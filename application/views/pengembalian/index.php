<h4>Pengembalian Buku</h4>
<p class="text-muted">Konfirmasi pengembalian buku dari peminjam.</p>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
<?php endif; ?>

<table class="table table-bordered bg-white mt-3">
  <thead style="background-color:#AACCD6;">
    <tr>
      <th width="50">No</th>
      <th>Nama Peminjam</th>
      <th>Judul Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Status</th>
      <th width="150">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($peminjaman)) : ?>
      <tr><td colspan="6" class="text-center">Tidak ada buku yang sedang dipinjam.</td></tr>
    <?php endif; ?>
    <?php $no = 1; foreach ($peminjaman as $p) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $p->nama ?></td>
        <td><?= $p->judul ?></td>
        <td><?= date('d-m-Y', strtotime($p->tanggal_pinjam)) ?></td>
        <td><span class="badge bg-warning text-dark"><?= $p->status ?></span></td>
        <td>
          <a href="<?= base_url('pengembalian/konfirmasi/' . $p->id_peminjaman) ?>" class="btn btn-sm btn-success w-100" onclick="return confirm('Konfirmasi pengembalian buku ini?')">
            Kembalikan
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>