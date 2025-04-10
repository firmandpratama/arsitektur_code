<?php

// $server = "localhost";
// $user = "root";
// $password = "";
// $database = "datacore";
$server = "103.165.58.186:3151";
$user = "alexhmp";
$password = "Keluarga1";
$database = "etiketnew";

$koneksiApi = new mysqli($server, $user, $password, $database);

if ($koneksiApi->connect_errno) {
    echo "Gagal Konek Ke Database";
    exit();
}



function getUsr($koneksi, $email)
{
    $qCheck = "SELECT * FROM tbl_user WHERE email = ? ";
    $stmt = $koneksi->prepare($qCheck);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
