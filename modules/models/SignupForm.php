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
class SignupForm extends Model
{
    public $username;
    public $userpassword;
    public $useremail;
    public $rePassword;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
           ['username','filter','filter'=>'trim'],
           ['username','required'],
           ['username','unique','targetClass'=>'app\models\User','message'=>'用户名已被使用'],
           ['username','string','min'=>5,'max'=>255],
           ['useremail','filter','filter'=>'trim'],
           ['useremail','required'],
           ['useremail','unique','targetClass'=>'app\models\User','message'=>'邮箱已被使用'],
           ['username','string','max'=>255],
           [['userpassword','rePassword'],'required'],
           [['userpassword','rePassword'],'string','min'=>6],
           ['rePassword','compare','compareAttribute'=>'userpassword','message'=>'两次密码不一致'],
           ['verifyCode','captcha','captchaAction'=>'index/user/captcha']
           


        ];
    }

    public function attributeLabels(){
        return [
        'username'=>'用户名',
        'email'=>'邮箱',
        'password'=>'密码',
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
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->useremail = $this->useremail;
        $user->registerdate=date('Y-m-d H:i:s');
        $user->setPassword($this->userpassword);
        
        return $user->save() ? $user : null;
    }
}
