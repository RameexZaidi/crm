<?php 
	class LeadA extends CI_Controller{
		public function index(){
			$this->load->view('layout/header');
			$this->load->view('lead_a/upload_lead_a');
			$this->load->view('layout/footer');
		}
	}
?>