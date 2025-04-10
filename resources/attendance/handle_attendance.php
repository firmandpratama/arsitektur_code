<?php
session_name('sales_apps');
session_start();
header("Content-Type: application/json");
include "../../koneksi.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => "error", "message" => "Invalid request data"]);
    exit;
}

$stmt = $koneksi->prepare("INSERT INTO tbl_attendance_sales (registration_id, email, nama_lengkap, create_time) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "SQL error: " . $koneksi->error]);
    exit;
}

$stmt->bind_param("ssss", $registrationId, $email, $nama, $create_time);

foreach ($data as $entry) {
    $registrationId = $entry['registrationId'];
    $email = $entry['email'];
    $nama = $entry['nama'];
    $create_time = $entry['create_time'];

    if (!$stmt->execute()) {
        echo json_encode(["status" => "error", "message" => "Failed to insert data"]);
        exit;
    }
}

$stmt->close();

$updateStmt = $koneksi->prepare("UPDATE tbl_face_recognition SET status_aktif = 'Y' WHERE email = ?");
if ($updateStmt) {
    $updateStmt->bind_param("s", $email);
    $updateStmt->execute();
    $updateStmt->close();
}

$koneksi->close();

echo json_encode(["status" => "success", "message" => "Verified!"]);
setcookie("registration_id", $registrationId, time() + (86400 * 30), "/");
setcookie("id", base64_encode($email), time() + (86400 * 30), "/");
?>
