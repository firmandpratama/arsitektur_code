<?php
session_name('sales_apps');
session_start();
include 'koneksiAPI.php';
include 'helpers/debug.php';



$emailLog = base64_decode($_COOKIE['id']);
$usr = getUsr($koneksiApi, $emailLog);

if ($usr['status_aktif'] != 'Y') {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Anda terdeteksi belum login, silahkan login terlebih dahulu!!'); window.location.href='logout.php'</script>");
} elseif ($usr['status_aktif'] == 'Y') {
    $status_aktif = $usr['status_aktif'];
    $email = $usr['email'];
    $job_name = $usr['jabatan_singkat'];
    $name_sales = $usr['nama_lengkap'];
    $nik_sales = $usr['nik'];
    $divisi = $usr['divisi'];
    $password_view = $usr['password_view'];
    $jabatan_pos = $usr['jabatan'];
    $kode_cabang = $usr['kode_cabang'];
}

// dd($password);


if (
    isset($_COOKIE['activity_id']) && !empty($_COOKIE['activity_id']) &&
    !in_array(basename($_SERVER['PHP_SELF']), ['store_activity_report.php', 'store_activity_co.php', 'store_activity_cam_out.php'])
) {
    header("Location: store_activity_report.php?checkID=" . $_COOKIE['activity_id']);
    exit();
}








?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "meta.php"; ?>

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- Title -->
    <title>Sales Apps | Importa</title>

    <!-- PWA Version -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#0d0072" />
    <link rel="manifest" href="/sales_apps/assets/js/web.webmanifest">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/vendor/swiper/swiper-bundle.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


</head>

<body>
    <div class="page-wraper">

        <!-- Header -->

        <!-- Header End -->