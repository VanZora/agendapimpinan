<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["tambah"])) {

    if (tambahpegawai($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Pegawai telah ditambahkan!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='?page=pegawai';
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
    <form action="" method="post" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NIP</label>
            <input name="nik" type="number" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA</label>
            <input name="nama" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">EMAIL</label>
            <input name="email" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">JABATAN</label>
            <select name="id_jabatan" class="form-select" aria-label="Default select example" required>
                <option value="333">Pilih Jabatan</option>
                <?php
                $data = mysqli_query($conn, "select * from jabatan");
                foreach ($data as $row) { ?>
                    <option value="<?php echo $row['id_jabatan']; ?>"><?php echo $row['nama_jabatan']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">USERNAME</label>
            <input name="username" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">PASSWORD</label>
            <input name="password" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label>
                <input name="gambar" type="file" class="form-control" id="validationDefault01" required>
            </div>

        <div class="d-grid gap-2">
            <input type="submit" name="tambah" value="Tambahkan" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>