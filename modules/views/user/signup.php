<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
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
<div class="site-login">
    <div class="re_p"><?= Html::encode($this->title) ?></div>

    <div class="re_d">请输入以下信息</div>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'userpassword')->passwordInput() ?>
        <?= $form->field($model, 'rePassword')->passwordInput() ?>
         <?= $form->field($model, 'useremail')->textInput(['autofocus' => true]) ?>
         <?=$form->field($model,'verifyCode')->widget(Captcha::className(),['captchaAction'=>'user/captcha'])?>

        <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
