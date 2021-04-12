<title><?= $title ?></title>
<!-- BEGIN: Main Content -->

<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Blog Layout -->
    <div class="intro-y col-span-12 md:col-span-6  xl:col-span-12 pb-5 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto=">
                <a href="" class="text-lg  font-medium mr-auto">DOCUMENT CLASIFICATION</a> 
            </div>
        </div>
        <div class="intro-y grid grid-cols-12 gap-6 mt-5">
            <div class="group inline-block  col-span-3  xl:col-span-12">
              <button
                class="outline-none focus:outline-none border px-3 py-1 bg-white rounded-sm flex items-center min-w-32"
              >
                <span class="pr-1 font-semibold flex-1"><a href="index.php?file-kategori&turunan=0&id=1">MAIN PROSES</a></span>
                <span>
                  <svg
                    class="fill-current h-4 w-4 transform group-hover:-rotate-180
                    transition duration-150 ease-in-out"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                  </svg>
                </span>
              </button>
              <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                <?php

                    $query = mysqli_query($mysqli, "SELECT sub1_kategori.sub1_kategori_id, sub1_kategori.sub1_kategori_nama FROM sub1_kategori, kategori WHERE sub1_kategori.kategori_id = kategori.kategori_id AND kategori.kategori_id = 1");

                    while ($data = mysqli_fetch_array($query)) { 
                ?>
                <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                  <button class="w-full text-left flex items-center outline-none focus:outline-none">
                        <?php 
                            $querytotal = "SELECT COUNT(*) AS jml
                                        FROM tb_berkas WHERE tb_berkas.sub1_kategori_id='".$data['sub1_kategori_id']."'";
                            $sqltotal = mysqli_query($mysqli, $querytotal);
                            $total = mysqli_fetch_assoc($sqltotal);
                            $totalfile = $total['jml'];
                        ?>
                        <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=1&id=<?php echo $data['sub1_kategori_id']; ?>"><?= $data['sub1_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                        <span class="mr-auto">
                          <svg
                            class="fill-current h-4 w-4
                            transition duration-150 ease-in-out"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                          </svg>
                        </span>
                  </button>
                  <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32">
                    <?php 
                    $query1 = mysqli_query($mysqli, "SELECT sub2_kategori.sub2_kategori_id, sub2_kategori.sub2_kategori_nama FROM sub2_kategori, sub1_kategori WHERE sub2_kategori.sub1_kategori_id = sub1_kategori.sub1_kategori_id AND sub1_kategori.sub1_kategori_id = '".$data['sub1_kategori_id']."'");
                    while($data1=mysqli_fetch_array($query1)){?>
                        <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                          <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                            <?php 
                                $querytotal = "SELECT COUNT(*) AS jml
                                            FROM tb_berkas WHERE tb_berkas.sub2_kategori_id='".$data1['sub2_kategori_id']."'";
                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                $total = mysqli_fetch_assoc($sqltotal);
                                $totalfile = $total['jml'];
                            ?>
                            <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=2&id=<?php echo $data1['sub2_kategori_id']; ?>"><?= $data1['sub2_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                            <span class="mr-auto">
                              <svg
                                class="fill-current h-4 w-4
                                transition duration-150 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                />
                              </svg>
                            </span>
                          </button>
                          <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32 ">
                            <?php 
                            $query2 = mysqli_query($mysqli, "SELECT sub3_kategori.sub3_kategori_id, sub3_kategori.sub3_kategori_nama FROM sub3_kategori, sub2_kategori WHERE sub3_kategori.sub2_kategori_id = sub2_kategori.sub2_kategori_id AND sub3_kategori.sub2_kategori_id = '".$data1['sub2_kategori_id']."'");           while($data2=mysqli_fetch_array($query2)){?>
                                <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                  <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                                    <?php 
                                        $querytotal = "SELECT COUNT(*) AS jml
                                                        FROM tb_berkas WHERE tb_berkas.sub3_kategori_id='".$data2['sub3_kategori_id']."'";
                                        $sqltotal = mysqli_query($mysqli, $querytotal);
                                        $total = mysqli_fetch_assoc($sqltotal);
                                        $totalfile = $total['jml'];
                                    ?>
                                    <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=3&id=<?php echo $data2['sub3_kategori_id']; ?>"><?= $data2['sub3_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                                    <span class="mr-auto">
                                      <svg
                                        class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                      >
                                        <path
                                          d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                        />
                                      </svg>
                                    </span>
                                  </button>
                                  <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32 ">
                                      <?php
                                        $query3 = mysqli_query($mysqli, "SELECT sub4_kategori.sub4_kategori_id, sub4_kategori.sub4_kategori_nama FROM sub4_kategori, sub3_kategori WHERE sub4_kategori.sub3_kategori_id = sub3_kategori.sub3_kategori_id AND sub4_kategori.sub3_kategori_id = '".$data2['sub3_kategori_id']."'");
                                        while($data3=mysqli_fetch_array($query3)){?>
                                        <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                          <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                                            <?php 
                                                $querytotal = "SELECT COUNT(*) AS jml
                                                                FROM tb_berkas WHERE tb_berkas.sub4_kategori_id='".$data3['sub4_kategori_id']."'";
                                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalfile = $total['jml'];
                                            ?>
                                                <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=4&id=<?php echo $data3['sub4_kategori_id']; ?>"><?= $data3['sub4_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                                                <span class="mr-auto">
                                                  <svg
                                                    class="fill-current h-4 w-4
                                                    transition duration-150 ease-in-out"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                  >
                                                    <path
                                                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                                    />
                                                  </svg>
                                                </span>
                                            </button>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php }?>
                  </ul>
                </li>
                <?php }?>
              </ul>
            </div>
            <div class="group inline-block  col-span-3 xl:col-span-12 ">
              <button
                class="outline-none focus:outline-none border px-3 py-1 bg-white rounded-sm flex items-center min-w-32"
              >
                <span class="pr-1 font-semibold flex-1"><a href="index.php?file-kategori&turunan=0&id=2">ENEBLER PROSES</a></span>
                <span>
                  <svg
                    class="fill-current h-4 w-4 transform group-hover:-rotate-180
                    transition duration-150 ease-in-out"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                    />
                  </svg>
                </span>
              </button>
              <ul class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
                <?php

                    $query = mysqli_query($mysqli, "SELECT sub1_kategori.sub1_kategori_id, sub1_kategori.sub1_kategori_nama FROM sub1_kategori, kategori WHERE sub1_kategori.kategori_id = kategori.kategori_id AND kategori.kategori_id = 2");

                    while ($data = mysqli_fetch_array($query)) { 
                ?>
                <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                  <button class="w-full text-left flex items-center outline-none focus:outline-none">
                        <?php 
                            $querytotal = "SELECT COUNT(*) AS jml
                                        FROM tb_berkas WHERE tb_berkas.sub1_kategori_id='".$data['sub1_kategori_id']."'";
                            $sqltotal = mysqli_query($mysqli, $querytotal);
                            $total = mysqli_fetch_assoc($sqltotal);
                            $totalfile = $total['jml'];
                        ?>
                        <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=1&id=<?php echo $data['sub1_kategori_id']; ?>"><?= $data['sub1_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                        <span class="mr-auto">
                          <svg
                            class="fill-current h-4 w-4
                            transition duration-150 ease-in-out"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                          </svg>
                        </span>
                  </button>
                  <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32">
                    <?php 
                    $query1 = mysqli_query($mysqli, "SELECT sub2_kategori.sub2_kategori_id, sub2_kategori.sub2_kategori_nama FROM sub2_kategori, sub1_kategori WHERE sub2_kategori.sub1_kategori_id = sub1_kategori.sub1_kategori_id AND sub1_kategori.sub1_kategori_id = '".$data['sub1_kategori_id']."'");
                    while($data1=mysqli_fetch_array($query1)){?>
                        <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                          <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                            <?php 
                                $querytotal = "SELECT COUNT(*) AS jml
                                            FROM tb_berkas WHERE tb_berkas.sub2_kategori_id='".$data1['sub2_kategori_id']."'";
                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                $total = mysqli_fetch_assoc($sqltotal);
                                $totalfile = $total['jml'];
                            ?>
                            <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=2&id=<?php echo $data1['sub2_kategori_id']; ?>"><?= $data1['sub2_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                            <span class="mr-auto">
                              <svg
                                class="fill-current h-4 w-4
                                transition duration-150 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                              >
                                <path
                                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                />
                              </svg>
                            </span>
                          </button>
                          <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32 ">
                            <?php 
                            $query2 = mysqli_query($mysqli, "SELECT sub3_kategori.sub3_kategori_id, sub3_kategori.sub3_kategori_nama FROM sub3_kategori, sub2_kategori WHERE sub3_kategori.sub2_kategori_id = sub2_kategori.sub2_kategori_id AND sub3_kategori.sub2_kategori_id = '".$data1['sub2_kategori_id']."'");           while($data2=mysqli_fetch_array($query2)){?>
                                <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                  <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                                    <?php 
                                        $querytotal = "SELECT COUNT(*) AS jml
                                                        FROM tb_berkas WHERE tb_berkas.sub3_kategori_id='".$data2['sub3_kategori_id']."'";
                                        $sqltotal = mysqli_query($mysqli, $querytotal);
                                        $total = mysqli_fetch_assoc($sqltotal);
                                        $totalfile = $total['jml'];
                                    ?>
                                    <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=3&id=<?php echo $data2['sub3_kategori_id']; ?>"><?= $data2['sub3_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                                    <span class="mr-auto">
                                      <svg
                                        class="fill-current h-4 w-4
                                        transition duration-150 ease-in-out"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                      >
                                        <path
                                          d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                        />
                                      </svg>
                                    </span>
                                  </button>
                                  <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32 ">
                                      <?php
                                        $query3 = mysqli_query($mysqli, "SELECT sub4_kategori.sub4_kategori_id, sub4_kategori.sub4_kategori_nama FROM sub4_kategori, sub3_kategori WHERE sub4_kategori.sub3_kategori_id = sub3_kategori.sub3_kategori_id AND sub4_kategori.sub3_kategori_id = '".$data2['sub3_kategori_id']."'");
                                        while($data3=mysqli_fetch_array($query3)){?>
                                        <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                          <button  class="w-full text-left flex items-center outline-none focus:outline-none">
                                            <?php 
                                                $querytotal = "SELECT COUNT(*) AS jml
                                                                FROM tb_berkas WHERE tb_berkas.sub4_kategori_id='".$data3['sub4_kategori_id']."'";
                                                $sqltotal = mysqli_query($mysqli, $querytotal);
                                                $total = mysqli_fetch_assoc($sqltotal);
                                                $totalfile = $total['jml'];
                                            ?>
                                                <span class="pr-1 flex-1"><a href="index.php?file-kategori&turunan=4&id=<?php echo $data3['sub4_kategori_id']; ?>"><?= $data3['sub4_kategori_nama']?> ( <?= $totalfile; ?> )</a></span>
                                                <span class="mr-auto">
                                                  <svg
                                                    class="fill-current h-4 w-4
                                                    transition duration-150 ease-in-out"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                  >
                                                    <path
                                                      d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                                    />
                                                  </svg>
                                                </span>
                                            </button>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php }?>
                  </ul>
                </li>
                <?php }?>
              </ul>
            </div>

            <style>
              /* since nested groupes are not supported we have to use 
                 regular css for the nested dropdowns 
              */
              li>ul                 { transform: translatex(100%) scale(0) }
              li:hover>ul           { transform: translatex(101%) scale(1) }
              li > button svg       { transform: rotate(-90deg) }
              li:hover > button svg { transform: rotate(-270deg) }

              /* Below styles fake what can be achieved with the tailwind config
                 you need to add the group-hover variant to scale and define your custom
                 min width style.
                 See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
                 for implementation with config file
              */
              .group:hover .group-hover\:scale-100 { transform: scale(1) }
              .group:hover .group-hover\:-rotate-180 { transform: rotate(180deg) }
              .scale-0 { transform: scale(0) }
              .min-w-32 { min-width: 15rem }
            </style>
        </div>
    </div>
    
    <!-- END: Blog Layout -->
</div>
<!-- END: Main Content -->