<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Penguji 1 dan 2</title>

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

$sqlM = "SELECT * FROM mahasiswa";
$resultM = mysqli_query($link, $sqlM);

$sqlM2 = "SELECT * FROM mahasiswa";
$resultM2= mysqli_query($link, $sqlM2);

$sqlNrp = "SELECT * FROM mahasiswa WHERE penguji1='' OR penguji2=''";
$resultNrp = mysqli_query($link, $sqlNrp);

$sqlD = "SELECT * FROM dosen";
$resultD = mysqli_query($link, $sqlD);
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
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <strong>Penguji Sidang</strong>
                                    </div>
                                    <div class="panel-body">
                            <form action="proses.php?cmd=insertPenguji" method="POST" class="form-horizontal">
                             <div class="form-group">
                                <label class="col-sm-2 control-label">NRP:</label>
                                <div class="col-sm-10">
                                    <select name="nrp" id="nrp" class="form-control">
                                        <?php
                                        while($rowNrp = mysqli_fetch_object($resultNrp)) {
                                            $Nrp[]=$rowNrp;
                                            echo "<option value='" . $rowNrp->nrp . "'>" . $rowNrp->nrp . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div></br></br>
                                <label class="col-sm-2 control-label">Tanggal:</label>
                                <div class="col-sm-10">
                                  <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                                </div></br></br>
                                <label class="col-sm-2 control-label">Jam:</label>
                                <div class="col-sm-10">
                                    <select name="jam" id="jam" class="form-control">
                                        <option>07.00-08.30</option>
                                        <option>08.30-10.00</option>
                                        <option>10.00-11.30</option>
                                        <option>11.30-13.00</option>
                                        <option>13.00-14.30</option>
                                        <option>14.30-16.00</option>
                                        <option>16.00-17.30</option>
                                    </select>
                                </div></br></br>
                                <label class="col-sm-2 control-label">NPK1:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="npk1" id="npk1" placeholder="NPK Dosen Penguji 1" required>
                                </div></br></br>
                                <label class="col-sm-2 control-label">NPK2:</label>
                                <div class="col-sm-10">
                                  <input type="text" class="form-control" name="npk2" id="npk2" placeholder="NPK Dosen Penguji 2" required>
                                </div>
                              </div>
                            <div class="col-sm-9"></div>
                            <input class="btn btn-primary" type="submit" value="Simpan">
                            </form>
                            </div>
                        </div>
                    </div>

                    <?php 
                    ?>

                    <div class="col-lg-12">
                        <legend>Dosen:</legend>
                        <table class="table table-bordered">
                            <tr class="info">
                                <th><center>No</th>
                                <th><center>Tanggal</th>
                                <th><center>Jam Kosong</th>
                                <th><center>NPK</th>
                                <th><center>Nama</th>
                                <th><center>Total Menguji</th>
                                <th><center>Status</th>
                            </tr>
                            <?php
                            $hitung = 1;
                            while ($rowD = mysqli_fetch_object($resultD)) {
                                $sqlJadwal = "SELECT * from jadwal_kegiatan_dosen WHERE npk=".$rowD->npk;
                                $resultJadwal = mysqli_query($link, $sqlJadwal);
                                if(!$resultJadwal) {
                                    echo "SQL ERROR: ".$sqlJadwal;
                                }
                                while ($rowJadwal = mysqli_fetch_object($resultJadwal)) {
                                    echo "<tr>";
                                    echo "<td><center>" . $hitung. "</td>";
                                    echo "<td><center>" . $rowJadwal->tgl . "</td>";
                                    echo "<td><center>" . $rowJadwal->jam . "</td>";
                                    echo "<td><center>" . $rowD->npk . "</td>";
                                    echo "<td><center>" . $rowD->nama . "</td>";

                                    $sqlHitung1 = "SELECT COUNT(m.penguji1) as hitung1 FROM Mahasiswa m 
                                    INNER JOIN dosen d ON m.penguji1='".$rowD->npk."'";
                                    $resultHitung1 = mysqli_query($link, $sqlHitung1);
                                    if(!$resultHitung1) {
                                        echo "SQL ERROR: ".$sqlHitung1;
                                    }
                                    $sqlHitung2 = "SELECT COUNT(m.penguji2) as hitung2 FROM Mahasiswa m 
                                    INNER JOIN dosen d ON m.penguji2='".$rowD->npk."'";
                                    $resultHitung2 = mysqli_query($link, $sqlHitung2);
                                    if(!$resultHitung2) {
                                        echo "SQL ERROR: ".$sqlHitung2;
                                    }
                                    while($rowH = mysqli_fetch_object($resultHitung1)){
                                        $tampungan1 = $rowH->hitung1/11;
                                    }
                                    while($rowH2 = mysqli_fetch_object($resultHitung2)){
                                        $tampungan2 = $rowH2->hitung2/11;
                                    }
                                    $hasil = $tampungan1+$tampungan2;
                                    echo "<td><center>".$hasil."</td>";

                                    if($rowJadwal->status==1){
                                        $bookingDosen = "BOOKED";
                                    }
                                    else if($rowJadwal->status==0){
                                        $bookingDosen = "FREE";
                                    }
                                    else{
                                        $bookingDosen = "> 1 MHS";
                                    }
                                    echo "<td><center>".$bookingDosen."</td>";
                                    echo "<tr>";
                                    $hitung = $hitung +1;
                                }
                            } ?>
                        </table>
                    </div>

                    <div class="col-lg-12">
                        <legend>Mahasiswa:</legend>
                        <table class="table table-bordered">
                            <tr class="info">
                                <th><center>No</th>
                                <th><center>NRP</th>
                                <th><center>Nama</th>
                                <th><center>Judul TA</th>
                                <th><center>Pembimbing 1</th>
                                <th><center>Pembimbing 2</th>
                                <th><center>Penguji 1</th>
                                <th><center>Penguji 2</th>
                                <th><center>Hapus</th>
                            </tr>
                            <?php
                            $hitung = 1;
                            while ($rowM = mysqli_fetch_object($resultM)) {
                                echo "<tr>";
                                echo "<td>" . $hitung. "</td>";
                                echo "<td>" . $rowM->nrp . "</td>";
                                echo "<td>" . $rowM->nama . "</td>";
                                echo "<td>" . $rowM->judul_ta . "</td>";

                                $sqlDosen = "SELECT nama  from dosen WHERE dosen.npk=(SELECT npk1 FROM `mahasiswa` WHERE nrp= ".$rowM->nrp.")";
                                $resultDosen = mysqli_query($link, $sqlDosen);
                                if(!$resultDosen) {
                                    echo "SQL ERROR: ".$sqlDosen;
                                }
                                while ($row1 = mysqli_fetch_object($resultDosen)) {
                                    echo "<td>" . $row1->nama . "</td>";
                                }

                                $sqlDosen2 = "SELECT nama  from dosen WHERE dosen.npk=(SELECT npk2 FROM `mahasiswa` WHERE nrp= ".$rowM->nrp.")";
                                $resultDosen2 = mysqli_query($link, $sqlDosen2);
                                if(!$resultDosen2) {
                                    echo "SQL ERROR: ".$sqlDosen2;
                                }
                                while ($row2 = mysqli_fetch_object($resultDosen2)) {
                                    echo "<td>" . $row2->nama . "</td>";
                                }

                                $sqlPenguji = "select dosen.nama as nama from mahasiswa, dosen WHERE dosen.npk=mahasiswa.penguji1 and mahasiswa.nama='".$rowM->nama."'";
                                $resultPenguji = mysqli_query($link, $sqlPenguji);
                                if(!$resultPenguji){
                                    echo "SQL ERROR: ".$sqlPenguji;
                                }
                                $sqlPenguji2 = "select dosen.nama as nama from mahasiswa, dosen WHERE dosen.npk=mahasiswa.penguji2 and mahasiswa.nama='".$rowM->nama."'";
                                $resultPenguji2 = mysqli_query($link, $sqlPenguji2);
                                if(!$resultPenguji2){
                                    echo "SQL ERROR: ".$sqlPenguji2;
                                }
                                if($rowM->penguji1 ==""){
                                    echo"<td><center>-</td>";
                                }
                                while($rowP = mysqli_fetch_object($resultPenguji)){
                                    echo "<td>" . $rowP->nama . "</td>";                                
                                }
                                
                                while($rowP = mysqli_fetch_object($resultPenguji2)){
                                    echo "<td>" . $rowP->nama . "</td>";
                                }

                                if($rowM->penguji2 ==""){
                                    echo"<td><center>-</td>";
                                }
                                echo "<td>";
                                echo "<center><a href='proses.php?cmd=hapusPenguji&i=" . $rowM->nrp . "&uji1=".$rowM->penguji1."&uji2=".$rowM->penguji2."'><img src='./img/hapus.png' width='20px'></a>";
                                echo "</td>";
                                echo "<tr>";
                                $hitung = $hitung +1;
                            } ?>
                        </table>
                    </div>
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
