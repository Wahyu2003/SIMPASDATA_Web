<?php
session_start();
session_destroy();
// header("Location: ../index.php");
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=../index.php">';
exit;
?>