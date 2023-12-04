<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Junior</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            background-color: var(--red);
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
        <h1>Tambah Akun Junior</h1>
    </header>

    <div class="container">
        <form action="../senior/junior_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" pattern="[0-9]{4,21}" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" oninput="formatNama('nama')" required>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="selectKelas" onchange="checkSelect()" required>
                <option value="">Pilih Kelas</option>
                <?php
                $query_kelas = "SELECT * FROM kelas";
                $result_kelas = mysqli_query($db, $query_kelas);
                while ($row_kelas = mysqli_fetch_assoc($result_kelas)) {
                    echo "<option value='" . $row_kelas['id_kelas'] . "'>" . $row_kelas['nama'] . "</option>";
                }
                ?>
            </select>
            <span id="errorSelect" class="error"></span>

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
            <input type="tel" name="no_hp" pattern="[0-9]{12,13}">


            <button type="submit" name="btn_input_junior" id="btn_input_junior" disabled>Simpan</button>
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

        function checkSelect() {
            var selectedOption = document.getElementById('selectKelas').value;
            var btnSimpan = document.getElementById('btn_input_junior');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Junior</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            background-color: var(--red);
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
        <h1>Tambah Akun Junior</h1>
    </header>

    <div class="container">
        <form action="../senior/junior_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" pattern="[0-9]{4,21}" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" oninput="formatNama('nama')" required>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="selectKelas" onchange="checkSelect()" required>
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
            <input type="tel" name="no_hp" pattern="[0-9]{12,13}">

            <label for="foto">Foto</label>
            <input type="file" name="foto">

            <button type="submit" name="btn_input_junior" id="btn_input_junior" disabled>Simpan</button>
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

        function checkSelect() {
            var selectedOption = document.getElementById('selectKelas').value;
            var btnSimpan = document.getElementById('btn_input_junior');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Junior</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            background-color: var(--red);
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
        <h1>Tambah Akun Junior</h1>
    </header>

    <div class="container">
        <form action="../senior/junior_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" pattern="[0-9]{4,21}" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" oninput="formatNama('nama')" required>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="selectKelas" onchange="checkSelect()" required>
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
            <input type="tel" name="no_hp" pattern="[0-9]{12,13}">

            <label for="foto">Foto</label>
            <input type="file" name="foto">

            <button type="submit" name="btn_input_junior" id="btn_input_junior" disabled>Simpan</button>
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

        function checkSelect() {
            var selectedOption = document.getElementById('selectKelas').value;
            var btnSimpan = document.getElementById('btn_input_junior');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Junior</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
            background-color: var(--red);
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
        <h1>Tambah Akun Junior</h1>
    </header>

    <div class="container">
        <form action="../senior/junior_tambah.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="nisn">NISN</label>
            <input type="text" name="nisn" id="nisn" pattern="[0-9]{4,21}" required>

            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" oninput="formatNama('nama')" required>

            <label for="kelas">Kelas</label>
            <select name="kelas" id="selectKelas" onchange="checkSelect()" required>
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
            <input type="tel" name="no_hp" pattern="[0-9]{12,13}">

            <label for="foto">Foto</label>
            <input type="file" name="foto">

            <button type="submit" name="btn_input_junior" id="btn_input_junior" disabled>Simpan</button>
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

        function checkSelect() {
            var selectedOption = document.getElementById('selectKelas').value;
            var btnSimpan = document.getElementById('btn_input_junior');

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
