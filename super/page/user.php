<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pengguna_baru=$_POST['nama'];
    $id_user=$_POST['id_user'];
        if($_FILES['input-file']['name']!=""){
            //var_dump($_FILES['input-file']['name']);
            
            $name_file_foto = $_FILES['input-file']['name'];
            $tmp_name       = $_FILES['input-file']['tmp_name'];

            $nama_baru_file_foto = str_replace(".", "_", str_replace(" ", "_", $name_file_foto));

            $explode        = explode(".", $name_file_foto);
            $ekstensi       = strtolower(end($explode));
            $baru           = uniqid(rand()) . "_" . $nama_baru_file_foto . "." . $ekstensi;
            $path           = '../img/foto/'.$baru;
            //echo $baru.' -- '.$tmp_name.'----'.$nama_baru.'-----'.$path;
            if (move_uploaded_file($tmp_name, $path)) {
                if(file_exists('../img/foto/'.$foto))
                {
                    unlink('../img/foto/'.$foto);
                    echo "foto lama dihapus";
                }
                if(isset($_POST['cb-edit-user'])){
                    $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
                    $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_pengguna_baru', foto='$baru',password='$password' WHERE id_pengguna='$id_user'";
                     mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                     alert("Update user nama, foto, dan password  Berhasil");
                }
                else
                {
                    $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_pengguna_baru', foto='$baru' WHERE id_pengguna='$id_user'";
                     mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                     alert("Update user nama dan foto  Berhasil");
                }  
            }
        }else{
            if(isset($_POST['cb-edit-user'])){
                    $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
                    $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_pengguna_baru',password='$password' WHERE id_pengguna='$id_user'";
                     mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                     alert("Update user nama dan password  Berhasil");
                }
                else
                {
                    $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_pengguna_baru' WHERE id_pengguna='$id_user'";
                     mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                     alert("Update user nama  Berhasil");
                }  
        }
        //echo $nama_pengguna_baru.'-'.$id_user.'-'.$password;
}


$querytotal = "SELECT COUNT(*) AS jml
            FROM tb_pengguna ";


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
if (isset($_GET['keyword-pengguna'])) {
    $keyword = $_GET['keyword-pengguna'];
    $keyword = $keyword . "%";
    $statement = "SELECT tb_pengguna.id_pengguna,tb_pengguna.foto,tb_pengguna.username,tb_pengguna.password,tb_pengguna.nama_pengguna,tb_level.level,tb_direktorat.direktorat,tb_divisi.divisi
            FROM tb_pengguna, tb_direktorat, tb_divisi, tb_level 
            WHERE tb_pengguna.id_level = tb_level.id_level 
            AND tb_pengguna.id_direktorat = tb_direktorat.id_direktorat 
            AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_pengguna.nama_pengguna LIKE '$keyword' ORDER BY id_pengguna ASC";
    }
else{
        $statement = "SELECT tb_pengguna.id_pengguna,tb_pengguna.foto,tb_pengguna.username,tb_pengguna.password,tb_pengguna.nama_pengguna,tb_level.level,tb_direktorat.direktorat,tb_divisi.divisi
            FROM tb_pengguna, tb_direktorat, tb_divisi, tb_level 
            WHERE tb_pengguna.id_level = tb_level.id_level 
            AND tb_pengguna.id_direktorat = tb_direktorat.id_direktorat 
            AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_divisi.id_direktorat = tb_direktorat.id_direktorat 
            ORDER BY id_pengguna ASC
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
                                <input id="keyword-pengguna" name="keyword-pengguna" type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                                 
                            </div>
                        </form>
                    </div>
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <table class="table table-report -mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center whitespace-no-wrap">Id</th>
                                    <th class="text-center whitespace-no-wrap">FOTO</th>
                                    <th class="text-center whitespace-no-wrap">USER NAME</th>
                                    <th class="text-center whitespace-no-wrap">DIREKTORAT</th>
                                    <th class="text-center whitespace-no-wrap">DIVISI</th>
                                    <th class="text-center whitespace-no-wrap">USERNAME</th>
                                    
                                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($data=mysqli_fetch_assoc($query)){ 
                                    
                                ?>
                                <tr class="intro-x">
                                    <td>
                                        <div class="flex items-center justify-center"><?= $data['id_pengguna']?></div>
                                        
                                    </td>
                                    <td class="w-10">
                                        <div class="w-10 h-10 image-fit zoom-in">
                                            <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full" src="../img/foto/<?= $data['foto']?>" title="Uploaded at 3 December 2020">
                                        </div>
                                        
                                    </td>
                                    <td class="w-40">
                                        <div class=""><?= $data['nama_pengguna']?></div>
                                        
                                    </td>
                                    <td class="w-40">
                                        <div class="flex items-center justify-center"><?= $data['direktorat']?></div>
                                        
                                    </td>
                                    <td class="w-40">
                                        <div class="flex items-center justify-center"><?= $data['divisi']?></div>
                                        
                                    </td>
                                    <td class="w-40">
                                        <div class="flex items-center justify-center"><?= $data['username']?></div>
                                        
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a id="<?= $data['id_pengguna'] ?>" name="ubah-pengunna" class="flex items-center mr-3 ubah_pengguna" href="javascript:;"data-toggle="modal" data-target="#button-modal-preview"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i></a>
                                            <a id="<?= $data['id_pengguna'] ?>" href="javascript:;" data-toggle="modal" data-target="#delete-modal" data-url="../img/foto/<?= $data['foto']?>" class="flex items-center text-theme-6 hapus_pengguna"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
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

                <?php 
                if(!isset($keyword)):
                    if($halamanaktif >1): ?>
                <li>
                    <a class="pagination__link" href="?user&halaman=<?= $halamanaktif - 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <?php endif; ?>
                <?php for($i=$start_number;$i <= $end_number;$i++): ?>

                    <?php if($i == $halamanaktif): ?> 
                        <li> <a class="pagination__link pagination__link--active" href="?userhalaman=<?= $i; ?>"><?= $i; ?></a> </li>
                    <?php else : ?>
                        <li> <a class="pagination__link" href="?user&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
                    <?php endif;  ?>
                <?php endfor; ?>
                <?php if($halamanaktif < $jumlahHalaman): ?>
                    <li>
                        <a class="pagination__link" href="?user&halaman=<?=$halamanaktif + 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                    </li>
                <?php endif;endif;  ?>
            </ul>
        </div>
        <!-- END: Pagination -->
</div>