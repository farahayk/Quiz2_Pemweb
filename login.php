<?php
    session_start();

    $host_db = "localhost";
    $user_db = "root";
    $pass_db = "";
    $nama_db = "login";
    $koneksi = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);

    $username = "";
    $password = "";
    $checkbox = "";
    $error = False;
    $usname = $username;
    $psword = $password;

    if(isset($_COOKIE['cookie_username'])){
        $cookie_username = $_COOKIE['cookie_username'];
        $cookie_password = $_COOKIE['cookie_password'];
        $usname = $cookie_username;
        $psword = $cookie_password;

        $sql = "select * from login where username = '$cookie_username'";
        $query = mysqli_query($koneksi,$sql);
        $data = mysqli_fetch_array($query);
        if($data['password'] == $cookie_password){
            $_SESSION['session_username'] = $cookie_username;
            $_SESSION['session_password'] = $cookie_password;
        }
    }

    if(isset($_SESSION['session_username'])){
        if(isset($_POST['login'])){
            header("location:dashboard.php");
        }
    }

    if(isset($_POST['login'])){
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        if(isset($_POST['checkbox'])){
            $checkbox   = $_POST['checkbox'];
        }

        if($username == '' or $password == ''){
            echo "<script>alert('Silakan masukkan username dan password anda terlebih dahulu!');</script>";
            $error = True;
        }else{
            $sql = "select * from 'login' where username = '$username'";
            $query = mysqli_query($koneksi,$sql);
            $data   = mysqli_fetch_array($query);

            if($data['username'] != $username){
                echo "<script>alert('Username yang anda masukkan tidak tersedia!');</script>";
                $error = True;
            }elseif($data['password'] != md5($password)){
                echo "<script>alert('Password yang anda masukkan tidak sesuai!');</script>";
                $error = True;
            }
            if($error == False){
                $_SESSION['session_username'] = $username;
                $_SESSION['session_password'] = $password;

                if($checkbox == 1){
                    $cookie_name = "cookie_username";
                    $cookie_value = $username;
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                    $cookie_name = "cookie_password";
                    $cookie_value = $password;
                    $cookie_time = time() + (60 * 60 * 24 * 30);
                    setcookie($cookie_name,$cookie_value,$cookie_time,"/");
                }
                header("location:dashboard.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Java Guide</title>
    <link rel="stylesheet" type="text/css" href="Login.css">
</head>
<body>
<div> 
    <div class="background"> </div>
    <div class="box">
        <div class="register">
            <h2>Register</h2>
            <h1>JAVA GUIDE</h1>
            <form action="" method="POST">
                <input type="text" name="username" <?php echo $usname;?> placeholder="Username/email"> <br>
                <input type="password" name="password" <?php echo $psword;?> placeholder="Password"> <br>
                <input type="checkbox" name="checkbox" value="1" <?php>
                <label for="remember"> Remember me</label><br>
                <a href="#"> Lost your password?</a>
                <button type="submit" name="login">Login</button>
            </form>      
        </div>
        <div class="login"> Login </div>
    </div>   
</div>
</body>
</html>
