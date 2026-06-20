<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        if ($this->session->userdata('role') != 'admin') {
            redirect('dashboard');
        }
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Data User';
        $data['user'] = $this->user->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Akun Pengguna';
        $data['aksi'] = base_url('user/simpan');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Akun Pengguna';
        $data['item'] = $this->user->getById($id);
        $data['aksi'] = base_url('user/ubah/' . $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('user/form', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $this->_rules(TRUE);

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
            return;
        }

        $data = $this->_get_form_data();
        $this->user->insert($data);
        redirect('user');
    }

    public function ubah($id)
    {
        $this->_rules(FALSE);

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $data = $this->_get_form_data();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $this->user->update($id, $data);
        redirect('user');
    }

    public function hapus($id)
    {
        $this->user->delete($id);
        redirect('user');
    }

    private function _rules($is_new = TRUE)
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        if ($is_new) {
            $this->form_validation->set_rules('password', 'Password', 'required');
        }
    }

    private function _get_form_data()
    {
        return [
            'nama'     => $this->input->post('nama', TRUE),
            'alamat'   => $this->input->post('alamat', TRUE),
            'no_hp'    => $this->input->post('no_hp', TRUE),
            'email'    => $this->input->post('email', TRUE),
            'username' => $this->input->post('username', TRUE),
            'password' => $this->input->post('password', TRUE),
        ];
    }
}
