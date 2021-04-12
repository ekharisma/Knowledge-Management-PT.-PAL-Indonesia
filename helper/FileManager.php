<?php

class FileManager
{
    public static function ubah_pengguna($id)
    {
        require_once('../config/db_sql.php');
        $sql = "SELECT * FROM tb_pengguna  WHERE tb_pengguna.id_pengguna = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $update = $stmt->get_result();
        //var_dump(mysqli_fetch_assoc($comments));die;
       
        while($data=mysqli_fetch_assoc($update)){
        echo "
                <div class='intro-y col-span-12'>
                    <div class='intro-y box lg:mt-5'>
                        <div class='flex items-center p-5 border-b border-gray-200 dark:border-dark-5'>
                            <h2 class='font-medium text-base mr-auto'>
                                 EDIT PROFIL
                            </h2>
                        </div>
                        <div class='p-5'>
                            
                                <form class='grid grid-cols-12 gap-5' method='POST' enctype='multipart/form-data' action='' >
                                    <div class='col-span-12 xl:col-span-4'>
                                        <div class='border border-gray-200 dark:border-dark-5 rounded-md p-5'>
                                            <div class='w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto'>
                                                <img id='output' name='output' class='rounded-md' alt='Midone Tailwind HTML Admin Template' src='../img/foto/".$data['foto']."'>
                                                <div title='Remove this profile photo?' class='tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2'> <i data-feather='x' class='w-4 h-4'></i> </div>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class='col-span-12 xl:col-span-8'>
                                        <div class='mt-3'>
                                            <label>Display Name</label>
                                            <input type='text' name='id_user' id='id_user' class='input w-full border bg-gray-100 mt-2' placeholder='Input text...' value='".$data['id_pengguna']."' />
                                        </div>
                                        <div class='mt-3'>
                                            <label>Display Name</label>
                                            <input type='text' name='nama' id='nama' class='input w-full border bg-gray-100 mt-2' placeholder='Input text...' value='".$data['nama_pengguna']."' />
                                        </div>
                                        <div class='mt-3'>
                                            <label>Foto</label>
                                            <div class='fallback mt-3'> <input name='input-file' id='input-file' type='file'onchange='loadFile(event)''> </div>
                                        </div>
                                        <div class='mt-3 mx-auto'>
                                          <input id='cb-edit-user' name='cb-edit-user' class='input border border-gray-500' type='checkbox' value='edit-categori' onchange='myFunction()'><label> also edit password </label>
                                        </div>
                                        <div  class='mt-3'>
                                            <label>Password Baru</label>
                                            <input disabled id='password' type='passwor' class='intro-x login__input input input--lg border border-gray-300 block mt-4' name='password' placeholder='Password'>
                                        </div>

                                        <button type='submit' name='submit' value='update-profil' class='button w-20 bg-theme-1 text-white mt-3'>Save</button>
                                    </div>
                                </form>  
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                  URL.revokeObjectURL(output.src) // free memory
                                }
                              };
                            </script>
                            <script>
                            function myFunction() {
                                const val = document.getElementById('cb-edit-user');
                                console.log(val.checked);
                                    if(val.checked){
                                      document.getElementById('password').removeAttribute('disabled');
                                    }
                                    else{
                                      document.getElementById('password').setAttribute('disabled','');
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <!-- END: Display Information -->
                </div>

        ";
         }       
        
        
        $stmt->close();
        $mysqli->close();
    }
    public static function ubah($id)
    {
        require_once('../config/db_sql.php');
        $sql = "SELECT * FROM tb_berkas  WHERE tb_berkas.id_berkas = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $update = $stmt->get_result();
        //var_dump(mysqli_fetch_assoc($comments));die;
       

        echo "<h1>Edit |    | berkas id = ".$id."</h1>";
        $sql = "SELECT * FROM kategori";
          $kategori = $mysqli->query($sql);

          if (isset($_POST['kategori_id'])) {
              $kategori_id = $_POST['kategori_id'];
              $query = mysqli_query($mysqli, "SELECT * FROM sub1_kategori WHERE sub1_kategori.kategori_id='".$kategori_id."'");
              while ($data=mysqli_fetch_assoc($query)) {
                  echo "<option value='" . $data['sub1_kategori_id'] . "'>" . $data['sub1_kategori_nama'] . "</option>";
              }
          }
        //var_dump(mysqli_fetch_assoc($comments));
        while($data=mysqli_fetch_assoc($update)){
            echo "
                
                <form method='POST' enctype='multipart/form-data' action=''>
                  <div class='grid grid-cols-5 gap-6 mt-5'>
                    <div class='intro-y col-span-12 lg:col-span-6'>
                      <!-- BEGIN: Form Layout -->
                      <div class='intro-y box p-5'>
                        <div class='mt-3'>
                          <label class='flex flex-col sm:flex-row'> Nama File <span class='sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600'>Required, at least 2 characters</span> </label>
                          <input type='text' name='nama' class='input w-full border mt-2' placeholder='type here ...' value='".$data['nama']."'>
                        </div>
                        <div class='mt-3'>
                          <label class='flex flex-col sm:flex-row'> File Upload <span class='sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600'>Upload berkas ulang </span> </label>
                          <div class='fallback mt-3'> <input name='berkas' id='berkas' type='file' /> </div>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-3'>
                            <label class='flex flex-col sm:flex-row'>Tipe File<span class='sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600'>Public = 0 , private = 1</span> </label>
                            <select id='tipe-file' name='tipe-file' class='input w-full border flex-1 mt-2'>
                                <option value='".$data['kat']."'>Choose file type</option>
                                <option value='0'>Public</option>
                                <option value='1'>Private</option>
                            </select>
                        </div>
                        <div class='mt-3 items-center'>
                          <input id='cb-edit' name='cb-edit' class='input border border-gray-500' type='checkbox' value='edit-categori' onchange='myFunction()'><label> also edit categories </label>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-4'>
                          <select id='kategori' name='kategori' class='input w-full border flex-1' disabled>
                            <option value='0'>--Pilih kategori--</option>
                    ";
                    foreach ($kategori as $kat):
                        echo "<option value='".$kat['kategori_id']."''>".$kat['kategori_nama']."</option>";
                    endforeach;
                         
                        
            echo "
                         </select>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-4'>
                          <select id='sub1_kategori' name='sub1_kategori' class='input w-full border flex-1' disabled>
                            <option value='0'>--Pilih sub 1 kategori--</option>
                          </select>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-4'>
                          <select id='sub2_kategori' name='sub2_kategori' class='input w-full border flex-1' disabled>
                            <option value='0'>--Pilih sub 2 kategori--</option>
                          </select>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-4'>
                          <select id='sub3_kategori' name='sub3_kategori' class='input w-full border flex-1' disabled>
                            <option value='0'>--Pilih sub 3 kategori--</option>
                          </select>
                        </div>
                        <div class='intro-y col-span-12 sm:col-span-6 mt-4'>
                          <select id='sub4_kategori' name='sub4_kategori' class='input w-full border flex-1' disabled>
                            <option value='0'>--Pilih sub 4 kategori--</option>
                          </select>
                        </div>
                        <div class='mt-3'>
                          <label class='flex flex-col sm:flex-row'>Deskrisi <span class='sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600'>maks. 255 kata</span> </label>
                          <input type='text' name='deskripsi' class='input w-full border mt-2' placeholder='Type here..' value='".$data['deskripsi']."'>
                        </div>
                        <div class='mt-3 '>
                          <input type='text' name='id_berkas' class='input w-full border mt-2' placeholder='Type here..' value='".$data['id_berkas']."'>
                        </div>
                        <div class='mt-3 '>
                          <input type='text' name='id_pengguna_berkas' class='input w-full border mt-2' placeholder='Type here..' value='".$data['id_pengguna']."'>
                        </div>
                        <div class='mt-3 '>
                          <input type='text' name='nama_file_lama' class='input w-full border mt-2' placeholder='Type here..' value='".$data['file']."'>
                        </div>

                        <div class='items-center modal_center text-center mt-5'>
                          <button type='submit' action='submit' name='update' value='update' class='button w-24 bg-theme-1 modal_center text-center text-white'>Update</button>
                        </div>
                      </div>
                </form>
                <!-- END: Form Layout -->
                <script src='../dist/js/upload.js'></script>
                <script>
                function myFunction() {
                    const val = document.getElementById('cb-edit');
                    console.log(val.checked);
                        if(val.checked){
                          document.getElementById('kategori').removeAttribute('disabled');
                          document.getElementById('sub1_kategori').removeAttribute('disabled');
                          document.getElementById('sub2_kategori').removeAttribute('disabled');
                          document.getElementById('sub3_kategori').removeAttribute('disabled');
                          document.getElementById('sub4_kategori').removeAttribute('disabled');
                        }
                        else{
                          document.getElementById('kategori').setAttribute('disabled','');
                          document.getElementById('sub1_kategori').setAttribute('disabled','');
                          document.getElementById('sub2_kategori').setAttribute('disabled','');
                          document.getElementById('sub3_kategori').setAttribute('disabled','');
                          document.getElementById('sub4_kategori').setAttribute('disabled','');
                        }
                    }
                </script>
            ";
        }
        
        $stmt->close();
        $mysqli->close();
    }


