<?php 
	class Dashboard extends CI_Controller{
	    public function __construct(){
	        parent::__construct();
	        $this->load->model('DashboardModel');
	    }
		public function index(){
		    $data['total_leads'] = $this->DashboardModel->CountAssignLeads();
			$this->load->view('layout/header');
			$this->load->view('layout/content',$data);
			$this->load->view('layout/footer');
		}
		
		
	}
?>