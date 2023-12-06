<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="adminlte.min.css_v=3.2.0">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>

<?php
require 'function.php';

?>

<body style="background-color: #CFE5F1">
    <div class="registration-form">
        
        <form action="" method="post" enctype="multipart/form-data">
        <div style="text-align:center">
            <h1>Registrasi Admin</h1>
        </div><br>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input name="username" type="text" class="form-control" id="validationDefault01" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="validationDefault01" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                <input name="password2" type="password" class="form-control" id="validationDefault01" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto</label>
                <input name="gambar" type="file" class="form-control" id="validationDefault01" required>
            </div>

            <div class="d-grid gap-2">
                <input type="submit" name="register" value="Registrasi" class="btn btn-secondary btn-sm" type="button">
            </div><br>

            <div class="d-grid gap-2">
                <a href="login.php" name="register" value="Registrasi" class="btn btn-outline-secondary btn-sm" type="button">Kembali</a>
            </div>
        </form>

    </div>
</body>

<?php

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Registrasi Berhasil!',
            'User telah ditambahkan!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                window.location='login.php';
            }
        })
        </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

</html>