<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Admin Home</title>
    <link rel="stylesheet" href="../main/style.css">
</head>
<body>
    <?php
        include "../main/menu.php";
    ?>
    <main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>
            <h1 class="box-info">Halaman Home Admin, Selamat Datang 
            <?php 
                $namaAdmin = $_SESSION['namaAdmin'];
                echo $namaAdmin;
            ?>
            </h1>
		</main> 
</body>
</html>