<?php
require ('koneksi.php');
session_start();

if (isset($_POST['submit'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['txt_user']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['txt_pass']);
    // $email = $_POST['txt_email'];
    // $pass = $_POST['txt_pass'];

    if (!empty(trim($user)) && !empty(trim($pass))) {
        $query  = "SELECT * FROM admin WHERE username = '$user'";
        $result = mysqli_query($koneksi, $query);
        $num    = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $id = $row['id'];
        $userVal = $row['username'];
        $passVal = $row['password'];
        $userName = $row['nama'];
        
        
        if ($num != 0) {
            if ($userVal==$user && $passVal==$pass) {
                echo "<div class=\"notif\"><h1>Pendaftaran berhasil! Akun Anda telah dibuat</h1></div>";
                header('Location: home.php');
                session_start();
                $_SESSION['nama'] = $userName;

            }else {
                $error = "user atau password salah!!";
                echo $error;
                header('Location: login.php');
            }
        } else {
            $error = "user tidak ditemukan!!";
            echo $error;
            header('Location: login.php');
        }
    } else {
        $error = "Data tidak boleh kosong!!";
        echo $error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="assets/image/logo-pasdata-3.png" alt="Logo">
        </div>
        <div class="content">
            <h1 class="simpasdata">SIM<span>PASDATA</span></h1>
            <h4 class="subsimpasdata">SISTEM INFORMASI MANAJEMEN PASKIBRA SMA NEGERI 2 TANGGUL</h4>
        </div>
        <div class="login-form-container">
            <form class="login-form" method="post" action="login.php">
                 Input fields for username and password 
                <div class="form-group">
                    <input type="text" id="txt_user" name="txt_user" required placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" id="txt_pass" name ="txt_pass" required placeholder="Password">
                </div>
                <div class="button-sign-in">
                    <button type="submit" name="submit">Masuk</button>
                    <a class="lupasandi" href="lupasandi.php">Lupa kata sandi</a>
                </div>
            </form>
        </div>
    </div>
</body> 
</html>