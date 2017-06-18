
<!DOCTYPE html>
<html lang="cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="image/favicon.ico">

    <title>河南理工大学计算机15级数据库课程设计</title>  
    


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
                <h3 class="panel-title">河南理工大学计算机15级数据库课程设计</h3>
              </div>
              <div class="panel-body">
                   <div class="jumbotron">
                      <h1>Hello, world!</h1>
                      <p>使用前请先登录，有问题请联系：<a class="btn btn-success" href="//wpa.qq.com/msgrd?v=3&uin=504056823&site=qq&menu=yes" role="button" target="_blank">BoilTask</a></p>
                      <p><small>给口饭吃：<a class="btn btn-warning" href="//www.BoilTask.com" role="button" target="_blank">前往首页</a></small></p>
                    </div>
              </div>
              <div class="panel-footer">
                 <center>
                <?php
                echo "<div>";
                if(isset($_SESSION['user_id'])){
                    echo "已登录：".$_SESSION['user_id'];
                    echo "<a href='logout.php' class='btn btn-danger'>注销</a></div>";
                }
                else{
                    echo "<button type=\"button\" class=\"btn btn-danger btn-lg\" data-toggle=\"modal\" data-target=\"#LoginModal\">登陆</button>";
                    echo "</div>";
                }
                
                ?>
                </center>
              </div>
        </div>
    </div>
<form action="login.php" method="post" role="form" class="form-horizontal">
    <div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
    					&times;
    				</button>
    				<h4 class="modal-title" id="LoginModalLabel">登陆 <small>登录失败请联系：<a class="btn btn-success btn-xs" href="//wpa.qq.com/msgrd?v=3&uin=504056823&site=qq&menu=yes" role="button" target="_blank">BoilTask</a></small></h4>
    			</div>
    			<div class="modal-body">
    <table class="table table-striped">
	<tr>
	    <td>学号</td>
	    <td><input name="user_id" class="form-control" placeholder="311*********" type="text"></td>
	</tr>
    <tr>
    	<td>密码</td>
    	<td><input name="password" class="form-control" placeholder="（默认与学号相同）" type="password"></td>
    </tr>
	</table>
    		</div>
    			<div class="modal-footer">
    			    <button name="submit" type="submit" class="btn btn-danger">登陆</button>
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
            location.href=location.href;
        });
    }
    function cancel(title) {
        $.post('action.php',{
            action:"cancel",
            title:title
        }, function(data) {
            location.href=location.href;
        });
    }
    function insert() {
        $.post('action.php',{
            action:"insert",
            title:$("#diytitle").val()
        }, function(data) {
            location.href=location.href;
        });
    }
</script>
    
    <?php
        if(!isset($_SESSION['user_id']))
            echo "<script>$('#LoginModal').modal('show');</script>";
    ?>
  </body>
</html>
<!--not cached-->
