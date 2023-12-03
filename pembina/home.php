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

        $selectedValue = '';

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

    if (isset($_POST['selectedValue']))
      $selectedValue = $_POST['selectedValue'];

    // Query sesuai dengan $selectedValue
    $orderColumn = '';
    switch ($selectedValue) {
        case 'nilai_sikap':
            $valuee = "SUM(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai END) AS total_sikap";
            $orderColumn = 'total_sikap';
            break;
        case 'nilai_pola_pikir':
            $valuee = "SUM(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai END) AS total_pola_pikir";
            $orderColumn = 'total_pola_pikir';
            break;
        case 'nilai_keaktifan':
            $valuee = "SUM(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai END) AS total_keaktifan";
            $orderColumn = 'total_keaktifan';
            break;
        default:
            $valuee = "SUM((COALESCE(detail_nilai.total_nilai, 0) * 3) / 3) AS total_keseluruhan";
            $orderColumn = 'total_keseluruhan'; // Default order column
    }

    $query = mysqli_query($db, "SELECT
    siswa.nisn,
    siswa.nama,
    kelas.nama AS kelas,
    $valuee
FROM
    siswa
JOIN kelas ON siswa.kelas_id = kelas.id_kelas
JOIN entered ON siswa.nisn = entered.nisn_s
LEFT JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
LEFT JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
GROUP BY
    siswa.nisn, siswa.nama, kelas.nama
ORDER BY
$orderColumn DESC
LIMIT 5;");

    if (!$query) {
        die('Error executing query: ' . mysqli_error($db));
    }





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
              <form method="post" action="">
                <select class="search" name="selectedValue" id="selectedValue" onchange="this.form.submit()">
                  <option value="nilai_sikap" <?php if(isset($_POST['selectedValue']) && $_POST['selectedValue'] == 'nilai_sikap') echo 'selected'; ?>>Nilai Sikap</option>
                  <option value="nilai_pola_pikir" <?php if(isset($_POST['selectedValue']) && $_POST['selectedValue'] == 'nilai_pola_pikir') echo 'selected'; ?>>Nilai Pola Pikir</option>
                  <option value="nilai_keaktifan" <?php if(isset($_POST['selectedValue']) && $_POST['selectedValue'] == 'nilai_keaktifan') echo 'selected'; ?>>Nilai Keaktifan</option>
                </select>
              </form>
          </div>
          <div class="datatable">
                    <?php
                        // Tampilkan hasil query
                        if (mysqli_num_rows($query) > 0) {
                            ?>
                            <table>
                                <tr>
                                    <th>NISN</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kelas</th>
                                    <th>Total Nilai</th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['nisn'] . '</td>';
                                    echo '<td>' . $row['nama'] . '</td>';
                                    echo '<td>' . $row['kelas'] . '</td>';
                                    echo '<td>' . $row[$orderColumn] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </table>
                            <?php
                        }
                    
                    ?>
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
        <div class="datatable2">
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
<!-- <script>
    // Function to fetch data based on selected value
    function fetchData(selectedValue, targetTable) {
        // Use AJAX to send a request to the server with the selected value
        // Update the table with the server's response
        // Example using fetch API:
        fetch('home.php?selectedValue=' + selectedValue)
            .then(response => response.json())
            .then(data => {
                // Update the table body with the fetched data
                var tableBody = document.querySelector(targetTable + ' table tbody');
                tableBody.innerHTML = ''; // Clear existing content

                data.forEach(row => {
                    var newRow = document.createElement('tr');
                    newRow.innerHTML = '<td>' + row.nisn + '</td>' +
                        '<td>' + row.nama + '</td>' +
                        '<td>' + row.kelas + '</td>' +
                        '<td>' + row[selectedValue] + '</td>';
                    tableBody.appendChild(newRow);
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // Event listener to fetch data when the selection changes
    document.getElementById('selectedValue').addEventListener('change', function() {
        var selectedValue = document.getElementById('selectedValue').value;
        fetchData(selectedValue, '.datatable');
    });

    document.getElementById('selectedValue2').addEventListener('change', function() {
        var selectedValue2 = document.getElementById('selectedValue2').value;
        fetchData(selectedValue2, '.datatable2');
    });

    // Initial data load when the page loads
    window.addEventListener('load', function() {
        var selectedValue = document.getElementById('selectedValue').value;
        var selectedValue2 = document.getElementById('selectedValue2').value;
        fetchData(selectedValue, '.datatable');
        fetchData(selectedValue2, '.datatable2');
    });
</script> -->

</body>
</html>
