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
             <h3>Tambah data</h3>
             <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="nama kategori" class="input-control"  required>
                     <input type="submit" name="submit" value ="Tambah" class="button">
                 </form>
                <?php
                if(isset($_POST['submit'])){
                    $nama= ucwords($_POST['nama']);
                    $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (
                        null,
                        '".$nama."')");

                    if($insert){
                        echo '<script>alert("data ditambahkan")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo "gagal tambah data". mysqli_error($conn);
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