<?php ob_start(); $page = "pegawai";
include 'header.php';

require '../function.php';
if (isset($_GET["id"])) {

    if (deletepegawai($_GET) > 0)
        header("location:?page=pegawai");
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
        <a href="?page=tambahpegawai" class="btn btn-outline-secondary btn-sm">Tambah Data Pegawai</a>
    </div><br>

    <div class="table-responsive">
    <table id="example" class="table">
        <thead>
            <tr>
                <th>NIP</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>JABATAN</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $data = mysqli_query($conn, "select *, jabatan.nama_jabatan as jabatan from pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan");

            while ($row = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?php echo $row['nik']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['jabatan']; ?></td>
                    <td><a href="?page=editpegawai&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning"><i class='bx bx-edit nav_icon'></i></a>
                        <a href="?page=pegawai&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger btn-delet"><i class='bx bx-trash nav_icon'></i></a>
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
            title: 'Hapus Pegawai?',
            text: "Menghapus pegawai ini juga akan menghapus data yang berhubungan dengan pegawai ini",
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