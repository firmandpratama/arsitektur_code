<?php
include "../../koneksi.php";
session_name('sales_apps');
session_start();

$response = array();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $email = mysqli_real_escape_string($koneksi, $email);

    $sql = "SELECT registration_id FROM tbl_face_recognition WHERE email = '$email'";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $registrationNumbers = array();
        foreach ($result as $row) {
            $registrationNumbers[] = $row["registration_id"];
        }

        $response['status'] = 'success';
        $response['data'] = $registrationNumbers;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No records found';
    }

} else {
    $response['status'] = 'error';
    $response['message'] = 'User is not logged in';
}

header('Content-Type: application/json');
echo json_encode($response);
