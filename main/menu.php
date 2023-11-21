<?php include "../main/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SideBar</title>
    <link rel="stylesheet" href="../main/menu.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    />
  </head>
  <body>
    <nav class="sidebar">
      <header>
        
        <i class="bx bx-chevron-right toggle"></i>
      </header>
      <?php
     if ($role == 'admin') { ?>
     <div class="text header-text">
            <span class="main"> <?php 
        $namaAdmin = $_SESSION['namaAdmin'];
        echo $namaAdmin;
    ?> || Admin</span>
          </div>
      <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="search-bar">
              <i class="bx bx-search icons"></i>
              <input type="search" placeholder="Search..." />
            </li>
            <li class="nav-link">
              <a href="./home.php">
                <i class="bx bx-home-alt icons"></i>
                <span class="text nav-text">Home</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_manajemen_akun_senior.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./junior_manajemen_akun.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_manajemen_akun_pembina.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Pembina</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./data_terhapus.php">
                <i class='bx bx-trash icons'></i>
                <span class="text nav-text">Data Terhapus</span>
              </a>
            </li>
          </ul>
        </div>
      <?php } elseif ($role == 'pembina') { ?>
        <div class="text header-text">
            <span class="main"> <?php 
        $namaAdmin = $_SESSION['namaAdmin'];
        echo $namaAdmin;
    ?> || Pembina</span>
          </div>
          <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="search-bar">
              <i class="bx bx-search icons"></i>
              <input type="search" placeholder="Search..." />
            </li>
            <li class="nav-link">
              <a href="./home.php">
                <i class="bx bx-home-alt icons"></i>
                <span class="text nav-text">Home</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_manajemen_akun_senior.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./junior_manajemen_akun.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./nilai_senior.php">
                <i class='bx bx-edit icons'></i>
                <span class="text nav-text">Nilai Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./data_terhapus.php">
                <i class='bx bx-trash icons'></i>
                <span class="text nav-text">Data Terhapus</span>
              </a>
            </li>
            
          </ul>
        </div>
        <?php }elseif ($role == 'senior') { ?>
          <div class="text header-text">
            <span class="main"> <?php 
        $namaSiswa = $_SESSION['namaSiswa'];
        echo $namaSiswa;
    ?> || Senior</span>
          </div>
          <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="search-bar">
              <i class="bx bx-search icons"></i>
              <input type="search" placeholder="Search..." />
            </li>
            <li class="nav-link">
              <a href="./home.php">
                <i class="bx bx-home-alt icons"></i>
                <span class="text nav-text">Home</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./junior_manajemen_akun.php">
                <i class='bx bxs-user-account icons'></i>
                <span class="text nav-text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./nilai_junior.php">
                <i class='bx bx-edit icons'></i>
                <span class="text nav-text">Nilai Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./data_terhapus.php">
                <i class='bx bx-trash icons'></i>
                <span class="text nav-text">Data Terhapus</span>
              </a>
            </li>
          </ul>
        </div>
        <?php } ?>
        <ul class="bottom-content"> <!-- Perbaikan: Gunakan elemen ul untuk memasukkan elemen li -->
          <li class="nav-link">
            <a href="../main/profil.php">
              <i class='bx bx-user icons'></i>
              <span class="text nav-text"> Profil</span>
            </a>
          </li>
          <li class="mode">
            <div class="moon-sun">
              <i class="bx bx-moon icons moon"></i>
              <i class="bx bx-sun icons sun"></i>
            </div>
            <span class="mode-text text">Dark Mode</span>
            <div class="toggle-switch">
              <span class="switch"></span>
            </div>
          </li>
          <li class="nav-link">
            <a href="../main/signout.php">
              <i class="bx bx-log-out icons"></i>
              <span class="text nav-text"> Log Out</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <script src="../main/script.js"></script>
  </body>
</html>
