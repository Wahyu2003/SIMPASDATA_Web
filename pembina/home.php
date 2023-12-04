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
		<h1 >Selamat Datang <?php $namaAdmin = $_SESSION['namaAdmin'];echo $namaAdmin;?></h1>
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
    <span class="judul">Nilai Tertinggi</span>
    <div class="isikan">
      <form action="" method="POST" class="satu">
        <div class="ft">
            <span>Senior</span>
            <?php
                $selectNilai = mysqli_query($db, "SELECT id_nilai, nama FROM nilai ORDER BY id_nilai ASC LIMIT 3");
                $options = '';
                while ($row = mysqli_fetch_assoc($selectNilai)) {
                    $selected = (isset($_POST['search']) && $_POST['search'] == $row['id_nilai']) ? "selected" : "";
                    $options .= "<option value='" . $row['id_nilai'] . "' $selected>" . $row['nama'] . "</option>";
                }
            ?>
            <select name="search" id="search" class="search" onchange="this.form.submit()">
                <?=$options?>
            </select>
          </div>
          <div class="datatable">
            <table>
              <tr>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Total Nilai</th>
              </tr>
              <?php
                  $nisn='';
                  $kelas='';
                  $nama='';
                  $total='';
                  if(isset($_POST['search'])){                             
                      $tampilData = mysqli_query($db, 
                      "SELECT
                      siswa.nisn,
                      siswa.nama,
                      kelas.nama AS kelas,
                      SUM(CASE WHEN nilai.id_nilai = '$_POST[search]' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai
                      FROM
                      siswa
                      JOIN kelas ON siswa.kelas_id = kelas.id_kelas
                      JOIN entered ON siswa.nisn = entered.nisn_s
                      JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
                      JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
                      GROUP BY
                      siswa.nisn, siswa.nama, kelas.nama
                      ORDER BY
                      total_nilai
                      DESC
                      LIMIT 3;"
                      );
                          while($row = mysqli_fetch_assoc($tampilData)){
                              ?>
                              <tr>
                                  <td><?=$row['nisn']?></td>
                                  <td><?=$row['nama']?></td>
                                  <td><?=$row['kelas']?></td>
                                  <td><?=$row['total_nilai']?></td>
                              </tr>
                              <?php
                          }
                  }
              ?>
            </table>
        </div>
      </form>
      <form action="" method="POST" class="dua">
        <div class="ft">
            <span>Junior</span>
              <?php
                $selectNilai = mysqli_query($db, "SELECT id_nilai, nama FROM nilai ORDER BY id_nilai ASC");
                $options = '';
                while ($row = mysqli_fetch_assoc($selectNilai)) {
                    $selected = (isset($_POST['search']) && $_POST['search'] == $row['id_nilai']) ? "selected" : "";
                    $options .= "<option value='" . $row['id_nilai'] . "' $selected>" . $row['nama'] . "</option>";
                }
              ?>
            <select name="search" id="search" class="search" onchange="this.form.submit()">
                <?=$options?>
            </select>
        </div>
        <div class="datatable">
          <table>
            <tr>
              <th>NISN</th>
              <th>Nama Lengkap</th>
              <th>Kelas</th>
              <th>Total Nilai</th>
            </tr>
            <?php
                $nisn='';
                $kelas='';
                $nama='';
                $total='';
                if(isset($_POST['search'])){                             
                    $tampilData = mysqli_query($db, 
                    "SELECT
                    siswa.nisn,
                    siswa.nama,
                    kelas.nama AS kelas,
                    SUM(CASE WHEN nilai.id_nilai = '$_POST[search]' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai
                    FROM
                        siswa
                    JOIN kelas ON siswa.kelas_id = kelas.id_kelas
                    JOIN entered ON siswa.nisn = entered.nisn_j
                    JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
                    JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
                    GROUP BY
                        siswa.nisn, siswa.nama, kelas.nama
                    ORDER BY
                    total_nilai
                    DESC
                    LIMIT 3;"
                    );
                        while($row = mysqli_fetch_assoc($tampilData)){
                            ?>
                            <tr>
                                <td><?=$row['nisn']?></td>
                                <td><?=$row['nama']?></td>
                                <td><?=$row['kelas']?></td>
                                <td><?=$row['total_nilai']?></td>
                            </tr>
                            <?php
                        }
                }
            ?>
              
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
	

</body>
</html>
