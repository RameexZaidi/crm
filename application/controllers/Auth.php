<?php 
	class Auth extends CI_Controller{
		public function index(){
			$this->load->view('auth/login');
		}
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Model load
        $this->load->library('session');
    }

    public function Process() {
    date_default_timezone_set('Asia/Karachi');

    $username = $this->input->post('username');
    $u_passwd = $this->input->post('password');

    $user = $this->User_model->get_user($username);

    if ($user) {
        if (password_verify($u_passwd, $user->u_passwd)) {

            $this->session->set_userdata([
                'user_id'   => $user->user_id,
                'u_name'    => $user->u_name,
                'role'      => $user->role,
                'logged_in' => true
            ]);

            $today = date('Y-m-d');

            // ✅ Login log: Only one entry per day per user
            $this->db->where('agent_id', $user->user_id);
            $this->db->where('DATE(created_at)', $today);
            $loginLog = $this->db->get('tbl_login_log')->row();

            if (!$loginLog) {
                $log_data = [
                    'agent_id'   => $user->user_id,
                    'group_id'   => $user->grp_id,
                    'login_time' => date('Y-m-d H:i:s'),
                    'status'     => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('tbl_login_log', $log_data);

                // Get insert ID to update later
                $log_id = $this->db->insert_id();
            } else {
                $log_id = $loginLog->id; // Assuming the table has an ID field
            }

            // ✅ If role is agent, handle today's leads
            if ($user->role === 'agent') {
                $this->db->where('user_id', $user->user_id);
                $this->db->where('DATE(assign_date)', $today); // adjust to your column name
                $leads = $this->db->get('tbl_lead_assign_detail')->result();

                if (!empty($leads)) {
                    // Update status to 1 for all today's leads
                    $this->db->where('user_id', $user->user_id);
                    $this->db->where('DATE(assign_date)', $today);
                    $this->db->update('tbl_lead_assign_detail', ['status' => 1]);

                    // Update today's quota in tbl_login_log
                    $lead_count = count($leads);
                    $this->db->where('id', $log_id);
                    $this->db->update('tbl_login_log', ['today_quota' => $lead_count]);
                }
            }

            redirect('dashboard');

        } else {
            $this->session->set_flashdata('error', 'Password did not match');
            redirect('Auth');
        }
    } else {
        $this->session->set_flashdata('error', 'Username not found');
        redirect('Auth');
    }
}





    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth');
    }
}

?>