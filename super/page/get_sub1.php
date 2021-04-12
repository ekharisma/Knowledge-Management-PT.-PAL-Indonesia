<?php
	require '../config/db_sql.php';
	$provinsi = $_POST['provinsi'];
 
	echo "<option value=''>Pilih Kabupaten</option>";
 
	$query = "SELECT * FROM sub1_kategori WHERE kategori_id=? ORDER BY sub1_kategori_id ASC";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("i", $provinsi);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['sub1_kategori_id'] . "'>" . $row['sub1_kategori_nama'] . "</option>";
	}
?>