<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["tambah"])) {

    if (tambahjabatan($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Jabatan telah ditambahkan!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='?page=jabatan';
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
    <button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back'></i></button><br><br>
    <form action="" method="post">
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">ID JABATAN</label>
            <input name="id_jabatan" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA JABATAN</label>
            <input name="nama_jabatan" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">LEVEL</label>
            <input name="level" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="d-grid gap-2">
            <input type="submit" name="tambah" value="Tambahkan" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>