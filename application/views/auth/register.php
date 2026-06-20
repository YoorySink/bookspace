<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?> - BookSpace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#AACCD6;">

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
  <div class="card shadow-sm" style="width:420px;">
    <div class="card-body p-4">
      <h4 class="text-center mb-4" style="color:#4382DF;">Daftar Akun BookSpace</h4>

      <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>
      <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="alert alert-info"><?= $this->session->flashdata('pesan') ?></div>
      <?php endif; ?>

      <form method="post" action="<?= base_url('auth/daftar') ?>">
        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" name="alamat" class="form-control" value="<?= set_value('alamat') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">No. HP</label>
          <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn w-100" style="background-color:#4382DF; color:#fff;">Daftar</button>
      </form>

      <p class="text-center mt-3 mb-0">
        Sudah punya akun? <a href="<?= base_url('auth') ?>">Login di sini</a>
      </p>
    </div>
  </div>
</div>

</body>
</html>