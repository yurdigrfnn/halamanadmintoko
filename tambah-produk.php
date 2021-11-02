<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Toko | Profil</title>
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
             <h3>Tambah produk</h3>
             <div class="box">
                 <form action="" method="POST" enctype="multipart/form-data">
                     <select name="kategori" class="input-control" require>
                         <option value="">---pilih---</option>
                         <?php
                            $kategori= mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($p =mysqli_fetch_array($kategori)) {
                            
                         ?>
                         <option value="<?php echo $p['category_id']?>"><?php echo $p['category_name']?></option>
                         <?php } ?>
                     </select>

                     <input type="text" name="nama" placeholder="Nama Produk" class="input-control" require>
                     <input type="number" name="harga" placeholder="Harga Produk" class="input-control" require>
                     <input type="file" name="img" placeholder="Upload Gambar"  require>
                     <textarea name="deskripsi" placeholder="Deskripsi Produk" class="input-control"></textarea>
                     <select name="status" id="" class="input-control">
                         <option value="">--pilih--</option>
                         <option value="1">Aktif</option>
                         <option value="0">tidak aktif </option>
                     </select>
                     <input type="submit" name="submit" value ="Tambah" class="button">
                 </form>
                <?php
                if(isset($_POST['submit'])){
                   //print_r($_FILES['img']);
                    // menampung input data dari from
                    $kategori=$_POST['kategori'];
                    $nama=$_POST['nama'];
                    $harga=$_POST['harga'];
                    $deskripsi=$_POST['deskripsi'];
                    $status = $_POST['status'];

                    //menampung data file yang di upload
                    $filename= $_FILES['img']['name'];
                    $tmp_name = $_FILES['img']['tmp_name'];

                    $type1= explode(".", $filename);
                    $type2=$type1[1];
                    $newname='name'.time().".".$type2;
                    

                    //menampung data format yang di ijinkan
                    $type_diijinkan = array('png','jpeg','gif','jpg','pdf');

                    //validasi format file
                    if(!in_array($type2,$type_diijinkan)){
                        echo "format file salah";
                    }else{
                        move_uploaded_file($tmp_name,'./produk/' .$newname);
                        $insert=mysqli_query($conn, "INSERT INTO tb_product VALUES(
                                    null,
                                    '".$kategori."',
                                    '".$nama."',
                                    '".$harga."',
                                    '".$deskripsi."',
                                    '".$newname."',
                                    '".$status."',
                                    null
                                    
                        )");
                        if($insert){
                            echo '<script>alert("produk ditambahkan")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo "gagal tambah produk". mysqli_error($conn);
                        }
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