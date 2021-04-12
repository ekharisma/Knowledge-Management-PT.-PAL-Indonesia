<title><?= $title ?></title>
<!-- BEGIN: Main Content -->

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Blog Layout -->
    <div class="intro-y col-span-12 md:col-span-6  xl:col-span-6 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">MAIN PROSES</a> 
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
        <?php  
            $query = mysqli_query($mysqli, "SELECT sub1_kategori.sub1_kategori_id, sub1_kategori.sub1_kategori_nama FROM sub1_kategori, kategori WHERE sub1_kategori.kategori_id = kategori.kategori_id AND kategori.kategori_id = 1");

            while ($data = mysqli_fetch_array($query)) { 
        ?>
        <ul class="ml-0" >
            <li >   
                <?php 
                    $querytotal = "SELECT COUNT(*) AS jml
                                FROM tb_berkas WHERE tb_berkas.sub1_kategori_id='".$data['sub1_kategori_id']."'";
                    $sqltotal = mysqli_query($mysqli, $querytotal);
                    $total = mysqli_fetch_assoc($sqltotal);
                    $totalfile = $total['jml'];
                ?>
                <a href="index.php?file-kategori&turunan=1&id=<?php echo $data['sub1_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['sub1_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>
                <?php 
                $query1 = mysqli_query($mysqli, "SELECT sub2_kategori.sub2_kategori_id, sub2_kategori.sub2_kategori_nama FROM sub2_kategori, sub1_kategori WHERE sub2_kategori.sub1_kategori_id = sub1_kategori.sub1_kategori_id AND sub1_kategori.sub1_kategori_id = '".$data['sub1_kategori_id']."'");
                while($data1=mysqli_fetch_array($query1)){?>
                    <ul class="list-disc ml-10">
                        <li>
                        <?php 
                            $querytotal = "SELECT COUNT(*) AS jml
                                        FROM tb_berkas WHERE tb_berkas.sub2_kategori_id='".$data1['sub2_kategori_id']."'";
                            $sqltotal = mysqli_query($mysqli, $querytotal);
                            $total = mysqli_fetch_assoc($sqltotal);
                            $totalfile = $total['jml'];
                        ?>
                        <a href="index.php?file-kategori&turunan=2&id=<?php echo $data1['sub2_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                            <div class="truncate mr-auto"><?php echo $data1['sub2_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                            <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                        </a>
                        <?php
                        $query2 = mysqli_query($mysqli, "SELECT sub3_kategori.sub3_kategori_id, sub3_kategori.sub3_kategori_nama FROM sub3_kategori, sub2_kategori WHERE sub3_kategori.sub2_kategori_id = sub2_kategori.sub2_kategori_id AND sub3_kategori.sub2_kategori_id = '".$data1['sub2_kategori_id']."'");
                                                        
                        while($data2=mysqli_fetch_array($query2)){?>
                        <ul class="list-disc ml-10">
                            <li>
                                <?php 
                                    $querytotal = "SELECT COUNT(*) AS jml
                                                    FROM tb_berkas WHERE tb_berkas.sub3_kategori_id='".$data2['sub3_kategori_id']."'";
                                    $sqltotal = mysqli_query($mysqli, $querytotal);
                                    $total = mysqli_fetch_assoc($sqltotal);
                                    $totalfile = $total['jml'];
                                ?>
                                <a href="index.php?file-kategori&turunan=3&id=<?php echo $data2['sub3_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                                    <div class="truncate mr-auto"><?php echo $data2['sub3_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                                </a>
                                 <?php
                                    $query3 = mysqli_query($mysqli, "SELECT sub4_kategori.sub4_kategori_id, sub4_kategori.sub4_kategori_nama FROM sub4_kategori, sub3_kategori WHERE sub4_kategori.sub3_kategori_id = sub3_kategori.sub3_kategori_id AND sub4_kategori.sub3_kategori_id = '".$data2['sub3_kategori_id']."'");
                                    while($data3=mysqli_fetch_array($query3)){?>
                                    <ul class=" ml-10">
                                        <li>
                                            <?php 
                                                $querytotal = "SELECT COUNT(*) AS jml
                                                                                        FROM tb_berkas WHERE tb_berkas.sub4_kategori_id='".$data3['sub4_kategori_id']."'";
                                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalfile = $total['jml'];
                                            ?>
                                            <a href="index.php?file-kategori&turunan=4&id=<?php echo $data3['sub4_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                                                <div class="truncate mr-auto"><?php echo $data3['sub4_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                                                <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                                            </a>
                                        </li>
                                </ul>
                                <?php } ?>        
                            </li>
                        </ul>
                        <?php } ?>        
                        </li>
                    </ul>
                    <?php } ?>    
                    </li>
                </ul>
                <?php } ?>
            </div>
    </div>
    <div class="intro-y col-span-12 md:col-span-6  xl:col-span-6 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">ENEBLER PROSES</a> 
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
        <?php  
            $query = mysqli_query($mysqli, "SELECT sub1_kategori.sub1_kategori_id, sub1_kategori.sub1_kategori_nama FROM sub1_kategori, kategori WHERE sub1_kategori.kategori_id = kategori.kategori_id AND kategori.kategori_id = 2");

            while ($data = mysqli_fetch_array($query)) { 
        ?>
        <ul class="ml-0">
            <li >   
                <?php 
                    $querytotal = "SELECT COUNT(*) AS jml
                                FROM tb_berkas WHERE tb_berkas.sub1_kategori_id='".$data['sub1_kategori_id']."'";
                    $sqltotal = mysqli_query($mysqli, $querytotal);
                    $total = mysqli_fetch_assoc($sqltotal);
                    $totalfile = $total['jml'];
                ?>
                <a href="index.php?file-kategori&turunan=1&id=<?php echo $data['sub1_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['sub1_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>
                <?php 
                $query1 = mysqli_query($mysqli, "SELECT sub2_kategori.sub2_kategori_id, sub2_kategori.sub2_kategori_nama FROM sub2_kategori, sub1_kategori WHERE sub2_kategori.sub1_kategori_id = sub1_kategori.sub1_kategori_id AND sub1_kategori.sub1_kategori_id = '".$data['sub1_kategori_id']."'");
                while($data1=mysqli_fetch_array($query1)){?>
                    <ul class="list-disc ml-10">
                        <li>
                        <?php 
                            $querytotal = "SELECT COUNT(*) AS jml
                                                            FROM tb_berkas WHERE tb_berkas.sub2_kategori_id='".$data1['sub2_kategori_id']."'";
                            $sqltotal = mysqli_query($mysqli, $querytotal);
                            $total = mysqli_fetch_assoc($sqltotal);
                            $totalfile = $total['jml'];
                        ?>
                        <a href="index.php?file-kategori&turunan=2&id=<?php echo $data1['sub2_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                            <div class="truncate mr-auto"><?php echo $data1['sub2_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                            <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                        </a>
                        <?php
                        $query2 = mysqli_query($mysqli, "SELECT sub3_kategori.sub3_kategori_id, sub3_kategori.sub3_kategori_nama FROM sub3_kategori, sub2_kategori WHERE sub3_kategori.sub2_kategori_id = sub2_kategori.sub2_kategori_id AND sub3_kategori.sub2_kategori_id = '".$data1['sub2_kategori_id']."'");
                                                        
                        while($data2=mysqli_fetch_array($query2)){?>
                        <ul class="list-disc ml-10">
                            <li>
                            <?php 
                                $querytotal = "SELECT COUNT(*) AS jml
                                                FROM tb_berkas WHERE tb_berkas.sub3_kategori_id='".$data2['sub3_kategori_id']."'";
                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                $total = mysqli_fetch_assoc($sqltotal);
                                $totalfile = $total['jml'];
                            ?>
                            <a href="index.php?file-kategori&turunan=3&id=<?php echo $data2['sub3_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                                <div class="truncate mr-auto"><?php echo $data2['sub3_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                                <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                            </a>
                             <?php
                                $query3 = mysqli_query($mysqli, "SELECT sub4_kategori.sub4_kategori_id, sub4_kategori.sub4_kategori_nama FROM sub4_kategori, sub3_kategori WHERE sub4_kategori.sub3_kategori_id = sub3_kategori.sub3_kategori_id AND sub4_kategori.sub3_kategori_id = '".$data2['sub3_kategori_id']."'");
                                while($data3=mysqli_fetch_array($query3)){?>
                                <ul class="list-disc ml-10">
                                    <li>
                                    <?php 
                                        $querytotal = "SELECT COUNT(*) AS jml
                                                                                FROM tb_berkas WHERE tb_berkas.sub4_kategori_id='".$data3['sub4_kategori_id']."'";
                                        $sqltotal = mysqli_query($mysqli, $querytotal);
                                        $total = mysqli_fetch_assoc($sqltotal);
                                        $totalfile = $total['jml'];
                                    ?>
                                    <a href="index.php?file-kategori&turunan=4&id=<?php echo $data3['sub4_kategori_id']; ?>" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                                        <div class="truncate mr-auto"><?php echo $data3['sub4_kategori_nama'];echo "  (";echo $totalfile;echo ")"; ?></div>
                                        <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                                    </a>
                                </li>
                            </ul>
                            <?php } ?>        
                            </li>
                        </ul>
                        <?php } ?>        
                        </li>
                    </ul>
                    <?php } ?>    
                    </li>
                </ul>
                <?php } ?>
            </div>
    </div>
    
    <!-- END: Blog Layout -->
</div>
<!-- END: Main Content -->
<script>
const sideHome = document.getElementById('side-home');
const sideDashboard = document.getElementById('side-dashboard');
const sideBerkas = document.getElementById('side-berkas');
const sideUpload = document.getElementById('side-upload');
const sideProfile = document.getElementById('side-profile');
const sidePrivate = document.getElementById('side-private');
const sidePublic = document.getElementById('side-public');
const sideKategori= document.getElementById('side-kategori');

console.log("halo");

sideHome.classList.remove('side-menu--active');
sideDashboard.classList.remove('side-menu--active');
sideBerkas.classList.remove('side-menu--active');
sideUpload.classList.remove('side-menu--active');
sideProfile.classList.remove('side-menu--active');
sidePrivate.classList.remove('side-menu--active');
sidePublic.classList.remove('side-menu--active');
sideKategori.classList.add('side-menu--active');
</script>