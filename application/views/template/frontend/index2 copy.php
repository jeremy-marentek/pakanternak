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
        <?= $header; ?> 

        <!-- Content -->
        <?= $content; ?>

        <!-- Footer -->
        <?= $footer; ?>

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
    
  $("#provinsi").on("change", function(e){
    e.preventDefault();
    var option = $('option:selected', this).val();    
    $('#kota option:gt(0)').remove();

  
    if(option==='')
    {
      alert('null');    
      $("#kota").prop("disabled", true);
    }
    else
    {        
      $("#kota").prop("disabled", false);
      getKota(option);
    }
  });
      
  function getKota(idpro) {
    var $op = $("#kota"); 
    
    $.getJSON("checkout/kota/"+idpro, function(data){      
      $.each(data, function(i,field){  
         $op.append('<option value="'+field.city_id+'">'+field.type+' '+field.city_name+'</option>'); 
      });
    });
  }

// Menggunakan class 'kurir' sebagai selector pada event change
// Inisialisasi variabel total bayar

$(".kurir").on("change", function() {
    // Dapatkan data dari elemen terkait
    var origin = $(this).data('origin');
    var destination = $(this).data('destination');
    var weight = $(this).data('weight');
    var courier = $(this).val();
    var id_penjual = $(this).data('penjual'); // Dapatkan ID penjual

    // Dapatkan referensi elemen opsi ongkir untuk penjual yang bersangkutan
    var $op = $("#ongkirSelect" + id_penjual);
    var $ongkirElement = $("#ongkir" + id_penjual); // Dapatkan elemen ongkir untuk penjual yang bersangkutan
    var $subtotalElement = $("#subtotal" + id_penjual); // Dapatkan elemen subtotal untuk penjual yang bersangkutan

    // Lakukan permintaan AJAX hanya untuk penjual yang bersangkutan
    $.getJSON("checkout/tarif/"+origin+"/"+destination+"/"+weight+"/"+courier, function(data) {     
        var optionsHtml = ""; // Variabel untuk menyimpan HTML opsi
        $.each(data, function(i, field) {  
            for (var i in field.costs) {
                // Masukkan biaya dan estimasi ke dalam opsi
                var cost = parseFloat(field.costs[i].cost[0].value); // Biaya pengiriman
                var etd = field.costs[i].cost[0].etd; // Estimasi pengiriman

                // Periksa apakah kata "hari" ada dalam estimasi
                if (etd.indexOf("HARI") === -1) {
                    etd += " HARI"; // Tambahkan kata "hari" jika tidak ada
                }

                // Buat opsi dengan biaya dan estimasi
                optionsHtml += "<option value='" + cost + "'>Rp " + cost + "  (" + etd + ") </option>";
            }
        });

        // Masukkan opsi ke dalam elemen select
        $op.html(optionsHtml);

        // Event listener untuk perubahan opsi ongkir
        $op.on("change", function() {
            // Ambil nilai ongkir yang dipilih
            var selectedShippingCost = parseFloat($(this).val());

            // Ambil total belanja penjual
            var totalBelanja = parseFloat($ongkirElement.data('totalbelanja'));

            // Hitung subtotal dengan menambahkan biaya pengiriman ke total belanja
            var subtotal = selectedShippingCost + totalBelanja;

            // Tampilkan subtotal dengan format mata uang menggunakan formatCurrency
            var formattedSubtotal = formatCurrency(subtotal);

            // Update teks subtotal dengan subtotal yang dihitung
            $subtotalElement.text(formattedSubtotal);

            // Update total bayar
            updateTotalBayar();
        });

        // Trigger perubahan untuk memastikan subtotal dihitung saat halaman dimuat
        $op.trigger("change");
    });
});

// Fungsi formatCurrency untuk format mata uang

