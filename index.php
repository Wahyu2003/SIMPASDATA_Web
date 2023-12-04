<?php
session_start();
require_once("database/koneksi.php");

if(isset($_SESSION['nipAdmin']) && isset($_SESSION['roleAdmin']) == 'admin'){
    header("Location: admin/home.php");
    exit;
}
if(isset($_SESSION['nipAdmin']) && isset($_SESSION['roleAdmin']) == 'pembina'){
    header("Location: pembina/home.php");
    exit;
}
if(isset($_SESSION['nisnSiswa']) && isset($_SESSION['roleSiswa']) == 'senior'){
    header("Location: senior/home.php");
    exit;
}

if(isset($_POST['signin'])){
    //mengambil dari name input
    $nisnnip = $_POST['nisnnip'];
    $password = $_POST['password'];

    //mengambil query ke tabel admin
    $q = mysqli_query($db, "SELECT * FROM admin WHERE nip = '$nisnnip' AND password = '$password' AND status = 'aktif'");
    $adminQ = mysqli_fetch_array($q);
    
    //mengambil query ke tabel siswa
    $r = mysqli_query($db, "SELECT * FROM siswa WHERE nisn = '$nisnnip' AND password = '$password' AND status = 'aktif' AND level = 'allow' AND role = 'senior'");
    $siswaQ = mysqli_fetch_array($r);

    if(mysqli_num_rows($q) == 1){
        $_SESSION['nipAdmin'] = $adminQ['nip'];
        $_SESSION['fotoAdmin'] = $adminQ['foto'];
        $_SESSION['namaAdmin'] = $adminQ['nama'];
        $_SESSION['alamatAdmin'] = $adminQ['alamat'];
        $_SESSION['genderAdmin'] = $adminQ['gender'];
        $_SESSION['emailAdmin'] = $adminQ['email'];
        $_SESSION['noHpAdmin'] = $adminQ['no_hp'];
        $_SESSION['passwordAdmin'] = $adminQ['password'];
        $_SESSION['statusAdmin'] = $adminQ['status'];
        $_SESSION['roleAdmin'] = $adminQ['role'];
        $role = $_SESSION['roleAdmin'];

        if ($role == 'admin') {
            header("Location: admin/home.php");
            exit;
        } elseif ($role == 'pembina') {
            header("Location: pembina/home.php");
            exit;
        }
    } elseif(mysqli_num_rows($r) == 1) {
        $_SESSION['nisnSiswa'] = $siswaQ['nisn'];
        $_SESSION['kelas_idSiswa'] = $siswaQ['kelas_id'];
        $_SESSION['fotoSiswa'] = $siswaQ['foto'];
        $_SESSION['namaSiswa'] = $siswaQ['nama'];
        $_SESSION['genderSiswa'] = $siswaQ['gender'];
        $_SESSION['alamatSiswa'] = $siswaQ['alamat'];
        $_SESSION['emailSiswa'] = $siswaQ['email'];
        $_SESSION['passwordSiswa'] = $siswaQ['password'];
        $_SESSION['noHpSiswa'] = $siswaQ['no_hp'];
        $_SESSION['statusSiswa'] = $siswaQ['status'];
        $_SESSION['roleSiswa'] = $siswaQ['role'];
        $_SESSION['levelSiswa'] = $siswaQ['level'];
        $role = $_SESSION['roleSiswa'];
        $status = $_SESSION['statusSiswa'];
        $level = $_SESSION['levelSiswa'];

        if ($role == 'senior' && $status == 'aktif' && $level == 'allow') {
            header("Location: senior/home.php");
            exit;
        }
    }  else {
        $_SESSION['loginError'] = "NISN/NIP atau Password Salah";
        header("Location: index.php");
        exit;
    }
    unset($_SESSION['loginError']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Sign In</title>
    <link rel="stylesheet" href="assets/css/loginn.css">
    <style>

        .notification-container {
            position: absolute;
            top: 1px; 
            left: 50%;
            transform: translateX(-50%);
        }

        .notification {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .login-container {
            position: relative;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .popup p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
 

        <div class="logo">
            <img src="assets/logo-pasdata-3.png" alt="Logo">
        </div>

        <div class="content">
            <h1 class="simpasdata">SIM<span>PASDATA</span></h1>
            <h4 class="subsimpasdata">SISTEM INFORMASI MANAJEMEN PASKIBRA <br> SMA NEGERI 2 TANGGUL</h4>
        </div>

        <div class="login-form-container">
            <form class="login-form" method="post" onsubmit="return showPopup()">
                <input type="text" name="nisnnip" id="nisnnip" placeholder="Masukan NIS/NIP">

                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi">
                </div>
                <div class="button-sign-in">
                    <button type="submit" name="signin">Masuk</button>
                </div><br>
                <a class="lupasandi" href="forgot_password.php">Lupa kata sandi?</a>
            </form>
        </div>
    </div>

    <div class="popup" id="popup">
        <p>Login Gagal. Periksa NISP/NIP Dan Password Anda.</p>
        <button onclick="hidePopup()">Tutup</button>
    </div>

    <script>
   <?php
if (isset($_SESSION['loginError'])) {
    echo "document.getElementById('popup').style.display = 'block';";
    unset($_SESSION['loginError']);
} else {
    echo "document.getElementById('popup').style.display = 'none';";
}
?>

    function hidePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>

</body>
</html>
