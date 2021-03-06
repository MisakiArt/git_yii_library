<?php

namespace app\modules\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $userid
 * @property string $username
 * @property string $userpassword
 * @property string $registerdate
 * @property integer $reputation
 * @property string $useremail
 */
class User extends ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registerdate'], 'required'],
            [['registerdate'], 'safe'],
            [['reputation'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['userpassword'], 'string', 'max' => 100],
            [['useremail'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'username' => 'Username',
            'userpassword' => 'Userpassword',
            'registerdate' => 'Registerdate',
            'reputation' => 'Reputation',
            'useremail' => 'Useremail',
        ];
    }
   
     function findname($id){
        $user=User::find()->select('username')->where(['userid'=>$id])->asArray()->one();
        return $user['username'];

    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function setPassword($userpassword)
    {
        $this->userpassword = md5($userpassword);
    }
     public function login($username,$pwd){
        $user=User::find()->where(['username'=>$username])->one();
        if($user){
            if($user->userpassword==$pwd){
                return $user;
            }
            return false;

        }
        return false;
    }


}