$(".kurir").on("change", function() {
    var option = $(this).val(); // Ambil nilai yang dipilih dari elemen .kurir

    if (option === '') {
        alert('null');    
        var $ongkirElement = $("#ongkir" + $(this).data('penjual'));
        $ongkirElement.find('select').val(''); // Kosongkan opsi ongkir
        $ongkirElement.find('.ongkir').text(''); // Kosongkan nilai ongkir

        // Kosongkan nilai subtotal
        var id_penjual = $(this).data('penjual');
        $("#subtotal" + id_penjual).text('');
        
        // Kosongkan total bayar
        updateTotalBayar();
    } else {
        // Dapatkan data dari elemen terkait
        var origin = $(this).data('origin');
        var destination = $(this).data('destination');
        var weight = $(this).data('weight');
        var courier = $(this).val();
        var id_penjual = $(this).data('penjual'); // Dapatkan ID penjual

        // Dapatkan referensi elemen opsi ongkir untuk penjual yang bersangkutan
        var $op = $("#ongkirSelect" + id_penjual);
        var $ongkirElement = $("#ongkir" + id_penjual); // Dapatkan elemen ongkir untuk penjual yang bersangkutan
        var $subtotalElement = $("#subtotal" + id_penjual); // Dapatkan elemen subtotal untuk penjual yang bersangkutan

        // Lakukan permintaan AJAX hanya untuk penjual yang bersangkutan
        $.getJSON("checkout/tarif/"+origin+"/"+destination+"/"+weight+"/"+courier, function(data) {     
            var optionsHtml = ""; // Variabel untuk menyimpan HTML opsi
            $.each(data, function(i, field) {  
    for (var i in field.costs) {
        // Masukkan biaya dan estimasi ke dalam opsi
        var cost = parseFloat(field.costs[i].cost[0].value); // Biaya pengiriman
        var etd = field.costs[i].cost[0].etd; // Estimasi pengiriman
        var desc = field.costs[i].description; // Deskripsi layanan

        // Periksa apakah kata "hari" ada dalam estimasi
        if (etd.indexOf("HARI") === -1) {
            etd += " HARI"; // Tambahkan kata "hari" jika tidak ada
        }

        // Buat opsi dengan biaya, deskripsi, dan estimasi
        optionsHtml += "<option value='" + cost + "'>" + desc + " - " + formatCurrency(cost) + "  (" + etd + ") </option>";
    }
});


            // Masukkan opsi ke dalam elemen select
            $op.html(optionsHtml);

            // Event listener untuk perubahan opsi ongkir
            $op.on("change", function() {
                // Ambil nilai ongkir yang dipilih
                var selectedShippingCost = parseFloat($(this).val());

                // Ambil total belanja penjual
                var totalBelanja = parseFloat($ongkirElement.data('totalbelanja'));

                // Hitung subtotal dengan menambahkan biaya pengiriman ke total belanja
                var subtotal = selectedShippingCost + totalBelanja;

                // Tampilkan subtotal dengan format mata uang menggunakan formatCurrency
                var formattedSubtotal = formatCurrency(subtotal);

                // Update teks subtotal dengan subtotal yang dihitung
                $subtotalElement.text(formattedSubtotal);

                // Update total bayar
                updateTotalBayar();
            });

            // Trigger perubahan untuk memastikan subtotal dihitung saat halaman dimuat
            $op.trigger("change");
        });
    }
});


// Fungsi formatCurrency untuk format mata uang
// Fungsi formatCurrency untuk format mata uang
function formatCurrency(amount) {
    // Tambahkan karakter pemisah ribuan menggunakan fungsi number_format
    return 'Rp ' + number_format(amount);
}

// Fungsi number_format untuk format angka
function number_format(number) {
    // Gunakan built-in function toLocaleString untuk menambahkan pemisah ribuan
    return number.toLocaleString('id-ID');
}

// Fungsi untuk mengupdate total bayar
function updateTotalBayar() {
    var totalBayar = 0; // Reset total bayar menjadi 0
    // Loop untuk mengambil subtotal dari masing-masing penjual
    $("td[id^='subtotal']").each(function() {
        var subtotalText = $(this).text().trim(); // Ambil teks subtotal dari elemen saat ini
        // Bersihkan nilai subtotal dari karakter tambahan seperti "Rp" dan spasi
        var cleanedSubtotal = subtotalText.replace('Rp', '').replace(/\./g, '').trim(); // Hilangkan karakter titik (".")
        // Ubah teks subtotal yang telah dibersihkan menjadi angka
        var subtotal = parseFloat(cleanedSubtotal);
        // Cek apakah nilai subtotal valid sebelum menambahkannya ke totalBayar
        if (!isNaN(subtotal)) {
            totalBayar += subtotal; // Tambahkan subtotal ke total bayar
        }
    });
    // Tampilkan total bayar di bagian "TOTAL BAYAR"
    $(".total-price td").text(formatCurrency(totalBayar));
    
    // Log respons updateTotalBayar
    console.log("Total Bayar telah diperbarui:", totalBayar);
}

</script>









</body>


</html>
