<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

public function __construct()
{
    parent::__construct();
    $this->load->model('M_cart');
    $this->load->model('m_home');
    
}

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'barang' => $this->m_home->get_all_data(),
            'isi' => 'v_home'
        );
        $this->load->view('layout/v_wrapper_frontend',$data,false);
    }
    public function kategori($id_kategori)
    {
        $kategori = $this->m_home->kategori($id_kategori);
        $data = array(
            'title' => 'Kategori Barang : ' . $kategori->nama_kategori,
            'barang' => $this->m_home->get_all_data_barang($id_kategori),
            'isi' => 'v_kategori_barang'
        );
        $this->load->view('layout/v_wrapper_frontend',$data,false);
    }
    public function detail_barang($id_barang)
    {
        $data = array(
            'title' => 'Detail Barang',
            'gambar' => $this->m_home->gambar_barang($id_barang),
            'barang' => $this->m_home->detail_barang($id_barang),
            'isi' => 'v_detail_barang'
        );
        $this->load->view('layout/v_wrapper_frontend',$data,false);
    }
    public function search()
    {
        $q = $this->input->get('q', true);
        if (!$q) {
            // redirect back to home if no query
            redirect(base_url());
        }

        $results = $this->m_home->search_barang($q);

        $data = array(
            'title' => 'Hasil Pencarian: ' . htmlspecialchars($q, ENT_QUOTES),
            'barang' => $results,
            'isi' => 'v_home'
        );
        $this->load->view('layout/v_wrapper_frontend',$data,false);
    }
    
}