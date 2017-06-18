<?php
    require_once('db_info.php');
    if(!isset($_SESSION['user_id'])){
        require_once('welcome.php');
        exit(0);
    }
    
    $sql="SELECT `class` FROM `users` WHERE `user_id`='".$_SESSION['user_id']."'";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
    $row=mysqli_fetch_object($result);
    mysql_free_result($result);
    $class=$row->class;
    
    $TitleSet=Array();
    $sql="SELECT * FROM `title`";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
    $i=0;
    while ($row=mysqli_fetch_object($result)){
    	$TitleSet[$i][0]=$row->title_name;
    	$titlesql="SELECT `user_id`,`name` FROM `users` WHERE `title`='".$TitleSet[$i][0]."' AND class=".$class;
    	$titleresult=mysqli_query($mysqli,$titlesql);
    	if($titleresult){
        	$titlerow=mysqli_fetch_object($titleresult);
        	$TitleSet[$i][1]=$titlerow->user_id;
        	$TitleSet[$i][2]=$titlerow->name;
    	}else{
    	    $TitleSet[$i][1]=$TitleSet[$i][2]="";
    	}
    	$TitleSet[$i][3]=$row->diy;
        $i++;
    }

?>
<!DOCTYPE html>
<html lang="cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/favicon.ico">

    <title>河南理工大学计算机150<?php echo $class;?>数据库课程设计</title>  

<link rel="stylesheet" href="jscss/pace.css">

<!-- Buttons 库的核心文件 -->
<link rel="stylesheet" href="jscss/buttons.css">
 

<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">

	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
        <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">河南理工大学计算机150<?php echo $class;?>数据库课程设计</h3>
              </div>
              <div class="panel-body">
                    <table class="table table-striped table-hover">
                        <thead align="center">
                            <tr>
                                <th>序号</th><th>题目</th><th class='hidden-xs'>学号</th><th class='hidden-xs'>姓名</th><th>More</th>
                            </tr>
                        </thead>
                        <?php
                            $i=1;
                            foreach($TitleSet as $Title){
                                echo "<tr".($Title[1]==$_SESSION['user_id']?" class=info":($Title[1]!=""?" class=success":"")).">";
                                echo "<td>$i";
                                if($Title[3]=='1')
                                    echo "*";
                                echo "</td>";
                                $cnt=0;
                                foreach($Title as $table_cell){
                                    if($cnt==3)
                                        break;
                                    if($cnt==1||$cnt==2)
                                        echo "<td class='hidden-xs'>";
                                    else
                                	    echo "<td>";
                                	echo "\t".$table_cell;
                                	echo "</td>";
                                	$cnt++;
                                }
                                echo "<td>";
                                if($Title[1]=="")
                                    echo "<a class='btn btn-primary' onclick=$(this).button('loading');join(\"$Title[0]\");>选择</a>";
                                else if($Title[1]==$_SESSION['user_id']){
                                    echo "<a class='btn btn-primary' onclick=$(this).button('loading');cancel(\"$Title[0]\");>取消</a>";
                                }
                                echo "</td>";
                                echo "</tr>"."\n";
                                $i++;
                            }
                            echo "<tr class=danger>";
                                echo "<td>$i</td>";
                                echo "<td><input id='diytitle'></td>";
                                echo "<td class='hidden-xs'></td>";
                                echo "<td class='hidden-xs'></td>";
                                echo "<td><a class='btn btn-primary' onclick=$(this).button('loading');insert();>DIY</a></td>";
                            echo "</tr>\n";
                        ?>
                    </table>
              </div>
              <div class="panel-footer">
                 <center>
                <?php
                echo "<div>";
                echo "已登录：".$_SESSION['user_id'];
                echo "<button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#InfoModal\">修改密码</button>";
                echo "<a href='logout.php' class='btn btn-danger'>注销</a>";
                echo "</div>";
                ?>
                </center>
              </div>
        </div>
    </div>
    
<form action="info.php" method="post" role="form" class="form-horizontal">
    <div class="modal fade" id="InfoModal" tabindex="-1" role="dialog" aria-labelledby="InfoModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
    					&times;
    				</button>
    				<h4 class="modal-title" id="InfoModalLabel">修改密码 <small>有问题请联系：<a class="btn btn-success btn-xs" href="//wpa.qq.com/msgrd?v=3&uin=504056823&site=qq&menu=yes" role="button" target="_blank">BoilTask</a></small></h4>
    			</div>
    			<div class="modal-body">
    <table class="table table-striped">
	<tr>
	    <td>旧密码</td>
	    <td><input name="old_password" class="form-control" placeholder="请输入旧密码" type="password"></td>
	</tr>
    <tr>
    	<td>新密码</td>
    	<td><input name="new_password" class="form-control" type="password"></td>
    </tr>
    <tr>
    	<td>请确认</td>
    	<td><input name="re_password" class="form-control" type="password"></td>
    </tr>
	</table>
    		</div>
    			<div class="modal-footer">
    			    <button name="submit" type="submit" class="btn btn-danger">确认</button>
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close
    				</button>
    			</div>
    		</div>
    	</div>
    </div>	
</form>

    <script src="http://cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>

    <script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="jscss/pace.js"></script>
    
<script>
    function join(title) {
        $.post('action.php',{
            action:"join",
            title:title
        }, function(data) {
            if(data!='')
                alert(data);
            location.href=location.href;
        });
    }
    function cancel(title) {
        $.post('action.php',{
            action:"cancel",
            title:title
        }, function(data) {
            if(data!='')
                alert(data);
            location.href=location.href;
        });
    }
    function insert() {
        $.post('action.php',{
            action:"insert",
            title:$("#diytitle").val()
        }, function(data) {
            if(data!='')
                alert(data);
            location.href=location.href;
        });
    }
</script>
  </body>
</html>
<!--not cached-->
