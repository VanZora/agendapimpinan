<?php $page = "agenda";
include 'header.php';

require '../function.php';
if (isset($_GET["id_agenda"])) {

    if (deleteagenda($_GET) > 0)
        header("location:?page=agenda");
    else
        echo mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Document</title>
</head>

<body>
    <?php
    $username = $_SESSION["user"];

    $data1 = mysqli_query($conn, "select *, jabatan.nama_jabatan from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan where username = '$username'");
    $result = mysqli_fetch_assoc($data1);
    ?>
    <div class="row">
        <div class="col">
            <td>
                <blockquote class="quote-info mt-0 bayangan">
                    <h5 id="tip">Selamat Datang! <?php echo $result['nama']; ?></h5>
                    <p><?php echo $result['nama_jabatan']; ?> </p>
                </blockquote>
            </td>
        </div>
        <div class="col">
            <td>
                <blockquote class="quote-orange mt-0 bayangan">
                    <h5 id="tip">Tanggal </h5>
                    <p><?php echo date("m/d/Y"); ?></p>
                </blockquote>
            </td>
        </div>
    </div>
    <div class="container">
        <div class="d-grid gap-2">
            <a onclick="show()" class="btn btn-secondary btn-sm"><i class='bx bx-calendar nav_icon'></i> </a>
        </div><br>
        <div class="table-responsive" id="the-table">
            <table id="example" class="table table-striped border-light-subtle">
                <thead>
                    <tr>
                        <th>ID AGENDA</th>
                        <th>JUDUL</th>
                        <th>DESKRIPSI</th>
                        <th>LIST TANGGAL</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $user = $result['nik'];

                    //$dataa = mysqli_query($conn, "select *, pegawai.nama from agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik where nik_pegawai='$user' and status='Dilaksanakan'");
                    $data = mysqli_query($conn, "select *, agenda.*, pegawai.nama from undangan INNER JOIN agenda ON undangan.id_agenda = agenda.id_agenda INNER JOIN pegawai ON undangan.nik_pegawai = pegawai.nik where undangan.nik_pegawai='$user' and status='Dilaksanakan'");
                    while ($row = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td><?php echo $row['id_agenda']; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><a href="?page=detailagenda&id_agenda=<?php echo $row['id_agenda']; ?>" class="btn btn-sm btn-primary">Detail</a>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="the-calendar">
            <div class="card-body lg-6">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</body>

<script>
    let mode = 1;
    $("#the-table").hide();
    $("#the-calendar").show();

    function show() {

        if (mode == 1) {
            $("#the-calendar").hide();
            $("#the-table").show();
            mode = 2;
        } else {
            $("#the-calendar").show();
            $("#the-table").hide();
            mode = 1;
        }
    }

    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            editable: false,
            events: [
                <?php
                $data = mysqli_query($conn, "select *, agenda.*, pegawai.nama from undangan INNER JOIN agenda ON undangan.id_agenda = agenda.id_agenda INNER JOIN pegawai ON undangan.nik_pegawai = pegawai.nik where undangan.nik_pegawai='$user' and status='Dilaksanakan'");

                while ($k = mysqli_fetch_array($data)) {
                    $title = $k['judul'];
                    $start = $k['tanggal']; // This should be a valid date format (e.g., '2023-11-03').
                ?> {
                        title: '<?php echo $title; ?>',
                        start: '<?php echo $start; ?>',
                        url: "?page=detailagenda&id_agenda='<?php echo $k['id_agenda']; ?>'" // Optional, if you want to link to details.
                    },
                <?php } ?>
            ]
        });
    });
</script>

</html>