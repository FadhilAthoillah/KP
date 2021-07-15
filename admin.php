<?php 
  session_start();
  if(!isset($_SESSION['login_user'])) {
    header("location: login.php");
  }else{
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="index1.css">
  <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

  <title>Kedai Lais Coffee</title>
</head>

<body>

  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h1 class="display-4"><span class="font-weight-bold">KEDAI LAIS COFFEE</span></h1>
      <hr>
      <p class="lead font-weight-bold">Silahkan Pesan Menu Sesuai Keinginan Anda <br>
        Enjoy Your Coffee</p>
    </div>
  </div>
  <!-- Akhir Jumbotron -->

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg  bg-dark">
    <div class="container">
      <a class="navbar-brand text-white" href="admin.php"><strong>Kedai</strong> Lais Coffee</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link mr-4" href="admin.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-4" href="daftar_menu.php">DAFTAR MENU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-4" href="pesanan.php">PESANAN</a>
          </li>
          <li>
            <a class="nav-link mr-4" href="pesanan_di_tempat.php">PESANAN DI TEMPAT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-4" href="logout.php">LOGOUT</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->

  <!-- Menu -->
  <div class="container">
    <div class="judul text-center mt-5">
      <h3 class="font-weight-bold">KEDAI LAIS COFFEE</h3>
      <h5>Jakasampurna, Bekasi Barat, Kota Bekasi
        <br>Buka Jam <strong>16:00 - 23:00</strong>
      </h5>
      <button class="btn btn-secondary btn-sm mt-2" type="button" data-toggle="modal" data-target="#pengaturanOngkir">
        Pengaturan Ongkir
      </button>
    </div>

    <div class="row mb-5 mt-5 ">
      <div class="col-md-6 d-flex justify-content-end">
        <div class="card bg-dark text-white border-light">
          <img src="images/background/menu2.jpg" class="card-img" alt="Lihat Daftar Menu">
          <div class="card-img-overlay mt-5 text-center">
            <a href="daftar_menu.php" class="btn btn-primary">LIHAT DAFTAR MENU</a>
          </div>
        </div>
      </div>

      <div class="col-md-6 d-flex justify-content-start">
        <div class="card bg-dark text-white border-light">
          <img src="images/background/menu3.jpg" class="card-img" alt="Lihat Pesanan">
          <div class="card-img-overlay mt-5 text-center">
            <a href="pesanan.php" class="btn btn-primary">LIHAT PESANAN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-body">
              <iframe src="linechart.php" width="100%" height="500"></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="pengaturanOngkir" tabindex="-1" aria-labelledby="pengaturanOngkirLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pengaturanOngkirLabel">Pengaturan Ongkos Kirim</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="ongkirLabel" class="d-block mb-2">Status Ongkos Kirim</label>
              <?php
              include('./koneksi.php');
              $chekcbox = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ongkir"));
            ?>
              <div class="form-check form-check-inline">
                <input type="radio" name="ongkir_status" class="form-check-input" id="flat_ongkir" value="flat"
                  onClick="flatOngkir()" <?= $chekcbox['ongkir_status'] == 'flat' ? 'checked' : ''  ?>>
                <label for="flat_ongkir" class="form-check-label">Flat</label>
              </div>
              <div class="form-check form-check-inline">
                <input type="radio" name="ongkir_status" class="form-check-input" id="gratis_ongkir" value="gratis"
                  onClick="flatOngkir()" <?= $chekcbox['ongkir_status'] == 'gratis' ? 'checked' : ''  ?>>
                <label for="gratis_ongkir" class="form-check-label">Gratis</label>
              </div>
            </div>
            <div class="form-group" id="hargaOngkir"
              style="display: <?= $chekcbox['ongkir_status'] == 'flat' ? 'block' : 'none' ?>">
              <label for="ongkoskirim" class="d-block mb-2">Harga Ongkir</label>
              <input type="number" name="ongkir_harga" id="ongkir_harga" class="form-control"
                value="<?= $chekcbox['ongkir_harga'] ?>">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
            <button class="btn btn-primary btn-sm" type="submit" name="saveOngkir">Simpan perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Akhir Menu -->

  <!-- Awal Footer -->
  <hr class="footer">
  <div class="container">
    <div class="row footer-body">
      <div class="col-md-6">
        <div class="copyright">
          <strong>Copyright</strong> <i class="far fa-copyright"></i> 2021</p>
        </div>
      </div>

      <div class="col-md-6 d-flex justify-content-end">
        <div class="icon-contact">
          <label class="font-weight-bold">Follow Us </label>
          <a href="#"><img src="images/icon/fb.png" class="mr-3 ml-4" data-toggle="tooltip" title="Facebook"></a>
          <a href="#"><img src="images/icon/ig.png" class="mr-3" data-toggle="tooltip" title="Instagram"></a>
          <a href="#"><img src="images/icon/twitter.png" class="" data-toggle="tooltip" title="Twitter"></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Footer -->

  <?php
    if(isset($_POST['saveOngkir'])) {
      $ongkir_status = $_POST['ongkir_status'];
      if($ongkir_status == 'flat') {
        $ongkir_harga = $_POST['ongkir_harga'];
      } else {
        $ongkir_harga = 0;
      }
      $update_ongkir = mysqli_query($koneksi, "UPDATE ongkir SET ongkir_status='$ongkir_status', ongkir_harga='$ongkir_harga' WHERE id_ongkir='1'");
      
      // Dialihkan ke halaman nota
      echo "<script>alert('Pengaturan ongkos kirim berhasil diperbarui!');</script>";
      echo "<script>location= 'admin.php'</script>";
    }
  ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script>
    function flatOngkir() {
      const checkbox = document.getElementById('flat_ongkir');
      const hargaOngkir = document.getElementById('hargaOngkir');

      if (checkbox.checked == true) {
        hargaOngkir.style.display = "block";
      } else {
        hargaOngkir.style.display = "none";
      }
    }
  </script>
</body>

</html>
<?php } ?>