<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <title>SIMPASDATA || Pembina Home</title>
  <link rel="stylesheet" href="../assets/css/homepembina.css">
</head>
<body>
<?php
        include "../main/menu.php";

		//mengambil data Purna
		$jumlahpurna = mysqli_query($db, "SELECT COUNT(*) as total FROM siswa WHERE role = 'purna'");
		$jumlahpurna_data = mysqli_fetch_assoc($jumlahpurna);
		$totalpurna = $jumlahpurna_data['total'];

		//mengambil data senior
		$jumlahsiswas = mysqli_query($db, "SELECT COUNT(*) as total FROM siswa WHERE role = 'senior'");
		$jumlahsiswa_datas = mysqli_fetch_assoc($jumlahsiswas);
		$totalSiswaS = $jumlahsiswa_datas['total'];

		//mengambil data junior
		$jumlahsiswaj = mysqli_query($db, "SELECT COUNT(*) as total FROM siswa WHERE role = 'junior'");
		$jumlahsiswa_dataj = mysqli_fetch_assoc($jumlahsiswaj);
		$totalSiswaJ = $jumlahsiswa_dataj['total'];
    ?>
    <div class="ucapan">
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 1s;">Selamat</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 2s;">	Datang</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 3s;">	<?php $namaAdmin = $_SESSION['namaAdmin'];echo $namaAdmin;
	?></h1>
    </div>
<div class="bodi">
  <div class="bordera">
    <span class="judul">Daftar Anggota</span>
    <div class="data">
      
      <a href="./data_purna.php?action=klik" class="isidata">
        <span>Data Purna</span>
        <ul>
          <li class="jumlah"><?php echo $totalpurna ?></li>
          <li>Orang</li>
        </ul>
      </a><a href="./menu_manajemen_akun_senior.php?action=klik" class="isidata">
        <span>Data Senior</span>
        <ul>
          <li class="jumlah"><?php echo $totalSiswaS;?></li>
          <li>Orang</li>
        </ul>
      </a><a href="./junior_manajemen_akun.php?action=klik" class="isidata">
        <span>Data Junior</span>
        <ul>
          <li class="jumlah"><?php echo $totalSiswaJ;?></li>
          <li>Orang</li>
        </ul>
      </a>
    </div>
  </div>
  <div class="bordern">
    <span class="judul">5 Nilai Tertinggi</span>
    <div class="isikan">
      <div class="satu">
        <div class="ft">
          <span>Senior</span>
          <input type="text" class="search">
        </div>
        <div class="datatable">
          <table>
            <tr>
              <th>NISN</th>
              <th>Nama Lengkap</th>
              <th>Kelas</th>
              <th>Total Nilai</th>
            </tr>
            <tr>
              <td><?php ?></td>
              <td><?php ?></td>
              <td><?php ?></td>
              <td><?php ?></td>
            </tr>
          </table>
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
              <th>NISN</th>
              <th>Nama Lengkap</th>
              <th>Kelas</th>
              <th>Total Nilai</th>
            </tr>
            <tr>
              <td><?php ?></td>
              <td><?php ?></td>
              <td><?php ?></td>
              <td><?php ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
	

</body>
</html>
