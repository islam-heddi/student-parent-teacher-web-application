<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/tables.css">
    <style>
        #selection{
            font-size: 24px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="./index.html">Home</a>
            <a href="./index.html#connect">Connecter</a>
            <a href="inscrire.html">inscrire</a>

        </menu>
    </header>
    <section>
    <div class="center">
        <h1>Inscrivez vous ..</h1>
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
                        <input type="date" min="2015-01-01" max="2020-12-31" name="date" required>
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
                        Niveau :
                    </td>
                    <td>
                        <select id="selection" name="level" required>
                            <option value="01">Niveau 01</option>
                            <option value="02">Niveau 02</option>
                            <option value="03">Niveau 03</option>
                            <option value="04">Niveau 04</option>
                            <option value="05">Niveau 05</option>
                        </select>
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
</section>
<div style="background-color: white;">
<?php
//here is the data base connexion
    include 'Connexion/connexion.php';
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['password']) && isset($_POST['level'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $date = $_POST['date'];
            $password = $_POST['password'];
            $password_confirm = $_POST['confirm-password'];
            $level = $_POST['level'];
            

            $matricule_as_student = Random_Matricule_student();
            if($password == $password_confirm){
                $query = "INSERT INTO `student`(`matricule`, `nom`, `prenom`, `ddn`, `niveau`, `password`) VALUES ('$matricule_as_student','$nom','$prenom','$date','$level','$password')";
                if(mysqli_query($id,$query)) echo "<h1 style='color : green'>ADDED successfully TON MATRICULE d'accés est $matricule_as_student</h1>";
            else echo "ERROR !!";    
        }else{
            echo "<h1 style='color:red'>Mot passe n'est pas valider</h1>";
        }
        
    }
?>
</div>
</body>
</html>