<?php 
    require_once("db_info.php");
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }
    $sql="SELECT `password` FROM `users` WHERE `user_id`=\"".$user_id."\"";
    $result=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_object($result);
    if($row->password!=""&&$password==$row->password)
        $login=$user_id;
    else
        $login=false;
	if ($login){
		$_SESSION['user_id']=$login;
		echo "<script language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
	}else{
		echo "<script language='javascript'>\n";
		echo "alert('UserName or Password Wrong!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
	}
?>
