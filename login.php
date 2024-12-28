<?php
//memulai session start
session_start();

$host = "localhost";
$uname = "root";
$pword = "";
$dbname = "perpustakaan";

$koneksi = mysqli_connect($host, $uname, $pword, $dbname);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    

    if (empty($username) || empty($password)) {
        $err = "Silakan masukkan username dan password.";
    } else {
        $sql = "SELECT * FROM login WHERE username = '$username'";
        $result = mysqli_query($koneksi, $sql);

        if ($result) {
            $user = mysqli_fetch_array($result);
            if (!$user) {
                $err = "Username tidak ditemukan.";
            } else if ($user['password'] != md5($password)) {
                $err = "Password salah.";
            } else {
                $_SESSION['session_username'] = $username;
                $_SESSION['login'] = 'oke';
                header("Location: index.php");
                exit();
            }
        } else {
            $err = "Terjadi kesalahan pada sistem. Silakan coba lagi.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling Global */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffecf7; /* Warna latar belakang lembut */
            overflow: hidden;
        }

        .container-fluid {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #ff7ce5, #fcd3ff); /* Gradasi warna pastel */
            position: relative;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 15px 40px rgba(0, 0, 0, 0.1);
            display: flex;
            max-width: 900px;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .login-image {
            background: url('cover/loginimage.jpg') no-repeat center center;
            background-size: cover;
            width: 50%;
            border-radius: 20px 0 0 20px;
        }

        .login-form {
            padding: 40px;
            width: 50%;
        }

        .login-form h2 {
            font-weight: bold;
            color: #f78da7; /* Warna pink pastel */
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #ff7ce5; /* Warna fokus lembut */
            box-shadow: 0 0 8px rgba(255, 124, 229, 0.6);
        }

        .btn-login {
            background-color: #f78da7; /* Warna tombol pink pastel */
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
        }

        .btn-login:hover {
            background-color: #ff7ce5; /* Warna hover */
        }

        .login-form a {
            text-decoration: none;
            color: #ff7ce5; /* Warna link pastel */
        }

        .login-form .options {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-top: -10px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-login img {
            width: 40px;
            height: auto;
        }

        /* Dekorasi Lucu Float */
        .cute-deco {
            position: absolute;
            width: 80px;
            height: 80px;
            opacity: 0.8;
            z-index: 0;
            animation: float 5s infinite ease-in-out;
        }

        .deco-1 {
            top: 15%;
            left: 5%;
            animation-delay: 0s;
        }

        .deco-2 {
            top: 60%;
            left: 50%;
            animation-delay: 2s;
        }

        .deco-3 {
            bottom: 10%;
            right: 10%;
            animation-delay: 1.5s;
        }

        .deco-4 {
            top: 40%;
            right: 20%;
            animation-delay: 3s;
        }

        /* Animasi Float */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body>
    <!-- Container -->
    <div class="container-fluid">
        <!-- Dekorasi Lucu Floating -->
        <img src="https://cdn-icons-png.flaticon.com/512/846/846475.png" class="cute-deco deco-1" alt="deco">
        <img src="https://cdn-icons-png.flaticon.com/512/2917/2917996.png" class="cute-deco deco-2" alt="deco">
        <img src="https://cdn-icons-png.flaticon.com/512/204/204287.png" class="cute-deco deco-3" alt="deco">
        <img src="https://cdn-icons-png.flaticon.com/512/3132/3132115.png" class="cute-deco deco-4" alt="deco">

        <!-- Login Card -->
        <div class="login-card">
            <!-- Sisi Kiri -->
            <div class="login-image"></div>

            <!-- Sisi Kanan -->
            <div class="login-form">
                <h2>Welcome To SI Perpus 💖</h2>
                <form method="POST" action="login.php">
                    <input type="text" name="username" class="form-control" placeholder="Username or Email" required>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>

                    <div class="options">
                        <div>
                            <input type="checkbox" id="remember-me">
                            <label for="remember-me">Remember me</label>
                        </div>
                        <a href="#">Forgot password?</a>
                    </div>

                    <button type="submit" name="login" class="btn btn-login">Login</button>
                </form>

                <div class="text-center mt-3">
                    <span>Don't have an account? <a href="register.php">Sign up</a></span>
                </div>

                <!-- Social Media Login -->
                <div class="social-login">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" alt="Apple">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991145.png" alt="Google">
                </div>
            </div>
        </div>
    </div>
</body>

</html>



