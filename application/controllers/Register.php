<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Register extends CI_Controller
 {
    public function __construct()
 {
        parent::__construct();
        // $this->load->helper( 'my_helper' );
        // $this->load->library( 'form_validation' );

        $this->load->model( 'm_model' );
    }

    public function index()
 {
        $this->load->view( 'auth/register' );
    }

    public function aksi_register()
 {
        $nama_pengguna = $this->input->post( 'nama_pengguna' );
        $email = $this->input->post( 'email' );
        $password = $this->input->post( 'password' );
        $role = $this->input->post( 'role' );

        // $uppercase = preg_match( '@[A-Z]@', $password );
        // $lowercase = preg_match( '@[a-z]@', $password );
        $number    = preg_match( '@[0-9]@', $password );

        if (!$number || strlen($password) < 8) {
            $this->session->set_flashdata( 'eror', 'gagal register' );
            redirect( 'register' );
        } else {
            $kode_pass = md5( $password );
            $data = array (
                'nama_pengguna' => $nama_pengguna,
                'email'         => $email,
                'password'      => $kode_pass,
                'role'          => $role,
            );
            $this->m_model->register( $data );
            redirect( 'auth/login' );
        }
        ;
    }
}

?>