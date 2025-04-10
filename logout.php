<?php
include 'koneksi.php';
session_name('sales_apps');
session_start();

$email = $_SESSION['email'] ?? null;

if ($email) {
    $stmt = $koneksi->prepare("UPDATE tbl_face_recognition SET status_aktif = NULL WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->close();
}

$_SESSION = [];
setcookie("id", "", time() - 3600, "/");
setcookie("registration_id", "", time() - 3600, "/");

session_unset();
session_destroy();
session_write_close();

header("Location: index.php");
exit;
