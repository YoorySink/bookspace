<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        if ($this->session->userdata('role') != 'admin') {
            redirect('dashboard');
        }
        $this->load->model('Peminjaman_model', 'peminjaman');
        $this->load->model('Buku_model', 'buku');
    }

    public function index()
    {
        $data['title'] = 'Pengembalian Buku';
        $data['peminjaman'] = $this->peminjaman->getAktif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pengembalian/index', $data);
        $this->load->view('templates/footer');
    }

    public function konfirmasi($id_peminjaman)
    {
        $transaksi = $this->peminjaman->getById($id_peminjaman);

        if ($transaksi && $transaksi->status == 'Dipinjam') {
            $this->peminjaman->updateStatus($id_peminjaman, 'Dikembalikan');
            $this->buku->tambahStok($transaksi->id_buku);

            $this->session->set_flashdata('pesan', 'Konfirmasi pengembalian buku berhasil dilakukan.');
        }

        redirect('pengembalian');
    }
}