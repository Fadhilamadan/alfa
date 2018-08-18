<?php
session_start();
require './db.php';

if(isset($_POST['kode'])) {
    $kode = $_POST['kode'];

    $sqlP = "SELECT * FROM periode WHERE id = '".$kode."'";
    $resultP = mysqli_query($link, $sqlP);

    $rowP = mysqli_fetch_object($resultP);

    header("content-type: text/x-json");
    echo json_encode($rowP);
    exit();
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

    <title>Master Periode</title>

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
                    <form class="form-signin" action="proses.php?cmd=insertPeriode" method="POST">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                            <div class="panel panel-info">
                                <div class="panel-heading"><strong>Periode Sidang</strong></div>
                                <div class="panel-body">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nama:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama Periode" required></div>
                                            </br></br>
                                            <label class="col-sm-2 control-label">Buka:</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="buka" placeholder="Tanggal Buka Periode" required></div>
                                            </br></br>
                                            <label class="col-sm-2 control-label">Tutup:</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tutup" placeholder="Tanggal Tutup Periode" required></div>
                                            </br></br>
                                            <label class="col-sm-2 control-label">Status:</label>
                                            <div class="col-sm-10">
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1">Aktif</option>
                                                    <option value="0">Non Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form></br></br>&nbsp&nbsp&nbsp
                                    <div class="col-sm-8"></div><button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>

                    <?php
                    $sql = "SELECT * FROM periode ";
                    $result = mysqli_query($link, $sql);
                    if(!$result) {
                        echo "SQL ERROR: ".$sql;
                    }?>
                    <legend>Periode Sidang Tugas Akhir</legend>
                    <table class="table table-bordered">
                        <tr class="info">
                            <th><center>No</th>
                            <th><center>Nama Periode</th>
                            <th><center>Tanggal Buka</th>
                            <th><center>Tanggal Tutup</th>
                            <th><center>Status</th>
                            <th><center>Edit / Hapus</th>
                        </tr>
                        <?php
                        $hitung = 1;
                        while ($row = mysqli_fetch_object($result)) {
                            echo "<tr>";
                            echo "<td><center>" . $hitung. "</td>";
                            echo "<td><center>" . $row->nama . "</td>";
                            echo "<td><center>" . $row->buka . "</td>";
                            echo "<td><center>" . $row->tutup . "</td>";
                            if($row->status==1){
                                echo "<td><center>Buka</td>";
                            }
                            else{
                                echo "<td><center>Tutup</td>";
                            }
                            echo "<td>";
                            echo "<center><a href='#' class='edit' data-toggle='modal' id='tekan' ide='" . $row->id . "' data-target='#exampleModal'><img src='./img/edit.png' width='20px'></a>&nbsp&nbsp&nbsp";
                            echo "<a href='proses.php?cmd=hapusPeriode&i=" . $row->id . "'><img src='./img/hapus.png' width='20px'></a>";
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

    <!-- .modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><strong>Edit Periode</strong></h4>
            </div>
            <div class="modal-body">
                <form action="proses.php?cmd=editPeriode" method="POST">
                        <input name="id_P" type="hidden" class="form-control" id="idP">
                    <div class="form-group">
                        <label class="control-label">Nama Periode:</label>
                        <input name="nama_P" type="text" class="form-control" id="namaP">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Buka:</label>
                        <input name="buka_P" type="date" class="form-control" id="bukaP" value="<?php echo $rowP->buka; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal Tutup:</label>
                        <input name="tutup_P" type="date" class="form-control" id="tutupP" value="<?php echo $rowP->tutup; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status:</label>
                        <select name="status_P" id="statusP" class="form-control">
                          <option value="1">Buka</option>
                          <option value="0">Tutup</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="kirim" value="SIMPAN"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- /.modal -->

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

    <script type="text/javascript">
    $(function() {
        $("body").delegate('.edit', 'click', function(){
            var idEdit = $(this).attr('ide');
            $.ajax({
                url     : "master-periode.php",
                type    : "POST",
                data    : {
                        "kode": idEdit
                    },
                success:function(show)
                {
                    $("#idP").val(show.id);
                    $("#namaP").val(show.nama);
                    $("#bukaP").val(show.buka);
                    $("#tutupP").val(show.tutup);
                    if(show.status == "1"){ //BUAT NYAMAIN AKTIF
                        $("#statusP option[value=1]").prop('selected', true);
                    }
                    if(show.status == "0"){ //BUAT NYAMAIN NONAKTIF
                        $("#statusP option[value=0]").prop('selected', true);
                    }
                }
            });
        });
    });
    </script>

</body>

</html>
