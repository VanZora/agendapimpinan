<?php $page = "dashboard";
include 'header.php';

require '../function.php';
if (isset($_POST["tambah"])) {

    if (disposisikan($_POST) > 0) {
        echo "<script>
        Swal.fire(
            'Berhasil!',
            'Agenda telah didisposisikan!',
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
    
    <?php
        $id_agenda = $_GET['id_agenda'];
        $id_permohonan = $_GET['id_permohonan'];
        $data1 = mysqli_query($conn, "select * from agenda where id_agenda = '$id_agenda'");
        $result = mysqli_fetch_assoc($data1);
        $nik_pegawai = $result['nik_pegawai'];
    ?>
    
    <form action="" method="post" id="myForm">
        <input type="hidden" name="id_agenda" value="<?php echo $id_agenda; ?>">
        <input type="hidden" name="id_permohonan" value="<?php echo $id_permohonan; ?>">
        <input type="hidden" name="nik_pegawai" value="<?php echo $nik_pegawai; ?>">
        <input type="hidden" name="nik_pegawai" value="<?php echo $nik_pegawai; ?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">NAMA PIMPINAN PERWAKILAN</label>
            <select name="nik_perwakilan" class="form-select" aria-label="Default select example" required>
                <option value="<?php echo $nik_pegawai; ?>">Pilih Perwakilan</option>
                <?php
                $data = mysqli_query($conn, "select * from pegawai inner join jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where pegawai.nik = '$nik_pegawai'");
                $hasil = mysqli_fetch_assoc($data);
                $level = $hasil['level'];
                $datax = mysqli_query($conn, "select * from pegawai inner join jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where jabatan.level > '$level'");
                foreach ($datax as $row) { ?>
                    <option value="<?php echo $row['nik']; ?>"><?php echo $row['nama']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CATATAN</label>
            <input name="catatan" type="text" class="form-control" id="validationDefault01" required>
        </div>
        <div class="d-grid gap-2">
            <input type="submit" name="tambah" value="Tambahkan" class="btn btn-secondary btn-sm btn-ganti" type="button">
        </div><br><br>
    </form>
</body>

<script>
    $('.btntes').on('click', function(e) {
        var form = document.querySelector("#myForm");
        
        alert("sdsds");
        form.submit();
    });
</script>
</html>