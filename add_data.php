<?php
include("connection.php");
//untuk memulai session
session_start();

// kuery untuk mengambil data produk dan sales
$produkQuery = mysqli_query($conn, "SELECT * FROM produk");
$salesQuery = mysqli_query($conn, "SELECT * FROM sales");

// submit form menyimpan data ke database

if (isset($_POST['submit'])) {
 $tanggal = $_POST['tanggal'];
 $id_sales = $_POST['id_sales'];
 $nama_lead = $_POST['nama_lead'];
 $id_produk = $_POST['id_produk'];
 $no_wa = $_POST['no_wa'];
 $kota = $_POST['kota']; 

 // query untuk menambahkan data leads
 $query = "INSERT INTO leads (tanggal, id_sales,id_produk,no_wa, nama_lead,   kota) VALUES ('$tanggal', '$id_sales', '$id_produk', '$no_wa', '$nama_lead', '$kota')";

if ( mysqli_query($conn, $query)) {
 $_SESSION['success'] = "Data leads berhasil disimpan.";
}else {
 $_SESSION['error'] = "Data leads gagal disimpan.";
}
 header("Location: index.php");
 exit();
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Leads</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h1 class="title">Selamat datang di tambah leads</h1>
    <div class="card">
      <div class="card-header ">
        <a href="index.php" class="btn btn-success">Kembali</a>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row m-3">
            <div class="col">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="col">
              <label class="form-label">Sales</label>
              <select class="form-select" name="id_sales" required>
                <option value="" hidden>--Pilih Sales--</option>
                <?php while ($sales = mysqli_fetch_assoc($salesQuery)) { ?>
                  <option value="<?= $sales['id_sales'] ?>"><?= $sales['nama_sales'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <label class="form-label">Nama lead</label>
              <input type="text" class="form-control" name="nama_lead" placeholder="Nama lead" required>
            </div>
          </div>
          <div class="row m-3">
            <div class="col">
              <label class="form-label">Produk</label>
              <select class="form-select" name="id_produk" required>
                <option value="" hidden>--Pilih Produk--</option>
                <?php while ($produk = mysqli_fetch_assoc($produkQuery)) { ?>
                  <option value="<?= $produk['id_produk'] ?>"><?= $produk['nama_produk'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <label class="form-label">No. Whatsapp</label>
              <input type="number" class="form-control" name="no_wa" placeholder="No. Whatsapp" required>
            </div>
            <div class="col">
              <label class="form-label">Kota</label>
              <input type="text" class="form-control" name="kota" placeholder="Kota" required>
            </div>
          </div>
            <div class="card-footer text-center">
        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-secondary">Cancel</button>
      </div>
        </form>
      </div>
    
    </div>
  </div>
</body>
</html>
