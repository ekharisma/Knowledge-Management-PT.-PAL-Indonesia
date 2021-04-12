<?php 
if (isset($_POST['update'])) 
{
    $id_pengguna_berkas=$_POST['id_pengguna_berkas'];
    $id_berkas_update=$_POST['id_berkas'];
    $nama_file_baru=$_POST['nama'];
    $type_file_baru=$_POST['tipe-file'];
    $deskripsi      = $_POST['deskripsi'];
    //echo $id_pengguna_berkas.'-'.$id_berkas_update.'-'.$nama_file_baru.'-'.$deskripsi;
    if($_FILES['berkas']['name']=="")
    {
        //echo '--masuk 1';
        if(!isset($_POST['cb-edit']))
        {
            //echo '--masuk 2';
            $perintah = "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',deskripsi='$deskripsi' WHERE id_berkas='$id_berkas_update'";
            mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
            alert("Update file berhasil (nama, type file, deskripsi)");
        }
        else
        {
            //echo '--masuk 3';
            $kategori_id    = $_POST['kategori'];
            $sub1_kategori_id    = $_POST['sub1_kategori'];
            $sub2_kategori_id    = $_POST['sub2_kategori'];
            $sub3_kategori_id    = $_POST['sub3_kategori'];
            $sub4_kategori_id    = $_POST['sub4_kategori'];
            $perintah = "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',deskripsi='$deskripsi',kategori_id='$kategori_id',sub1_kategori_id='$sub1_kategori_id',sub2_kategori_id='$sub2_kategori_id',sub3_kategori_id='$sub3_kategori_id',sub4_kategori_id='$sub4_kategori_id' WHERE id_berkas='$id_berkas_update'";
            mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
            alert("Update file berhasil (nama, type file, deskripsi , klasifikasi dokument)");
        }
    }
    else
    {
        //echo '--masuk 4';
        $div = "SELECT tb_divisi.divisi FROM tb_divisi,tb_pengguna where tb_divisi.id_divisi=tb_pengguna.id_divisi AND tb_pengguna.id_pengguna=' $id_pengguna_berkas' ";
        $divq = mysqli_query($mysqli, $div);
        $datav = mysqli_fetch_assoc($divq);
        $divv = $datav['divisi'];
        $divisiaaa = str_replace(" ", "", $divv);

        $nama_file_lama = $_POST['nama_file_lama'];
        $name           = $_FILES['berkas']['name'];
        $type           = $_FILES['berkas']['type'];
        $size           = $_FILES['berkas']['size'];
        $tmp_name       = $_FILES['berkas']['tmp_name'];

        $nama_baru    = str_replace(".", "_", str_replace(" ", "_", $name));

        $explode        = explode(".", $name);
        $ekstensi       = strtolower(end($explode));
        $baru           = uniqid(rand()) . "_" . $nama_baru . "." . $ekstensi;
        $path           = "../berkas/";
        if (($ekstensi == 'mkv') || ($ekstensi == 'mp4') || ($ekstensi == '3gp')) 
        {
            // var_dump($ekstensi . " " . $size);
            if ($size < 1000000000) 
            {
                $video = $path . $divisiaaa . "/video/" . $baru;
                if (move_uploaded_file($tmp_name, $video)) 
                {
                    if(file_exists($path . $divisiaaa . "/video/".$nama_file_lama))
                    {
                        unlink($path . $divisiaaa . "/video/".$nama_file_lama); 
                    }
                    

                    if(!isset($_POST['cb-edit']))
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=1,deskripsi='$deskripsi' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi, berkas)");
                    }
                    else
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=1,deskripsi='$deskripsi',kategori_id='$kategori_id',sub1_kategori_id='$sub1_kategori_id',sub2_kategori_id='$sub2_kategori_id',sub3_kategori_id='$sub3_kategori_id',sub4_kategori_id='$sub4_kategori_id' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi , klasifikasi dokument, berkas)");
                    }
                }
            } 
            else 
            { 
                alert("Ukuran video terlalu besar"); 
            }

        } 
        else if (($ekstensi == 'docx') || ($ekstensi == 'xlsx') || ($ekstensi == 'pptx') || ($ekstensi == 'pdf')) 
        {
            if ($size < 70000000) 
            { //70mb
                $document = $path . $divisiaaa . "/document/" . $baru;
                if (move_uploaded_file($tmp_name, $document)) 
                {
                    if(file_exists($path . $divisiaaa . "/document/".$nama_file_lama))
                    {
                        unlink($path . $divisiaaa . "/document/".$nama_file_lama);
                    }
                    

                    if(!isset($_POST['cb-edit']))
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=2,deskripsi='$deskripsi' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi, berkas)");
                    }
                    else
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=2,deskripsi='$deskripsi',kategori_id='$kategori_id',sub1_kategori_id='$sub1_kategori_id',sub2_kategori_id='$sub2_kategori_id',sub3_kategori_id='$sub3_kategori_id',sub4_kategori_id='$sub4_kategori_id' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi , klasifikasi dokument, berkas)");
                    }
                }
            } 
            else 
            { 
                alert("Ukuran Dokumen terlalu besar");
            }
        } 
        elseif (($ekstensi == 'mp3') || ($ekstensi == 'wav') || ($ekstensi == 'wma')) 
        {
            if ($size < 1000000000) 
            {
                $audio = $path . $divisiaaa . "/audio/" . $baru;
                if (move_uploaded_file($tmp_name, $audio)) 
                {
                    if(file_exists($path . $divisiaaa . "/audio/".$nama_file_lama))
                    {
                        unlink($path . $divisiaaa . "/audio/".$nama_file_lama);
                    }
                    
    
                    if(!isset($_POST['cb-edit']))
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=3,deskripsi='$deskripsi' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi, berkas)");
                    }
                    else
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=3,deskripsi='$deskripsi',kategori_id='$kategori_id',sub1_kategori_id='$sub1_kategori_id',sub2_kategori_id='$sub2_kategori_id',sub3_kategori_id='$sub3_kategori_id',sub4_kategori_id='$sub4_kategori_id' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi , klasifikasi dokument, berkas)");
                    }
                }
            } 
            else 
            { 
                alert("Ukuran audio terlalu besar");
            }
        } 
        else 
        {
            if ($size < 1000000000) 
            {
                $lain = $path . $divisiaaa . "/lain/" . $baru;
                if (move_uploaded_file($tmp_name, $lain)) 
                {
                    if(file_exists($path . $divisiaaa . "/lain/".$nama_file_lama))
                    {
                        unlink($path . $divisiaaa . "/lain/".$nama_file_lama);
                    }
                    

                    if(!isset($_POST['cb-edit']))
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=4,deskripsi='$deskripsi' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi, berkas)");
                    }
                    else
                    {
                        $query = mysqli_query($mysqli, "UPDATE tb_berkas SET nama='$nama_file_baru',kat='$type_file_baru',file='$baru',ukuran='$size',id_jenis=4,deskripsi='$deskripsi',kategori_id='$kategori_id',sub1_kategori_id='$sub1_kategori_id',sub2_kategori_id='$sub2_kategori_id',sub3_kategori_id='$sub3_kategori_id',sub4_kategori_id='$sub4_kategori_id' WHERE id_berkas='$id_berkas_update'");
                        mysqli_query($mysqli, $query) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                        alert("Update file berhasil (nama, type file, deskripsi , klasifikasi dokument, berkas)");
                    }
                } 
            } 
            else 
            { 
                alert("Ukuran file terlalu besar"); 
            }
        }
    }
}

