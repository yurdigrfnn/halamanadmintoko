<?php
    session_start();
    include "db.php";
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Toko | Kategori</title>
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
             <h3>Produk</h3>
             <div class="box">
                 <p><a href="tambah-produk.php">Tambah Produk</a></p>
                 <table border="1" cellspacing="0" class="table">
                     <thead>
                         <tr>
                             <th width="60px">No</th>
                             <th>Kategori</th>
                             <th>Nama Produk</th>
                             <th>Harga</th>
                             <th>deskripsi</th>
                             <th>gambar</th>
                             <th>Status</th>
                             <th>tanggal di buat</th>
                             <th width="140px">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no=1;
                            $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING(category_id) ORDER BY product_id DESC");
                            if(mysqli_num_rows($produk) > 0){
                            while ($row = mysqli_fetch_array($produk)) {
                            
                            
                         ?>
                         <tr>
                             <td><?php echo $no++?></td>
                             <td><?php echo $row['category_name'] ?></td>
                             <td><?php echo $row['product_name'] ?></td>
                             <td>Rp.<?php echo number_format($row['product_price'])  ?></td>
                             <td><?php echo $row['product_description'] ?></td>
                             <td><img src="produk/<?php echo $row['product_img'] ?>" alt="" width ="60px"></td>
                             
                             <td><?php $row['product_status']; 
                                                if($row['product_status']!=1 ){echo"tidak aktif";}else{echo "aktif";} ?>
                                                
                                            </td><td><?php echo $row['date_created']?></td>
                             <td>
                                 <a href="edit-produk.php?id=<?php echo $row['product_id']?>" class="button_edithapus">edit</a>  <a href="proses-hapus.php?idp=<?php echo $row['product_id']?> " onclick="return confirm('Yakin di hapus?')" class="button_edithapus">hapus</a>
                             </td>
                         </tr>
                         <?php } }else{?> 
                             <tr>
                                <td colspan="7">tidak ada data</td>
                             </tr>
                            
                         <?php }?>
                     </tbody>
                 </table>
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