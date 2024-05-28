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
        <div class="ground" id="request">
            <form method="post">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>
                            Nom
                        </th>
                        <th>
                            Prenom
                        </th>
                        <th>
                            date de naissance
                        </th>
                        <th>
                            Genre 
                        </th>
                        <th>
                            Tel
                        </th>
                        <th>
                            Password
                        </th>
                        <th>
                            Matricule
                        </th>
                        <th>Confirmed</th>
                        <th>
                            EMAIL
                        </th>
                    </tr>
                    <?php
                        $req = "SELECT `password`, `matricule`, `ddn`, `nom`, `prenom`, `gender`, `tel`, `reg`, `email` FROM `parent` WHERE `reg` = 'OK'";
                        $Nb_element = 0;
                        $table = mysqli_query($id,$req) or die("ERROR IN REQUESTING");
                        $mat = array();
                        while($row = $table->fetch_assoc()){
                            echo "<tr>
                            <td>".$Nb_element."</td>
                             <td> ".$row["nom"]." </td>
                             "."<td>".$row["prenom"]."</td>
                             "."<td>".$row["ddn"]."</td>
                             "."<td>".$row["gender"]."</td>
                             "."<td>".$row["tel"]."</td>
                             "."<td>".$row["password"]."</td>
                             "."<td>".$row["matricule"]."</td>
                             "."<td>".$row["reg"]."</td>
                             "."<td>".$row["email"]."</td>
                             "."<td><button type='submit' name='remove' value='".$Nb_element."'>remove</button></td>
                             </tr> ";
                             $Nb_element++;
                             $mat[] = $row["matricule"];
                        }
                    ?>
                </table>
            </form>
        </div>
        <?php
            if(isset($_POST['remove'])){
                $index = $_POST['remove'];
        ?>
        <div class="ground" id="delete">
            <p>Est ce que vous ètes sûr d'avoir supprimer ?</p>
            <form method="post">
                <table>
                    <tr>
                        <td>
                            Matricule:
                        </td>
                        <td>
                            <input type="text" maxlength="11" value="<?php echo $mat[$index]; ?>" placeholder="xxxxxxxx" name="matricule" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Supprimer" class="butn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
            }
            if(isset($_POST['matricule'])){
                $req = "DELETE FROM `parent` WHERE `matricule` = ".$_POST['matricule'];
                mysqli_query($id,$req) or die("ERROR IN REQUESTING");
                echo "<h1>REMOVED SUCCESSFULLY</h1>";
            }
        ?>
    </article>
</body>
</html>
