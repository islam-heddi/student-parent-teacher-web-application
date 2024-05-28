<?php 
    session_start();
    if(isset($_POST['admin']) && isset($_POST['password'])){
        $username = $_POST['admin'];
        $password = $_POST['password'];
        $check_the_autrization = $username == 'admin' && $password == 'admin2004';
        if($check_the_autrization){
            $verfication = true;
            $_SESSION['admin_verification'] = true;
        }else{
            echo "<h1>PERMISSION DENIED!!</h1>";
            $_SESSION['admin_verification'] = false;
            $verfication = false;
        }
    }else if(isset($_SESSION['admin_verification'])){
        if($_SESSION['admin_verification'] == true){
            $verfication = true;
        }else{
            $verfication = false;
            echo "<h1>PERMISSION DENIED!!</h1>";
        }
    }else{
        echo "<h1>PERMISSION DENIED!!</h1>";
        $verfication = false;
        $_SESSION['admin_verification'] = false;
    }
    if($verfication){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome in admin panel</title>
    <link rel="shortcut icon" href="./fonts/marteaux.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/admin-style.css">
</head>
<body>
    <header>
        <a href="./administration/ListStudent.php">Etudiant</a>
        <a href="./administration/ListTeachers.php">Engseignant</a>
        <a href="./administration/addrequestParent.php">Parent</a>
        <a href="deconnect.php?link=adminpanel.html">Deconnect</a>
    </header>
    <article>
        <h1>Bonjour dans mode admin</h1>
        <p>Là vous pouvez verifier et approuver tous qui attend</p>
        <p>Verifiez la fille d'attence pour celle qui va inscrire</p>
        <a href="deconnect.php?link=adminpanel.html">Deconnect</a>
    </article>
</body>
</html>
<?php } ?>