<?php

$config = require(__DIR__ . '/../helpers/config.php');
$base_url = $config['API_BASE_URL'];
$username = $config['API_USERNAME'];
$password_auth = $config['API_PASSWORD'];
$email = $config['EMAIL_USER'];
$password = $config['PASSWORD_USER'];

function fetchData($endpoint)
{
    global $base_url, $username, $password_auth, $email, $password;

    $url = "{$base_url}/{$endpoint}";
    $data = [
        "email" => $email,
        "password_view" => $password
    ];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password_auth");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $data);


    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        echo json_encode(["error" => curl_error($ch)]);
        exit;
    }


    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return ["error" => $error];
    }

    curl_close($ch);

    return [
        "status_code" => $http_code,
        "response" => json_decode($response, true)
    ];
}
