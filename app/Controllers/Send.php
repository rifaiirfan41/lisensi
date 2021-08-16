<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Send extends BaseController
{
    public function index()
    {
        $idgrup = "-1001475547623";
        $token = "1744703466:AAGiWB77jxgSzz6cVNVKhqPw1gwgIbrwFus";
        $this->request->getVar('perizinan');
        $this->request->getVar('noperizinan');
        $this->request->getVar('nama');
        $nama = $this->request->getVar('deskripsi');
        $aktif = $this->request->getVar('tglaktif');
        $berlaku = $this->request->getVar('tglberlaku');
        $this->request->getVar('instansi');
        $this->request->getVar('alamat');
        $this->request->getVar('catatan');
        // $sisa = $berlaku - date('Y-m-d');
        $pesan = "Notifikasi SIO E-Lisensi \n Nama perizinan :" . $nama . "\n Tanggal aktif : " . $aktif . " \n Berlaku sampai : " . $berlaku;
        // $pesan = $this->request->getVar('text');
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $idgrup;
        $url =  $url . "&text=" . urlencode($pesan);
        $ch = curl_init();
        $opt_array = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $opt_array);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    public function kedua()
    {
        $idgrup = "-1001475547623";
        $token = "1744703466:AAGiWB77jxgSzz6cVNVKhqPw1gwgIbrwFus";
        $this->request->getVar('peralatan');
        $nodok = $this->request->getVar('nodokumen');
        $nopeng = $this->request->getVar('nopengesahan');
        $this->request->getVar('nourut');
        $this->request->getVar('kapasitas');
        $this->request->getVar('lokasi2');
        $tglkeluar = $this->request->getVar('tglkeluar');
        $tglberlaku = $this->request->getVar('masaberlaku');
        $period = $this->request->getVar('panjang');
        $this->request->getVar('keterangan');
        // $sisa = $berlaku - date('Y-m-d');
        $pesan = "Notifikasi SIO E-Lisensi \n Nomor Dokumen :" . $nodok . "\n Nomor Pengesahan :" . $nopeng . "\n Tanggal keluar : " . $tglkeluar . " \n Tanggal Berlaku : " . $tglberlaku;
        // $pesan = $this->request->getVar('text');
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $idgrup;
        $url =  $url . "&text=" . urlencode($pesan);
        $ch = curl_init();
        $opt_array = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $opt_array);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