$querytotal = "SELECT COUNT(*) AS jml
            FROM tb_berkas ";


$sqltotal = mysqli_query($mysqli, $querytotal);
$total = mysqli_fetch_assoc($sqltotal);
$totalfile = $total['jml'];
//echo $totalfile;

$jumlahDataPerhalaman=12;
$jumlahHalaman = ceil($totalfile/$jumlahDataPerhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerhalaman* $halamanaktif)- $jumlahDataPerhalaman;
$jumlah_number = 2; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
$start_number = ($halamanaktif > $jumlah_number)? $halamanaktif - $jumlah_number : 1;
$end_number = ($halamanaktif < ($jumlahHalaman - $jumlah_number))? $halamanaktif + $jumlah_number : $jumlahHalaman;  
if (isset($_GET['keyword-berkas'])) {
    $keyword = $_GET['keyword-berkas'];
    $keyword = $keyword . "%";
    $statement = "SELECT tb_berkas.id_pengguna,tb_berkas.nama,tb_berkas.file,tb_berkas.id_berkas,tb_berkas.tanggal,tb_berkas.jam,tb_berkas.deskripsi,tb_pengguna.id_divisi,tb_pengguna.nama_pengguna,tb_berkas.id_jenis, tb_divisi.divisi
        FROM tb_berkas, tb_pengguna, tb_direktorat, tb_divisi, tb_jenis 
        WHERE tb_berkas.id_jenis = tb_jenis.id_jenis 
        AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna 
        AND tb_pengguna.id_direktorat = tb_direktorat.id_direktorat 
        AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_berkas.nama LIKE '$keyword' ORDER BY id_berkas ASC";
    }
else{
        $statement = "SELECT tb_berkas.id_pengguna,tb_berkas.nama,tb_berkas.file,tb_berkas.id_berkas,tb_berkas.tanggal,tb_berkas.jam,tb_berkas.deskripsi,tb_pengguna.id_divisi,tb_pengguna.nama_pengguna,tb_berkas.id_jenis,tb_divisi.divisi
            FROM tb_berkas, tb_pengguna, tb_direktorat, tb_divisi, tb_jenis 
            WHERE tb_berkas.id_jenis = tb_jenis.id_jenis 
            AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna 
            AND tb_pengguna.id_direktorat = tb_direktorat.id_direktorat 
            AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_divisi.id_direktorat = tb_direktorat.id_direktorat 
            ORDER BY id_berkas ASC
            LIMIT $awalData,$jumlahDataPerhalaman";
    }

  
