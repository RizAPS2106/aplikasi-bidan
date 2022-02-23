$(document).ready(function () {

  // Ketika Refresh
  if (window.performance) {
    console.info("window.performance works fine on this browser");
  }
  if (performance.navigation.type == performance.navigation.TYPE_RELOAD) {
    $("#create_form").trigger("reset");
    $("#edit_form").trigger("reset");

    $("#radio1").prop('checked',true);
    $("#radio2").prop('checked',false);
    
    $("#layanan").val('').change();
    $('#id_alamat').val($('#id_alamat option:first-child').val()).trigger('change');

    $('#total_harga').val('');

    $('.profil_field').prop('readonly',true);
    $('.profil_password_field').prop('disabled',true);
  }

  // Format Rupiah
  function rupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  // Sticky Navbar
  if (typeof document.getElementsByClassName("sub-navbar")[0] !== "undefined") {
    window.onscroll = function () { stickyNavbar() };
    
    var navbar = document.getElementById("sticky-navbar");

    var navbar_offset = navbar.offsetTop;

    function stickyNavbar() {
      if (window.pageYOffset >= navbar_offset) {
        navbar.classList.add("sticky-navbar")
      } else {
        navbar.classList.remove("sticky-navbar");
      }
    }
  }

  // Base Url
  var base_url = window.location.origin;

  // Konfigurasi Modal Bootstrap Untuk Select2
  $.fn.modal.Constructor.prototype._enforceFocus = function () { };

  // DataTables
  $("#user_table").DataTable();
  $("#cabang_table").DataTable();
  $("#layanan_table").DataTable();

  // Select2
  $(".select2").select2({
    theme: 'bootstrap-5',
    placeholder: '--- Pilih ---'
  });

  // Datetime Picker
  $(".datetimepicker").datetimepicker({
    language:'id',
    startDate: new Date(),
	  endDate: Infinity,
    todayHighlight: true,
  });

  // Ubah Password Toggle Script
  $("#ubah_password").click(function () {
    $("#form_ubah_password").toggle();
  });

  // Alamat Toggle Script 
  $('input[type=radio][name=layanan_detail]').change(function() {
    if (this.value == 'onsite') {
      $('#form_alamat').hide();
    }
    else if (this.value == 'homecare') {
      $('#form_alamat').show();
    }
  });

  // Memilih Layanan Script
  let total_harga;
  $('#layanan').on('select2:select', function (e) {
    var data_layanan = $('#layanan').val();
    total_harga = 0;
    data_layanan.forEach((number, index) => {
      const harga = $.parseJSON(number);
      total_harga += harga['harga'];
      $('#harga_total').html(rupiah(total_harga.toString()));
      $('#total_harga').val(total_harga);
    }); 
  });

  $('#layanan').on('select2:unselecting', function (e) {
    var data_layanan = e.params.args.data.id;
    const layanan = $.parseJSON(data_layanan);
    total_harga -= layanan['harga'];
    $('#harga_total').html(rupiah(total_harga.toString()));
    $('#total_harga').val(total_harga);
  });

  // Memilih Alamat Script
  $('#id_alamat').on('select2:select', function (e) {
    var data_layanan = {"id_alamat" : $('#id_alamat').val()};
    $.ajax({
      url: base_url+'/konsumen/alamat/pick',
      type: "POST",
      data: data_layanan,
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        alert("Status: " + textStatus);
        alert("Error: " + errorThrown);
      },
    });
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

  // Register ke Login
  $("#to_login").on("click", function (event) {
    localStorage.setItem('openModal', '#loginModal');
    location.replace(base_url);
  })
  var modalId = localStorage.getItem('openModal');
  if (modalId != null) {
    $(modalId).modal("show");
    localStorage.removeItem('openModal');
  }

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
          location.replace(base_url + "/admin/");
        } else if (data.includes("Bidan")){
          location.replace(base_url + "/bidan/");
        }else if (data.includes("Owner") || data.includes("Konsumen") || data.includes("Bidan")) {
          swal({
            title: "Berhasil",
            text: 'Selamat Datang, '+data,
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

  // Logout Script
  $("#logout").on("click", function () {
    swal({
      title: "Keluar?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        location.replace(base_url+"/login/logout");
      }
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
              localStorage.setItem('openModal', '#loginModal');
              location.replace(base_url);
            }
          });
        } else {
          if ($("#create").val() == "Menyimpan...") {
            $("#create").val("Simpan");
          } else if ($("#create").val() == "Mendaftar...") {
            $("#create").val("Daftar");
          }

          if ($("#create_url").val() == base_url + "/admin/cabang/create") {

            if (data.includes("Kode cabang")) { $("#kode_cabang").addClass("is-invalid"); }
            else { $("#kode_cabang").removeClass("is-invalid"); }
            if (data.includes("Nama")) { $("#nama").addClass("is-invalid"); }
            else { $("#nama").removeClass("is-invalid"); }
            if (data.includes("Alamat")) { $("#alamat").addClass("is-invalid"); }
            else { $("#alamat").removeClass("is-invalid"); }

          } else if ($("#create_url").val() == base_url + "/admin/layanan/create") {
            
            if (data.includes("Nama Layanan")) { $("#nama_layanan").addClass("is-invalid"); }
            else { $("#nama_layanan").removeClass("is-invalid"); }
            if (data.includes("Harga")) { $("#harga").addClass("is-invalid"); }
            else { $("#harga").removeClass("is-invalid"); }
          
          } else {
            
            if (data.includes("Nama")) { $("#nama").addClass("is-invalid"); }
            else { $("#nama").removeClass("is-invalid"); }
            if (data.includes("Telepon")) { $("#telepon").addClass("is-invalid"); }
            else { $("#telepon").removeClass("is-invalid"); }
            if (data.includes("Email")) { $("#email").addClass("is-invalid"); }
            else { $("#email").removeClass("is-invalid"); }
            if (data.includes("Password")) { $("#password").addClass("is-invalid"); $("#password_invalid").addClass("is-invalid"); }
            else { $("#password").removeClass("is-invalid"); $("#password_invalid").removeClass("is-invalid"); }
            if (data.includes("Konfirmasi password")) { $("#konfirmasi_password").addClass("is-invalid"); $("#password_invalid").addClass("is-invalid"); }
            else { $("#konfirmasi_password").remmoveClass("is-invalid"); $("#password_invalid").removeClass("is-invalid"); }
          
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

  // Enable Ubah Data Script
  $("#enable_form").on("click", function (event){
    $('.profil_field').removeAttr('readonly');
    $('.profil_password_field').removeAttr('disabled');
    $("#enable_button").hide();
    $("#ubah_button").show();
  })

  $("#batal_ubah").on("click", function (event){
    $('.profil_field').prop('readonly',true);
    $('.profil_password_field').prop('disabled',true);
    $("#ubah_button").hide();
    $("#enable_button").show();

    location.reload();    
  })

  // Tampil Ubah Data Script
  $(".item_edit").on("click", function () {
    var id = $(this).attr("data");

    
      var id_table = $("#table").attr('id');
      if (id_table == "user_table") {
        var url_preview_edit = base_url + "/admin/user/preview_edit";
      } else if (id_table == "cabang_table") {
        var url_preview_edit = base_url + "/admin/cabang/preview_edit";
      } else if (id_table == "layanan_table") {
        var url_preview_edit = base_url + "/admin/layanan/preview_edit";
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
        } else if (id_table == "layanan_table") {
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
        if($("#edit").val()=="Ubah"){
          $("#edit").val("Mengubah...");
        }else if($("#edit").val()=="Tambahkan"){
          $("#edit").val("Menambahkan...");
        }
      },
      success: function (data) {
        if (!( data == "Data berhasil diubah" || data == "Saldo berhasil ditambahkan" )) {
          if($("#edit").val()=="Mengubah..."){
            $("#edit").val("Ubah");
          }else if($("#edit").val()=="Menambahkan..."){
            $("#edit").val("Tambahkan");
          }
          
          if ($("#edit_url").val() == base_url + "/admin/cabang/edit") {

            if (data.includes("Kode cabang")) { $("#kode_cabangs").addClass("is-invalid"); }
            else { $("#kode_cabangs").removeClass("is-invalid"); }
            if (data.includes("Nama")) { $("#namas").addClass("is-invalid"); }
            else { $("#namas").removeClass("is-invalid"); }
            if (data.includes("Alamat")) { $("#alamats").addClass("is-invalid"); }
            else { $("#alamats").removeClass("is-invalid"); }

          } else if ($("#edit_url").val() == base_url + "/admin/layanan/edit") {

            if (data.includes("Nama Layanan")) { $("#nama_layanans").addClass("is-invalid"); }
            else { $("#nama_layanans").removeClass("is-invalid"); }
            if (data.includes("Harga")) { $("#hargas").addClass("is-invalid"); }
            else { $("#hargas").removeClass("is-invalid"); }

          } else if ($("#edit_url").val() == base_url + "/konsumen/saldo/add") {

            if (data.includes("saldo")) { $("#saldos").addClass("is-invalid"); }
            else { $("#saldos").removeClass("is-invalid"); }
          
          } else {

            if (data.includes("Nama")) { $("#namas").addClass("is-invalid"); }
            else { $("#namas").removeClass("is-invalid"); }
            if (data.includes("Telepon")) { $("#telepons").addClass("is-invalid"); }
            else { $("#telepons").removeClass("is-invalid"); }
            if (data.includes("Email")) { $("#emails").addClass("is-invalid"); }
            else { $("#emails").removeClass("is-invalid"); }
            if (data.includes("Password lama")) { $("#password_lamas").addClass("is-invalid"); }
            else { $("#password_lamas").removeClass("is-invalid"); }
            if (data.includes("Password")) { $("#passwords").addClass("is-invalid"); $("#password_invalids").addClass("is-invalid"); }
            else { $("#passwords").removeClass("is-invalid"); $("#password_invalids").removeClass("is-invalid"); }
            if (data.includes("Konfirmasi password")) { $("#konfirmasi_passwords").addClass("is-invalid"); $("#password_invalids").addClass("is-invalid"); }
            else { $("#konfirmasi_passwords").remmoveClass("is-invalid"); $("#password_invalids").removeClass("is-invalid"); }

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
          $("#saldoModal").modal("hide");

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

    var id_table = $("#table").attr('id');
    if (id_table == "user_table") {
      var url_delete = base_url + "/admin/user/" + id + "/delete";
    } else if (id_table == "cabang_table") {
      var url_delete = base_url + "/admin/cabang/" + id + "/delete";
    } else if (id_table == "layanan_table") {
      var url_delete = base_url + "/admin/layanan/" + id + "/delete";
    } else {
      var url_delete = base_url + "/admin/user/" + id + "/delete";
    }
    
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
  
  // Order Data Script
  $("#order_form").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url: $("#order_url").val(),
      type: "POST",
      data: new FormData($("#order_form")[0]),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#order").val("Pesanan di proses...");
      },
      success: function (data) {
        if (data == "Pesanan berhasil dibuat") {
          $("#orderModal").modal("hide");

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
            $("#order_form").trigger("reset");
            location.replace(base_url);
          }); 
        } else {
          $("#order").val("Pesan");

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

  // Tambah Data Alamat Script
  $("#addalamat_form").on("submit", function (event) {
    event.preventDefault();

    $.ajax({
      url: $("#addalamat_url").val(),
      type: "POST",
      data: new FormData($("#addalamat_form")[0]),
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#addalamat").val("Alamat ditambahkan...");
      },
      success: function (data) {
        if (data == "Alamat berhasil disimpan") {
          $("#addalamatModal").modal("hide");

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
            $("#addalamat_form").trigger("reset");
            location.reload();
          });
        } else {
          $("#addalamat").val("Tambahkan Alamat");
          
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

});