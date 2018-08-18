<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jadwal Kegiatan Tugas Akhir</title>

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

if(!isset($_COOKIE['loginD'])) { // YG BENER loginD
    header('location: index.php');
}

$sqlD = "SELECT * FROM dosen WHERE nama ='".$_COOKIE['nomerD']."'";
$resultD = mysqli_query($link, $sqlD);
$rowD= mysqli_fetch_array($resultD);

$sqlD2 = "SELECT * FROM dosen WHERE nama ='".$_COOKIE['nomerD']."'";
$resultD2 = mysqli_query($link, $sqlD2);

$sqlP = "SELECT * FROM periode WHERE status ='1'";
$resultP = mysqli_query($link, $sqlP);
$rowP= mysqli_fetch_array($resultP);
?>

<body>

    <div class="brand">
        <img class="img-center" src="./img/logos.png" width="100" height="100">
        ALFA - Sistem Penjadwalan TA
        <img class="img-center" src="./img/logo.png" width="100" height="100">
    </div>
    <div class="address-bar">Dosen - Universitas Surabaya</div>

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
                        <a href="./jadwal-kegiatan.php">Jadwal Kegiatan</a>
                    </li>
                    <li>
                        <a href="./jadwal-sidang.php">Jadwal Sidang</a>
                    </li>
                    <li>
                        <a href="./proses.php?cmd=logoutD">Logout, <?php echo $rowD['nama']; ?> </a>
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>BIODATA DOSEN</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-xs-6 col-lg-2">
                                <img src="./img/default.jpg" width='156px' height='209px'>
                            </div>
                            <div class="col-xs-6 col-lg-3">
                                <strong>
                                NPK : <?php echo $rowD['npk']; ?><br>
                                Nama : <?php echo $rowD['nama']; ?><br>
                                </strong>
                            </div>
                            <div class="col-xs-6 col-lg-7">
                                <div class="alert alert-success">
                                    <h3 class="text-center"><br/><br/><strong>PERIODE: <?php echo $rowP['nama']; ?> </strong><br/><br/><br/></h3>
                                </div>
                            </div>
                        </div>
                    </div>

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
                    
                    <legend>Jadwal Anda Sekarang:</legend>
                    <table class="table table-bordered">
                        <tr class="info">
                            <th><center>No</th>
                            <th><center>Tanggal</th>
                            <th><center>Jam</th>
                            <th><center>Hapus</th>
                        </tr>
                        <?php
                        $hitung = 1;
                        while ($rowD2 = mysqli_fetch_object($resultD2)) {
                            $sqlJ = "SELECT * from jadwal_kegiatan_dosen WHERE npk='".$rowD2->npk."' ORDER BY tgl";
                            $resultJ = mysqli_query($link, $sqlJ);
                            if(!$resultJ) {
                                echo "SQL ERROR: ".$sqlJ;
                            }
                            while ($rowJ = mysqli_fetch_object($resultJ)) {
                                echo "<tr>";
                                echo "<td><center>" . $hitung. "</td>";
                                echo "<td><center>" . $rowJ->tgl . "</td>";
                                echo "<td><center>" . $rowJ->jam . "</td>";
                                echo "<td><center><a href='proses.php?cmd=hapusJadwalDosen&jam1=" . $rowJ->jam . "&tgl1=".$rowJ->tgl."&npk1=".$rowJ->npk."'><img src='./img/hapus.png' width='20px'></a></td>";
                                echo "<tr>";
                                $hitung = $hitung +1;
                            }
                        } ?>
                    </table> 

                    <legend>Jadwal Kosong Dosen</legend>
                    <form class="form-signin" action="proses.php?cmd=jamDosen" method="POST">
                        <table class="table table-hover table-bordered">
                          <tr class="info">
                            <th><center>Hari</th>
                            <th>
                                <center><?php $tampung = 1;
                                $a = date("l", strtotime($rowP['buka'])); 
                                $a2 = date("l", strtotime($rowP['buka'])); 
                                if($a!= "Sunday"){
                                    echo $a; }
                                else{
                                    $a = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $a;}
                                $tampung++;
                                ?>
                            </th>
                            <th>
                                <center><?php $b = date("l", strtotime("+1 day", strtotime($rowP['buka']))); 
                                $b2 = date("l", strtotime("+1 day", strtotime($rowP['buka']))); 
                                if($b!="Sunday"&&$b!=$a){
                                    echo $b;}
                                else{
                                    $b = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $b;}
                                $tampung++;?>
                            </th>
                            <th>
                                <center><?php $c = date("l", strtotime("+2 day", strtotime($rowP['buka']))); 
                                $c2 = date("l", strtotime("+2 day", strtotime($rowP['buka']))); 
                                if($c!="Sunday"&&$c!=$b){
                                    echo $c;}
                                else{
                                    $c = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $c;}
                                $tampung++;?>
                            </th>
                            <th>
                                <center><?php $d = date("l", strtotime("+3 day", strtotime($rowP['buka'])));
                                $d2 = date("l", strtotime("+3 day", strtotime($rowP['buka']))); 
                                if($d!="Sunday"&&$d!=$c){
                                    echo $d;}
                                else{
                                    $d = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $d;}
                                $tampung++;?>
                            </th>
                            <th>
                                <center><?php $e = date("l", strtotime("+4 day", strtotime($rowP['buka']))); 
                                $e2 = date("l", strtotime("+4 day", strtotime($rowP['buka']))); 
                                if($e!="Sunday"&&$e!=$d){
                                    echo $e;}
                                else{
                                    $e = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $e;}
                                $tampung++;?>
                            </th>
                            <th>
                                <center><?php $f = date("l", strtotime("+5 day", strtotime($rowP['buka'])));
                                $f2 = date("l", strtotime("+5 day", strtotime($rowP['buka'])));
                                if($f!="Sunday"&&$f!=$e){
                                    echo $f;}
                                else{
                                    $f = date("l", strtotime("+".$tampung." day", strtotime($rowP['buka'])));
                                    echo $f;}
                                $tampung++;?>
                            </th>
                          </tr>
                          <tr>
                            <td><center>Tanggal</td>
                            <td>
                                <center><?php $tampung2 = 1;
                                if($a2!="Sunday"){
                                echo $rowP['buka'];}
                                else{
                                    echo $date0 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++; ?></td>
                            <td>
                                <center><?php if($b2!="Sunday"&&$b2!=$a){
                                    echo $date1 = date('Y-m-d', strtotime("+1 day", strtotime($rowP['buka'])));}
                                else{
                                    echo $date1 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++;  ?></td>
                            <td>
                                <center><?php if($c2!="Sunday"&&$c2!=$b){
                                    echo $date2 = date('Y-m-d', strtotime("+2 day", strtotime($rowP['buka'])));}
                                else{
                                    echo $date2 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++;  ?></td>
                            <td>
                                <center><?php if($d2!="Sunday"&&$d2!=$c){
                                    echo $date3 = date('Y-m-d', strtotime("+3 day", strtotime($rowP['buka'])));}
                                else{
                                    echo $date3 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++;  ?></td>

                            <td>
                                <center><?php if($e2!="Sunday"&&$e2!=$d){
                                    echo $date4 = date('Y-m-d', strtotime("+4 day", strtotime($rowP['buka'])));}
                                else{
                                    echo $date4 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++;  ?></td>                                
                            <td>
                                <center><?php if($f2!="Sunday"&&$f2!=$e){
                                    echo $date5 = date('Y-m-d', strtotime("+5 day", strtotime($rowP['buka'])));}
                                else{
                                    echo $date5 = date('Y-m-d', strtotime("+".$tampung2." day", strtotime($rowP['buka'])));
                                } 
                                $tampung2++;  ?></td>
                          </tr>
                          <tr>
                            <td><center>07.00 - 08.30</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="07.00-08.30 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>08.30 - 10.00</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="08.30-10.00 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>10.00 - 11.30</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="10.00-11.30 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>11.30 - 13.00</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="11.30-13.00 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>13.00 - 14.30</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="13.00-14.30 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>14.30 - 16.00</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="14.30-16.00 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                          <tr>
                            <td><center>16.00 - 17.30</td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $rowP['buka']; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $date1; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $date2; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $date3; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $date4; ?>"></label></div></td>
                            <td><center><div class="checkbox"><label><input type="checkbox" name="jam[]" value="16.00-17.30 <?php echo $date5; ?>"></label></div></td>
                          </tr>
                        </table>
                        <div class="col-sm-11"></div>&nbsp&nbsp&nbsp&nbsp<button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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