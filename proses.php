<?php
session_start();
require './db.php';
$cmd = $_GET['cmd'];

switch ($cmd) {
    case "login":
        $id = $_POST['ID'];
        $pswd = $_POST['pswd'];
        $jabatan = $_POST['jabatan'];

        /*---------- ADMIN ----------*/
        if($jabatan == 'admin'){
            $sql = "SELECT * FROM admin WHERE nama ='" . $id . "' ";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            if(mysqli_num_rows($result) > 0) {
                if($pswd == $row['password']){
                    setcookie("nomer", $id, time() + 6000);
                    setcookie("login", TRUE, time() + 6000);
                    header("location: master-mahasiswa.php");
                }
                else {
                    $_SESSION['notifSQL'] = "<strong>MAAF!</strong> PASSWORD SALAH.";
                    header("location: login.php");
                }
            }
            else {
                $_SESSION['notifSQL'] = "<strong>MAAF!</strong> USER TIDAK DITEMUKAN.";
                header("location: login.php");
            }
        }

        /*---------- DOSEN ----------*/
        if($jabatan == 'dosen'){
            $sqlD = "SELECT * FROM dosen WHERE nama ='" . $id . "' ";
            $resultD = mysqli_query($link, $sqlD);
            $rowD=  mysqli_fetch_array($resultD);
            if(mysqli_num_rows($resultD) > 0) {
                if($pswd == $rowD['password']){
                    setcookie("nomerD", $id, time() +6000);
                    setcookie("loginD", TRUE, time() +6000);
                    header("location: jadwal-kegiatan.php");
                }
                else {
                    $_SESSION['notifSQL'] = "<strong>MAAF!</strong> PASSWORD SALAH.";
                    header("location: login.php");
                }
            }
            else {
                $_SESSION['notifSQL'] = "<strong>MAAF!</strong> USER TIDAK DITEMUKAN.";
                header("location: login.php");
            }
        }

        /*---------- KALAB ----------*/
        if($jabatan == 'kalab'){
            $sqlK = "SELECT * FROM kalab WHERE nama ='" . $id . "' "; //TABEL KALEB
            $resultK = mysqli_query($link, $sqlK);
            $rowK =  mysqli_fetch_array($resultK);
            if(mysqli_num_rows($resultK) > 0) {
                if($pswd == $rowK['password']){
                    setcookie("nomerK", $id, time() +6000);
                    setcookie("loginK", TRUE, time() +6000);
                    header("location: page-penguji.php"); //HALAMAN STAFF
                }
                else {
                    $_SESSION['notifSQL'] = "<strong>MAAF!</strong> PASSWORD SALAH.";
                    header("location: login.php");
                }
            }
            else {
                $_SESSION['notifSQL'] = "<strong>MAAF!</strong> USER TIDAK DITEMUKAN.";
                header("location: login.php");
            }
        }
        break;

    case "logout":
        setcookie("nomer", $id, time() -1);
        setcookie("login", FALSE, time() -1);
        header('location: login.php');
        break;

    case "logoutD":
        setcookie("nomerD", $id, time() -1);
        setcookie("loginD", FALSE, time() -1);
        header('location: login.php');
        break;

    case "logoutK":
        setcookie("nomerK", $id, time() -1);
        setcookie("loginK", FALSE, time() -1);
        header('location: login.php');
        break;
        
    /*---------- index.php ----------*/
    case "inputM":
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $ponsel = $_POST['ponsel'];
        $judul = $_POST['judul'];
        $pers = $_POST['pers'];
        $npk1 = $_POST['npk1'];
        $npk2 = $_POST['npk2'];

        $per1 = 0;
        $per2 = 0;
        $per3 = 0;
        $per4 = 0;
        $per5 = 0;
        $per6 = 0;

        if(!empty($_POST['pers']))
        {
            foreach($_POST['pers'] as $chkval)
            {
                if($chkval == '1')
                {
                    $per1 = 1;
                }
                if($chkval == '2')
                {
                    $per2 = 1;
                }
                if($chkval == '3')
                {
                    $per3 = 1;
                }
                if($chkval == '4')
                {
                    $per4 = 1;
                }
                if($chkval == '5')
                {
                    $per5 = 1;
                }
                if($chkval == '6')
                {
                    $per6 = 1;
                }
            }
        }

        $sql = "INSERT INTO mahasiswa (nrp, nama, hp, judul_ta, npk1, npk2, pra1, pra2, pra3, pra4, pra5, pra6)" . "VALUE ('" . $nrp . "', '" . $nama . "', '" . $ponsel . "', '".$judul."',  '". $npk1."', '". $npk2."','". $per1 ."', '". $per2 ."', '". $per3 ."', '". $per4 ."', '". $per5 ."', '". $per6 ."')";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            header("Location: index.php");
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA ANDA BERHASIL DI MASUKKAN.";
            header("Location: index.php");
        }
        break;
    /*---------- index.php ----------*/



    /*---------- filter ----------*/
    /*
    case "filter":  //BELOM SELESAI
        $nama = $_POST['nama'];
        break;
        */
    /*---------- filter ----------*/



    /*---------- master-mahasiswa.php ----------*/
    case "editMahasiswa":
        $K = $_POST['nrp'];
        $N = $_POST['nama'];
        $H = $_POST['nohp'];
        $P1 = $_POST['pembimbing1'];
        $P2 = $_POST['pembimbing2'];

        $per1 = 0;
        $per2 = 0;
        $per3 = 0;
        $per4 = 0;
        $per5 = 0;
        $per6 = 0;

        if(!empty($_POST['pers']))
        {
            foreach($_POST['pers'] as $chkval)
            {
                if($chkval == '1')
                {
                    $per1 = 1;
                }
                if($chkval == '2')
                {
                    $per2 = 1;
                }
                if($chkval == '3')
                {
                    $per3 = 1;
                }
                if($chkval == '4')
                {
                    $per4 = 1;
                }
                if($chkval == '5')
                {
                    $per5 = 1;
                }
                if($chkval == '6')
                {
                    $per6 = 1;
                }
            }
        }

        $sqlEDIT = "UPDATE mahasiswa SET nama = '".$N."', hp ='".$H."', npk1 = '".$P1."', npk2 = '".$P2."', pra1=".$per1.", pra2=".$per2.", pra3=".$per3.", pra4=".$per4.", pra5=".$per5.", pra6=".$per6." WHERE nrp = '".$K."'";
        $resultEDIT = mysqli_query($link, $sqlEDIT);
        if (!$resultEDIT) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-mahasiswa.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI EDIT.";
            header('location: master-mahasiswa.php');
        }
        break;

    case "hapusMahasiswa":
        $kode_mahasiswa = $_GET['i'];
        
        $sql = "DELETE FROM mahasiswa WHERE nrp='" . $kode_mahasiswa . "' ";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-mahasiswa.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI HAPUS.";
            header("Location: master-mahasiswa.php");
        }
        break;
    /*---------- master-mahasiswa.php ----------*/

    /*---------- master-periode.php ----------*/
    case "insertPeriode": 
        $buka = $_POST['buka'];
        $tutup = $_POST['tutup'];
        $nama = $_POST['nama'];
        $status = $_POST['status'];

        $cBuka = strtotime($buka);
        $cTutup = strtotime($tutup);

        $year = substr($buka, 0,4);
        $month=substr($buka,5,2);
        $day=substr($buka,8,2);
        echo $year ."</br>";
        echo $month ."</br>";
        echo $day ."</br>";

        $hBuka = date("l", $cBuka);
        $hTutup = date("l", $cTutup);

        if($status == 1) {
            $sqlP = "SELECT * FROM periode WHERE status = 1";
            $resultP = mysqli_query($link, $sqlP);
            if (!$resultP) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $rowP = mysqli_fetch_array($resultP);
            }

            if(mysqli_num_rows($resultP) > 0) {
                $sqlEDIT = "UPDATE periode SET status = 0 WHERE id = ".$rowP['id'];
                $resultEDIT = mysqli_query($link, $sqlEDIT);
                if (!$resultEDIT) {
                    $_SESSION['notifSQL'] = "SQL ERROR.";
                    die(header('location: master-periode.php'));
                }
            }

            $sqlAKTIF = "INSERT INTO periode (nama, buka, tutup, status) " . "VALUE ('".$nama."','".$buka."', '".$tutup."', 1)";
            $resultAKTIF = mysqli_query($link, $sqlAKTIF);
            if (!$resultAKTIF) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
                header('location: master-periode.php');
            }
        }
        else {
            $sqlNONAKTIF = "INSERT INTO periode (nama, buka, tutup) " . "VALUE ('".$nama."','".$buka."', '".$tutup."')";
            $resultNONAKTIF  = mysqli_query($link, $sqlNONAKTIF );

            if (!$resultNONAKTIF ) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
                header('location: master-periode.php');
            }
        }
        break;

    case "editPeriode":
        $K = $_POST['id_P'];
        $N = $_POST['nama_P'];
        $B = $_POST['buka_P'];
        $A = $_POST['tutup_P'];
        $S = $_POST['status_P'];

        if($S == 1) {

            $sqlP = "SELECT * FROM periode WHERE status = 1";
            $resultP = mysqli_query($link, $sqlP);
            if (!$resultP) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $rowP = mysqli_fetch_array($resultP);
            }

            if(mysqli_num_rows($resultP) > 0) {
                $sqlEDIT = "UPDATE periode SET status = 0 WHERE id = ".$rowP['id'];
                $resultEDIT = mysqli_query($link, $sqlEDIT);
                if (!$resultEDIT) {
                    $_SESSION['notifSQL'] = "SQL ERROR.";
                    die(header('location: master-periode.php'));
                }
            }

            $sqlAKTIF = "UPDATE periode SET nama = '".$N."', buka ='".$B."', tutup = '".$A."', status = '".$S."' WHERE id = '".$K."'";
            $resultAKTIF = mysqli_query($link, $sqlAKTIF);
            if (!$resultAKTIF) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI EDIT.";
                header('location: master-periode.php');
            }
        }
        else {
            $sqlNONAKTIF = "UPDATE periode SET nama = '".$N."', buka ='".$B."', tutup = '".$A."', status = '".$S."' WHERE id = '".$K."'";
            $resultNONAKTIF  = mysqli_query($link, $sqlNONAKTIF );

            if (!$resultNONAKTIF ) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-periode.php'));
            }
            else {
                $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI EDIT.";
                header('location: master-periode.php');
            }
        }
        break;

    case "hapusPeriode":
        $kode_periode = $_GET['i'];
        
        $sql = "DELETE FROM periode WHERE id='" . $kode_periode . "' ";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-periode.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong>DATA BERHASIL DI HAPUS.";
            header("Location: master-periode.php");
        }
        break;
    /*---------- master-periode.php ----------*/

    /*---------- master-ruang.php ----------*/
    case "insertRuang":
        $nrp = $_POST['nrp'];
        $ruang = $_POST['ruangan'];

        //CEK KETERSEDIAAN RUANG
        $sql = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE ruangid='".$ruang."'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-ruang.php'));
        }
        while ($row=mysqli_fetch_object($result)) {
            $sqlRuang = "SELECT * FROM jadwal_sidang_tugas_akhir WHERE nrp ='".$nrp."'";
            $resultRuang = mysqli_query($link, $sqlRuang);
            if (!$resultRuang) {
                $_SESSION['notifSQL'] = "SQL ERROR.";
                die(header('location: master-ruang.php'));
            }
            while ($rowRuang=mysqli_fetch_object($resultRuang)) {
                if($row->tanggal == $rowRuang->tanggal && $row->jam == $rowRuang->jam){
                    $_SESSION['notifSQL'] = "<strong>MAAF,</strong> Ruangan yang dipilih telah digunakan. Silahkan pilih yang lain.";
                    die(header('location: master-ruang.php'));
                }
            }
        }

        //UPDATE RUANGAN DI JADWAL SIDANG
        $sqlInsert = "UPDATE jadwal_sidang_tugas_akhir SET ruangid = ".$ruang." WHERE nrp='".$nrp."'";
        $resultInsert = mysqli_query($link, $sqlInsert);
        if (!$resultInsert) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-ruang.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
            header('location: master-ruang.php');
        }
        break;

    case "editRuang":
        $K = $_POST['id_R'];
        $N = $_POST['nama_R'];
        $R = $_POST['ruang_R'];

        $sqlEDIT = "UPDATE jadwal_sidang_tugas_akhir SET nrp = '".$N."', ruangid ='".$R."' WHERE id = '".$K."'";
        $resultEDIT = mysqli_query($link, $sqlEDIT);
        if (!$resultEDIT) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-ruang.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI EDIT.";
            header('location: master-ruang.php');
        }
        break;

    case "hapusRuang":
        $kode_ruang = $_GET['i'];
        
        $sql = "DELETE FROM jadwal_sidang_tugas_akhir WHERE id='" . $kode_ruang . "' ";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-ruang.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong>DATA BERHASIL DI HAPUS.";
            header("Location: master-ruang.php");
        }
        break;
    /*---------- master-ruang.php ----------*/

    /*---------- jadwal-kegiatan.php ----------*/
    case "jamDosen":
        $jam = $_POST['jam'];
        $hitung = count($jam);
        $jamm ="";
        $sqlD = "SELECT * FROM dosen WHERE nama ='".$_COOKIE['nomerD']."'";
        $resultD = mysqli_query($link, $sqlD);
        $rowD= mysqli_fetch_array($resultD);
        for($i=0 ;$i < $hitung; $i++ ){
            $jamm= substr($jam[$i], 0,11);
            $tgl= substr($jam[$i], 12,10);

            $sqlJ = "SELECT * FROM jadwal_kegiatan_dosen WHERE npk='".$rowD['npk']."' AND tgl ='".$tgl."' AND jam='".$jamm."'";
            $resultJ = mysqli_query($link,$sqlJ);
            if(mysqli_num_rows($resultJ)==0)
            {
                $sql = "INSERT INTO jadwal_kegiatan_dosen (tgl, jam, npk) " . "VALUE ('".$tgl."', '".$jamm."', '".$rowD['npk']."')";
                $result = mysqli_query($link, $sql);
            }
        }
        if (!$result ) {
            $_SESSION['notifSQL'] = "<strong>MAAF</strong> JADWAL TELAH TERISI.";
            die(header('location: jadwal-kegiatan.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
            header('location: jadwal-kegiatan.php');
        }
        break;

    case "hapusJadwalDosen":
        $tanggal = $_GET['tgl1'];
        $jam = $_GET['jam1'];
        $npk = $_GET['npk1'];
        
        $sql = "DELETE FROM jadwal_kegiatan_dosen WHERE npk='" . $npk . "' AND tgl='".$tanggal."' AND jam='".$jam."'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: jadwal-kegiatan.php'));
        }
        else {
            $_SESSION['notif'] = "DATA BERHASIL DI HAPUS.";
            header("Location: jadwal-kegiatan.php");
        }
        break;


    /*---------- page-penguji.php ----------*/
    case "insertPenguji":
        $nrp = $_POST['nrp'];
        $npk1 = $_POST['npk1'];
        $npk2 = $_POST['npk2'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam'];

        //CEK PEMBIMBING SAMA PENGUJI
        $sqlBimbing = "SELECT * from mahasiswa WHERE nrp ='".$nrp."'";
        $resultBimbing = mysqli_query($link, $sqlBimbing);
        while ($row=mysqli_fetch_object($resultBimbing)) {
            if($npk1 == $row->npk1 or $npk1 == $row->npk2){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> PENGUJI 1 DENGAN PEMBIMBING SAMA.";
                die(header('location: page-penguji.php'));
            }
            if($npk2 == $row->npk1 or $npk2 == $row->npk2){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> PENGUJI 2 DENGAN PEMBIMBING SAMA.";
                die(header('location: page-penguji.php'));
            }
            if($npk2 == $row->ketua or $npk1 == $row->ketua){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> PEMBIMBING DENGAN KETUA SAMA.";
                die(header('location: page-penguji.php'));
            }
            if($npk2 == $row->sekretaris or $npk1 == $row->sekretaris){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> PEMBIMBING DENGAN SEKERTARIS SAMA.";
                die(header('location: page-penguji.php'));
            }
        }

        //CEK KELAYAKAN DOSEN PENGUJI
        $sqlLayak = "SELECT * FROM dosen WHERE status=0";
        $resultLayak = mysqli_query($link, $sqlLayak);
        while ($rowLayak=mysqli_fetch_object($resultLayak)) {
            if($npk1 == $rowLayak->npk){
                $sqlLayak2 = "SELECT * FROM dosen WHERE status=0";
                $resultLayak2 = mysqli_query($link, $sqlLayak2);
                while ($rowLayak2=mysqli_fetch_object($resultLayak2)) {
                    if($npk2 == $rowLayak2->npk){
                        $_SESSION['notifSQL'] = "<strong>MAAF</strong> Kedua penguji tidak layak.";
                        die(header('location: page-penguji.php'));
                    }
                }
            }
        }

        //CEK JADWAL KOSONG DOSEN
        $sqlCekJadwal = "SELECT * FROM jadwal_kegiatan_dosen WHERE npk ='".$npk1."' AND tgl ='".$tanggal."' AND jam ='".$jam."'";
        $resultCekJadwal = mysqli_query($link, $sqlCekJadwal);
        if(!$resultCekJadwal){
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: page-penguji.php'));
        }
        while(mysqli_num_rows($resultCekJadwal)==0){
            $_SESSION['notif'] = "<strong>ERROR</strong> Jadwal dosen dengan npk '".$npk1."' tidak ada.";
            die(header('location: page-penguji.php'));
        }
        $sqlCekJadwal2 = "SELECT * FROM jadwal_kegiatan_dosen WHERE npk ='".$npk2."' AND tgl ='".$tanggal."' AND jam ='".$jam."'";
        $resultCekJadwal2 = mysqli_query($link, $sqlCekJadwal2);
        if(!$resultCekJadwal2){
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: page-penguji.php'));
        }
        while(mysqli_num_rows($resultCekJadwal2)==0){
            $_SESSION['notif'] = "<strong>ERROR</strong> Jadwal dosen dengan npk '".$npk2."' tidak ada.";
            die(header('location: page-penguji.php'));
        }

        //-------------------INSERT KE jadwal sidang
        $sqlSidang = "INSERT into jadwal_sidang_tugas_akhir (nrp, jam, tanggal) VALUE ('".$nrp."', '".$jam."', '".$tanggal."')";
        $resultSidang = mysqli_query($link, $sqlSidang);
        if (!$resultSidang) {
            $_SESSION['notifSQL'] = "SQL ERROR 404.";
            die(header('location: page-penguji.php'));
        }

        //--------------------UPDATE DI MAHASISWA
        $sql = "UPDATE mahasiswa SET penguji1='".$npk1."', penguji2='".$npk2."' WHERE nrp='".$nrp."'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: page-penguji.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
            $sqlJadwal = "SELECT * FROM jadwal_kegiatan_dosen WHERE npk='".$npk1."' AND jam='".$jam."' AND tgl ='".$tanggal."'" ;
            $resultJadwal = mysqli_query($link, $sqlJadwal);
            if (!$resultJadwal) {
                echo "SQL ERROR".$sqlJadwal;
            }
            while($rowJadwal = mysqli_fetch_object($resultJadwal)){
                $hasil1 = $rowJadwal->status + 1;

                /*if($hasill>1 ){
                    $_SESSION['notifSQL'] = "<strong>---SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
                    header('location: page-penguji.php');
                }*/

                $sqlStatus = "UPDATE jadwal_kegiatan_dosen SET status='".$hasil1."' WHERE npk='".$npk1."' AND jam='".$jam."' AND tgl ='".$tanggal."'" ;
                $resultStatus1 = mysqli_query($link, $sqlStatus);
                if (!$resultStatus1 ) {
                    echo "SQL ERROR".$sqlStatus;
                }
                else {
                    $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
                    header('location: page-penguji.php');
                }
            }
            $sqlJadwal2 = "SELECT * FROM jadwal_kegiatan_dosen WHERE npk='".$npk2."' AND jam='".$jam."' AND tgl ='".$tanggal."'" ;
            $resultJadwal2 = mysqli_query($link, $sqlJadwal2);
            if (!$resultJadwal2) {
                echo "SQL ERROR".$sqlJadwal2;
            }
            while($rowJadwal2 = mysqli_fetch_object($resultJadwal2)){
                $hasil2 = $rowJadwal2->status + 1;
                $sqlStatus2 = "UPDATE jadwal_kegiatan_dosen SET status='".$hasil2."' WHERE npk='".$npk2."' AND jam='".$jam."' AND tgl ='".$tanggal."'" ;
                $resultStatus2 = mysqli_query($link, $sqlStatus2);
                if (!$resultStatus2) {
                    echo "SQL ERROR".$sqlStatus2;
                }
            }
            die(header('location: page-penguji.php'));
        }
        break;

    case "hapusPenguji":
        $kode_mahasiswa = $_GET['i'];
        $penguji1 = $_GET['uji1'];
        $penguji2 = $_GET['uji2'];
        $sql = "UPDATE mahasiswa SET penguji1='', penguji2='' WHERE nrp='" . $kode_mahasiswa . "' ";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: page-penguji.php'));
        }
        else {
            $sqlDelete = "DELETE FROM jadwal_sidang_tugas_akhir WHERE nrp = '".$kode_mahasiswa."'";
            $resultDel = mysqli_query($link, $sqlDelete);
            if (!$resultDel) {
                $_SESSION['notifSQL'] = "SQL ERROR2.";
                die(header('location: page-penguji.php'));
            }
            else {
                $sqlDosen = "UPDATE jadwal_kegiatan_dosen SET status=(status-1) WHERE npk='".$uji1."' OR npk ='".$uji2."'";
                $resultDos = mysqli_query($link, $sqlDosen);
                if (!$resultDos) {
                    $_SESSION['notifSQL'] = "SQL ERROR3.";
                    die(header('location: page-penguji.php'));
                }
                else{       
                    $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI HAPUS.";
                    header("Location: page-penguji.php");
                }
            }
        }
        break;
    /*---------- page-penguji.php ----------*/

    /*---------- page-ketua.php ----------*/
    case "insertKetSek":
        $ketua = $_POST['ketua'];
        $sekre = $_POST['seker'];
        $nrp = $_POST['mahasiswa'];

        $sql = "SELECT * from mahasiswa WHERE nrp ='".$nrp."'";
        $result = mysqli_query($link, $sql);
        while ($row=mysqli_fetch_object($result)) {
            if($ketua == $row->penguji1 or $ketua == $row->penguji2){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> KETUA DENGAN PENGUJI SAMA.";
                die(header('location: page-ketua.php'));
            }
            if($sekre == $row->penguji1 or $sekre == $row->penguji2){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> SEKERTARIS DENGAN PENGUJI SAMA.";
                die(header('location: page-ketua.php'));
            }
            if($ketua == $row->npk1 or $ketua == $row->npk1 or $sekre == $row->npk2 or $sekre == $row->npk2){
                $_SESSION['notifSQL'] = "<strong>MAAF</strong> KETUA DENGAN PEMBIMBING SAMA.";
                die(header('location: page-ketua.php'));
            }
        }

        if($ketua == $sekre){
            $_SESSION['notifSQL'] = "<strong>MAAF</strong> KETUA DENGAN SEKERTARIS SAMA.";
            die(header('location: page-ketua.php'));
        }
        else{
            $sqlUpdate = "UPDATE mahasiswa SET ketua = '".$ketua."', sekretaris = '".$sekre."' WHERE nrp='".$nrp."'";
            $resultUpdate = mysqli_query($link, $sqlUpdate);
            if (!$resultUpdate) {
                $_SESSION['notif'] = "SQL ERROR.";
                die(header('location: page-ketua.php'));
            }
            else {
                $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI MASUKKAN.";
                header('location: page-ketua.php');
            }
        }
        break;

    case "hapusKetua":
        $nrp = $_GET['i'];
        $sql = "UPDATE mahasiswa SET ketua='', sekretaris='' WHERE nrp='".$nrp."'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: page-ketua.php'));
        }
        else {
            $_SESSION['notif'] = "DATA BERHASIL DI HAPUS.";
            header('location: page-ketua.php');
        }
        break;
    /*---------- page-ketua.php ----------*/

    /*---------- master-sidang.php ----------*/
    case "hapusJadwal":
        $kode = $_GET['i'];
        
        $sql = "UPDATE jadwal_sidang_tugas_akhir SET ruangid = 0 WHERE nrp='".$kode."'";
        $result = mysqli_query($link, $sql);
        if (!$result) {
            $_SESSION['notifSQL'] = "SQL ERROR.";
            die(header('location: master-sidang.php'));
        }
        else {
            $_SESSION['notif'] = "<strong>SELAMAT</strong> DATA BERHASIL DI HAPUS.";
            header("Location: master-sidang.php");
        }
        break;
    /*---------- master-sidang.php ----------*/

    default;
        die("UNKNOWN");
} ?>