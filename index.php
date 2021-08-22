<?php
session_start();
include_once './config/connection.php';

  if(isset($_POST["signin"])) {
    if(empty($_POST["login"]) || empty($_POST["password"])) {
        $msg = 'All fields are required !';	
    }
    else {        
        $query = 'SELECT * FROM `user` WHERE `login`="'.$_POST['login'].'" AND `password`="'.$_POST['password'].'"';
        $query = $db->prepare($query);
        $query->execute();
        $count = $query->rowCount();
        $la_case = $query->fetchAll(\PDO::FETCH_ASSOC);

        if ($count > 0) {
					if ($la_case[0]['active'] == 0) {
            $_SESSION['id_user']=$la_case[0]['id_user'];
            $_SESSION['login']=$la_case[0]['login'];
            $_SESSION['fname']=$la_case[0]['fname'];
            $_SESSION['lname']=$la_case[0]['lname'];
            $_SESSION['role']=$la_case[0]['role'];
						header("location:app/dashboard.php");

					}
				} else {
          $msg = 'Incorrect Login or Password !';
      }
    }
	}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>GSB</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/offcanvas-navbar/">

    

    <!-- Bootstrap core CSS -->
<!-- <link href="./assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="./assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="./assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="./assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="./assets/img/favicons/manifest.json">
<link rel="mask-icon" href="./assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="./assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./assets/css/offcanvas.css" rel="stylesheet">
  </head>
  <body class="bg-light">

<?php include_once("./includes/navbar_off.php"); ?>
<?php include_once("./includes/nav_scroller_off.php"); ?>

<main class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <img class="me-3" src="./assets/brand/bootstrap-logo-white.svg" alt="" width="48" height="38">
    <div class="lh-1">
      <h1 class="h6 mb-0 text-white lh-1">GSB App</h1>
      <small>Since 1980</small>
    </div>
  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-10">Sign In</h6>
    <form method="POST" action="index.php" >
      <div class="row">
        <div class="p-2 col-md-6">
          <input type="text" name="login" class="form-control" placeholder="First name" aria-label="First name">
        </div>
        <div class="p-2 col-md-6">
          <input type="text" name="password" class="form-control" placeholder="Last name" aria-label="Last name">
        </div>
      </div>
      <button type="submit" name="signin" class="btn btn-primary">Submit</button>
    </form>
  </div>
</main>
<?php include_once("./includes/footer.php"); ?>
