<?php
    include "Connexion/connexion.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes note</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/tables.css">
</head>
<body>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="./studentLabel.php">Retourne au l'accueil</a>
        </menu>
    </header>
    <?php
        if($_SESSION['ConnectedAs'] == "student"){
            $mat = $_SESSION['matricule_student'];
            $rq = "SELECT * FROM note where trimestre = '1' and matricule_et = $mat";
            $result = mysqli_query($id,$rq) or die("ERROR in request");
            $res1 = $result->fetch_assoc();
            $rq = "SELECT * FROM note where trimestre = '2' and matricule_et = $mat";
            $result = mysqli_query($id,$rq) or die("ERROR in request");
            $res2 = $result->fetch_assoc();
            $rq = "SELECT * FROM note where trimestre = '3' and matricule_et = $mat";
            $result = mysqli_query($id,$rq) or die("ERROR in request");
            $res3 = $result->fetch_assoc();
            ?>
        <div>
            
            <?php
                if($res1 == 0 && $res2 == 0 && $res3 == 0) echo "<h1>Vous note ne sont pas disponibles </h1>";
                else echo "<h1>Voici vos note : </h1>";
            ?>
            <?php if($res1 !=0) {?>
            <h1>Trimestre 1</h1>
            <p>Histoire geographique : <?php echo $res1['note_hg']; ?></p>
            <p>Mathematique : <?php echo $res1['note_math']; ?></p>
            <p>Science physique : <?php echo $res1['note_sp']; ?></p>
            <p>Français : <?php echo $res1['note_fr']; ?></p>
            <p>Anglaise : <?php echo $res1['note_en']; ?></p>
            <h1>Moyenne :
            <?php
                $hg = $res1['note_hg'];
                $math = $res1['note_math'];
                $sp = $res1['note_sp'];
                $fr = $res1['note_fr'];
                $en = $res1['note_en'];
                
                $moyenne = ($hg + $math + $sp + $fr + $en) / 5;

                echo $moyenne;
            ?>
            </h1>
            <?php } ?>
            <?php if($res2 !=0) { ?>
            <h1>Trimestre 2</h1>
            <p>Histoire geographique : <?php echo $res2['note_hg']; ?></p>
            <p>Mathematique : <?php echo $res2['note_math']; ?></p>
            <p>Science physique : <?php echo $res2['note_sp']; ?></p>
            <p>Français : <?php echo $res2['note_fr']; ?></p>
            <p>Anglaise : <?php echo $res2['note_en']; ?></p>
            <h1>Moyenne :
            <?php
                $hg = $res2['note_hg'];
                $math = $res2['note_math'];
                $sp = $res2['note_sp'];
                $fr = $res2['note_fr'];
                $en = $res2['note_en'];
                
                $moyenne = ($hg + $math + $sp + $fr + $en) / 5;

                echo $moyenne;
            ?>
            </h1>
            <?php } ?>
            <?php if($res3 !=0) {?>
            <h1>Trimestre 3</h1>
            <p>Histoire geographique : <?php echo $res3['note_hg']; ?></p>
            <p>Mathematique : <?php echo $res3['note_math']; ?></p>
            <p>Science physique : <?php echo $res3['note_sp']; ?></p>
            <p>Français : <?php echo $res3['note_fr']; ?></p>
            <p>Anglaise : <?php echo $res3['note_en']; ?></p>
            <h1>Moyenne :
            <?php
                $hg = $res3['note_hg'];
                $math = $res3['note_math'];
                $sp = $res3['note_sp'];
                $fr = $res3['note_fr'];
                $en = $res3['note_en'];
                
                $moyenne = ($hg + $math + $sp + $fr + $en) / 5;

                echo $moyenne;
            ?>
            </h1>
            <?php } ?>
        </div>
            

            <?php
        }else{
            echo "<div>ERROR: SESSION EMPTY</div>";
        }
    ?>
</body>
</html>