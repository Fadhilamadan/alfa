<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Penjadwalan Tugas Akhir</title>

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

<!-- SQL DATABASE -->
<?php
session_start();
require './db.php';

$sqlNpk1 = "SELECT * FROM dosen";
$resultNpk1 = mysqli_query($link, $sqlNpk1);

$sqlNpk2 = "SELECT * FROM dosen";
$resultNpk2 = mysqli_query($link, $sqlNpk2);
?>
<!-- SQL DATABASE -->

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
                        <a href="./login.php">Login</a>
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
                <div class="col-lg-12">
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
                    <form class="form-signin" action="proses.php?cmd=inputM" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <legend>Data Mahasiswa:</legend>
                                <form class="form-inline">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label">NRP:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="nrp" placeholder="NRP" required>
                                    </div></br></br>
                                    <label class="col-sm-2 control-label">Nama:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                    </div></br></br>
                                    <label class="col-sm-2 control-label">Ponsel:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="ponsel" placeholder="08977348xxx" required>
                                    </div></br></br>
                                    <label class="col-sm-2 control-label">Judul:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" name="judul" placeholder="Judul Tugas Akhir" required>
                                    </div></br></br>
                                    <label class="col-sm-2 control-label">Pemb. 1:</label>
                                    <div class="col-sm-10">
                                      <select name="npk1" id="npk1" class="form-control">
                                        <?php
                                        while($rowNpk1 = mysqli_fetch_object($resultNpk1)) {
                                            $Npk1[]=$rowNpk1;
                                            echo "<option value='" . $rowNpk1->npk . "'>" . $rowNpk1->nama . "</option>";
                                        }
                                        ?>
                                    </select>
                                    </div></br></br>
                                    <label class="col-sm-2 control-label">Pemb. 2:</label>
                                    <div class="col-sm-10">
                                      <select name="npk2" id="npk2" class="form-control">
                                        <?php
                                        while($rowNpk2 = mysqli_fetch_object($resultNpk2)) {
                                            $Npk2[]=$rowNpk2;
                                            echo "<option value='" . $rowNpk2->npk . "'>" . $rowNpk2->nama . "</option>";
                                        }
                                        ?>
                                    </select>
                                    </div>
                                  </div>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <legend>Prasyarat:</legend>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="1" checked>1. Buku TA Sebanyak 4 Eksemplar</label>
                                </div>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="2" checked>2. Proposal TA Berserata form TA 4 Eksemplar</label>
                                </div>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="3" checked>3. Karya Tulis TA Sebanyak 4 Eksemplar</label>
                                </div>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="4" checked>4. Fotokopi Kartu Studi</label>
                                </div>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="5" checked>5. Fotokopi Bimbingan TA</label>
                                </div>
                                <div class="checkbox">
                                  <label>&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" name="pers[]" value="6" checked>6. Fotokopi Sertifikat LSTA</label>
                                </div>
                            </div>
                            <div class="col-md-5"></div><input class="btn btn-primary" type="submit" value="Simpan">
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