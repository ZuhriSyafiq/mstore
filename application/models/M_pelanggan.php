<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

    public function register($data)
    {
     $this->db->insert('tb_pelanggan', $data);
        
    }

    public function get_all()
    {
        return $this->db->get('tb_pelanggan')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('tb_pelanggan', ['id_pelanggan' => $id])->row();
    }

}

/* End of file .php */
