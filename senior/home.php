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


        $selectedValue2 = '';
  if (isset($_POST['selectedValue2'])) 
    $selectedValue2 = $_POST['selectedValue2'];

    // Query sesuai dengan $selectedValue
    $orderColumn2 = '';
    switch ($selectedValue2) {
        case 'nilai_sikap':
            $valuee2 = "SUM(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai END) AS total_sikap";
            $orderColumn2 = 'total_sikap';
            break;
        case 'nilai_pola_pikir':
            $valuee2 = "SUM(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai END) AS total_pola_pikir";
            $orderColumn2 = 'total_pola_pikir';
            break;
        case 'nilai_keaktifan':
            $valuee2 = "SUM(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai END) AS total_keaktifan";
            $orderColumn2 = 'total_keaktifan';
            break;
        case 'nilai_pbb':
            $valuee2 = "SUM(CASE WHEN nilai.nama = 'nilai pbb' THEN detail_nilai.total_nilai END) AS total_pbb";
            $orderColumn2 = 'total_pbb';
            break;
        default:
            $valuee2 = "SUM((COALESCE(detail_nilai.total_nilai, 0) * 4) / 4) AS total_keseluruhan";
            $orderColumn2 = 'total_keseluruhan'; // Default order column
    }

        $query2 = mysqli_query($db, "SELECT
        siswa.nisn,
        siswa.nama,
        kelas.nama AS kelas,
        $valuee2
    FROM
        siswa
    JOIN kelas ON siswa.kelas_id = kelas.id_kelas
    JOIN entered ON siswa.nisn = entered.nisn_j
    LEFT JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
    LEFT JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
    GROUP BY
        siswa.nisn, siswa.nama, kelas.nama
    ORDER BY
    $orderColumn2 DESC
    LIMIT 5;");

        if (!$query2) {
            die('Error executing query: ' . mysqli_error($db));
        }
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
        <span>Junior</span>
              <form method="post" action="">
                <select class="search" name="selectedValue2" id="selectedValue2" onchange="this.form.submit()">
                  <option value="nilai_sikap" <?php if(isset($_POST['selectedValue2']) && $_POST['selectedValue2'] == 'nilai_sikap') echo 'selected'; ?>>Nilai Sikap</option>
                  <option value="nilai_pola_pikir" <?php if(isset($_POST['selectedValue2']) && $_POST['selectedValue2'] == 'nilai_pola_pikir') echo 'selected'; ?>>Nilai Pola Pikir</option>
                  <option value="nilai_keaktifan" <?php if(isset($_POST['selectedValue2']) && $_POST['selectedValue2'] == 'nilai_keaktifan') echo 'selected'; ?>>Nilai Keaktifan</option>
                  <option value="nilai_pbb" <?php if(isset($_POST['selectedValue2']) && $_POST['selectedValue2'] == 'nilai_pbb') echo 'selected'; ?>>Nilai Pbb</option>
                </select>
              </form>
        </div>
        <div class="datatable">
            <?php
                if (mysqli_num_rows($query2) > 0) {
                    ?>
                    <table>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>Total Nilai</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($query2)) {
                            echo '<tr>';
                            echo '<td>' . $row['nisn'] . '</td>';
                            echo '<td>' . $row['nama'] . '</td>';
                            echo '<td>' . $row['kelas'] . '</td>';
                            echo '<td>' . $row[$orderColumn2] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <?php
                }
            
            ?>
            </div>
        </div>
        </div>
    </div>
</div>
	
</body>
</html>
