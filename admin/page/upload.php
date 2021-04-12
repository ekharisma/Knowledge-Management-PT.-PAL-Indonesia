<?php

date_default_timezone_set('Asia/Jakarta');
$divisi = $_SESSION['id_divisi'];
echo $id_pengguna;

if (isset($_POST['upload'])) {
  var_dump($_FILES['berkas']['name']);

  $kategori_id    = $_POST['kategori'];
  $sub1_kategori_id    = $_POST['sub1_kategori'];
  $sub2_kategori_id    = $_POST['sub2_kategori'];
  $sub3_kategori_id    = $_POST['sub3_kategori'];
  $sub4_kategori_id    = $_POST['sub4_kategori'];

  $kat            = $_POST['kat'];
  $nama           = $_POST['nama'];
  $deskripsi      = $_POST['deskripsi'];
  $jam            = date('l, h:i:s a');
  $tanggal        = date('Y-m-d');

  $name           = $_FILES['berkas']['name'];
  $type           = $_FILES['berkas']['type'];
  $size           = $_FILES['berkas']['size'];
  $tmp_name       = $_FILES['berkas']['tmp_name'];

  $nama_baru    = str_replace(".", "_", str_replace(" ", "_", $name));

  $explode        = explode(".", $name);
  $ekstensi       = strtolower(end($explode));
  $baru           = uniqid(rand()) . "_" . $nama_baru . "." . $ekstensi;
  $path           = "../berkas/";


  if (($ekstensi == 'mkv') || ($ekstensi == 'mp4') || ($ekstensi == '3gp')) {
    // var_dump($ekstensi . " " . $size);
    if ($size < 1000000000) {
      $video = $path . $divisib . "/video/" . $baru;
      if (move_uploaded_file($tmp_name, $video)) {
        //$copy = "../"  . $divisi . "video/" . $baru;
        //copy($video, $copy);
        $query = mysqli_query($mysqli, "INSERT INTO tb_berkas VALUES ('', '$nama', '$baru', '$deskripsi', '$size', '$jam', '$tanggal', 1, '$id_pengguna', '$kat', '0', '0','$kategori_id','$sub1_kategori_id','$sub2_kategori_id','$sub3_kategori_id','$sub4_kategori_id')");
        if ($query) {
          echo "<script language='javascript'>alert('Berkas video berhasil di upload'); document.location='index.php';</script>";
        }
      } else {
?>
        <script type="text/javascript">
          alert("Upload video gagal");
        </script>
      <?php echo "<script>window.history.back();</script>";
      }
    } else {
      ?>
      <script type="text/javascript">
        alert("Ukuran video terlalu besar");
      </script>
      <?php echo "<script>window.history.back();</script>";
    }
  } elseif (($ekstensi == 'docx') || ($ekstensi == 'xlsx') || ($ekstensi == 'pptx') || ($ekstensi == 'pdf')) {
    if ($size < 70000000) { //70mb
      $document = $path . $divisib . "/document/" . $baru;
      if (move_uploaded_file($tmp_name, $document)) {
       //$copy = "../"  . $divisi . "document/" . $baru;
        //copy($document, $copy);
        $query = mysqli_query($mysqli, "INSERT INTO tb_berkas VALUES ('', '$nama', '$baru', '$deskripsi', '$size', '$jam', '$tanggal', 2, '$id_pengguna', '$kat', '0', '0','$kategori_id','$sub1_kategori_id','$sub2_kategori_id','$sub3_kategori_id','$sub4_kategori_id')");
        if ($query) {
          echo "<script language='javascript'>alert('Berkas document berhasil di upload'); document.location='index.php';</script>";
        }
      } else {
        echo "gagal";
      ?>
        <script type="text/javascript">
          alert("Upload dokumen gagal");
        </script>
      <?php echo "<script>window.history.back();</script>";
      }
    } else {
      ?>
      <script type="text/javascript">
        alert("Ukuran Dokumen terlalu besar");
      </script>
      <?php echo "<script>window.history.back();</script>";
    }
  } elseif (($ekstensi == 'mp3') || ($ekstensi == 'wav') || ($ekstensi == 'wma')) {
    if ($size < 1000000000) {
      $audio = $path . $divisib . "/audio/" . $baru;
      if (move_uploaded_file($tmp_name, $audio)) {
        //$copy = "../"  . $divisi . "audio/" . $baru;
        //copy($audio, $copy);
        $query = mysqli_query($mysqli, "INSERT INTO tb_berkas VALUES ('', '$nama', '$baru', '$deskripsi', '$size', '$jam', '$tanggal', 3, '$id_pengguna', '$kat', '0', '0','$kategori_id','$sub1_kategori_id','$sub2_kategori_id','$sub3_kategori_id','$sub4_kategori_id')");
        if ($query) {
          echo "<script language='javascript'>alert('Berkas audio berhasil di upload'); document.location='index.php';</script>";
        }
      } else {
      ?>
        <script type="text/javascript">
          alert("Upload audio gagal");
        </script>
      <?php echo "<script>window.history.back();</script>";
      }
    } else {
      ?>
      <script type="text/javascript">
        alert("Ukuran audio terlalu besar");
      </script>
      <?php echo "<script>window.history.back();</script>";
    }
  } else {
    if ($size < 1000000000) {
      $lain = $path . $divisib . "/lain/" . $baru;
      if (move_uploaded_file($tmp_name, $lain)) {
        //$copy = "../"  . $divisi . "lain/" . $baru;
        //copy($lain, $copy);
        $query = mysqli_query($mysqli, "INSERT INTO tb_berkas VALUES ('', '$nama', '$baru', '$deskripsi', '$size', '$jam', '$tanggal', 4, '$id_pengguna', '$kat', '0', '0','$kategori_id','$sub1_kategori_id','$sub2_kategori_id','$sub3_kategori_id','$sub4_kategori_id')");
        var_dump($query);
        if ($query) {
          echo "<script language='javascript'>alert('Berkas lain berhasil di upload'); document.location='index.php';</script>";
        }
      } else {
      ?>
        <script type="text/javascript">
          alert("Upload File gagal <?php echo  $lain; ?>");
        </script>
      <?php echo "<script>window.history.back();</script>";
      }
    } else {
      ?>
      <script type="text/javascript">
        alert("Ukuran file terlalu besar");
      </script>
<?php echo "<script>window.history.back();</script>";
    }
  }
}

