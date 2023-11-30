<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <title>SIMPASDATA || Senior Home</title>
  <link rel="stylesheet" href="../assets/css/homesenior.css">
</head>
<body>
<?php
        include "../main/menu.php";
		//mengambil data junior
		$jumlahsiswaj = mysqli_query($db, "SELECT COUNT(*) as total FROM siswa WHERE role = 'junior'");
		$jumlahsiswa_dataj = mysqli_fetch_assoc($jumlahsiswaj);
		$totalSiswaJ = $jumlahsiswa_dataj['total'];
    ?>
    <div class="ucapan">
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 1s;">Selamat</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 2s;">	Datang</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 3s;">	<?php $namaSiswa = $_SESSION['namaSiswa'];echo $namaSiswa;
	?></h1>
    </div>
<div class="bodi">
    <div class="bordera">
        <div class="isikan">
            <div class="satu">
                <span class="judul">Daftar Anggota</span>
                    <div class="data">
                        <a href="./junior_manajemen_akun.php?action=klik" class="isidata">
                            <span>Data Junior</span>
                        <ul>
                            <li class="jumlah"><?php echo $totalSiswaJ;?></li>
                            <li>Orang</li>
                        </ul>
                        </a>
                    </div>
            </div>
            <div class="dua">
                <div class="ft">
                    <span>apasa</span>
                    <input type="text" class="search">
                </div>
                <div class="datatable">
                <table>
                    <tr>
                    <th>cakjsa</th>
                    <th>cakjsa</th>
                    <th>cakjsa</th>
                    <th>cakjsa</th>
                    </tr>
                    <tr>
                    <td>adgyi</td>
                    <td>adgyi</td>
                    <td>adgyi</td>
                    <td>adgyi</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
	
</body>
</html>
