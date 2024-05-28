<?php
    include "Connexion/connexion.php";
    session_start();
    $verified = false;
    if(isset($_POST['Matricule']) && isset($_POST['password'])){
        $matricule_teacher = $_POST['Matricule'];
        $pwd = $_POST['password'];
        $_SESSION['inscription'] = $matricule_teacher;
        $_SESSION['password'] = $pwd;
        if(is_exists_matricule_teacher($matricule_teacher) && check_password_matricule_teacher($matricule_teacher,$pwd)){
            $row = Return_Teacher_Row($matricule_teacher);
            $_SESSION['ConnectedAs'] = "teacher";
            $_SESSION['password'] = $row['password'];
            $_SESSION['username'] = $row['nom'] ." ".$row['prenom'];
            $_SESSION['speciality'] = $row['speciality'];
            $_SESSION['matricule'] = $matricule_teacher;
            $_SESSION['ddn'] = $row['ddn'];
            $_SESSION['tel'] = $row['tel'];
            $username = $_SESSION['username'];
            $matr = $_SESSION['matricule'];
            $ddn = $_SESSION['ddn'];
            $tel = $_SESSION['tel'];
            $speciality = $_SESSION['speciality'];
            $verified = true;
        }else{
            echo "<div>PROBLEM IN LOGIN</div>";
        }
    }elseif($_SESSION['inscription'] != 0 && $_SESSION['password'] != 0){
        $username = $_SESSION['username'];
        $matr = $_SESSION['matricule'];
        $ddn = $_SESSION['ddn'];
        $tel = $_SESSION['tel'];
        $speciality = $_SESSION['speciality'];
        $verified = true;
    }else{
        header("Location: teacher.html");  
        $verified = false;
    }
    $_SESSION['ConnectedAs'] = "teacher";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseignant</title>
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/tables.css">
</head>
<body>
    <?php
        if($verified == true){
    ?>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="./deconnect.php?link=teacher.html">Deconnecter</a>
            <a href="./publier.php">Publier</a>
            <a href="./noter.php">Noter</a>
        </menu>
    </header>
    <div class="presentation">
        <h1>Bonjour monsieur <?php echo "$username";?></h1>
        <h1>Votre matricule <?php echo $matr; ?></h1>
        <p>tu as né en <?php echo $ddn; ?></p>
        <p>specialité : <?php echo $speciality; ?></p>
        <p>Phone number : <?php echo $tel; ?></p>
    </div>
    <div>
        <p>Contacte un parent : </p> 
        <form method="post" action="talkTeacher.php">
            <label>Matricule du parent :</label>
            <input type="text" placeholder="xxxxxxxxx" name="matricule_parent" required>
            <input type="submit" class="butn">
        </form>
    </div>
    <div>
        <h1>Notifications</h1>
        <p>Contact messagerie : </p>
        <form method="post" action="talkTeacher.php">
        <?php
            $rq = "SELECT * FROM `parler` WHERE notifier = 0 AND ennonceur = 'parent' AND matricule_ens = $matr";
            $result = mysqli_query($id,$rq);
            while($row = $result->fetch_assoc()){
                $mat_parent = $row['matricule_prt'];
                $rq = "SELECT * FROM `parent` WHERE matricule = $mat_parent";
                $res = mysqli_query($id,$rq);
                $row_parent = $res->fetch_assoc();
                echo "<p style='font-size:17px'>le ".$row['date_message']." : ".$row_parent['nom']." ".$row_parent['prenom']." dit '".$row['message']."'</p>";
                echo "<button type='submit' value='$mat_parent' name='matricule_parent'>Démarrer la conversation</button>";
            }
        ?>
        </form>
    </div>
    <?php } ?>
</body>
</html>