<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        if ($this->session->userdata('id_user')) {
            redirect('dashboard');
        }

        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }

    public function login()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->user->cekLogin($username, $password);

        if ($user) {
            $role = ($user->username == 'admin') ? 'admin' : 'peminjam';

            $session_data = [
                'id_user' => $user->id_user,
                'nama'    => $user->nama,
                'role'    => $role
            ];
            $this->session->set_userdata($session_data);

            redirect('dashboard');
        } else {
            $this->session->set_flashdata('pesan', 'Username atau password salah.');
            redirect('auth');
        }
    }

    public function register()
    {
        $data['title'] = 'Register';
        $this->load->view('auth/register', $data);
    }

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Register';
            $this->load->view('auth/register', $data);
            return;
        }

        $username = $this->input->post('username', TRUE);

        if ($this->user->cekUsername($username)) {
            $this->session->set_flashdata('pesan', 'Username sudah digunakan, silakan pilih username lain.');
            redirect('auth/register');
            return;
        }

        $data = [
            'nama'     => $this->input->post('nama', TRUE),
            'alamat'   => $this->input->post('alamat', TRUE),
            'no_hp'    => $this->input->post('no_hp', TRUE),
            'email'    => $this->input->post('email', TRUE),
            'username' => $username,
            'password' => $this->input->post('password', TRUE)
        ];

        $this->user->register($data);

        $this->session->set_flashdata('pesan', 'Pendaftaran berhasil, silakan login.');
        redirect('auth');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}