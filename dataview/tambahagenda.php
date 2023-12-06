<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["tambah"])) {

    if (tambahagenda($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Agenda telah ditambahkan!',
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
    <button class="btn btn-outline-secondary btn-sm" onclick="history.back()"><i class='bx bx-arrow-back'></i></button><br><br>
    <form action="" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA PIMPINAN</label>
            <select name="nik_pegawai" class="form-select" aria-label="Default select example" required>
                <option value="dimas123">Pilih Pimpinan</option>
                <?php
                $data = mysqli_query($conn, "select *, jabatan.* from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan");
                foreach ($data as $row) { ?>
                    <option value="<?php echo $row['nik']; ?>"><?php echo $row['nama']; ?> - <?php echo $row['nama_jabatan']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">JUDUL</label>
            <input name="judul" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">DESKRIPSI</label>
            <input name="deskripsi" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">TANGGAL</label>
            <input name="tanggal" type="date" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">LOKASI</label>
            <input name="lokasi" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">PESAN</label>
            <input name="pesan" type="text" class="form-control" id="validationDefault01" required>
        </div>

        <div class="d-grid gap-2">
            <input type="submit" name="tambah" value="Tambahkan" class="btn btn-secondary btn-sm" type="button">
        </div><br><br>
    </form>
</body>

</html>