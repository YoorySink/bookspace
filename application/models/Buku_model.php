<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    private $table = 'buku';

    // Mengambil seluruh buku, di-JOIN dengan kategori agar nama_kategori ikut tampil
    public function getAll()
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        $this->db->order_by('buku.judul', 'ASC');

        return $this->db->get()->result();
    }

    public function getAllWithKategori()
    {
        return $this->getAll();
    }

    // Mengambil satu buku beserta nama kategorinya, dipakai untuk detail dan form edit
    public function getById($id)
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        $this->db->where('buku.id_buku', $id);

        return $this->db->get()->row();
    }

    public function getByIdWithKategori($id)
    {
        return $this->getById($id);
    }

    // Mencari buku berdasarkan judul, dipakai pada fitur pencarian peminjam
    public function cari($keyword)
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        $this->db->group_start();
        $this->db->like('buku.judul', $keyword);
        $this->db->or_like('buku.penulis', $keyword);
        $this->db->group_end();
        $this->db->order_by('buku.judul', 'ASC');

        return $this->db->get()->result();
    }

    // Memfilter buku berdasarkan kategori, dipakai pada fitur filter peminjam
    public function filterKategori($id_kategori)
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        $this->db->where('buku.id_kategori', $id_kategori);
        $this->db->order_by('buku.judul', 'ASC');

        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id_buku', $id)
            ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id_buku', $id)
            ->delete($this->table);
    }

    // Mengurangi stok saat buku dipinjam
    public function kurangiStok($id)
    {
        $this->db->set('stok', 'stok - 1', FALSE);
        $this->db->where('id_buku', $id);
        $this->db->update($this->table);
    }

    // Menambah stok saat buku dikembalikan
    public function tambahStok($id)
    {
        $this->db->set('stok', 'stok + 1', FALSE);
        $this->db->where('id_buku', $id);
        $this->db->update($this->table);
    }

    // Statistik dashboard
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }

    public function totalStokTersedia()
    {
        return $this->db->select_sum('stok')->get($this->table)->row()->stok;
    }
}