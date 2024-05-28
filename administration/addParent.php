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
        <div>
            <?php
                if(isset($_POST['email']) && isset($_POST['password'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cpassword=$_POST['confirm-password'];
                    $nom = $_POST['nom'];
                    $prenom = $_POST['prenom'];
                    $date = $_POST['date'];
                    $gender =  $_POST['gender'];
                    $tel = $_POST['tel'];
                    $matricule = Random_Matricule_parent();
                    if($password == $cpassword){
                        $rq = "INSERT INTO `parent`(`password`, `matricule`, `ddn`, `nom`, `prenom`, `gender`, `tel`, `reg`, `email`) VALUES ('$password','$matricule','$date','$nom','$prenom','$gender','$tel','OK','$email')";
                        mysqli_query($id,$rq) or die("ERROR : IN THE TABLE");
                        echo "ADDED SUCCESSFULLY La matricule est ".$matricule;
                    }else{
                        echo "<h1>THE PASSWORD DOES NOT MATCH</h1>";
                    }
                }
            ?>
        </div>
        <div id="add" class="ground">
            <p>Taper les informations :</p>
            <form method="post">
                <table>
                    <tr>
                        <td>
                            Nom :
                        </td>
                        <td>
                            <input type="text" name="nom" placeholder="Le nom içi"required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Prénom :
                        </td>
                        <td>
                            <input type="text" name="prenom" placeholder="Le prénom içi"required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date de naissance :
                        </td>
                        <td>
                            <input type="date" min="1900-01-01" max="1995-12-31" name="date" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email :
                        </td>
                        <td>
                            <input type="Email" name="email" placeholder="example@email.com" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mot de passe :
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="**************"required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Retapez Mot de passe :
                        </td>
                        <td>
                            <input type="password" name="confirm-password" placeholder="**************"required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Numero de Telephone :
                        </td>
                        <td>
                            <input type="text" placeholder="0601......." name="tel" id="tel" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Gender :
                        </td>
                        <td>
                            Père <input type="radio" name="gender" value="male" required>
                            Mère <input type="radio" name="gender" value="female" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="butn">
                        </td>
                        <td>
                            <input type="reset" class="butn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </article>

</body>
</html>
