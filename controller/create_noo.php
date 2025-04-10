<?php
session_name('sales_apps');
session_start();
date_default_timezone_set("Asia/Jakarta");
include('../koneksi.php');
include('../helpers/debug.php');
$mitra_name  = $_POST['mitra_name'];
$lat  = $_POST['lat'];
$lng  = $_POST['lng'];
$address  = $_POST['alamat'];

$email_sales = $_SESSION['email'];
$name_sales  = $_SESSION['nama_lengkap'];
$nik_sales   = $_SESSION['nik'];
// dd($_SESSION);
$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg');

$files = [
    'foto_ktp',
    'tampak_depan',
    'tampak_sisi_kiri',
    'tampak_sisi_kanan',
    'tampak_dalam1',
    'tampak_dalam2',
    'tampak_dalam3',
    'nota_kompetitor',
    'form_new_outlet'
];

$file_paths = [];

foreach ($files as $file) {
    if (isset($_FILES[$file]['name']) && $_FILES[$file]['error'] == 0) {
        $ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
        if (!in_array($ext, $ekstensi)) {
            echo ("<script LANGUAGE='JavaScript'>window.alert('Ekstensi Gambar Tidak Cocok'); window.location.href='../new_open_outlet.php'</script>");
            exit;
        }
        $new_filename = $rand . '_' . $_FILES[$file]['name'];
        move_uploaded_file($_FILES[$file]['tmp_name'], 'file_noo/' . $new_filename);
        $file_paths[$file] = $new_filename;
    } else {
        $file_paths[$file] = null;
    }
}

$sql = "INSERT INTO tbl_form_noo (nama_mitra, latitude, longitude, alamat_mitra,  nama_sales, nik_sales, email_sales, foto_ktp, tampak_depan, 
    tampak_sisi_kiri, tampak_sisi_kanan, tampak_dalam1, tampak_dalam2, tampak_dalam3, 
    nota_kompetitor, form_new_outlet, create_time) 
    VALUES ('$mitra_name','$lat','$lng','$address', '$name_sales', '$nik_sales', '$email_sales', 
    '{$file_paths['foto_ktp']}', '{$file_paths['tampak_depan']}', '{$file_paths['tampak_sisi_kiri']}', 
    '{$file_paths['tampak_sisi_kanan']}', '{$file_paths['tampak_dalam1']}', '{$file_paths['tampak_dalam2']}', 
    '{$file_paths['tampak_dalam3']}', '{$file_paths['nota_kompetitor']}', '{$file_paths['form_new_outlet']}', NOW())";

if (mysqli_query($koneksi, $sql)) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('SuccesFully Create New Open Outlet'); window.location.href='../new_open_outlet.php'</script>");
} else {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Create New Open Outlet Is Failed'); window.location.href='../new_open_outlet.php'</script>");
}
