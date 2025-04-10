<?php
session_name('sales_apps');
session_start();
header("Content-Type: application/json");
include "../../koneksi.php";

if (!isset($_SESSION['email'])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit();
}

$email = $_SESSION['email'];

$query = "SELECT login_count FROM tbl_face_recognition WHERE email = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$failureCount = $row ? $row['login_count'] : 0;

$failureCount += 1;

$updateQuery = "UPDATE tbl_face_recognition SET login_count = ? WHERE email = ?";
$stmt = $koneksi->prepare($updateQuery);
$stmt->bind_param("is", $failureCount, $email);
$stmt->execute();

echo json_encode(["status" => "success", "failure_count" => $failureCount]);
?>
