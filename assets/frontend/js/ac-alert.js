// Sweet alert login error
const loginError = $('.flash-data').data('loginerror');
// Sweet alert login error
const changePassword = $('.flash-data').data('changepassword');
// Sweet alert Flashdata
const flashData = $('.flash-data').data('flashdata');
// Sweet alert Flashdata
const flashRegistrasi = $('.flash-data').data('registrasi');
// Sweet alert sendEmail
const sendEmail = $('.flash-data').data('sendemail');
// Sweet alert error Login Seller
const loginSeller = $('.flash-data').data('loginerrorseller');
// Sweet alert status aktif
const statusAktif = $('.flash-data').data('statusaktif');
// Sweet alert status aktif
const aktivasiAkun = $('.flash-data').data('aktivasiakun');
// Sweet alert status aktif
const editProfil = $('.flash-data').data('editprofil');


// Sweet alert login error
if (loginError) {
    swal({
        title: loginError,
        text: "Periksa kembali email dan password anda",
        icon: "error",
    });
}

// Sweet alert login seller error
if (loginSeller) {
    swal({
        title: loginSeller,
        text: "Periksa kembali nim dan password anda",
        icon: "error",
    });
}

// Sweet alert status aktif
if (statusAktif) {
    swal({
        title: statusAktif,
        text: "Silahkan cek email untuk mengaktifkan akun",
        icon: "error",
    });
}

// Sweet alert aktivasi akun
if (aktivasiAkun) {
    swal({
        title: aktivasiAkun,
        text: "Silahkan login ke akun anda",
        icon: "success",
    });
}

// Sweet alert password berhasil diubah
if (changePassword) {
    swal({
        title: 'Success',
        text: changePassword,
        icon: "success",
    });
}

// Sweet alert flashData
if (flashData) {
    swal({
        title: 'Success',
        text: flashData,
        icon: "success",
    });
}

// Sweet alert flashRegistrasi
if (flashRegistrasi) {
    swal({
        title: 'Registrasi Berhasil',
        text: flashRegistrasi,
        icon: "success",
    });
}

// Sweet alert sendEmail
if (sendEmail) {
    swal({
        title: sendEmail,
        text: "Cek email untuk mereset password",
        icon: "success",
    });
}

// Sweet alert edit Profil
if (editProfil) {
    swal({
        title: "Success",
        text: editProfil,
        icon: "success",
    });
}

//Sweet alert  hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    swal({
        title: "Anda Yakin",
        text: "Ingin menghapus data ini?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                document.location.href = href;
            }
        });
});


'use strict';
$(document).ready(function () {
    // [ sweet-basic ]
    $('.sweet-basic').on('click', function () {
        swal('Hello world!');
    });
    // [ sweet-success ]
    $('.sweet-success').on('click', function () {
        swal("Good job!", "You clicked the button!", "success");
    });
    // [ sweet-warning ]
    $('.sweet-warning').on('click', function () {
        swal("Good job!", "You clicked the button!", "warning");
    });
    // [ sweet-error ]
    $('.sweet-error').on('click', function () {
        swal("Error!", "You clicked the button!", "error");
    });
    // [ sweet-info ]
    $('.sweet-info').on('click', function () {
        swal("Good job!", "You clicked the button!", "info");
    });
    // [ sweet-multiple ]
    $('.sweet-multiple').on('click', function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!", {
                        icon: "error",
                    });
                }
            });
    });
    // [ sweet-prompt ]
    $('.sweet-prompt').on('click', function () {
        swal("Write something here:", {
            content: "input",
        })
            .then((value) => {
                swal(`You typed: ${value}`);
            });
    });
    // [ sweet-ajax ]
    $('.sweet-ajax').on('click', function () {
        swal({
            text: 'Search for a movie. e.g. "La La Land".',
            content: "input",
            button: {
                text: "Search!",
                closeModal: false,
            },
        })
            .then(name => {
                if (!name) throw null;
                return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
            })
            .then(results => {
                return results.json();
            })
            .then(json => {
                const movie = json.results[0];
                if (!movie) {
                    return swal("No movie was found!");
                }
                const name = movie.trackName;
                const imageURL = movie.artworkUrl100;
                swal({
                    title: "Top result:",
                    text: name,
                    icon: imageURL,
                });
            })
            .catch(err => {
                if (err) {
                    swal("Oh noes!", "The AJAX request failed!", "error");
                } else {
                    swal.stopLoading();
                    swal.close();
                }
            });
    });
});
