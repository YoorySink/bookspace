<h4>Peminjaman Buku Aktif</h4>
<p class="text-muted">Daftar buku yang saat ini sedang Anda pinjam.</p>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
<?php endif; ?>

<table class="table table-bordered bg-white mt-3">
  <thead style="background-color:#AACCD6;">
    <tr>
      <th width="50">No</th>
      <th>Judul Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($peminjaman)) : ?>
      <tr><td colspan="4" class="text-center">Tidak ada transaksi peminjaman aktif.</td></tr>
    <?php endif; ?>
    <?php $no = 1; foreach ($peminjaman as $p) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $p->judul ?></td>
        <td><?= date('d-m-Y', strtotime($p->tanggal_pinjam)) ?></td>
        <td>
          <span class="badge bg-warning text-dark"><?= $p->status ?></span>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>