    public static function comments($id,$id_author)
    {
        require_once('../config/db_sql.php');
        
        $sql = "SELECT tb_komentar.tanggal,tb_komentar.komentar,tb_komentar.jam,tb_pengguna.foto,tb_pengguna.nama_pengguna,tb_komentar.id_pengguna FROM tb_komentar,tb_pengguna WHERE tb_komentar.id_pengguna=tb_pengguna.id_pengguna AND tb_komentar.id_berkas = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $comments = $stmt->get_result();
        $sql_nama=mysqli_query($mysqli,"SELECT tb_berkas.nama AS nama_file FROM tb_berkas WHERE id_berkas='$id'");
        $namafile= mysqli_fetch_assoc($sql_nama);
        $nama_file=$namafile['nama_file'];
        
        echo "<p class='block truncate font-medium'>Komentar |    |".$nama_file."<p>";
        while($data=mysqli_fetch_assoc($comments)){
            echo "<div class='intro-x cursor-pointer box relative flex items-center p-5'>";
            if($data['id_pengguna']==$id_author){
            echo "
            <div class='w-12 h-12 flex-none image-fit mr-1 '>
                        <img alt='Midone Tailwind HTML Admin Template' class='rounded-full' src='../img/foto/".$data['foto']."'>
                    </div>
                    <div class='ml-2 overflow-hidden'>
                        <div class='flex items-center'>
                            <a class='flex items-center mr-2 block font-medium'>".$data['nama_pengguna']." (<div class='text-theme-9'>AUTHOR</div>)</a> 
                            <div class='flex items-center justify-center text-xs text-gray-500 ml-auto'> ".$data['tanggal']."-".$data['jam']."</div>
                        </div>
                        <div class='flex items-center'>
                        <div class='block font-medium text-base text-gray-600 '>".$data['komentar']."</div>
                        </div>
                    </div>
            ";
            } else {
                echo "
                    <div class='w-12 h-12 flex-none image-fit mr-1 '>
                        <img alt='Midone Tailwind HTML Admin Template' class='rounded-full' src='../img/foto/".$data['foto']."'>
                    </div>
                    <div class='ml-2 overflow-hidden'>
                        <div class='flex items-center'>
                            <a class='flex items-center mr-2 block font-medium'>".$data['nama_pengguna']."</a> 
                            <div class='flex items-center justify-center text-xs text-gray-500 ml-auto'> ".$data['tanggal']."-".$data['jam']."</div>
                        </div>
                        <div class='flex items-center'>
                        <div class='block font-medium text-base text-gray-600 '>".$data['komentar']." </div>
                        </div>
                    </div>
            ";
            }
            echo " </div>";
        }
        $stmt->close();
        $mysqli->close();
    }

