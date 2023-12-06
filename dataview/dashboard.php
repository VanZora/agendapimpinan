<?php
include 'header.php';
include "../functionagenda.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Full Calendar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <br>
    <form action="" method="post">
        <input type="text" name="search">
        <button id="search-button" type="submit" class="btn btn-secondary">
            <i class="bx bx-search"></i>
        </button>
    </form>


    <div class="container">
        <div class="card-body lg-6">
            <div id="calendar"></div>
        </div>
    </div>




</body>

<!-- Script Full Calendar -->
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            editable: false,
            events: [
                <?php
                include "../function.php";
                $data = mysqli_query($conn, "select * from agenda");

                while ($k = mysqli_fetch_array($data)) {
                    $title = $k['judul'];
                    $start = $k['listTanggal']; // This should be a valid date format (e.g., '2023-11-03').
                ?> {
                        title: '<?php echo $title; ?>',
                        start: '<?php echo $start; ?>',
                        url: "?page=detail&id='<?php echo $k['id_agenda']; ?>'" // Optional, if you want to link to details.
                    },
                <?php } ?>
            ]
        });
    });
</script>

</html>