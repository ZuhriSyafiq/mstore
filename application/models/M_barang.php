<?php 
class M_barang extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->order_by('tb_barang.id_barang','desc');
        return $this->db->get()->result();
    }
    public function get_data($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();
    }
    public function add($data)
    {
        $this->db->insert('tb_barang', $data);
        
    }
    public function edit($data)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->update('tb_barang', $data);        
    }
    public function delete($data)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->delete('tb_barang', $data);
        
        
    }
}
