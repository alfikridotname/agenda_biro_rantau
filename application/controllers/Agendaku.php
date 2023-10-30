<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agendaku extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
	}
	
	public function index()
	{
		$data['title']        = "Agendaku";
		$this->load->view('pages/agendaku/agendaku',$data);
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
                $hasil = $this->db->query("SELECT jabatan_asn FROM v_agenda_detail WHERE id_agenda = {$lists->id_agenda}")->result();
                if(empty($hasil))
                {
                    $ccc = "Not Set";
                }else{
                    $isi = [];
                    foreach ($hasil as $key) {
                        if(count($hasil) > 1)
                        {
                            $strip = "- ";
                        }else{
                            $strip = "";
                        }
                        $isi[] = $strip.$key->jabatan_asn;
                        $aaa   = join(",",$isi); // 'a,b'
                        $bbb   = explode(",", $aaa);
                        $ccc   = implode("<br>",$bbb);
                    }
                }
                // print_r($hasil);
                $row[] = $ccc;
                $row[] = $lists->agenda;
                $pecah = explode(":", $lists->jam_mulai);
                $row[] = longdate_indo($lists->tanggal);
                $row[] = $pecah[0].':'.$pecah[1];
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
}