<?php
session_name('sales_apps');
session_start();
include('../koneksi.php');

if (!isset($_SESSION['email'])) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Anda terdeteksi belum login, silahkan login terlebih dahulu!!'); window.location.href='../logout.php'</script>");
    exit();
}

$email = $_SESSION['email'];
$nik_sales = $_SESSION['nik'];
$rand = $nik_sales;
$ekstensi = array('png', 'jpg', 'jpeg');
$filename = $_FILES['foto_profil']['name'];
$ukuran = $_FILES['foto_profil']['size'];
$tmp_name = $_FILES['foto_profil']['tmp_name'];
$error = $_FILES['foto_profil']['error'];
$image = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if ($error !== UPLOAD_ERR_OK) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Terjadi kesalahan saat mengunggah file.'); window.location.href='../profile_account.php'</script>");
    exit();
} elseif (!in_array($image, $ekstensi)) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Ekstensi gambar tidak sesuai.'); window.location.href='../profile_account.php'</script>");
    exit();
} elseif ($ukuran > 500000) {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Ukuran gambar maksimal 500KB.'); window.location.href='../profile_account.php'</script>");
    exit();
}

$query = "SELECT foto_profil FROM tbl_face_recognition WHERE email = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $old_foto);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if (!empty($old_foto) && file_exists('../assets/images/avatar/' . $old_foto)) {
    unlink('../assets/images/avatar/' . $old_foto);
}

$xx = $rand . '_' . $filename;
$target_path = '../assets/images/avatar/' . $xx;

if (move_uploaded_file($tmp_name, $target_path)) {
    $stmt = mysqli_prepare($koneksi, "UPDATE tbl_face_recognition SET foto_profil = ? WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "ss", $xx, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Profil berhasil diperbarui.'); window.location.href='../profile_account.php'</script>");
    } else {
        echo ("<script LANGUAGE='JavaScript'>window.alert('Gagal memperbarui profil. Error: " . mysqli_error($koneksi) . "'); window.location.href='../profile_account.php'</script>");
    }
    mysqli_stmt_close($stmt);
} else {
    echo ("<script LANGUAGE='JavaScript'>window.alert('Gagal mengunggah file.'); window.location.href='../profile_account.php'</script>");
}
