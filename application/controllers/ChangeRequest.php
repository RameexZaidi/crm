<?php 
    class ChangeRequest extends CI_Controller{
         public function __construct() {
        parent::__construct();
        $this->load->model('Change_request_model');
        $this->load->model('Report_model'); // For updating report
        $this->load->library('session');
    }
        public function RequestForChange($report_id){
            $data['leads'] = $this->Change_request_model->GetReportForRequest($report_id);
           
            $data['report_id'] = $report_id;
            $this->load->view('layout/header');
            $this->load->view('report/create_change_request',$data);
            $this->load->view('layout/footer');
        }
    //     public function store() {
    //     $data = [
    //         'report_id' => $this->input->post('report_id'),
    //         'column_name' => $this->input->post('column_name'),
    //         'requested_change' => $this->input->post('requested_change'),
    //         'status' => 'pending',
    //         'user_id' => $this->session->userdata('user_id'),
    //     ];

    //     $this->Change_request_model->create($data);
    //     $this->session->set_flashdata('success', 'Change request submitted.');
    //     redirect('Report/ReportRequest');
    // }
    
    public function store() {
    $report_id = $this->input->post('report_id');

    $data = [
        'report_id' => $report_id,
        'column_name' => $this->input->post('column_name'),
        'requested_change' => $this->input->post('requested_change'),
        'status' => 'pending',
        'user_id' => $this->session->userdata('user_id'),
    ];

    // Insert into change_request table
    $this->Change_request_model->create($data);

    // Update 'change_request' = 1 in cc_reqrpt table for the given report_id
    $this->db->where('id', $report_id); // assuming 'id' is the PK in cc_reqrpt
    $this->db->update('cc_reqrpt', ['change_request' => 1]);

    // Flash message and redirect
    $this->session->set_flashdata('success', 'Change request submitted.');
    redirect('Report/ReportRequest');
}

    
    public function update($id) {
        $request = $this->Change_request_model->get_by_id($id);

        $status = $this->input->post('status');
        $remark = $this->input->post('manager_remark');

        if ($status == 'approved') {
            // Update report column
            $this->db->where('id', $request->report_id)
                     ->update('reports', [$request->column_name => $request->requested_change]);
        }

        $this->Change_request_model->update($id, [
            'status' => $status,
            'manager_remark' => $remark
        ]);

        $this->session->set_flashdata('success', 'Change request processed.');
        redirect('change_request/index');
    }
    
    public function ViewChangeRequest(){
        $data['request'] = $this->Change_request_model->ViewChangeRequest();
        $this->load->view('layout/header');
        $this->load->view('report/view_change_request',$data);
        $this->load->view('layout/footer');
    }
    
    public function UpdateReportRecord($id){
        $data['leads'] = $this->Change_request_model->GetChangeRequest($id);
        $this->load->view('layout/header');
        $this->load->view('report/update_report_record',$data);
        $this->load->view('layout/footer');
    }
        // For Manager
        public function updateLead()
{
    $lead_id = $this->input->post('lead_id');
    $change_request_id = $this->input->post('change_request_id');
    $user_id = $this->input->post('user_id');

    // Step 1: Update cc_leads_a
    $leadData = [
        'fname' => $this->input->post('f_name'),
        'mid_init' => $this->input->post('u_father'),
        'surname' => $this->input->post('u_mobile'),
        'phones' => $this->input->post('phones'),
        'street' => $this->input->post('street'),
        'city' => $this->input->post('city'),
        'state_abb' => $this->input->post('state_abb'),
        'zipcode' => $this->input->post('zipcode'),
        'ssn' => $this->input->post('ssn'),
        'email' => $this->input->post('email'),
        'gen_code' => $this->input->post('gen_code'),
        'dob' => $this->input->post('jn_date'),
        'AA' => $this->input->post('AA'),
    ];

    $this->db->where('id', $lead_id);
    $this->db->update('cc_leads_a', $leadData);

    // Step 2: Update change_requests status = 'approved'
    $this->db->where('id', $change_request_id);
    $this->db->update('change_requests', ['status' => 'approved']);

    // Step 3: File Upload (if any)
    $report_file = '';
    if (!empty($_FILES['report_file']['name'])) {
        $config['upload_path'] = './assets/report/';
        $config['allowed_types'] = 'pdf|doc|docx|jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('report_file')) {
            $uploadData = $this->upload->data();
            $report_file = $uploadData['file_name'];
        } else {
            $this->session->set_flashdata('error', 'Report upload failed: ' . $this->upload->display_errors());
            redirect('Lead/view/' . $lead_id);
            return;
        }
    }

    // Step 4: Disable all old reports for this lead
    $this->db->where('dl_id', $lead_id);
    $this->db->update('cc_reqrpt', ['t_enable' => 'f']);

    // Step 5: Insert new report with t_enable = 't'
    $newReportData = [
        'cr_user' => $user_id,
        'comp_id' => 1,
        'dl_id' => $lead_id,
        'ag_id' => $user_id,
        'fileupload' => $report_file,
        't_enable' => 't',
        'cr_time' => date('Y-m-d H:i:s'),
        'cr_date' => date('Y-m-d'),
        'up_type' => $this->session->userdata('role'),
    ];

    $this->db->insert('cc_reqrpt', $newReportData);

    // Final Step: Success Message
    $this->session->set_flashdata('success', 'Report updated successfully with uploaded file.');
    redirect('ChangeRequest/ViewChangeRequest');
}


        
    }
?>