$query = mysqli_query($mysqli, $statement);

?>
<title><?= $title ?></title>
<!-- END: Top Bar -->
                <h2 class="intro-y text-lg font-medium mt-10">
                    Data List Layout
                </h2>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                        <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Product</button>
                        <div class="dropdown">
                            <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                            </button>
                            <div class="dropdown-box w-40">
                                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel </a>
                                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF </a>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block mx-auto text-gray-600">Showing <?= $totalfile;?> entries</div>
                        
                        <form class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">

                            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                                <input id="keyword-berkas" name="keyword-berkas" type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                                 
                            </div>
                        </form>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center whitespace-no-wrap">ID</th>
                                    <th class="whitespace-no-wrap">UPLOADER</th>
                                    <th class="whitespace-no-wrap">FILE NAME</th>
                                    <th class="text-center whitespace-no-wrap">DESCRIPTION</th>
                                    <th class="text-center whitespace-no-wrap">TYPE</th>
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($data=mysqli_fetch_assoc($query)){ 
                                    
                                ?>
                                <tr class="intro-x">
                                    <td>
                                        <?= $data['id_berkas']?>
                                    </td>
                                    <td class="w-40">
                                        <?= $data['nama_pengguna']?>
                                    </td>
                                    <td class="">
                                        <div class="block font-medium text-base"><?= $data['nama']?></div> 
                                        <div class="text-gray-600 text-xs whitespace-no-wrap">Shared : Tgl <?php echo $data['tanggal']; ?></div>
                                    </td>
                                    <td >
                                        <div class="block font-medium text-base"><?= $data['deskripsi']?></div> 
                                    </td>
                                    <td class="w-20">
                                        <?php
                                            $divisiaaa = str_replace(" ", "", $data['divisi']);
                                            if ($data['id_jenis'] == 1) {
                                                $url = 'berkas/' . $divisiaaa . '/video/'; ?>
                                                <div class="flex items-center justify-center">Video</div>

                                            <?php

                                            } elseif ($data['id_jenis'] == 2) {
                                                $url = 'berkas/' . $divisiaaa . '/document/'; ?>
                                                <div class=" flex items-center justify-center">Dokument</div>

                                            <?php

                                            } elseif ($data['id_jenis'] == 3) {
                                                $url = 'berkas/' . $divisiaaa . '/audio/'; ?>
                                                <div class=" flexitems-center justify-center">Audio</div>

                                            <?php

                                            } elseif ($data['id_jenis'] == 4) {
                                                $url = 'berkas/' . $divisiaaa . '/lain/'; ?>
                                                <div class="flex items-center justify-center">Lainnya</div>

                                            <?php

                                            }

                                        ?>
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a id="<?= $data['id_berkas'] ?>" name="ubah" class="flex items-center mr-3 ubah" href="javascript:;"data-toggle="modal" data-target="#button-modal-preview"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></a>
                                            <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-3 text-theme-1 detail tooltip" title="detail" > <i data-feather="book-open" class="w-4 h-4 mr-1"></i></a>
                                            <a id="<?= $data['id_berkas'] ?>" name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-3 text-theme-12 lihat tooltip " data-url="<?= $url; ?>" title="Lihat" > <i data-feather="eye" class="w-4 h-4 mr-1"></i></a>
                                            <a id="<?= $data['id_berkas'] ?>" name="unduh" href="aksi/download.php?id=<?php echo $data['id_berkas']; ?>&url=<?php echo $url; ?> download data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-3 text-theme-30 unduh tooltip" title="Download" > <i data-feather="share" class="w-4 h-4"></i></a>
                                            <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#delete-modal" data-url="<?= $url; ?><?= $data['file']?>" class="flex items-center text-theme-6 hapus"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } $i=0;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                <?php if($halamanaktif >1): ?>
                <li>
                    <a class="pagination__link" href="?berkas-all&halaman=<?= $halamanaktif - 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <?php endif; ?>
                <?php for($i=$start_number;$i <= $end_number;$i++): ?>

                    <?php if($i == $halamanaktif): ?> 
                        <li> <a class="pagination__link pagination__link--active" href="?berkas-all&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
                    <?php else : ?>
                        <li> <a class="pagination__link" href="?berkas-all&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
                    <?php endif;  ?>
                <?php endfor; ?>
                <?php if($halamanaktif < $jumlahHalaman): ?>
                    <li>
                        <a class="pagination__link" href="?berkas-all&halaman=<?=$halamanaktif + 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- END: Pagination -->
</div>