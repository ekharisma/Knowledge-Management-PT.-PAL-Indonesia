<?php
require('../config/db_sql.php');
$sql = "SELECT COUNT(tb_berkas.nama) as jumlah FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_jenis.id_jenis = ? AND tb_berkas.kat =1 AND tb_pengguna.id_divisi='$id_divisi' ";
$stmt = $mysqli->prepare($sql);
$jenis = 5;
$stmt->bind_param('i', $jenis);
$stmt->execute();
$jenis = 3;
$gambar = $stmt->get_result()->fetch_assoc();
$stmt->bind_param('i', $jenis);
$stmt->execute();
$jenis = 1;
$audio = $stmt->get_result()->fetch_assoc();
$stmt->bind_param('i', $jenis);
$stmt->execute();
$jenis = 2;
$video = $stmt->get_result()->fetch_assoc();
$stmt->bind_param('i', $jenis);
$stmt->execute();
$dokumen = $stmt->get_result()->fetch_assoc();
$jenis = 4;
$stmt->bind_param('i', $jenis);
$stmt->execute();
$lain = $stmt->get_result()->fetch_assoc();
?>

<title><?=$title?></title>

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Rekap Umum
                </h2>
                <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <a href="index.php?private_detail&jenis=5" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="image" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna"><?= $gambar['jumlah'] ?></p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Image</div>
                        </div>
                    </div>
                </a>
                <a href="index.php?private_detail&jenis=3" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="speaker" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna"><?= $audio['jumlah'] ?></p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Audio</div>
                        </div>
                    </div>
                </a>
                <a href="index.php?private_detail&jenis=1" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="video" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna"><?= $video['jumlah'] ?></p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Video</div>
                        </div>
                    </div>
                </a>
                <a href="index.php?private_detail&jenis=2" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna"><?= $dokumen['jumlah'] ?></p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Document</div>
                        </div>
                    </div>
                </a>
                <a href="index.php?private_detail&jenis=4" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="file-plus" class="report-box__icon text-theme-10"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna"><?= $lain['jumlah'] ?></p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Others</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- END: General Report -->
    </div>
</div>
<script src="../dist/js/sidePrivate.js"></script>