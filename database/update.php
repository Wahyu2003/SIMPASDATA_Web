<?php
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengecek apakah file dikirim
    if (isset($_FILES["file"]) && isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"])) {
        // Direktori tempat menyimpan file
        $target_dir = "C:\Users\Acer\OneDrive\Pictures\project/";

        // Membuat nama file yang unik
        $unique_id = uniqid();
        $original_filename = $_FILES["file"]["name"];
        $file_extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));

        // Gabungkan string unik, garis bawah, dan nama asli file
        $target_file = $target_dir . $unique_id . "_" . basename($original_filename);

        // Mendapatkan ID siswa yang akan diperbarui
        $nisn = isset($_POST['nisn']) ? $_POST['nisn'] : null;

        // Memeriksa apakah file gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Memindahkan file ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // File berhasil diunggah, sekarang perbarui informasi di dalam database
            $file_name = basename($original_filename);

            // Menggunakan parameterized query untuk mencegah SQL injection
            if ($db) {
                $stmt = $db->prepare("UPDATE siswa SET foto = ? WHERE nisn = ?");
                $stmt->bind_param("si", $file_name, $nisn);

                // Eksekusi query
                if ($stmt->execute()) {
                    // Query berhasil dieksekusi
                    http_response_code(200);
                    echo json_encode(array("message" => "File updated successfully in the database."));
                    if ($stmt->execute()) {
                        // Query berhasil dieksekusi
                        http_response_code(200);
                        echo json_encode(array("message" => "File updated successfully in the database."));
                    } else {
                        // Terjadi kesalahan saat memperbarui data di database
                        http_response_code(500);
                        echo json_encode(array("message" => "Error updating data in the database: " . $stmt->error));
                    }
                } else {
                    // Terjadi kesalahan saat memperbarui data di database
                    http_response_code(500);
                    echo json_encode(array("message" => "Error updating data in the database: " . $stmt->error));
                }

                // Tutup statement
                $stmt->close();
            } else {
                // Terjadi kesalahan koneksi database
                http_response_code(500);
                echo json_encode(array("message" => "Error connecting to the database."));
            }
        } else {
            // Terjadi kesalahan saat memindahkan file
            http_response_code(500);
            echo json_encode(array("message" => "Error moving the file to the specified directory."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "No file sent in the request."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid request method."));
}

// Menutup koneksi setelah selesai menggunakan
if ($db) {
    $db->close();  // Pastikan bahwa $db tidak null
}
?>
