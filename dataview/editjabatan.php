<?php $page = "jabatan";
include 'header.php';

require '../function.php';
if (isset($_POST["input"])) {

    if (editjabatan($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Data diubah!',
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
    <?php
    $id = $_GET['id_jabatan'];
    $data = mysqli_query($conn, "select * from jabatan where id_jabatan='$id'");
    $row = mysqli_fetch_assoc($data);
    ?>
    <form action="" method="post">
        <input name="id_jabatan2" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['id_jabatan']; ?>" required>
        
        <div class="mb-3">
            <input name="id_jabatan" type="hidden" class="form-control" id="validationDefault01" value="<?php echo $row['id_jabatan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA JABATAN</label>
            <input name="nama_jabatan" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['nama_jabatan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">LEVEL</label>
            <input name="level" type="text" class="form-control" id="validationDefault01" value="<?php echo $row['level']; ?>" required>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" name="input" value="Edit" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>