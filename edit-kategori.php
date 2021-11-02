<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    include "db.php";
    $kategori = mysqli_query($conn,"SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) != 1){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $ktgr= mysqli_fetch_object($kategori);
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
             <h3>edit data kategori</h3>
             <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="nama kategori" class="input-control" value="<?php echo $ktgr->category_name?>" required>
                     <input type="submit" name="submit" value ="edit" class="button">
                 </form>
                <?php
                if(isset($_POST['submit'])){
                    $nama= ucwords($_POST['nama']);
                    $update = mysqli_query($conn, "UPDATE tb_category SET category_name = '".$nama."' WHERE category_id ='".$ktgr->category_id."'");

                    if($update){
                        echo '<script>alert("data telah di ubah")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo "gagal ubah data". mysqli_error($conn);
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
</body>
</html>