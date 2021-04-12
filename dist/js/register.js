$("#direktorat").change(function () {
    var id_direktorat = $("#direktorat").val();
    console.log(id_direktorat);
    $.ajax({
        type: 'POST',
        url: "",
        data: { id_direktorat: id_direktorat },
        success: function (data) {
            $("#divisi").html(data);
        },
    });
});