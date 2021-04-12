<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['comment'])){
        $comment = $_POST["comment"];
        $id_berkas = $_POST["id_berkas"];
        $jam            = date('l, h:i:s a');
        $tanggal        = date('Y-m-d');
        //echo $comment." ".$id_berkas." ".$tanggal." ".$jam." ".$id_pengguna;
        if(empty($comment)){
            alert("Komentar belum diisi");
        }
        else {
          $perintah = "INSERT INTO tb_komentar SET
                        komentar = '$comment',
                        tanggal = '$tanggal',
                        jam='$jam',
                        id_berkas='$id_berkas',
                        id_pengguna='$id_pengguna'";
          mysqli_query($mysqli, $perintah) 
          or die ("Gagal Perintah SQL". mysqli_error());
          alert("komentar tersimpan");
        }
    }
    if (isset($_POST['nama'])){
        $nama_baru=$_POST['nama'];
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
                
                $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_baru',foto='$baru' WHERE id_pengguna='$id_pengguna'";
                mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error($mysqli));
                $_SESSION['nama']=$nama_baru;
                $_SESSION['foto']=$baru;
                alert("Update profil nama dan foto Berhasil");
            }
        }else{
            //echo $nama_baru;
            $perintah = "UPDATE tb_pengguna SET nama_pengguna='$nama_baru' WHERE id_pengguna='$id_pengguna'";
            mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL".mysqli_error($mysqli)); 
            //mysqli_query($mysqli, $perintah) or die ("Gagal Perintah SQL". mysqli_error());
            $_SESSION['nama']=$nama_baru;
            alert("Update profi nama Berhasil");
        }
    }
    
    
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id_jenis = $_GET['jenis'];
}
$jumlah = 0;


?>
<title><?= $title ?></title>
<!-- BEGIN: Profile Info -->
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $foto; ?>">
            </div>
            <div class="ml-5">
                <div class="font-medium text-lg  mt-1 sm:mt-0  truncate sm:whitespace-normal"><?php echo $nama; ?></div>
                <div class="text-gray-600"><?php echo $direktorat; ?></div>
                <div class="text-gray-600"><?php echo $divisi; ?></div>

            </div>
        </div>
        <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
            <div class="text-center rounded-md w-20 py-3">
                    <?php
                    $query = mysqli_query($mysqli, "SELECT tb_berkas.id_berkas FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 1 AND tb_pengguna.id_pengguna = '$id'");

                    $jum = mysqli_num_rows($query);

                    ?>
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg"><?php echo $jum; ?></div>
                    <div class="text-gray-600">Video</div>
                </div>
                <div class="text-center rounded-md w-20 py-3">
                    <?php
                    $query = mysqli_query($mysqli, "SELECT tb_berkas.id_berkas FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 2 AND tb_pengguna.id_pengguna = '$id'");

                    $jum = mysqli_num_rows($query);

                    ?>
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg"><?php echo $jum; ?></div>
                    <div class="text-gray-600">Document</div>
                </div>
                <div class="text-center rounded-md w-20 py-3">
                    <?php

                    $query = mysqli_query($mysqli, "SELECT tb_berkas.id_berkas FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 3 AND tb_pengguna.id_pengguna = '$id'");

                    $jum = mysqli_num_rows($query);

                    ?>
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg"><?php echo $jum; ?></div>
                    <div class="text-gray-600">Audio</div>
                </div>
                <div class="text-center rounded-md w-20 py-3">
                    <?php
                    $query = mysqli_query($mysqli, "SELECT tb_berkas.id_berkas FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 4 AND tb_pengguna.id_pengguna = '$id'");

                    $jum = mysqli_num_rows($query);

                    ?>
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg"><?php echo $jum; ?></div>
                    <div class="text-gray-600">Other</div>
                </div>
        </div>
    </div>
    
</div>
<!-- END: Profile Info -->

