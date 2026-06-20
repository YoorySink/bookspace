<div class="sidebar col-2 p-0">
    <?php if ($this->session->userdata('role') == 'admin') : ?>
      <a href="<?= base_url('dashboard') ?>">Dashboard</a>
      <a href="<?= base_url('buku') ?>">Manajemen Buku</a>
      <a href="<?= base_url('kategori') ?>">Manajemen Kategori</a>
      <a href="<?= base_url('user') ?>">Manajemen User</a>
      <a href="<?= base_url('pengembalian') ?>">Pengembalian Buku</a>
    <?php else : ?>
      <a href="<?= base_url('buku') ?>">Daftar Buku</a>
      <a href="<?= base_url('peminjaman') ?>">Peminjaman Buku</a>
      <a href="<?= base_url('peminjaman/riwayat') ?>">Riwayat Peminjaman</a>
    <?php endif; ?>
  </div>
  
  <div class="col-10 p-4">