<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    private $table = 'kategori';

    public function getAll()
    {
        return $this->db
            ->order_by('nama_kategori', 'ASC')
            ->get($this->table)
            ->result();
    }

    public function getById($id)
    {
        return $this->db
            ->get_where($this->table, ['id_kategori' => $id])
            ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id_kategori', $id)
            ->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id_kategori', $id)
            ->delete($this->table);
    }
}