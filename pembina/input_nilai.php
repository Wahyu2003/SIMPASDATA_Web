<?php
    require ("../main/auth.php");
?>

<?php
    if(isset($_POST['tambahNilai'])){
        $nisn = $_POST['nama'];
        $nilaiSikap = $_POST['nilai_sikap'];
        $nilaiPolaPikir = $_POST['nilai_pola_pikir'];
        $nilaiKeaktifan = $_POST['nilai_keaktifan'];
        $tahunPelajaran = $_POST['tahun_pelajaran'];

        $nipPembina = $_SESSION['nipAdmin'];

        
    }
?>
