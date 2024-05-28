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
</head>
<body>
    <header>
        <a href="ListStudent.php">Etudiant</a>
        <a href="ListTeachers.php">Engseignant</a>
        <a href="addrequestParent.php">Parent</a>
        <a href="./../deconnect.php?link=adminpanel.html">Deconnect</a>

    </header>
    <article>
        <?php
            if(isset($_GET['mat'])){
                $mat = $_GET['mat'];
                $nom = $_GET['nom'];
                $prenom = $_GET['prenom'];
                $speciality = $_GET['speciality'];
                $password = $_GET['password'];
                $ddn = $_GET['ddn'];
                $tel = $_GET['tel'];
        ?>
        <form>
            <table>
                <tr>
                    <td>
                        Matricule :
                    </td>
                    <td>
                        <input type="text" name="matricule" value="<?php echo $mat; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nom :
                    </td>
                    <td>
                        <input type="text" value="<?php echo $nom; ?>" name="nom" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Prenom :
                    </td>
                    <td>
                        <input type="text" value="<?php echo $prenom; ?>" name="prenom" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        password :
                    </td>
                    <td>
                        <input type="password" value="<?php echo $password; ?>" name="password" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        speciality :
                    </td>
                    <td>
                        <input type="text" value="<?php echo $speciality; ?>" name="speciality" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        date de naissance :
                    </td>
                    <td>
                        <input type="date" min="1900-01-01" max="2000-12-31" value="<?php echo $ddn; ?>" name="ddn" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Téléphone :
                    </td>
                    <td>
                        <input type="text" value="<?php echo $tel; ?>" name="tel" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Modifier">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php }?>
        <?php 
            if(isset($_GET['matricule'])){
                $mat = $_GET['matricule'];
                $nom = $_GET['nom'];
                $prenom = $_GET['prenom'];
                $speciality = $_GET['speciality'];
                $password = $_GET['password'];
                $ddn = $_GET['ddn'];
                $tel = $_GET['tel'];
                $rq = "UPDATE `teacher` SET `password`='$password',`nom`='$nom',`prenom`='$prenom',`ddn`='$ddn',`speciality`='$speciality',`tel`='$tel' WHERE matricule = $mat";
                mysqli_query($id,$rq) or die("error in the request");
                echo "<div>MODIFICATION succés</div>";
            }
        ?>
    </article>
</body>
</html>
