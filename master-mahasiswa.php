<?php
session_start();
require './db.php';
if(isset($_POST['kode'])) {
    $kode = $_POST['kode'];
    $sqlP = "SELECT * FROM mahasiswa WHERE nrp = '".$kode."'";
    $resultP = mysqli_query($link, $sqlP);
    $rowP = mysqli_fetch_object($resultP);
    header("content-type: text/x-json");
    echo json_encode($rowP);
    exit();
}
$sqlPemb = "SELECT *  from dosen";
$resultPemb = mysqli_query($link, $sqlPemb);
if(!$resultPemb) {
    echo "SQL ERROR: ".$sqlPemb;
}
$sql = "SELECT * FROM mahasiswa ";
$result = mysqli_query($link, $sql);
if(!$result) {
    echo "SQL ERROR: ".$sql;
}
if(!isset($_COOKIE['login'])) {
    header('location: index.php');
}

$sqlM = "SELECT * FROM admin WHERE nama='".$_COOKIE['nomer']."'";
$resultM = mysqli_query($link, $sqlM);
$rowM = mysqli_fetch_array($resultM);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Master Mahasiswa</title>

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

<body>

    <div class="brand">
        <img class="img-center" src="./img/logos.png" width="100" height="100">
        ALFA - Sistem Penjadwalan TA
        <img class="img-center" src="./img/logo.png" width="100" height="100">
    </div>
    <div class="address-bar">Admin - Universitas Surabaya</div>

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
                        <a href="./master-mahasiswa.php">Mahasiswa</a>
                    </li>
                    <li>
                        <a href="./master-periode.php">Periode</a>
                    </li>
                    <li>
                        <a href="./master-sidang.php">Jadwal Sidang</a>
                    </li>
                    <li>
                        <a href="./master-ruang.php">Atur Ruang</a>
                    </li>
                    <li>
                        <a href="./proses.php?cmd=logout">Logout, <?php echo $rowM['nama']; ?> </a>
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
                    <legend>Data Mahasiswa Mendaftar Tugas Akhir</legend>
                    <table class="table table-bordered">
                        <tr class="info">
                            <th rowspan="2"><center></br>No</th>
                            <th rowspan="2"><center></br>NRP</th>
                            <th rowspan="2"><center></br>Nama</th>
                            <th rowspan="2"><center></br>No. Ponsel</th>
                            <th rowspan="2"><center></br>Pembimbing 1</th>
                            <th rowspan="2"><center></br>Pembimbing 2</th>
                            <th colspan="6"><center>Prasyarat</th>
                            <th rowspan="2"><center></br>Edit / Hapus</th>
                        </tr>
                        <tr class="info">
                            <th><center>1</th>
                            <th><center>2</th>
                            <th><center>3</th>
                            <th><center>4</th>
                            <th><center>5</th>
                            <th><center>6</th>
                        </tr>
                        <?php
                        $hitung = 1;
                        while ($row = mysqli_fetch_object($result)) {
                            echo "<tr>";
                            echo "<td>" . $hitung. "</td>";
                            echo "<td>" . $row->nrp . "</td>";
                            echo "<td>" . $row->nama . "</td>";
                            echo "<td>" . $row->hp . "</td>";
                            $sqlDosen = "SELECT nama  from dosen WHERE dosen.npk=(SELECT npk1 FROM `mahasiswa` WHERE nrp= ".$row->nrp.")";
                            $resultDosen = mysqli_query($link, $sqlDosen);
                            if(!$resultDosen) {
                                echo "SQL ERROR: ".$sqlDosen;
                            }
                            while ($row1 = mysqli_fetch_object($resultDosen)) {
                                echo "<td>" . $row1->nama . "</td>";
                            }
                            $sqlDosen2 = "SELECT nama  from dosen WHERE dosen.npk=(SELECT npk2 FROM `mahasiswa` WHERE nrp= ".$row->nrp.")";
                            $resultDosen2 = mysqli_query($link, $sqlDosen2);
                            if(!$resultDosen2) {
                                echo "SQL ERROR: ".$sqlDosen2;
                            }
                            while ($row2 = mysqli_fetch_object($resultDosen2)) {
                                echo "<td>" . $row2->nama . "</td>";
                            }
                            echo "<td>" . $row->pra1 . "</td>";
                            echo "<td>" . $row->pra2 . "</td>";
                            echo "<td>" . $row->pra3 . "</td>";
                            echo "<td>" . $row->pra4 . "</td>";
                            echo "<td>" . $row->pra5 . "</td>";
                            echo "<td>" . $row->pra6 . "</td>";
                            echo "<td>";
                            echo "<center><a href='#' class='edit' data-toggle='modal' id='tekan' ide='" . $row->nrp . "' data-target='#exampleModal'><img src='./img/edit.png' width='20px'></a>&nbsp&nbsp&nbsp";
                            echo "<a href='proses.php?cmd=hapusMahasiswa&i=" . $row->nrp . "'><img src='./img/hapus.png' width='20px'></a>";
                            echo "</td>";
                            echo "<tr>";
                            $hitung = $hitung +1;
                        } ?>
                    </table>
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

    <!-- .modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><strong>Edit Data Mahasiswa</strong></h4>
            </div>
            <div class="modal-body">
                <form action="proses.php?cmd=editMahasiswa" method="POST">
                    <div class="form-group">
                        <label class="control-label">NRP:</label>
                        <input name="nrp" type="text" class="form-control" id="nrp"></div>
                    <div class="form-group">
                        <label class="control-label">Nama:</label>
                        <input name="nama" type="text" class="form-control" id="nama"></div>
                    <div class="form-group">
                        <label class="control-label">No Ponsel:</label>
                        <input name="nohp" type="text" class="form-control" id="nohp"></div>
                    <div class="form-group">
                        <label class="control-label">Pembimbing 1:</label>
                        <select name="pembimbing1" id="pemb1" class="form-control">
                            <?php
                            while($rowPemb = mysqli_fetch_object($resultPemb)) {
                                $pemb[]=$rowPemb; //BUAT PENGULANGAN
                                echo "<option value='" . $rowPemb->npk . "'>" . $rowPemb->nama . "</option>";
                            }
                            ?>
                        </select></div>
                    <div class="form-group">
                        <label class="control-label">Pembimbing 2:</label>
                        <select name="pembimbing2" id="pemb2" class="form-control">
                            <?php
                            foreach($pemb as $rowPemb1) { //BUAT RESET mysqli_fetch_object()
                                echo "<option value='" . $rowPemb1->npk . "'>" . $rowPemb1->nama . "</option>";
                            }
                            ?>
                        </select></div>
                    <div class="form-group">
                        <label class="control-label">Prasyarat:</label></br>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per1" value="1">1</label>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per2" value="2">2</label>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per3" value="3">3</label>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per4" value="4">4</label>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per5" value="5">5</label>
                        <label class="checkbox-inline"><input type="checkbox" name="pers[]" id="per6" value="6">6</label>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" id="kirim" value="SIMPAN"/>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- /.modal -->

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

    <script type="text/javascript">
    $(function() {
        $("body").delegate('.edit', 'click', function(){
            var idEdit = $(this).attr('ide');
            $.ajax({
                url     : "master-mahasiswa.php",
                type    : "POST",
                data    : {
                        "kode": idEdit
                    },
                success:function(show)
                {
                    $("#nrp").val(show.nrp);
                    $("#nama").val(show.nama);
                    $("#nohp").val(show.hp);
                    var npk1 = show.npk1;
                    var npk2 = show.npk2;
                    if(show.npk1 == "'"+npk1+"'"){ 
                        $("#pemb1 option[value='"+ npk1 +"']").prop('selected', true);
                    }
                    if(show.npk1 != "'"+npk1+"'"){ 
                        $("#pemb1 option[value='"+ npk1 +"']").prop('selected', true);
                    }
                    if(show.npk2 == "'"+npk2+"'"){ 
                        $("#pemb2 option[value='"+ npk2 +"']").prop('selected', true);
                    }
                    if(show.npk2 != "'"+npk2+"'"){ 
                        $("#pemb2 option[value='"+ npk2 +"']").prop('selected', true);
                    }
                    if(show.pra1 == "1"){
                        $("#per1").prop('checked', true);
                    }
                    if(show.pra1 == "0"){ 
                        $("#per1").prop('checked', false);
                    }
                    if(show.pra2 == "1"){ 
                        $("#per2").prop('checked', true);
                    }
                    if(show.pra2 == "0"){ 
                        $("#per2").prop('checked', false);
                    }
                    if(show.pra3 == "1"){ 
                        $("#per3").prop('checked', true);
                    }
                    if(show.pra3 == "0"){ 
                        $("#per3").prop('checked', false);
                    }
                    if(show.pra4 == "1"){ 
                        $("#per4").prop('checked', true);
                    }
                    if(show.pra4 == "0"){ 
                        $("#per4").prop('checked', false);
                    }
                    if(show.pra5 == "1"){ 
                        $("#per5").prop('checked', true);
                    }
                    if(show.pra5 == "0"){ 
                        $("#per5").prop('checked', false);
                    }
                    if(show.pra6 == "1"){ 
                        $("#per6").prop('checked', true);
                    }
                    if(show.pra6 == "0"){ 
                        $("#per6").prop('checked', false);
                    }
                }
            });
        });
    });
    </script>

</body>

</html>