<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> - BookSpace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --bs-primary: #4382DF;
      --bs-secondary: #AACCD6;
    }
    body {
      background-color: #f4f7fa;
    }
    .navbar-bookspace {
      background-color: #4382DF;
    }
    .sidebar {
      background-color: #AACCD6;
      min-height: calc(100vh - 56px);
    }
    .sidebar a {
      color: #1f2d3d;
      display: block;
      padding: 10px 16px;
      text-decoration: none;
    }
    .sidebar a:hover, .sidebar a.active {
      background-color: #4382DF;
      color: #ffffff;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark navbar-bookspace">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">BookSpace</span>
    <span class="text-white">
      <?= $this->session->userdata('nama') ?>
      (<?= $this->session->userdata('role') ?>)
      <a href="<?= base_url('auth/logout') ?>" class="btn btn-sm btn-light ms-2">Logout</a>
    </span>
  </div>
</nav>

<div class="d-flex">