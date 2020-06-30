<?php
	require("function/session.php");
	require("function/function.php");
	
	$_SESSION["username"]=null;
	redirect_to("login.php");
?>