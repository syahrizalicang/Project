<?php
	session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	} 
?>
<?php
include 'db.php';
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
			<h1><a class="text-red" href="dashboard.php">Tokonabila</a></h1>
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
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?php echo $_SESSION['a_global']->admin_name ?></h4>
			</div>
		</div>
	</div>
    <div class="section">
        <div class="container">
            <h4>Data Penjualan</h4>
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
                    <th>Status</th>
                    <th>Update To</th>
                </tr>
                </thead>
                <tbody style="text-align: center;">
                <?php $no = 1 ?>
                <?php $pembelian = mysqli_query($conn, "SELECT * FROM penjualan LEFT JOIN tb_product USING (product_id) ORDER BY tanggal_order DESC") ?>
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
                                <?php
                                if($row['status'] == 0 ){
                                    echo "Diproses";
                                }elseif ($row['status'] == 1){
                                    echo "Selesai";
                                }else{
                                    echo "Dikirim";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($row['status'] == 0 ){
                                    echo '<a href="update-penjualan.php?penjualan_id='.$row['penjualan_id'].'&status=2" class="btn button6">Dikirim</a>';
                                }elseif ($row['status'] == 1){
                                    echo 'SELESAI';
                                }else{
                                    echo '<a href="update-penjualan.php?penjualan_id='.$row['penjualan_id'].'&status=1" class="btn button1">Selesai</a>';
                                }
                                ?>
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
</body>
</html>