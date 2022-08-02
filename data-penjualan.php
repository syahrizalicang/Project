<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tokonabila</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<!--	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
</head>
<body>
	<!--header -->
	<header>
		<div class="container">
			<h1><a href="dashboard.php">Tokonabila</a></h1>
			<ul>
				<li><a href="dashboard.php">Dashboard</a></li>
				<li><a href="profil.php">Profil</a></li>
				<li><a href="data-kategori.php">Data kategori</a></li>
				<li><a href="data-produk.php">Data Produk</a></li>
				<li><a href="data-penjualan.php">Data Penjualan</a></li>
				<li><a href="keluar.php">Keluar</a></li>
				
			</ul>
		</div>
	</header>
	<!-- content -->
	<div class="section">
		<div class="container">
			<h4>Data Penjualan</h4>
            <p><a class="btn-add p-10" href="tambah-penjualan.php">Tambah Data</a>
            <div class="box">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Produk</th>
						<th>Telepon</th>
						<th>Total Harga</th>
						<th>Tanggal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody style="text-align: center;">
					<?php $no = 1 ?>
					<?php $pembelian = mysqli_query($conn, "SELECT * FROM penjualan LEFT JOIN tb_product USING (product_id) ORDER BY penjualan_id DESC") ?>
					<?php
                    if(mysqli_num_rows($pembelian) > 0){
                        while($row = mysqli_fetch_array($pembelian)){ ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nama_pembeli']; ?></td>
                            <td><?php echo $row['product_name'] ?></td>
                            <td><?php echo $row['telepon'] ?></td>
                            <td>Rp. <?php echo number_format($row['total_harga']) ?></td>
                            <td><?php echo $row['tanggal_order'] ?></td>
                            <td>
                                <a href="edit-penjualan.php?id=<?php echo $row['penjualan_id'] ?>" class="btn btn-warning">Edit</a>
                                <a href="proses-hapus.php?id_penjualan=<?php echo $row['penjualan_id'] ?>" class="btn btn-danger">hapus</a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php } ?>
                    <?php } ?>
					 
				</tbody>
				
			</table>
            </div>
			
		</div>
	</div>

	<!-- footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2022 - Tokonabila.</small>
		</div>
	</footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>