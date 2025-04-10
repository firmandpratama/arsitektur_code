<?php
$server = "202.52.146.237:3306";
$user = "ncorpid_salesapp";
$password = "E@N8CTH8bytm";
$database = "ncorpid_salesapp";

$koneksi = new mysqli($server, $user, $password, $database);

if ($koneksi->connect_errno) {
    echo "Gagal Konek Ke Database";
    exit();
}


try {
    $dsn = "mysql:host=$server;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
