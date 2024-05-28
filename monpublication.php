<?php
include "Connexion/connexion.php";
    session_start();
    $verfied = false;
    if($_SESSION['ConnectedAs'] == "teacher"){
        $verfied = true;
        $mat = $_SESSION['matricule'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Publication</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="teacherLabel.php">retourne au l'accueil</a>
            <a href="publier.php">Publier</a>
        </menu>
    </header> 
    <?php
        $rq = "SELECT * FROM publier WHERE matricule_ens = $mat";
        $result = mysqli_query($id,$rq);
        while($res = $result->fetch_assoc()){
            $id_pub = $res['ID'];
            $ddp = $res['ddp'];
            $message = $res['message'];
            $niveau = $res['niveau'];
            $params = "matricule_ens=$mat&id=$id_pub&date=$ddp&message=$message&niveau=$niveau";
            echo "<div>";
            echo "<p>Publication id :".$res['ID']."</p>";
            echo "<p>Publication: ".$res['message']."</p>";
            echo "<p>Date : ".$res['ddp']."</p>";
            echo "<p>Niveau : ".$res['niveau']."</p>";
            echo "<a href='modifpub.php?$params'>Modifier</a>   ";
            echo "<a href='deletepub.php?$params'>Supprimer</a>";
            echo "</div>";
        }
    ?>
</body>
</html>