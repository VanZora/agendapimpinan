<?php $page = "agenda";
include 'header.php';

require '../function.php';
if (isset($_POST["input"])) {

    if (editagenda($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Data diubah!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='?page=agenda';
            }
        })
        </script>";
    } else {
        echo mysqli_error($conn);
    }
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
    <?php
    $id = $_GET['id_agenda'];
    $data = mysqli_query($conn, "select *, pegawai.nama from agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik where id_agenda='$id'");
    $row = mysqli_fetch_assoc($data);
    ?>
    <form action="" method="post">
        <input name="id_agenda" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['id_agenda']; ?>" required>
        <input name="timestamp" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['timestamp']; ?>" required>
        <input name="nik_pegawai" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['nik_pegawai']; ?>" required>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA PIMPINAN</label>
            <input name="nama" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['nama']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">JUDUL</label>
            <input name="judul" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['judul']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">DESKRIPSI</label>
            <input name="deskripsi" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['deskripsi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">TANGGAL</label>
            <input name="tanggal" type="date" class="form-control" id="validationDefault01" value="<?php echo $row['tanggal']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">STATUS</label>
            <input name="status" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['status']; ?>" required readonly>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" name="input" value="Edit" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>