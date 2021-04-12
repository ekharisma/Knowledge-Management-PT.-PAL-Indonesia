$(document).ready(function () {
    const FILE_INTERACTION = '../../helper/FileInteraction.php';
    $('.unduh').on('click', () => {
        const id = this.id;
        $.ajax({
            type: 'post',
            url: FILE_INTERACTION,
            data: { unduh: id, like: likes },
            success: (response) => {
                $('.jumlahUnduh').html(response);
            }
        });
    });

    $('.lihat').on('click', () => {
        const id = this.id;
        console.log(this);
        $.ajax({
            type: 'post',
            url: FILE_INTERACTION,
            data: { unduh: id, view: views },
            success: (response) => {
                $('.jumlahView').html(response);
            }
        });
    });
});