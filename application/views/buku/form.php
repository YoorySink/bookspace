<h4><?= $title ?></h4>

<div class="card mt-3" style="max-width: 600px;">
  <div class="card-body">
    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
    <?php if (isset($error_upload)) : ?>
      <div class="alert alert-danger"><?= $error_upload ?></div>
    <?php endif; ?>

    <form method="post" action="<?= $aksi ?>" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Kategori Buku</label>
        <select name="id_kategori" class="form-select" required>
          <option value="">-- Pilih Kategori --</option>
          <?php foreach ($kategori_list as $k) : ?>
            <option value="<?= $k->id_kategori ?>" <?= set_value('id_kategori', $item ? $item->id_kategori : '') == $k->id_kategori ? 'selected' : '' ?>>
              <?= $k->nama_kategori ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Judul Buku</label>
        <input type="text" name="judul" class="form-control" value="<?= set_value('judul', $item ? $item->judul : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input type="text" name="penulis" class="form-control" value="<?= set_value('penulis', $item ? $item->penulis : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="<?= set_value('penerbit', $item ? $item->penerbit : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control" value="<?= set_value('tahun_terbit', $item ? $item->tahun_terbit : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="<?= set_value('stok', $item ? $item->stok : '0') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Cover Buku (Format Gambar)</label>
        <input type="file" name="cover" class="form-control">
        <?php if ($item && $item->cover) : ?>
          <div class="mt-2">
            <small class="text-muted d-block">Cover Saat Ini:</small>
            <img src="<?= base_url('uploads/' . $item->cover) ?>" width="80" class="img-thumbnail mt-1">
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn text-white" style="background-color:#4382DF;">Simpan</button>
      <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>