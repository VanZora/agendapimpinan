<?php $page = "jabatan";
include 'header.php';

require '../function.php';
if (isset($_GET["id_jabatan"])) {

    if (deletejabatan($_GET) > 0)
        header("location:?page=jabatan");
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
    <div class="d-grid gap-2">
        <a href="?page=tambahjabatan" class="btn btn-outline-secondary btn-sm">Tambah Agenda</a>
    </div><br>

    <div class="table-responsive">
    <table id="example" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>ID JABATAN</th>
                <th>NAMA JABATAN</th>
                <th>LEVEL</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $data = mysqli_query($conn, "select * from jabatan");

            while ($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?php echo $row['id_jabatan']; ?></td>
                    <td><?php echo $row['nama_jabatan']; ?></td>
                    <td><?php echo $row['level']; ?></td>
                    <td><a href="?page=editjabatan&id_jabatan=<?php echo $row['id_jabatan']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?page=jabatan&id_jabatan=<?php echo $row['id_jabatan']; ?>" class="btn btn-sm btn-danger btn-delet">Hapus</a>
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
            title: 'Hapus Jabatan?',
            text: "Menghapus jabatan ini juga akan menghapus data yang berhubungan dengan jabatan ini",
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