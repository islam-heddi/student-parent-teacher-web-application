<?php
    include "Connexion/connexion.php";
    if(isset($_GET['id'])){
        $id_pb = $_GET['id'];
        $rq = "DELETE FROM `publier` WHERE `ID` = $id_pb";
        mysqli_query($id,$rq) or die("ERROR IN REQUEST");
        header("Location: monpublication.php");
    }
?>