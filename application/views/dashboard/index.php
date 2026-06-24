<h4>Dashboard Statistik</h4>
<p class="text-muted">Selamat datang kembali, <strong><?= $this->session->userdata('nama') ?></strong>.</p>

<div class="row mt-4">
  <div class="col-md-3">
    <div class="card text-white shadow-sm mb-3" style="background-color:#4382DF;">
      <div class="card-body">
        <h6 class="card-title">Total Buku</h6>
        <h2><?= $total_buku ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white shadow-sm mb-3" style="background-color:#AACCD6;">
      <div class="card-body">
        <h6 class="card-title text-dark">Total Kategori</h6>
        <h2 class="text-dark"><?= $total_kategori ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-warning shadow-sm mb-3">
      <div class="card-body">
        <h6 class="card-title text-dark">Buku Dipinjam</h6>
        <h2 class="text-dark"><?= $total_dipinjam ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-success shadow-sm mb-3">
      <div class="card-body">
        <h6 class="card-title">Stok Tersedia</h6>
        <h2><?= $total_tersedia ?></h2>
      </div>
    </div>
  </div>
</div>