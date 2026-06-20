<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        if ($this->session->userdata('role') != 'admin') {
            redirect('dashboard');
        }
        $this->load->model('Kategori_model', 'kategori');
    }

    public function index()
    {
        $data['title'] = 'Manajemen Kategori';
        $data['kategori'] = $this->kategori->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Kategori Buku';
        $data['aksi'] = base_url('kategori/simpan');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Kategori Buku';
        $data['item'] = $this->kategori->getById($id);
        $data['aksi'] = base_url('kategori/ubah/' . $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/form', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
            return;
        }

        $data = ['nama_kategori' => $this->input->post('nama_kategori', TRUE)];
        $this->kategori->insert($data);
        redirect('kategori');
    }

    public function ubah($id)
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $data = ['nama_kategori' => $this->input->post('nama_kategori', TRUE)];
        $this->kategori->update($id, $data);
        redirect('kategori');
    }

    public function hapus($id)
    {
        $this->kategori->delete($id);
        redirect('kategori');
    }
}
