<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?> - BookSpace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#AACCD6;">

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
  <div class="card shadow-sm" style="width:380px;">
    <div class="card-body p-4">
      <h4 class="text-center mb-4" style="color:#4382DF;">BookSpace</h4>

      <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('pesan') ?></div>
      <?php endif; ?>

      <form method="post" action="<?= base_url('auth/login') ?>">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn w-100" style="background-color:#4382DF; color:#fff;">Login</button>
      </form>

      <p class="text-center mt-3 mb-0">
        Belum punya akun? <a href="<?= base_url('auth/register') ?>">Daftar di sini</a>
      </p>
    </div>
  </div>
</div>

</body>
</html>