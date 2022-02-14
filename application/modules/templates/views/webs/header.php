<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> <?php if (isset($title['judul'])) {
            echo $title['judul'];
          } else {
            echo $title;
          }
          ?></title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets') ?>/images/mapen_icon.png">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/website') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/website') ?>/vendor/fontawesome/css/all.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/website') ?>/css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/website/') ?>chosen/dist/css/component-chosen.min.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="<?= base_url('website') ?>" class="logo d-flex align-items-center">
        <img src="<?= base_url('assets/website') ?>/img/logo.png" alt="">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == "index") {
                                            echo "active";
                                          } ?>" href="<?= base_url('website/index#home') ?>">Home</a></li>
          <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == "about") {
                                            echo "active";
                                          } ?>" href="<?= base_url('website/index#about') ?>">About</a></li>
          <li><a class="nav-link scrollto <?php if ($this->uri->segment(2) == "contact") {
                                            echo "active";
                                          } ?>" href="<?= base_url('website/index#contact') ?>">Contact</a></li>
          <?php if (!$this->session->userdata('email')) {
          ?>
            <li><a class="getstarted scrollto shadow" href="<?= base_url('login') ?>">
                <i class="fas fa-user-alt me-2"></i>
                Login
              </a></li>
          <?php
          } else { ?>
            <li><a href="<?= base_url('profil') ?>"><img src="<?= base_url('assets/images/users/' . $user['image']); ?>" class="rounded-circle" width="30px"></a></li>

          <?php } ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->