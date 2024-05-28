<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Publication</title>
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
    <header>
        <h1>Mon Ecole</h1>
        <menu>
            <a href="teacherLabel.php">retourne au l'accueil</a>
            <a href="publier.php">Publier</a>
        </menu>
    </header> 
    <?php
        if(isset($_GET['id'])){
            ?>
        <div>
            <form method="get" action="update.php">
                <label>Publication : </label> <input type="text" name="id" value="<?php echo $_GET['id']; ?>" readonly>
                <h1>Completer çi dessous :</h1>
                <label>Pour quel niveau cette publication : </label>
                <select name="niveau">
                    <option value="<?php echo $_GET['niveau']; ?>"><?php echo "niveau ".$_GET['niveau']; ?></option>
                    <option value="1">niveau 01</option>
                    <option value="2">niveau 02</option>
                    <option value="3">niveau 03</option>
                    <option value="4">niveau 04</option>
                    <option value="5">niveau 05</option>
                </select>
                <textarea placeholder="Taper quelque chose...." name="publication"  required><?php echo $_GET['message']; ?></textarea><br>
                <br>
                <button type="submit" name="submit">
                    UPDATE
                </button>
                <button type="reset">
                    Reset
                </button>
            </form>
        </div>

<?php
        }else{
            echo "<div>ERROR : params error</div>";
        }
    ?>
</body>
</html>