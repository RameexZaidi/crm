<?php 
	class LeadMnagement extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('LeadManagementModel');
		}
		public function index(){
			$data['all_leads'] = $this->LeadManagementModel->GetAllLeads();
			
			$this->load->view('layout/header');
			$this->load->view('manage_lead/lead_list_a_type',$data);
			$this->load->view('layout/footer');
		}

		public function Lead_B_Type(){
			$data['all_leads'] = $this->LeadManagementModel->get_cc_b_leads();
			$this->load->view('layout/header');
			$this->load->view('manage_lead/lead_list_b_type',$data);
			$this->load->view('layout/footer');
		}
	}
?>