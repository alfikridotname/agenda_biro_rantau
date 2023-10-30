<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}
	}
	
	public function index()
	{
		$data['title']        = "Dashboard";
		$data['menu_sidebar'] = $this->load->view('layouts/menu_sidebar',$data,true);
		$this->template->load('template','index',$data);
	}
}