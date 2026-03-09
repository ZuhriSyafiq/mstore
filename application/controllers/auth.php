<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // libraries 'pelanggan_login' and 'user_login' are autoloaded in this project
        // ensure m_auth is available for direct checks if needed
        $this->load->model('m_auth');
    }

    /**
     * Login for pelanggan (frontend customers)
     */
    public function login_pelanggan()
    {
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => '%s Harus Di Isi !!'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus Di Isi !!'));

        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            // use pelanggan_login library which handles session and redirect
            $this->pelanggan_login->login($email, $password);
            return; // library will redirect on success/failure
        }

        $data = array(
            'title' => 'Login Pelanggan',
            'isi'   => 'v_login_pelanggan'
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function logout_pelanggan()
    {
        // use pelanggan_login library logout helper
        $this->pelanggan_login->logout();
    }

    /**
     * Login for backend users (admin/user)
     */
    public function login_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array('required' => '%s Harus Di Isi !!'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus Di Isi !!'));

        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            // use user_login library which handles session and redirect
            $this->user_login->login($username, $password);
            return; // library will redirect
        }

        $data = array('title' => 'Login User');
        $this->load->view('v_login_user', $data, false);
    }

    public function logout_user()
    {
        $this->user_login->logout();
    }
}
