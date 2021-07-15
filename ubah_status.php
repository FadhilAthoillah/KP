<?php
    include('koneksi.php');
    $id_pemesanan = $_GET['id'];
    $tampil_pemesanan = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'"));

    if($tampil_pemesanan['status'] == "Menunggu Konfirmasi") {
        $ubah_status = mysqli_query($koneksi, "UPDATE pemesanan SET status = 'Dikemas' WHERE id_pemesanan = '$id_pemesanan'");
        echo "<script>alert('Pesanan diproses!');</script>";
        echo "<script>location= 'pesanan.php'</script>";
    } else if($tampil_pemesanan['status'] == "Dikemas") {
        $ubah_status = mysqli_query($koneksi, "UPDATE pemesanan SET status = 'Dikirim' WHERE id_pemesanan = '$id_pemesanan'");
        echo "<script>alert('Pemesanan Dikirim!');</script>";
        echo "<script>location= 'pesanan.php'</script>";
    } else if($tampil_pemesanan['status'] == "Dikirim") {
        $ubah_status = mysqli_query($koneksi, "UPDATE pemesanan SET status = 'Selesai' WHERE id_pemesanan = '$id_pemesanan'");
        echo "<script>alert('Terima kasih telah berbelanja, semoga harimu menyenangkan!');</script>";
        echo "<script>location= 'pesanan_pembeli.php'</script>";
    }
?>