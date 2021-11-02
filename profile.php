<?php
    session_start();
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    include "db.php";
    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
    $ds = mysqli_fetch_object($query);
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
             <h3>Ubah Profil <?php echo $ds->admin_name ?></h3>
             <div class="box">
                 <form action="" method="POST">
                     <input type="text" name="nama" placeholder="nama lengkap" class="input-control" value="<?php echo $ds->admin_name ?>" required>
                     <input type="text" name="username" placeholder="Username" class="input-control" value="<?php echo $ds->username ?>" required>
                     <input type="text" name="hp" placeholder="No hp" class="input-control" value="<?php echo $ds->admin_tlp ?>" required>
                     <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $ds->admin_email ?>" required>
                     <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $ds->admin_address ?>" required>
                     <input type="submit" name="submit" value ="Ubah Profil" class="button">
                 </form>
                 <?php
                 if(isset($_POST['submit'])){
                     $nama = $_POST['nama'];
                     $user = $_POST['username'];
                     $hp = $_POST['hp'];
                     $email = $_POST['email'];
                     $alam = $_POST['alamat'];

                     $update = mysqli_query($conn, "UPDATE tb_admin SET 
                                            admin_name = '".$nama."',
                                            username = '".$user."',
                                            admin_tlp = '".$hp."',
                                            admin_email = '".$email."',
                                            admin_address = '".$alam."' 
                                            WHERE admin_id='".$ds->admin_id."'");
                        if($update){
                            echo '<script>alert("data berhasil di ubah")</script>';
                            echo '<script>window.location="profile.php"</script>';
                        }else{
                            echo "gagal" . mysqli_error($conn);
                        }
                 }
                 ?>
             </div>
             <h3>Ubah password <?php echo $ds->admin_name ?></h3>
             <div class="box">
                 <form action="" method="POST">
                     <input type="password" name="password1" placeholder="Ubah Password" class="input-control"  required>
                     <input type="password" name="password2" placeholder="konfirmasi Ubah Password" class="input-control"  required>
                     <input type="submit" name="ubahpassword" value ="Ubah  Password" class="button">
                 </form>
                 <?php
                 if(isset($_POST['ubahpassword'])){
                     $password1 = $_POST['password1'];
                     $password2 = $_POST['password2'];

                     if($password2 != $password1){
                         echo '<script>alert("password tidak sesuai")</script>';
                     }else{
                         $ubah_password = mysqli_query($conn, "UPDATE tb_admin SET 
                         password = '".MD5($password1)."' 
                         WHERE admin_id='".$ds->admin_id."'");

                         if($ubah_password){
                             echo '<script>alert("data berhasil di ubah")</script>';
                            echo '<script>window.location="profile.php"</script>';
                         }else{
                            echo "gagal" . mysqli_error($conn);
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
</body>
</html>