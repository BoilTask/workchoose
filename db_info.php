<?php @session_start();
	ini_set("display_errors","Off");
	ini_set("session.cookie_httponly", 1);   
	header('X-Frame-Options:SAMEORIGIN');
	
global $mysqli;

	if(($mysqli=mysqli_connect("localhost","root","root"))==null) //此处填写用户名和密码
	    die('Could not connect: ' . mysqli_error($mysqli));
	// use db
	mysqli_query($mysqli,"set names utf8");
  //if(!$OJ_SAE)mysqli_set_charset("utf8");
	
	if(!mysqli_select_db($mysqli,"sjk")) // sjk 为创建的数据库
		die('Can\'t use foo : ' . mysqli_error($mysqli));

	//sychronize php and mysql server with timezone settings, dafault setting for China
	//if you are not from China, comment out these two lines or modify them.
	date_default_timezone_set("PRC");
	mysqli_query($mysqli,"SET time_zone ='+8:00'");
?>
