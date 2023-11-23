<?php
require_once ('koneksi.php');



$nipnisn = $_POST["post_nipnisn"];
$password = $_POST["post_password"];


//cek apakah sesuai db
$query = "SELECT nisn,password_siswa
          FROM siswa
          WHERE nisn = '$nipnisn' AND password_siswa = '$password'";
         
$obj_query = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($obj_query);


if ($data){
    echo json_encode(
        array(
        'response'=>true,
        'payload'=>array(
            "nisn"=>$data["nisn"],
            
            
            "password_siswa"=>$data["password_siswa"]

        )
    )
        );
}else{
    
    echo json_encode(
        array(
            'response' => false,
            'payload' => null
            )
     );
}


header('Content-Type:application/json');
