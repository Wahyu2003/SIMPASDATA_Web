<?php
require_once "koneksi.php";

// Mendapatkan parameter dari POST
$nisn = $_POST['nisn'];

// Menambahkan parameter ke query
$query = mysqli_query($db, 
"SELECT
    siswa.nisn,
    siswa.nama,
    kelas.nama AS kelas,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai END), 2) AS rata_sikap,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai END), 2) AS rata_pola_pikir,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai END), 2) AS rata_keaktifan,
    ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 3) / 3), 2) AS rata_keseluruhan,
    ROUND(AVG(entered.sanksi), 2) AS rata_pelanggaran,
    CASE WHEN ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 3) / 3), 2) < 8 THEN 'B' ELSE 'A' END AS nilai_alfabet
    FROM
    siswa
JOIN kelas ON siswa.kelas_id = kelas.id_kelas
JOIN entered ON siswa.nisn = entered.nisn_s
LEFT JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
LEFT JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
WHERE
siswa.nisn = '$nisn'
GROUP BY
    siswa.nisn, siswa.nama, kelas.nama;
");

$dataSenior = array();
$response = array();

if ($query) {
    while ($a = mysqli_fetch_assoc($query)) {
        $dataSenior[] = array(
            'nisn' => $a['nisn'],
            'nama' => $a['nama'],
            'kelas' => $a['kelas'],
            'rata_sikap' => $a['rata_sikap'],
            'rata_pola_pikir' => $a['rata_pola_pikir'],
            'rata_keaktifan' => $a['rata_keaktifan'],
            'rata_keseluruhan' => $a['rata_keseluruhan'],
            'rata_pelanggaran' => $a['rata_pelanggaran'],
            'nilai_alfabet' => $a['nilai_alfabet']
        );
    }

    $response['success'] = true;
    $response['message'] = "Data retrieved successfully.";
    $response['data'] = $dataSenior;
} else {
    $response['success'] = false;
    $response['message'] = "Error retrieving data: " . mysqli_error($db);
}

// Mengirimkan respons sebagai JSON
header('Content-Type: application/json');
echo json_encode($response);

?>


