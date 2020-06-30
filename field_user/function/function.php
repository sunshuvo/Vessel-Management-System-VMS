<?php
function redirect_to($page){
	header("Location:$page");
}

function mysql_conn(){
	$dbhost="localhost";
	$dbuser="dbtest";
	$dbpass="dbtest";
	$dbname="fisheries";
	
	$connect= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	return($connect);
}

function delete_row($id){
	$del_query  = "DELETE FROM `user` WHERE `user`.`id` = $id";
	$connect=mysql_conn();
	$row_res = mysqli_query($connect,$del_query);
}

function generate_salt($len){
	$unique_id=md5(uniqid(mt_rand()),true);
	$base64_string = base64_encode($unique_id);
	$modified_based_string= str_replace("+",".",$base64_string);
	$salt=substr($modified_based_string,0,$len);
	return($salt);		
}

function pass_encrypt($password){
	
	$hash_format="$2y$10$";
	$salt_len=22;
	$salt= generate_salt($salt_len);
	$format_salt=$hash_format.$salt;
	$hashed_pass = crypt($password,$format_salt);
	
	return($hashed_pass);
}

function findentry($username,$field){
	$login_qry  = "select * from user where ";
	$login_qry .= "username='$username'";
	
	$res_login = mysqli_query(mysql_conn(),$login_qry);
	
	if($res_login){
		while($user=mysqli_fetch_assoc($res_login)){
			$found=$user["$field"];
		}
		//mysqli_free_result($res_login);
		return($found);
	}
}

function passcheck($username,$password){
	$login_qry  = "select * from user where ";
	$login_qry .= "username='$username'";
	
	$res_login = mysqli_query(mysql_conn(),$login_qry);
	
	while($user=mysqli_fetch_assoc($res_login)){
		$existing_hash = $user["password"];	
//		echo $existing_hash."<br>";
	}
	//mysqli_free_result($res_login);
	$try_hash = crypt($password,$existing_hash);
	$try_hash = substr($try_hash, 0, -10);
//	echo $try_hash;
	
	if($existing_hash==$try_hash){return true;}
	else{return false;}
}

	
?>