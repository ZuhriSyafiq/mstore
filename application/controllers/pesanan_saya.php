<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cart');
        $this->load->model('m_transaksi');
        $this->load->model('m_pesanan_masuk');
    }


    public function index()
    {
        $belum_bayar = $this->m_transaksi->belum_bayar();
        $diproses = $this->m_transaksi->diproses();
        $dikirim = $this->m_transaksi->dikirim();
        $selesai = $this->m_transaksi->selesai();

        // kumpulkan semua rincian barang untuk order yang dimiliki user
        $detail = array();
        $all_orders = array_merge($belum_bayar ?: [], $diproses ?: [], $dikirim ?: [], $selesai ?: []);
        foreach ($all_orders as $ord) {
            if (isset($ord->no_order)) {
                $rows = $this->m_transaksi->getDetailOrder($ord->no_order);
                if (!empty($rows)) {
                    foreach ($rows as $r) {
                        $detail[] = $r;
                    }
                }
            }
        }

        $data = array(
            'title' => 'Pesanan Saya',
            'belum_bayar' => $belum_bayar,
            'diproses' => $diproses,
            'dikirim' => $dikirim,
            'selesai' => $selesai,
            'detail' => $detail,
            'isi' => 'v_pesanan_saya'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function bayar($id_transaksi)
    {
        $this->form_validation->set_rules(
            'atas_nama',
            'Atas Nama',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/bukti_bayar';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = 'bukti_bayar';
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Pembayaran',
                    'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
                    'rekening' => $this->m_transaksi->rekening(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'v_bayar',
                );
                $this->load->view('layout/v_wrapper_frontend', $data, false);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/bukti_bayar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_transaksi' => $id_transaksi,
                    'atas_nama' => $this->input->post('atas_nama'),
                    'nama_bank' => $this->input->post('nama_bank'),
                    'no_rek' => $this->input->post('no_rek'),
                    'status_bayar' => '1',
                    'bukti_bayar' => $upload_data['uploads']['file_name']
                );
                $this->m_transaksi->upload_buktibayar($data);
                $this->session->set_flashdata('pesan', 'Bukti Pembayaran Berhasil Di Upload');
                redirect('pesanan_saya');
            }
        }
        $data = array(
            'title' => 'Pembayaran',
            'pesanan' => $this->m_transaksi->detail_pesanan($id_transaksi),
            'rekening' => $this->m_transaksi->rekening(),
            'isi' => 'v_bayar',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }
    public function diterima($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '3'
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', ' Pesanan Telah Diterima');
        $this->session->set_flashdata('active_tab', 'selesai');
        redirect('pesanan_saya');
    }
    public function detail($id_transaksi)
    {
        $data = array(
            'title' => 'Detail Pesanan',
            'transaksi' => $this->m_transaksi->detail_transaksi($id_transaksi),
            'detail_pesanan' => $this->m_transaksi->rincian_barang($id_transaksi),
            'isi' => 'v_detail_pesanan',
        );

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }
}
