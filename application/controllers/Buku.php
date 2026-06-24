<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('Buku_model', 'buku');
        $this->load->model('Kategori_model', 'kategori');
        $this->load->model('Peminjaman_model', 'peminjaman');
    }

    public function index()
    {
        $data['title'] = ($this->session->userdata('role') == 'admin') ? 'Manajemen Buku' : 'Daftar Buku';
        
        $keyword = $this->input->get('cari', TRUE);
        $id_kategori = $this->input->get('kategori', TRUE);

        if ($keyword) {
            $data['buku'] = $this->buku->cari($keyword);
        } elseif ($id_kategori) {
            $data['buku'] = $this->buku->filterKategori($id_kategori);
        } else {
            $data['buku'] = $this->buku->getAllWithKategori();
        }

        $data['kategori_list'] = $this->kategori->getAll();
        $data['kategori'] = $data['kategori_list'];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('buku/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Buku';
        $data['buku'] = $this->buku->getByIdWithKategori($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('buku/detail', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->session->userdata('role') != 'admin') redirect('dashboard');

        $data['title'] = 'Tambah Buku Baru';
        $data['kategori'] = $this->kategori->getAll();
        $data['aksi'] = base_url('buku/simpan');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('buku/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->session->userdata('role') != 'admin') redirect('dashboard');

        $data['title'] = 'Edit Data Buku';
        $data['kategori'] = $this->kategori->getAll();
        $data['item'] = $this->buku->getById($id);
        $data['aksi'] = base_url('buku/ubah/' . $id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('buku/form', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        if ($this->session->userdata('role') != 'admin') redirect('dashboard');

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
            return;
        }

        $data = $this->_get_form_data();
        $cover = $this->_upload_cover();
        if ($cover) {
            $data['cover'] = $cover;
        }

        $this->buku->insert($data);
        redirect('buku');
    }

    public function ubah($id)
    {
        if ($this->session->userdata('role') != 'admin') redirect('dashboard');

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $data = $this->_get_form_data();
        $cover = $this->_upload_cover();
        if ($cover) {
            $data['cover'] = $cover;
        }

        $this->buku->update($id, $data);
        redirect('buku');
    }

    public function hapus($id)
    {
        if ($this->session->userdata('role') != 'admin') redirect('dashboard');

        if ($this->peminjaman->countByBuku($id) > 0) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus buku karena terdapat riwayat peminjaman. Hapus terlebih dahulu data peminjaman terkait jika diperlukan.');
        } else {
            $this->buku->delete($id);
            $this->session->set_flashdata('pesan', 'Buku berhasil dihapus.');
        }

        redirect('buku');
    }

    private function _rules()
    {
        $this->form_validation->set_rules('judul', 'Judul Buku', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|numeric');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
    }

    private function _get_form_data()
    {
        return [
            'id_kategori'  => $this->input->post('id_kategori', TRUE),
            'judul'        => $this->input->post('judul', TRUE),
            'penulis'      => $this->input->post('penulis', TRUE),
            'penerbit'     => $this->input->post('penerbit', TRUE),
            'tahun_terbit' => $this->input->post('tahun_terbit', TRUE),
            'stok'         => $this->input->post('stok', TRUE),
        ];
    }

    private function _upload_cover()
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $config['file_name']     = 'cover_' . time();

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('cover')) {
            return $this->upload->data('file_name');
        }
        return NULL;
    }
}
