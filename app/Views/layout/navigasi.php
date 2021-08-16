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