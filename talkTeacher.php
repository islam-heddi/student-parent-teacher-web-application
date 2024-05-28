<?php
	session_start();
	include "Connexion/connexion.php";
	if(isset($_POST['matricule_parent']) || isset($_SESSION['matricule_parent']))	{
		if(isset($_POST['matricule_parent'])) $matricule_parent = $_POST['matricule_parent'];
		else $matricule_parent = $_SESSION['matricule_parent'];
		$rq = "SELECT * FROM `parent` WHERE matricule = $matricule_parent";
		$result = mysqli_query($id,$rq) or die("ERROR");
		$row = $result->fetch_assoc();
		if($row != 0){
			$parentname = $row['nom']." ".$row['prenom'];
			$_SESSION['parentname'] = $parentname;
			$_SESSION['matricule_parent'] = $matricule_parent;	
		}
		$matricule_teacher = $_SESSION['matricule'];
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
		<menu><a href="teacherLabel.php">Revenir au votre profile</a></menu>
	</header>
	<div>
	<?php if($row == 0) echo "<h1>ERROR NO PARENT HAVE THIS MATRICULE</h1>";
		  else{ ?>
		<h1>Mr.<?php echo $_SESSION['username']; ?> avec le parent <?php echo $parentname; ?></h1>
		<p>Vous devriez parler içi ...</p>
		<!--&#13;&#10; break line in textarea block -->
		<form method="post">
			<textarea readonly><?php
				$rq = "UPDATE `parler` SET `notifier`='1' WHERE `ennonceur` = 'parent'";
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
			<textarea name="message" style="height: 50px;" placeholder="Votre message içi ....."></textarea>
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