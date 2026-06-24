<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('Buku_model', 'buku');
        $this->load->model('User_model', 'user');
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Kategori_model', 'kategori');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        if ($this->session->userdata('role') == 'admin') {
            $data['total_buku'] = $this->buku->countAll();
            $data['total_kategori'] = count($this->kategori->getAll());
            $data['total_user'] = $this->user->countAll();
            $data['total_dipinjam'] = $this->peminjaman->countByStatus('Dipinjam');
            $data['total_tersedia'] = $this->buku->totalStokTersedia();
            $data['stok_tersedia'] = $data['total_tersedia'];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
