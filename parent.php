
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent</title>
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
        <img src="./fonts/family.png" alt="parent">
        <h1>Se connecter en tant que un parent</h1>
        <form action="parentLabel.php" method="post">
            <table>
                <tr>
                    <td>
                        Matricule ou email :
                    </td>
                    <td>
                        <input type="text" placeholder="xxxxxxxxxx" name="inscription">
                    </td>
                </tr>
                <tr>
                    <td>
                        Mot de passe :
                    </td>
                    <td>
                        <input type="password" placeholder="*************" name="password">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="butn">
                    </td>
                </tr>
            </table>
        </form>
        <p>Tu n'a pas un compte <a href="./signup.php">inscrivez là !</a></p>
    </div>
</section>

<div>
    
</div>

</body>
</html>