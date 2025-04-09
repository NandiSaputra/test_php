
<?php

include("connection.php");
session_start();
//query untuk ambil data product

$ProductQuery = mysqli_query($conn, "SELECT * FROM produk");

// query untuk ambil data sales
$SalesQuery = mysqli_query($conn, "SELECT * FROM sales");

//query untuk filter produk
$no =1;
if (isset($_GET['submit'])) {
  $id_produk = $_GET['id_produk'];

  $leadQuery = mysqli_query($conn, "SELECT * FROM leads 
  JOIN produk ON leads.id_produk = produk.id_produk 
  JOIN sales ON leads.id_sales = sales.id_sales 
  WHERE leads.id_produk = '$id_produk' 
  ORDER BY leads.tanggal DESC");
}elseif (isset($_GET['reset'])) {
  $leadQuery = mysqli_query($conn, "SELECT * FROM leads 
  JOIN produk ON leads.id_produk = produk.id_produk 
  JOIN sales ON leads.id_sales = sales.id_sales 
  ORDER BY leads.tanggal DESC");  
}else {
  $leadQuery = mysqli_query($conn, "SELECT * FROM leads 
  JOIN produk ON leads.id_produk = produk.id_produk 
  JOIN sales ON leads.id_sales = sales.id_sales 
  ORDER BY leads.tanggal DESC");
}


//query untuk filter sales dan tanggal
if (isset($_GET['submit_sales_date'])) {
 
  $tanggal = $_GET['tanggal'];
   $id_sales = $_GET['id_sales'];

if (isset($tanggal) && isset($id_sales)) {
  $leadQuery = mysqli_query($conn, "SELECT * FROM leads 
  JOIN produk ON leads.id_produk = produk.id_produk 
  JOIN sales ON leads.id_sales = sales.id_sales 
  WHERE leads.tanggal = '$tanggal' AND leads.id_sales = '$id_sales' 
  ORDER BY leads.tanggal DESC");
 
}
}



?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  
  <body>
   <?php if (isset($_SESSION['success'])): ?>
 <div class="alert alert-success" role="alert">
     <?= $_SESSION['success'] ?> 
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>
<div class="container">
  <form method="GET">
    <div class="col">
              <label class="form-label">Produk</label>
              <select class="form-select" name="id_produk">
                <option value="" hidden >--Pilih Produk--</option>
                <?php while ($produk = mysqli_fetch_assoc($ProductQuery)) { ?>
                  <option value="<?= $produk['id_produk'] ?>"> <?= isset($_GET['id_produk']) && $_GET['id_produk'] == $produk['id_produk'] ? : '' ?> <?= $produk['nama_produk'] ?></option>
                <?php } ?>
              </select>
            </div>
             <button type="submit" name="submit" class="btn btn-primary">Cari</button>
             <button type="submit" name="reset" class="btn btn-primary">reset</button>
             </form> 
          </div>
  
 <div class="container">  <form method="GET">
      <div>
        <label class="form-label">Tanggal</label>
        <input type="date" class="form-control" name="tanggal">
      </div>
    <div class="col">
              <label class="form-label">Sales</label>
              <select class="form-select" name="id_sales">
                <option value="" hidden >--Pilih Sales--</option>
                <?php while ($sales = mysqli_fetch_assoc($SalesQuery)) { ?>
                  <option value="<?= $sales['id_sales'] ?>"> <?= isset($_GET['id_sales']) && $_GET['id_sales'] == $sales['id_sales'] ? : '' ?> <?= $sales['nama_sales'] ?></option>
                <?php } ?>
              </select>
            </div>
             <button type="submit" name="submit_sales_date" class="btn btn-primary">Cari</button>
             <button type="submit" name="reset_sales_date" class="btn btn-primary">reset</button>
          </div>
 
  </form> </div>
   
 

  <div class="container mt-4 mb-4"> <a href="add_data.php" class="btn btn-secondary">Tambah Data</a> </div>
    
<table class="table table-striped table-hover">
  <thead> </thead>
    
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Id Input</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Sales</th>
      <th scope="col">Produk</th>
      <th scope="col">Nama_Leads</th>
      <th scope="col">No. Wa</th>
        <th scope="col">Kota</th>
         <th scope="col">Aksi</th>

     
      <tbody></tbody>
      <?php while ($lead = mysqli_fetch_assoc($leadQuery)) { ?>
        <tr>
          <td><?= $no++?></td>
         <td><?= str_pad($lead['id_leads'], 3, '0', STR_PAD_LEFT) ?></td>
          <td><?= $lead['tanggal'] ?></td>
          <td><?= $lead['nama_sales'] ?></td>
          <td><?= $lead['nama_produk'] ?></td>
           <td><?= $lead['nama_lead'] ?></td>
            <td><?= $lead['no_wa'] ?></td>
             <td><?= $lead['kota'] ?></td>
             <td><a href="edit_data.php?id_leads=<?= $lead['id_leads'] ?>" class="btn btn-primary">Edit</a></td>
          <?php } ?>
</table>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
  </body>
</html>