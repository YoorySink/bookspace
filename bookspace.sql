-- Membuat database
CREATE DATABASE bookspace;
USE bookspace;

-- Tabel user, menampung data admin dan peminjam
CREATE TABLE user (
  id_user    INT AUTO_INCREMENT PRIMARY KEY,
  nama       VARCHAR(100) NOT NULL,
  alamat     VARCHAR(255) NULL,
  no_hp      VARCHAR(20)  NULL,
  email      VARCHAR(100) NULL,
  username   VARCHAR(50)  NOT NULL,
  password   VARCHAR(50)  NOT NULL
);

-- Tabel kategori, menampung jenis kategori buku
CREATE TABLE kategori (
  id_kategori   INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(100) NOT NULL
);

-- Tabel buku, terhubung ke kategori melalui id_kategori
CREATE TABLE buku (
  id_buku       INT AUTO_INCREMENT PRIMARY KEY,
  id_kategori   INT NOT NULL,
  judul         VARCHAR(150) NOT NULL,
  penulis       VARCHAR(100) NOT NULL,
  penerbit      VARCHAR(100) NOT NULL,
  tahun_terbit  YEAR NOT NULL,
  stok          INT NOT NULL DEFAULT 0,
  cover         VARCHAR(255) NULL,
  CONSTRAINT fk_buku_kategori FOREIGN KEY (id_kategori)
    REFERENCES kategori(id_kategori)
);

-- Tabel peminjaman, menghubungkan user dan buku
CREATE TABLE peminjaman (
  id_peminjaman   INT AUTO_INCREMENT PRIMARY KEY,
  id_user         INT NOT NULL,
  id_buku         INT NOT NULL,
  tanggal_pinjam  DATE NOT NULL,
  tanggal_kembali DATE NULL,
  status          ENUM('Menunggu','Dipinjam','Dikembalikan') NOT NULL DEFAULT 'Menunggu',
  CONSTRAINT fk_peminjaman_user FOREIGN KEY (id_user)
    REFERENCES user(id_user),
  CONSTRAINT fk_peminjaman_buku FOREIGN KEY (id_buku)
    REFERENCES buku(id_buku)
);

-- Data dummy: akun admin
INSERT INTO user (nama, alamat, no_hp, email, username, password) VALUES
('Administrator', 'Kantor Perpustakaan', '081200000000', 'admin@bookspace.test', 'admin', '123');

-- Data dummy: akun peminjam
INSERT INTO user (nama, alamat, no_hp, email, username, password) VALUES
('Budi Santoso', 'Jl. Melati No. 1', '081234567890', 'budi@mail.com', 'budi', '123'),
('Sari Wulandari', 'Jl. Kenanga No. 5', '081298765432', 'sari@mail.com', 'sari', '123');

-- Data dummy: kategori buku
INSERT INTO kategori (nama_kategori) VALUES
('Pemrograman'),
('Novel'),
('Sejarah'),
('Sains');

-- Data dummy: buku
INSERT INTO buku (id_kategori, judul, penulis, penerbit, tahun_terbit, stok, cover) VALUES
(1, 'Belajar CodeIgniter 3', 'Andi Wijaya', 'Penerbit Informatika', 2021, 5, NULL),
(1, 'Dasar Pemrograman PHP', 'Budi Hartono', 'Elex Media', 2020, 3, NULL),
(2, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 4, NULL),
(3, 'Sejarah Nusantara', 'Slamet Riyadi', 'Gramedia', 2018, 2, NULL),
(4, 'Pengantar Fisika Dasar', 'Maria Susanti', 'Erlangga', 2019, 6, NULL);