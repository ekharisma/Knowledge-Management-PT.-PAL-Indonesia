<?php

//require("../config/db_sql.php");
require('../helper/QueryConverter.php');
$sql = "SELECT COUNT(*) as jumlah FROM tb_berkas WHERE tanggal LIKE ?";
$stmt = $mysqli->prepare($sql);
$dataPerBulan = array();
$bulan = [
    '2020-01%', '2020-02%', '2020-03%', '2020-04%', '2020-5%', '2020-06%', '2020-07%', '2020-08%',
    '2020-09%', '2020-10%', '2020-11%', '2020-12%'
];
for ($i = 0; $i <= 12; $i++) {
    $tempBulan = $bulan[$i];
    $stmt->bind_param('s', $tempBulan);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    $dataPerBulan[$i] = $data;
}
$sql = "SELECT * FROM tb_berkas";
$result = $mysqli->query($sql);
$converter = new QueryConverter;
$berkas = $converter->toJson($result);
$sql = "SELECT * FROM tb_pengguna";
$result = $mysqli->query($sql);
$pengguna = $converter->toJson($result);
//dokumen per divisi
$sql = "SELECT tb_divisi.id_divisi, tb_divisi.divisi, tb_pengguna.id_pengguna, tb_pengguna.id_divisi, tb_berkas.id_pengguna,
COUNT(divisi) AS jumlahdokumen
FROM tb_divisi, tb_pengguna, tb_berkas
WHERE tb_divisi.id_divisi = tb_pengguna.id_divisi
AND tb_pengguna.id_pengguna = tb_berkas.id_pengguna
GROUP BY divisi";
$result = $mysqli->query($sql);
$dokumenPerdivisi = $converter->toJson($result);
//last upload
$sql = "SELECT tb_berkas.nama, tb_berkas.tanggal, tb_berkas.jam, tb_berkas.id_jenis, tb_berkas.id_pengguna, tb_divisi.id_divisi, tb_pengguna.id_divisi, tb_pengguna.id_pengguna 
FROM tb_berkas 
INNER JOIN tb_jenis, tb_pengguna, tb_divisi 
WHERE (tb_berkas.id_jenis = tb_jenis.id_jenis) 
AND (tb_berkas.id_pengguna = tb_pengguna.id_pengguna) 
AND (tb_pengguna.id_divisi = tb_divisi.id_divisi)
ORDER BY CONCAT(tb_berkas.tanggal, tb_berkas.jam) DESC LIMIT 5";
$lastUpload = $mysqli->query($sql);
//most viewed
$sql = "SELECT tb_berkas.nama, tb_berkas.view, tb_berkas.id_jenis, tb_berkas.id_pengguna, tb_divisi.id_divisi, tb_pengguna.id_pengguna, tb_pengguna.id_divisi FROM tb_berkas INNER JOIN tb_jenis, tb_pengguna, tb_divisi WHERE view > 5 AND (tb_berkas.id_jenis = tb_jenis.id_jenis) AND (tb_berkas.id_pengguna = tb_pengguna.id_pengguna) AND (tb_pengguna.id_divisi = tb_divisi.id_divisi) ORDER BY view DESC LIMIT 5";
$mostViewed = $mysqli->query($sql);
//daftar dokumen
$limit = 10;
$sql = "SELECT count(*) as jumlah, tanggal,deskripsi, tb_divisi.divisi, tb_direktorat.direktorat FROM tb_berkas JOIN tb_jenis ON tb_berkas.id_jenis = tb_jenis.id_jenis JOIN tb_pengguna ON tb_berkas.id_pengguna = tb_pengguna.id_pengguna JOIN tb_divisi ON tb_pengguna.id_divisi = tb_divisi.id_divisi JOIN tb_direktorat ON tb_pengguna.id_direktorat = tb_direktorat.id_direktorat GROUP BY tb_divisi.divisi ORDER BY jumlah DESC";
$documentList = $mysqli->query($sql);
$row = $documentList->fetch_row();
$totalDokumen = $row[0];
$totalHalaman = ceil($totalDokumen / $limit);
?>

