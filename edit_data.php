<?php
include("connection.php");
//untuk memulai session
session_start();

// kuery untuk mengambil data produk dan sales
$produkQuery = mysqli_query($conn, "SELECT * FROM produk");
$salesQuery = mysqli_query($conn, "SELECT * FROM sales");

//query untuk mengambil data lead berdadarkan id


$id_leads = $_GET['id_leads'];
$query = "SELECT * FROM leads join produk on leads.id_produk = produk.id_produk join sales on leads.id_sales = sales.id_sales WHERE id_leads = '$id_leads'";
$result = mysqli_query($conn, $query);
$lead = mysqli_fetch_assoc($result);
// untuk update data lead berdasrkan id
if (isset($_POST['edit'])) {
 $tanggal = $_POST['tanggal'];
 $id_sales = $_POST['id_sales'];
 $nama_lead = $_POST['nama_lead'];
 $id_produk = $_POST['id_produk'];
 $no_wa = $_POST['no_wa']; 
 $kota = $_POST['kota']; 
// query update data leads
 $query = "UPDATE leads SET tanggal = '$tanggal', id_sales = '$id_sales', id_produk = '$id_produk', no_wa = '$no_wa', nama_lead = '$nama_lead', kota = '$kota' WHERE id_leads = '$id_leads'";

if ( mysqli_query($conn, $query)) {
 // menampilkan pesan
 $_SESSION['success'] = "Data leads berhasil di edit.";
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
    <h1 class="title">Selamat datang di edit leads</h1>
    <div class="card">
    
      <div class="card-body">
        <form method="POST">
          <div class="row m-3">
            <div class="col">
              <label class="form-label">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" value="<?= $lead['tanggal'] ?>" required>
            </div>
            <div class="col">
              <label class="form-label">Sales</label>
              <select class="form-select" name="id_sales"required>
                <option value="">--Pilih Sales--</option>
                <?php while ($sales = mysqli_fetch_assoc($salesQuery)) { ?>
                  <option value="<?= $sales['id_sales'] ?>"><?= $sales['id_sales'] == $lead['id_sales']? 'Selected' : '' ?> <?= $sales['nama_sales'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <label class="form-label">Nama lead</label>
              <input type="text" class="form-control" name="nama_lead" placeholder="Nama lead" value="<?= $lead['nama_lead'] ?>" required>
            </div>
          </div>
          <div class="row m-3">
            <div class="col">
              <label class="form-label">Produk</label>
              <select class="form-select" name="id_produk" required>
                <option value="" hidden >--Pilih Produk--</option>
                <?php while ($produk = mysqli_fetch_assoc($produkQuery)) { ?>
                  <option value="<?= $produk['id_produk'] ?>"><?= $produk['id_produk'] == $lead['id_produk']? 'selected': '' ?> <?= $produk['nama_produk'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col">
              <label class="form-label">No. Whatsapp</label>
              <input type="number" class="form-control" name="no_wa" placeholder="No. Whatsapp" value="<?= $lead['no_wa'] ?>" required>
            </div>
            <div class="col">
              <label class="form-label">Kota</label>
              <input type="text" class="form-control" name="kota" placeholder="Kota" value ="<?= $lead['kota'] ?>" required>
            </div>
          </div>
            <div class="card-footer text-center">
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
       <a href="index.php" class="btn btn-secondary">Kembali</a>
      </div>
        </form>
      </div>
    
    </div>
  </div>
</body>
</html>
