<?php 
    class LeadWorking extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('LeadWorkingModel');
        }
        public function Working(){
            $data['leads'] = $this->LeadWorkingModel->GetAssignedLead();
            // die($this->db->last_query());
            $this->load->view('layout/header');
            $this->load->view('lead_working/lead_screen',$data);
            $this->load->view('layout/footer');
        }
        
        public function LeadProcess($id){
            $data['leads'] = $this->LeadWorkingModel->GetAssignedLeadById($id);
            $this->load->view('layout/header');
            $this->load->view('lead_working/start_working',$data);
            $this->load->view('layout/footer');
        }
        
        public function fetch_users_by_role()
        {
            $role = $this->input->post('role');
            $users = $this->LeadWorkingModel->get_users_by_role($role); // You’ll create this
        
            $options = '<option value="">Select User</option>';
            foreach ($users as $user) {
                $options .= '<option value="' . $user->id . '">' . htmlspecialchars($user->u_name) . '</option>';
            }
            echo $options;
        }
        
        public function manual_login_submit()
{
    $user_id = $this->input->post('user_id');
    $password = $this->input->post('password');
    $lead_id = $this->input->post('lead_id');

    $user = $this->LeadWorkingModel->get_user_by_id($user_id);

    if ($user && password_verify($password, $user->u_passwd)) {

        // Destroy previous session
        $this->session->sess_destroy();
        session_start(); // Re-start session manually

        // Set new session
        $this->session->set_userdata([
            'user_id' => $user->id,
            'name' => $user->u_name,
            'role' => $user->role,
            'is_logged_in' => true
        ]);

        // Update lead
        if ($lead_id) {
            $data = [];
            if ($user->role == 'closer') {
                $data['closer_id'] = $user->id;
            } elseif ($user->role == 'qualifier') {
                $data['qualifier_id'] = $user->id;
            } elseif ($user->role == 'agent') {
                $data['agent_id'] = $user->id;
            }

            if (!empty($data)) {
                $this->db->where('id', $lead_id)->update('leads', $data);
            }
        }

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
    }
}



    }
?>