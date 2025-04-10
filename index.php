<?php
session_name('sales_apps');
session_start();
include 'koneksi.php';

if (isset($_COOKIE['registration_id'])) {
    header("Location: home.php");
    exit();
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkStatus = mysqli_query($koneksi, "SELECT status_aktif FROM tbl_face_recognition WHERE email = '$email'");
    $status = mysqli_fetch_assoc($checkStatus);

    if ($status['status_aktif'] == 'N') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                const verificationContainer = document.createElement('div');
                verificationContainer.classList.add('verification-container');
        
                const verificationBox = document.createElement('div');
                verificationBox.classList.add('verification-box');
                verificationBox.style.backgroundColor = 'rgba(200, 0, 0, 0.85)';
                verificationBox.innerHTML = `<span class='icon'>&#10060;</span> Akun disabled! <br>Silakan hubungi IT.`;
        
                verificationContainer.appendChild(verificationBox);
                document.body.appendChild(verificationContainer);
        
                setTimeout(() => {
                    document.body.removeChild(verificationContainer);
                }, 2000);
            });
        </script>";
    } else if ($status['status_aktif'] == 'Y') {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            const verificationContainer = document.createElement('div');
            verificationContainer.classList.add('verification-container');
    
            const verificationBox = document.createElement('div');
            verificationBox.classList.add('verification-box');
            verificationBox.style.backgroundColor = 'rgba(200, 0, 0, 0.85)';
            verificationBox.innerHTML = `<span class='icon'>&#10060;</span> Akun tidak dapat digunakan dengan double device!`;
    
            verificationContainer.appendChild(verificationBox);
            document.body.appendChild(verificationContainer);
    
            setTimeout(() => {
                document.body.removeChild(verificationContainer);
            }, 2000);
        });
    </script>";
    } else {
        $checkQuery = mysqli_query($koneksi, "SELECT login_count FROM tbl_face_recognition WHERE email = '$email'");
        $count = mysqli_fetch_assoc($checkQuery);

        if ($count['login_count'] >= 3) {
            $updateQuery = mysqli_query($koneksi, "UPDATE tbl_face_recognition SET status_aktif = 'N' WHERE email = '$email'");

            if ($updateQuery) {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const verificationContainer = document.createElement('div');
                    verificationContainer.classList.add('verification-container');
            
                    const verificationBox = document.createElement('div');
                    verificationBox.classList.add('verification-box');
                    verificationBox.style.backgroundColor = 'rgba(200, 0, 0, 0.85)';
                    verificationBox.innerHTML = `<span class='icon'>&#10060;</span> Akun disabled! <br>Anda terlalu banyak melakukan percobaan.`;
            
                    verificationContainer.appendChild(verificationBox);
                    document.body.appendChild(verificationContainer);
            
                    setTimeout(() => {
                        document.body.removeChild(verificationContainer);
                    }, 2000);
                });
            </script>";
            } else {
                echo "Gagal memperbarui status_aktif: " . mysqli_error($koneksi);
            }
        } else {
            $api_url = "https://avaija.com/etiket/api-login.php";

            $options = [
                'http' => [
                    'header'  => "Authorization: Basic " . base64_encode("avaija:avaija@$") . "\r\n" .
                        "Content-Type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query([
                        'email' => $email,
                        'password' => $password
                    ])
                ]
            ];

            $context  = stream_context_create($options);
            $response = @file_get_contents($api_url, false, $context);
            $user_data = json_decode($response, true);

            if (isset($user_data['status']) && $user_data['status'] === "Error") {
                echo "<script>alert('" . addslashes($user_data['Message']) . "');</script>";
            }

            if ($user_data && isset($user_data['status_aktif']) && $user_data['status_aktif'] === 'Y') {
                if (password_verify($password, $user_data['password_hash'])) {
                    $_SESSION['nama_lengkap'] = $user_data['nama_lengkap'];
                    $_SESSION['email'] = $user_data['email'];
                    $_SESSION['nik'] = $user_data['nik'];
                    $_SESSION['jabatan'] = $user_data['jabatan'];
                    $_SESSION['password_hash'] = $user_data['password_hash'];
                    $_SESSION['password_view'] = $user_data['password_view'];
                    $_SESSION['kode_cabang'] = $user_data['kode_cabang'];
                    $_SESSION['no_hp'] = $user_data['no_hp'];
                    $_SESSION['status_aktif'] = $user_data['status_aktif'];
                    $_SESSION['department'] = $user_data['department'];
                    $_SESSION['divisi'] = $user_data['divisi'];
                    $_SESSION['region_area'] = $user_data['region_area'];
                    $_SESSION['nama_singkat'] = $user_data['nama_singkat'];
                    $_SESSION['jabatan_singkat'] = $user_data['jabatan_singkat'];
                    $_SESSION['login'] = true;

                    echo "<script>window.location='face_create.php'</script>";
                } else {
                    echo "<script>alert('Password salah!');</script>";
                }
            } else {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const verificationContainer = document.createElement('div');
                    verificationContainer.classList.add('verification-container');
            
                    const verificationBox = document.createElement('div');
                    verificationBox.classList.add('verification-box');
                    verificationBox.style.backgroundColor = 'rgba(200, 0, 0, 0.85)';
                    verificationBox.innerHTML = `<span class='icon'>&#10060;</span> Email atau password tidak sesuai!`;
            
                    verificationContainer.appendChild(verificationBox);
                    document.body.appendChild(verificationContainer);
            
                    setTimeout(() => {
                        document.body.removeChild(verificationContainer);
                    }, 2000);
                });
            </script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="manifest" href="/sales_app/assets/js/web.webmanifest">
    <title>Sales App Importa - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;

        }

        img {
            height: 70vh;
            width: 40%;
        }

        @media screen and (max-width: 992px) {
            img {
                width: 100%;
                height: 50vh;
            }
        }

        .verification-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .verification-box {
            background-color: rgba(0, 128, 0, 0.85);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        .icon {
            font-size: 24px;
            color: yellow;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 10px;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #D9D9D9;
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px;
            /* Memberikan ruang untuk ikon */
        }

        .show-pass {
            position: absolute;
            right: 10px;
            cursor: pointer;
            color: #555;
        }

        .show-pass i {
            font-size: 18px;
        }


        .forgot-password {
            display: block;
            text-align: right;
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }

        .login-btn {
            background: #C10910;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .help-text {
            font-size: 12px;
            margin-top: 20px;
            color: #555;
        }

        .help-text a {
            font-weight: 600;
            text-decoration: none;
            color: #000;
        }

        /* Container untuk gambar */
        .image-container {
            position: absolute;
            top: 0%;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 450px;
            z-index: -1;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Media Query untuk tablet */
        @media (min-width: 600px) {
            .image-container {
                max-width: 100%;
            }
        }


        /* Curved Container */
        .curved-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60vh;
            text-align: center;
            padding: 30px 40px;
            background: #ffffff;
            border-radius: 10% 10% 0 0;
            box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="image-container">
        <img src="assets/images/cover_login.png" width="100" alt="Header Image">
    </div>
    <div class="curved-container">
        <h2>SIAP (SALES IMPORTA APPLICATION)</h2>
        <p>Welcome! Please enter your username and password.</p>
        <form action="" enctype="multipart/form-data" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Masukkan email anda" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Masukkan password anda" required>
                    <span class="input-group-text show-pass" onclick="togglePassword()">
                        <i class="fa fa-eye-slash" id="eye-slash"></i>
                        <i class="fa fa-eye" id="eye" style="display: none;"></i>
                    </span>
                </div>
            </div>

            <button class="login-btn" name="login">Login</button>
        </form>
        <p class="help-text" style="padding-bottom: 20px;">Need help logging in? Contact help.<br><a href="#">Support Service IT Department</a></p>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            var eyeSlash = document.getElementById("eye-slash");
            var eye = document.getElementById("eye");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeSlash.style.display = "none";
                eye.style.display = "inline";
            } else {
                passwordInput.type = "password";
                eyeSlash.style.display = "inline";
                eye.style.display = "none";
            }
        }
    </script>
</body>

</html>