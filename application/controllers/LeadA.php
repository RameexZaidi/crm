<?php 
	class LeadA extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('LeadManagementModel');
		}
		public function index(){
			$this->load->view('layout/header');
			$this->load->view('lead_a/upload_lead_a');
			$this->load->view('layout/footer');
		}

		public function UnAssignLeads(){
			$data['leads'] = $this->LeadManagementModel->get_unassigned_leads();
			$this->load->view('layout/header');
			$this->load->view('lead_a/un_assign_leads',$data);
			$this->load->view('layout/footer');
		}
	}

