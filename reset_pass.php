<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM PASDATA | Reset Password</title>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>SI</b> Mahasiswa</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Reset Password</p>
      <?php
				if($_GET['key'] && $_GET['reset']){
				  include('database/koneksi.php');
          $email=$_GET['key'];
          $pass=$_GET['reset']; 
          
          $select=mysql_query("SELECT email,password FROM admin WHERE email='$email' AND md5(password)='$pass'");
          $select2=mysql_query("SELECT email,password FROM siswa WHERE email='$email' AND md5(password)='$pass'");

          if(mysql_num_rows($select)==1){
          ?>
            <form action="" method="POST">
              <div class="form-group">
                <label class="label">Password Baru</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" onkeyup='check();' placeholder="*********">
                    <input type="hidden" name="email" value="<?php echo $email;?>">
                    <input type="hidden" name="pass" value="<?php echo $pass;?>">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-check-circle-outline"></i>
                    </span>
                  </div>
              </div>
              </div>
                <div class="form-group">
                  <label class="label">Konfirmasi Password</label>
                    <div class="input-group">
                      <input type="password" name="konfirmasi" class="form-control" id="confirm_password"  onkeyup='check();' placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
              <div class="form-group">  
                <span id='message'></span>
              </div>
              <div class="form-group">
                <button class="btn btn-danger submit-btn btn-block" id="btnSubmit" name="submit_password">Reset</button>
              </div>     
            </form>
              <?php
            } elseif(mysql_num_rows($select2)==1) {
              ?>
            <form action="" method="POST">
              <div class="form-group">
                <label class="label">Password Baru</label>
                  <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" onkeyup='check();' placeholder="*********">
                    <input type="hidden" name="email" value="<?php echo $email;?>">
                    <input type="hidden" name="pass" value="<?php echo $pass;?>">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-check-circle-outline"></i>
                    </span>
                  </div>
              </div>
              </div>
                <div class="form-group">
                  <label class="label">Konfirmasi Password</label>
                    <div class="input-group">
                      <input type="password" name="konfirmasi" class="form-control" id="confirm_password"  onkeyup='check();' placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
              <div class="form-group">  
                <span id='message'></span>
              </div>
              <div class="form-group">
                <button class="btn btn-danger submit-btn btn-block" id="btnSubmit" name="submit_password">Reset</button>
              </div>     
            </form>
              <?php
            }else{
              echo "Data Tidak Ditemukan";
            }
				}
				?>
	
        <?php
        if(isset($_POST['submit_password']))
        {
          include('database/koneksi.php');
          $email=$_POST['email'];
          $pass=$_POST['password'];
          
          $select=mysql_query("UPDATE admin SET password='$pass' WHERE email='$email'") or die(mysql_error());
          $select2=mysql_query("UPDATE siswa SET password='$pass' WHERE email='$email'") or die(mysql_error());
            
          if($select){
            echo "<script> alert('Reset password berhasil'); window.location = 'index.php'; </script>";//jika pesan terkirim
              
          }elseif($select2){
            echo "<script> alert('Reset password berhasil'); window.location = 'index.php'; </script>";
          
          }else{
            echo "<script>alert('Gagal Menyimpan '); window.location = 'forgot_password.php';</script>";
          }
        }
        ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
    <!-- <script src="vendor.bundle.base.js"></script>
    <script src="vendor.bundle.addons.js"></script>
	<script src="off-canvas.js"></script>
    <script src="misc.js"></script> -->
<!-- jQuery -->
<!-- <script src="admin/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="admin/dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
	
    <script type="text/javascript">
       var check = function() {
        if (document.getElementById('password').value ==
          document.getElementById('confirm_password').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'Password dan Konfirmasi Sama';
        } else {
          document.getElementById('message').style.color = 'red';
          document.getElementById('message').innerHTML = 'Password dan Konfirmasi Tidak Sama';
        }
      }
    </script>
</body>
</html>
