<?php
require_once ('koneksi.php');



$nipnisn = $_POST["post_nipnisn"];
$password = $_POST["post_password"];


//cek apakah sesuai db
$query = "SELECT nip,password
          FROM admin
          WHERE nip = '$nipnisn' AND password = '$password'
          UNION
          SELECT nisn AS nip, password_siswa AS password
          FROM siswa
          WHERE nisn = '$nipnisn' AND password_siswa = '$password'";

$obj_query = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($obj_query);


if ($data){
    echo json_encode(
        array(
        'response'=>true,
        'payload'=>array(
            "nip"=>$data["nip"],
            
            
            "password"=>$data["password"]

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
