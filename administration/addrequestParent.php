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
            <form>
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
                        $Nb_element = 0;
                        $req = "SELECT `password`, `matricule`, `ddn`, `nom`, `prenom`, `gender`, `tel`, `reg`, `email` FROM `parent` WHERE `reg` = 'NO'";
                        $table = mysqli_query($id,$req) or die("ERROR IN REQUESTING");
                        if($table != null){
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
                                 "."<td><button type='submit' name='add' value='".$Nb_element."'>ADD</button></td>
                                 "."<td><button type='submit' name='remove' value='".$Nb_element."'>REMOVE</button></td>"."
                                 </tr> ";
                                 $Nb_element++;
                                 $mat[] = $row["matricule"];
                            }
                        }

                    ?>
                </table>
            </form>
        </div>
    </article>
    <h1>
        <?php
            if(isset($_GET['add'])){
                $index = $_GET['add'];
                $rq = "UPDATE `parent` SET `reg` = 'OK' WHERE `matricule` = ".$mat[$index];
                mysqli_query($id,$rq) or die("ERROR IN REQUEST");
                echo "ADDED SUCCESSFULLY matricule : ".$mat[$index];
                header("Location: ./../admin.php");
            }elseif (isset($_GET['remove'])) {
                $index = $_GET['remove'];
                $rq = "DELETE FROM `parent`WHERE `matricule` = ".$mat[$index];
                mysqli_query($id,$rq) or die("ERROR IN REQUEST");
                echo "REMOVED SUCCESSFULLY matricule : ".$mat[$index];
                header("Location: ./../admin.php");

            }

        ?>
    </h1>
</body>
</html>
