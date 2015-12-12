<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('datatable');
	}

	public function datatable_data(){
		$this->load->model('employee_model');
		$this->load->library('ajax');
		
		$data = $this->employee_model->get_datatable_data();
		$this->ajax->send($data);
	}
}
