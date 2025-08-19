<?php 
	class Agent extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('AgentModel');
			$this->load->model('Group_model');
		}
		public function index(){
		    $data['groups'] = $this->Group_model->get_all();
			$this->load->view('layout/header');
			$this->load->view('agent/create_agent',$data);
			$this->load->view('layout/footer');
		}
		public function store()
{


    // Generate random username and password
    $random_username = 'USR' . strtoupper(substr(md5(time() . rand()), 0, 4));
    $plain_password = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*'), 0, 8);
    $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

    // Prepare agent data
    $agent_data = [
        'u_name'          => $this->input->post('f_name'),
        'u_father'        => $this->input->post('u_father'),
        'u_mobile'        => $this->input->post('u_mobile'),
        'u_whatsapp'      => $this->input->post('u_whatsapp'),
        'u_email'         => $this->input->post('u_email'),
        'grp_id'          => $this->input->post('grp_id'),
        'u_qual'          => $this->input->post('u_qual'),
        'u_dob'           => $this->input->post('u_dob'),
        'u_mob2'          => $this->input->post('u_mob2'),
        'u_ph'            => $this->input->post('u_ph'),
        'u_cnic'          => $this->input->post('u_cnic'),
        'u_gender'        => $this->input->post('u_gender'),
        'u_spouse'        => $this->input->post('u_spouse'),
        'married'         => $this->input->post('married'),
        'u_add'           => $this->input->post('u_add'),
        'u_country'       => $this->input->post('u_country'),
        'u_state'         => $this->input->post('u_state'),
        'u_city'          => $this->input->post('u_city'),
        'jn_date'         => $this->input->post('jn_date'),
        'rjn_dt'          => $this->input->post('rjn_dt'),
        'u_sal'           => $this->input->post('u_sal'),
        'cr_user'         => $this->input->post('cr_user'),
        'up_user'         => $this->input->post('up_user'),
        'login_name'      => $random_username,
        'plain_password'  => $plain_password,
        'u_passwd'        => $hashed_password,
    ];

    // Insert agent
    $agent_id = $this->AgentModel->insert_user($agent_data);

    if ($agent_id) {
        // Prepare mu_users data
        $mu_user = [
            'user_id'        => $agent_id,
            'comp_id'        => 1,
            'u_email'        => $this->input->post('u_email'),
            'u_passwd'       => $hashed_password,
            'u_pwd'          => $hashed_password,
            'u_name'         => $random_username,
            'u_mobile'       => $this->input->post('u_mobile'),
            'cr_date'        => date('m-d-Y'),
            'cr_time'        => date('Y-m-d H:i:s'),
            'cr_user'        => 1,
            'up_date'        => date('Y-m-d'),
            'up_time'        => date('Y-m-d H:i:s'),
            'up_user'        => 0,
            'u_enable'       => 't',
            'u_block'        => 'f',
            'u_ver'          => 'yes',
            'ver_code'       => 00,
            'frgt_code'      => 00,
            'frgt_code_exp'  => 00,
            'role'			 =>$this->input->post('role'),	
        ];

        // Insert into mu_users table
        $this->db->insert('mu_users', $mu_user);

        // Flash success + show credentials
        $this->session->set_flashdata('success', 'User created successfully.<br>Username: <b>' . $random_username . '</b><br>Password: <b>' . $plain_password . '</b>');
    } else {
        $this->session->set_flashdata('error', 'Failed to create user.');
    }

    redirect('Agent/index');
}


			public function upload_file()
{
    $config['upload_path']   = './assets/agents/';
    $config['allowed_types'] = '*';  // or 'jpg|jpeg|png|pdf|doc|docx'
    $config['max_size']      = 2048;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('file')) {
        $data = $this->upload->data();
        echo json_encode(['success' => true, 'file_name' => $data['file_name']]);
    } else {
        echo json_encode(['success' => false, 'error' => $this->upload->display_errors()]);
    }
}

public function AgentListing(){
	$data['agents'] = $this->AgentModel->GetAgent();
	
	$this->load->view('layout/header');
	$this->load->view('agent/agent_listing',$data);
	$this->load->view('layout/footer');
}

public function UserListing(){
    $data['user'] = $this->AgentModel->GetUser();
    $this->load->view('layout/header');
    $this->load->view('agent/view_user',$data);
    $this->load->view('layout/footer');
}

public function change_password() {
    $user_id = $this->input->post('user_id');
    $new_password = $this->input->post('new_password');
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $now = date('Y-m-d H:i:s');

    // Prepare data for both tables
    $mu_users_data = [
        'u_passwd' => $hashed_password,
        'u_pwd' => $hashed_password,
        'last_password_changed_at' => $now
    ];

    $cc_agents_data = [
        'u_passwd' => $hashed_password,
        'plain_password' => $new_password,
        'last_password_changed_at' => $now
    ];

    // Load model and update both tables
    

    $mu_updated = $this->AgentModel->update_mu_users($user_id, $mu_users_data);
    $cc_updated = $this->AgentModel->update_cc_agents($user_id, $cc_agents_data);

    if ($mu_updated && $cc_updated) {
    $this->session->set_flashdata('success', 'Password changed successfully for both tables.');
    } else {
        $this->session->set_flashdata('error', 'Password change failed.');
    }


    redirect('Agent/UserListing'); // Replace with your actual user list route
}

public function toggle_status() {
    $user_id = $this->input->post('user_id');
    $status = $this->input->post('status');
    date_default_timezone_set('Asia/Karachi');
    $now = date('Y-m-d H:i:s');

    

    $mu_update = $this->AgentModel->update_mu_user_status($user_id, $status, $now);
    $cc_update = $this->AgentModel->update_cc_agent_status($user_id, $status, $now);

    if ($mu_update && $cc_update) {
        echo json_encode(['status' => 'success', 'message' => 'User status updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update status']);
    }
}

	}
?>