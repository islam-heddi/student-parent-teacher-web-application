<?php
    include "./../Connexion/connexion.php";
    if(isset($_GET['mat'])){
        $mat = $_GET['mat'];
        $rq = "DELETE FROM `teacher` WHERE matricule = $mat";
        mysqli_query($id,$rq) or die("ERROR");
        $rq = "DELETE FROM `publier` WHERE `matricule_ens` = $mat";
        mysqli_query($id,$rq) or die("ERROR");
        $rq = "DELETE FROM `parler` WHERE `matricule_ens` = $mat";
        mysqli_query($id,$rq) or die("ERROR");
        header("Location: ListTeachers.php");
    }else{
        echo "BAD REQUEST";
    }

?>