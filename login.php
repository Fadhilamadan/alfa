<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Sistem Penjadwalan Tugas Akhir</title>

    <!-- Bootstrap Core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php
session_start();
require './db.php';

if(isset($_COOKIE['login'])) {
    header('location: master-mahasiswa.php');
}
?>

<body>

    <div class="brand">
        <img class="img-center" src="./img/logos.png" width="100" height="100">
        ALFA - Sistem Penjadwalan TA
        <img class="img-center" src="./img/logo.png" width="100" height="100">
    </div>
    <div class="address-bar">Universitas Surabaya</div>

    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Sistem Penjadwalan Tugas Akhir</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="./index.php">Home</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12 text-center">
                    <?php
                    if(!isset($_SESSION['notif'])) {
                        echo "";
                    }
                    else { ?>
                        <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                        echo $_SESSION['notif']."</br>";
                        unset($_SESSION['notif']); ?>
                        </div>
                        <?php
                    }
                    if(!isset($_SESSION['notifSQL'])) {
                        echo "";
                    }
                    else { ?>
                        <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php
                        echo $_SESSION['notifSQL']."</br>";
                        unset($_SESSION['notifSQL']); ?>
                        </div>
                        <?php
                    } ?>
                    <form class="form-signin" action="proses.php?cmd=login" method="POST">
                        <img src="./img/staff.png" class="center"><br/>
                        <h2 class="form-signin-heading text-center">LOGIN</h2>
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-md-4">
                                <label for="inputNRP" class="sr-only">Username</label>
                                <input type="text" name="ID" class="form-control" placeholder="Username" required autofocus></br>
                                <label for="inputPassword" class="sr-only">Password</label>
                                <input type="password" name="pswd" class="form-control" placeholder="Password" required></br>
                                <select name="jabatan" class="form-control" id="jabatan" required="*">
                                    <option value='admin'>Admin</option>
                                    <option value='dosen'>Dosen</option>
                                    <option value='kalab'>Kalab</option>
                                </select></br>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">LOGIN</button>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="pull-right">Faishal Hendaryawan | Fadhil Amadan | Lucas Leonard | Putu Aditya</p>
                    <p class="pull-left">&copy; 2016 | Desain dan Implementasi Sistem</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>