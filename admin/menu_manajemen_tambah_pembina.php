<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Tambah Akun Junior</title>
    <link rel="stylesheet" href="../assets/css/tambah.css">
 </head>
 <body>
    <?php 
    include "../main/menu.php"
    ?>
    <div class="kontener">
        <div class="header">
            <h1>Manajemen Akun Pembina</h1>
        </div>
        <div class="volume">
            <form action="pembina_tambah.php" method="POST" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th><label for="nisn">NIP</label></th>
                        <td><input type="text" name="nisn" id="nisn" pattern="[0-9]{4,5,18,21}"></td>
                    </tr>
                    <tr>
                        <th><label for="nama">Nama Lengkap</label></th>
                        <td><input type="text" name="nama" id="nama" oninput="formatNama('nama')"></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><input type="text" name="alamat" oninput="formatNama('alamat')"></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            <input type="radio" name="jenis_kelamin" value="L"> Laki-laki
                            <input type="radio" name="jenis_kelamin" value="P"> Perempuan
                        </td>
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
                        <td><button type="submit" name="btn_input_junior">Simpan</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
 </body>
 </html>

 <script>
    function formatNama(inputId) {
        var inputElement = document.getElementById(inputId);
        var inputValue = inputElement.value;

        // Mengonversi nama menjadi format huruf besar di awal
        var formattedValue = inputValue.replace(/\b\w/g, function (match) {
            return match.toUpperCase();
        });

        // Menetapkan nilai yang telah diformat kembali ke input
        inputElement.value = formattedValue;
    }
</script>