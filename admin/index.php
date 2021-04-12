`<?php
  error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
  require '../config/db_sql.php';
  date_default_timezone_set('Asia/Jakarta');
  session_start();
  if (!isset($_SESSION['admin'])) {
    header("Location: ../page/login.php");
  }

  $id_pengguna    = $_SESSION['id_pengguna'];
  $nama           = $_SESSION['nama'];
  $foto           = $_SESSION['foto'];
  $direktorat    = $_SESSION['direktorat'];
  $divisi          = $_SESSION['divisi'];
  $id_divisi          = $_SESSION['id_divisi'];
  $divisib        = str_replace(" ", "", $divisi);

  
  
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
  ?>
<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
  <meta charset="utf-8">
  <link href="../dist/images/logo.svg" rel="shortcut icon">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="LEFT4CODE">
  <!-- <title>Dashboard - Midone - Tailwind HTML Admin Template</title> -->
  <!-- BEGIN: CSS Assets-->
  <link rel="stylesheet" href="../dist/css/app.css" />
  <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="app">
  <!-- BEGIN VIEW MODAL -->
  <div class="modal" id="button-modal-preview">
    <div class="modal__content modal__content--xl p-10 text-center"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
      <div class=container>
        <p>Detail Modal</p>
      </div>
      <div class="px-5 pb-8 text-center mt-5"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-6 text-white">Close</button> </div>
    </div>
  </div>
  <div class='modal' id='delete-modal'>
    <div class='modal__content'>
      <div class='p-5 text-center'> <i data-feather='x-circle' class='w-16 h-16 text-theme-6 mx-auto mt-3'></i>
        <div class='text-3xl mt-5'>Are You Sure?</div>
        <div class='text-gray-600 mt-2'>Deleted file can not be recovered</div>
      </div>
      <div class='px-5 pb-8 text-center'> <button type='button' data-dismiss='modal' class='button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1'>Cancel</button> <button type='button' class='button w-24 bg-theme-6 text-white hapus_btn'>Delete</button> </div>
    </div>
  </div>
  <div class="modal" id="checksumModal">
  <div class="modal__content modal__content--xl p-5 text-center"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
    <div>
      <label>File Checksum</label>
      <input id="internalChecksum" type='teks' class='input w-full border mt-2' value="" placeholder='Checksum Berkas Internal' disabled>
    </div>
    <div id="switch">
      <label class=mt-3 id='checksumLabel'>Upload Eksternal File</label>
      <form id='uploadForm' action='upload.php' method='post' enctype='multipart/form-data'>
        Select image to upload:
        <input type='file' name='file' id='file'>
      </form>
      <button id='submitUpload' type='button' class='button bg-theme-1 text-white mt-5'>Upload File</button>
    </div>
    <button id="compareChekscum" type='button' class='button bg-theme-1 text-white mt-5'>Compare Checskum</button>
    <div class="px-5 pb-8 pt-5 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-6 text-white">Close</button> </div>
  </div>
</div>
  <!-- END VIEW MODAL -->
  <!-- BEGIN: Mobile Menu -->
  <div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
      <a href="" class="flex mr-auto">
        <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="../img/pal.png">
      </a>
      <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
      <li>
        <a id="mobile-home" href="index.php?home" class="menu menu--active">
          <div class="menu__icon"> <i data-feather="home"></i> </div>
          <div class="menu__title"> Home </div>
        </a>
      </li>
      <li>
        <a id="mobile-dashboard" href="index.php?dashboard" class="menu ">
          <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
          <div class="menu__title"> Dashboard </div>
        </a>
      </li>
      <li>
        <a id="mobile-dashboard" href="index.php?kategori" class="menu ">
          <div class="menu__icon"> <i data-feather="list"></i> </div>
          <div class="menu__title"> Category </div>
        </a>
      </li>
      <li>
        <a id="mobile-dashboard" href="index.php?dokument-clasification" class="menu ">
          <div class="menu__icon"> <i data-feather="list"></i> </div>
          <div class="menu__title"> Document Clasification </div>
        </a>
      </li>
      <li>
        <a id="mobile-dashboard" href="index.php?berkas" class="menu ">
          <div class="menu__icon"> <i data-feather="box"></i> </div>
          <div class="menu__title"> File </div>
        </a>
      </li>
      <li>
        <a id="mobile-upload" href="index.php?upload" class="menu">
          <div class="menu__icon"> <i data-feather="sunrise"></i> </div>
          <div class="menu__title"> Upload </div>
        </a>
      </li>
      <li>
        <a id="mobile-profile" href="index.php?profil-detail&id=<?php echo $id_pengguna; ?>&jenis=1" class="user">
          <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
          <div class="menu__title"> Profile </div>
        </a>
      </li>
      <!-- divider menu FILE-->
      <li class="menu__devider my-6"></li>
      <li>
        <a id="mobile-private" href="index.php?private" class="menu">
          <div class="menu__icon"> <i data-feather="lock"></i> </div>
          <div class="menu__title"> Private </div>
        </a>
      </li>
      <li>
        <a id="mobile-public" href="index.php?public" class="menu">
          <div class="menu__icon"> <i data-feather="unlock"></i> </div>
          <div class="menu__title"> Public </div>
        </a>
      </li>
    </ul>
  </div>
  <!-- END: Mobile Menu -->
  <div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
      <a href="" class="intro-x flex items-center pl-5 pt-4">
        <span class="hidden xl:block text-white text-lg ml-3"> PT<span class="font-medium"> PAL Indonesia</span> </span>
      </a>
      <div class="side-nav__devider my-6"></div>
      <ul>
        <li>
          <a id="side-home" href="index.php?home" class="side-menu side-menu--active">
            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
            <div class="side-menu__title"> Home </div>

          </a>
        </li>
        <li>
          <a id="side-dashboard" href="index.php?dashboard" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="hard-drive"></i> </div>
            <div class="side-menu__title"> Dashboard </div>
          </a>
        </li>
        <li>
          <a id="side-kategori" href="index.php?kategori" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="list"></i> </div>
            <div class="side-menu__title"> Category </div>
          </a>
        </li>
        <li>
          <a id="side-berkas" href="index.php?berkas" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="box"></i> </div>
            <div class="side-menu__title"> File </div>
          </a>
        </li>
        <li>
          <a id="side-berkas" href="index.php?dokument-clasification" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="box"></i> </div>
            <div class="side-menu__title"> Document Clasification </div>
          </a>
        </li>
        <li>
          <a id="side-upload" href="index.php?upload" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="sunrise"></i> </div>
            <div class="side-menu__title"> Upload </div>
          </a>
        </li>
        <li>
          <a id="side-profile" href="index.php?profil-detail&id=<?php echo $id_pengguna; ?>&jenis=1" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="user"></i> </div>
            <div class="side-menu__title"> Profile </div>
          </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
          <a id="side-private" href="index.php?private" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="lock"></i> </div>
            <div class="side-menu__title"> Private </div>
          </a>
        </li>
        <li>
          <a id="side-public" href="index.php?public" class="side-menu">
            <div class="side-menu__icon"> <i data-feather="unlock"></i> </div>
            <div class="side-menu__title"> Public</div>
          </a>
        </li>

      </ul>
    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content">
      <!-- BEGIN: Top Bar -->
      <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a  href="" class="breadcrumb--active">Home</a> </div>
        <!-- END: Breadcrumb --nnti figanti dashboradnya -->
        <!-- BEGIN: Search -->
        <div class="intro-x relative mr-3 sm:mr-6">
          <div class="search hidden sm:block">
            <form class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0" method="GET" action="">
               <input type="text" class="search__input input placeholder-theme-13" name="keyword-all" placeholder="Cari...">
              <i data-feather="search" class="search__icon dark:text-gray-300"></i>
            </form>
           
          </div>
          <a class="notification sm:hidden" href=""> <i data-feather="search" class="notification__icon dark:text-gray-300"></i> </a>
        </div>
        <!-- END: Search -->

        <!-- BEGIN: Account Menu -->
        <div class="intro-x dropdown w-8 h-8">
          <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="Midone Tailwind HTML Admin Template" src="../img/foto/<?php echo $foto; ?>">
          </div>
          <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
              <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                <div class="font-medium"><?php echo $nama; ?></div>
                <div class="text-xs text-theme-41 dark:text-gray-600"><?php echo $direktorat; ?></div>
                <div class="text-xs text-theme-41 dark:text-gray-600"><?php echo $divisi; ?></div>
              </div>
              <div class="p-2">
                <a href="index.php?profil-detail&id=<?php echo $id_pengguna; ?>&jenis=1" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
              </div>
              <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                <a href="aksi/logout.php" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Account Menu -->
      </div>
      <!-- END: Top Bar -->
      <!-- BEGIN: Main Content -->
      <?php
      if (isset($_REQUEST['home'])) {
        $title = 'Home';
        include("page/home.php");
      } else if (isset($_REQUEST['video'])) {
        $title = 'File Manager';
        include("page/berkas/video.php");
      } else if (isset($_REQUEST['audio'])) {
        $title = 'File Manager';
        include("page/berkas/audio.php");
      } else if (isset($_REQUEST['berkas'])) {
        $title = 'File Manager';
        include("page/berkas/dokumen.php");
      } else if (isset($_REQUEST['gambar'])) {
        $title = 'File Manager';
        include("page/berkas/gambar.php");
      } else if (isset($_REQUEST['other'])) {
        $title = 'File Manager';
        include("page/berkas/lain.php");
      } else if (isset($_REQUEST['upload'])) {
        $title = 'Upload';
        include("page/upload.php");
      } else if (isset($_REQUEST['public'])) {
        $title = 'Publik';
        include("page/public.php");
      } else if (isset($_REQUEST['private'])) {
        $title = 'Privat';
        include("page/private.php");
      } else if (isset($_REQUEST['profil-detail'])) {
        $title = 'Profil';
        include("page/profil-detail.php");
      } else if (isset($_REQUEST['file'])) {
        $title='Berkas Divisi';
        include("page/file.php");
      } else if (isset($_REQUEST['dashboard'])) {
        $title = 'Dashboard';
        include("page/dashboard.php");
      } else if (isset($_REQUEST['public_detail'])) {
        $title = 'Public - Berkas';
        include("page/public_detail.php");
      } else if (isset($_REQUEST['private_detail'])) {
        $title = 'Privat - Berkas';
        include("page/private-detail.php");
      } else if (isset($_GET['keyword'])) {
        $title = 'File Manager';
        include("page/berkas/dokumen.php");
      } else if (isset($_GET['keyword-audio'])) {
        $title = 'File Manager';
        include("page/berkas/audio.php");
      } else if (isset($_GET['keyword-video'])) {
        $title = 'File Manager';
        include("page/berkas/video.php");
      } else if (isset($_GET['keyword-lain'])) {
        $title = 'File Manager';
        include("page/berkas/lain.php");
      } else if (isset($_GET['keyword-gambar'])) {
        $title = 'File Manager';
        include("page/berkas/gambar.php");
      } else if (isset($_GET['keyword-all'])) {
        $title = 'Search';
        include("page/cari.php");
      } else if (isset($_GET['kategori'])) {
        $title = 'Kategori';
        include("page/kategori.php");
      } else if (isset($_GET['file-kategori'])) {
        $title = 'File Kategori';
        include("page/file-kategori.php");
      } else if (isset($_GET['dokument-clasification'])) {
        $title = 'File Kategori';
        include("page/dokument-clasification.php");
      } else {
        $title = 'Beranda';
        include("page/home.php");
      }

      ?>


      <!-- END: Main Content -->
    </div>
    <!-- END: Content -->
  </div>

  <!-- BEGIN: JS Assets-->

  <script src="../dist/js/app.js"></script>
  <script src="../dist/js/jquery.js"></script>
  <script src="../dist/js/dokumen.js"></script>
  <script src="../dist/js/dashboard.js"></script>
  <!-- <script src="../dist/js/file_interaction.js"></script> -->
  <script src="../dist/js/fileSearch.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script >
    $(document).on("click", ".lihat", function(){
        
        var id = $(this).attr("id");
        var id_view='#'+id+"_view_count"
        //console.log(id_view);
        $.ajax({

          url: 'page/setcounter.php',
          method: 'post',
          data: {
            id: id,
            act:1
          },
          success: function(data) {
            $(id_view).text(data);
            //console.log(data);
          }

        });
        
    });
    $(document).on("click", ".unduh", function(){
        var id = $(this).attr("id");
        var id_view='#'+id+"_download_count"
        //console.log(id_view);
        $.ajax({

          url: 'page/setcounter.php',
          method: 'post',
          data: {
            id: id,
            act:2
          },
          success: function(data) {
            $(id_view).text(data);
            //console.log(data);
          }

        });
    });
   
  </script>
  
  <!-- END: JS Assets-->
</body>

</html>