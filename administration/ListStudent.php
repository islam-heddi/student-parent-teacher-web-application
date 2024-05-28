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
    <style>
        form table{
            padding:12px;
            border: 1px solid black;
        }
        form tr,td,th{
            padding:12px;
            border-collapse:collapse;
            border: 1px solid black;

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
        <form>
            <table>
                <tr>
                    <th>
                        Matricule
                    </th>
                    <th>
                        Nom
                    </th>
                    <th>
                        Prenom
                    </th>
                    <th>
                        password
                    </th>
                    <th>
                        Date de naissance
                    </th>
                    <th>
                        niveau
                    </th>
                    <th>
                        Modifier
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>
                <?php
                $rq = "SELECT * FROM `student`";
                $result = mysqli_query($id,$rq) or die("ERROR IN THE REQUEST");
                    while($res = $result->fetch_assoc()){
                        $mat = $res['matricule'];
                        $nom = $res['nom'];
                        $prenom = $res['prenom'];
                        $niv = $res['niveau'];
                        $motdepass = $res['password'];
                        $ddn = $res['ddn'];
                        $params = "mat=$mat&nom=$nom&prenom=$prenom&niv=$niv&password=$motdepass&ddn=$ddn";
                        echo "<tr>";
                        echo "<td>$mat</td>";
                        echo "<td>$nom</td>";
                        echo "<td>$prenom</td>";
                        echo "<td>$motdepass</td>";
                        echo "<td>$ddn</td>";
                        echo "<td>$niv</td>";
                        echo "<td><a href='updateStudent.php?$params'>Modifier</a></td>";
                        echo "<td><a href='deleteStudent.php?$params'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </form>
    </article>
</body>
</html>