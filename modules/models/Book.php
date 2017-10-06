<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $bookid
 * @property integer $bookstatus
 * @property string $bookname
 * @property integer $booktypeid
 * @property string $author
 * @property integer $bookoperid
 * @property integer $bookcount
 * @property string $booktag
 * @property string $bookintroduction
 * @property integer $bookreserves
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bookstatus', 'booktypeid', 'bookoperid', 'bookcount', 'bookreserves'], 'integer'],
            [['booktypeid', 'bookoperid'], 'required'],
            [['bookid', 'bookname', 'author', 'booktag'], 'string', 'max' => 100],
            [['bookintroduction'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookid' => 'Bookid',
            'bookstatus' => 'Bookstatus',
            'bookname' => 'Bookname',
            'booktypeid' => 'Booktypeid',
            'author' => 'Author',
            'bookoperid' => 'Bookoperid',
            'bookcount' => 'Bookcount',
            'booktag' => 'Booktag',
            'bookintroduction' => 'Bookintroduction',
            'bookreserves' => 'Bookreserves',
        ];
    }

     public function getRelate()  
    {  
        return $this->hasMany(Type::classname(),['typeid'=>'booktypeid']);
    }  

    

    public function borrowbook($id){
        $book=Book::find()->where(['id'=>$id])->one();
        if(!$book){throw new Exception("不存在的");}
        $book->bookreserves=$book->bookreserves-1;
        if(!$book->save()) throw new Exception("保存失败");;

    }

    public function getbookname($id){
        $book=Book::find()->select('bookname')->where(['id'=>$id])->one();
        if(!$book) throw new Exception("不存在的");
        return $book->bookname;
    }
    public function getbookbyid($id){
        $res=Book::find()->select('id,bookid,bookname,author,booktypeid,booktag,bookintroduction,bookcount,bookreserves')->with('relate')->where(['id'=>$id])->asArray()->one();

        $res['booktypeid']=$res['relate'][0]['type'];
        unset($res['relate']);
        if(!$res){
            throw new Exception("不存在的");
        }
        return $res;
    }

    public function addhot($id){
        $book=Book::find()->where(['id'=>$id])->one();
        if(!$book) throw new Exception("不存在的");
        $book->bookcount++;
        if(!$book->save()) throw new Exception("保存失败");
    }
     //数据检索方法
   public function seldata(){

       $pageNum = $_POST['pageNum'];
       $sort = $_POST['sort'];
       $index = $_POST['index'];
       $search = $_POST['search'];
      
       $book=Book::find()->all();
       $totalItem = count($book);
       $pageSize = 9;
       $totalPage = ceil($totalItem/$pageSize);
       $startItem =($pageNum-1) * $pageSize;
       $arr['totalItem'] = $totalItem;
       $arr['pageSize'] = $pageSize;
       $arr['totalPage'] = $totalPage;
       if($_POST['type']==null){
        if($search=='*'){     
       $sql='select id,bookid,bookname,author,booktypeid, bookcount from library_book ORDER BY '.$index.' '.$sort.' limit '.$startItem.','.$pageSize;
     }
       else{

        $sql="select bookid,bookname,author,booktypeid, bookcount from library_book WHERE bookname LIKE '%$search%' OR booktag LIKE '%$search%' OR author LIKE '%$search%' OR id = '$search' ORDER BY $index $sort limit $startItem,$pageSize";
       }
     }
        else{
        $type= $_POST['type'];
        $type=Type::findidbytype($type);
        if($search=='*'){
        $sql="select bookid,bookname,author,booktypeid, bookcount from library_book WHERE booktypeid = $type ORDER BY $index $sort limit $startItem,$pageSize";}
        else
        {
           $sql="select bookid,bookname,author,booktypeid, bookcount from library_book WHERE booktypeid = $type AND (bookname LIKE '%$search%' OR booktag LIKE '%$search%' OR author LIKE '%$search%' OR id = '$search') ORDER BY $index $sort limit $startItem,$pageSize ";
        }
      }
        
       if($labels= Book::findBySql($sql)->asArray()->all())  {
       for($i=0;$i<count($labels);$i++){
           $labels[$i]['booktypeid']=Type::findtypebyid($labels[$i]['booktypeid']);
       }   
       
       foreach($labels as $lab) {
        $arr['data_content'][] = $lab;
       }
 
       echo json_encode($arr);
     }
     else
      echo '0';
    }
}
