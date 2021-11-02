<?php 
include "db.php";

if($_GET['idk']){
    $hapus = mysqli_query($conn , "DELETE FROM tb_category WHERE category_id ='".$_GET['idk']."'");
    //echo '<script>alert("data telah di hapus")</script>';
    echo '<script>window.location="data-kategori.php"</script>';
}
if($_GET['idp']){

    $file= mysqli_query($conn, "SELECT product_img FROM tb_product WHERE product_id = '".$_GET['idp']."'");

    $db= mysqli_fetch_object($file);
    unlink('./produk/'.$db->product_img);

    $hapus = mysqli_query($conn , "DELETE FROM tb_product WHERE product_id ='".$_GET['idp']."'");
    //echo '<script>alert("data telah di hapus")</script>';
    echo '<script>window.location="data-produk.php"</script>';
}