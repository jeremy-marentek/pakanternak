<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/frontend/images/logo/favicon-warma-blue.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?= base_url(); ?>assets/frontend/images/icon.png">

    <!-- Google font (font-family: 'Roboto', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/plugins.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/style.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/frontend/css/custom.css">

</head>

<body>
    <div id="wrapper" class="wrapper">

        <!-- Header -->
        <!-- -->

        <!-- Content -->
        <?= $content; ?>

        <!-- Footer -->
        

        <!-- Quickview Modal -->
        

    <!-- Js Files -->

    
    <script src="<?= base_url(); ?>assets/frontend/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/frontend/js/bootstrap.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets/frontend/js/plugins.js"></script> -->
    <script src="<?= base_url(); ?>assets/frontend/js/main.js"></script>
    <!-- Tautan jQuery dan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Sweet Alert Js -->
    <script src="<?= base_url(); ?>assets/sweetalert/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/sweetalert/script_sweetalert.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript">
  
  function getLokasi() {
    var $op = $("#provinsi"), $op1 = $("#sel11"), $np = $("#nama_provinsi"), $nk = $("#nama_kota");
    
    $.getJSON("provinsi", function(data){  
      $.each(data, function(i,field){  
      
         $op.append('<option value="'+field.province_id+'">'+field.province+'</option>'); 
         $op1.append('<option value="'+field.province_id+'">'+field.province+'</option>'); 
        
         $op.on("change", function(){
             $np.val($("#provinsi option:selected").text()); // Set nama_provinsi dengan teks opsi terpilih dari provinsi
         });
         $("#kota").on("change", function(){
             $nk.val($("#kota option:selected").text()); // Set nama_kota dengan teks opsi terpilih dari kota
         });
  
      });
      
    });
   
  }
  
  getLokasi();
  
  $("#sel11").on("change", function(e){
    e.preventDefault();
    var option = $('option:selected', this).val();    
    $('#sel22 option:gt(0)').remove();
    $('#kurir').val('');
  
    if(option==='')
    {
      alert('null');    
      $("#sel22").prop("disabled", true);
      $("#kurir").prop("disabled", true);
    }
    else
    {        
      $("#sel22").prop("disabled", false);
      getKota1(option);
    }
  });
  
  
  $("#provinsi").on("change", function(e){
    e.preventDefault();
    var option = $('option:selected', this).val();    
    $('#kota option:gt(0)').remove();
    $('#kurir').val('');
  
    if(option==='')
    {
      alert('null');    
      $("#kota").prop("disabled", true);
      $("#kurir").prop("disabled", true);
    }
    else
    {        
      $("#kota").prop("disabled", false);
      getKota(option);
    }
  });
  
  
  
  
  $("#sel22").on("change", function(e){
    e.preventDefault();
    var option = $('option:selected', this).val();    
    $('#kurir').val('');
  
    if(option==='')
    {
      alert('null');    
      $("#kurir").prop("disabled", true);
    }
    else
    {        
      $("#kurir").prop("disabled", false);    
    }
  });
  
  
  $("#kurir").on("change", function(e){
    e.preventDefault();
    var option = $('option:selected', this).val();    
    var origin = $("#kota").val();
    var des = $("#sel22").val();
    var qty = $("#berat").val();
  
    if(qty==='0' || qty==='')
    {
      alert('null');
    }
    else if(option==='')
    {
      alert('null');        
    }
    else
    {                
      getOrigin(origin,des,qty,option);
    }
  });
  
  
  function getOrigin(origin,des,qty,cour) {
    var $op = $("#hasil"); 
    var i, j, x = "";
    
    $.getJSON("checkout/tarif/"+origin+"/"+des+"/"+qty+"/"+cour, function(data){     
      $.each(data, function(i,field){  
  
        for(i in field.costs)
        {
            x += "<p class='mb-0'><b>" + field.costs[i].service + "</b> : "+field.costs[i].description+"</p>";
  
             for (j in field.costs[i].cost) {
                  x += field.costs[i].cost[j].value +"<br>"+field.costs[i].cost[j].etd+"<br>"+field.costs[i].cost[j].note;
              }
           
        }
  
        $op.html(x);
  
      });
    });
   
  }
  
  
  function getKota1(idpro) {
    var $op = $("#sel22"); 
    
    $.getJSON("checkout/kota/"+idpro, function(data){      
      $.each(data, function(i,field){  
      
  
         $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>'); 
  
      });
      
    });
   
  }
    
  function getKota(idpro) {
    var $op = $("#kota"); 
    
    $.getJSON("checkout/kota/"+idpro, function(data){      
      $.each(data, function(i,field){  
      
  
         $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>'); 
  
      });
      
    });
   
  }
  
  </script>

    <!-- Snap Midtrans -->
    <!-- <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-r3Il2sHQSHWzr--h"></script> -->
<!--  -->

    <script>
        $(document).ready(function() {
            // Periksa apakah halaman yang sedang dibuka adalah halaman checkout
            var currentUrl = window.location.href;
            var tipeAkun = <?php echo $this->session->userdata('tipe'); ?>;
            if (currentUrl.indexOf("alamatpenjual") != -1 && tipeAkun === 1) {
                // Lakukan AJAX request untuk memeriksa keberadaan alamat utama
                $.ajax({
                    url: "<?= site_url('alamat/cekAlamatUtama') ?>",
                    type: "GET",
                    dataType: "json", // Tentukan tipe data yang diharapkan dari respons
                    success: function(response) {
                        // Tangani respons dari server
                        if (!response.alamat_utama) {
                            // Jika tidak ada alamat utama, tampilkan SweetAlert
                            Swal.fire({
                                icon: 'info',
                                title: 'Oops...',
                                text: 'Anda belum memiliki alamat!',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect ke halaman tambah alamat
                                    $('#tambahAlamatModal').modal('show');
                                }
                            });
                        }
                    }
                });
            }
        });
    </script>



<!-- Script di luar elemen 'lokasi_saat_ini' -->
<script>
  // Panggil fungsi getGeolocation saat halaman dimuat
  window.onload = function() {
    getGeolocation();
  };

  function getGeolocation() {
    // Periksa apakah browser mendukung geolocation
    if ("geolocation" in navigator) {
      // Jika mendukung, minta izin dan dapatkan lokasi
      navigator.geolocation.getCurrentPosition(function(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Simpan nilai latitude dan longitude ke input tersembunyi
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;

        // Konstruksi URL Google Maps dengan latitude dan longitude
        var mapUrl = "https://maps.google.com/maps?q=" + latitude + "," + longitude + "&output=embed";

        // Tampilkan lokasi dalam iframe dengan URL Google Maps
        document.getElementById("lokasi_saat_ini").innerHTML = "<iframe src='" + mapUrl + "' style='width:100%; height:300px;'></iframe>";
      }, function(error) {
        // Tangani kesalahan jika pengguna menolak izin
        if (error.code === error.PERMISSION_DENIED) {
          document.getElementById("lokasi_saat_ini").innerHTML = "Anda menolak untuk memberikan izin lokasi.";
          // Tampilkan tombol untuk mengambil lokasi saat ini saat izin ditolak
          var buttonHTML = "<br><button type='button' class='btn btn-primary' onclick='getGeolocation()'>Izinkan Lokasi</button>";
          document.getElementById("lokasi_saat_ini").innerHTML += buttonHTML;
        }
      });
    } else {
      // Jika browser tidak mendukung geolocation, tampilkan pesan kesalahan
      document.getElementById("lokasi_saat_ini").innerHTML = "Geolocation tidak didukung oleh browser ini.";
    }
  }
</script>









</body>


</html>
