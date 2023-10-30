<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_crud','m');
	}
	
	public function index()
	{
		$data['title'] = "Agenda";
		$data['count']  = $this->m->get_all_where('v_agenda',array('tanggal'=>date('Y-m-d')),'jam_mulai','ASC')->num_rows();
		$this->load->view('welcome_message',$data);
	}

    public function akses_agenda()
    {
        $result  = $this->m->get_all_where('v_agenda',array('tanggal'=>date('Y-m-d')),'jam_mulai','ASC')->result();
        $no=0;
        foreach ($result as $key) {
        	$no++;
        	$pecah = explode(":", $key->jam_mulai); 
            echo "<tr class='records'>
                  	<td>{$no}</td>
                  	<td>{$key->agenda}</td>
                  	<td>{$key->tempat}</td>
                  	<td>$pecah[0]:$pecah[1]</td>
                  	<td>";
            $hasil  = $this->m->get_all_where('v_agenda_detail',array('id_agenda'=>$key->id_agenda),'','')->result();
            foreach ($hasil as $key_detail) {
            		$strip = count($hasil) > 1 ? '- ' : '';
            		echo "{$strip}".$key_detail->nama_asn.' ['.$key_detail->jabatan_asn."]<br>";	
            }
            echo "</td></tr>";
        }
    }
}