    public static function mini_profil($id)
    {
        require_once('../config/db_sql.php');
        $sql = "SELECT tb_pengguna.nama_pengguna, tb_pengguna.foto, tb_direktorat.direktorat, tb_divisi.divisi, tb_pengguna.id_pengguna FROM tb_pengguna, tb_direktorat, tb_divisi WHERE tb_pengguna.id_direktorat = tb_direktorat.id_direktorat AND tb_pengguna.id_divisi = tb_divisi.id_divisi AND tb_direktorat.id_direktorat = tb_divisi.id_direktorat AND tb_pengguna.id_pengguna = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $mini_profil = $stmt->get_result()->fetch_assoc();
        echo "
            <div class='overflow-x-auto'>
            <table class='table'>
                <tbody>
                    <tr class='bg-gray-200 dark:bg-dark-1'>
                        <td class='border-b dark:border-dark-5'>Nama</td>
                        <td class='border-b dark:border-dark-5'>" . $mini_profil['nama_pengguna'] . "</td>
                    </tr>
                    <tr>
                        <td class='border-b dark:border-dark-5'>Direktorats/td>
                        <td class='border-b dark:border-dark-5'>" . $mini_profil['direktorat'] . "</td>
                    </tr>
                    <tr class='bg-gray-200 dark:bg-dark-1'>
                        <td class='border-b dark:border-dark-5'>Divisi</td>
                        <td class='border-b dark:border-dark-5'>" . $mini_profil['divisi'] . "</td>
                    </tr> 
                    <tr class='bg-gray-200 dark:bg-dark-1'>
                        <td class='border-b dark:border-dark-5'>Id</td>
                        <td class='border-b dark:border-dark-5'>" . $mini_profil['id_pengguna'] . "</td>
                    </tr>            
                </tbody>
            </table>
        </div>
        ";
        $stmt->close();
        $mysqli->close();
    }
    
