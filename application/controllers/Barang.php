<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');

        //Load Dependencies

    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => 'Barang',
            'barang' => $this->m_barang->get_all_data(),
            'isi' => 'barang/v_barang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    // Add a new item
    public function add()
    {
        $this->form_validation->set_rules(
            'nama_barang',
            'Nama Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Nama Kategori',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'harga',
            'Harga Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'berat',
            'Berat',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add Barang',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'barang/v_add'
                );
                $this->load->view('layout/v_wrapper_backend', $data, false);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name']
                );
                $this->m_barang->add($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan');
                redirect('barang');
            }
        }
        $data = array(
            'title' => 'Add Barang',
            'kategori' => $this->m_kategori->get_all_data(),
            'isi' => 'barang/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    //Update one item
    public function edit($id_barang = null)
    {
        $this->form_validation->set_rules(
            'nama_barang',
            'Nama Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'id_kategori',
            'Nama Kategori',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'harga',
            'Harga Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'berat',
            'Berat',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );
        $this->form_validation->set_rules(
            'deskripsi',
            'Deskripsi Barang',
            'required',
            array('required' => '%s Harus Di Isi !!')
        );


        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Edit Barang',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'barang' => $this->m_barang->get_data($id_barang),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'barang/v_edit'
                );
                $this->load->view('layout/v_wrapper_backend', $data, false);
            } else {
                $barang = $this->m_barang->get_data($id_barang);
                if ($barang->gambar !== "") {
                    unlink('./assets/gambar/' . $barang->gambar);
                }
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'id_barang' => $id_barang,
                    'nama_barang' => $this->input->post('nama_barang'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name']
                );
                $this->m_barang->edit($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Di Edit');
                redirect('barang');
            }
            //jika tanpa ganti gambar
            $data = array(
                'id_barang' => $id_barang,
                'nama_barang' => $this->input->post('nama_barang'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'deskripsi' => $this->input->post('deskripsi')
            );
            $this->m_barang->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Di Edit');
            redirect('barang');
        }

        $data = array(
            'title' => 'Edit Barang',
            'kategori' => $this->m_kategori->get_all_data(),
            'barang' => $this->m_barang->get_data($id_barang),
            'isi' => 'barang/v_edit'
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    //Delete one item
    public function delete($id_barang = NULL)
    {
        //delete gambar
        $barang = $this->m_barang->get_data($id_barang);
        if ($barang->gambar != "") {
            unlink('./assets/gambar/' . $barang->gambar);
        }
        //end delete gambar
        $data = array('id_barang' => $id_barang);
        $this->m_barang->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('barang');
    }
}

/* End of file Controllername.php */
