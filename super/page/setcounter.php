<?php
 require '../../config/db_sql.php';
if (isset($_POST['act'])) {
	if ($_POST['act'] == 1) {
		
		$id_file = $_POST['id'];
		$query = "UPDATE tb_berkas SET view=view+1 WHERE id_berkas=$id_file";
		$sql = mysqli_query($mysqli, $query);
		if ($sql) {
			$query = "SELECT tb_berkas.view FROM tb_berkas WHERE id_berkas=$id_file";
			$sql = mysqli_query($mysqli, $query);
			$update_view=mysqli_fetch_assoc($sql);
			echo $update_view['view'];
		}
	} elseif ($_POST['act'] == 2) {

		$id_file = $_POST['id'];
		$query = "UPDATE tb_berkas SET download=download+1 WHERE id_berkas=$id_file";
		$sql = mysqli_query($mysqli, $query);
		if ($sql) {
			$query = "SELECT tb_berkas.download FROM tb_berkas WHERE id_berkas=$id_file";
			$sql = mysqli_query($mysqli, $query);
			$update_download=mysqli_fetch_assoc($sql);
			echo $update_download['download'];
		}
	}
}

?>