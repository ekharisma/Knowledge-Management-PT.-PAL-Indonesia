const FILE_MANAGER = "../helper/FileManager.php";

$('.ubah').on('click', function () {
    console.log(this);
    const id = this.id;
    $.ajax({
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { ubah: id },
        success: function (response) {
            $('.container').html(response);
        }
    });
})

$('.ubah_pengguna').on('click', function () {
    console.log(this);
    const id = this.id;
    $.ajax({
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { ubah_pengguna: id },
        success: function (response) {
            $('.container').html(response);
        }
    });
})

$('.comments').on('click', function () {
    
    const id = this.id;
    const id_pengguna = $(this).attr('data-url');
    console.log(id+'-- '+id_pengguna);
    $.ajax({
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { comments: id, id_author: id_pengguna },
        success: function (response) {
            $('.container').html(response);
        }
    });
})

$('.mini_profil').on('click', function () {
    console.log(this);
    const id = this.id;
    $.ajax({
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { mini_profil: id },
        success: function (response) {
            $('.container').html(response);
        }
    });
})

$('.lihat').on('click', function () {
    const id = this.id;
    const url = $(this).attr('data-url');
    console.log(url);
    $.ajax({
        
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { lihat: id, url: url },
        success: function (response) {
            $('.container').html(response);
        }
    });
});

$('.detail').on('click', function () {
    console.log(this);
    const id = this.id;
    $.ajax({
        type: "get",
        cache: false,
        url: FILE_MANAGER,
        data: { detail: id },
        success: function (response) {
            $('.container').html(response);
        }
    });
})

$('.unduh').on('click', function () {
    const id = this.id;
    $.ajax({
        type: 'get',
        cache: false,
        url: FILE_MANAGER,
        data: { unduh: id },
        success: function (response) {
            $('.container').html(response);
            console.log(response);
        }
    })
})

$('.hapus').on('click', function () {
    const id = this.id;
    let url = $(this).data('url');
    url='../'+url;
    
    $('.hapus_btn').on('click', function () {
        console.log(url);
        $.ajax({
            type: 'get',
            url: FILE_MANAGER,
            data: { hapus: id, url:url },
            success: function (response) {
                document.getElementById('delete-modal').classList.toggle("hidden");
                alert("File telah dihapus");
                location.reload(true); 
            }
        });
    });
});

$('.hapus_pengguna').on('click', function () {
    const id = this.id;
    let url = $(this).data('url');
    
    console.log(url);
    $('.hapus_btn').on('click', function () {
        console.log(url);
        $.ajax({
            type: 'get',
            url: FILE_MANAGER,
            data: { hapus_pengguna: id, url:url },
            success: function (response) {
                document.getElementById('delete-modal').classList.toggle("hidden");
                alert("pengguna telah dihapus");
                location.reload(true); 
            }
        });
    });
});

$('.kode').on('click', function () {
    const id = this.id;
    let url = $(this).data('url');
    url='../'+url;
    console.log(url);
    $.ajax({
        type: 'get',
        url: FILE_MANAGER,
        data: { checksum: id, url: url },
        success: (response) => {
            $("#internalChecksum").val(response);
            // console.log(response);
        }
    })
});

$("#submitUpload").on('click', () => {
    const formData = new FormData();
    const files = $("#file")[0].files;
    if (files.length > 0) {
        formData.append('file', files[0]);
        $.ajax({
            url: FILE_MANAGER,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                // console.log(response);
                $("#switch").html(response);
            }
        })
    }
})

const compareChecksumBtn = document.getElementById('compareChekscum');
compareChecksumBtn.addEventListener('click', () => {
    const checksumInternal = document.getElementById('internalChecksum').value;
    const checksumEksternal = document.getElementById('eksternalChecksum').value;
    console.log(checksumInternal);
    console.log(checksumEksternal);
    if (checksumInternal === checksumEksternal) {
        alert("Berkas Identik");
    }
    else {
        alert("Berkas telah diubah");
    }
})
