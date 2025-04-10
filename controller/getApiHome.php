<?php

include('../helpers/debug.php');
$url = "https://ncorp.id/apisalesapps.importa.co.id/home.php";
$username = "avaija";
$password = "avaija@$";


$data = [
    "email" => "syaiful.anam@importa.co.id",
    "password_view" => "Importa02"
];
// dd($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
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

curl_close($ch);

$json_data = json_encode([
    "status_code" => $http_code,
    "response" => json_decode($response, true)
], JSON_PRETTY_PRINT);
// echo $json_data;
$data = json_decode($json_data, true);

$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if ($data['status_code'] == 200 && $data['response']['code'] == 1) {
    $list_mitra = $data['response']['value']['list_mitra'];
    $total_data = count($list_mitra);


    $limited_mitra = array_slice($list_mitra, $offset, $limit);


    foreach ($list_mitra as $mitra) {
        $nama_mitra = htmlspecialchars($mitra['mitra_name']);
        $alamat_mitra = htmlspecialchars($mitra['address_retail_mitra']);
        // $tanggal_waktu = isset($mitra['tanggal']) && isset($mitra['waktu']) ? $mitra['tanggal'] . ' ' . $mitra['waktu'] : 'Tanggal tidak tersedia';
        $status = isset($mitra['status_aktivitas']) && $mitra['status_aktivitas'] == 'done' ? 'Pending' : 'Done';
        $status_class = $status == 'Done' ? 'text-success' : 'text-warning';


        echo '
        <div class="card shadow border-right-success">
    <div class="card-body">
        <div class="row align-items-center d-flex">
            <div class="col-2 text-center">
            <i class="fa-solid fa-location-dot fa-3x text-dark"></i>
                
            </div>
            <div class="col-7" style="margin-top: -12px">
              <div class="font-weight-bold text-dark text-uppercase fs-lg fs-md-3 text-truncate" 
                     style="max-width: 100%;" 
                     data-bs-toggle="tooltip" 
                     data-bs-placement="top" 
                     data-bs-trigger="click" 
                     title=" ' . $nama_mitra . '">
                    ' . $nama_mitra . '
                </div>
          
                <div class="font-weight-bold text-dark fs-md-3">
                    22 Januari 2025
                </div>
                <div class="text-dark text-truncate fs-md-3" 
                     style="max-width: 100%;" 
                     data-bs-toggle="tooltip" 
                      data-bs-trigger="click" 
                     title=" ' . $alamat_mitra . '">
                    ' . $alamat_mitra . '
                </div>
               
            </div>
            <div class="col-3 h6  ' . $status_class . ' font-weight-bolder text-end">
            ' . $status . '
            </div>
        </div>
    </div>
</div>

      ';
    }


    echo '<script>var totalData = ' . $total_data . ';</script>';
} else {
    echo "Gagal mengambil data.";
}
