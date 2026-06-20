<h4><?= $title ?></h4>

<div class="card mt-3" style="max-width: 500px;">
  <div class="card-body">
    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

    <form method="post" action="<?= $aksi ?>">
      <div class="mb-3">
        <label class="form-label">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="form-control" value="<?= set_value('nama_kategori', $item ? $item->nama_kategori : '') ?>">
      </div>
      <button type="submit" class="btn text-white" style="background-color:#4382DF;">Simpan</button>
      <a href="<?= base_url('kategori') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>