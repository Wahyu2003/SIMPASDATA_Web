<?php
$db = mysqli_connect("localhost", "root", "", "kurikuler");

if (mysqli_connect_errno()) {
    echo "Koneksi gagal : ".mysqli_connect_error();
}
?>