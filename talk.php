<?php
	session_start();
	include "Connexion/connexion.php";
	if(isset($_POST['matricule_teacher']) || isset($_SESSION['matricule_teacher']))	{
		if(isset($_POST['matricule_teacher'])) $matricule_teacher = $_POST['matricule_teacher'];
		else $matricule_teacher = $_SESSION['matricule_teacher'];
		$rq = "SELECT * FROM `teacher` WHERE matricule = $matricule_teacher";
		$result = mysqli_query($id,$rq) or die("ERROR");
		$row = $result->fetch_assoc();
		if($row != 0){
			$teachername = $row['nom']." ".$row['prenom'];
			$speciality = $row['speciality'];
			$_SESSION['teachername'] = $teachername;
			$_SESSION['speciality'] = $speciality;
			$_SESSION['matricule_teacher'] = $matricule_teacher;	
		}
		$matricule_parent = $_SESSION['matricule'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Discussion</title>
	<link rel="stylesheet" type="text/css" href="./styles/style.css">
	<style type="text/css">
		textarea{
			resize: none;
			width: 100%;
			height: 300px;
			font-size: 20px;
		}
	</style>
</head>
<body>
	<header>
		<h1>Mon Ecole</h1>
		<menu><a href="parentLabel.php">Revenir au votre profile</a></menu>
	</header>
	<div>
	<?php if($row == 0) echo "<h1>ERROR NO TEACHER HAVE THIS MATRICULE</h1>";
		  else{ ?>
		<h1>Mr.<?php echo $_SESSION['username']; ?> avec enseignant <?php echo $teachername." de specialité ".$speciality; ?></h1>
		<p>Vous devriez parler içi ...</p>
		<!--&#13;&#10; break line in textarea block -->
		<form method="post">
			<textarea readonly><?php
				$rq = "UPDATE `parler` SET `notifier`='1' WHERE `ennonceur` = 'teacher'";
				mysqli_query($id,$rq) or die("ERROR");
				$rq = "SELECT * FROM `parler` where matricule_ens = $matricule_teacher AND matricule_prt = $matricule_parent";
				$result = mysqli_query($id,$rq) or die("ERROR");
				while ($row = $result->fetch_assoc()) {
					$ennonceur = $row['ennonceur'];
					$message = $row['message'];
					$dd = $row['date_message'];
					echo "$dd $ennonceur : $message";
					echo "&#13;&#10;";
				}
			 ?></textarea>
			<textarea name="message" style="height: 50px;" placeholder="Votre message içi ....." required></textarea>
			<input type="submit">
			<input type="reset">
		</form>
			<?php

		if(isset($_POST['message'])){
			$message = $_POST['message'];
			$ennonceur = $_SESSION['ConnectedAs'];
			$date = date("y-m-d");
			echo "$date";
			$reques = "INSERT INTO `parler`(`matricule_prt`, `matricule_ens`, `message`, `notifier`, `ennonceur`, `date_message`) VALUES ('$matricule_parent','$matricule_teacher','$message','0','$ennonceur','$date')";
			mysqli_query($id,$reques) or die("ERROR");
			 header("refresh: 0.5;");

		}
	?>
	</div>
<?php } ?>
</body>
</html>
<?php
}
?>