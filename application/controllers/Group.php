<?php 
    class Group extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Group_model');
    }

    public function index() {
        $data['groups'] = $this->Group_model->get_all();
        $this->load->view('layout/header', $data);
        $this->load->view('group/create_group', $data);
        $this->load->view('layout/footer', $data);
    } 

    public function GroupListing() {
        $data['groups'] = $this->Group_model->get_all();
        $this->load->view('layout/header', $data);
        $this->load->view('group/group_listing', $data);
        $this->load->view('layout/footer', $data);
    }

   

    public function store() {

    $config['upload_path']   = './assets/group_logo/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = 2048; // in KB (2MB)
    $config['encrypt_name']  = TRUE; // To prevent file name conflicts

    $this->load->library('upload', $config);

    $grp_logo = null;

    // Check if a file is selected and upload
    if (!empty($_FILES['grp_logo']['name'])) {
        if ($this->upload->do_upload('grp_logo')) {
            $uploadData = $this->upload->data();
            $grp_logo = $uploadData['file_name']; // Save file name to DB
        } else {
            $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors('', ''));
            redirect('Group/index');
            return;
        }
    }

    $data = [
        'comp_id'   => 1,
        'grp_name'  => $this->input->post('grp_name'),
        'grp_comp'  => $this->input->post('grp_comp'),
        'grp_desc'  => $this->input->post('grp_desc'),
        'grp_logo'  => $grp_logo,
        't_enable'  => 't',
        't_block'   => 't',
        'cr_date'   => date('Y-m-d'),
        'cr_time'   => date('Y-m-d H:i:s'),
        'cr_user'   => 1,
        'up_date'   => date('Y-m-d'),
        'up_time'   => date('Y-m-d H:i:s'),
        'up_user'   => 1,
        'up_type'   => 'Super-Admin'
    ];

    if ($this->Group_model->insert($data)) {
        $this->session->set_flashdata('success', 'Group added successfully!');
    } else {
        $this->session->set_flashdata('error', 'Failed to add group.');
    }

    redirect('Group');
}


}

?>