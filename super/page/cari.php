<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

$idn = $_SESSION['id_divisi'];
if (isset($_GET['keyword-all'])) {

	$keyword = $_GET['keyword-all'];

}

$querytotal = "SELECT COUNT(*) AS jml
			FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_berkas.nama LIKE '%$keyword%' ORDER BY tanggal desc, jam desc";


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



$statement = "SELECT * FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_berkas.nama LIKE '%$keyword%' ORDER BY tanggal desc, jam desc
	LIMIT $awalData,$jumlahDataPerhalaman";



$query = mysqli_query($mysqli, $statement);

?>

<title><?= $title ?></title>

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">
		Search File | File page ( Total <?php echo  $totalfile; ?> Files)
	</h2>
</div>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
	<div class="intro-y col-span-12">
		<div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
			<!-- BEGIN: Blog Layout -->
			<?php
			$total = 0;
			while ($data = mysqli_fetch_assoc($query)) {
				$ddiv = str_replace(" ", "", $data['divisi']);

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
								$perintah = "SELECT tb_divisi.divisi
									FROM tb_divisi WHERE tb_divisi.id_divisi='".$data['id_divisi']."'";
								$queryperintah = mysqli_query($mysqli, $perintah);
								$dataurl = mysqli_fetch_assoc($queryperintah);
								$divisiaaa = str_replace(" ", "", $dataurl['divisi']);
								if ($data['id_jenis'] == 1) {
									$url = 'berkas/' . $divisiaaa . '/video/'; ?>
									<div class="file__icon__file-name"><i data-feather="film"></i></div>

								<?php

								} elseif ($data['id_jenis'] == 2) {
									$url = 'berkas/' . $divisiaaa . '/document/'; ?>
									<div class="file__icon__file-name"><i data-feather="type"></i></div>

								<?php

								} elseif ($data['id_jenis'] == 3) {
									$url = 'berkas/' . $divisiaaa . '/audio/'; ?>
									<div class="file__icon__file-name"><i data-feather="music"></i></div>

								<?php

								} elseif ($data['id_jenis'] == 4) {
									$url = 'berkas/' . $divisiaaa . '/lain/'; ?>
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
			?>
			<!-- END: Blog Layout -->
			<!-- BEGIN: Pagination -->
			<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
			<ul class="pagination">
				<?php if($halamanaktif >1): ?>
				<li>
					<a class="pagination__link" href="?keyword-all=<?= $keyword ?>&halaman=<?= $halamanaktif - 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
				</li>
				<?php endif; ?>
				<?php for($i=$start_number;$i <= $end_number;$i++): ?>

					<?php if($i == $halamanaktif): ?> 
						<li> <a class="pagination__link pagination__link--active" href="?keyword-all=<?= $keyword ?>&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
					<?php else : ?>
						<li> <a class="pagination__link" href="?keyword-all=<?= $keyword ?>&halaman=<?= $i; ?>"><?= $i; ?></a> </li>
					<?php endif;  ?>
				<?php endfor; ?>
				<?php if($halamanaktif < $jumlahHalaman): ?>
					<li>
						<a class="pagination__link" href="?keyword-all=<?= $keyword ?>&halaman=<?= $halamanaktif + 1; ?>"> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<!-- END: Pagination -->
		</div>

	</div>
</div>



<script type="text/javascript">
	function counter(idfile, action) {
		// alert(action);
		$.ajax({
			type: "POST",
			url: "page/setCounter.php",
			data: {
				idf: idfile,
				act: action
			},
			beforeSend: function(html) { // this happens before actual call
				// $("#results").html(''); 
			},
			success: function(html) { // this happens after we get results
				// alert(html);		
			}
		});
	}
</script>