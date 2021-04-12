<title><?= $title ?></title>

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        HOME PAGE KNOWLEDGE MANAGEMENT
    </h2>
</div>
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Blog Layout -->
    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">DIREKTORAT UTAMA</a>
            </div>
        </div>
        <div class="p-5">
            <div class="h-40 xxl:h-56 image-fit">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="../img/direktorat/direktorat_utama.png">
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
            <?php
            $query = mysqli_query($mysqli, "SELECT tb_divisi.id_divisi, tb_divisi.divisi FROM tb_divisi, tb_direktorat WHERE tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_direktorat.id_direktorat = 5");

            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="index.php?file&id_divisi=<?php echo $data['id_divisi']; ?>&id=5&jenis=1" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['divisi']; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>

            <?php

            }

            ?>

        </div>
    </div>
    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">DIREKTORAT PEMBANGUNAN KAPAL</a>
            </div>
        </div>
        <div class="p-5">
            <div class="h-40 xxl:h-56 image-fit">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="../img/direktorat/direktorat_pembangunan.png">
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
            <?php
            $query = mysqli_query($mysqli, "SELECT tb_divisi.id_divisi, tb_divisi.divisi FROM tb_divisi, tb_direktorat WHERE tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_direktorat.id_direktorat = 1");

            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="index.php?file&id_divisi=<?php echo $data['id_divisi']; ?>&id=1&jenis=1" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['divisi']; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>

            <?php

            }

            ?>

        </div>
    </div>
    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">DIREKTORAT REKUM & HARKAN</a>
            </div>
        </div>
        <div class="p-5">
            <div class="h-40 xxl:h-56 image-fit">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="../img/direktorat/direktorat_rekum.png">
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
            <?php
            $query = mysqli_query($mysqli, "SELECT tb_divisi.id_divisi, tb_divisi.divisi FROM tb_divisi, tb_direktorat WHERE tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_direktorat.id_direktorat = 2");

            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="index.php?file&id_divisi=<?php echo $data['id_divisi']; ?>&id=2&jenis=1" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['divisi']; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>

            <?php

            }

            ?>

        </div>
    </div>
    <div class="intro-y col-span-12  md:col-span-6 xl:col-start-3  xl:col-span-4 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">DIREKTORAT KEUANGAN</a>
            </div>
        </div>
        <div class="p-5">
            <div class="h-40 xxl:h-56 image-fit">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="../img/direktorat/direktorat_keuangan.png">
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
            <?php
            $query = mysqli_query($mysqli, "SELECT tb_divisi.id_divisi, tb_divisi.divisi FROM tb_divisi, tb_direktorat WHERE tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_direktorat.id_direktorat = 3");

            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="index.php?file&id_divisi=<?php echo $data['id_divisi']; ?>&id=3&jenis=1" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['divisi']; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>

            <?php

            }

            ?>

        </div>
    </div>
    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
        <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
            <div class="ml-3 mr-auto">
                <a href="" class="text-lg font-medium mr-auto">DIREKTORAT SDM & UMUM</a>
            </div>
        </div>
        <div class="p-5">
            <div class="h-40 xxl:h-56 image-fit">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="../img/direktorat/direktorat_sdm.png">
            </div>
        </div>
        <div class="p-2 border-t border-gray-200 dark:border-dark-5">
            <?php
            $query = mysqli_query($mysqli, "SELECT tb_divisi.id_divisi, tb_divisi.divisi FROM tb_divisi, tb_direktorat WHERE tb_divisi.id_direktorat = tb_direktorat.id_direktorat AND tb_direktorat.id_direktorat = 4");

            while ($data = mysqli_fetch_assoc($query)) { ?>
                <a href="index.php?file&id_divisi=<?php echo $data['id_divisi']; ?>&id=4&jenis=1" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                    <div class="truncate mr-auto"><?php echo $data['divisi']; ?></div>
                    <i data-feather="chevron-right" class="inset-y-0 right-0 w-16"></i>
                </a>

            <?php

            }

            ?>

        </div>
    </div>

    <!-- END: Blog Layout -->
</div>