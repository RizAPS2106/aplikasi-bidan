$(document).ready(function() {

// Base Url    
    var base_url = window.location.origin;

// Ketika refresh
    if (window.performance) {
        console.info("window.performance works fine on this browser");
    }
    console.info(performance.navigation.type);
    if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
        $('#create_form').trigger('reset');
        $('#edit_form').trigger('reset');
    }

// DataTables
    $('#bidan_table').DataTable();
    $('#konsumen_table').DataTable();

// Ubah Password Toggle Script 
    $('#ubah_password').click(function(){
        $('#form_ubah_password').toggle();
    });

// Login Auth Script
$('#auth_form').on("submit", function(event) {
    event.preventDefault();

    $.ajax({
        url: $('#auth_url').val(),
        type: "POST",
        data: new FormData($('#auth_form')[0]),
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.includes('Admin')){
                location.replace(base_url+'/admin/dashboard');
            } else if (data.includes('Konsumen')) {
                swal({
                    title: "Berhasil",
                    text: data,
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: 'Oke',
                            className: 'sweet-button'
                        }
                    }
                }).then(() => {
                    $('#auth_form').trigger('reset');
                });
            } else if (data.includes('Bidan')) {
                swal({
                    title: "Berhasil",
                    text: data,
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: 'Oke',
                            className: 'sweet-button'
                        }
                    }
                }).then(() => {
                    $('#auth_form').trigger('reset');
                });
            } else {
                var elementemail = document.getElementById("email");
                var elementpassword = document.getElementById("password");

                if (data.includes("Email")) {elementemail.classList.add("is-invalid");} 
                else {elementemail.classList.remove("is-invalid");}
                if (data.includes("Password")) {elementpassword.classList.add("is-invalid");} 
                else {elementpassword.classList.remove("is-invalid");}
                
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
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });
});

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
                if($('#create').val() == "Simpan"){$('#create').val("Menyimpan...");}
                else if($('#create').val() == "Daftar"){$('#create').val("Mendaftar...");}
            },
            success: function(data) {
                if (data == 'Data berhasil disimpan' || data == "Registrasi berhasil") {
                    $('#createModal').modal('hide');
                    
                    swal({
                        title: "Berhasil",
                        text: data,
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: 'Oke',
                                className: 'sweet-button'
                            }
                        }
                    }).then(() => {
                        $('#create_form').trigger('reset');
                        if($('#create').val() == 'Menyimpan...'){
                            location.reload();
                        }else if($('#create').val() == 'Mendaftar...'){
                            location.replace(base_url+'/');
                        }
                    });
                } else {
                    if($('#create').val() == "Menyimpan..."){$('#create').val("Simpan");}
                    else if($('#create').val() == "Mendaftar..."){$('#create').val("Daftar");}

                    var elementnama = document.getElementById("nama");
                    var elementtelepon = document.getElementById("telepon");
                    var elementemail = document.getElementById("email");
                    var elementpassword = document.getElementById("password");
                    var elementkonfirmasi_password = document.getElementById("konfirmasi_password");
                    var elementpassword_invalid = document.getElementById("password_invalid");

                    if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
                    else {elementnama.classList.remove("is-invalid");}
                    if (data.includes("Telepon")) {elementtelepon.classList.add("is-invalid");} 
                    else {elementtelepon.classList.remove("is-invalid");}
                    if (data.includes("Email")) {elementemail.classList.add("is-invalid");} 
                    else {elementemail.classList.remove("is-invalid");}
                    if (data.includes("Password")) {elementpassword.classList.add("is-invalid");
                    elementpassword_invalid.classList.add("is-invalid");} 
                    else {elementpassword.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
                    if (data.includes("Konfirmasi password")) {elementkonfirmasi_password.classList.add("is-invalid");
                    elementpassword_invalid.classList.add("is-invalid");} 
                    else {elementkonfirmasi_password.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
                    
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
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

// Tampil Data User Script
    $('.item_edit').on('click',function() {
        var id = $(this).attr('data');
        var url_preview_edit = base_url + '/admin/user/preview_edit';
        
        $.ajax({
            type: "GET",
            url: url_preview_edit,
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $.each(data, function(id, nama, alamat, telepon) {
                    $('#updateModal').modal('show');
                    $('[name="id"]').val(data.id);
                    $('[name="nama"]').val(data.nama);
                    $('[name="telepon"]').val(data.telepon);
                    $('[name="email"]').val(data.email);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
        return false;
    });

// Ketika modal ditutup
    $('#createModal').on('hidden.bs.modal', function () {
        $('#create_form').trigger('reset');
    })

    $('#updateModal').on('hidden.bs.modal', function () {
        $('#create_form').trigger('reset');
    })

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
                    var elementtelepon = document.getElementById("telepons");
                    var elementemail = document.getElementById("emails");
                    var elementpassword_lama = document.getElementById("password_lamas");
                    var elementpassword = document.getElementById("passwords");
                    var elementkonfirmasi_password = document.getElementById("konfirmasi_passwords");
                    var elementpassword_invalid = document.getElementById("password_invalids");

                    if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
                    else {elementnama.classList.remove("is-invalid");}
                    if (data.includes("telepon")) {elementtelepon.classList.add("is-invalid");} 
                    else {elementtelepon.classList.remove("is-invalid");}
                    if (data.includes("email")) {elementemail.classList.add("is-invalid");} 
                    else {elementemail.classList.remove("is-invalid");}
                    if (data.includes("Password lama")) {elementpassword_lama.classList.add("is-invalid");} 
                    else {elementpassword_lama.classList.remove("is-invalid");}
                    if (data.includes("Password")) {elementpassword.classList.add("is-invalid");
                    elementpassword_invalid.classList.add("is-invalid");} 
                    else { elementpassword.classList.remove("is-invalid");
                    elementpassword_invalid.classList.remove("is-invalid");}
                    if (data.includes("Konfirmasi password")) {elementkonfirmasi_password.classList.add("is-invalid");
                    elementpassword_invalid.classList.add("is-invalid");} 
                    else {elementkonfirmasi_password.classList.remove("is-invalid");
                    elementpassword_invalid.classList.remove("is-invalid");}

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
                    $('#updateModal').modal('hide');

                    swal({
                        title: "Berhasil",
                        text: data,
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: 'Oke',
                                className: 'sweet-button'
                            }
                        }
                    }).then(() => {
                        $('#create_form').trigger('reset');
                        location.reload();
                    });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

// Hapus Data Script
    $('.item_delete').on('click', function() {
        var id = $(this).attr('data');
        var url_delete =  base_url + '/admin/user/'+id+'/delete';
        
        swal({
            title: "Yakin akan dihapus?",
            text: "Ketika sudah dihapus data tidak dapat kembali",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: url_delete,
                    success: function(data) {
                        swal("Data berhasil dihapus", {
                            icon: "success",
                            buttons: {
                                confirm: {
                                    text: 'Oke',
                                    className: 'sweet-button'
                                }
                            }
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            } else {
                swal("Data tidak jadi dihapus",{
                    buttons: false,
                    timer: 900
                });
            }
        });
    });
});