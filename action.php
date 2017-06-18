<?php
    require_once("db_info.php");
    if(!isset($_SESSION['user_id'])){
    	echo "请先登录！";
        exit(0);
    }
    if($_POST['action']=="join"){
        if (isset($_POST['title'])){
    		$user_id=$_SESSION['user_id'];
    		$sql="SELECT `class` FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
            $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
            $row=mysqli_fetch_object($result);
            mysql_free_result($result);
            $class=$row->class;
    		
    		$title=$_POST['title'];
    		$sql="SELECT `user_id` FROM `users` WHERE `title`=\"$title\" AND `class`=".$class;
    		$result=mysqli_query($mysqli,$sql);
    		if(mysqli_num_rows($result)>0){
            	echo "选题冲突！";
    		    exit(0);
    		}
    		
    		//$sql="DELETE FROM `title` WHERE `title_name`= (SELECT `title` FROM `users` WHERE `user_id`='$user_id') AND `diy`=1";
    		//mysqli_query($mysqli,$sql);
    		
    		$sql="UPDATE `users` SET `title`='$title' WHERE `user_id`=\"$user_id\"";
    		mysqli_query($mysqli,$sql);
    	}
    }else if($_POST['action']=="cancel"){
        if (isset($_POST['title'])){
    		$user_id=$_SESSION['user_id'];
    		$title=$_POST['title'];
    		
    		//$sql="DELETE FROM `title` WHERE `title_name`= (SELECT `title` FROM `users` WHERE `user_id`='$user_id') AND `diy`=1";
    		//mysqli_query($mysqli,$sql);
    		
    		$sql="UPDATE `users` SET `title`='' WHERE `user_id`=\"$user_id\"";
    		mysqli_query($mysqli,$sql);
    	}
    }else if($_POST['action']=="insert"){
        if (isset($_POST['title'])&&$_POST['title']!=""){
    		$user_id=$_SESSION['user_id'];
    		$title=$_POST['title'];
    		
    		$sql="SELECT * FROM `title` WHERE `title_name`='$title'";
    		$result=mysqli_query($mysqli,$sql);
    		if(mysqli_num_rows($result)>0){
            	echo "题目已存在！";
    		    exit(0);
    		}
    		
    		$sql="INSERT INTO `title` (`title_name`, `diy`) VALUES ('$title', 1);";
    		mysqli_query($mysqli,$sql);
    		$sql="UPDATE `users` SET `title`='$title' WHERE `user_id`='$user_id'";
    		mysqli_query($mysqli,$sql);
    	}
    }
?>