?>
<title><?= $title ?></title>
<div class="intro-y flex items-center ">
  <h2 class="text-xl mt-3">
    Halaman Upload
  </h2>
</div>
<form method="POST" enctype="multipart/form-data" action="">
  <div class="grid grid-cols-5 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
      <!-- BEGIN: Form Layout -->
      <div class="intro-y box p-5">
        <div class="">
          <label>Category</label>
          <div class="mt-2">
            <select data-placeholder="Select your favorite actors" name="kat" class="tail-select w-full" single>
              <option value="0">Biasa</option>
              <option value="1">Private</option>
            </select>
          </div>
        </div>
        <div class="mt-3">
          <label>Nama</label>
          <input type="text" name="nama" class="input w-full border mt-2" placeholder="Input text">
        </div>
        <div class="mt-3">
          <label>Berkas</label>
          <div class="fallback mt-3"> <input name="berkas" id="berkas" type="file" /> </div>
        </div>
        <?php 
          $sql = "SELECT * FROM kategori";
          $kategori = $mysqli->query($sql);

          if (isset($_POST['kategori_id'])) {
              $kategori_id = $_POST['kategori_id'];
              $query = mysqli_query($mysqli, "SELECT * FROM sub1_kategori WHERE sub1_kategori.kategori_id='".$kategori_id."'");
              while ($data=mysqli_fetch_assoc($query)) {
                  echo "<option value='" . $data['sub1_kategori_id'] . "'>" . $data['sub1_kategori_nama'] . "</option>";
              }
          }

        ?>
        <div class="intro-y col-span-12 sm:col-span-6 mt-4">
          <select id="kategori" name="kategori" class="input w-full border flex-1">
            <option value="0">--Pilih Kategori--</option>
              <?php foreach ($kategori as $kat) : ?>
                <?php //echo $kat['kategori_id']; ?>
                <option value="<?= $kat['kategori_id']; ?>"><?= $kat['kategori_nama']; ?></option>
              <?php endforeach ?>
          </select>
        </div>
        <div class="intro-y col-span-12 sm:col-span-6 mt-4">
          <select id="sub1_kategori" name="sub1_kategori" class="input w-full border flex-1">
            <option value="0">--Pilih sub 1 kategori--</option>
          </select>
        </div>
        <div class="intro-y col-span-12 sm:col-span-6 mt-4">
          <select id="sub2_kategori" name="sub2_kategori" class="input w-full border flex-1">
            <option value="0">--Pilih sub 2 kategori--</option>
          </select>
        </div>
        <div class="intro-y col-span-12 sm:col-span-6 mt-4">
          <select id="sub3_kategori" name="sub3_kategori" class="input w-full border flex-1">
            <option value="0">--Pilih sub 3 kategori--</option>
          </select>
        </div>
        <div class="intro-y col-span-12 sm:col-span-6 mt-4">
          <select id="sub4_kategori" name="sub4_kategori" class="input w-full border flex-1">
            <option value="0">--Pilih sub 4 kategori--</option>
          </select>
        </div>
        <div class="mt-3">
          <label>Deskripsi</label>
          <input type="text" name="deskripsi" class="input w-full border mt-2" placeholder="Input text">
        </div>

        <div class="items-center modal_center text-center mt-5">
          <button type="submit" action="submit" name="upload" class="button w-24 bg-theme-1 modal_center text-center text-white">Upload</button>
        </div>
      </div>
</form>
<!-- END: Form Layout -->
</div>
</div>

<script src="../dist/js/upload.js"></script>
<script>
const sideHome = document.getElementById('side-home');
const sideDashboard = document.getElementById('side-dashboard');
const sideBerkas = document.getElementById('side-berkas');
const sideUpload = document.getElementById('side-upload');
const sideProfile = document.getElementById('side-profile');
const sidePrivate = document.getElementById('side-private');
const sidePublic = document.getElementById('side-public');
const sideKategori= document.getElementById('side-kategori');

sideHome.classList.remove('side-menu--active');
sideDashboard.classList.remove('side-menu--active');
sideBerkas.classList.remove('side-menu--active');
sideUpload.classList.add('side-menu--active');
sideProfile.classList.remove('side-menu--active');
sidePrivate.classList.remove('side-menu--active');
sidePublic.classList.remove('side-menu--active');
sideKategori.classList.remove('side-menu--active');
</script>