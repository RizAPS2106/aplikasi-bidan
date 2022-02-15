$(document).ready(function () {

  window.onscroll = function() {stickyNavbar()};

  // Get Element
  var navbar = document.getElementById("sticky-navbar");

  // Offset position
  var navbar_offset = navbar.offsetTop;

  // Window on scroll function
  function stickyNavbar() {
    if (window.pageYOffset >= navbar_offset) {
      navbar.classList.add("sticky-navbar")
    } else {
      navbar.classList.remove("sticky-navbar");
    }
  }

  function rupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  // Base Url
  var base_url = window.location.origin;
  
  // Ketika Refresh
  if (window.performance) {
    console.info("window.performance works fine on this browser");
  }
  console.info(performance.navigation.type);
  if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    $("#create_form").trigger("reset");
    $("#edit_form").trigger("reset");
  }

  // Konfigurasi Modal Untuk Select2
  $.fn.modal.Constructor.prototype._enforceFocus = function () {};

  // Select2
  $(".select-live-search").select2({
    theme: 'bootstrap-5'
  });

  // DataTables
  $("#user_table").DataTable();
  $("#cabang_table").DataTable();
  $("#layanan_table").DataTable();

  // Ubah Password Toggle Script
  $("#ubah_password").click(function () {
    $("#form_ubah_password").toggle();
  });

  // Login Auth Script
  $("#auth_form").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url: $("#auth_url").val(),
      type: "POST",
      data: new FormData($("#auth_form")[0]),
      processData: false,
      contentType: false,
      success: function (data) {
        if (data.includes("Admin")) {
          location.replace(base_url + "/admin/dashboard");
        } else if (data.includes("Owner") || data.includes("Konsumen") || data.includes("Bidan")) {
          swal({
            title: "Berhasil",
            text: data,
            icon: "success",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          }).then(() => {
            $("#auth_form").trigger("reset");
          });
        } else {
          var elementemail = document.getElementById("email");
          var elementpassword = document.getElementById("password");

          if (data.includes("Email")) {
            elementemail.classList.add("is-invalid");
          } else {
            elementemail.classList.remove("is-invalid");
          }
          if (data.includes("Password")) {
            elementpassword.classList.add("is-invalid");
          } else {
            elementpassword.classList.remove("is-invalid");
          }

          swal({
            title: "Periksa Form",
            text: data,
            icon: "warning",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          });
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });

  // Tambah Data Script
  $("#create_form").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url: $("#create_url").val(),
      type: "POST",
      data: new FormData($("#create_form")[0]),
      processData: false,
      contentType: false,
      beforeSend: function () {
        if ($("#create").val() == "Simpan") {
          $("#create").val("Menyimpan...");
        } else if ($("#create").val() == "Daftar") {
          $("#create").val("Mendaftar...");
        }
      },
      success: function (data) {
        if (data == "Data berhasil disimpan" || data == "Registrasi berhasil") {
          $("#createModal").modal("hide");

          swal({
            title: "Berhasil",
            text: data,
            icon: "success",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          }).then(() => {
            $("#create_form").trigger("reset");
            if ($("#create").val() == "Menyimpan...") {
              location.reload();
            } else if ($("#create").val() == "Mendaftar...") {
              location.replace(base_url + "/");
            }
          });
        } else {
          if ($("#create").val() == "Menyimpan...") {
            $("#create").val("Simpan");
          } else if ($("#create").val() == "Mendaftar...") {
            $("#create").val("Daftar");
          }

          if ($("#create_url").val() == base_url + "/admin/cabang/create") {
            var elementkode_cabang = document.getElementById("kode_cabang");
            var elementnama = document.getElementById("nama");
            var elementalamat = document.getElementById("alamat");

            if (data.includes("Kode cabang")) {elementkode_cabang.classList.add("is-invalid");} 
            else {elementkode_cabang.classList.remove("is-invalid");}
            if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Alamat")) {elementalamat.classList.add("is-invalid");} 
            else {elementalamat.classList.remove("is-invalid");}

          } else if($("#create_url").val() == base_url + "/admin/layanan/create"){
            var elementnama = document.getElementById("nama_layanan");
            var elementharga = document.getElementById("harga");

            if (data.includes("Nama Layanan")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Harga")) {elementharga.classList.add("is-invalid");} 
            else {elementharga.classList.remove("is-invalid");}

          } else {
            var elementnama = document.getElementById("nama");
            var elementtelepon = document.getElementById("telepon");
            var elementemail = document.getElementById("email");
            var elementpassword = document.getElementById("password");
            var elementkonfirmasi_password = document.getElementById("konfirmasi_password");
            var elementpassword_invalid = document.getElementById("password_invalid");

            if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Nomor telepon")) {elementtelepon.classList.add("is-invalid");} 
            else {elementtelepon.classList.remove("is-invalid");}
            if (data.includes("Email")) {elementemail.classList.add("is-invalid");} 
            else {elementemail.classList.remove("is-invalid");}
            if (data.includes("Password")) {elementpassword.classList.add("is-invalid");elementpassword_invalid.classList.add("is-invalid");} 
            else {elementpassword.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
            if (data.includes("Konfirmasi password")) {elementkonfirmasi_password.classList.add("is-invalid");elementpassword_invalid.classList.add("is-invalid");} 
            else {elementkonfirmasi_password.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
          }

          swal({
            title: "Periksa Form",
            text: data,
            icon: "warning",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          });
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });

  // Tampil Data Ubah Script
  $(".item_edit").on("click", function () {
    var id = $(this).attr("data");

    if (typeof document.getElementsByClassName("table")[0] !== "undefined") {
      var id_table = document.getElementsByClassName("table")[0].id;
      if (id_table == "cabang_table") {
        var url_preview_edit = base_url + "/admin/cabang/preview_edit";
      } else if(id_table == "layanan_table"){
        var url_preview_edit = base_url + "/admin/layanan/preview_edit"; 
      } else {
        var url_preview_edit = base_url + "/admin/user/preview_edit";
      }
    } else {
      var url_preview_edit = base_url + "/admin/user/preview_edit";
    }

    $.ajax({
      type: "GET",
      url: url_preview_edit,
      dataType: "JSON",
      data: {
        id: id,
      },
      success: function (data) {
        if (id_table == "cabang_table") {
          $.each(data, function (id, kode_cabang, nama, alamat, id_user) {
            $("#updateModal").modal("show");
            $('[name="id"]').val(data.id);
            $('[name="kode_cabang"]').val(data.kode_cabang);
            $('[name="nama"]').val(data.nama);
            $('[name="alamat"]').val(data.alamat);
            $('[name="id_user"]').val(data.id_user).trigger("change");
          });
        } else if(id_table == "layanan_table") {
          $.each(data, function (id, nama_layanan, harga) {
            $("#updateModal").modal("show");
            $('[name="id"]').val(data.id);
            $('[name="nama_layanan"]').val(data.nama_layanan);
            $('[name="harga"]').val(rupiah(data.harga));
          });
        } else {
          $.each(data, function (id, nama, id_cabang, alamat, telepon) {
            $("#updateModal").modal("show");
            $('[name="id"]').val(data.id);
            $('[name="nama"]').val(data.nama);
            $('[name="telepon"]').val(data.telepon);
            $('[name="email"]').val(data.email);
            $('[name="id_cabang"]').val(data.id_cabang).trigger("change");
          });
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
    return false;
  });

  // Ketika Modal Ditutup
  $("#createModal").on("hidden.bs.modal", function () {
    $("#create_form").trigger("reset");
    $(".select-live-search").val("").trigger("change");
  });

  $("#updateModal").on("hidden.bs.modal", function () {
    $("#create_form").trigger("reset");
    $(".select-live-search").val("").trigger("change");
  });

  // Ubah Data Script
  $("#edit_form").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url: $("#edit_url").val(),
      type: "POST",
      data: new FormData($("#edit_form")[0]),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#edit").val("Mengubah...");
      },
      success: function (data) {
        if (data != "Data berhasil diubah") {
          $("#edit").val("Ubah");

          if ($("#edit_url").val() == base_url + "/admin/cabang/edit") {
            var elementkode_cabang = document.getElementById("kode_cabangs");
            var elementnama = document.getElementById("namas");
            var elementalamat = document.getElementById("alamats");

            if (data.includes("Kode cabang")) {elementkode_cabang.classList.add("is-invalid");} 
            else {elementkode_cabang.classList.remove("is-invalid");}
            if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Alamat")) {elementalamat.classList.add("is-invalid");} 
            else {elementalamat.classList.remove("is-invalid");}

          } else if($("#edit_url").val() == base_url + "/admin/layanan/edit") {
            var elementnama = document.getElementById("nama_layanans");
            var elementharga = document.getElementById("hargas");

            if (data.includes("Nama Layanan")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Harga")) {elementharga.classList.add("is-invalid");} 
            else {elementharga.classList.remove("is-invalid");}

          } else {
            var elementnama = document.getElementById("namas");
            var elementtelepon = document.getElementById("telepons");
            var elementemail = document.getElementById("emails");
            var elementpassword_lama =
              document.getElementById("password_lamas");
            var elementpassword = document.getElementById("passwords");
            var elementkonfirmasi_password = document.getElementById(
              "konfirmasi_passwords"
            );
            var elementpassword_invalid =
              document.getElementById("password_invalids");

            if (data.includes("Nama")) {elementnama.classList.add("is-invalid");} 
            else {elementnama.classList.remove("is-invalid");}
            if (data.includes("Nomor telepon")) {elementtelepon.classList.add("is-invalid");} 
            else {elementtelepon.classList.remove("is-invalid");}
            if (data.includes("email")) {elementemail.classList.add("is-invalid");} 
            else {elementemail.classList.remove("is-invalid");}
            if (data.includes("Password lama")) {elementpassword_lama.classList.add("is-invalid");} 
            else {elementpassword_lama.classList.remove("is-invalid");}
            if (data.includes("Password")) {elementpassword.classList.add("is-invalid");elementpassword_invalid.classList.add("is-invalid");} 
            else {elementpassword.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
            if (data.includes("Konfirmasi password")) {elementkonfirmasi_password.classList.add("is-invalid");elementpassword_invalid.classList.add("is-invalid");} 
            else {elementkonfirmasi_password.classList.remove("is-invalid");elementpassword_invalid.classList.remove("is-invalid");}
          }

          swal({
            title: "Periksa Form",
            text: data,
            icon: "warning",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          });
        } else {
          $("#updateModal").modal("hide");

          swal({
            title: "Berhasil",
            text: data,
            icon: "success",
            buttons: {
              confirm: {
                text: "Oke",
                className: "sweet-button",
              },
            },
          }).then(() => {
            $("#create_form").trigger("reset");
            location.reload();
          });
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
  });

  // Hapus Data Script
  $(".item_delete").on("click", function () {
    var id = $(this).attr("data");
    var url_delete = base_url + "/admin/user/" + id + "/delete";

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
          success: function (data) {
            swal("Data berhasil dihapus", {
              icon: "success",
              buttons: {
                confirm: {
                  text: "Oke",
                  className: "sweet-button",
                },
              },
            }).then(() => {
              location.reload();
            });
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
          },
        });
      } else {
        swal("Data tidak jadi dihapus", {
          buttons: false,
          timer: 900,
        });
      }
    });
  });
});