<title><?= $title ?></title>

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
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="user" class="report-box__icon text-theme-10"></i>
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_pengguna">0</p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Users</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="credit-card" class="report-box__icon text-theme-11"></i>
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">
                                <p id="jumlah_dokumen">0</p>
                            </div>
                            <div class="text-base text-gray-600 mt-1">Documents</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        <!-- BEGIN: Sales Report -->
        <div class="col-span-12 lg:col-span-12 mt-8">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Documents per Months
                </h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div> <label>Year</label>
                    <div class="mt-2" style="width:max-content"> <select id="year" data-search="true" class="tail-select w-full">
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select> </div>
                </div>
                <div class="report-chart">
                    <canvas id="grafik_jumlah_dokumen" height="100" class="mt-6"></canvas>
                </div>
            </div>
        </div>
        <!-- END: Sales Report -->
        <!-- BEGIN: Official Store -->
        <div class="col-span-12 lg:col-span-12 mt-8">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                     Documents per Divisions
                </h2>
            </div>
            <div class="intro-y box p-5 mt-12 sm:mt-5">
                <div class="report-chart">
                    <canvas id="grafik_jumlah_dokumen_per_divisi" height="100" class="mt-6"></canvas>
                </div>
            </div>
        </div>
        <!-- END: Official Store -->
        <!-- BEGIN: Weekly Best Sellers -->
        <div class="col-span-12 xl:col-span-6 mt-6">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    <p>Last Upload</p>
                </h2>
            </div>
            <div id="lastUpload" class="mt-5">
                <?php foreach ($lastUpload as $row) : ?>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Midone Tailwind HTML Admin Template" src="../dist/images/profile-15.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium"><?= $row['nama'] ?></div>
                                <div class="text-gray-600 text-xs"><?= $row['tanggal'] ?></div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium"><?= $row['jam'] ?></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- END: Weekly Best Sellers -->
        <!-- BEGIN: Weekly Best Sellers -->
        <div class="col-span-12 xl:col-span-6 mt-6">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    <p>Most Viewed</p>
                </h2>
            </div>
            <div id="mostViewed" class="mt-5">
                <?php foreach ($mostViewed as $row) : ?>
                    <div class="intro-y">
                        <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                <img alt="Midone Tailwind HTML Admin Template" src="../dist/images/profile-15.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium"><?= $row['nama'] ?></div>
                                <div class="text-gray-600 text-xs"><?= $row['tanggal'] ?></div>
                            </div>
                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium"><?= $row['view'] ?></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <!-- END: Weekly Best Sellers -->
        <!-- BEGIN: Weekly Top Products -->
        <div class="col-span-12 mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    <p>Division List</p>
                </h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <button class="button box flex items-center text-gray-700 dark:text-gray-300"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to Excel </button>
                    <button class="ml-3 button box flex items-center text-gray-700 dark:text-gray-300"> <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Export to PDF </button>
                </div>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-no-wrap">#</th>
                            <th class="whitespace-no-wrap">Divisions</th>
                            <th class="text-center whitespace-no-wrap">Documents</th>
                            <th class="text-center whitespace-no-wrap">Last Uploads</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1;
                        foreach ($documentList as $document) : ?>
                            <tr class="intro-x">
                                <td class="w-40">
                                    <div class="flex">
                                        <div class="flex items-center justify-center"> <i class="w-4 h-4 mr-2"></i> <?= $nomor ?> </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="font-medium whitespace-no-wrap"><?= $document['divisi'] ?></a>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap"><?= $document['direktorat'] ?></div>
                                </td>
                                <td class="text-center"><?= $document['jumlah'] ?></td>
                                <td class="w-40">
                                    <div class="flex items-center justify-center"> <i class="w-4 h-4 mr-2"></i> <?= $document['tanggal'] ?> </div>
                                </td>
                            </tr>
                        <?php $nomor++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END: Weekly Top Products -->
    </div>
</div>
<script src="../dist/js/sideDashboard.js"></script>
<script>
    var berkas = <?= $berkas ?>;
    var pengguna = <?= $pengguna ?>;
    var dataPerBulan = <?= json_encode($dataPerBulan) ?>;
    var dataPerDivisi = <?= $dokumenPerdivisi ?>;
</script>