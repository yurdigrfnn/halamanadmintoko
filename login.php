<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | toko yurdi</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
</head>
<body id="bg_login">
    <div class="box">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="username" class="box1" require>
            <input type="password" name="password" placeholder = "password" class="box1" require>
            <input type="submit" name="submit" value ="login" class="button">
        </form>
        <?php
            if(isset($_POST['submit'])){  
                session_start(); 
                include "db.php";
                $user = mysqli_real_escape_string($conn, $_POST['user']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);
                
                $cek = mysqli_query($conn, "SELECT * FROM TB_ADMIN WHERE username = '".$user."' and password = '".MD5($password)."' ");
               if(mysqli_num_rows($cek) == 1){
                   $ds=mysqli_fetch_object($cek);
                   $_SESSION['status_login'] = true;
                   $_SESSION['admin_global'] = $ds;
                   $_SESSION['id']= $ds->admin_id;
                   echo '<script>window.location="dashboard.php"</script>';
               }else{
                    echo '<script>alert("username/password salah");</script>';
               }
            }
        ?>
    </div>
</body>
</html>