 <?php
session_start();
require_once("database/koneksi.php");

if(isset($_SESSION['nipAdmin']) && $_SESSION['roleAdmin'] == 'admin'){
    header("Location: admin/home.php");
    exit;
}elseif(isset($_SESSION['nipAdmin']) && $_SESSION['roleAdmin'] == 'pembina'){
    header("Location: pembina/home.php");
    exit;
}elseif(isset($_SESSION['nisnSiswa']) && $_SESSION['roleSiswa'] == 'senior'){
    header("Location: senior/home.php");
    exit;
}

if(isset($_POST['signin'])){
    //mengambil dari name input
    $nisnnip = $_POST['nisnnip'];
    $password = $_POST['password'];

    //mengambil query ke tabel admin
    $q = mysqli_query($db, "SELECT * FROM admin WHERE nip = '$nisnnip' AND password = '$password'");
    $adminQ = mysqli_fetch_array($q);
    //mengambil query ke tabel siswa
    $r = mysqli_query($db, "SELECT * FROM siswa WHERE nisn = '$nisnnip' AND password = '$password'");
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
    } else {
        echo "gagal autentifikasi";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Sign In</title>
    <link rel ="stylesheet" href="assets/css/loginn.css">
</head>
<body>
    <div class="login-container">
                <div class="logo">
                    <img src="assets/logo-pasdata-3.png" alt="Logo">
                </div>
        
            <div class="content">
                
                <h1 class="simpasdata">SIM<span>PASDATA</span></h1>
                <h4 class="subsimpasdata">SISTEM INFORMASI MANAJEMEN PASKIBRA SMA NEGERI 2 TANGGUL</h4>
                <h2>Sign In</h2>
            </div>
            <div class="login-form-container">
                <form class ="login-form" method="post" action="index.php">
                    <label for="nisnnip">NISN/NIP</label>
                    <input type="text" name="nisnnip" id="nisnnip" placeholder="Masukkan NISN/NIP..">
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password..">
                </div>
                <div class = "button-sign-in">
                    
                    <button type="submit" name="signin">Sign In</button>
                    
                    <a class="lupasandi" href="main/forgot-password.php">Lupa kata sandi?</a>
                
                </div>
            </div>
        </form>
</div>
</body>
</html>