<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Manajemen Kategori</h4>
  <a href="<?= base_url('kategori/tambah') ?>" class="btn" style="background-color:#4382DF; color:#fff;">
    Tambah Kategori
  </a>
</div>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
<?php endif; ?>

<table class="table table-bordered bg-white">
  <thead style="background-color:#AACCD6;">
    <tr>
      <th width="50">No</th>
      <th>Nama Kategori</th>
      <th width="180">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach ($kategori as $k) : ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $k->nama_kategori ?></td>
      <td>
        <a href="<?= base_url('kategori/edit/' . $k->id_kategori) ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="<?= base_url('kategori/hapus/' . $k->id_kategori) ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Hapus kategori ini?')">Hapus</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>