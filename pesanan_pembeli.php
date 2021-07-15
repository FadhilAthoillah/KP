<?php  
  include('koneksi.php');
  session_start();
  if(!isset($_SESSION['login_user'])) {
    header("location: login.php");
  } else {
    $username_login = $_SESSION['login_user'];
    $ambil_datauser = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username_login'"));
    $id_user = $ambil_datauser['id_user'];
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
  <link rel="stylesheet" href="vendors/selectPlugin/dist/css/select2.min.css">

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
      <a class="navbar-brand text-white" href="user.php"><strong>Kedai</strong>Lais Coffee</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link mr-4" href="user.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-4" href="menu_pembeli.php">DAFTAR MENU</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-4" href="pesanan_pembeli.php">PESANAN ANDA</a>
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
      <h3 class="text-center font-weight-bold">PESANAN ANDA</h3>
    </div>

    <ul class="nav nav-tabs justify-content-around mt-5 mb-5" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="belumBayar-tab" data-toggle="tab" href="#belumBayar" role="tab"
          aria-controls="belumBayar" aria-selected="true">Belum Bayar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="konfirmasi-tab" data-toggle="tab" href="#konfirmasi" role="tab"
          aria-controls="konfirmasi" aria-selected="false">Menunggu Konfirmasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dikemas-tab" data-toggle="tab" href="#dikemas" role="tab" aria-controls="dikemas"
          aria-selected="false">Dikemas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab" aria-controls="dikirim"
          aria-selected="false">Dikirim</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab" aria-controls="selesai"
          aria-selected="false">Selesai</a>
      </li>
    </ul>
    <div class="tab-content mb-5" id="myTabContent">
      <div class="tab-pane fade show active" id="belumBayar" role="tabpanel" aria-labelledby="belumBayar-tab">

        <?php
        if(empty($_SESSION["pesanan"]) OR !isset($_SESSION["pesanan"])) {
        echo "<h3 class='text-center'>Pesanan Anda masih kosong!</h3>";
        echo "<a href='menu_pembeli.php' class='d-block mx-auto btn btn-primary mt-5' style='width: 20%'>Daftar Menu</a>";
        } else { ?>
        <!-- BAIKNYA KALAU CART TABLE SEPERTI INI TIDAK MENGGUNAKAN DATATABLES
          KARENA TIDAK BAGUS UNTUK UI NYA, JIKA ANDA MAU MENGGUNAKANNYA
          TINGGAL DI UNCOMMENT, DAN AKTIFKAN YANG ATASNYA DAN HAPUS
          BAWAHNYA -->

        <!-- <table class="table table-bordered" id="example"> -->
        <table class="table">
          <thead class="thead">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Pesanan</th>
              <th scope="col">Harga</th>
              <th scope="col">Jumlah</th>
              <th scope="col">Subharga</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nomor        = 1;
                $totalbelanja = 0;
                foreach ($_SESSION["pesanan"] as $id_menu => $jumlah): 
                include('koneksi.php');
                $ambil    = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_menu='$id_menu'");
                $pecah    = $ambil -> fetch_assoc();
                $subharga = $pecah["harga"]*$jumlah;
              ?>
            <tr>
              <td><?php echo $nomor; ?></td>
              <td><?php echo $pecah["nama_menu"]; ?></td>
              <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
              <td><?php echo $jumlah; ?></td>
              <td>Rp. <?php echo number_format($subharga); ?></td>
              <td>
                <a href="hapus_pesanan.php?id_menu=<?php echo $id_menu ?>" class="badge badge-danger">Hapus</a>
              </td>
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja+=$subharga; ?>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Total Belanja</th>
              <th colspan="2">Rp. <?php echo number_format($totalbelanja) ?></th>
            </tr>
            <?php
                $dataOngkir = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ongkir"));
              ?>
            <tr class="<?= $dataOngkir['ongkir_status'] == 'gratis' ? 'd-none' : '' ?>">
              <th colspan="4">Biaya Ongkos Kirim</th>
              <th colspan="2">Rp. <?php echo number_format($dataOngkir['ongkir_harga']) ?></th>
            </tr>
            <tr>
              <th colspan="4">Total Pesanan</th>
              <th colspan="2">
                <?php
                    if($dataOngkir['ongkir_status'] == 'flat') {
                      $pesanan_total = $dataOngkir['ongkir_harga'] + $totalbelanja; 
                    } else {
                      $pesanan_total = $totalbelanja;
                    }
                    echo "Rp. " . number_format($pesanan_total);
                  ?>
              </th>
            </tr>
          </tfoot>
        </table>
        <br>
        <hr>

        <form method="POST" action="" enctype="multipart/form-data" autocomplete="off">
          <input type="hidden" name="ongkir" value="<?= $dataOngkir['ongkir_harga']; ?>">
          <div class="form-group mb-2">
            <label for="nama">Nama Penerima</label>
            <input type="text" name="nama_penerima" id="nama" class="form-control" placeholder="Nama Penerima" required>
            <input type="hidden" name="pesanan_total" value="<?= $pesanan_total ?>">
          </div>

          <div class="form-group mb-2">
            <label for="alamat">Alamat Penerima</label>
            <textarea name="alamat_penerima" id="alamat_penerima" cols="10" rows="2" class="form-control"
              placeholder="Alamat Penerima" required></textarea>
          </div>

          <div class="form-group">
            <label for="gambar">bukti pembayaran</label>
            <input type="file" class="form-control-file border" id="gambar" name="gambar" required>
          </div><br>
          <button type="submit" class="btn btn-success" name="konfirm">Konfirmasi Pesanan</button>
          <a href="menu_pembeli.php" class="btn btn-primary btn-sm">Lihat Menu</a>
          <a href="bayar_di_tempat.php" class="btn btn-primary btn-sm">Bayar Di tempat</a>
        </form>
        <?php } ?>

      </div>

      <div class="tab-pane fade" id="konfirmasi" role="tabpanel" aria-labelledby="konfirmasi-tab">
        <?php
        if(mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Menunggu Konfirmasi'")) == 0) {
        echo "<h3 class='text-center'>Pesanan yang menunggu konfirmasi tidak ada!</h3>";
        } else { ?>
        <table class="table table-bordered" id="example">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col">Tanggal Pesan</th>
              <th scope="col">Total Bayar</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nomor        = 1;
                $konfirmasi   = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Menunggu Konfirmasi'");
                while($data_konfirmasi = mysqli_fetch_array($konfirmasi)) {
              ?>
            <tr>
              <td><?= $nomor++; ?></td>
              <td><?= $data_konfirmasi['nomor_transaksi'] ?></td>
              <td><?= $data_konfirmasi['tanggal_pemesanan'] ?></td>
              <td>Rp. <?= number_format($data_konfirmasi["total_belanja"]); ?></td>
              <td><?= $data_konfirmasi['status'] ?></td>
              <td>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                  data-target="#detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>">
                  Detail Pemesanan
                </button>
              </td>
            </tr>
            <div class="modal fade" id="detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>" tabindex="-1"
              role="dialog">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3 border-bottom pb-2">
                      <div class="col-2">Nomor</div>
                      <div class="col-4">Nama Menu</div>
                      <div class="col-2">Jumlah</div>
                      <div class="col-2">Harga</div>
                      <div class="col-2">Sub Total</div>
                    </div>
                    <?php
                        $no = 1;
                        $query_pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu = produk.id_menu WHERE pemesanan_produk.id_pemesanan='$data_konfirmasi[id_pemesanan]'");
                        while($data_pesanan = mysqli_fetch_array($query_pesanan)) {
                      ?>

                    <div class="row mt-2 pb-2 border-bottom">
                      <div class="col-2"><?= $no++ ?></div>
                      <div class="col-4"><?= $data_pesanan['nama_menu'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga']) ?></div>
                      <div class="col-2"><?= $data_pesanan['jumlah'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga'] * $data_pesanan['jumlah']) ?>
                      </div>
                    </div>
                    <?php } ?>

                    <div class="row mt-4">
                      <div class="col-5">Nama Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['nama_penerima'] ?></div>

                      <div class="col-5">Alamat Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['alamat_penerima'] ?></div>

                      <div class="col-5">Harga Total (Termasuk Ongkir jika ada)</div>
                      <div class="col-1">:</div>
                      <div class="col-6">Rp. <?= number_format($data_konfirmasi['total_belanja']) ?></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
      </div>

      <div class="tab-pane fade" id="dikemas" role="tabpanel" aria-labelledby="dikemas-tab">
        <?php
        if(mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Dikemas'")) == 0) {
        echo "<h3 class='text-center'>Pesanan anda belum ada yang dikemas!</h3>";
        } else { ?>
        <table class="table table-bordered" id="example">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col">Tanggal Pesan</th>
              <th scope="col">Total Bayar</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nomor        = 1;
                $konfirmasi   = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Dikemas'");
                while($data_konfirmasi = mysqli_fetch_array($konfirmasi)) {
              ?>
            <tr>
              <td><?= $nomor++; ?></td>
              <td><?= $data_konfirmasi['nomor_transaksi'] ?></td>
              <td><?= $data_konfirmasi['tanggal_pemesanan'] ?></td>
              <td>Rp. <?= number_format($data_konfirmasi["total_belanja"]); ?></td>
              <td><?= $data_konfirmasi['status'] ?></td>
              <td>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                  data-target="#detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>">
                  Detail Pemesanan
                </button>
              </td>
            </tr>
            <div class="modal fade" id="detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>" tabindex="-1"
              role="dialog">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3 border-bottom pb-2">
                      <div class="col-2">Nomor</div>
                      <div class="col-4">Nama Menu</div>
                      <div class="col-2">Jumlah</div>
                      <div class="col-2">Harga</div>
                      <div class="col-2">Sub Total</div>
                    </div>
                    <?php
                        $no = 1;
                        $query_pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu = produk.id_menu WHERE pemesanan_produk.id_pemesanan='$data_konfirmasi[id_pemesanan]'");
                        while($data_pesanan = mysqli_fetch_array($query_pesanan)) {
                      ?>

                    <div class="row mt-2 pb-2 border-bottom">
                      <div class="col-2"><?= $no++ ?></div>
                      <div class="col-4"><?= $data_pesanan['nama_menu'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga']) ?></div>
                      <div class="col-2"><?= $data_pesanan['jumlah'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga'] * $data_pesanan['jumlah']) ?>
                      </div>
                    </div>
                    <?php } ?>

                    <div class="row mt-4">
                      <div class="col-5">Nama Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['nama_penerima'] ?></div>

                      <div class="col-5">Alamat Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['alamat_penerima'] ?></div>

                      <div class="col-5">Harga Total (Termasuk Ongkir jika ada)</div>
                      <div class="col-1">:</div>
                      <div class="col-6">Rp. <?= number_format($data_konfirmasi['total_belanja']) ?></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
      </div>

      <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
        <?php
        if(mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Dikirim'")) == 0) {
        echo "<h3 class='text-center'>Tidak ada pesanan yang dikirim!</h3>";
        } else { ?>
        <table class="table table-bordered" id="example">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col">Tanggal Pesan</th>
              <th scope="col">Total Bayar</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nomor        = 1;
                $konfirmasi   = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Dikirim'");
                while($data_konfirmasi = mysqli_fetch_array($konfirmasi)) {
              ?>
            <tr>
              <td><?= $nomor++; ?></td>
              <td><?= $data_konfirmasi['nomor_transaksi'] ?></td>
              <td><?= $data_konfirmasi['tanggal_pemesanan'] ?></td>
              <td>Rp. <?= number_format($data_konfirmasi["total_belanja"]); ?></td>
              <td><?= $data_konfirmasi['status'] ?></td>
              <td>
                <a href="ubah_status.php?id=<?= $data_konfirmasi['id_pemesanan'] ?>" class="btn btn-success">Pesanan
                  Diterima</a>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                  data-target="#detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>">
                  Detail Pemesanan
                </button>
              </td>
            </tr>
            <div class="modal fade" id="detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>" tabindex="-1"
              role="dialog">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3 border-bottom pb-2">
                      <div class="col-2">Nomor</div>
                      <div class="col-4">Nama Menu</div>
                      <div class="col-2">Jumlah</div>
                      <div class="col-2">Harga</div>
                      <div class="col-2">Sub Total</div>
                    </div>
                    <?php
                        $no = 1;
                        $query_pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu = produk.id_menu WHERE pemesanan_produk.id_pemesanan='$data_konfirmasi[id_pemesanan]'");
                        while($data_pesanan = mysqli_fetch_array($query_pesanan)) {
                      ?>

                    <div class="row mt-2 pb-2 border-bottom">
                      <div class="col-2"><?= $no++ ?></div>
                      <div class="col-4"><?= $data_pesanan['nama_menu'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga']) ?></div>
                      <div class="col-2"><?= $data_pesanan['jumlah'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga'] * $data_pesanan['jumlah']) ?>
                      </div>
                    </div>
                    <?php } ?>

                    <div class="row mt-4">
                      <div class="col-5">Nama Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['nama_penerima'] ?></div>

                      <div class="col-5">Alamat Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['alamat_penerima'] ?></div>

                      <div class="col-5">Harga Total (Termasuk Ongkir jika ada)</div>
                      <div class="col-1">:</div>
                      <div class="col-6">Rp. <?= number_format($data_konfirmasi['total_belanja']) ?></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
      </div>

      <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
        <?php
        if(mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Selesai'")) == 0) {
        echo "<h3 class='text-center'>Anda belum memesan apa-apa!</h3>";
        echo "<a href='menu_pembeli.php' class='d-block mx-auto btn btn-primary mt-5' style='width: 20%'>Daftar Menu</a>";
        } else { ?>
        <table class="table table-bordered" id="example">
          <thead class="thead-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nomor Transaksi</th>
              <th scope="col">Tanggal Pesan</th>
              <th scope="col">Total Bayar</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $nomor        = 1;
                $konfirmasi   = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_user='$id_user' AND status='Selesai'");
                while($data_konfirmasi = mysqli_fetch_array($konfirmasi)) {
              ?>
            <tr>
              <td><?= $nomor++; ?></td>
              <td><?= $data_konfirmasi['nomor_transaksi'] ?></td>
              <td><?= $data_konfirmasi['tanggal_pemesanan'] ?></td>
              <td>Rp. <?= number_format($data_konfirmasi["total_belanja"]); ?></td>
              <td><?= $data_konfirmasi['status'] ?></td>
              <td>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                  data-target="#detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>">
                  Detail Pemesanan
                </button>
              </td>
            </tr>
            <div class="modal fade" id="detailPesanan<?= $data_konfirmasi['id_pemesanan'] ?>" tabindex="-1"
              role="dialog">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3 border-bottom pb-2">
                      <div class="col-2">Nomor</div>
                      <div class="col-4">Nama Menu</div>
                      <div class="col-2">Jumlah</div>
                      <div class="col-2">Harga</div>
                      <div class="col-2">Sub Total</div>
                    </div>
                    <?php
                        $no = 1;
                        $query_pesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan_produk JOIN produk ON pemesanan_produk.id_menu = produk.id_menu WHERE pemesanan_produk.id_pemesanan='$data_konfirmasi[id_pemesanan]'");
                        while($data_pesanan = mysqli_fetch_array($query_pesanan)) {
                      ?>

                    <div class="row mt-2 pb-2 border-bottom">
                      <div class="col-2"><?= $no++ ?></div>
                      <div class="col-4"><?= $data_pesanan['nama_menu'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga']) ?></div>
                      <div class="col-2"><?= $data_pesanan['jumlah'] ?></div>
                      <div class="col-2">Rp. <?= number_format($data_pesanan['harga'] * $data_pesanan['jumlah']) ?>
                      </div>
                    </div>
                    <?php } ?>

                    <div class="row mt-4">
                      <div class="col-5">Nama Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['nama_penerima'] ?></div>

                      <div class="col-5">Alamat Penerima</div>
                      <div class="col-1">:</div>
                      <div class="col-6"><?= $data_konfirmasi['alamat_penerima'] ?></div>

                      <div class="col-5">Harga Total (Termasuk Ongkir jika ada)</div>
                      <div class="col-1">:</div>
                      <div class="col-6">Rp. <?= number_format($data_konfirmasi['total_belanja']) ?></div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </tbody>
        </table>
        <?php } ?>
      </div>
    </div>

    <?php
      if(isset($_POST['konfirm'])) {
          $nomor_transaksi   = "KLC" . rand(100, 900);
          $nama_penerima     = $_POST['nama_penerima'];
          $alamat_penerima   = $_POST['alamat_penerima'];
          $pesanan_total     = $_POST['pesanan_total'];
          $ongkir            = $_POST['ongkir'];
          $tanggal_pemesanan = date("Y-m-d");
          $nama_file         = $_FILES['gambar']['name'];
          $source            = $_FILES['gambar']['tmp_name'];
          $folder            = './upload/';
          move_uploaded_file($source, $folder.$nama_file);
          // Menyimpan data ke tabel pemesanan
          $insert            = mysqli_query($koneksi, "INSERT INTO pemesanan SET id_user='$id_user', nomor_transaksi = '$nomor_transaksi', nama_penerima = '$nama_penerima',
                                                                                  alamat_penerima = '$alamat_penerima', tanggal_pemesanan = '$tanggal_pemesanan',
                                                                                  total_belanja = '$pesanan_total', ongkir='$ongkir', gambar = '$nama_file', status = 'Menunggu Konfirmasi'");
          // Mendapatkan ID barusan
          $id_terbaru        = $koneksi->insert_id;
          // Menyimpan data ke tabel pemesanan produk
          foreach ($_SESSION["pesanan"] as $id_menu => $jumlah) {
            $insert = mysqli_query($koneksi, "INSERT INTO pemesanan_produk (id_pemesanan, id_menu, jumlah, gambar) 
              VALUES ('$id_terbaru', '$id_menu', '$jumlah','$nama_file') ");
          }
          // Mengosongkan pesanan
          unset($_SESSION["pesanan"]);
          // Dialihkan ke halaman nota
          echo "<script>alert('Pemesanan Sukses!');</script>";
          echo "<script>location= 'menu_pembeli.php'</script>";
      }
      ?>
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
  <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
  </script>
  <script src="./vendors/selectPlugin/dist/js/select2.min.js"></script>
  <script src="./vendors/selectPlugin/dist/js/i18n/id.js"></script>
  <script src="./js/ongkir.js"></script>
</body>

</html>
<?php } ?>