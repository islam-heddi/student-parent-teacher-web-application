<?php
    include "Connexion/connexion.php";
    if(isset($_GET['id'])){
        $id_pub = $_GET['id'];
        $message = $_GET['publication'];
        $niveau = $_GET['niveau'];
        $rq = "UPDATE `publier` SET `message`='$message',`niveau`='$niveau' WHERE ID = $id_pub";
        mysqli_query($id,$rq) or die("ERROR IN THE REQUEST");
        header("Location: monpublication.php");
    }else{
        echo "<div>PARAMETERS INVALID</div>";
    }

?>