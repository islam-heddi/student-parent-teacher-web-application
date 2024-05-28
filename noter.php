<?php
    include "Connexion/connexion.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noter un étudiant</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
</head>
<body>
    <?php
        if(isset($_SESSION['ConnectedAs']) || $_SESSION['ConnectedAs'] == "teacher"){
    ?>
        <header>
            <h1>Mon Ecole</h1>
            <menu>
                <a href="./deconnect.php?link=teacher.html">Deconnecter</a>
                <a href="./publier.php">Publier</a>
                <a href="./noter.php">Noter</a>
            </menu>
        </header>
        <div>
            <form>
                <h1>Entrer matricule l'étudiant :</h1>
                <input type="text" placeholder="xxxxxxx" name="matricule" required>
                <h1>Trimestre :</h1>
                <select name="trimestre">
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                            </select>
                <input type="submit">
            </form>
        </div>
        <?php
            if(isset($_GET['matricule'])){
                $mat = $_GET['matricule'];
                $tri = $_GET['trimestre'];
                $rq = "SELECT * FROM student where matricule = $mat";
                $result = mysqli_query($id,$rq) or die("ERROR");
                $res = $result->fetch_assoc();
                $rq = "SELECT * FROM note where matricule_et = $mat and trimestre = $tri";
                $result1 = mysqli_query($id,$rq) or die("ERROR");
                $res1 = $result1->fetch_assoc();
                if($res != 0) {
                    $cond = true;
                    if($res1 != 0){
                        $cond1 = true;
                    }else{
                        $cond1 = false;
                    }
                }
                else{
                    $cond = false;
                    echo "<div>Il y'a pas un étudiant marquer par cette matricule là .</div>";
                }
            }else{
                $cond = false;
            }
        ?>
        <?php if($cond) { ?>
        <div>
            <h1>Etudiant : <?php echo $res['nom']." ".$res['prenom']; ?></h1>
            <h1>Niveau : <?php echo $res['niveau']; ?></h1>
            <h1>Veuillez saisir les notes :</h1>
            <form>
                <table>
                    <tr>
                        <td>
                            Matricule :
                        </td>
                        <td>
                            <input type="text" value="<?php echo $mat ?>" name="matricule_et" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Trimestre :
                        </td>
                        <td>
                            <input type="text" value="<?php echo $_GET['trimestre']; ?>" name="trimestre">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            His Geo
                        </td>
                        <td>
                            <input type="number" max="10" min="0" <?php if($cond1) echo "value='".$res1['note_hg']."'"; ?> name="hg" placeholder="la note içi">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mathematique
                        </td>
                        <td>
                            <input type="number" max="10" min="0" <?php if($cond1) echo "value='".$res1['note_math']."'"; ?> name="math" placeholder="la note içi">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Français
                        </td>
                        <td>
                            <input type="number" max="10" min="0" <?php if($cond1) echo "value='".$res1['note_fr']."'"; ?> name="fr" placeholder="la note içi">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Science et physique : 
                        </td>
                        <td>
                            <input type="number" max="10" min="0" <?php if($cond1) echo "value='".$res1['note_sp']."'"; ?> name="sp" placeholder="la note içi">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Anglaise : 
                        </td>
                        <td>
                            <input type="number" max="10" min="0" <?php if($cond1) echo "value='".$res1['note_en']."'"; ?> name="EN" placeholder="la note içi">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="<?php if($cond1) {echo "modifier";}else{echo "sousmission";} ?>" name="submittion">
                        </td>
                        <td>
                            <input type="reset">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php } ?>
        <?php
            if(isset($_GET['matricule_et']) && isset($_GET['submittion'])){
                $mat = $_GET['matricule_et'];
                $tri = $_GET['trimestre'];
                $hg = $_GET['hg'];
                $math = $_GET['math'];
                $sp = $_GET['sp'];
                $fr = $_GET['fr'];
                $en = $_GET['EN'];
                if($_GET['submittion'] == "sousmission") {
                    $rq = "INSERT INTO `note`(`matricule_et`, `trimestre`, `note_en`, `note_fr`, `note_math`, `note_sp`, `note_hg`) VALUES ('$mat','$tri','$en','$fr','$math','$sp','$hg')";
                    mysqli_query($id,$rq) or die("ERROR: bad request");
                    echo "<div>SOUSMISSION succés</div>";
                }else if($_GET['submittion'] == "modifier"){
                    $rq ="UPDATE `note` SET `note_en`='$en',`note_fr`='$fr',`note_math`='$math',`note_sp`='$sp',`note_hg`='$hg' WHERE matricule_et = $mat and trimestre = $tri";
                    mysqli_query($id,$rq) or die("ERROR: bad request");   
                    echo "<div>MODFICATION succés</div>";
                }
                
            } 
         
        ?>
    <?php
        }else{
            echo "<div>ERROR : Bad request</div>";
        }
    ?>
</body>
</html>