<?php
\yii::$app->session->open();
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<link rel="stylesheet" type="text/css" href='<?php echo Yii::$app->homeUrl ?>/../css/usercenter.css'>
<script type="text/javascript" src='<?php echo Yii::$app->homeUrl ?>/../js/usercenter.js'></script>

<div class='index'>
  <div><a href="<?php echo Yii::$app->homeUrl ?>index/index">首页</a></div>
  <div>></div>
  <div> <a href="<?php echo Yii::$app->homeUrl ?>index/user/usercenter?userid=<?php echo $_SESSION['userid']?>">用户中心</a></div>
  <div>></div>
  <div><?php echo $_SESSION['user'] ?></div>
</div> 

<div id='center_box'>
  <div id='center_meau'>
  <ul>
    <li><a href="<?php echo Yii::$app->homeUrl ?>index/user/usercenter?userid=<?php echo $_SESSION['userid']?>&act=onborrow">在借图书</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl ?>index/user/usercenter?userid=<?php echo $_SESSION['userid']?>&act=historyborrow">历史记录</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl ?>index/user/usercenter?userid=<?php echo $_SESSION['userid']?>&act=modifypwd">修改密码</a></li>
  </ul>
  </div>

  <div id='center_context'>   
  <?php if($_GET['act']!='modifypwd'){?>
      <table class="center_table">
      <tr>
      <th>借书号</th>
      <th>在借图书</th>
      <th>借书日期</th>
      <th>截止日期</th>
      <?php if($_GET['act']==null||$_GET['act']=='onborrow'){?>

      <th>还书/续借</th>
      <?php } else {?>
      <th>状态</th>
      <?php }?>


      </tr>
      <?php

      if($_GET['act']==null||$_GET['act']=='onborrow'){
      $url1=Yii::$app->homeUrl.'index/book/backbook';
      $url2=Yii::$app->homeUrl.'index/book/longdate';
     
      for($i=0;$i<count($res);$i++){
         $print='<tr>';
      foreach($res[$i] as $key=>$value) {
        $print.="<td>$value</td>";
      }
      $print.='<td><a href="'.$url1.'?borrowid='.$res[$i]['borrowid'].'">还书</a>&nbsp<a href="'.$url2.'?borrowid='.$res[$i]['borrowid'].'">续借</a></td></tr>';
      echo $print;
    }

       }

      else{
         for($i=0;$i<count($res);$i++){
         $print='<tr>';
      foreach($res[$i] as $key=>$value) {
        $print.="<td>$value</td>";
      }
      $print.='</tr>';
      echo $print;

      }
    }

   
      ?>
    

      </table>

       <?= LinkPager::widget(['pagination' => $pages]); ?>
       <?php 
     }
       else{
        ?>
        <?php $form = ActiveForm::begin(['id' => 'modifypwd']); ?>
        <?= $form->field($model, 'userid')->hiddenInput(['value' => \Yii::$app->session->get('userid')]) ?>
        <?= $form->field($model, 'userpassword')->passwordInput() ?>
        <?= $form->field($model, 'newPassword')->passwordInput() ?>
        <?= $form->field($model, 'rePassword')->passwordInput() ?>
         <?=$form->field($model,'verifyCode')->widget(Captcha::className(),['captchaAction'=>'user/captcha'])?>

        <div class="form-group">
                <?= Html::submitButton('确认', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

<?php
       }
       ?>
  </div>
</div>

