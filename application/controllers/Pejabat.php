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
            $list = $this->m->get_datatables('tbl_asn',$column_order,$column_search,$order,array());
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
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $data = array('nama_asn'=>$this->input->post('nama_asn'),
                			  'jabatan_asn'=>$this->input->post('jabatan_asn'),
                			  'status'=>$this->input->post('status')
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
    public function saveedit_pejabat()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array());

            $this->form_validation->set_rules('nama_asn', 'Nama Pejabat', 'required');
            $this->form_validation->set_rules('jabatan_asn', 'Jabatan', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $data = array('nama_asn'=>$this->input->post('nama_asn'),
                              'jabatan_asn'=>$this->input->post('jabatan_asn'),
                              'status'=>$this->input->post('status')
                             );
                $result = $this->db->update('tbl_asn',$data, ['id_asn'=>$this->input->post('id_asn')]);
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
    public function delete_penjabat()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $id_penjabat = $this->input->post('id_penjabat');
            $data = array('success'=>false, 'messages'=>array());
            $this->db->delete('tbl_asn', ['id_asn'=>$id_penjabat]);
                $data['success'] = true;

            $this->session->set_flashdata('pesan','<div class="alert alert-info">Data penjabat dihapus</div>');

            echo json_encode($data);
        }
    }

    public function get_penjabat()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array(),'pilihan'=>[], 'data'=>[]);
            $id_penjabat = $this->input->post('id_penjabat');
            $q = $this->db->get_where('tbl_asn', ['id_asn'=>$id_penjabat])->row();

            $pilihan_jabatan = [
                  'Kepala Biro Administrasi Pembangunan', 
                  'Kepala Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Daerah',
                  'Kepala Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah',
                  'Kepala Bagian Pelaporan Pelaksanaan Pembangunan',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan APBD',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan APBN',
                  'Kepala Sub Bagian Tata Usaha',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah I',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah II',
                  // 'Kepala Sub Bagian Pengendalian Administrasi Pelaksanaan Pembangunan Wilayah III',
                  // 'Kepala Sub Bagian Analisis Capaian Kinerja Pembangunan Daerah',
                  // 'Kepala Sub Bagian Kebijakan Pembangunan Daerah',
                  // 'Kepala Sub Bagian Pelaporan Pelaksanaan Pembangunan Daerah',
                  'Perencana Ahli Muda',
                  'Analis Kebijakan Ahli Muda',
                  'Analis Pembangunan',
                  'Staf Tata Usaha',
                  'Penyusun Laporan Keuangan',
                  'Pranata Komputer',
                  'Pengadministrasi Umum',
                  'Penyusun Program, Anggaran dan Laporan',
                  'Sopir',
                  'Tenaga Ahli Web Programmer',
                  
                  'Eselon III', 'Eselon IV', 'Seluruh Staf', 'Staff Terkait', 'PLH Kabag Pembangunan','Semua Kabag','Semua Kasubag','Kasubag Terkait'];

                $data['success'] = true;
                $data['data']['id_asn'] = $q->id_asn;
                $data['data']['nama_asn'] = $q->nama_asn;
                $data['data']['jabatan_asn'] = $q->jabatan_asn;
                $data['data']['jabatan_asn'] = $q->jabatan_asn;
                $data['data']['status'] = $q->status;
                $data['pilihan'] = $pilihan_jabatan;
            

            echo json_encode($data);
        }
    }
}