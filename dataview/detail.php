<?php ob_start(); 
include 'header.php';
include "../function.php";


// Pastikan parameter "id" dikirimkan melalui URL
if (isset($_GET["id_agenda"])) {
    $id = $_GET["id_agenda"];

    $query = "select *, pegawai.nama from agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik where id_agenda = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $k = mysqli_fetch_array($result);
    } else {
        echo "Error: " . mysqli_error($conn); // Menampilkan pesan kesalahan SQL
    }

    $query1 = mysqli_query($conn, "select * from hasil WHERE id_agenda = $id");
    $k2 = mysqli_fetch_assoc($query1);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../timeline.css">
    <title>Detail k</title>

</head>

<body>
    <div class="container">
        <button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back'></i></button><br><br>
        <div class="text-center">
            <h3>DETAIL AGENDA</h3>
        </div><br>
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
        <br>
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
            $data = mysqli_query($conn, "select * from disposisi where disposisi.id_agenda = $id");
        ?>
        <div class="row" <?php if(mysqli_num_rows($data) < 1) { echo'hidden'; } ?>>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Riwayat perjalanan</h3>
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
</body>

</html>