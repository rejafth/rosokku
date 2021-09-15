/* 
==================================================================
GLOBAL CONFIG
==================================================================
*/
$(function() {
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    })
});



/* 
==================================================================
INPUTMASK
==================================================================
*/
Inputmask.extendAliases({
    rupiah: {
        prefix: '',
        groupSeparator: ',',
        alias: 'numeric',
        placeholder: '',
        autoGroup: !0,
        digits: 0,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    }
})
$('[data-mask="currency"]').inputmask({
    alias: 'rupiah'
});

$('[data-mask="phone"]').inputmask({
    mask: '+62999999999999',
    placeholder: ''
});

$('[data-mask="rekening"]').inputmask({
    mask: '999999999999999999999999999999',
    placeholder: ''
});



/* 
==================================================================
SUMMERNOTE
==================================================================
*/
// $(function () {
//     $('.editor').summernote();
//     $('.editorair').summernote({
//         // airMode: true,
//         height: 100,
//         toolbar: false
//     });
// })



/* 
==================================================================
SELECT 2
==================================================================
*/

//Initialize Select2 Elements
$('.select2').select2();
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});



/* 
==================================================================
LIGHTBOX
==================================================================
*/
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});



/*
==================================================================
SWEETALERT
==================================================================
*/
$('.delete').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Anda yakin ?',
        text: "Data akan dihapus permanen",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.done').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Yakin sudah selesai ?',
        text: "Data akan ditandai sebagai sudah selesai",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.proses').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi request ?',
        text: "Barang akan diproses untuk diambil oleh kurir",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.pencairan').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Lanjutkan pencairan dana ?',
        text: "Data akan diproses untuk segera dicairkan",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.reset').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Reset password user ?',
        text: "Password user akan direset ke default",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.logout').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Yakin logout ?',
        text: "Sesi login saat ini akan berakhir",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

$('.cancel_tugas').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Batalkan Penugasan ?',
        text: "Penugasan saat ini akan dibatalkan dan transaksi akan masuk ke antrian pending",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});