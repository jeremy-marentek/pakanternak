// Sweet alert Flashdata
const flashData = $('.flash-data').data('flashdata');
// Sweet alert login admin error
const loginAdmin = $('.flash-data').data('loginadmin');
// Sweet alert password error
const passwordError = $('.flash-data').data('passworderror');
// Sweet alert email salah
const emailError = $('.flash-data').data('emailerror');
// Sweet alert kirim email
const sendEmail = $('.flash-data').data('sendemail');
// Sweet alert ubah password
const ubahPassword = $('.flash-data').data('ubahpassword');
// Sweet alert ubah akun tidak aktif
const nonActive = $('.flash-data').data('nonactive');
// Sweet alert nim tidak terdaftr
const nimEmpty = $('.flash-data').data('nimempty');
// Sweet alert registrasi berhasil
const registrasi = $('.flash-data').data('registrasi');
// Sweet alert aktivasi akun
const activeAccount = $('.flash-data').data('activeakun');
// Sweet alert loginsuccess
const loginSuccess = $('.flash-data').data('loginsuccess');
// Sweet alert nonaktifkan status
const nonaktifkanStatus = $('.flash-data').data('nonaktif');
// Sweet alert nonaktifkan status
const aktifkanStatus = $('.flash-data').data('aktif');
// Sweet alert tambah keranjang
const tambahKeranjang = $('.flash-data').data('tambahkeranjang');
// Sweet alert tidak dapat membeli produk sendiri
const keranjangGagal = $('.flash-data').data('keranjanggagal');
// Sweet alert registrasi gagal
const registrasiGagal = $('.flash-data').data('registrasigagal');
// Sweet alert berhasil verifikasi
const verifikasiAkun = $('.flash-data').data('verifikasiakun');
// Sweet alert akun tidak aktif
const akunTidakAktif = $('.flash-data').data('akuntidakaktif');
// Sweet alert input pengiriman
const inputKirim = $('.flash-data').data('inputpengiriman');
// Sweet alert konfirmasi barang
const konfirmasiBarang = $('.flash-data').data('konfirmasibarang');
// Sweet alert cancel pesanan sukses
const cancelPesanan = $('.flash-data').data('cancelpesanan');



// Sweet alert flashData
if (flashData) {
    Swal.fire({
        title: 'Sukses',
        text: flashData,
        type: 'success',
    });
}

// Sweet alert password error
if (passwordError) {
    Swal.fire({
        title: 'Password Salah',
        text: passwordError,
        type: 'error',
    });
}

// Sweet alert login admin error
if (loginAdmin) {
    Swal.fire({
        title: 'Tidak terdaftar',
        text: loginAdmin,
        type: 'error',
    });
}

// Sweet alert email salah
if (emailError) {
    Swal.fire({
        title: 'Email tidak terdaftar',
        text: emailError,
        type: 'error',
    });
}

// Sweet alert email terkirim
if (sendEmail) {
    Swal.fire({
        title: 'Terkirim',
        text: sendEmail,
        type: 'success',
    });
}

// Sweet alert ubah password
if (ubahPassword) {
    Swal.fire({
        title: 'Sukses',
        text: ubahPassword,
        type: 'success',
    });
}

// Sweet alert akun tidak aktif
if (nonActive) {
    Swal.fire({
        title: 'Akun tidak aktif',
        text: nonActive,
        type: 'error',
    });
}

// Sweet alert nim tidak terdaftar
if (nimEmpty) {
    Swal.fire({
        title: 'Login Gagal',
        text: nimEmpty,
        type: 'error',
    });
}

// Sweet alert registrasi berhasil
if (registrasi) {
    Swal.fire({
        title: 'Registrasi Berhasil',
        text: registrasi,
        type: 'success',
    });
}

// Sweet alert aktivasi akun
if (activeAccount) {
    Swal.fire({
        title: 'Akun Diaktifkan',
        text: activeAccount,
        type: 'success',
    });
}

// Sweet alert login sukses
// if (loginSuccess) {
//     Swal.fire({
//         title: 'Login Berhasil',
//         text: loginSuccess,
//         type: 'success',
//     });
// }

// Sweet alert nonaktifkan status
if (nonaktifkanStatus) {
    Swal.fire({
        title: 'Nonaktif',
        text: nonaktifkanStatus,
        type: 'success',
    });
}

// Sweet alert aktifkan status
if (aktifkanStatus) {
    Swal.fire({
        title: 'Di Aktifkan',
        text: aktifkanStatus,
        type: 'success',
    });
}

// Sweet alert tambahkan keranjang
if (tambahKeranjang) {
    Swal.fire({
        title: 'Berhasil',
        text: tambahKeranjang,
        type: 'success',
    });
}

// Sweet alert keranjang gagal
if (keranjangGagal) {
    Swal.fire({
        title: 'Gagal',
        text: keranjangGagal,
        type: 'error',
    });
}

// Sweet alert registrasi gagal
if (registrasiGagal) {
    Swal.fire({
        title: 'Registrasi Gagal',
        text: registrasiGagal,
        type: 'error',
    });
}

//Sweet alert verifikasi akun
if (verifikasiAkun) {
    Swal.fire({
        title: 'Berhasil Diaktifkan',
        text: verifikasiAkun,
        type: 'success',
    });
}

//Sweet alert verifikasi akun
if (akunTidakAktif) {
    Swal.fire({
        title: 'Akun Tidak Aktif',
        text: akunTidakAktif,
        type: 'error',
    });
}

//Sweet alert input kirim
if (inputKirim) {
    Swal.fire({
        title: 'Success',
        text: inputKirim,
        type: 'success',
    });
}

//Sweet alert konfirmasi barang
if (konfirmasiBarang) {
    Swal.fire({
        title: 'Success',
        text: konfirmasiBarang,
        type: 'success',
    });
}

//Sweet alert cancel pesanan
if (cancelPesanan) {
    Swal.fire({
        title: 'Success',
        text: cancelPesanan,
        type: 'success',
    });
}

//Sweet alert hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Hapus Data?',
        text: 'Data tidak akan kembali setelah terhapus',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert nonaktifkan status akun
$('.tombol-nonaktif').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Nonaktifkan',
        text: 'Anda yakin ingin menonaktifkan akun ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Nonaktifkan',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert nonaktifkan status produk
$('.tombol-nonaktifproduk').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Nonaktifkan',
        text: 'Anda yakin ingin menonaktifkan produk ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Nonaktifkan',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert aktifkan status akun
$('.tombol-aktif').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Aktifkan',
        text: 'Anda yakin ingin mengaktifkan akun ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Aktifkan',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert aktifkan status produk
$('.tombol-aktifproduk').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Aktifkan',
        text: 'Anda yakin ingin mengaktifkan produk ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Aktifkan',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert harap login
$('.harap-login').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Harap Login',
        text: 'Untuk dapat melihat akun anda',
        type: 'warning',
    })
});

//Sweet alert kirim barang
$('.tombol-kirim').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Kirim',
        text: 'Ubah status pesanan menjadi dikirim?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert tombol konfirmasi
$('.tombol-konfirmasi').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin mengkonfirmasi pesanan?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Konfirmasi',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

//Sweet alert tombol cancel pesanan
$('.tombol-cancel').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Batalkan?',
        text: 'Anda yakin ingin membatalkan pesanan?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#D33',
        confirmButtonText: 'Batalkan',
        cancelButtonText: 'Kembali'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

