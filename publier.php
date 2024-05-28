<?php
    session_start();
    if($_SESSION['ConnectedAs'] == "teacher"){
        $verfied = true;
    }else{
        echo "<div><h1>You don't have the right to access this page .</h1></div>";
        $verfied = false;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="shortcut icon" href="./fonts/school.png" type="image/x-icon">
    <style>
        button{
            padding: 30px;
            font-size: 20px;
        }
        textarea{
            width: 100%;
            height: 200px;
            resize: none;
            font-size: 20px;
        }
        div form label {
            font-size: 20px;
        }
        div form select {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <?php if($verfied){ ?>
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="teacherLabel.php">retourne au l'accueill</a>
            <a href="monpublication.php">Mes Publication</a>
        </menu>
    </header> 
        <div>
            <h1>Publication</h1>
            <h1>Completer çi dessous :</h1>
            <form method="post" action="operationPublication.php">
                <label>Pour quel niveau cette publication : </label>
                <select name="niveau">
                    <option value="1">niveau 01</option>
                    <option value="2">niveau 02</option>
                    <option value="3">niveau 03</option>
                    <option value="4">niveau 04</option>
                    <option value="5">niveau 05</option>
                </select>
                <textarea placeholder="Taper quelque chose...." name="publication" required></textarea><br>
                <button type="submit" name="submit">
                    Publier
                </button>
                <button type="reset">
                    Reset
                </button>
            </form>
        </div>
    <?php } ?>
</body>
</html>