<?php

namespace app\modules\controllers;
use app\modules\models\book;
use app\modules\models\type;
use app\modules\models\borrow;

class BookController extends \yii\web\Controller
{
	public $layout='main';
    public function actionBook()
    {
    	if(isset($_GET['id'])&&!empty($_GET['id'])){

              return $this->render('book');

    	}
        
    }

    public function actionGetbook(){
    	$id=$_GET['id'];
        Book::addhot($id);
        $res=Book::getbookbyid($id);
    	echo json_encode($res);
    }


    public function actionBorrowbook(){
        if($_POST['bookid']!=null && $_POST['userid']!=null){

            $bookid=$_POST['bookid'];
            $userid=$_POST['userid'];
            Borrow::borrowbook($bookid,$userid);
 
        }
        else{
            echo "<script>alert('请先登录');history.go(-1);</script>";
        }
    }

    function actionBackbook(){
        if($_GET['borrowid']!=null){
            $borrowid=$_GET['borrowid'];
            $borrow=new borrow;
            $borrow=$borrow::find()->where(['borrowid'=>$borrowid])->one();
            $borrow->ifback='1';
            if( $borrow->save())
            echo "<script>alert('请将书交给管理员验证');history.go(-1);</script>";
        else 
            echo "<script>alert('还书失败');history.go(-1);</script>";

        }
        else return $this->redirect(['index/index']);

    }
    function actionLongdate(){
        if($_GET['borrowid']!=null){
            $borrowid=$_GET['borrowid'];
            Borrow::longdate($borrowid);

        }
        else
            return $this->redirect(['index/index']);

    }

    

}
