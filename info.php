<?php
    require_once("db_info.php");
    if(!isset($_SESSION['user_id'])){
    	echo "<script language='javascript'>\n";
		echo "alert('请先登录！');\n";
		echo "history.go(-1);\n";
		echo "</script>";
        exit(0);
    }
    if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['re_password'])){
        $old_password=$_POST['old_password'];
        $new_password=$_POST['new_password'];
        $re_password=$_POST['re_password'];
        if($new_password!=$re_password){
            echo "<script language='javascript'>\n";
    		echo "alert('密码不一致！');\n";
    		echo "history.go(-1);\n";
    		echo "</script>";
            exit(0);
        }
        $sql="SELECT `password` FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
        $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
        $row=mysqli_fetch_object($result);
        mysql_free_result($result);
        if($old_password!=$row->password){
            echo "<script language='javascript'>\n";
    		echo "alert('旧密码错误！');\n";
    		echo "history.go(-1);\n";
    		echo "</script>";
            exit(0);
        }
        $sql="UPDATE `users` SET `password`='$new_password' WHERE `user_id`='".$_SESSION['user_id']."'";
    	mysqli_query($mysqli,$sql);
        echo "<script language='javascript'>\n";
		echo "alert('修改成功！');\n";
		echo "history.go(-1);\n";
		echo "</script>";
        exit(0);
    }else{
        echo "<script language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
    }
?>