    public static function lihat($id,$url)
    {
        require_once('../config/db_sql.php');
        $sql = "SELECT tb_berkas.file ,tb_berkas.view FROM tb_berkas, tb_jenis WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_berkas = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $lihat = $stmt->get_result()->fetch_assoc();
        echo "<iframe class=' w-full h-full' src='../".$url."" . $lihat['file'] . "' frameborder='0' allowfullscreen></iframe>";
        $stmt->close();
        $mysqli->close();
    }

    public static function detail($id)
    {
        require_once('../config/db_sql.php');
        $sql = 'SELECT tb_berkas.nama, tb_berkas.file, tb_berkas.deskripsi, tb_berkas.ukuran, tb_berkas.jam, tb_jenis.jenis FROM tb_berkas, tb_jenis WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_berkas = ?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $detail = $stmt->get_result()->fetch_assoc();
        echo "
        <div class='overflow-x-auto'>
        <table class='table'>
            <tbody>
                <tr class='bg-gray-200 dark:bg-dark-1'>
                    <td class='border-b dark:border-dark-5'>Nama</td>
                    <td class='border-b dark:border-dark-5'>" . $detail['nama'] . "</td>
                </tr>
                <tr>
                    <td class='border-b dark:border-dark-5'>Nama File</td>
                    <td class='border-b dark:border-dark-5'>" . $detail['file'] . "</td>
                </tr>
                <tr class='bg-gray-200 dark:bg-dark-1'>
                    <td class='border-b dark:border-dark-5'>Deskripsi</td>
                    <td class='border-b dark:border-dark-5'>" . $detail['deskripsi'] . "</td>
                </tr>
                <tr class='bg-gray-200 dark:bg-dark-1'>
                    <td class='border-b dark:border-dark-5'>Tanggal Upload</td>
                    <td class='border-b dark:border-dark-5'>" . $detail['jam'] . "</td>
                </tr>              
            </tbody>
        </table>
    </div>
        ";
        $stmt->close();
        $mysqli->close();
    }

