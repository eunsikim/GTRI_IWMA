<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('./views');

    $twig = new \Twig\Environment($loader);

    $title = 'Users';
    // If the user is not logged in, redirect to login view
    require_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php');

    if(!isLogged()){
        header('Location: login');
    }
    elseif(!isLogged()){
        header('Location: /');
    }

    require_once($_SERVER['DOCUMENT_ROOT']."/mysql/config.php");

    //  Get all users
    function getUsers($conn){
        $sqlriz = "Select * FROM `users`";

        $res = mysqli_query($conn,$sqlriz);

        while($row=mysqli_fetch_object($res))
        {
            $users[]=$row;
        }

        return $users;
    }
    
    $error = null;
    if(isset($_GET['error'])){
        $error = $_GET['error'];
    }

    echo $twig->render('users.html', [
        'title' => 'Home',
        'error' => $error, 
        'userName' => $_SESSION['user'],
        'isLogged' => isLogged(),
        'users' => getUsers($conn)
        ]) 
?>