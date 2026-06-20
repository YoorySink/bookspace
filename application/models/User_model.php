<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'user';

    // Mengecek username dan password saat login
    public function cekLogin($username, $password)
    {
        return $this->db
            ->get_where($this->table, [
                'username' => $username,
                'password' => $password
            ])
            ->row();
    }

    // Mengecek apakah username sudah dipakai, dipakai saat register
    public function cekUsername($username)
    {
        return $this->db
            ->get_where($this->table, ['username' => $username])
            ->row();
    }

    // Menyimpan user baru saat register
    public function register($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Mengambil seluruh data user, dipakai pada manajemen user
    public function getAll()
    {
        return $this->db
            ->order_by('id_user', 'DESC')
            ->get($this->table)
            ->result();
    }

    // Mengambil satu data user berdasarkan id
    public function getById($id)
    {
        return $this->db
            ->get_where($this->table, ['id_user' => $id])
            ->row();
    }

    // Menambah data user dari form manajemen user (oleh admin)
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Mengubah data user
    public function update($id, $data)
    {
        return $this->db
            ->where('id_user', $id)
            ->update($this->table, $data);
    }

    // Menghapus data user
    public function delete($id)
    {
        return $this->db
            ->where('id_user', $id)
            ->delete($this->table);
    }

    // Menghitung total user, dipakai pada dashboard
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }
}