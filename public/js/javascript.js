$(document).ready(function() {

// DataTables

    $('#bidan_table').DataTable();
    $('#konsumen_table').DataTable();


// Tambah Data Script
    $('#create_form').on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: $('#create_url').val(),
            type: "POST",
            data: new FormData($('#create_form')[0]),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#create').val("Menyimpan...");
            },
            success: function(data) {
                if (data != 'Data Berhasil disimpan') {
                    $('#create').val("Simpan");
                    var elementnama = document.getElementById("nama");
                    var elementalamat = document.getElementById("alamat");
                    var elementtelepon = document.getElementById("telepon");

                    if (data.includes("nama")) {
                        elementnama.classList.add("is-invalid");
                    } else {
                        elementnama.classList.remove("is-invalid");
                    }

                    if (data.includes("alamat")) {
                        elementalamat.classList.add("is-invalid");
                    } else {
                        elementalamat.classList.remove("is-invalid");
                    }

                    if (data.includes("telepon")) {
                        elementtelepon.classList.add("is-invalid");
                    } else {
                        elementtelepon.classList.remove("is-invalid");
                    }

                    swal({
                        title: "Periksa Form",
                        text: data,
                        icon: "warning",
                        buttons: {
                            confirm: {
                                text: 'Oke',
                                className: 'sweet-button'
                            }
                        }
                    });
                } else {
                    location.reload();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });



// Tampil Data Ubah Bidan dan Ubah Konsumen Script

var base_url = window.location.origin;

// Tampil Data Ubah Bidan

    $('#bidan_table').on('click', '.item_edit', function() {
        var id = $(this).attr('data');

        var url = base_url + '/admin/bidan/preview_edit';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function(id, nama, alamat, telepon) {
                    $('#updateModal').modal('show');
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="telepon"]').val(data.telepon);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
        return false;
    });


// Tampil Data Ubah Konsumen Script 

    $('#konsumen_table').on('click', '.item_edit', function() {
        var id = $(this).attr('data');

        var url = base_url + '/admin/konsumen/preview_edit';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function(id, nama, alamat, telepon) {
                    $('#updateModal').modal('show');
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="telepon"]').val(data.telepon);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
        return false;
    });


// Ubah Data Script 

    $('#edit_form').on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: $('#edit_url').val(),
            type: "POST",
            data: new FormData($('#edit_form')[0]),
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#edit').val("Mengubah...");
            },
            success: function(data) {
                if (data != 'Data berhasil diubah') {
                    $('#edit').val("Ubah");
                    var elementnama = document.getElementById("namas");
                    var elementalamat = document.getElementById("alamats");
                    var elementtelepon = document.getElementById("telepons");

                    if (data.includes("nama")) {
                        elementnama.classList.add("is-invalid");
                    } else {
                        elementnama.classList.remove("is-invalid");
                    }

                    if (data.includes("alamat")) {
                        elementalamat.classList.add("is-invalid");
                    } else {
                        elementalamat.classList.remove("is-invalid");
                    }

                    if (data.includes("telepon")) {
                        elementtelepon.classList.add("is-invalid");
                    } else {
                        elementtelepon.classList.remove("is-invalid");
                    }

                    swal({
                        title: "Periksa Form",
                        text: data,
                        icon: "warning",
                        buttons: {
                            confirm: {
                                text: 'Oke',
                                className: 'sweet-button'
                            }
                        }
                    });
                } else {
                    $("#create_form").trigger("reset");
                    location.reload();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

// Ketika refresh
    if (window.performance) {
        console.info("window.performance works fine on this browser");
    }
    console.info(performance.navigation.type);
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        $('#create_form').trigger('reset');
        $('#edit_form').trigger('reset');
    }

});