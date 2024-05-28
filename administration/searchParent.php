<?php
    include './../Connexion/connexion.php';
    session_start();
    if(isset($_SESSION['admin_verification'])){
        if($_SESSION['admin_verification'] == false){
            echo "<h1>PERMISSION DENIED</h1>";
            exit();
        }
    }elseif(!isset($_SESSION['admin_verification'])){
        echo "<h1>PERMISSION DENIED</h1>";
            exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome in admin panel</title>
    <link rel="shortcut icon" href="./../fonts/marteaux.png" type="image/x-icon">
    <link rel="stylesheet" href="./../styles/admin-style.css">

    <style type="text/css">
        #request table{
            border-collapse: collapse;
            border: 1px solid black;
        }

        #request tr,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <header>
    <a href="ListStudent.php">Etudiant</a>
        <a href="ListTeachers.php">Engseignant</a>
        <a href="addrequestParent.php">Parent</a>
        <a href="./../deconnect.php?link=adminpanel.html">Deconnect</a>

    </header>
    <article>
        <div class="choice">
            <a href="addrequestParent.php"><button id="sel-btn1">Ajouter un parent par une reqûete</button></a>
            <a href="addParent.php"><button id="sel-btn2">Ajouter un parent</button></a>
            <a href="modifyParent.php"><button id="sel-btn3">Modifier un parent</button></a>
            <a href="deleteParent.php"><button id="sel-btn4">Supprimer un parent</button></a>
            <a href="searchParent.php"><button id="sel-btn5">Rechercher un parent</button></a>
        </div>
        <div class="ground" id="search">
            <form method="post">
                <table>
                    <tr>
                        <td>
                            Matricule :
                        </td>
                        <td>
                        <input type="text" maxlength="11" placeholder="xxxxxxxx" name="matricule">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="rechercher" class="butn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
            <?php
                if(isset($_POST['matricule'])){
                    $req = "SELECT `matricule`, `ddn`, `nom`, `prenom`, `gender`, `tel`, `reg`, `email` FROM `parent` WHERE `matricule` = ".$_POST['matricule'];
                    $result = mysqli_query($id,$req) or die("ERROR IN REQUESTING");
                        $row = $result->fetch_assoc();
                    if(!$row){ echo "<h1>Il y'a pas qui a cette matricule</h1>";
                    }else{
            ?>
            <form>
                <p>Nom : <?php echo $row['nom']; ?></p>
                <p>Prènom : <?php echo $row['prenom']; ?></p>
                <p>Date de naissance : <?php echo $row['ddn']; ?></p>
                <p>Genre : <?php echo $row['gender']; ?></p>
                <p>Numéro de téléphone : <?php echo $row['tel']; ?></p>
                <p>Email : <?php echo $row['email']; ?></p>
                <p>Confirmé : <?php echo $row['reg']; ?></p>
            </form>
        <?php }
            }?>
    </article>
</body>
</html>
