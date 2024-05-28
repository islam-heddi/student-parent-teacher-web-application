<?php
    include 'Connexion/connexion.php';
    $verified = "NO";
    session_start();
    if(isset($_POST['inscription']) && isset($_POST['password'])){
        $inscription = $_POST['inscription'];
        $password = $_POST['password'];
        $_SESSION['inscription'] = $inscription;
        $_SESSION['password'] = $password;
        if(is_exists_matricule($inscription)){
            $rq = "SELECT * FROM `parent` WHERE password='$password' AND matricule='$inscription'"; 
            $result = mysqli_query($id,$rq) or die("ERROR");
            $row = $result->fetch_assoc();
            if($row != 0 && $row['reg'] != "NO"){
                $verified = "Yes";
                $username = $row['nom']." ".$row['prenom'];
                $ddn = $row['ddn'];
                $phonenumber= $row['tel'];
                $matr = $row['matricule'];
                if($row['gender'] == "male") $genre = "pére";
                else $genre = "mère";
                $email = $row['email'];
                $_SESSION['username'] = $username;
                $_SESSION['ddn'] = $ddn;
                $_SESSION['tel'] = $phonenumber;
                $_SESSION['email'] = $email;
                $_SESSION['matricule'] = $row['matricule'];
                $_SESSION['gender'] = $genre;
            }elseif($row['reg'] == "NO"){
                echo "<div><h1>The admins must confirm your account inorder to login</h1></div>";
            }else{
                echo "<div><h1>Wrong password</h1>";
                echo "password : ".$_POST['password']."</div>";
            }
        }else{
            echo "<div><h1>No matricule or email presented</h1></div>";
        }
    }elseif($_SESSION['inscription'] != 0 && $_SESSION['password'] != 0){
                 $email = $_SESSION['email'];
                 $username = $_SESSION['username'];
                 $ddn = $_SESSION['ddn'];
                 $phonenumber = $_SESSION['tel'];
                 $matr = $_SESSION['matricule'];
                 $verified = "Yes";
                 $genre = $_SESSION['gender'];
    }else{
        header("Location: parent.php");
        die();
    }
    $_SESSION['ConnectedAs'] = "parent";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
</head>
<body>
    <?php if($verified == "Yes"){ ?>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="enfantnote.php">La note d'enfant</a>
            <a href="deconnect.php?link=parent.php">Deconnect</a>
        </menu>
    </header>
    <div class="presentation">
        <h1>Bonjour monsieur <?php echo "$username";?></h1>
        <h1>Votre matricule <?php echo $matr; ?></h1>
        <p>tu as né en <?php echo $ddn; ?></p>
        <p>gender : <?php echo $genre; ?></p>
        <p>Phone number : <?php echo $phonenumber; ?></p>
        <p>Email : <?php echo $email; ?></p>
    </div>
    <div>
        <p>performer des actions par parler avec des enseignants</p>
        <p>Que vous pouvez parler avec qui ?</p>
        <form action="talk.php" method="post">
            <label>Matricule du Maitre(sse) : </label>
            <input type="text" placeholder="xxxxxxxxxx" name="matricule_teacher"><br>
            <label>Votre Matricule : </label>
            <input type="text" value="<?php echo $matr; ?>" name="matricule_parent" readonly>
            <input type="submit" class="buttn" value="Parler">
        </form>
    </div>
    <div>
        <h1>La liste de les maitre </h1>
        <table>
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>date de naissance</th>
                <th>specialité</th>
            </tr>
            <?php
                $rq = "SELECT * FROM `teacher`";
                $result = mysqli_query($id,$rq) or die("ERROR");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>".
                            "<td>".$row['matricule']."</td>".
                            "<td>".$row['nom']."</td>".
                            "<td>".$row['prenom']."</td>".
                            "<td>".$row['ddn']."</td>".
                            "<td>".$row['speciality']."</td></tr>";
                }
            ?>
        </table>
    </div>
    <div>
    <h1>Notifications</h1>
        <p>Contact messagerie : </p>
        <form method="post" action="talk.php">
        <?php
            $rq = "SELECT * FROM `parler` WHERE notifier = 0 AND ennonceur = 'teacher' AND matricule_prt = $matr";
            $result = mysqli_query($id,$rq);
            while($row = $result->fetch_assoc()){
                $mat_teacher = $row['matricule_ens'];
                $rq = "SELECT * FROM `teacher` WHERE matricule = $mat_teacher";
                $res = mysqli_query($id,$rq);
                $row_teacher = $res->fetch_assoc();
                echo "<p style='font-size:17px'>le ".$row['date_message']." : ".$row_teacher['nom']." ".$row_teacher['prenom']." dit '".$row['message']."'</p>";
                echo "<button type='submit' value='$mat_teacher' name='matricule_teacher'>Démarrer la conversation</button>";
            }
        ?>
        </form>
    </div>
<?php } ?>
</body>
</html>