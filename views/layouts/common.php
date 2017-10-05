<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>图书管理系统</title>
	<link rel="stylesheet" type="text/css" href='<?php echo Yii::$app->homeUrl ?>/../css/index.css'>
	<script type="text/javascript" src='<?php echo Yii::$app->homeUrl ?>/../js/jquery.js'></script>
	<script type="text/javascript" src='<?php echo Yii::$app->homeUrl ?>/../js/common.js'></script>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
   <div id='box'>
      <div id='header' style="background-image: url(<?php echo Yii::$app->homeUrl ?>/../image/header.jpg);">
      <div class="h_top">
      <div class="h_left"><a href="<?php echo Yii::$app->homeUrl ?>?r=index">图书管理系统&nbsp</a></div>
          <div class="h_right">
          <?php
          $session=Yii::$app->session;
          if(!$session->isActive){ $session->open();
          }
          if($session->get('user')==null){
          ?>
         <div class="h_unlog"><a href="<?php echo Yii::$app->homeUrl ?>?r=user/register">注册</a></div>
         <div class="h_unlog"><a href="<?php echo Yii::$app->homeUrl ?>?r=user/login">登录</a></div>

          <?php }else{?>
              <ul>
              <li class="h_user" userid="<?php echo $_SESSION['userid']; ?>" ><a href="">&nbsp欢迎读者<?php echo $_SESSION['user'] ?></a>
                  <ul>
                      <li><a href="<?php echo Yii::$app->homeUrl ?>?r=user/usercenter&userid=<?php echo $_SESSION['userid']?>">个人中心</a></li>
                      <li><a href="<?php echo Yii::$app->homeUrl ?>?r=user/loginout">退出账号</a></li>
                  </ul>
              </li>
              </ul>


          <?php }?>
      </div>
      </div>
      <div class="h_text">
        <div class="h_float">
        胸中怀抱着花与月，像朝着圣地前行的巡礼者那般继续走下去。
        </div>
      </div>
      </div>
      <div id='center'>
        <?= $content ?>
        <div class="blank"></div>
      </div>
      <div id='footer'>
      <div class="webmessage">
      如有疑惑请联系作者，qq：1076448574
       </div>

      </div>

   </div>
   <?php $this->endBody() ?>
	
</body>
</html>
<?php $this->endPage() ?>