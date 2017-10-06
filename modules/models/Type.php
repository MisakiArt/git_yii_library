<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "{{%type}}".
 *
 * @property integer $typeid
 * @property string $type
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeid' => 'Typeid',
            'type' => 'Type',
        ];
    }

    public function findtypebyid($id){
        $res=Type::find()->select('type')->where("typeid=$id")->asArray()->one();
        if(!$res) throw new Exception("不存在的");
        return $res['type'];

    }
        public function findidbytype($type){
        $res=Type::find()->select('typeid')->where("type='$type'")->asArray()->one();
        if(!$res) throw new Exception("不存在的");
        return $res['typeid'];

    }
}
