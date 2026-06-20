<div class="d-flex justify-content-between align-items-center mb-3">
  <h4>Manajemen User</h4>
  <a href="<?= base_url('user/tambah') ?>" class="btn" style="background-color:#4382DF; color:#fff;">Tambah User</a>
</div>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
<?php endif; ?>

<table class="table table-bordered bg-white">
  <thead style="background-color:#AACCD6;">
    <tr>
      <th width="50">No</th>
      <th>Nama Lengkap</th>
      <th>Username</th>
      <th>No. HP</th>
      <th>Email</th>
      <th width="180">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; foreach ($users as $u) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $u->nama ?></td>
        <td><?= $u->username ?></td>
        <td><?= $u->no_hp ?></td>
        <td><?= $u->email ?></td>
        <td>
          <a href="<?= base_url('user/edit/' . $u->id_user) ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="<?= base_url('user/hapus/' . $u->id_user) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>