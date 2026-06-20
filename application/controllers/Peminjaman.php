<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Buku_model', 'buku');
    }

    public function index()
    {
        $data['title'] = 'Ajukan Peminjaman Buku';
        $data['buku'] = $this->buku->getAllWithKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    public function ajukan($id_buku)
    {
        $buku = $this->buku->getById($id_buku);

        if ($buku && $buku->stok > 0) {
            $data = [
                'id_user'        => $this->session->userdata('id_user'),
                'id_buku'        => $id_buku,
                'tanggal_pinjam' => date('Y-m-d'),
                'status'         => 'Dipinjam'
            ];

            $this->peminjaman->insert($data);
            $this->buku->kurangiStok($id_buku);

            $this->session->set_flashdata('pesan', 'Peminjaman buku berhasil diajukan!');
        } else {
            $this->session->set_flashdata('error', 'Maaf, stok buku kosong.');
        }

        redirect('peminjaman/riwayat');
    }

    public function riwayat()
    {
        $data['title'] = 'Riwayat Peminjaman Saya';
        $id_user = $this->session->userdata('id_user');
        $data['riwayat'] = $this->peminjaman->getByUser($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('peminjaman/riwayat', $data);
        $this->load->view('templates/footer');
    }
}