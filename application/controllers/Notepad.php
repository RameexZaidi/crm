<?php 
	class Notepad extends CI_Controller{
		public function index(){
			$this->load->view('layout/header');
			$this->load->view('notepad/notepad');
			$this->load->view('layout/footer');
		}
	}
?>