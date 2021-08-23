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
  <link href="<?= base_url('assets/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendors/datatables.net/js/jquery.dataTables.js') ?>" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link href="<?= base_url('assets/vendors/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <style>
    #accordian {
      background: #3C4B64;
      width: 250px;
      padding: 2px;
      float: left;
      height: 100vh;
      overflow-x: hidden;
      position: relative;
      padding-right: 0px;
    }

    .main-navbar {
      position: relative;
      margin: 0;
      padding: 0;
    }

    #accordian li {
      list-style-type: none;
    }

    #accordian ul li a {
      color: rgba(255, 255, 255, 0.5);
      text-decoration: none;
      font-size: 15px;
      line-height: 45px;
      display: block;
      padding: 0px 20px;
      transition-duration: 0.6s;
      transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
      position: relative;
    }

    #accordian>ul>li.active>a {
      color: #3C4B64;
      background-color: transparent;
      transition: all 0.7s;
    }


    #accordian a:not(:only-child):after {
      content: "\f105";
      position: absolute;
      right: 20px;
      top: 10%;
      font-size: 14px;
      font-family: "Font Awesome 5 Free";
      display: inline-block;
      padding-right: 1px;
      vertical-align: middle;
      font-weight: 900;
      transition: 0.5s;
    }

    #accordian .active>a:not(:only-child):after {
      transform: rotate(90deg);
    }

    .selector-active {
      width: 100%;
      display: inline-block;
      position: absolute;
      height: 37px;
      top: 0px;
      left: 0px;
      transition-duration: 0.6s;
      transition-timing-function: cubic-bezier(0.68, -0.55, 0.265, 1.55);
      background-color: #fff;
      border-top-left-radius: 50px;
      border-bottom-left-radius: 50px;
    }

    .selector-active .top,
    .selector-active .bottom {
      position: absolute;
      width: 25px;
      height: 25px;
      background-color: #fff;
      right: 0;
    }

    .selector-active .top {
      top: -25px;
    }

    .selector-active .bottom {
      bottom: -25px;
    }

    .selector-active .top:before,
    .selector-active .bottom:before {
      content: '';
      position: absolute;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-color: #3C4B64;
    }

    .selector-active .top:before {
      left: -25px;
      top: -25px;
    }

    .selector-active .bottom:before {
      bottom: -25px;
      left: -25px;
    }
  </style>
</head>

<body>
  <link href="<?= base_url('assets/css/preloader.css') ?>" rel="stylesheet">
  <script src="<?= base_url('assets/vendors/jquery/js/jquery.min.js') ?>"></script>

  <div class="bgn">
    <div class="bg"></div>
    <div class="lod" id="lod">
      <div class="loader">
        <div class="inner_loader_1"></div>
        <div class="inner_loader_2"></div>
        <div class="inner_loader_3"></div>
        <div class="inner_loader_4"></div>
        <div class="inner_loader_5"></div>
        <div class="inner_loader_6"></div>
      </div>
    </div>
  </div>
  <?php
  //$uri = service('uri');
  ?>
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
  <!-- <div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
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
  </div> -->


  </div>
  <!-- </div>
  </div> -->
  <?php

  use YoHang88\LetterAvatar\LetterAvatar;

  $ava = new LetterAvatar(session('nama_lengkap'), 'circle', 64);
  ?>
  <div class="c-wrapper ">
    <header class="c-header c-header-light c-header-fixed">
      <button class="c-header-toggler c-class-toggler mfs-3" style="outline: none !important;" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <svg class="c-icon c-icon-lg">
          <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-menu'); ?>"></use>
        </svg>
      </button>
      <li class="c-header-nav">
        <div class="ml-2 mt-3">
          <h4> <?= $judul; ?></h4>
        </div>
      </li>
      </ul>
      <ul class="c-header-nav mfs-auto mr-3">

        <li class="c-header-nav-item dropdown">
          <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar"><img class="c-avatar-img" src="<?= $ava ?>" alt="foto avatar"></div>
            <div class="ml-2"><?= session('nama_lengkap') ?></div>
          </a>

          <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>Pengguna</strong></div><a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
                <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-user') ?>"></use>
              </svg> Profil</a><a class="dropdown-item" href="#">
              <svg class="c-icon mfe-2">
                <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked'); ?>"></use>
              </svg> Ubah Password</a>
            <div class="dropdown-divider"></div><a class="dropdown-item" href="<?= base_url('login/logout') ?>">
              <svg class="c-icon mfe-2">
                <use xlink:href="<?= base_url('assets/vendors/@coreui/icons/svg/free.svg#cil-account-logout') ?>"></use>
              </svg> Logout</a>
          </div>
        </li>
        <!-- <button class="c-header-toggler c-class-toggler mfe-md-3" type="button" data-target="#aside" data-class="c-sidebar-show">
        <svg class="c-icon c-icon-lg">
          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
        </svg>
      </button> -->
      </ul>
    </header>
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
  <script>
    // $('#a2').addClass('active');
    // var tabsVerticalInner = $('#accordian');
    // var selectorVerticalInner = $('#accordian').find('li').length;
    // var activeItemVerticalInner = tabsVerticalInner.find('.active');
    // var activeWidthVerticalHeight = activeItemVerticalInner.innerHeight();
    // var activeWidthVerticalWidth = activeItemVerticalInner.innerWidth();
    // var itemPosVerticalTop = activeItemVerticalInner.position();
    // var itemPosVerticalLeft = activeItemVerticalInner.position();
    // $(".selector-active").css({
    //   "top": itemPosVerticalTop.top + "px",
    //   "left": itemPosVerticalLeft.left + "px",
    //   "height": activeWidthVerticalHeight + "px",
    //   "width": activeWidthVerticalWidth + "px"
    // });
    // $("#accordian").on("click", "li", function() {
    //   $('#accordian ul li').removeClass("active");
    //   $(this).addClass('active');
    //   var activeWidthVerticalHeight = $(this).innerHeight();
    //   var activeWidthVerticalWidth = $(this).innerWidth();
    //   var itemPosVerticalTop = $(this).position();
    //   var itemPosVerticalLeft = $(this).position();
    //   $(".selector-active").css({
    //     "top": itemPosVerticalTop.top + "px",
    //     "left": itemPosVerticalLeft.left + "px",
    //     "height": activeWidthVerticalHeight + "px",
    //     "width": activeWidthVerticalWidth + "px"
    //   });
    // });
    // $(window).load(function() {
    // });
    $('.bgn').fadeOut('slow');
  </script>
</body>

</html>