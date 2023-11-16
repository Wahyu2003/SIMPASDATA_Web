<?php include "../main/auth.php"; ?>

<!-- FOOTER -->
<section id="section-footer">
        <nav class="nav-footer">
            <a href="#" class="notification-footer">
                <p>Notif</p>
            </a>
			<a href="#" class="profil-footer">
                <p>Profil</p>
            </a>
        </nav>
</section>

<!-- SIDEBAR -->
<section id="sidebar">
			<span class="text">
                <p>SIM PASDATA</p>
            </span>
            <?php
            if ($role == 'admin') { ?>
                <ul class="side-menu top">
                    <li><a href="./home.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Home</a></li>
                    <li><a href="./menu_manajemen_akun_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Manajemen Akun Senior</a></li>
                    <li><a href="./menu_manajemen_akun_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Manajemen Akun Junior</a></li>
                    <li><a href="./menu_manajemen_akun_pembina.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Manajemen Akun Pembina</a></li>
                    <li><a href="./menu_nilai_keaktifan_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Keaktifan Senior</a></li>
                    <li><a href="./menu_nilai_pola_pikir_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Pola Pikir Senior</a></li>
                    <li><a href="./menu_nilai_sikap_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Sikap Senior</a></li>
                    
                </ul>
            <?php }elseif ($role == 'pembina') { ?>
                <ul class="side-menu top">
                    <li><a href="./home.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Home</a></li>
                    <li><a href="./menu_manajemen_akun_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Manajemen Akun Senior</a></li>
                    <li><a href="./nilai_senior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Nilai Senior</a></li>
                </ul>
            <?php }elseif ($role == 'senior') { ?>
                <ul class="side-menu top">
                    <li><a href="./home.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Home</a></li>
                    <li><a href="./menu_manajemen_akun_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Manajemen Akun Junior</a></li>
                    <li><a href="./menu_nilai_keaktifan_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Keaktifan Junior</a></li>
                    <li><a href="./menu_nilai_pola_pikir_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Pola Pikir Junior</a></li>
                    <li><a href="./menu_nilai_sikap_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai Sikap Junior</a></li>  
                    <li><a href="./menu_nilai_pbb_junior.php" class="nav-link px-2 mx-1 text-dark btn btn-light">Input Nilai PBB Junior</a></li>  
                </ul>
            <?php } ?>

		<ul class="side-menu">
			<li>
				<a href="../main/signout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
<!-- SIDEBAR -->