<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model
{
    private $table = 'peminjaman';

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function getById($id)
    {
        return $this->db
            ->get_where($this->table, ['id_peminjaman' => $id])
            ->row();
    }

    public function updateStatus($id, $status)
    {
        $data = ['status' => $status];

        if ($status == 'Dikembalikan') {
            $data['tanggal_kembali'] = date('Y-m-d');
        }

        return $this->db
            ->where('id_peminjaman', $id)
            ->update($this->table, $data);
    }

    public function getAktif()
    {
        $this->db->select('peminjaman.*, user.nama, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('user', 'user.id_user = peminjaman.id_user');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.status', 'Dipinjam');
        $this->db->order_by('peminjaman.tanggal_pinjam', 'ASC');

        return $this->db->get()->result();
    }

    public function getAktifByUser($id_user)
    {
        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.id_user', $id_user);
        $this->db->where('peminjaman.status', 'Dipinjam');
        $this->db->order_by('peminjaman.tanggal_pinjam', 'ASC');

        return $this->db->get()->result();
    }

    public function getByUser($id_user)
    {
        $this->db->select('peminjaman.*, buku.judul');
        $this->db->from('peminjaman');
        $this->db->join('buku', 'buku.id_buku = peminjaman.id_buku');
        $this->db->where('peminjaman.id_user', $id_user);
        $this->db->order_by('peminjaman.tanggal_pinjam', 'DESC');

        return $this->db->get()->result();
    }

    // Menghitung jumlah peminjaman berdasarkan status, dipakai di Dashboard
    public function countByStatus($status)
    {
        return $this->db
            ->where('status', $status)
            ->count_all_results($this->table);
    }

    public function countByBuku($id_buku)
    {
        return $this->db
            ->where('id_buku', $id_buku)
            ->count_all_results($this->table);
    }
}