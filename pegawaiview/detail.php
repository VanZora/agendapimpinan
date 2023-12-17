<?php ob_start(); 
include 'header.php';
include "../function.php";

if (isset($_POST["btn_verifikasi"])) {
    if (verifikasiAjuan($_POST) > 0)
        header("location:?page=detailagenda&id_agenda=" . $_GET["id_agenda"]);
    else
        echo mysqli_error($conn);
}

if (isset($_POST["btn_selesai"])) {
    if (selesaiRapat($_POST) > 0)
        header("location:?page=hasil");
    else
        echo mysqli_error($conn);
}

if (isset($_GET["id_permohonan"])) {
    $id_permohonan = $_GET["id_permohonan"];
}

$id_agenda = $_GET["id_agenda"];

$query = "select *, pegawai.nama from agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik WHERE id_agenda = $id_agenda";
$result = mysqli_query($conn, $query);
$k = mysqli_fetch_array($result);

$query1 = mysqli_query($conn, "select * from hasil WHERE id_agenda = $id_agenda");
$k2 = mysqli_fetch_assoc($query1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail k</title>
    <link rel="stylesheet" href="../timeline.css">
</head>

<body>
    <div class="container">
        <div class="text-center"><h3>DETAIL AGENDA</h3></div><br>
        <table class="table">
            <tr>
                <th>JUDUL AGENDA</th>
                <td>: <?php echo $k['judul']; ?></td>
            </tr>
            <tr>
                <th>DESKRIPSI</th>
                <td>: <?php echo $k['deskripsi']; ?></td>
            </tr>
            <tr>
                <th>TANGGAL</th>
                <td>: <?php echo $k['tanggal']; ?></td>
            </tr>
            <tr>
                <th>LOKASI</th>
                <td>: <?php echo $k['lokasi']; ?></td>
            </tr>
            <tr>
                <th>PIMPINAN YANG DIMINTA HADIR</th>
                <td>: <?php echo $k['nama']; ?></td>
            </tr>
            <tr>
                <th>DIINPUT PADA</th>
                <td>: <?php echo $k['timestamp']; ?></td>
            </tr>
            <tr>
                <th>STATUS</th>
                <td>: <?php echo $k['status']; ?></td>
            </tr>
        </table>

        <table class="table" <?php if($k['status']!='Selesai'){echo "hidden"; }?>>
            <tr>
                <th>TANGGAL SELESAI</th>
                <td>: <?php echo $k2['tanggal_selesai']; ?></td>
            </tr>
            <tr>
                <th>KESIMPULAN</th>
                <td>: <?php echo $k2['kesimpulan']; ?></td>
            </tr>
        </table>

        <?php 
        $username = $_SESSION["user"];
        $datax = mysqli_query($conn, "select * from pegawai where username = '$username'");
        $pegawai = mysqli_fetch_assoc($datax);
        ?>

        <form action="" method="post" <?php if($k['status']=='Dilaksanakan' || $k['status']=='Selesai' || $k['nik_pegawai']!=$pegawai['nik']){echo "hidden"; }?>>
        <div class="d-grid gap-2">
            <input type="hidden" name="id_permohonan" value="<?php echo $id_permohonan; ?>">
            <input type="hidden" name="id_agenda" value="<?php echo $k['id_agenda']; ?>">
            <button name="btn_verifikasi" class="btn btn-outline-secondary btn-sm">Verifikasi kehadiran</button>
            <a href="?page=disposisikan&id_agenda=<?php echo $k['id_agenda']; ?>&id_permohonan=<?php echo $id_permohonan; ?>" class="btn btn-outline-secondary btn-sm">Disposisikan</a>
        </div>
    </form>
    
    <form action="" method="post" <?php if($k['status']!='Dilaksanakan' || $k['nik_pegawai']!=$pegawai['nik']){echo "hidden"; }?>>
    <h3>Kesimpulan</h3>
    <div class="d-grid gap-2">
            <input type="hidden" name="id_agenda" value="<?php echo $k['id_agenda']; ?>">
            <textarea name="kesimpulan"></textarea>
            <button name="btn_selesai" class="btn btn-outline-secondary btn-sm">Selesai</button>
    </div>
    </form>

    </div>
    <div class="container">
        <?php 
            $data = mysqli_query($conn, "select * from disposisi where disposisi.id_agenda = $id_agenda");
        ?>
        <div class="row" <?php if(mysqli_num_rows($data) < 1) { echo'hidden'; } ?>>
            <div class="col-md-12">
            <h3>Riwayat perjalanan</h3>
                <div class="card">
                    <div class="card-body">
                        <div id="content">
                            <ul class="timeline">
                            <?php
                                while ($item = mysqli_fetch_array($data)) {
                                ?>
                                    <li class="event" data-date="<?php echo $item['timestamp']; ?>">
                                        <h3><?php echo $item['pegawai_before']; ?> → <?php echo $item['pegawai_after']; ?></h3>
                                        <p>Catatan : <?php echo $item['catatan']; ?></p>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>