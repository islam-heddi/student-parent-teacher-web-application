<?php
	$link = $_GET['link'];
	session_start();
	session_unset();
	header('Location: '.$link);
?>