    public static function hapus_pengguna($id,$url)
    {
        require_once('../config/db_sql.php');
        $sql = "DELETE FROM tb_pengguna WHERE id_pengguna = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        unlink($url);

        echo "
        <div class='p-5 text-center'> <i data-feather='check-circle' class='w-16 h-16 text-theme-9 mx-auto mt-3'></i>
            <div class='text-3xl mt-5'>Sukses</div>
            <div class='text-gray-600 mt-2'pengguna telah terhapus</div>
        </div>
        <div class='px-5 pb-8 text-center'> <button type='button' data-dismiss='modal' class='button w-24 bg-theme-1 text-white'>Tutup</button> </div>
        ";
    }
    public static function hapus($id,$url)
    {
        require_once('../config/db_sql.php');
        $sql = "DELETE FROM tb_berkas WHERE id_berkas = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        unlink($url);

        echo "
        <div class='p-5 text-center'> <i data-feather='check-circle' class='w-16 h-16 text-theme-9 mx-auto mt-3'></i>
            <div class='text-3xl mt-5'>Sukses</div>
            <div class='text-gray-600 mt-2'>File telah terhapus</div>
        </div>
        <div class='px-5 pb-8 text-center'> <button type='button' data-dismiss='modal' class='button w-24 bg-theme-1 text-white'>Tutup</button> </div>
        ";
    }

    public static function search($keyword)
    {
        require_once('../config/db_sql.php');
        $sql = "SELECT tb_berkas.id_berkas,tb_berkas.ukuran, tb_berkas.nama, tb_berkas.file, tb_berkas.deskripsi, tb_jenis.jenis FROM tb_berkas, tb_jenis, tb_pengguna WHERE tb_berkas.id_jenis = tb_jenis.id_jenis AND tb_berkas.id_pengguna = tb_pengguna.id_pengguna AND tb_jenis.id_jenis = 2 AND tb_berkas.nama LIKE ? ORDER BY id_berkas ASC";
        $keyword = $keyword . "%";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('s', $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $mysqli->close();
        return $result;
    }

    public static function generateChecksum($id = null, $url)
    {
        require_once("ChecksumUtil.php");
        $checksum = ChecksumUtil::checksumGenerator($url);
        echo $checksum;
    }

    public static function uploadFile()
    {
        require_once("ChecksumUtil.php");
        $filename = $_FILES['file']['name'];
        $location = "../uploads/" . $filename;
        $checksum = null;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $checksum = ChecksumUtil::checksumGenerator($location);
            unlink($location);
        }
        // echo $checksum;
        echo "
        <label class=mt-3 id='checksumLabel'>Checksum Berkas Eksternal</label>
        <input id='eksternalChecksum' type='text' class='input w-full border mt-2' value='". $checksum ."' placeholder='Checksum Berkas Eksternal' disabled>
        ";
    }
}

if (isset($_GET['ubah'])) {
    FileManager::ubah($_GET['ubah']);
    unset($_GET['ubah']);
}

if (isset($_GET['ubah_pengguna'])) {
    FileManager::ubah_pengguna($_GET['ubah_pengguna']);
    unset($_GET['ubah_pengguna']);
}

if (isset($_GET['comments'])) {
    FileManager::comments($_GET['comments'],$_GET['id_author']);
    unset($_GET['comments']);
}

if (isset($_GET['mini_profil'])) {
    FileManager::mini_profil($_GET['mini_profil']);
    unset($_GET['mini_profil']);
}

if (isset($_GET['lihat'])) {
    FileManager::lihat($_GET['lihat'],$_GET['url']);
    unset($_GET['lihat']);
}

if (isset($_GET['detail'])) {
    FileManager::detail($_GET['detail']);
    unset($_GET['detail']);
}

if (isset($_GET['search'])) {
    FileManager::search($_GET['search']);
    unset($_GET['search']);
}

if (isset($_GET['hapus'])) {
    FileManager::hapus($_GET['hapus'],$_GET['url']);
    unset($_GET['hapus']);
}

if (isset($_GET['hapus_pengguna'])) {
    FileManager::hapus_pengguna($_GET['hapus_pengguna'],$_GET['url']);
    unset($_GET['hapus_pengguna']);
}

if (isset($_GET['checksum'])) {
    FileManager::generateChecksum($_GET['checksum'], $_GET['url']);
    unset($_GET['checksum']);
}

if (isset($_FILES['file'])) {
    FileManager::uploadFile();
}
