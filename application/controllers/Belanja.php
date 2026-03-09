<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cart');
        $this->load->model('m_transaksi');
    }

    // ==============================
    // HALAMAN CART
    // ==============================
    public function index()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if (!$id_pelanggan) {
            redirect('pelanggan/login');
        }

        $cart = $this->db->get_where('cart', [
            'id_pelanggan' => $id_pelanggan
        ])->result();

        if (empty($cart)) {
            redirect('home');
        }

        $this->db->select_sum('subtotal');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $total = $this->db->get('cart')->row()->subtotal;

        $data = array(
            'title' => 'Keranjang Belanja',
            'cart'  => $cart,
            'total' => $total,
            'isi'   => 'v_belanja'
        );

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function keranjang()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if (!$id_pelanggan) {
            redirect('login');
        }

        $data['cart'] = $this->M_cart->get_cart_by_pelanggan($id_pelanggan);

        $this->load->view('keranjang', $data);
    }


    // ==============================
    // TAMBAH KE CART
    // ==============================
    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $id_pelanggan  = $this->session->userdata('id_pelanggan');

        if (!$id_pelanggan) {
            redirect('pelanggan/login');
        }

        $id_barang = $this->input->post('id');
        $qty       = $this->input->post('qty');
        $harga     = $this->input->post('price');

        $cek = $this->db->get_where('cart', [
            'id_pelanggan' => $id_pelanggan,
            'id_barang'    => $id_barang
        ])->row();

        if ($cek) {

            $qty_baru = $cek->qty + $qty;
            $subtotal = $qty_baru * $harga;

            $this->db->update('cart', [
                'qty'      => $qty_baru,
                'subtotal' => $subtotal
            ], ['id' => $cek->id]);
        } else {

            $data = [
                'id_pelanggan' => $id_pelanggan,
                'id_barang'    => $id_barang,
                'qty'          => $qty,
                'harga'        => $harga,
                'subtotal'     => $qty * $harga
            ];

            $this->db->insert('cart', $data);
        }

        $this->session->set_flashdata('success', 'Barang berhasil ditambahkan ke keranjang');
        redirect($redirect_page, 'refresh');
    }

    // ==============================
    // UPDATE QTY AJAX
    // ==============================
    public function update_qty_ajax()
    {
        $id  = $this->input->post('id');
        $qty = $this->input->post('qty');

        $cart = $this->db->get_where('cart', ['id' => $id])->row();

        $subtotal = $qty * $cart->harga;

        $this->db->where('id', $id);
        $this->db->update('cart', [
            'qty'      => $qty,
            'subtotal' => $subtotal
        ]);

        $id_pelanggan = $this->session->userdata('id_pelanggan');

        $this->db->select_sum('subtotal');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $grand_total = $this->db->get('cart')->row()->subtotal;

        echo json_encode([
            'grand_total' => $grand_total
        ]);
    }

    // ==============================
    // HAPUS SATU ITEM
    // ==============================
    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('cart');

        redirect('belanja');
    }

    // ==============================
    // HAPUS SEMUA CART
    // ==============================
    public function clear()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('cart');

        redirect('belanja');
    }

    // ==============================
    // CHECKOUT
    // ==============================
    public function checkout()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if (!$id_pelanggan) {
            redirect('pelanggan/login');
        }

        $cart_items = $this->M_cart->get_cart_by_pelanggan($id_pelanggan);

        if (empty($cart_items)) {
            redirect('belanja');
        }

        $this->db->select_sum('subtotal');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $grand_total = $this->db->get('cart')->row()->subtotal;

        $data = [
            'title' => 'Checkout',
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
            'isi' => 'v_checkout'
        ];

        $this->load->view('layout/v_wrapper_frontend', $data);
    }

    public function proses_checkout()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if (!$id_pelanggan) {
            redirect('pelanggan/login');
        }

        $cart_items = $this->M_cart->get_cart_by_pelanggan($id_pelanggan);

        if (empty($cart_items)) {
            redirect('belanja');
        }

        // =====================
        // Generate No Order
        // =====================
        $no_order = date('YmdHis');

        // =====================
        // Hitung Grand Total dari DB (lebih aman)
        // =====================
        $this->db->select_sum('subtotal');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $grand_total = $this->db->get('cart')->row()->subtotal;

        $ongkir = $this->input->post('ongkir');
        $total_bayar = $grand_total + $ongkir;

        // =====================
        // Simpan Transaksi
        // =====================
        $data_transaksi = [
            'id_pelanggan' => $id_pelanggan,
            'no_order' => $no_order,
            'tgl_order' => date('Y-m-d'),
            'nama_penerima' => $this->input->post('nama_penerima'),
            'hp_penerima' => $this->input->post('hp_penerima'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('kode_pos'),
            'ekspedisi' => $this->input->post('ekspedisi'),
            'paket' => $this->input->post('paket'),
            'estimasi' => $this->input->post('estimasi'),
            'ongkir' => $ongkir,
            'berat' => $this->input->post('berat'),
            'grand_total' => $grand_total,
            'total_bayar' => $total_bayar,
            'status_bayar' => 0,
            'status_order' => 0
        ];

        $this->db->insert('tb_transaksi', $data_transaksi);

        // =====================
        // Simpan Detail Transaksi
        // =====================
        foreach ($cart_items as $item) {
            $data_rinci = [
                'no_order'  => $no_order,
                'id_barang' => $item->id_barang,
                'qty'       => $item->qty
            ];

            $this->db->insert('tb_rinci_transaksi', $data_rinci);
        }

        // =====================
        // Hapus Cart
        // =====================
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('cart');

        redirect('pesanan_saya');
    }
}
