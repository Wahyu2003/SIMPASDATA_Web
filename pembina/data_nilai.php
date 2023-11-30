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
		<div class="dataisi">
			
        <a href="./data_nilai_junior.php" class="isidata">
			<span>Data Junior</span>
			<ul>
				<li class="jumlah"><div class="bx bx-book"></div></li>
			</ul>
		</a><a href="./data_nilai_senior.php" class="isidata">
			<Span>Data Senior</Span>
			<ul>
				<li class="jumlah"><div class="bx bx-book-bookmark"></li>
			</ul>
		</a>
		<a href="./nilai_junior.php" class="isidata">
			<span>Input Nilai Junior</span>
			<ul>
				<li class="jumlah"><i class='bx bx-add-to-queue'></i></li>
			</ul>
		</a><a href="./nilai_senior.php" class="isidata">
			<Span>Input Nilai Senior</Span>
			<ul>
				<li class="jumlah"><i class='bx bxs-add-to-queue'></i></li>
			</ul>
		</a>
		</div>
	</div>

</body>
</html>
