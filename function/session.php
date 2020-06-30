<?php 
session_start();

function message($param){
	if(isset($_SESSION[$param])){
		$output  = "<div class=\"ses_mes\">";
		$output .=$_SESSION[$param];
		$output .="</div>";
		
		return($output);
	}
	
}

?>