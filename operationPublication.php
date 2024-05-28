<?php
    include "Connexion/connexion.php";
    session_start();
    if(isset($_POST['publication'])){
        $publication = $_POST['publication'];
        $niveau = $_POST['niveau'];
        $matricule_enseignant = $_SESSION['matricule'];
        $date = date("y-m-d");
        $identification = Random_identification_pub();
        $rq = "INSERT INTO `publier`(`matricule_ens`, `message`, `ddp`, `niveau`, `ID`) VALUES ('$matricule_enseignant','$publication','$date','$niveau','$identification')";
        mysqli_query($id,$rq) or die("ERROR IN REQUEST");
        header("Location: publier.php");
      }
?>