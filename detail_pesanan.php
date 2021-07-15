<?php 
    include('koneksi.php');
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
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  <title>Kedai Lais Coffe</title>
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
            <a class="nav-link mr-4" href="pesanan_di_tempat.php">PESANAN Di TEMPAT</a>
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
    <div class="judul-pesanan mt-5">
      <h3 class="text-center font-weight-bold">DATA PESANAN PELANGGAN</h3>
    </div>
    <table class="table table-bordered" id="example">
      <thead class="thead-light">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">ID Pemesanan</th>
          <th scope="col">Nama Pesanan</th>
          <th scope="col">Harga</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Subharga</th>
        </tr>
      </thead>
      <tbody>
        <?php $nomor=1; ?>
        <?php $totalbelanja = 0; ?>
        <?php 
              $ambil = $koneksi->query("SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu=produk.id_menu WHERE pemesanan_produk.id_pemesanan='$_GET[id]'");
           ?>
        <?php while ($pecah=$ambil->fetch_assoc()) { ?>
        <?php $subharga1=$pecah['harga']*$pecah['jumlah']; ?>
        <tr>
          <th scope="row"><?php echo $nomor; ?></th>
          <td><?php echo $pecah['id_pemesanan_produk']; ?></td>
          <td><?php echo $pecah['nama_menu']; ?></td>
          <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
          <td><?php echo $pecah['jumlah']; ?></td>
          <td>
            Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
          </td>
        </tr>
        <?php $nomor++; ?>
        <?php $totalbelanja+=$subharga1; ?>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="5">Total Belanja</th>
          <th>Rp. <?= number_format($totalbelanja) ?></th>
        </tr>
        <tr>
          <th colspan="5">Ongkos Kirim</th>
          <th>
            <?php
                $ambil_ongkir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesanan = '$_GET[id]'"));
                echo "Rp. " . number_format($ambil_ongkir['ongkir']);
              ?>
          </th>
        </tr>
        <tr>
          <th colspan="5">Total Bayar</th>
          <th>
            <?php
                echo "Rp. " . number_format($ambil_ongkir['total_belanja']);
            ?>
          </th>
        </tr>
      </tfoot>
    </table>
    <br>

    <div class="card mb-3">
      <div class="card-body">
        <div class="judul-pesanan">
          <h4 class="font-weight-bold">INFO PEMESAN</h4>
        </div>
        <!-- PENERIMA -->
        <?php $pemesan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesanan = '$_GET[id]'")); ?>
        <div class="row">
          <div class="col">Nama Penerima</div>
          <div class="col">:</div>
          <div class="col-8"><strong><?= $pemesan['nama_penerima'] ?></strong></div>
        </div>
        <div class="row">
          <div class="col">Alamat Penerima</div>
          <div class="col">:</div>
          <div class="col-8"><strong><?= $pemesan['alamat_penerima'] ?></strong></div>
        </div>
        <!-- TUTUP PENERIMA -->
      </div>
    </div>


    <?php
      include('koneksi.php');
      $query = mysqli_query($koneksi, "SELECT gambar FROM Pemesanan WHERE id_pemesanan='$_GET[id]'");
      ($result = mysqli_fetch_all($query, MYSQLI_ASSOC));
      foreach($result as $result) :
    ?>

    <div class="col-md-4 mt-2">
      <img class="zoom" width='700' height='400' src="upload/<?php echo $result['gambar'] ?>">
      <div class="card-body">
      </div>
    </div>
  </div>
  <?php endforeach; ?>
  <div class="container">
    <form method="POST" action="">
      <a href="pesanan.php" class="btn btn-success btn-sm">Kembali</a>
      <button <i class="fas fa-print" onclick="window.print()">Cetak</i></button>

    </form>
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
    </div>
  </div>
  <!-- Akhir Footer -->





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="js/medium-zoom.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
  </script>

</body>

</html>

<?php } ?>