<?php ob_start(); $page = "hasil";
include 'header.php';

require '../function.php';
if (isset($_GET["id_agenda"])) {

    if (deleteagenda($_GET) > 0)
        header("location:?page=hasil");
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
    <div class="text-center">
        <h3>HASIL RAPAT</h3>
    </div>
    <div class="table-responsive">
    <table id="example" class="table table-striped border-light-subtle">
        <thead>
            <tr>
                <th>JUDUL AGENDA</th>
                <th>PIMPINAN YANG BERHADIR</th>
                <th>TANGGAL SELESAI</th>
                <th>KESIMPULAN</th>
                <th>AKSI</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $username = $_SESSION["user"];

            $data1 = mysqli_query($conn, "select * from pegawai where username = '$username'");
            $result = mysqli_fetch_assoc($data1);
            $user = $result['nik'];

            $data = mysqli_query($conn, "select *, agenda.*, pegawai.nama from undangan INNER JOIN agenda ON undangan.id_agenda = agenda.id_agenda INNER JOIN pegawai ON undangan.nik_pegawai = pegawai.nik where undangan.nik_pegawai='$user' and agenda.nik_pegawai!='$user' and status='Selesai' or undangan.nik_pegawai='$user' and agenda.nik_pegawai='$user' and status!='Dilaksanakan'");
            $pilah = mysqli_fetch_assoc($data);
            $id_agenda = "";

            if(mysqli_num_rows($data) > 0){
                $id_agenda = $pilah['id_agenda'];
            }

            $data2s = mysqli_query($conn, "select hasil.*, agenda.judul, agenda.nik_pegawai, pegawai.nama from hasil INNER JOIN agenda ON hasil.id_agenda = agenda.id_agenda INNER JOIN pegawai ON agenda.nik_pegawai = pegawai.nik where agenda.id_agenda='$id_agenda'");
            
                    
            //$data = mysqli_query($conn, "select hasil.*, agenda.judul, agenda.nik_pegawai from agenda INNER join hasil ON hasil.id_agenda = agenda.id_agenda INNER JOIN undangan ON undangan.nik_pegawai = agenda.nik_pegawai where undangan.nik_pegawai='$user'");

            while ($row = mysqli_fetch_array($data2s)) { ?>
                <tr>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tanggal_selesai']; ?></td>
                    <td><?php echo $row['kesimpulan']; ?></td>
                    <td><a href="?page=detailagenda&id_agenda=<?php echo $row['id_agenda']; ?>" class="btn btn-sm btn-primary"><i class='bx bx-detail nav_icon'></i></a> 
                    <a href="?page=agenda&id_agenda=<?php echo $row['id_agenda']; ?>" class="btn btn-sm btn-danger btn-delet"><i class='bx bx-trash nav_icon'></i></a>
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
            title: 'Hapus Agenda?',
            text: "Menghapus agenda ini juga akan menghapus agenda yang sudah dikirim ke pimpinan",
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