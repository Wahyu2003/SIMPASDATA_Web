 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Tambah Akun Junior</title>
    <style>
        table{
            text-align:left;
        }
    </style>
 </head>
 <body>
    <?php 
    session_start();
    include "../main/menu.php"
    ?>
    <center>
        <button type="submit" name="btnKembali" class="custom"><a href="./junior_manajemen_akun.php">Kembali</a></button>
    </center>
    <form action="" method="POST">
        <table cellpadding="5">
            <tr>
                <th><label for="nisn">NISN</label></th>
                <td><input type="text" name="nisn" id="nisn"></td>
            </tr>
            <tr>
                <th><label for="nama">Nama Lengkap</label></th>
                <td><input type="text" name="nama" id="nama"></td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>
                    <select name="kelas" id="kelas" onchange="this.form.submit()">
                        <option value="">Pilih Kelas</option>
                    </select>
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
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td><input type="text" name="no_hp"></td>
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
 </body>
 </html>