<div class="flex flex-wrap" id="tabs-id">
  <div class="w-full">
    <ul class="flex list-none flex-wrap pt-3 flex-row">
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal bg-white"  onclick="changeAtiveTab(event,'tab-video')">
          <i class="fas fa-space-shuttle text-base mr-1"></i>  Video
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal bg-white" onclick="changeAtiveTab(event,'tab-dokument')">
          <i class="fas fa-cog text-base mr-1"></i>  Document
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal bg-white" onclick="changeAtiveTab(event,'tab-audio')">
          <i class="fas fa-briefcase text-base mr-1"></i>  Audio
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal bg-white" onclick="changeAtiveTab(event,'tab-other')">
          <i class="fas fa-briefcase text-base mr-1" ></i>  Other
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal bg-white" onclick="changeAtiveTab(event,'tab-edit-profil')">
          <i class="fas fa-briefcase text-base mr-1" ></i>  Edit Profil
        </a>
      </li>
    </ul>
    <div class="relative flex flex-col min-w-0 break-words w-full mb-3 ">
      <div class="px-4 py-5 flex-auto">
        <div class="tab-content tab-space">
          <div class="block" id="tab-video">
            <div class="pos intro-y grid grid-cols-12 gap-5  " >
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-5 mt-1 pt-1 border-t border-theme-5">
                        <!-- BEGIN: Blog Layout -->
                        <?php
                        $query = mysqli_query($mysqli, "SELECT tb_pengguna.id_pengguna, tb_pengguna.nama_pengguna, tb_pengguna.foto, tb_berkas.id_berkas,tb_berkas.nama, tb_berkas.file, tb_berkas.jam, tb_berkas.tanggal,tb_berkas.view,tb_berkas.download, tb_jenis.id_jenis FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 1 AND tb_pengguna.id_pengguna = '$id'");

                        $jumlah = mysqli_num_rows($query);

                        if ($jumlah == 0) { ?>

                            <h3 class="text-center">Kosong</h3>

                            <?php
                        } else {
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <div class="box intro-y block col-span-12 sm:col-span-4 xxl:col-span-3">
                                    <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                                        <div class="w-10 h-10 flex-none image-fit">
                                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $data['foto']; ?>">
                                        </div>
                                        <div class="ml-3 mr-auto">
                                            <span class="username "><a id="<?php echo $data['id_pengguna'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="mini_profil"><?php echo $data['nama_pengguna']; ?></a></span>
                                            <div class="flex text-gray-600 truncate text-xs mt-1"><span class="mx-1">•</span>Shared publicly : Tgl <?php echo $data['tanggal']; ?></div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="file  mx-auto ">
                                            <a href="" class="w-2/5 file__icon file__icon--file mx-auto">
                                                <?php

                                                if ($data['id_jenis'] == 1) {
                                                    $url = 'berkas/' . $divisib . '/video/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="film"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 2) {
                                                    $url = 'berkas/' . $divisib . '/document/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="type"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 3) {
                                                    $url = 'berkas/' . $divisib . '/audio/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="music"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 4) {
                                                    $url = 'berkas/' . $divisib . '/lain/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="list"></i></div>

                                                <?php

                                                }

                                                ?>
                                            </a>
                                        </div>
                                        <a href="" class="block font-medium text-base mt-5"><?php echo $data['nama']; ?></a>
                                    </div>
                                    <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5">
                                        <a id="<?= $data['id_berkas'] ?>" name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="tooltip flex items-center mr-2 block p-2 transition duration-300 ease-in-out bg-theme-17 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md lihat " title="Lihat" data-url="<?= $url; ?>"> <i data-feather="eye" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-14 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md detail tooltip" title="Detail" > <i data-feather="book-open" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#checksumModal" data-url="<?= $url . $data['file'] ?>" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-18 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md kode tooltip" title="Checksum"> <i data-feather="key" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" name="unduh" href="<?= '../'.$url.$data['file']; ?>" download data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-theme-30 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md unduh tooltip" title="Download" > <i data-feather="share" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-auto comments tooltip" title="Comments" data-url="<?= $data['id_pengguna'] ?>" > <i data-feather="message-square" class="w-3 h-3"></i> </a>

                                    </div>
                                    <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
                                        <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                                            <div  class="mr-2"> Views: <span id ="<?= $data['id_berkas'];?>_view_count" class="font-medium"><?php echo $data['view']; ?></span> </div>
                                            <?php 
                                                $perintah = "SELECT COUNT(*) AS jml
                                                            FROM tb_komentar 
                                                            WHERE tb_komentar.id_berkas='".$data['id_berkas']."'";
                                                $sqltotal = mysqli_query($mysqli, $perintah);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalcomment = $total['jml'];
                                            ?> 
                                            <div class="mr-2"> Comment: <span class="font-medium"><?php echo $totalcomment ?></span> </div>
                                            <div class="ml-auto"> Download: <span id ="<?= $data['id_berkas'];?>_download_count" class="font-medium"><?php echo $data['download']; ?></span> </div>
                                        </div>
                                        <form class="w-full flex items-center mt-3" method="POST" action="">
                                            <div class="w-8 h-8 flex-none image-fit mr-3">
                                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $foto; ?>">
                                            </div>
                                            <div class="flex-1 relative text-gray-700 mr-3">
                                                <input class="hidden" type="text" name="id_berkas" value="<?= $data['id_berkas'];  ?>" />
                                                <input type="text" class="input w-full rounded-full bg-gray-200 pr-10 placeholder-theme-13" name="comment" placeholder="Post a comment...">
                                                
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit ">
                                                <button type="submit" name="submit" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 ml-auto " value=""> <i data-feather="send" class="w-3 h-3"></i> </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                        <?php
                                $total++;
                            }
                        }
                        ?>
                        <!-- END: Blog Layout -->
                    </div>
                </div>
            </div>
          </div>
          <div class="hidden" id="tab-dokument">
            <div class="pos intro-y grid grid-cols-12 gap-5 " >
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-5 mt-1 pt-1 border-t border-theme-5">
                        <!-- BEGIN: Blog Layout -->
                        <?php
                        $query = mysqli_query($mysqli, "SELECT tb_pengguna.id_pengguna, tb_pengguna.nama_pengguna, tb_pengguna.foto, tb_berkas.id_berkas,tb_berkas.nama, tb_berkas.file, tb_berkas.jam, tb_berkas.tanggal,tb_berkas.view,tb_berkas.download, tb_jenis.id_jenis FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 2 AND tb_pengguna.id_pengguna = '$id'");

                        $jumlah = mysqli_num_rows($query);

                        if ($jumlah == 0) { ?>

                            <h3 class="text-center">Kosong</h3>

                            <?php
                        } else {
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <div class="box intro-y block col-span-12 sm:col-span-4 xxl:col-span-3">
                                    <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                                        <div class="w-10 h-10 flex-none image-fit">
                                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $data['foto']; ?>">
                                        </div>
                                        <div class="ml-3 mr-auto">
                                            <span class="username "><a id="<?php echo $data['id_pengguna'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="mini_profil"><?php echo $data['nama_pengguna']; ?></a></span>
                                            <div class="flex text-gray-600 truncate text-xs mt-1"><span class="mx-1">•</span>Shared publicly : Tgl <?php echo $data['tanggal']; ?></div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="file  mx-auto ">
                                            <a href="" class="w-2/5 file__icon file__icon--file mx-auto">
                                                <?php

                                                if ($data['id_jenis'] == 1) {
                                                    $url = 'berkas/' . $divisib . '/video/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="film"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 2) {
                                                    $url = 'berkas/' . $divisib . '/document/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="type"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 3) {
                                                    $url = 'berkas/' . $divisib . '/audio/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="music"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 4) {
                                                    $url = 'berkas/' . $divisib . '/lain/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="list"></i></div>

                                                <?php

                                                }

                                                ?>
                                            </a>
                                        </div>
                                        <a href="" class="block font-medium text-base mt-5"><?php echo $data['nama']; ?></a>
                                    </div>
                                    <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5">
                                        <a id="<?= $data['id_berkas'] ?>" name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="tooltip flex items-center mr-2 block p-2 transition duration-300 ease-in-out bg-theme-17 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md lihat " title="Lihat" data-url="<?= $url; ?>"> <i data-feather="eye" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-14 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md detail tooltip" title="Detail" > <i data-feather="book-open" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#checksumModal" data-url="<?= $url . $data['file'] ?>" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-18 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md kode tooltip" title="Checksum"> <i data-feather="key" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" name="unduh" href="<?= '../'.$url.$data['file']; ?>" download data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-theme-30 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md unduh tooltip" title="Download" > <i data-feather="share" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-auto comments tooltip" title="Comments" data-url="<?= $data['id_pengguna'] ?>" > <i data-feather="message-square" class="w-3 h-3"></i> </a>
                                    </div>
                                    <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
                                        <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                                            <div  class="mr-2"> Views: <span id ="<?= $data['id_berkas'];?>_view_count" class="font-medium"><?=  $data['view']; ?></span> </div>
                                            <?php 
                                                $perintah = "SELECT COUNT(*) AS jml
                                                            FROM tb_komentar 
                                                            WHERE tb_komentar.id_berkas='".$data['id_berkas']."'";
                                                $sqltotal = mysqli_query($mysqli, $perintah);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalcomment = $total['jml'];
                                            ?> 
                                            <div class="mr-2"> Comment: <span class="font-medium"><?php echo $totalcomment ?></span> </div>
                                            <div class="ml-auto"> Download: <span id ="<?= $data['id_berkas'];?>_download_count" class="font-medium"><?php echo $data['download']; ?></span> </div>
                                        </div>
                                        <form class="w-full flex items-center mt-3" method="POST" action="">
                                            <div class="w-8 h-8 flex-none image-fit mr-3">
                                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $foto; ?>">
                                            </div>
                                            <div class="flex-1 relative text-gray-700 mr-3">
                                                <input class="hidden" type="text" name="id_berkas" value="<?= $data['id_berkas'];  ?>" />
                                                <input type="text" class="input w-full rounded-full bg-gray-200 pr-10 placeholder-theme-13" name="comment" placeholder="Post a comment...">
                                                
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit ">
                                                <button type="submit" name="submit" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 ml-auto " value=""> <i data-feather="send" class="w-3 h-3"></i> </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                        <?php
                                $total++;
                            }
                        }
                        ?>
                        <!-- END: Blog Layout -->
                    </div>
                </div>
            </div>
          </div>
          <div class="hidden" id="tab-audio">
            <div class="pos intro-y grid grid-cols-12 gap-5 " >
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-5 mt-1 pt-1 border-t border-theme-5">
                        <!-- BEGIN: Blog Layout -->
                        <?php
                        $query = mysqli_query($mysqli, "SELECT tb_pengguna.id_pengguna, tb_pengguna.nama_pengguna, tb_pengguna.foto, tb_berkas.id_berkas,tb_berkas.nama, tb_berkas.file, tb_berkas.jam, tb_berkas.tanggal,tb_berkas.view,tb_berkas.download, tb_jenis.id_jenis FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 3 AND tb_pengguna.id_pengguna = '$id'");

                        $jumlah = mysqli_num_rows($query);

                        if ($jumlah == 0) { ?>

                            <h3 class="text-center">Kosong</h3>

                            <?php
                        } else {
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <div class="box intro-y block col-span-12 sm:col-span-4 xxl:col-span-3">
                                    <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                                        <div class="w-10 h-10 flex-none image-fit">
                                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $data['foto']; ?>">
                                        </div>
                                        <div class="ml-3 mr-auto">
                                            <span class="username "><a id="<?php echo $data['id_pengguna'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="mini_profil"><?php echo $data['nama_pengguna']; ?></a></span>
                                            <div class="flex text-gray-600 truncate text-xs mt-1"><span class="mx-1">•</span>Shared publicly : Tgl <?php echo $data['tanggal']; ?></div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="file  mx-auto ">
                                            <a href="" class="w-2/5 file__icon file__icon--file mx-auto">
                                                <?php

                                                if ($data['id_jenis'] == 1) {
                                                    $url = 'berkas/' . $divisib . '/video/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="film"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 2) {
                                                    $url = 'berkas/' . $divisib . '/document/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="type"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 3) {
                                                    $url = 'berkas/' . $divisib . '/audio/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="music"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 4) {
                                                    $url = 'berkas/' . $divisib . '/lain/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="list"></i></div>

                                                <?php

                                                }

                                                ?>
                                            </a>
                                        </div>
                                        <a href="" class="block font-medium text-base mt-5"><?php echo $data['nama']; ?></a>
                                    </div>
                                    <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5">
                                        <a id="<?= $data['id_berkas'] ?>" name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="tooltip flex items-center mr-2 block p-2 transition duration-300 ease-in-out bg-theme-17 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md lihat " title="Lihat" data-url="<?= $url; ?>"> <i data-feather="eye" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-14 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md detail tooltip" title="Detail" > <i data-feather="book-open" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#checksumModal" data-url="<?= $url . $data['file'] ?>" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-18 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md kode tooltip" title="Checksum"> <i data-feather="key" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" name="unduh" href="<?= '../'.$url.$data['file']; ?>" download data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-theme-30 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md unduh tooltip" title="Download" > <i data-feather="share" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-auto comments tooltip" title="Comments" data-url="<?= $data['id_pengguna'] ?>" > <i data-feather="message-square" class="w-3 h-3"></i> </a>

                                    </div>
                                    <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
                                        <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                                            <div  class="mr-2"> Views: <span id ="<?= $data['id_berkas'];?>_view_count" class="font-medium"><?php echo $data['view']; ?></span> </div>
                                            <?php 
                                                $perintah = "SELECT COUNT(*) AS jml
                                                            FROM tb_komentar 
                                                            WHERE tb_komentar.id_berkas='".$data['id_berkas']."'";
                                                $sqltotal = mysqli_query($mysqli, $perintah);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalcomment = $total['jml'];
                                            ?> 
                                            <div class="mr-2"> Comment: <span class="font-medium"><?php echo $totalcomment ?></span> </div>
                                            <div class="ml-auto"> Download: <span id ="<?= $data['id_berkas'];?>_download_count" class="font-medium"><?php echo $data['download']; ?></span> </div>
                                        </div>
                                        <form class="w-full flex items-center mt-3" method="POST" action="">
                                            <div class="w-8 h-8 flex-none image-fit mr-3">
                                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $foto; ?>">
                                            </div>
                                            <div class="flex-1 relative text-gray-700 mr-3">
                                                <input class="hidden" type="text" name="id_berkas" value="<?= $data['id_berkas'];  ?>" />
                                                <input type="text" class="input w-full rounded-full bg-gray-200 pr-10 placeholder-theme-13" name="comment" placeholder="Post a comment...">
                                                
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit ">
                                                <button type="submit" name="submit" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 ml-auto " value=""> <i data-feather="send" class="w-3 h-3"></i> </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                        <?php
                                $total++;
                            }
                        }
                        ?>
                        <!-- END: Blog Layout -->
                    </div>
                </div>
            </div>
          </div>
          <div class="hidden" id="tab-other">
            <div class="pos intro-y grid grid-cols-12 gap-5 " >
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-5 mt-1 pt-1 border-t border-theme-5">
                        <!-- BEGIN: Blog Layout -->
                        <?php
                        $query = mysqli_query($mysqli, "SELECT tb_pengguna.id_pengguna, tb_pengguna.nama_pengguna, tb_pengguna.foto, tb_berkas.id_berkas,tb_berkas.nama, tb_berkas.file, tb_berkas.jam, tb_berkas.tanggal,tb_berkas.view,tb_berkas.download, tb_jenis.id_jenis FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 4 AND tb_pengguna.id_pengguna = '$id'");

                        $jumlah = mysqli_num_rows($query);

                        if ($jumlah == 0) { ?>

                            <h3 class="text-center">Kosong</h3>

                            <?php
                        } else {
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <div class="box intro-y block col-span-12 sm:col-span-4 xxl:col-span-3">
                                    <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                                        <div class="w-10 h-10 flex-none image-fit">
                                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $data['foto']; ?>">
                                        </div>
                                        <div class="ml-3 mr-auto">
                                            <span class="username "><a id="<?php echo $data['id_pengguna'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="mini_profil"><?php echo $data['nama_pengguna']; ?></a></span>
                                            <div class="flex text-gray-600 truncate text-xs mt-1"><span class="mx-1">•</span>Shared publicly : Tgl <?php echo $data['tanggal']; ?></div>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="file  mx-auto ">
                                            <a href="" class="w-2/5 file__icon file__icon--file mx-auto">
                                                <?php

                                                if ($data['id_jenis'] == 1) {
                                                    $url = 'berkas/' . $divisib . '/video/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="film"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 2) {
                                                    $url = 'berkas/' . $divisib . '/document/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="type"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 3) {
                                                    $url = 'berkas/' . $divisib . '/audio/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="music"></i></div>

                                                <?php

                                                } elseif ($data['id_jenis'] == 4) {
                                                    $url = 'berkas/' . $divisib . '/lain/'; ?>
                                                    <div class="file__icon__file-name"><i data-feather="list"></i></div>

                                                <?php

                                                }

                                                ?>
                                            </a>
                                        </div>
                                        <a href="" class="block font-medium text-base mt-5"><?php echo $data['nama']; ?></a>
                                    </div>
                                    <div class="flex items-center px-5 py-3 border-t border-gray-200 dark:border-dark-5">
                                        <a id="<?= $data['id_berkas'] ?>" name="lihat" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="tooltip flex items-center mr-2 block p-2 transition duration-300 ease-in-out bg-theme-17 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md lihat " title="Lihat" data-url="<?= $url; ?>"> <i data-feather="eye" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-14 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md detail tooltip" title="Detail" > <i data-feather="book-open" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#checksumModal" data-url="<?= $url . $data['file'] ?>" class="flex items-center mr-2  block p-2 transition duration-300 ease-in-out bg-theme-18 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md kode tooltip" title="Checksum"> <i data-feather="key" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" name="unduh" href="<?= '../'.$url.$data['file']; ?>" download data-toggle="modal" data-target="#button-modal-preview" class="flex items-center block p-2 transition duration-300 ease-in-out bg-theme-30 dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md unduh tooltip" title="Download" > <i data-feather="share" class="w-4 h-4"></i></a>
                                        <a id="<?= $data['id_berkas'] ?>" href="javascript:;" data-toggle="modal" data-target="#button-modal-preview" class="w-8 h-8 flex items-center justify-center rounded-full bg-theme-1 text-white ml-auto comments tooltip" title="Comments" data-url="<?= $data['id_pengguna'] ?>" > <i data-feather="message-square" class="w-3 h-3"></i> </a>

                                    </div>
                                    <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
                                        <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                                            <div  class="mr-2"> Views: <span id ="<?= $data['id_berkas'];?>_view_count" class="font-medium"><?php echo $data['view']; ?></span> </div>
                                            <?php 
                                                $perintah = "SELECT COUNT(*) AS jml
                                                            FROM tb_komentar 
                                                            WHERE tb_komentar.id_berkas='".$data['id_berkas']."'";
                                                $sqltotal = mysqli_query($mysqli, $perintah);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalcomment = $total['jml'];
                                            ?> 
                                            <div class="mr-2"> Comment: <span class="font-medium"><?php echo $totalcomment ?></span> </div>
                                            <div class="ml-auto"> Download: <span id ="<?= $data['id_berkas'];?>_download_count" class="font-medium"><?php echo $data['download']; ?></span> </div>
                                        </div>
                                        <form class="w-full flex items-center mt-3" method="POST" action="">
                                            <div class="w-8 h-8 flex-none image-fit mr-3">
                                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="../img/foto/<?php echo $foto; ?>">
                                            </div>
                                            <div class="flex-1 relative text-gray-700 mr-3">
                                                <input class="hidden" type="text" name="id_berkas" value="<?= $data['id_berkas'];  ?>" />
                                                <input type="text" class="input w-full rounded-full bg-gray-200 pr-10 placeholder-theme-13" name="comment" placeholder="Post a comment...">
                                                
                                            </div>
                                            <div class="w-8 h-8 flex-none image-fit ">
                                                <button type="submit" name="submit" class="intro-x w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 text-gray-600 ml-auto " value=""> <i data-feather="send" class="w-3 h-3"></i> </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                        <?php
                                $total++;
                            }
                        }
                        ?>
                        <!-- END: Blog Layout -->
                    </div>
                </div>
            </div>
          </div>
          <div class="hidden" id="tab-edit-profil">
            <div class="pos intro-y grid grid-cols-12 gap-5 " >
                <div class="intro-y col-span-12">
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                 EDIT PROFIL
                            </h2>
                        </div>
                        <div class="p-5">
                            
                                <form class="grid grid-cols-12 gap-5" method="POST" enctype="multipart/form-data" action="" >
                                    <div class="col-span-12 xl:col-span-4">
                                        <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                                            <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                <img id="output" name="output"class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="../img/foto/<?= $foto?>">
                                                <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="col-span-12 xl:col-span-8">
                                        <div class="mt-3">
                                            <label>Display Name</label>
                                            <input type="text" name="nama" id="nama" class="input w-full border bg-gray-100 mt-2" placeholder="Input text..." value="<?=$nama;?>" />
                                        </div>
                                        <div class="mt-3">
                                            <label>Foto</label>
                                            <div class="fallback mt-3"> <input name="input-file" id="input-file" type="file"onchange="loadFile(event)"> </div>
                                        </div>
                                        <button type="submit" name="submit" value="update-profil" class="button w-20 bg-theme-1 text-white mt-3">Save</button>
                                    </div>
                                </form>  
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                  URL.revokeObjectURL(output.src) // free memory
                                }
                              };
                            </script>
                        </div>
                    </div>
                    <!-- END: Display Information -->
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
     function changeAtiveTab(event,tabID){
    let element = event.target;
    while(element.nodeName !== "A"){
      element = element.parentNode;
    }
    ulElement = element.parentNode.parentNode;
    aElements = ulElement.querySelectorAll("li > a");
    tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
    for(let i = 0 ; i < aElements.length; i++){
      aElements[i].classList.remove("text-white");
      aElements[i].classList.remove("bg-gray-600");
      
      aElements[i].classList.add("bg-white");
      tabContents[i].classList.add("hidden");
      tabContents[i].classList.remove("block");
    }
    
    element.classList.remove("bg-white");
    
    element.classList.add("bg-gray-600");
    document.getElementById(tabID).classList.remove("hidden");
    document.getElementById(tabID).classList.add("block");
  }
    const sideHome = document.getElementById('side-home');
    const sideDashboard = document.getElementById('side-dashboard');
    const sideBerkas = document.getElementById('side-berkas');
    const sideUpload = document.getElementById('side-upload');
    const sideProfile = document.getElementById('side-profile');
    const sidePrivate = document.getElementById('side-private');
    const sidePublic = document.getElementById('side-public');
    

    sideHome.classList.remove('side-menu--active');
    sideDashboard.classList.remove('side-menu--active');
    sideBerkas.classList.remove('side-menu--active');
    sideUpload.classList.remove('side-menu--active');
    sideProfile.classList.add('side-menu--active');
    sidePrivate.classList.remove('side-menu--active');
    sidePublic.classList.remove('side-menu--active');
</script>