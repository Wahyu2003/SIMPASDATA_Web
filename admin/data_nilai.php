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
        ?><div class="ucapan">
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 1s;">Data</h1>
		<h1 class="animate__animated animate__fadeIn" style="--animate-duration: 2s;">	Nilai</h1>
    </div>

	<div class="data">
        <a href="./data_nilai_junior.php" class="isidata">
			<ul>
				<li class="jumlah"><div class="bx bx-book"></div></li>
				<li>Data Junior</li>
			</ul>
		</a><a href="./data_nilai_senior.php" class="isidata">
			<ul>
			<li class="jumlah"><div class="bx bx-book-bookmark"></div></li>
				<li>Data Senior</li>
			</ul>
		</a>
	</div>

</body>
</html>
