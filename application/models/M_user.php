<?php 
class M_user extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('id_user','desc');
        return $this->db->get()->result();
    }
    public function add($data)
    {
        $this->db->insert('tb_user', $data);
        
    }
    public function edit($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tb_user', $data);
        
        
    }
    public function delete($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tb_user', $data);
        
        
    }
}