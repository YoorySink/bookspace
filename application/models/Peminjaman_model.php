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

    // Menghitung jumlah peminjaman berdasarkan status, dipakai di Dashboard
    public function countByStatus($status)
    {
        return $this->db
            ->where('status', $status)
            ->count_all_results($this->table);
    }
}