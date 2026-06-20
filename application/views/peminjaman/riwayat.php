<h4>Riwayat Peminjaman Buku</h4>
<p class="text-muted">Seluruh catatan transaksi peminjaman buku yang pernah Anda lakukan.</p>

<table class="table table-bordered bg-white mt-3">
  <thead style="background-color:#AACCD6;">
    <tr>
      <th width="50">No</th>
      <th>Judul Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($riwayat)) : ?>
      <tr><td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td></tr>
    <?php endif; ?>
    <?php $no = 1; foreach ($riwayat as $r) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $r->judul ?></td>
        <td><?= date('d-m-Y', strtotime($r->tanggal_pinjam)) ?></td>
        <td><?= $r->tanggal_kembali ? date('d-m-Y', strtotime($r->tanggal_kembali)) : '-' ?></td>
        <td>
          <span class="badge bg-success"><?= $r->status ?></span>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>