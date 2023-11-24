<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Junior</title>
    <style>
        table {
            text-align: left;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php 
    
    include "../main/menu.php"
    ?>
    <center>
        <button type="submit" name="btnKembali" class="custom"><a href="./junior_manajemen_akun.php">Kembali</a></button>
    </center>
    <br>
    
    <center>
        <form action="../pembina/junior_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <table cellpadding="5">
                <tr>
                    <th><label for="nisn">NISN</label></th>
                    <td><input type="text" name="nisn" id="nisn" pattern="[0-9]{4,21}"></td>
                </tr>
                <tr>
                    <th><label for="nama">Nama Lengkap</label></th>
                    <td><input type="text" name="nama" id="nama" oninput="formatNama('nama')"></td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>
                        <select name="kelas" id="selectKelas" onchange="checkSelect()">
                            <option value="">Pilih Kelas</option>
                            <?php
                            $query_kelas = "SELECT * FROM kelas WHERE nama LIKE '%10%'";
                            $result_kelas = mysqli_query($db, $query_kelas);
                            while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                                echo "<option value='" . $row_kelas['id_kelas'] . "'>" . $row_kelas['nama'] . "</option>";
                            }
                            ?>
                        </select>
                        <span id="errorSelect" class="error"></span>
                        <br>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>
                        <input type="radio" name="jenis_kelamin" value="L"> Laki-laki
                        <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                    </td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><input type="text" name="alamat" oninput="formatNama('alamat')"></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"></td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td><input type="tel" name="no_hp" pattern="[0-9]{12,13}" ></td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td><input type="file" name="foto"></td>
                </tr>
                <tr>
                    <th></th>
                    <td><button type="submit" name="btn_input_junior" id="btn_input_junior" disabled>Simpan</button></td>
                </tr>
            </table>
        </form>
    </center>

    <script>
        function formatNama(inputId) {
            var inputElement = document.getElementById(inputId);
            var inputValue = inputElement.value;

            var formattedValue = inputValue.replace(/\b\w/g, function (match) {
                return match.toUpperCase();
            });

            inputElement.value = formattedValue;
        }

        function checkSelect() {
            var selectedOption = document.getElementById('selectKelas').value;
            var btnSimpan = document.getElementById('btn_input_junior');

            console.log("Selected Option: " + selectedOption);

            if (selectedOption === "") {
                document.getElementById('errorSelect').innerHTML = 'Pilih Salah Satu Kelas';
                btnSimpan.disabled = true;
            } else {
                document.getElementById('errorSelect').innerHTML = '';
                btnSimpan.disabled = false;
            }
        }

        function validateForm() {
            var selectedOption = document.getElementById('selectKelas').value;
            var errorSelect = document.getElementById('errorSelect');

            if (selectedOption === "") {
                errorSelect.innerHTML = 'Pilih salah satu opsi.';
                return false;
            } else {
                errorSelect.innerHTML = '';
                return true;
            }
        }
    </script>
</body>
</html>
