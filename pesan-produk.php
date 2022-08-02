<?php  
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
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
    <script src="layout/jquery.min.js"></script>
</head>
<body>
	<!--header -->
	<header>
		<div class="container">
			<h1><a href="index.php">Tokonabila</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>				
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
			

		</div>
	</div>

	<!-- produk detail -->
	<div class="section">
		<div class="container">
			<h3>Pemesanan Produk</h3>
			<div class="box">
				<div class="col-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="produk" required>
                            <option value="<?php echo $p->product_id ?>"><?php echo $p->product_name ?></option>
                        </select>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Pembeli" required>
                        <input type="text" name="email" class="input-control" placeholder="Email" required>
                        <input type="text" name="tlp" class="input-control" placeholder="Telepon(WA)" required>
                        <input type="number" id="jumlah" name="jumlah" class="input-control" placeholder="Jumlah Barang" required>
                        <textarea class="input-control" name="alamat" placeholder="Alamat Pengiriman"></textarea>
                        <input type="number" id="harga" name="total_harga" class="input-control" placeholder="Total Harga">
                        <input type="submit" name="submit" value="Submit" class="btn">
                    </form>
                    <?php
                    if(isset($_POST['submit'])){

                        // print_r($_FILES['gambar']);
                        // menampung inputan dari form
                        $produk 	= $_POST['produk'];
                        //dd($produk);
                        $nama 		= $_POST['nama'];
                        $email 		= $_POST['email'];
                        $tlp 		= $_POST['tlp'];
                        $jumlah 	= $_POST['jumlah'];
                        $harga 		= $_POST['harga'];
                        $alamat 	= $_POST['alamat'];
                        $totalHarga = $_POST['total_harga'];
                        $stok = $p->stok - $_POST['jumlah'];

                        $insert = mysqli_query($conn, "INSERT INTO penjualan VALUES (
										null,
                                        '".$nama."',
										'".$tlp."',
										'".$alamat."',
										null,
										'".$produk."',
										'".$email."',
										'".$totalHarga."',
										'".$jumlah."',
										0
								            ) ");
                        $update = mysqli_query($conn, "UPDATE tb_product SET
												stok = '".$stok."'
												WHERE product_id = '".$p->product_id."' ");

                        if($insert){
                            echo '<script>alert("Pesanan Sedang Diperoses Admin Silahakan Menunggu Konfirmasi Via Whatsapp")</script>';
                            echo '<script>window.location="detail-produk.php?id='.$_GET['id'].'"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                    }
                    ?>
				</div>
				<div class="col-3">
					<h3><?php echo $p->product_name ?></h3>
					<h3>Stok : <?php echo $p->stok ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p->product_description ?>
					</p>
					<p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">
						Hubungin via Whatsapp
						<img src="img/wa.jpg" width="50px"></a>
					</p>
				</div>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2022 - Toko Nabila.</small>
		</div>
	</div>
</body>
<script>
    $(document).ready(function(){
       $('#jumlah').on('change', function() {
           var harga = this.value * <?php echo $p->product_price?>;
           $('#harga').val(harga);
           // alert( this.value );
       });
    });
</script>
</html>