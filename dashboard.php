<?php
    session_start();
    $checkbox1 = "";

    if(!isset($_COOKIE['cookie_username'])){
        $_COOKIE['cookie_username'] = 'Tidak ada';
        $_COOKIE['cookie_password'] = 'Tidak ada';
    }

    if(!isset($_SESSION['session_username'])){
        header("location:login.php");
    }

    if(isset($_POST['checkbox1'])){
        $checkbox1   = $_POST['checkbox1'];
    }

    if(isset($_POST['logout'])){
        if($checkbox1 == 1){
            $_SESSION['session_username'] = "";
            $_SESSION['session_password'] = "";
            session_destroy();

            $cookie_name = "cookie_username";
            $cookie_value = "";
            $time = time() - (60 * 60);
            setcookie($cookie_name,$cookie_value,$time,"/");

            $cookie_name = "cookie_password";
            $cookie_value = "";
            $time = time() - (60 * 60);
            setcookie($cookie_name,$cookie_value,$time,"/");
        }

        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <title>Dashboard</title>
    </head>

    <body>
        <div style="margin:5%">
            <p><b>Session tersimpan</b></p>
                <div style="display:flex;">
                    <p>Username  : </p><?php print_r($_SESSION['session_username']);?>
                </div>
                <div style="display:flex;">
                    <p>Password  : </p><?php print_r($_SESSION['session_password']);?>
                </div>
            <p><b>Cookie tersimpan</b></p>
                <div style="display:flex;">
                    <p>Username  : </p><?php print_r($_COOKIE['cookie_username']);?>
                </div>
                <div style="display:flex;">
                    <p>Password : </p><?php print_r($_COOKIE['cookie_password']);?>
                </div>
        </div>
    </body>
</html>