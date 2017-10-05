<?php
/* @var $this yii\web\View */
?>

<link rel="stylesheet" type="text/css" href='<?php echo Yii::$app->homeUrl ?>/../css/register.css'>
<script>
    var checknameurl='<?php echo Yii::$app->homeUrl ?>?r=user/checkname';
</script>
<script type="text/javascript" src="<?php echo Yii::$app->homeUrl ?>/../js/register.js"></script>
<div class='index'>
  <div><a href="<?php echo Yii::$app->homeUrl ?>index/index">首页</a></div>
  <div>></div>
  <div>注册</div>
</div> 
<div id='re_content'>
    <div class="re_p">图书馆会员注册</div>
    <form method="post" action="<?php echo Yii::$app->homeUrl ?>index/user/useradd"  onSubmit="return register()">

    <table class="re_table">
    <tr>
    <th>用户名</th>
    <td><input class="re_input" type="text" name="user" value="" placeholder="请输入用户名"></td>
    </tr>
    <tr>
    <th></th>
    <td><span class="msg"></span></td>
    </tr>
    <tr>
    <th>密码</th>
    <td><input class="re_input" type="password" name="password" value="" placeholder="请输入密码"></td>
    </tr>
    <tr>
    <th></th>
    <td><span class="msg"></span></td>
    </tr>
    <tr>
    <th>确认密码</th>
    <td><input class="re_input" type="password"  value="" placeholder="请确认密码"></td>
    </tr>
    <tr>
    <th></th>
    <td><span class="msg"></span></td>
    </tr>
    <tr>
    <th>邮箱</th>
    <td><input class="re_input" type="text" name="email" value="" placeholder="请输入邮箱"></td>
    </tr>
    <tr>
    <th></th>
    <td><span class="msg"></span></td>
    </tr>
    <tr>
    <th></th>
    <td><input type="submit"  value="注册"></td>
    </tr>

    </table>
    </form>
    </div>