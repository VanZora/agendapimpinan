<?php

    if(@$_GET['page']=='agendabaru'){
        $status = "Diajukan";
        $page = "agendabaru";
        include "permohonan.php";
    }
    else if(@$_GET['page']=='disposisi'){
        $status = "Didisposisikan";
        $page = "disposisi";
        include "permohonan.php";
    }
    else if(@$_GET['page']=='detailagenda'){
        include "detail.php";
    }
    else if(@$_GET['page']=='agenda'){
        include "agenda.php";
    }
    else if(@$_GET['page']=='hasil'){
        include "hasil.php";
    }
    else if(@$_GET['page']=='disposisikan'){
        include "disposisi.php";
    }
    else {
        include "agenda.php";
        //header("location:dashboard.php");
    }
    

    
?>