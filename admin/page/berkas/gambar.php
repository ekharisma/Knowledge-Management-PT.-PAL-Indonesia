<?php
require_once('../helper/FileManager.php');
$querytotal = "SELECT COUNT(*) AS jml
            FROM tb_berkas  WHERE tb_berkas.id_jenis = 5 AND tb_berkas.id_pengguna = '$id_pengguna' ORDER BY id_berkas ASC";


$sqltotal = mysqli_query($mysqli, $querytotal);
$total = mysqli_fetch_assoc($sqltotal);
$totalfile = $total['jml'];

$jumlahDataPerhalaman=12;
$jumlahHalaman = ceil($totalfile/$jumlahDataPerhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerhalaman* $halamanaktif)- $jumlahDataPerhalaman;
$jumlah_number = 2; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
$start_number = ($halamanaktif > $jumlah_number)? $halamanaktif - $jumlah_number : 1;
$end_number = ($halamanaktif < ($jumlahHalaman - $jumlah_number))? $halamanaktif + $jumlah_number : $jumlahHalaman;

if (isset($_GET['keyword-gambar'])) {
    $sql = "SELECT tb_berkas.id_berkas,tb_berkas.ukuran, tb_berkas.nama, tb_berkas.file, tb_berkas.deskripsi FROM tb_berkas  WHERE tb_berkas.id_jenis = 5 AND tb_berkas.id_pengguna = '$id_pengguna' AND tb_berkas.nama LIKE ? ORDER BY id_berkas ASC";
    $keyword = $_GET['keyword-gambar'];
    $keyword = $keyword . "%";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $keyword);
    $stmt->execute();
    $berkas = $stmt->get_result();
} else {
    $sql = "SELECT tb_berkas.id_berkas,tb_berkas.ukuran, tb_berkas.nama, tb_berkas.file, tb_berkas.deskripsi FROM tb_berkas  WHERE tb_berkas.id_jenis = 5 AND tb_berkas.id_pengguna = '$id_pengguna' ORDER BY id_berkas ASC LIMIT $awalData,$jumlahDataPerhalaman";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $berkas = $stmt->get_result();
}
//file manager;
$id = $_POST['id'];
unset($_GET['keyword-gambar']);
?>

<title><?= $title ?></title>

<div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
        <h2 class="intro-y text-lg font-medium mr-auto mt-2">
            File Manager
        </h2>
        <!-- BEGIN: File Manager Menu -->
        <div class="intro-y box p-5 mt-6">
            <div class="mt-1">
                <a href="index.php?gambar" class="flex items-center px-3 py-2 rounded-md  bg-theme-1 text-white font-medium""> <i class="w-4 h-4 mr-2" data-feather="image"></i> Image </a>
                <a href="index.php?video" class="flex items-center px-3 py-2 mt-2 rounded-md"> <i class="w-4 h-4 mr-2" data-feather="video"></i> Video </a>
                <a href="index.php?berkas" class="flex items-center px-3 py-2 mt-2 rounded-md"> <i class="w-4 h-4 mr-2" data-feather="file"></i> Document </a>
                <a href="index.php?audio" class="flex items-center px-3 py-2 mt-2 rounded-md"> <i class="w-4 h-4 mr-2" data-feather="message-square"></i> Audio </a>
                <a href="index.php?other" class="flex items-center px-3 py-2 mt-2 rounded-md"> <i class="w-4 h-4 mr-2" data-feather="box"></i> Others </a>
            </div>
        </div>
        <!-- END: File Manager Menu -->
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
        <!-- BEGIN: File Manager Filter -->
        <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
            <form class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0" method="GET" action="">
                <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300" data-feather="search"></i>
                <input id="keyword" type="text" class="input w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13" name="keyword-gambar" placeholder="Search files">
                <button type="submit" class="button bg-theme-1 text-white"> <span class="w-5 h-5 flex items-center justify-center"> <i data-feather="search" class="w-4 h-4"></i> </span> </button>
            </form>
        </div>
        <!-- END: File Manager Filter -->
        <!-- BEGIN: Directory & Files -->
        <div id="result" class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
            <?php while ($row = $berkas->fetch_assoc()) : ?>
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                    <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                        <div class="absolute left-0 top-0 mt-3 ml-3">
                            <input id="keyword" class="input border border-gray-500" type="checkbox">
                        </div>
                        <a href="" class="w-3/5 file__icon file__icon--empty-directory mx-auto"></a> <a href="" class="block font-medium mt-4 text-center truncate"><?= $row['nama'] ?></a>
                        <div class="text-gray-600 text-xs text-center"><?= floor((int)$row['ukuran'] / 1024) . ' KB' ?></div>
                        <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                            <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                            <div class="dropdown-box w-40">
                                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    <?php $url = 'berkas/' . $divisib . '/lain/'; ?>
                                    <a id="<?= $row['id_berkas'] ?>"  name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md lihat" data-url="<?= $url; ?>"> <i data-feather="airplay" class="w-4 h-4 mr-2"></i>Preview</a>
                                    <a id="<?= $row['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md detail"> <i data-feather="book-open" class="w-4 h-4 mr-2"></i>Detail</a>
                                    <a id="<?= $row['id_berkas'] ?>" href="<?= '../'.$url.$row['file']; ?>" download  data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md unduh"> <i data-feather="box" class="w-4 h-4 mr-2"></i>Download</a>
                                    <a id="<?= $row['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#delete-modal" data-url="<?= $url; ?><?= $row['file']?>" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md hapus"> <i data-feather="trash" class="w-4 h-4 mr-2"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
        <!-- END: Directory & Files -->
        <!-- BEGIN: Pagination -->
        
        <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-6">
            <ul class="pagination">
                <?php if (!isset($keyword)&&$totalfile>12): ?>
                    <?php if($halamanaktif >1): ?>
                    <li>
                        <a class="pagination__link" href="?gambar&halaman=<?= $halamanaktif - 1;?>"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                    </li>
                    <?php endif; ?>
                    <?php for($i=$start_number;$i <= $end_number;$i++): ?>

                        <?php if($i == $halamanaktif): ?> 
                            <li> <a class="pagination__link pagination__link--active" href="?gambar&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
                        <?php else : ?>
                            <li> <a class="pagination__link" href="?gambar&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
                        <?php endif;  ?>
                    <?php endfor; ?>
                    <?php if($halamanaktif < $jumlahHalaman): ?>
                        <li>
                            <a class="pagination__link" href="?gambar&halaman=<?= $halamanaktif + 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
        
        <!-- END: Pagination -->
    </div>
</div>

<script>
    const sideHome = document.getElementById('side-home');
    const sideDashboard = document.getElementById('side-dashboard');
    const sideBerkas = document.getElementById('side-berkas');
    const sideUpload = document.getElementById('side-upload');
    const sideProfile = document.getElementById('side-profile');
    const sidePrivate = document.getElementById('side-private');
    const sidePublic = document.getElementById('side-public');

    sideHome.classList.remove('side-menu--active');
    sideDashboard.classList.remove('side-menu--active');
    sideBerkas.classList.add('side-menu--active');
    sideUpload.classList.remove('side-menu--active');
    sideProfile.classList.remove('side-menu--active');
    sidePrivate.classList.remove('side-menu--active');
    sidePublic.classList.remove('side-menu--active');
</script>