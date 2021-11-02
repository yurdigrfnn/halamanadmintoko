<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    include "db.php";

    $produk = mysqli_query($conn,"SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."'" );
    $r = mysqli_fetch_object($produk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Toko | Edit produk</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head> 
<body id="dashboard">
    <!--header -->
    <div class="header">
    <header class= "menu" >
        <h1><a href="dashboard.php">Toko AR</a></h1>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profil</a></li>
            <li><a href="data-kategori.php">Data kategori</a></li>
            <li><a href="data-produk.php">Data Produk</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </header></div>
     <div class="section">
         <div class="countainer">
             <h3>Edit produk</h3>
             <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <select name="kategori" class="input-control" require>
                         <option value="">---pilih---</option>
                         <?php
                            $kategori= mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($p =mysqli_fetch_array($kategori)) {
                            
                         ?>
                         <option value="<?php echo $p['category_id']?>"<?php echo ($p['category_id']== $r->category_id)?'selected':''; ?>><?php echo $p['category_name']?></option>
                         <?php } ?>
                     </select>

                     <input type="text" name="nama" placeholder="Nama Produk" class="input-control" value="<?php echo $r->product_name?>" require>
                     <input type="number" name="harga" placeholder="Harga Produk" class="input-control" value="<?php echo $r->product_price?>" require>
                     <img src="produk/<?php echo $r->product_img?>" alt="" width="130px">
                     <input type="hidden" name="foto" value="<?php echo $r->product_img?>">
                     <input type="file" name="img" placeholder="Upload Gambar" >
                     <textarea name="deskripsi" placeholder="Deskripsi Produk" class="input-control"><?php echo $r->product_description?></textarea>
                     <select name="status" id="" class="input-control">
                         <option value="" >--pilih--</option>
                         <option value="1" <?php echo ($r->product_status == 1)? 'selected':'';?>>Aktif</option>
                         <option value="0" <?php echo ($r->product_status == 0)? 'selected':'';?>>tidak aktif </option>
                     </select>
                     <input type="submit" name="submit" value ="edit" class="button">
                 </form>
                <?php
                if(isset($_POST['submit'])){ 
                   
                    //data input from form
                    $kategori=$_POST['kategori'];
                    $nama=$_POST['nama'];
                    $harga=$_POST['harga'];
                    $deskripsi=$_POST['deskripsi'];
                    $status = $_POST['status'];
                    $foto = $_GET['foto'];
                    //data gambar
                    $filename= $_FILES['img']['name'];
                    $tmp_name = $_FILES['img']['tmp_name'];

                    
                    //validation when admin update image
                    if($filename != ""){
                        $type1= explode(".", $filename);
                        $type2=$type1[1];
                        $newname='name'.time().".".$type2;
                        //menampung data format yang di ijinkan
                        $type_diijinkan = array('png','jpeg','gif','jpg','pdf');
                         //validasi format file
                        if(!in_array($type2,$type_diijinkan)){
                        echo "format file salah";
                        }else{
                            unlink('./produk/'.$foto);
                            move_uploaded_file($tmp_name,'./produk/' .$newname);
                            $namagambar=$newname;
                    }
                    }else{
                        $namagambar=$foto;
                    }

                    //query update
                    $update=mysqli_query($conn,"UPDATE tb_product SET 
                    category_id='".$kategori."',
                    product_name='".$nama."',
                    product_price='".$harga."',
                    product_description='".$deskripsi."',
                    product_img='".$namagambar."',
                    product_status='".$status."' WHERE product_id='".$r->product_id."' ");

                    if($update){
                        echo '<script>alert("produk di ubah")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                    }else{
                        echo "gagal tambah produk". mysqli_error($conn);
                    }
                    
                }
                ?>
             </div>
         </div>
     </div>
     <!---footer -->
    <footer>
        <div class="countainer">
            <small>Copyright &copy; 2021 . Yurdiansyah</small>
        </div>
    </footer>
    <script>
                        CKEDITOR.replace( 'deskripsi' );
                </script>
</body>
</html>