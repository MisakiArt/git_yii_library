<?php
/* @var $this yii\web\View */
?>
<link rel="stylesheet" type="text/css" href='<?php echo Yii::$app->homeUrl ?>/../css/register.css'>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl ?>/../js/user.js"></script>
<div class='index'>
  <div><a href="<?php echo Yii::$app->homeUrl ?>index/index">首页</a></div>
  <div>></div>
  <div>登录</div>
</div> 
<div id='re_content'>
    <div class="re_p">图书管理系统会员登录</div>
    <form method="post" action="<?php echo Yii::$app->homeUrl ?>index/user/login"  onSubmit="return login()">
        <table class="re_table">
            <tr>
                <th>用户名</th>
                <td><input type="text" name="user" value="" placeholder="请输入用户名"></td>
            </tr>
            <tr>
                <th>密码</th>
                <td><input type="password" name="password" value="" placeholder="请输入密码"></td>
            </tr>
            <tr>
                <th></th>
                <td>自动登录<input type="checkbox" checked="checked" name="autologin" value="autologin"></td>
            </tr>
            
            <tr>
                <th></th>
                <td><input type="submit"  value="登录"></td>
            </tr>

        </table>
    </form>
    </div>