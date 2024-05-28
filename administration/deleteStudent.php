<?php
    include "./../Connexion/connexion.php";
    if(isset($_GET['mat'])){
        $mat = $_GET['mat'];
        $rq = "DELETE FROM `student` WHERE matricule = '$mat'";
        mysqli_query($id,$rq) or die("ERROR");
        $rq = "DELETE FROM `note` WHERE matricule_et = '$mat'";
        mysqli_query($id,$rq) or die("ERROR");
        header("Location: ListStudent.php");
    }else{
        echo "BAD REQUEST";
    }

?>