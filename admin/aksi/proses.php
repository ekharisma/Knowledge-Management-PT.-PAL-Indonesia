<?php

include('../koneksi/config.php');

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['comment'])) {

    $akses             = $_GET['akses'];
    $id             = $_GET['id'];

    $nama             = $_POST['komentar'];
    $tanggal        = date('Y-m-d');
    $jam            = date('l, h:i:s a');
    $id_berkas         = $_POST['berkas'];
    $id_pengguna     = $_POST['pengguna'];

    $id_jenis         = $_POST['jenis'];

    $query = mysqli_query($conn, "INSERT INTO tb_komentar VALUES ('', '$nama', '$tanggal', '$jam', '$id_berkas', '$id_pengguna')");

    if ($query) {

        if ($akses == 1) {

?>
            <script type="text/javascript">
                alert("Berthasil memberikan komentar!");
            </script>
        <?php echo "<script>window.history.back();</script>";
        } else {

        ?>
            <script type="text/javascript">
                alert("Berthasil memberikan komentar!");
            </script>
<?php echo "<script>window.history.back();</script>";
        }
    } else {

        echo "Gagal";
    }
}

?>