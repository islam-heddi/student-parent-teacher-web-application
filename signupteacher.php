<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enseigants</title>
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/tables.css">
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
                        <input type="date" min="1900-01-01" max="2000-12-31" name="date" required>
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
                        specialité :
                    </td>
                    <td>
                        <input type="text" placeholder="specialitées ..." name="speciality" required>
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
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) && isset($_POST['tel'] ) && isset($_POST['password'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $tel = $_POST['tel'];
            $date = $_POST['date'];
            $password = $_POST['password'];
            $password_confirm = $_POST['confirm-password'];
            $speciality = $_POST['speciality'];
            
            $matricule_as_teacher = Random_Matricule_teacher();
            if($password == $password_confirm){
                $query = "INSERT INTO `teacher`(`matricule`, `password`, `nom`, `prenom`, `ddn`, `speciality`, `tel`) VALUES ('$matricule_as_teacher','$password','$nom','$prenom','$date','$speciality','$tel')";
                if(mysqli_query($id,$query)) echo "<h1 style='color : green'>ADDED successfully TON MATRICULE d'accés est $matricule_as_teacher</h1>";
            else echo "ERROR !!";    
        }else{
            echo "<h1 style='color:red'>Mot passe n'est pas valider</h1>";
        }
        
    }
?>
</div>
</body>
</html>