<?php include "../main/auth.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive navbar</title>
    <link rel="stylesheet" href="../main/menu.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    />
  </head>
  <body>
    <nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="logo.png" alt="logo" />
          </span>
          
        </div>
        <i class="bx bx-chevron-right toggle"></i>
      </header>
      <?php
     if ($role == 'admin') { ?>
     <div class="text header-text">
            <span class="main">Admin</span>
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
                <i class="bx bx-bar-chart-alt-2 icons"></i>
                <span class="text nav-text">Manajemen Akun Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_manajemen_akun_junior.php">
                <i class="bx bx-bell icons"></i>
                <span class="text nav-text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="menu_manajemen_akun_pembina.php">
                <i class="bx bx-pie-chart-alt icons"></i>
                <span class="text nav-text">Manajemen Akun Pembina</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_keaktifan_senior.php">
                <i class="bx bx-heart icons"></i>
                <span class="text nav-text">Nilai Keaktifan Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_pola_pikir_senior.php">
                <i class="bx bx-wallet-alt icons"></i>
                <span class="text nav-text">Nilai Pola Pikir Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_sikap_senior.php">
                <i class="bx bx-wallet-alt icons"></i>
                <span class="text nav-text">Nilai Sikap Senior</span>
              </a>
            </li>
          </ul>
        </div>
      <?php } elseif ($role == 'pembina') { ?>
        <div class="text header-text">
            <span class="main">Pembina</span>
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
                <i class="bx bx-bar-chart-alt-2 icons"></i>
                <span class="text nav-text">Manajemen Akun Senior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./nilai_senior.php">
                <i class="bx bx-bell icons"></i>
                <span class="text nav-text">Nilai Senior</span>
              </a>
            </li>
            
          </ul>
        </div>
        <?php }elseif ($role == 'senior') { ?>
          <div class="text header-text">
            <span class="main">Senior</span>
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
              <a href="./menu_manajemen_akun_junior.php">
                <i class="bx bx-bar-chart-alt-2 icons"></i>
                <span class="text nav-text">Manajemen Akun Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_keaktifan_junior.php">
                <i class="bx bx-bell icons"></i>
                <span class="text nav-text">Nilai Keaktifan Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_pola_pikir_junior.php">
                <i class="bx bx-pie-chart-alt icons"></i>
                <span class="text nav-text">Nilai Pola Pikir Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_sikap_junior.php">
                <i class="bx bx-heart icons"></i>
                <span class="text nav-text">Nilai Sikap Junior</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="./menu_nilai_pbb_junior.php">
                <i class="bx bx-wallet-alt icons"></i>
                <span class="text nav-text">Nilai PBB Junior</span>
              </a>
            </li>
          </ul>
        </div>
        <?php } ?>
        <ul class="bottom-content"> <!-- Perbaikan: Gunakan elemen ul untuk memasukkan elemen li -->
          <li class="nav-link">
            <a href="../main/signout.php">
              <i class="bx bx-log-out icons"></i>
              <span class="text nav-text"> Log Out</span>
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
        </ul>
      </div>
    </nav>
    <script src="../main/script.js"></script>
  </body>
</html>
