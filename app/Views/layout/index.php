<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">

  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <title><?= $judul ?></title>
  <!-- Main styles for this application-->
  <link href="<?= base_url('assets/img/logo.png') ?>" rel="icon">
  <link href="<?= base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

</head>

<body>
  <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none" style="font-size: 22px; background: white; color:black;">
      <img src="<?= base_url('assets/img/logo.png') ?>" width="20%" alt=""> &nbsp; E-LISENSI S2P
    </div>
    <ul class="c-sidebar-nav c-legacy-theme">
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('dashboard'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') ?>"></use>
          </svg> Dashboard</a></li>
      <?php if (session('role') == "ADMIN") { ?>
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('form'); ?>">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-folder-open') ?>"></use>
            </svg> Form</a></li>
      <?php } ?>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('listdataperizinan'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-clipboard') ?>"></use>
          </svg> List Data Perizinan</a></li>

      </li>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('listdataperalatan'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-3d') ?>"></use>
          </svg> List Data Peralatan</a></li>

      </li>
      <?php if (session('role') == "ADMIN") { ?>

        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-bell') ?>"></use>
            </svg> Master Data</a>
          <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('master') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-3d') ?>"></use>
                </svg> Jenis Peralatan
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('master/lokasi') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-location-pin') ?>"></use>
                </svg> Lokasi
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('master/izin') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-description') ?>"></use>
                </svg>Kriteria Perizinan
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('master/kategori') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-grain') ?>"></use>
                </svg>Kategori
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('master/jenisperaturan') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-color-border') ?>"></use>
                </svg>Jenis Peraturan
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>
      <?php if (session('role') == "ADMIN") { ?>

        <li class="c-sidebar-nav-dropdown"><a class="c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
              <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-history') ?>"></use>
            </svg> History</a>
          <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('history') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-list-rich') ?>"></use>
                </svg> Perizinan
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('history/alat') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-3d') ?>"></use>
                </svg> Peralatan
              </a>
            </li>
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="<?= base_url('history/peraturan') ?>">
                <svg class="c-sidebar-nav-icon">
                  <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-cog') ?>"></use>
                </svg>Peraturan
              </a>
            </li>
          </ul>
        </li>
      <?php } ?>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('peraturan'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-clipboard') ?>"></use>
          </svg> Peraturan</a></li>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('reporting'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-clipboard') ?>"></use>
          </svg> Reporting</a></li>
      <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="<?= base_url('notifikasi'); ?>">
          <svg class="c-sidebar-nav-icon">
            <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-alarm') ?>"></use>
          </svg> Notifikasi</a></li>
      <hr>
  </div>
  </div>
  </div>
  <?php
  echo $this->include('layout/navigasi'); ?>
  <div class="c-body" style="background: #f5f5f5;">
    <main class="c-main">
      <div class="container-fluid">
        <div class="fade-in">
          <?= $this->renderSection('konten'); ?>
        </div>
      </div>
    </main>
  </div>

  <footer class="c-footer" style="background: white;">
    <div class="mfs-auto"><a href="https://coreui.io">S2P</a> © 2020 E-lisensi.</div>
    <!-- <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div> -->
  </footer>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="<?= base_url('assets/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js'); ?>"></script>
  <!--[if IE]><!-->
  <script src="<?= base_url('assets/vendors/@coreui/icons/js/svgxuse.min.js') ?>"></script>
  <!--<![endif]-->
  <!-- Plugins and scripts required by this view-->
  <script src="<?= base_url('assets/vendors/@coreui/utils/js/coreui-utils.js') ?>"></script>
  <script src="<?= base_url('assets/js/popovers.js'); ?>"></script>

  <script src="<?= base_url('assets/vendors/datatables.net/js/jquery.dataTables.js'); ?>"></script>
  <script src="<?= base_url('assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datatables.js'); ?>"></script>

</body>

</html>