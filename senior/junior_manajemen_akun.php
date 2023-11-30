<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Junior</title>
    <style>
        .container {
    margin : 0 40px;
    padding : 0;
}
       .container .table {
    width: 100%;
    box-sizing: border-box;
    text-align : left;
}

.container .table table {
    width: 100%;
    border-collapse: collapse;
    border-left : 1px solid #a5a5a5;
    border-right : 1px solid #a5a5a5;
}

.container .table th, .container .table td {
    padding : 10px 5px;
    border-bottom: 1px solid #a5a5a5;
    border-top: 1px solid #a5a5a5;
}

        .jadikansenior,
        .detail,
        .batal,
        .hapus {
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            display: inline-block;
            width: 100px;
        }

    
        
        .detail {
            background-color: #2196F3; /* Warna biru */
        }

        .hapus {
            background-color: #FF0000; /* Warna merah */
        }

    

     
        .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        max-width: 400px; /* Sesuaikan dengan kebutuhan */
        width: 100%;
        text-align: center;
    }

    .popup p {
        margin-bottom: 15px;
        color: #333;
        font-size: 16px;
    }

    .popup-buttons {
        display: flex;
        flex-direction: column; /* Mengubah arah menjadi kolom */
        align-items: center; /* Mengatur agar tombol berada di tengah */
        margin-top: 20px;
    }

    .batal, .jadikansenior {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        font-size: 14px;
        transition: background-color 0.3s;
        display: block; /* Mengatur agar tombol memiliki display block */
        margin-bottom: 10px; /* Menambahkan margin antar tombol */
    }

    .batal {
        background-color: #f44336; /* Merah */
    }

    .batal:hover {
        background-color: #d32f2f; /* Merah yang sedikit lebih gelap saat dihover */
    }

    .jadikansenior {
        background-color: #4CAF50; /* Hijau */
    }

    .jadikansenior:hover {
        background-color: #388e3c; /* Hijau yang sedikit lebih gelap saat dihover */
    }

    </style>
</head>

<body>
<div class="container">
    <?php include "../main/menu.php"; ?>
    <center>
        <h1>Manajemen Akun Junior</h1>
    </center>
    <br>
    
        <style>
                      .custom {
                /* background-color: var(--red); */
                font-size: 14px;
                border-radius: 3px;
                padding: 10px;
                color: white;
                background-color: #58AFEE;
                
            }
            .custom:hover {
                font-size: 14px;
                border-radius: 3px;
                padding: 10px;
                color: white;
                background-color: #3c83b6;
            }
        </style>
        <form action="./junior_manajemen_input_akun.php">
            <button type="submit" name="btnTambahSenior" class="custom">Tambah Akun</button>
        </form>
  
    <br>
    <div class="table">
        <?php
        $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

        if (!$query) {
            die('Error executing query: ' . mysqli_error($db));
        }

        if (mysqli_num_rows($query) > 0) {
        ?>
            <table>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Hp</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>

                <?php
                while ($a = mysqli_fetch_assoc($query)) {
                    $nisnSiswa = $a['nisn'];
                    $namaSiswa = $a['nama'];
                    $kelasSiswa = $a['kelas'];
                    $alamatSiswa = $a['alamat'];
                    $genderSiswa = ($a['gender'] == 'L') ? "Laki - Laki" : "Perempuan"; // Ubah jenis kelamin
                    $noHpSiswa = $a['no_hp'];
                    $emailSiswa = $a['email'];
                ?>

                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $alamatSiswa ?></td>
                        <td><?= $genderSiswa ?></td>
                        <td><?= $noHpSiswa ?></td>
                        <td><?= $emailSiswa ?></td>
                        <td>
                            <button class="jadikansenior"onclick="showPopup('popup-jadikan-senior', '<?= $nisnSiswa ?>')">Jadikan Senior</button>
                            <form method="POST" action="./junior_manajemen_detail_akun.php?nisn=<?= $nisnSiswa ?>">
                                <button type="submit" class="detail">Detail</button>
                            </form>
                            <form method="POST" action="?delete&nisn=<?= $nisnSiswa ?>" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data tersebut?')">
                                <button type="submit" class="hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else {
            echo "<center><p>Tidak ada data yang ditemukan</p></center>";
        } ?>
    </div>

    <div id="popup-jadikan-senior" class="popup">
        <div class="popup-buttons">
        <p>Apakah Anda yakin ingin menjadikan data ini sebagai senior?</p>
        <br>
         
        <form method="POST" action="?update&nisn=">
            <button type="submit" class="jadikansenior">Ya</button>
        </form>
        <form>
        <button type="submit" class="batal" onclick="closePopup('popup-jadikan-senior')">Batal</button>
        </form>
        </div>
    </div>

    <script>
        function showPopup(popupId, nisn) {
            document.getElementById(popupId).style.display = 'flex';
            // Update the form action with the correct NISN
            document.querySelector('#popup-jadikan-senior form').action += nisn;
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }
    </script>
</div>
   
</body>

</html>

<?php
if (isset($_GET['delete'])) {
    $nisn = $_GET['nisn'];

    $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");

    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./junior_manajemen_akun.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>

<?php
if (isset($_GET['update'])) {
    $nisn = $_GET['nisn'];

    $update = mysqli_query($db, "UPDATE siswa SET role = 'senior', status='aktif', level='denied' WHERE siswa.nisn = '$nisn'");
    if ($update) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./junior_manajemen_akun.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate!!');</script>";
    }
}
?>
