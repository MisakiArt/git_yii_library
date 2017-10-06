<?php

namespace app\modules\models;

use Yii;
use yii\base\Model;
use app\modules\models\user;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ModifypwdForm extends Model
{
    public $userid;
    public $userpassword;
    public $newPassword;
    public $rePassword;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
           ['userid','required'],
           [['userpassword','rePassword','newPassword'],'required'],
           [['userpassword','rePassword','newPassword'],'string','min'=>6],
           ['rePassword','compare','compareAttribute'=>'newPassword','message'=>'两次密码不一致'],
           ['verifyCode','captcha','captchaAction'=>'index/user/captcha']
           


        ];
    }

    public function attributeLabels(){
        return [
        'userid'=>'',
        'userpassword'=>'旧密码',
        'newPassword'=>'新密码',
        'rePassword'=>'重复密码',
        'verifyCode'=>'验证码'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function modifypwd()
    {
        if (!$this->validate()) {
            return false;
        }  
        $user =User::find()->where(['userid'=>$this->userid])->one();
        if(!$user) return false;
        if(md5($this->userpassword)==$user->userpassword){
        $user->setPassword($this->newPassword);
        
        return $user->save() ? true : false;
    }
        else {return false;}
    }
}
