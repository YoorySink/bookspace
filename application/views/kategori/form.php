<h4><?= $title ?></h4>

<?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

<form method="post" action="<?= $aksi ?>" class="card card-body bg-white">
  <div class="mb-3">
    <label class="form-label">Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control"
           value="<?= $item->nama_kategori ?? set_value('nama_kategori') ?>">
  </div>
  <div>
    <button type="submit" class="btn" style="background-color:#4382DF; color:#fff;">Simpan</button>
    <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Batal</a>
  </div>
</form>