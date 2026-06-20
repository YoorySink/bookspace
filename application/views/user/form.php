<h4><?= $title ?></h4>

<div class="card mt-3" style="max-width: 500px;">
  <div class="card-body">
    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

    <form method="post" action="<?= $aksi ?>">
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" value="<?= set_value('nama', $item ? $item->nama : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat', $item ? $item->alamat : '') ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp', $item ? $item->no_hp : '') ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= set_value('email', $item ? $item->email : '') ?>">
      </div>
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="<?= set_value('username', $item ? $item->username : '') ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" <?= $item ? '' : 'required' ?>>
        <?php if ($item) : ?>
          <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn text-white" style="background-color:#4382DF;">Simpan</button>
      <a href="<?= base_url('user') ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>