<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
	}
	
	public function index()
	{
		$data['title'] = "Login";
		$this->load->view('login',$data);
	}

	public function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
			);
		$cek = $this->m->cek_login("tbl_login",$where)->num_rows();
		if($cek > 0){
 
			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);
 
			$this->session->set_userdata($data_session);
 			$this->session->set_flashdata('message', 'Sukses');
			redirect(base_url("dashboard"));
		}else{
			$this->session->set_flashdata('message', 'Username atau Password Salah !');
			redirect(base_url("auth"));
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
}
