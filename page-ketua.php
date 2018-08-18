<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ketua dan Sekretaris</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

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

if(!isset($_COOKIE['loginK'])) {
    header('location: index.php');
}

$sqlK = "SELECT * FROM kalab WHERE nama='".$_COOKIE['nomerK']."'";
$resultK = mysqli_query($link, $sqlK);
$rowK = mysqli_fetch_array($resultK);

$sqlM = "SELECT * FROM mahasiswa WHERE ketua ='' OR sekretaris =''";
$resultM = mysqli_query($link, $sqlM);

$sqlD = "SELECT * FROM dosen";
$resultD = mysqli_query($link, $sqlD);

$sqlPd = "SELECT * FROM periode";
$resultPd = mysqli_query($link, $sqlPd);

$sqlPP = "SELECT * FROM mahasiswa WHERE penguji1!='' AND penguji2 !=''";
$resultPP = mysqli_query($link, $sqlPP);

?>

<body>

    <div class="brand">
        <img class="img-center" src="./img/logos.png" width="100" height="100">
        ALFA - Sistem Penjadwalan TA
        <img class="img-center" src="./img/logo.png" width="100" height="100">
    </div>
    <div class="address-bar">Kalab - Universitas Surabaya</div>

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
                        <a href="./page-penguji.php">Penguji</a>
                    </li>
                    <li>
                        <a href="./page-ketua.php">Ketua & Sekre</a>
                    </li>
                    <li>
                        <a href="./proses.php?cmd=logoutK">Logout, <?php echo $rowK['nama']; ?> </a>
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
                    <form class="form-signin" action="proses.php?cmd=insertKetSek" method="POST">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <strong>Ketua dan Sekretaris Sidang</strong>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Mahasiswa:</label>
                                                <div class="col-sm-10">
                                                    <select name="mahasiswa" id="mahasiswa" class="form-control">
                                                        <?php
                                                        while($rowM = mysqli_fetch_object($resultM)) {
                                                            $mahasiswa[]=$rowM;
                                                            echo "<option value=".$rowM->nrp.">" . $rowM->nama . "</option>"; 
                                                        }?>
                                                    </select>
                                                </div>
                                                </br></br></br>
                                                <label class="col-sm-3 control-label">Ketua:</label>
                                                <div class="col-sm-10">
                                                    <select name="ketua" id="ketua" class="form-control">
                                                        <?php
                                                        while($rowD = mysqli_fetch_object($resultD)) {
                                                            $dosen[]=$rowD;
                                                            echo "<option value=" . $rowD->npk . ">" . $rowD->nama . "</option>"; 
                                                        }?>
                                                    </select>
                                                </div>
                                                </br></br></br>
                                                <label class="col-sm-3 control-label">Sekretaris:</label>
                                                <div class="col-sm-10">
                                                    <select name="seker" id="seker" class="form-control">
                                                        <?php
                                                        foreach($dosen as $rowDosen) { //BUAT RESET mysqli_fetch_object()
                                                            echo "<option value='" . $rowDosen->npk . "'>" . $rowDosen->nama . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                </br></br>
                                            </div>
                                        </form>
                                        </br></br>&nbsp&nbsp&nbsp
                                        <div class="col-sm-8"></div>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <legend>Mahasiswa:</legend>
                                <table class="table table-bordered">
                                    <tr class="info">
                                        <th><center>No</th>
                                        <th><center>Nama</th>
                                        <th><center>Pembimbing 1</th>
                                        <th><center>Pembimbing 2</th>
                                        <th><center>Penguji 1</th>
                                        <th><center>Penguji 2</th>
                                        <th><center>Ketua</th>
                                        <th><center>Sekretaris</th>
                                        <th><center>Hapus</th>
                                    </tr>
                                    <?php
                                    $hitung = 1;
                                    while ($rowM = mysqli_fetch_object($resultPP)) {
                                        echo "<tr>";
                                        echo "<td><center>" . $hitung. "</td>";
                                        echo "<td>" . $rowM->nama . "</td>";

                                        $sqlDos1 = "SELECT * FROM dosen WHERE npk='".$rowM->npk1."'";
                                        $resultDos1 = mysqli_query($link, $sqlDos1);
                                        //Pembimbing
                                        while($rowDos1=mysqli_fetch_object($resultDos1)){
                                            echo "<td>".$rowDos1->nama."</td>";
                                        }
                                        $sqlDos2 = "SELECT * FROM dosen WHERE npk='".$rowM->npk2."'";
                                        $resultDos2 = mysqli_query($link, $sqlDos2);
                                        while($rowDos2=mysqli_fetch_object($resultDos2)){
                                            echo "<td>".$rowDos2->nama."</td>";
                                        }
                                        //Penguji
                                        $sqlDos3 = "SELECT * FROM dosen WHERE npk='".$rowM->penguji1."'";
                                        $resultDos3 = mysqli_query($link, $sqlDos3);
                                        while($rowDos3=mysqli_fetch_object($resultDos3)){
                                            echo "<td>".$rowDos3->nama."</td>";
                                        }
                                        $sqlDos4 = "SELECT * FROM dosen WHERE npk='".$rowM->penguji2."'";
                                        $resultDos4 = mysqli_query($link, $sqlDos4);
                                        while($rowDos4=mysqli_fetch_object($resultDos4)){
                                            echo "<td>".$rowDos4->nama."</td>";
                                        }
                                        //Ket Sek
                                        $sqlDos5 = "SELECT * FROM dosen WHERE npk='".$rowM->ketua."'";
                                        $resultDos5 = mysqli_query($link, $sqlDos5);
                                        while($rowDos5=mysqli_fetch_object($resultDos5)){
                                            echo "<td>".$rowDos5->nama."</td>";
                                        }
                                        $sqlDos6 = "SELECT * FROM dosen WHERE npk='".$rowM->sekretaris."'";
                                        $resultDos6 = mysqli_query($link, $sqlDos6);
                                        while($rowDos6=mysqli_fetch_object($resultDos6)){
                                            echo "<td>".$rowDos6->nama."</td>";
                                        }
                                        if($rowM->ketua==""){
                                            echo"<td><center>-</td>";
                                        }
                                        if($rowM->sekretaris==""){
                                            echo"<td><center>-</td>";
                                        }
                                        //Hapus
                                        echo "<td>";
                                        echo "<center><a href='proses.php?cmd=hapusKetua&i=" . $rowM->nrp . "'><img src='./img/hapus.png' width='20px'></a>";
                                        echo "</td>";
                                        $hitung = $hitung +1;
                                    } ?>
                                </table>
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
