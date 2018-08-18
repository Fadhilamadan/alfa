<?php
session_start();
require './db.php';
if(isset($_POST['kode'])) {
    $kode = $_POST['kode'];
    $sqlP = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE id = '".$kode."'";
    $resultP = mysqli_query($link, $sqlP);
    $rowP = mysqli_fetch_object($resultP);
    header("content-type: text/x-json");
    echo json_encode($rowP);
    exit();
}
if(!isset($_COOKIE['login'])) {
    header('location: index.php');
}

$sqlR = "SELECT * FROM ruang";
$resultR = mysqli_query($link, $sqlR);
$sqlM = "SELECT * FROM admin WHERE nama='".$_COOKIE['nomer']."'";
$resultM = mysqli_query($link, $sqlM);
$rowM = mysqli_fetch_array($resultM);
$sqlNama = "SELECT * FROM mahasiswa m, dosen d";
$resultNama = mysqli_query($link, $sqlNama);
$sql = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE ruangid!=''";
$result = mysqli_query($link, $sql);
if(!$result) {
    echo "SQL ERROR: ".$sql;
}
$sqlBelum = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE ruangid=''";
$resultBelum = mysqli_query($link, $sqlBelum);
if(!$resultBelum) {
    echo "SQL ERROR: ".$sqlBelum;
}
$sqlB = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE ruangid=''";
$resultB = mysqli_query($link, $sqlB);
if(!$resultB) {
    echo "SQL ERROR: ".$sqlB;
}
$sqlBelumTambahan = "SELECT * FROM mahasiswa WHERE penguji1=''";
$resultBelumTambahan = mysqli_query($link, $sqlBelumTambahan);
if(!$resultBelumTambahan) {
    echo "SQL ERROR: ".$sqlBelumTambahan;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Master Ruang</title>

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
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/150x50&text=Logo" alt="">
                </a>
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
                    
                    <form class="form-signin" action="proses.php?cmd=insertRuang" method="POST">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <strong>Ruangan Sidang</strong>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">NRP:</label>
                                                <div class="col-sm-10">
                                                    <!-- NAMPILNO MAHASISWA SING DURUNG DAPET KELAS -->
                                                    <select name="nrp" id="nrp" class="form-control">
                                                        <?php
                                                        while($rowB = mysqli_fetch_object($resultB)) {
                                                            $Nrp[]=$rowB;
                                                            echo "<option value=" . $rowB->nrp . ">" . $rowB->nrp . "</option>"; 
                                                        }?>
                                                    </select>
                                                </div></br></br>
                                                <label class="col-sm-2 control-label">Ruang:</label>
                                                <div class="col-sm-10">
                                                    <select name="ruangan" id="ruangan" class="form-control">
                                                        <?php
                                                        while($rowR = mysqli_fetch_object($resultR)) {
                                                            $ruangan[]=$rowR;
                                                            echo "<option value='" . $rowR->id . "'>" . $rowR->nama . "</option>"; 
                                                        }?>
                                                    </select>
                                                </div>
                                            </div></br></br>&nbsp&nbsp&nbsp
                                            <div class="col-sm-8"></div>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-lg-7">
                        <legend>Jadwal Ruang Sidang</legend>
                        <table class="table table-bordered">
                            <tr class="info">
                                <th><center>No</th>
                                <th><center>NRP</th>
                                <th><center>Tanggal</th>
                                <th><center>Jam</th>
                                <th><center>Ruang</th>
                                <th><center>Edit</th>
                            </tr>
                            <?php
                            $hitung = 1;
                            while ($row = mysqli_fetch_object($result)) {
                                echo "<tr>";
                                echo "<td><center>" . $hitung. "</td>";
                                echo "<td><center>" . $row->nrp. "</td>";
                                echo "<td><center>" . $row->tanggal. "</td>";
                                echo "<td><center>" . $row->jam. "</td>";
                                $sqlRuang = "SELECT * FROM jadwal_sidang_tugas_akhir j, ruang r WHERE j.nrp='".$row->nrp."' AND j.ruangid=r.id";
                                $resultRuang = mysqli_query($link, $sqlRuang);
                                if(!$resultRuang) {
                                    echo "SQL ERROR: ".$sqlRuang;
                                }
                                while ($rowRuang = mysqli_fetch_object($resultRuang)) {
                                    echo "<td><center>" . $rowRuang->nama. "</td>";
                                }
                                echo "<td>";
                                echo "<center><a href='#' class='edit' data-toggle='modal' id='tekan' ide='" . $row->id . "' data-target='#exampleModal'><img src='./img/edit.png' width='20px'></a>";
                                echo "</td>";
                                echo "<tr>";
                                $hitung = $hitung +1;
                            } ?>
                        </table>
                    </div>

                    <div class="col-lg-5">
                        <legend>Mahasiswa Belum Memiliki Ruang Sidang</legend>
                        <?php
                        $sql = "SELECT * FROM ruang";
                        $result = mysqli_query($link, $sql);
                        if(!$result) {
                            echo "SQL ERROR: ".$sql;
                        }?>
                        <table class="table table-bordered">
                            <tr class="info">
                                <th><center>No</th>
                                <th><center>NRP</th>
                                <th><center>Tanggal</th>
                                <th><center>Jam</th>
                            </tr>
                            <?php
                            $hitung = 1;
                            while ($row = mysqli_fetch_object($resultBelum)) {
                                echo "<tr>";
                                echo "<td><center>" . $hitung. "</td>";
                                echo "<td><center>" . $row->nrp . "</td>";
                                echo "<td><center>" . $row->tanggal . "</td>";
                                echo "<td><center>" . $row->jam . "</td>";
                                echo "<tr>";
                                $hitung = $hitung +1;
                            }
                            while ($rowBT = mysqli_fetch_object($resultBelumTambahan)) {
                                echo "<tr>";
                                echo "<td><center>" . $hitung. "</td>";
                                echo "<td><center>" . $rowBT->nrp . "</td>";
                                echo "<td><center>-</td>";
                                echo "<td><center>-</td>";
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

    <!-- .modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><strong>Edit Jadwal Ruang</strong></h4>
            </div>
            <div class="modal-body">
                <form action="proses.php?cmd=editRuang" method="POST">
                        <input name="id_R" type="hidden" class="form-control" id="idR">
                    <div class="form-group">
                        <label class="control-label">NRP :</label>
                        <input name="nama_R" type="text" class="form-control" id="namaR"></div>
                    <div class="form-group">
                        <label class="control-label">Ruang Sidang:</label>
                        <select name="ruang_R" id="ruangR" class="form-control">
                            <?php
                            foreach($ruangan as $rowRuaang) { //BUAT RESET mysqli_fetch_object()
                                echo "<option value='" . $rowRuaang->id . "'>" . $rowRuaang->nama . "</option>";
                            }
                            ?>
                        </select>
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
                url     : "master-ruang.php",
                type    : "POST",
                data    : {
                        "kode": idEdit
                    },
                success:function(show)
                {
                    $("#idR").val(show.id);
                    $("#namaR").val(show.nrp);
                    var ruangid = show.ruangid;
                    if(show.ruangid == "'"+ruangid+"'"){ 
                        $("#ruangR option[value='"+ ruangid +"']").prop('selected', true);
                    }
                    if(show.ruangid != "'"+ruangid+"'"){ 
                        $("#ruangR option[value='"+ ruangid +"']").prop('selected', true);
                    }
                }
            });
        });
    });
    </script>

</body>

</html>