<?php
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
$success = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    $confirm_password = $_POST['confirm_password'] ?? "";

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $err .= "<li>Semua field wajib diisi.</li>";
    } else if ($password != $confirm_password) {
        $err .= "<li>Password dan konfirmasi password tidak sama.</li>";
    } else {
        $password_hashed = md5($password);
        $sql = "SELECT * FROM login WHERE username = '$username'";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $err .= "<li>Username <b>$username</b> sudah terdaftar.</li>";
        } else {
            $insert = "INSERT INTO login (username, password) VALUES ('$username', '$password_hashed')";
            if (mysqli_query($koneksi, $insert)) {
                $success = "Akun berhasil dibuat! <a href='login.php'>Log in</a>";
            } else {
                $err .= "<li>Terjadi kesalahan pada sistem. Silakan coba lagi.</li>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling Body */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #ffdde1, #ee9ca7);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Styling Container */
        .container {
            background: #fff;
            padding: 30px 20px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        h3 {
            font-size: 28px;
            font-weight: bold;
            color: #ee6f89;
            margin-bottom: 10px;
        }

        p.subtitle {
            color: #8e8e8e;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Form Input Styling */
        .form-control {
            border-radius: 20px;
            padding: 12px 15px;
            font-size: 14px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: #ee6f89;
            box-shadow: 0 0 10px rgba(238, 111, 137, 0.3);
            outline: none;
        }

        /* Submit Button */
        .btn-primary {
            background: #ee6f89;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 30px;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background: #e05670;
        }

        /* Additional Links */
        .sign-in-link {
            font-size: 14px;
            margin-top: 10px;
        }

        .sign-in-link a {
            color: #ee6f89;
            text-decoration: none;
            font-weight: bold;
        }

        .sign-in-link a:hover {
            text-decoration: underline;
        }

        /* Cute Decorations with Float */
        .cute-deco {
            position: absolute;
            width: 70px;
            height: 70px;
            opacity: 0.8;
            z-index: 0;
            animation: float 5s infinite ease-in-out;
        }

        /* Positions in Middle */
        .deco-1 {
            top: 20%;
            left: 30%;
            animation-delay: 0s;
        }

        .deco-2 {
            top: 40%;
            right: 25%;
            animation-delay: 1s;
        }

        .deco-3 {
            bottom: 20%;
            left: 35%;
            animation-delay: 2s;
        }

        .deco-4 {
            bottom: 30%;
            right: 20%;
            animation-delay: 3s;
        }

        /* Float Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>

<body>

    <!-- Cute Floating Decorations -->
    <img src="https://cdn-icons-png.flaticon.com/512/2917/2917996.png" alt="Deco" class="cute-deco deco-1">
    <img src="https://cdn-icons-png.flaticon.com/512/204/204287.png" alt="Deco" class="cute-deco deco-2">
    <img src="https://cdn-icons-png.flaticon.com/512/3132/3132115.png" alt="Deco" class="cute-deco deco-3">
    <img src="https://cdn-icons-png.flaticon.com/512/846/846475.png" alt="Deco" class="cute-deco deco-4">

    <!-- Form Container -->
    <div class="container">
        <!-- Title -->
        <h3>Welcome!</h3>
        <p class="subtitle">Create a new account to get started.</p>

        <!-- Error/Success Message -->
        <?php if (!empty($err)) : ?>
            <div class="error-message">
                <ul><?= $err ?></ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="success-message">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="register.php">
            <input type="text" name="username" class="form-control" placeholder="👤 Username" required>
            <input type="password" name="password" class="form-control" placeholder="🔒 Password" required>
            <input type="password" name="confirm_password" class="form-control" placeholder="🔑 Confirm Password" required>
            <button type="submit" name="register" class="btn btn-primary">Sign Up</button>
        </form>

        <!-- Additional Links -->
        <div class="sign-in-link">
            Already have an account? <a href="login.php">Log in</a>
        </div>
    </div>

</body>

</html>


