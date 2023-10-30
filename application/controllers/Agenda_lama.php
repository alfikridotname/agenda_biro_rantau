<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
	}
	
	public function index()
	{
		$data['title']        = "Agenda";
        $data['pejabat']      = $this->m->get_all('tbl_asn','','')->result();
		$data['menu_sidebar'] = $this->load->view('layouts/menu_sidebar',$data,true);
		$data['extra_js']     = $this->load->view('pages/agenda/js',$data,true);
		$this->template->load('template','pages/agenda/agenda',$data);
	}

	public function dataTable_agenda()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $column_order   = array('','nama_asn','jabatan_asn','agenda','tanggal','jam_mulai','tempat');
            $column_search  = array('no_agenda','nama_asn','jabatan_asn','agenda','tempat');
            $order = array('' => '');
            $list = $this->m->get_datatables('v_agenda',$column_order,$column_search,$order,array(''));
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $row   = array();
                $row[] = $no;
                $row[] = $lists->no_agenda;
                $hasil = $this->db->query("SELECT jabatan_asn FROM v_agenda_detail WHERE id_agenda = {$lists->id_agenda}")->result();
                if(empty($hasil))
                {
                    $ccc = "Not Set";
                }else{
                    $isi = [];
                    foreach ($hasil as $key) {
                        $strip = count($hasil) > 1 ? '- ' : '';
                        $isi[] = $strip." ".$key->jabatan_asn;
                        $aaa   = join(",",$isi); // 'a,b'
                        $bbb   = explode(",", $aaa);
                        $ccc   = implode("<br>",$bbb);
                    }
                }
                // print_r($hasil);
                $row[] = $ccc;
                $row[] = $lists->agenda;
                $row[] = $lists->tanggal;
                $row[] = $lists->tanggal_selesai;
                $row[] = $lists->jam_mulai;
                $row[] = $lists->tempat;
                $row[] = '<a href="javascript:void(0)" onclick="tambahAgendaDetail('."'".$lists->id_agenda."'".')" class="btn btn-sm btn-primary">Pejabat</a> <a href="javascript:void(0)" onclick="editAgenda('."'".$lists->id_agenda."'".')" class="btn btn-sm btn-info">Edit</a> <a href="javascript:void(0)" onclick="deleteAgenda('."'".$lists->id_agenda."'".')" class="btn btn-sm btn-danger">Delete</a>';
             
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->m->count_all('v_agenda',array('')),
                            "recordsFiltered" => $this->m->count_filtered('v_agenda',$column_order,$column_search,$order,array('')),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
	}

    public function dataTable_agenda_detail($id_agenda='')
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $column_order   = array('','nama_asn','jabatan_asn','agenda','tanggal','jam_mulai','tempat');
            $column_search  = array('no_agenda','nama_asn','jabatan_asn','agenda','tempat');
            $order = array('' => '');
            $list = $this->m->get_datatables('v_agenda_detail',$column_order,$column_search,$order,array('id_agenda'=>$id_agenda));
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $lists) {
                $no++;
                $row   = array();
                $row[] = $no;
                $row[] = $lists->jabatan_asn;
                $row[] = '<a href="javascript:void(0)" onclick="deleteAgendaDetail('."'".$lists->id_agenda."','".$lists->id_agenda_detail."'".')" class="btn btn-sm btn-danger">Delete</a>';
             
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->m->count_all('v_agenda',array('id_agenda'=>$id_agenda)),
                            "recordsFiltered" => $this->m->count_filtered('v_agenda',$column_order,$column_search,$order,array('id_agenda'=>$id_agenda)),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
    }

	public function save_agenda()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array());

            $this->form_validation->set_rules('no_agenda', 'No Agenda', 'required');
            $this->form_validation->set_rules('agenda', 'Agenda', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
            $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
            $this->form_validation->set_rules('tempat', 'Tempat', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $data = array('no_agenda'=>$this->input->post('no_agenda'),
                			  'agenda'=>$this->input->post('agenda'),
                              'tanggal'=>$this->input->post('tanggal'),
                              'tanggal_selesai'=>$this->input->post('tanggal_selesai'),
                              'jam_mulai'=>$this->input->post('jam_mulai'),
                              'tempat'=>$this->input->post('tempat')
                			 );
                $result = $this->m->my_insert('tbl_agenda',$data);
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

    public function update_agenda()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array());

            $this->form_validation->set_rules('eno_agenda', 'No Agenda', 'required');
            $this->form_validation->set_rules('eagenda', 'Agenda', 'required');
            $this->form_validation->set_rules('etanggal', 'Tanggal', 'required');
            $this->form_validation->set_rules('etanggal_selesai', 'Tanggal Selesai', 'required');
            $this->form_validation->set_rules('ejam_mulai', 'Jam', 'required');
            $this->form_validation->set_rules('etempat', 'Tempat', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $id_agenda = $this->input->post('h_eid_agenda');
                $data = array('no_agenda'=>$this->input->post('eno_agenda'),
                              'agenda'=>$this->input->post('eagenda'),
                              'tanggal'=>$this->input->post('etanggal'),
                              'tanggal_selesai'=>$this->input->post('etanggal_selesai'),
                              'jam_mulai'=>$this->input->post('ejam_mulai'),
                              'tempat'=>$this->input->post('etempat'));
                $result = $this->m->my_update('tbl_agenda',$data,array('id_agenda'=>$id_agenda));
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

    public function delete_agenda($id_agenda)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $this->m->my_delete('tbl_agenda',array('id_agenda'=>$id_agenda));
            echo json_encode(array("status" => TRUE));
        }
    }

    public function delete_agenda_detail($id_agenda_detail)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $this->m->my_delete('tbl_agenda_detail',array('id_agenda_detail'=>$id_agenda_detail));
            echo json_encode(array("status" => TRUE));
        }
    }

    public function save_agenda_detail()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $data = array('success'=>false, 'messages'=>array());

            $this->form_validation->set_rules('id_asn', 'Nama Pejabat', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run()) {
                $data = array('id_agenda'=>$this->input->post('hid_agenda'),
                              'id_asn'=>$this->input->post('id_asn')
                             );
                $result = $this->m->my_insert('tbl_agenda_detail',$data);
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

    public function edit_agenda()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $id_agenda = $this->input->get('id_agenda');
            $result = $this->m->get_by_id('tbl_agenda',array('id_agenda'=>$id_agenda));
            //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
            echo json_encode($result);
        }
    }
}