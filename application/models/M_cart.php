<?php
class M_cart extends CI_Model
{
    public function get_cart_by_pelanggan($id_pelanggan)
    {
        $this->db->select('
        cart.*, 
        tb_barang.nama_barang, 
        tb_barang.harga, 
        tb_barang.gambar,
        tb_barang.berat
    ');
        $this->db->from('cart');
        $this->db->join('tb_barang', 'tb_barang.id_barang = cart.id_barang');
        $this->db->where('cart.id_pelanggan', $id_pelanggan);

        return $this->db->get()->result();
    }
}
