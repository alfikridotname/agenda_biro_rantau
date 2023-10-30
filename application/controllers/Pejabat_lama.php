<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
	}
	
	public function index()
	{
		$data['title']        = "Pejabat";
		$data['menu_sidebar'] = $this->load->view('layouts/menu_sidebar',$data,true);
		$data['extra_js']     = $this->load->view('pages/pejabat/js',$data,true);
		$this->template->load('template','pages/pejabat/pejabat',$data);
	}

	public function dataTable_pejabat()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $column_order   = array('');
            $column_search  = array('nama_asn','jabatan_asn');
            $order = array('' => '');
            $list = $this->m->get_datatables('tbl_asn',$column_order,$column_search,$order,array('id_asn !='=>0000));
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $row   = array();
                $row[] = $no;
                $row[] = $lists->nama_asn;
                $row[] = $lists->jabatan_asn;
                $row[] = $lists->status;
                $row[] = '<a href="javascript:void(0)" onclick="editPejabat('."'".$lists->id_asn."'".')" class="btn btn-sm btn-info">Edit</a> <a href="javascript:void(0)" onclick="deletePejabat('."'".$lists->id_asn."'".')" class="btn btn-sm btn-danger">Delete</a>';
             
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->m->count_all('tbl_asn',array('id_asn'!=0000)),
                            "recordsFiltered" => $this->m->count_filtered('tbl_asn',$column_order,$column_search,$order,array('')),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
	}

	public function save_pejabat()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array());

            $this->form_validation->set_rules('nama_asn', 'Nama Pejabat', 'required');
            $this->form_validation->set_rules('jabatan_asn', 'Jabatan', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $data = array('nama_asn'=>$this->input->post('nama_asn'),
                			  'jabatan_asn'=>$this->input->post('jabatan_asn'),
                			  'status'=>'ADA'
                			 );
                $result = $this->m->my_insert('tbl_asn',$data);
                $data['success'] = true;
            }else{
                foreach ($_POST as $key => $value) {
                    $data['messages'][$key] = form_error($key);
                }
                $data['success'] = false;
            }

            echo json_encode($data);
        }
    }
}