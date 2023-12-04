<?php  include "../main/auth.php"; 
function resizeImage($imageData, $newWidth, $newHeight) {
  $img = imagecreatefromstring($imageData);

  // Check if image creation failed
  if (!$img) {
      // Log an error or handle it as needed
      error_log("Failed to create image from string");
      return false;
  }

  $resized = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($resized, $img, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($img), imagesy($img));
  imagedestroy($img);
  ob_start();
  imagejpeg($resized);
  $resizedImageData = ob_get_clean();
  imagedestroy($resized);
  return $resizedImageData;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPASDATA || Menu</title>
    <link rel="stylesheet" href="../main/style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
    if ($role == 'admin') { ?>
      <div class="top-bar">
      <div class="logo">
        <img src="../assets/logo-pasdata-3.png" alt="Logo">
        <span class="logo">SIMPASDATA</span>
      </div>
        <div class="menu-container">
            <div class="menu">
                <a href="./home.php">
                  <!-- <i class='bx bx-home-alt' ></i> -->
                  <span class="text active" onclick="setActive()">Home</span></a>
            </div>
            <div class="menu">
                <span class="text">Management</span>
                <ul>
                <li>
                    <a href="./menu_manajemen_akun_pembina.php">
                        <!-- <i class='bx bxs-user-account' ></i> -->
                        <span class="text" onclick="setActive()">Manajemen Akun Pembina</span>
                    </a>
                </li>
                <li>
                    <a href="./menu_manajemen_akun_senior.php">
                        <!-- <i class='bx bxs-doughnut-chart' ></i> -->
                        <span class="text" onclick="setActive()">Manajemen Akun Senior</span>
                    </a>
                </li>
                <li>
                    <a href="./junior_manajemen_akun.php">
                        <!-- <i class='bx bxs-message-dots' ></i> -->
                        <span class="text" onclick="setActive()">Manajemen Akun Junior</span>
                    </a>
                </li>
                </ul>
            </div>
            <div class="menu">
                    <a href="./data_nilai.php">
                        <!-- <i class='bx bx-trash' ></i> -->
                        <span class="text" onclick="setActive()">Data Nilai</span>
                    </a>
            </div>
        </div>
        <div class="profile menu">
          <span class="text">
            <?php echo $namaAdmin;?></span>
          <?php
          if (!empty($fotoAdmin)) {
            $fotoAdmin = resizeImage($fotoAdmin, 40, 40);
            echo "<img src='data:image/*;base64," . base64_encode($fotoAdmin) . "' alt='Gambar'>";
        } else {
          echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 40px; height: 40px;'>";
      }      
        
         ?>
        
            <ul>
            <li>
              <a href="./profile.php" class="text">
                <!-- <i class="bx bx-user icons"></i> -->
              <span class="text">Profile</span>
              </a>
            </li>
            <li>
                <a href="../main/signout.php" class="logout">
                <!-- <i class='bx bxs-log-out-circle' ></i> -->
                <span class="text">Logout</span>
              </a>
            </li>
            </ul>
          </div>  
      </div>
    <?php }
    elseif ($role == 'pembina') { ?>
      <div class="top-bar">
        <div class="logo">
          <img src="../assets/logo-pasdata-3.png" alt="Logo">
          <span class="logo">SIMPASDATA</span>
        </div>
        <div class="menu-container">
            <div class="menu">
                <a href="./home.php">
                  <!-- <i class='bx bx-home-alt' ></i> -->
                  <span class="text active">Home</span></a>
                </a>
            </div>
            <div class="menu">
                <span class="text">Management</span>
                <ul>
                <li>
                    <a href="./menu_manajemen_akun_senior.php">
                        <!-- <i class='bx bxs-doughnut-chart' ></i> -->
                        <span class="text">Manajemen Akun Senior</span>
                    </a>
                </li>
                <li>
                    <a href="./junior_manajemen_akun.php">
                        <!-- <i class='bx bxs-message-dots' ></i> -->
                        <span class="text">Manajemen Akun Junior</span>
                    </a>
                </li>
                </ul>
            </div>
            <div class="menu">
                <a href="./data_nilai.php">
                  <!-- <i class='bx bx-edit' ></i> -->
                  <span class="text">Data Nilai</span>
                </a>
            </div>
        </div>
        <div class="profile menu">
          <span class="text">
            <?php echo $namaAdmin;?></span>
          <?php
          if (!empty($fotoAdmin)) {
            $fotoAdmin = resizeImage($fotoAdmin, 40, 40);
            echo "<img src='data:image/*;base64," . base64_encode($fotoAdmin) . "' alt='Gambar'>";
        } else {
          echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 40px; height: 40px;'>";
      }      
         ?>
        
            <ul>
            <li>
              <a href="./profil.php">
                <!-- <i class="bx bx-user icons"></i> -->
              <span class="text">Profile</span>
              </a>
            </li>
            <li>
                <a href="../main/signout.php" class="logout">
                <!-- <i class='bx bxs-log-out-circle' ></i> -->
                <span class="text">Logout</span>
              </a>
            </li>
            </ul>
          </div>  
      </div>
    <?php }
    elseif ($role == 'senior') { ?>
      <div class="top-bar">
      <div class="logo">
        <img src="../assets/logo-pasdata-3.png" alt="Logo">
        <span class="logo">SIMPASDATA</span>
      </div>
        <div class="menu-container">
          <div class="menu">
              <a href="./home.php">
                <!-- <i class='bx bx-home-alt' ></i> -->
                <span class="text active">Home</span>
              </a>
          </div>
          <div class="menu">
              <a href="./junior_manajemen_akun.php">
                  <!-- <i class='bx bxs-message-dots' ></i> -->
                  <span class="text">Manajemen Akun Junior</span>
              </a>
          </div>
          <div class="menu">
              <a href="./nilai_junior.php">
                <!-- <i class='bx bx-edit' ></i> -->
                <span class="text nav-text">Nilai Junior</span>
              </a>
          </div>
        </div>
          <div class="profile menu">
          <span class="text">
            <?php echo $namaSiswa;?></span>
          <?php
          if (!empty($fotoSiswa)) {
            $fotoSiswa = resizeImage($fotoSiswa, 40, 40);
            echo "<img src='data:image/*;base64," . base64_encode($fotoSiswa) . "' alt='Gambar'>";
        } else {
          echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 40px; height: 40px;'>";
      }      
         ?>
        
            <ul>
            <li>
              <a href="./profil.php">
                <!-- <i class="bx bx-user icons"></i> -->
              <span class="text">Profile</span>
              </a>
            </li>
            <li>
                <a href="../main/signout.php" class="logout">
                <!-- <i class='bx bxs-log-out-circle' ></i> -->
                <span class="text">Logout</span>
              </a>
            </li>
            </ul>
          </div>      
      </div>
      <?php } ?>
<script src="../main/script.js"></script>
</body>
</html>