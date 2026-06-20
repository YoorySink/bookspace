<div class="d-flex justify-content-between align-items-center mb-3">
  <h4><?= $this->session->userdata('role') == 'admin' ? 'Manajemen Buku' : 'Daftar Buku' ?></h4>
  <?php if ($this->session->userdata('role') == 'admin') : ?>
    <a href="<?= base_url('buku/tambah') ?>" class="btn" style="background-color:#4382DF; color:#fff;">Tambah Buku</a>
  <?php endif; ?>
</div>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
<?php endif; ?>

<form method="get" action="<?= base_url('buku') ?>" class="row g-2 mb-3">
  <div class="col-md-4">
    <input type="text" name="cari" class="form-control" placeholder="Cari judul atau penulis..." value="<?= $this->input->get('cari') ?>">
  </div>
  <div class="col-md-3">
    <select name="kategori" class="form-select">
      <option value="">-- Semua Kategori --</option>
      <?php foreach ($kategori_list as $k) : ?>
        <option value="<?= $k->id_kategori ?>" <?= $this->input->get('kategori') == $k->id_kategori ? 'selected' : '' ?>>
          <?= $k->nama_kategori ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-2">
    <button type="submit" class="btn btn-secondary w-100">Filter</button>
  </div>
</form>

<div class="row">
  <?php if (empty($buku)) : ?>
    <div class="col-12"><div class="alert alert-info text-center">Data buku tidak ditemukan.</div></div>
  <?php endif; ?>
  
  <?php foreach ($buku as $b) : ?>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm h-100">
        <div class="row g-0 h-100">
          <div class="col-4 bg-light d-flex align-items-center justify-content-center" style="min-height:150px;">
            <?php if ($b->cover) : ?>
              <img src="<?= base_url('uploads/' . $b->cover) ?>" class="img-fluid rounded-start h-100 w-100" style="object-fit:cover;">
            <?php else : ?>
              <span class="text-muted small">No Cover</span>
            <?php 	endif; ?>
          </div>
          <div class="col-8 d-flex flex-column">
            <div class="card-body p-3 flex-grow-1">
              <span class="badge mb-1" style="background-color:#AACCD6; color:#1f2d3d;"><?= $b->nama_kategori ?></span>
              <h6 class="card-title fw-bold mb-1"><?= $b->judul ?></h6>
              <p class="card-text mb-1 small text-muted">Penulis: <?= $b->penulis ?></p>
              <p class="card-text mb-1 small text-muted">Stok: <strong><?= $b->stok ?></strong></p>
            </div>
            <div class="card-footer bg-white border-0 p-3 pt-0 mt-auto">
              <?php if ($this->session->userdata('role') == 'admin') : ?>
                <a href="<?= base_url('buku/edit/' . $b->id_buku) ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= base_url('buku/hapus/' . $b->id_buku) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus buku ini?')">Hapus</a>
              <?php else : ?>
                <?php if ($b->stok > 0) : ?>
                  <a href="<?= base_url('peminjaman/ajukan/' . $b->id_buku) ?>" class="btn btn-sm text-white w-100" style="background-color:#4382DF;">Pinjam Buku</a>
                <?php else : ?>
                  <button class="btn btn-sm btn-secondary w-100" disabled>Stok Habis</button>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>