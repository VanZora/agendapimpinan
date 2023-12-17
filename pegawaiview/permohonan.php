<?php ob_start(); 
include 'header.php';

require '../function.php';
if (isset($_GET["id"])) {

    if (deleteAjuan($_GET) > 0)
        header("location:?page=permohonan");
    else
        echo mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="text-center">
        <h3>PERMOHONAN AGENDA</h3>
    </div>
    <br>
    <div class="table-responsive">
        <table id="example" class="table table-striped border-light-subtle">
            <thead>
                <tr>
                    <th>WAKTU DITERIMA</th>
                    <th>JUDUL</th>
                    <th>PESAN</th>
                    <th>TANGGAL AGENDA</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $username = $_SESSION["user"];

                $data1 = mysqli_query($conn, "select * from pegawai where username = '$username'");
                $result = mysqli_fetch_assoc($data1);
                $user = $result['nik'];
                $data = mysqli_query($conn, "select permohonan.*, agenda.id_agenda, agenda.timestamp, agenda.judul, agenda.tanggal from permohonan INNER JOIN agenda ON permohonan.id_agenda = agenda.id_agenda INNER JOIN pegawai ON permohonan.nik_pegawai = pegawai.nik where permohonan.nik_pegawai = '$user' and agenda.status='$status'");

                while ($row = mysqli_fetch_array($data)) { ?>
                    <tr>
                        <td><?php echo $row['timestamp']; ?></td>
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['pesan']; ?></td>
                        <td><?php echo $row['tanggal']; ?></td>
                        <td><a href="?page=detailagenda&id_agenda=<?php echo $row['id_agenda']; ?>&id_permohonan=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Detail</a>
                            <a href="?page=permohonan&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-delet">Abaikan</a>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    $('.btn-delet').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        Swal.fire({
            title: 'Tolak Permohonan?',
            text: "Anda akan menolak undangan agenda ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Kembalikan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    })
</script>

</html>