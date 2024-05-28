<?php
include "Connexion/connexion.php";
session_start();

$verfied = false;

if(isset($_POST['matricule']) && isset($_POST['password'])){
    $matricule_st = $_POST['matricule'];
    $motdepass = $_POST['password'];
    $rq = "SELECT * FROM `student` WHERE `matricule`= '$matricule_st' and `password` = '$motdepass'";
    $result = mysqli_query($id,$rq) or die("ERROR IN REQUEST");
    $res = $result->fetch_assoc();
    if($res != 0){
        $_SESSION['ConnectedAs'] = "student";
        $_SESSION['matricule_student'] = $res['matricule'];
        $_SESSION['date_N'] = $res['ddn'];
        $_SESSION['niveau'] = $res['niveau'];
        $_SESSION['username'] = $res['nom']." ".$res['prenom'];
        $datN = $_SESSION['date_N'];
        $niveau = $_SESSION['niveau'];
        $username = $_SESSION['username'];

        $verfied = true;
    }else{
        echo "<div>WRONG LOGIN</div>";
    }
}elseif($_SESSION['ConnectedAs'] == "student" && isset($_SESSION['matricule_student'])){
        $datN = $_SESSION['date_N'];
        $niveau = $_SESSION['niveau'];
        $username = $_SESSION['username'];
        $matricule_st = $_SESSION['matricule_student'];
        $verfied = true;
}else{
    echo "<div>PARAMETER ERROR</div>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/tables.css">
</head>
<body>
    <?php
        if($verfied){
    ?>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="./manote.php">Mes Notes</a>
            <a href="./deconnect.php?link=student.html">Deconnecter</a>
        </menu>
    </header>
    <div class="presentation">
        <h1>Bonjour etudiant <?php echo "$username";?></h1>
        <h1>Votre matricule <?php echo $matricule_st; ?></h1>
        <p>tu as né en <?php echo $datN; ?></p>
        <p>niveau: <?php echo $niveau; ?></p>
        
    </div>

    <div>
        <h1>Publication : </h1>
    </div>
    <?php
        $rq = "SELECT * FROM `publier` where niveau = '$niveau'";
        $result = mysqli_query($id,$rq) or die("ERROR IN REQUEST");
        while($res = $result->fetch_assoc()){
            echo "<div>";
            $rq_tr = "SELECT nom,prenom FROM `teacher` where matricule = ".$res['matricule_ens'];
            $result_teacher = mysqli_query($id,$rq_tr) or die("ERROR IN REQUEST");
            $teacher_row = $result_teacher->fetch_assoc();
            echo "<p>Enseignant : ".$teacher_row['nom']." ".$teacher_row['prenom']." en ".$res['ddp']."</p>";
            echo "<p>".$res['message']."</p>";
            echo "</div>";
        }
        ?>
    
    <?php } ?>
</html>