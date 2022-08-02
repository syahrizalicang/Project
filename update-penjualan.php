<?php
include 'db.php';

if(isset($_GET['idk'])){
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['idk']."' ");
    echo '<script>window.location="data-kategori.php"</script>';
}
if(isset($_GET['penjualan_id'])){
    // query update data produk
    $update = mysqli_query($conn, "UPDATE penjualan SET												
												status = '".$_GET['status']."'
												WHERE penjualan_id = '".$_GET['penjualan_id']."' ");
    if($update){
        echo '<script>alert("Ubah data berhasil")</script>';
        echo '<script>window.location="dashboard.php"</script>';
    }else{
        echo 'gagal'.mysqli_error($conn);
    }

}
?>