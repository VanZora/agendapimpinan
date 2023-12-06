<?php

    if(@$_GET['page']=='agenda'){
        include "agenda.php";
    }
    else if(@$_GET['page']=='dashboard'){
        include "dashboard.php";
    }
    else if(@$_GET['page']=='detailagenda'){
        include "detail.php";
    }
    else if(@$_GET['page']=='tambahagenda'){
        include "tambahagenda.php";
    }
    else if(@$_GET['page']=='editagenda'){
        include "editagenda.php";
    }
    else if(@$_GET['page']=='pegawai'){
        include "pegawai.php";
    }
    else if(@$_GET['page']=='tambahpegawai'){
        include "tambahpegawai.php";
    }
    else if(@$_GET['page']=='editpegawai'){
        include "editpegawai.php";
    }
    else if(@$_GET['page']=='jabatan'){
        include "jabatan.php";
    }
    else if(@$_GET['page']=='tambahjabatan'){
        include "tambahjabatan.php";
    }
    else if(@$_GET['page']=='editjabatan'){
        include "editjabatan.php";
    }
    else if(@$_GET['page']=='hasil'){
        include "hasil.php";
    }
    
    else {
        include "agenda.php";
        //header("location:dashboard.php");
    }
    

    
?>