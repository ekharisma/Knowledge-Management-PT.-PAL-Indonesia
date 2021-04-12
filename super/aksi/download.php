<?php 

require '../../config/db_sql.php';

if (isset($_GET['id'])) {
	
	$id = $_GET['id'];
	$url = $_GET['url'];
	echo $url;

	$query = mysqli_query($mysqli, "SELECT * FROM tb_berkas WHERE id_berkas = '$id'");

	$row = mysqli_fetch_assoc($query);

	$file = $row['file'];

	$a = $url . $file;

	if (file_exists($file)) {
		
		echo "File telah dihapus <br>";
		echo $url;
		echo $file;

	}

	else {

		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"" . $file . "\"");
		header('Content-Transfer-Encoding: binary');
		$fp = fopen($url . $file, "r");
		$data = fread($fp, filesize($url . $file));
		fclose($fp);
		print $data;

	}
	
}

?>