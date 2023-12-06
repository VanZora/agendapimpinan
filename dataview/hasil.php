<?php $page = "hasil";
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
    <title>Document</title>
</head>

<body>
    <div class="text-center">
        <h3>HASIL RAPAT</h3>
    </div>
    <div class="table-responsive">
    <table id="example" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>JUDUL AGENDA</th>
                <th>NAMA PEGAWAI</th>
                <th>TANGGAL SELESAI</th>
                <th>KESIMPULAN</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $data = mysqli_query($conn, "select hasil.*, agenda.judul, agenda.nik_pegawai, pegawai.nama from hasil INNER JOIN agenda ON hasil.id_agenda = agenda.id_agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik");

            while ($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tanggal_selesai']; ?></td>
                    <td><?php echo $row['kesimpulan']; ?></td>
                    <td><a href="?page=detailagenda&id_agenda=<?php echo $row['id_agenda']; ?>" class="btn btn-sm btn-primary">Detail</a> <a href="?page=agenda&id_agenda=<?php echo $row['id_agenda']; ?>" class="btn btn-sm btn-danger btn-delet">Hapus</a>
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
            title: 'Hapus Agenda?',
            text: "Menghapus agenda ini juga akan menghapus agenda yang sudah dikirim ke pimpinan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batalkan',
            confirmButtonText: 'Ya Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    })
</script>

</html>