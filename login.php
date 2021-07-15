<?php 
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> -->


    <title>Halaman Login</title>
  </head>
  <body>
  <!-- Form Login -->
    <div class="container">
      <h4 class="text-center">FORM LOGIN</h4>
      <hr>
      <form method="POST" action="">
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
              </div>
              <input type="text" class="form-control" placeholder="Masukkan Username" name="username">
            </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
              </div>
              <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
          </div>
        </div>
        <div class="mb-3" >
          <small><a href="register.php" class="text-dark">Belum Punya Akun ? Buat Akun Anda !</a></small>
        </div>
        <div class="mb-3" >
           <p class="mb-1">
        <a href data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" ="#">I forgot my password</a>
      </p>
    </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="send_email.php" method="POST">
              <div class="form-group">
              <label for="recipient-name" class="col-form-label">Inputkan Email Anda</label>
              <input type="email" name="email" class="form-control" >
              </div>
             
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit_email">Submit</button>
              </div>
          </div>
          </div>
        </div>
              </div>
        <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
        <button type="reset" name="reset" class="btn btn-danger">RESET</button>
      </form>
  <!-- Akhir Form Login -->

  <!-- Eksekusi Form Login -->
      <?php 
        if(isset($_POST['submit'])) {
          $user = $_POST['username'];
          $password = $_POST['password'];

          // Query untuk memilih tabel
          $cek_data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' AND password = '$password'");
          $hasil = mysqli_fetch_array($cek_data);
          $status = $hasil['status'];
          $login_user = $hasil['username'];
          $row = mysqli_num_rows($cek_data);

          // Pengecekan Kondisi Login Berhasil/Tidak
            if ($row > 0) {
                session_start();   
                $_SESSION['login_user'] = $login_user;

                if ($status == 'admin') {
                  header('location: admin.php');
                }elseif ($status == 'user') {
                  header('location: user.php'); 
                }
            }else{
                header("location: login.php");
            }
        }
       ?>
    </div>
  <!-- Akhir Eksekusi Form Login -->
  <?php
if(isset($_POST['submit_email']))
{
  
  include('admin/koneksi.php');
  $email = $_POST['email'];
  
  $select=mysql_query("select email,password FROM user WHERE email='$email'");
  if(mysql_num_rows($select)==1)
  {
    while($row=mysql_fetch_array($select))
    {
      $email=$row['email'];
      $pass=md5($row['password']);
    }
    //$link="<a href='localhost/penjualan-fix/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/class.phpmailer.php');
    require_once('phpmail/class.smtp.php');
    $mail = new PHPMailer();
  
  $body      = "Klik link berikut untuk reset Password, <a href='http://localhost/penjualan-fix/reset_pass.php?reset=$pass&key=$email'>$pass<a>"; //isi dari email
        
   // $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
  $mail->SMTPDebug  = 1;
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "xulrepus1@gmail.com";
    // GMAIL password
    $mail->Password = "rokok123?";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='xulrepus1@gmail.com';
    $mail->FromName='Admin Kedai Lais Coffe';
    
  $email = $_POST['email'];
  
    $mail->AddAddress($email, 'User Sistem');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->MsgHTML($body);
  if($mail->Send())
    {
      echo "<script> alert('Link reset password telah dikirim ke email anda, Cek email untuk melakukan reset'); window.location = 'login.php'; </script>";//jika pesan terkirim
        
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }
else {
  echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'login.php'; </script>";//jika pesan terkirim
  
}  
}
?>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
  </body>
</html>