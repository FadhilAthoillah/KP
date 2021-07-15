<?php
if(isset($_POST['submit_email']))
{
  
  include('koneksi.php');
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
      echo "<script> alert('Link reset password telah dikirim ke email anda, Cek email untuk melakukan reset'); window.location = 'index.html'; </script>";//jika pesan terkirim
				
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }
else {
	echo "<script> alert('Email anda tidak terdaftar di sistem'); window.location = 'index.html'; </script>";//jika pesan terkirim
	
}  
}
?>