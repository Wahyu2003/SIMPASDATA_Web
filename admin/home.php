<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <title>SIMPASDATA || Admin Home</title>
  <link rel="stylesheet" href="../assets/css/homeadmin.css">
</head>
<body>
<?php
        include "../main/menu.php";

		//mengambil data pembina
		$jumlahpembina = mysqli_query($db, "SELECT COUNT(*) as total FROM admin WHERE role = 'pembina'");
		$jumlahpembina_data = mysqli_fetch_assoc($jumlahpembina);
		$totalpembina = $jumlahpembina_data['total'];

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
    ?><div class="ucapan">
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 1s;">Selamat</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 2s;">	Datang</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 3s;">	<?php $namaAdmin = $_SESSION['namaAdmin'];echo $namaAdmin;
	?></h1>
    </div>

	<div class="data">
		<a href="./menu_manajemen_akun_pembina.php?action=klik" class="isidata">
			<span>Data Pembina</span>
			<ul>
				<li class="jumlah"><?php echo $totalpembina?></li>
				<li>Orang</li>
			</ul>
		</a><a href="./data_purna.php?action=klik" class="isidata">
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
				<li class="jumlah"><li class="jumlah"><?php echo $totalSiswaJ;?></li></li>
				<li>Orang</li>
			</ul>
		</a>
	</div>

</body>
</html>
