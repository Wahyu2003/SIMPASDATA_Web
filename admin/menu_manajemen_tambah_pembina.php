<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Pembina</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            color:black;
        }
        header {
            background-color: var(--red);
            padding: 10px;
            color: white;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            text-align: left;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            padding: 5px;
        }

        .error {
            color: red;
        }

        .radio-group {
            display: flex;
            gap: 100px;
        }

        .radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .radio-group label input {
            margin-right: 5px;
        }

        button {
            padding: 10px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:disabled {
            background-color: #999;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <?php include "../main/menu.php" ?>
    <header>
        <h1>Tambah Akun Pembina</h1>
    </header>

    <div class="container">
        <form action="pembina_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nip">NIP</label>
            <input type="text" name="nip" id="nip" pattern="[0-9]{4,21}" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" oninput="formatNama('nama')" required>

            
            <label>Jenis Kelamin</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="jenis_kelamin" value="L" required>
                    Laki-Laki
                </label>
                <label>
                    <input type="radio" name="jenis_kelamin" value="P" required>
                    Perempuan
                </label>
            </div>

            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" oninput="formatNama('alamat')" required>

            <label for="email">Email</label>
            <input type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

            <label for="no_hp">Nomor HP</label>
            <input type="tel" name="no_hp" pattern="[0-9]{12,13}" required>

            <button type="submit" name="btn_input_pembina" id="btn_input_pembina">Simpan</button>
        </form>
    </div>

    <script>
        function formatNama(inputId) {
            var inputElement = document.getElementById(inputId);
            var inputValue = inputElement.value;

            var formattedValue = inputValue.replace(/\b\w/g, function (match) {
                return match.toUpperCase();
            });

            inputElement.value = formattedValue;
        }

       

       
    </script>
</body>
</html>
