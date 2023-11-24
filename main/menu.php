<?php  include "../main/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  
	<!-- My CSS -->
	<link rel="stylesheet" href="../main/style.css">

	<title>SideBar</title>
</head>
<body>
    <?php
        if ($role == 'admin') { ?>

	<!-- SIDEBAR -->
    <section id="sidebar">
      <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
          <span class="text">
          <?php 
                $namaAdmin = $_SESSION['namaAdmin'];
                echo $namaAdmin;?> || Admin
          </span>
        
      </a>
      <ul class="side-menu top">
        <li class="active">
          <a href="./home.php">
            <i class='bx bx-home-alt' ></i>
            <span class="text">Home</span>
          </a>
        </li>
        <li>
          <a href="./menu_manajemen_akun_pembina.php">
            <i class='bx bxs-user-account' ></i>
            <span class="text">Manajemen Akun Pembina</span>
          </a>
        </li>
        <li>
          <a href="./menu_manajemen_akun_senior.php">
            <i class='bx bxs-doughnut-chart' ></i>
            <span class="text">Manajemen Akun Senior</span>
          </a>
        </li>
        <li>
          <a href="./junior_manajemen_akun.php">
            <i class='bx bxs-message-dots' ></i>
            <span class="text">Manajemen Akun Junior</span>
          </a>
        </li>
        <li>
          <a href="./data_terhapus.php">
            <i class='bx bx-trash' ></i>
            <span class="text">Data Terhapus</span>
          </a>
        </li>
      </ul>
      <?php }
      elseif ($role == 'pembina') { ?>
    <!-- SIDEBAR -->
      <section id="sidebar">
        <a href="#" class="brand">
          <i class='bx bxs-smile'></i>
            <span class="text">
            <?php 
                  $namaAdmin = $_SESSION['namaAdmin'];
                  echo $namaAdmin;?> || Admin
            </span>
          
        </a>
        <ul class="side-menu top">
          <li class="active">
            <a href="./home.php">
              <i class='bx bx-home-alt' ></i>
              <span class="text">Home</span>
            </a>
          </li>
          <li>
            <a href="./menu_manajemen_akun_senior.php">
              <i class='bx bxs-doughnut-chart' ></i>
              <span class="text">Manajemen Akun Senior</span>
            </a>
          </li>
          <li>
            <a href="./junior_manajemen_akun.php">
              <i class='bx bxs-message-dots' ></i>
              <span class="text">Manajemen Akun Junior</span>
            </a>
          </li>
          <li>
            <a href="./nilai_senior.php">
              <i class='bx bx-edit' ></i>
              <span class="text nav-text">Nilai Senior</span>
            </a>
          </li>
          <li>
            <a href="./data_terhapus.php">
              <i class='bx bx-trash' ></i>
              <span class="text">Data Terhapus</span>
            </a>
          </li>
        </ul>
      <?php }
      elseif ($role == 'senior') { ?>
      <!-- SIDEBAR -->
        <section id="sidebar">
          <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
              <span class="text">
              <?php 
                    $namaSiswa = $_SESSION['namaSiswa'];
                    echo $namaSiswa;?> || Senior
              </span>
          </a>
          <ul class="side-menu top">
            <li class="active">
              <a href="./home.php">
                <i class='bx bx-home-alt' ></i>
                <span class="text">Home</span>
              </a>
            </li>
            <li>
              <a href="./junior_manajemen_akun.php">
                <i class='bx bxs-message-dots' ></i>
                <span class="text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li>
              <a href="./nilai_junior.php">
                <i class='bx bx-edit' ></i>
                <span class="text nav-text">Nilai Senior</span>
              </a>
            </li>
            <li>
              <a href="./data_terhapus.php">
                <i class='bx bx-trash' ></i>
                <span class="text">Data Terhapus</span>
              </a>
            </li>
          </ul>
          <?php } ?>


      <ul class="side-menu">
        <li>
          <a href="#">
            <i class='bx bxs-cog' ></i>
            <span class="text">Settings</span>
          </a>
        </li>
        <li>
        <a href="../main/signout.php" class="logout">
            <i class='bx bxs-log-out-circle' ></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </section>
	<!-- SIDEBAR -->
  

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
      <?php
        if ($role == 'admin') { ?>
          <a href="./profil.php" class="profile">
            <i class='bx bx-user icons'></i>
          </a>
      <?php }
        elseif ($role == 'pembina') { ?>
        <a href="./profil.php" class="profile">
            <i class='bx bx-user icons'></i>
          </a>
      <?php }
        elseif ($role == 'senior') { ?>
        <a href="./profil.php" class="profile">
            <i class='bx bx-user icons'></i>
          </a>
      <?php } ?>
			<!-- <a href="#" class="profile">
				<img src="img/people.png">
			</a> -->
		</nav>
		<!-- NAVBAR -->
		<!-- MAIN -->
	</section>
	<script src="../main/script.js"></script>
</body>
</html>