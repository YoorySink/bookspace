<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
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

        $this->load->model('Kategori_model', 'kategori');
    }

    public function index()
    {
        $data['title']    = 'Manajemen Kategori';
        $data['kategori'] = $this->kategori->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Kategori';
            $data['aksi']  = base_url('kategori/tambah');
            $data['item']  = null;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('kategori/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = ['nama_kategori' => $this->input->post('nama_kategori', TRUE)];
            $this->kategori->insert($data);

            $this->session->set_flashdata('pesan', 'Kategori berhasil ditambahkan.');
            redirect('kategori');
        }
    }

    public function edit($id)
    {
        $item = $this->kategori->getById($id);
        if (!$item) show_404();

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kategori';
            $data['aksi']  = base_url('kategori/edit/' . $id);
            $data['item']  = $item;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('kategori/form', $data);
            $this->load->view('templates/footer');
        } else {
            $data = ['nama_kategori' => $this->input->post('nama_kategori', TRUE)];
            $this->kategori->update($id, $data);

            $this->session->set_flashdata('pesan', 'Kategori berhasil diperbarui.');
            redirect('kategori');
        }
    }

    public function hapus($id)
    {
        if (!$this->kategori->getById($id)) show_404();

        $this->kategori->delete($id);
        $this->session->set_flashdata('pesan', 'Kategori berhasil dihapus.');
        redirect('kategori');
    }
}