<?php 
    class Report extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->model('Report_model');
            $this->load->model('Deal_model');
        }
        // For Report Manager
        public function index(){
            $data['report_request'] = $this->Report_model->GetReportRequest();
            $this->load->view('layout/header');
            $this->load->view('report/view_report_request',$data);
            $this->load->view('layout/footer');
        }
        
        //For Manager    
        public function ReportUploading($lead_id){
            $data['leads'] = $this->Report_model->GetLeadsDetail($lead_id);
            $this->load->view('layout/header');
            $this->load->view('report/report_uploading',$data);
            $this->load->view('layout/footer');
        }
       
       
       //For Manager     
        public function store() {
    $this->load->library('upload');
    $lead_id = $this->input->post('lead_id');
    $user_id = $this->session->userdata('user_id');
    $report_access = $this->input->post('report_access'); // <-- Get dropdown value

    $config['upload_path'] = './assets/report/';
    $config['allowed_types'] = 'pdf';
    $config['max_size'] = 10240; // 10MB
    $config['encrypt_name'] = TRUE;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('report_upload')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('LeadsProcess/form/'.$lead_id);
    } else {
        $upload_data = $this->upload->data();
        $file_path = 'assets/report/' . $upload_data['file_name'];

        // Insert file record
        $data = [
            'comp_id'     => 1,
            'dl_id'       => $lead_id,
            'whoreq'      => 'pr',
            'ag_id'       => $user_id,
            'mang_id'     => 0,
            'fileupload'  => $file_path,
            't_enable'    => true,
            't_block'     => false,
            'cr_date'     => date('Y-m-d'),
            'cr_time'     => date('H:i:s'),
            'cr_user'     => $user_id,
            'up_date'     => date('Y-m-d'),
            'up_time'     => date('H:i:s'),
            'up_user'     => $user_id,
            'up_type'     => 'report manager'
        ];

        $this->db->insert('cc_reqrpt', $data);

        // ✅ Now check if report_access = 1, update tbl_lead_working
        if ($report_access == '1') {
            $this->db->where('lead_id', $lead_id);
            $this->db->update('tbl_lead_working', ['report_request_enable' => 1]);
        }

        $this->session->set_flashdata('success', 'Report uploaded successfully.');
        redirect('Report/ReportUploading/'.$lead_id);
    }
}

    
    //For Agent / Super Agent
    public function UploadedReport(){
        $data['uploaded_report'] = $this->Report_model->GetUploadedReport();
        $this->load->view('layout/header');
        $this->load->view('report/uploaded_reports',$data);
        $this->load->view('layout/footer');
    }
    //For Agent / Super Agent
    public function ReportRequest(){
        $data['uploaded_report'] = $this->Report_model->ShowLeadsTouser();
    //   die($this->db->last_query());
        $this->load->view('layout/header');
        $this->load->view('report/uploaded_reports',$data);
        $this->load->view('layout/footer');
    }
    
    
    // Admin
    public function ReportTracking(){
        $data['tracking'] = $this->Report_model->ReportTracking();
        
        $this->load->view('layout/header');
        $this->load->view('report/report_tracking',$data);
        $this->load->view('layout/footer');
        
    
    }

    }
?>