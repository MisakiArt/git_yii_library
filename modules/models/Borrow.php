<?php

namespace app\modules\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "{{%borrow}}".
 *
 * @property integer $borrowid
 * @property integer $userid
 * @property integer $bookid
 * @property string $borrowtime
 * @property string $backtime
 * @property integer $ifback
 */
class Borrow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%borrow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'bookid', 'borrowtime', 'backtime'], 'required'],
            [['userid', 'bookid', 'ifback'], 'integer'],
            [['borrowtime', 'backtime','ifback'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borrowid' => 'Borrowid',
            'userid' => 'Userid',
            'bookid' => 'Bookid',
            'borrowtime' => 'Borrowtime',
            'backtime' => 'Backtime',
            'ifback' => 'Ifback',
        ];
    }

    public function getRelate()  
    {  
        return $this->hasMany(Book::classname(),['id'=>'bookid']);
    }  

    public function onborrow($userid){
            $where['userid']=$userid;
            $where['ifback']=0;
            $res=borrow::find()->select('borrowid,bookid,borrowtime,backtime')->with('relate')->where($where)->orderBy('borrowid DESC');

            $pages = new Pagination(['totalCount' =>$res->count(), 'pageSize' => '5']); 
            $res = $res->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            foreach ($res as $key => $value) {
                $res[$key]['bookid']=$value['relate'][0]['bookname'];
                unset($res[$key]['relate']);
            }
            // for($i=0;$i<count($res);$i++){
            //     $res[$i]['bookid']=\Book::getbookname($res[$i]['bookid']);
            // }
            $data=array();
            $data['res']=$res;
            $data['pages']=$pages;
            return $data;

    }
    public function historyborrow($userid){
            $where['userid']=$userid;
            $res=Borrow::find()->select('borrowid,bookid,borrowtime,backtime,ifback')->where($where)->orderBy('borrowid DESC')->with('relate');
            $pages = new Pagination(['totalCount' =>$res->count(), 'pageSize' => '10']); 
            $res = $res->offset($pages->offset)->limit($pages->limit)->asArray()->all();

            foreach ($res as $key => $value) {
                $res[$key]['bookid']=$value['relate'][0]['bookname'];
                unset($res[$key]['relate']);
                 switch ($res[$key]['ifback']) {
                    case '0':$res[$key]['ifback']='未归还';
                        break;
                    case '1':$res[$key]['ifback']='待审核';
                        break;
                    case '2':$res[$key]['ifback']='已归还';
                        break;        
                }

            }
             $data=array();
            $data['res']=$res;
            $data['pages']=$pages;
            return $data;
    }
    public function borrowbook($bookid,$userid){
         $book=Book::find('$bookreserves')->where(['id'=>$bookid])->one();
         if(!$book) throw new Exception("不存在的");
         if($book->bookreserves>0){
            $date=date_create(date('Y-m-d'));
            $borrow=new borrow();
            $borrow->bookid=$bookid;
            $borrow->userid=$userid;
            $borrow->borrowtime=date('Y-m-d');
            date_add($date,date_interval_create_from_date_string("30 days"));
            $borrow->backtime=(string)date_format($date,'Y-m-d');
            $borrow->validate();
            if($borrow->hasErrors()){
                echo "<script>alert('借书失败，请刷新重试');history.go(-1);</script>";
            }
            else{
            if($borrow->save()){
                Book::borrowbook($borrow->bookid);
                 echo "<script>alert('借书成功，请至管理员处确认信息');history.go(-1);</script>";
            }
            else echo "<script>alert('借书失败，请刷新重试');history.go(-1);</script>";
        }
    }
    else{
        echo "<script>alert('本书已经借完了');history.go(-1);</script>";

    }
    }
    public function longdate($borrowid){
            $borrow=borrow::find()->where(['borrowid'=>$borrowid])->one();
            if(!$borrow) throw new Exception("不存在的");
            $backtime=$borrow->backtime;
            $backtime=date_create($backtime);
             date_add($backtime,date_interval_create_from_date_string("30 days"));
             $borrow->backtime=(string)date_format($backtime,'Y-m-d');
            if(!$borrow->save()) throw new Exception("保存失败");
             echo "<script>alert('延期成功');history.go(-1);</script>";
    }
}
