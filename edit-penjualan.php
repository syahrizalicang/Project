<?php
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	} 

	$penjualan = mysqli_query($conn, "SELECT * FROM penjualan WHERE penjualan_id = '".$_GET['id']."' ");
	if(mysqli_num_rows($penjualan) == 0){
		echo '<script>window.location="data-penjualan.php"</script>';
	}
	$p = mysqli_fetch_object($penjualan);

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
			<h3>Edit Data Penjualan</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="produk" required>
                        <option value="">--Pilih--</option>
                        <?php
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product ORDER BY product_id DESC");
                        while($r = mysqli_fetch_array($produk)){
                            ?>
                            <option value="<?php echo $r['product_id'] ?>" <?php echo ($r['product_id'] == $p->product_id)? 'selected':''; ?>><?php echo $r['product_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" value="<?php echo $p->nama_pembeli ?>" placeholder="Nama Pembeli" required>
                    <input type="text" name="email" class="input-control" value="<?php echo $p->email_pembeli ?>" placeholder="Email" required>
                    <input type="text" name="tlp" class="input-control" placeholder="Telepon(WA)" value="<?php echo $p->telepon ?>" required>
                    <input type="number" name="jumlah" class="input-control" placeholder="Jumlah Barang"value="<?php echo $p->jumlah_barang ?>"  required>
                    <textarea class="input-control" name="alamat" placeholder="Alamat Pengiriman"> <?php echo $p->alamat_pengiriman ?> </textarea>
                    <input type="number" name="harga" class="input-control" value="<?php echo $p->total_harga ?>" placeholder="Total Harga">
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->status == 1)? 'selected':''; ?>>Selesai</option>
                        <option value="2" <?php echo ($p->status == 2)? 'selected':''; ?>>Dikirm</option>
                        <option value="0" <?php echo ($p->status == 0)? 'selected':''; ?>>Proses</option>
                    </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                if(isset($_POST['submit'])){
                    $produk 	= $_POST['produk'];
                    $nama 		= $_POST['nama'];
                    $email 		= $_POST['email'];
                    $tlp 		= $_POST['tlp'];
                    $jumlah 	= $_POST['jumlah'];
                    $harga 		= $_POST['harga'];
                    $alamat 	= $_POST['alamat'];
                    $totalHarga = $_POST['harga'];
                    $status = $_POST['status'];

						// query update data produk
						$update = mysqli_query($conn, "UPDATE penjualan SET
												product_id = '".$produk."',
												nama_pembeli = '".$nama."',
												telepon = '".$tlp."',
												alamat_pengiriman = '".$alamat."',
												email_pembeli = '".$email."',
												total_harga = '".$totalHarga."',
												status = '".$status."',
												jumlah_barang = '".$jumlah."'
												WHERE penjualan_id = '".$p->penjualan_id."' ");
						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="data-penjualan.php"</script>';
						}else{
							echo 'gagal'.mysqli_error($conn);
						}

					}
				?>
			</div>
		</div>
	</div>

	<!-- footer-->
	<footer>
		<div class="container">
			<small>Copyright &copy; 2022 - Tokonabila.</small>
		</div>
	</footer>
</body>
</html>