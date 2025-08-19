<?php 
    class LeadsProcess extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('LeadsProcess_model');
        }
        public function index(){
            $data['leads'] = $this->LeadsProcess_model->GetLeads();
           
            $this->load->view('layout/header');
            $this->load->view('lead_working/process',$data);
            $this->load->view('layout/footer');
        } 
        
       public function PreviousLeads() {
    $data['leads'] = $this->LeadsProcess_model->GetPreviousLeads();

            // Fetch all lead_ids that are already in process (from tbl_lead_working)
            $assigned_leads = $this->db->select('lead_id')->get('tbl_lead_working')->result_array();
            $data['in_process_ids'] = array_column($assigned_leads, 'lead_id');
        
            $this->load->view('layout/header');
            $this->load->view('lead_working/previous_leads', $data);
            $this->load->view('layout/footer');
        }
        
        public function BlankLeads(){
            $this->load->view('layout/header');
            $this->load->view('lead_working/blank_leads');
            $this->load->view('layout/footer');
        }

        public function ajaxSubmitReportRequest()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }

    $report_request = $this->input->post('report_request');
    $lead_id = $this->input->post('lead_id');
    $role = $this->session->userdata('role');
    $user_id = $this->session->userdata('user_id');

    // Check if already submitted
    $existing = $this->db->where('lead_id', $lead_id)
                         ->where('report_request', 1)
                         ->get('tbl_lead_working')
                         ->num_rows() > 0;

    if ($report_request === 'yes' && !$existing) {
        if (!in_array($role, ['agent', 'super_agent'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Only agents and super agents can send report requests.'
            ]);
            return;
        }

        $insertData = [
            'lead_id' => $lead_id,
            'report_request' => 1,
            'status' => 'report_requested',
            'agent_id' => ($role === 'agent') ? $user_id : null,
            'super_agent_id' => ($role === 'super_agent') ? $user_id : null,
            'qualifier_id' => 0,
            'closer_id' => 0,
            'agent_remarks' => null,
            'super_agent_remarks' => null,
            'qualifier_remarks' => null,
            'closer_remarks' => null,
            'remarks_at' => null,
            'super_agent_remarks_at' => null,
            'qualifier_remarks_at' => null,
            'closer_remarks_at' => null,
            'closer_amount' => 0,
            'convert_into_deal' => 0,
            'merged_remarks' => null,
        ];

        $this->db->insert('tbl_lead_working', $insertData);

        echo json_encode(['status' => 'success']);
        return;
    }

    echo json_encode(['status' => 'error', 'message' => 'Report already requested or invalid request.']);
}



   public function StartWorking($lead_id)
{
    $user_id = $this->session->userdata('user_id');
    $data['leads'] = $this->LeadsProcess_model->GetLeadsDetail($lead_id);
    $working = $this->LeadsProcess_model->GetLeadRemarks($lead_id);

    $remarks = '';
    $current_user_remark = '';
    $amount = '0';
    $report_request = ''; // Default
    $report_request_enable = 0; // Default disable

    if ($working) {
        $remarks = $working->merged_remarks;
        $current_user_remark = $working->merged_remarks;

        if ($working->closer_id == $user_id) {
            $amount = $working->closer_amount;
        }

        // ✅ Get report_request value from DB
        $report_request = $working->report_request ?? '';

        // ✅ Check if request was already sent (enable flag)
        if ($working->report_request == 1) {
            $report_request_enable = 1;
        }
    }

    $data['all_remarks'] = $remarks;
    $data['remarks'] = $current_user_remark;
    $data['amount'] = $amount;

    // ✅ Pass to view
    $data['report_request'] = $report_request;
    $data['report_request_enable'] = $report_request_enable;

    $this->load->view('layout/header');
    $this->load->view('lead_working/lead_working', $data);
    $this->load->view('layout/footer');
}






        
        public function get_users_by_role()
            {
                $role = $this->input->post('role');
            
                if ($role) {
                    $query = $this->db->get_where('mu_users', ['role' => $role]);
                    $users = $query->result();
            
                    if (!empty($users)) {
                        echo json_encode([
                            'status' => 'success',
                            'users' => $users
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'No users found for this role.'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Role is required.'
                    ]);
                }
            }
            public function login_user()
            {
                $user_id = $this->input->post('user_id');
                $password = $this->input->post('password');
                $role = $this->input->post('role');
            
                // Get user from cc_agents by ID and role
                $this->db->select('mu_users.*, cc_agents.u_name, cc_agents.id as agent_id, cc_agents.u_passwd');
                $this->db->from('mu_users');
                $this->db->join('cc_agents', 'cc_agents.id = mu_users.user_id');
                $this->db->where('mu_users.user_id', $user_id);
                $this->db->where('mu_users.role', $role);
                $query = $this->db->get();
            
                if ($query->num_rows() > 0) {
                    $user = $query->row();
            
                    if (password_verify($password, $user->u_passwd)) {
                        // Instead of destroying session, just overwrite
                        $this->session->set_userdata([
                            'user_id'   => $user->user_id,
                            'u_name'    => $user->u_name,
                            'role'      => $user->role,
                            'logged_in' => true
                        ]);
            
                        echo json_encode(['status' => 'success']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Incorrect password.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
                }
            }
        
         public function store()
        {
            $lead_id = $this->input->post('lead_id', true);
            $remarks = trim($this->input->post('remarks', true));
            $final_amount = $this->input->post('final_amount', true);
            $report_request = ($this->input->post('report_request') === 'yes') ? 1 : 0;
        
            $user_id = $this->session->userdata('user_id');
            $role = $this->session->userdata('role');
            date_default_timezone_set('Asia/Karachi');
            $now = date('Y-m-d H:i:s');
        
            $existing = $this->db->get_where('tbl_lead_working', ['lead_id' => $lead_id])->row_array();
        
            if ($report_request == 1 && !$existing) {
                if (!in_array($role, ['agent', 'super_agent'])) {
                    $this->session->set_flashdata('error', 'Report request can only be sent by agent or super_agent.');
                    redirect('LeadsProcess/StartWorking/' . $lead_id);
                    return;
                }
        
                $insertData = [
                    'lead_id' => $lead_id,
                    'report_request' => 1,
                    'status' => 'report_requested',
                    'agent_id' => ($role === 'agent') ? $user_id : null,
                    'super_agent_id' => ($role === 'super_agent') ? $user_id : null,
                    'qualifier_id' => 0,
                    'closer_id' => 0,
                    'agent_remarks' => null,
                    'super_agent_remarks' => null,
                    'qualifier_remarks' => null,
                    'closer_remarks' => null,
                    'remarks_at' => null,
                    'super_agent_remarks_at' => null,
                    'qualifier_remarks_at' => null,
                    'closer_remarks_at' => null,
                    'closer_amount' => 0,
                    'convert_into_deal' => 0,
                    'merged_remarks' => null,
                ];
        
                $this->db->insert('tbl_lead_working', $insertData);
                redirect('LeadsProcess/StartWorking/' . $lead_id);
                return;
            }
        
            if (empty($remarks)) {
                $this->session->set_flashdata('error', 'Remarks cannot be empty.');
                redirect('LeadsProcess/StartWorking/' . $lead_id);
                return;
            }
        
            $updateData = ['report_request' => $report_request];
            $roleLabel = ucfirst(str_replace('_', ' ', $role));
        
            switch ($role) {
                case 'agent':
                    if (empty($existing['agent_remarks'])) {
                        $updateData['agent_id'] = $user_id;
                        $updateData['agent_remarks'] = '';
                        $updateData['remarks_at'] = $now;
                        $updateData['status'] = 'agent_done';
                    }
                    break;
        
                case 'super_agent':
                    if (empty($existing['super_agent_remarks'])) {
                        $updateData['super_agent_id'] = $user_id;
                        $updateData['super_agent_remarks'] = '';
                        $updateData['super_agent_remarks_at'] = $now;
                        $updateData['status'] = 'super_agent_done';
                    }
                    break;
        
                case 'qualifier':
                    if (empty($existing['qualifier_remarks'])) {
                        $updateData['qualifier_id'] = $user_id;
                        $updateData['qualifier_remarks'] = '';
                        $updateData['qualifier_remarks_at'] = $now;
                        $updateData['status'] = 'qualifier_done';
                    }
                    break;
        
                case 'closer':
                if (empty($existing['closer_remarks'])) {
                    $updateData['closer_id'] = $user_id;
                    $updateData['closer_remarks'] = '';
                    $updateData['closer_remarks_at'] = $now;
                    $updateData['closer_amount'] = $final_amount;
                    $updateData['status'] = 'done';
                    $updateData['convert_into_deal'] = 1;
            
                    // Check if revert is 1, then set qualifier_revert = 1
                    $revert = $this->input->post('revert', true);
                    if ($revert == 1) {
                        $updateData['qualifier_revert'] = 1;
                    }
                }
                break;

        
                default:
                    $this->session->set_flashdata('error', 'Invalid role.');
                    redirect('LeadsProcess/StartWorking/' . $lead_id);
                    return;
            }
        
            // Yeh important part: merged_remarks ko sirf new remarks set karna hai, overwrite karna hai
            switch ($role) {
                case 'agent':
                    $merged_remarks = "\n \n" . $remarks;
                    break;
                case 'super_agent':
                    $merged_remarks = "\n \n" . $remarks;
                    break;
                case 'qualifier':
                    $merged_remarks = "\n \n" . $remarks;
                    break;
                case 'closer':
                    $merged_remarks = "\n \n" . $remarks;
                    break;
                default:
                    $merged_remarks = $remarks;
                    break;
            }
        
            $updateData['merged_remarks'] = $merged_remarks;
        
            if ($existing) {
                $this->db->where('lead_id', $lead_id)->update('tbl_lead_working', $updateData);
            } else {
                $updateData['lead_id'] = $lead_id;
                $this->db->insert('tbl_lead_working', $updateData);
            }
        
            redirect('LeadsProcess/StartWorking/' . $lead_id);
        }




    }
?>