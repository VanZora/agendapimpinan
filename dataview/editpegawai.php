<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["input"])) {

    if (editpegawai($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Data diubah!',
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
    <?php
    $id = $_GET['id'];
    $data = mysqli_query($conn, "select *, jabatan.nama_jabatan from pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where id='$id'");
    $row = mysqli_fetch_assoc($data);
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input name="id" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['id']; ?>" required>
        
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NIP</label>
            <input name="nik" type="number" class="form-control" id="validationDefault01" value="<?php echo $row['nik']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA</label>
            <input name="nama" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">EMAIL</label>
            <input name="email" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">JABATAN</label>
            <select name="id_jabatan" class="form-select" aria-label="Default select example" required>
                <option value="<?php echo $row['id_jabatan']; ?>"><?php echo $row['nama_jabatan']; ?></option>
                <?php
                $item = mysqli_query($conn, "select * from jabatan");
                foreach ($item as $select) { ?>
                    <option value="<?php echo $select['id_jabatan']; ?>"><?php echo $select['nama_jabatan']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">USERNAME</label>
            <input name="username" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">PASSWORD</label>
            <input name="password" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['password']; ?>" required>
        </div>
        <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label>
                <input name="gambar" type="file" class="form-control" id="validationDefault01">
            </div>

        <div class="d-grid gap-2">
            <input type="submit" name="input" value="Edit" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>