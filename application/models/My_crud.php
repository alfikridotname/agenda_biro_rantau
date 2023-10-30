<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class My_crud extends CI_Model {
    
    public function cek_login($table,$where){      
        return $this->db->get_where($table,$where);
    }
    
    protected function _get_datatables_query($table,$column_order,$column_search,$order)
    {
         
        $this->db->from($table);
 
        $i = 0;
     
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables($table,$column_order,$column_search,$order,$data,$wherein='')
    {
        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where($data);
        if($wherein)
        {
            $this->db->where_in('input_by',$wherein);
        }
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered($table,$column_order,$column_search,$order,$data=array(),$wherein='')
    {
        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        $this->db->where($data);
        if($wherein)
        {
            $this->db->where_in('input_by',$wherein);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($table,$data=array(),$wherein='')
    {
        $this->db->where($data);
        if($wherein)
        {
            $this->db->where_in('input_by',$wherein);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function get_all($table,$order,$orderby){
        $this->db->order_by($order,$orderby);
        return $this->db->get($table);
    }

    public function get_all_where($table,$data,$order,$orderby){
        $this->db->where($data);
        $this->db->order_by($order,$orderby);
        return $this->db->get($table);
    }

    public function get_total($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }    

    public function get_all_where_or($table,$data,$or,$order,$orderby){
        $this->db->where($data);
        $this->db->or_where($or);
        $this->db->order_by($order,$orderby);
        return $this->db->get($table);
    }
 
    public function get_by_id($table,$data)
    {
        $this->db->from($table);
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_id_max($table,$data)
    {
        $this->db->from($table);
        $this->db->where($data);
        $this->db->order_by('bulan','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function my_delete($table,$data)
    {
        $this->db->where($data);
        $this->db->delete($table);
    }

    public function my_get_one($table,$f_pk,$id_pk){
        $param  = array($f_pk => $id_pk);
        return $this->db->get_where($table,$param);
    }
 
    public function my_validasi($table,$data)
    {
        $query = $this->db->get_where($table, $data);
        if ($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function my_validasi_sisa($table,$data)
    {
        return $query = $this->db->get_where($table, $data);
    }

    public function my_insert($table,$data)
    {
        $this->db->insert($table,$data);
    }

    public function my_update($table,$data,$where)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    function updateData($table,$data,$key)
    {
        $this->db->set($data);
        $this->db->where($key);
        $this->db->update($table);
    }
}