<?php 
    class Deal extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Deal_model');
        }
        public function index(){
            $data['leads'] = $this->Deal_model->GetDeals();
            $this->load->view('layout/header');
            $this->load->view('lead_working/deals',$data);
            $this->load->view('layout/footer');
        }
        
        public function Tracking($lead_id){
            $data['lead'] = $this->Deal_model->LeadTracking($lead_id);
            $this->load->view('layout/header');
            $this->load->view('lead_working/lead_tracking',$data);
            $this->load->view('layout/footer');
        }
        
        
        public function LeadConversion($lead_id)
{
    // Sabse pehle, Deal_model ka function call karke lead ki tracking info hasil ki ja rahi hai.
    $data['leads'] = $this->Deal_model->LeadTracking($lead_id);

    // tbl_lead_working table se agent_id, qualifier_id aur closer_id liye ja rahe hain.
    $this->db->select('agent_id, qualifier_id, closer_id,super_agent_id');
    $this->db->where('lead_id', $lead_id);
    $lead = $this->db->get('tbl_lead_working')->row();

    // Ye array mein hum role-wise users ka data store karein ge.
    $assigned_users = [];

    if ($lead) {
        // IDs ko array mein rakhein
        $ids = array_filter([
            'agent' => $lead->agent_id,
            'super_agent' => $lead->super_agent_id,
            'qualifier' => $lead->qualifier_id,
            'closer' => $lead->closer_id
        ]);

        // Agar array khali nahi to cc_agents table se naam uthao
        if (!empty($ids)) {
            $this->db->select('id, u_name');
            $this->db->from('cc_agents');
            $this->db->where_in('id', $ids);
            $query = $this->db->get();
            $results = $query->result();

            foreach ($results as $user) {
                foreach ($ids as $role => $id) {
                    if ($user->id == $id) {
                        $assigned_users[$role] = [
                            'id' => $user->id,
                            'u_name' => $user->u_name
                        ];
                    }
                }
            }
        }
    }

    // Assigned users ka data view ke liye
    $data['assigned_users'] = $assigned_users;

    // ✅ tbl_convert_into_deal se remarks aur status check karna
    $this->db->select('admin_remarks, status');
    $this->db->from('tbl_convert_into_deal');
    $this->db->where('lead_id', $lead_id);
    $deal_info = $this->db->get()->row();

    if ($deal_info) {
        $data['admin_remarks'] = $deal_info->admin_remarks;
        $data['deal_status'] = $deal_info->status;
    } else {
        $data['admin_remarks'] = null;
        $data['deal_status'] = null;
    }

    // View load karwana
    $this->load->view('layout/header');
    $this->load->view('lead_working/lead_conversion', $data);
    $this->load->view('layout/footer');
}


        
        
        public function submitConversion()
        {
            $lead_id        = $this->input->post('lead_id');
            $status         = $this->input->post('status');
            $admin_remarks  = $this->input->post('remarks');
            $final_amount   = $this->input->post('final_amount');
            $revert_users   = $this->input->post('revert_users'); // array
        
            // Check if lead already exists with status 1
            $existing_deal = $this->db->where('lead_id', $lead_id)->where('is_active', 1)->get('tbl_convert_into_deal')->row();
        
            if ($existing_deal) {
                // Update existing record
                $update_data = [
                    'conversion_date' => date('Y-m-d'),
                    'status'          => $status,
                    'admin_remarks'   => $admin_remarks
                ];
        
                $this->db->where('id', $existing_deal->id)->update('tbl_convert_into_deal', $update_data);
            } else {
                // Auto-generate deal_code (e.g., DEAL-0001, DEAL-0002)
               // Get last deal_code_series from table
                $last = $this->db->select('deal_code_series')->order_by('deal_code_series', 'DESC')->limit(1)->get('tbl_convert_into_deal')->row();
                
                // Next ID (increment by 1 from last series)
                $next_id = isset($last->deal_code_series) ? ((int)$last->deal_code_series) + 1 : 1;
                
                // Deal Code (formatted)
                $deal_code = 'DEAL-' . str_pad($next_id, 4, '0', STR_PAD_LEFT);
                
                        
                // Insert new record
                $data = [
                    'deal_code_series'  => $next_id, // Unique number
                    'deal_code'         => $deal_code,      // Formatted code
                    'lead_id'           => $lead_id,
                    'conversion_date'   => date('Y-m-d'),
                    'status'            => $status,
                    'admin_remarks'     => $admin_remarks,
                    'closer_amount'     => $final_amount,
                ];
                
                $this->db->insert('tbl_convert_into_deal', $data);
            }
        
            // Handle Revert
            if ($status == 'Revert') {
                $revert_ids = $this->input->post('revert_users'); // Array of selected user IDs
                $update_data = [];
        
                // Get lead info from db
                $lead = $this->db->where('lead_id', $lead_id)->get('tbl_lead_working')->row();
        
                if (!empty($lead)) {
                    if (in_array($lead->agent_id, $revert_ids)) {
                        $update_data['agent_status'] = 0;
                        $update_data['agent_revert'] = 1;
                    }
        
                    if (in_array($lead->qualifier_id, $revert_ids)) {
                        $update_data['qualifier_revert'] = 1;
                    }
        
                    if (in_array($lead->closer_id, $revert_ids)) {
                        $update_data['closer_revert'] = 1;
                    }
        
                    // ✅ ONLY update if data is not empty
                    if (!empty($update_data)) {
                        $this->db->where('lead_id', $lead_id);
                        $this->db->set($update_data);
                        $this->db->update('tbl_lead_working');
                    }
                }
            }
        
            $this->session->set_flashdata('success', 'Lead converted successfully!');
            redirect('deal/LeadConversion/' . $lead_id);
        }

        public function ApproveDeals(){
            $data['deals'] = $this->Deal_model->GetApproveDeals();
            $this->load->view('layout/header');
            $this->load->view('lead_working/final_deals',$data);
            $this->load->view('layout/footer');
        }

    }
?>