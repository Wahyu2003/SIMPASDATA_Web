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
        include "../main/menu.php";
    ?>
    <div class="kontener">
        <div class="header">
            <h1>Manajemen Akun Pembina</h1>
        </div>
    <div class="volume">
        <form action="pembina_tambah.php" method="POST" enctype="multipart/form-data"onsubmit="return showSuccessPopup()">
            <div class="form">
                    <div class="kanan">
                        <label class="imput" for="nisn">NIP</label required>
                        
                        <input class="imput" type="text" name="nisn" id="nisn" pattern="[0-9]{4,5,18,21}" required>
                    
                    
                        <label class="imput" for="nama">Nama Lengkap</label>
                        <input class="imput" type="text" name="nama" id="nama" oninput="formatNama('nama')" required>
                    
                    
                        <label class="imput" for="alamat">Alamat</label>
                        <input class="imput" type="text" name="alamat" oninput="formatNama('alamat')" required>
                    </div>
                    <div class="kiri">
                        <label class="imput" for="jenis_kelamin">Jenis Kelamin</label>
                        <div class="sex">
                            <input class="impuut" type="radio" name="jenis_kelamin" value="L" required> Laki-laki
                            <input class="impuut" type="radio" name="jenis_kelamin" value="P" required> Perempuan
                        </div>
                        
                        <label class="imput" for="email">Email</label>
                        <input class="imput" type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    
                        <label class="imput" for="no_hp">No HP</label>
                        <input class="imput" type="tel" name="no_hp" pattern="[0-9]{12,13}" required>
                    </div>
                    
                    

                        
                </div>
                <button class="button"type="submit" name="btn_input_junior">Simpan</button>
            </div>
            
        </form>
        </div>

    </div>

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
        document.addEventListener("DOMContentLoaded", function () {
            var status = "<?php echo $status; ?>";
            if (status === "success") {
                alert("Data berhasil ditambahkan!");
            } else if (status === "failed") {
                alert("Gagal menambahkan data. Silakan coba lagi.");
            }
        });
    </script>
</body>
</html>
