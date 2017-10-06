<?php

namespace app\modules\controllers;
use app\modules\models\Book;
use app\modules\models\Type;
use app\modules\models\User;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\filters\HttpCache;


class IndexController extends \yii\web\Controller
{
  public $layout='main';

  public function behaviors()
{
    return [
        [
            'class' => HttpCache::className(),
            'only' => ['index'],
            'lastModified' => function ($action, $params) {
                $q = new \yii\db\Query();
                return $q->from('library_book')->max('updated_at');
            },
        ],
    ];
}

//首页，判断是否需要自动登录
    public function actionIndex()
    {
        $cookies=\Yii::$app->request->cookies;
        if($cookies->getValue('user',false)){
          $username=$cookies->getValue('user',false);
          $pwd=$cookies->getValue('password',false);
          if($user=User::login($username,$pwd)){
             $session=\Yii::$app->session;
                    if(!$session->isActive){ $session->open();
                    }
                    $session->set('user',$username);
                    $session->set('userid',$user->userid);
          }
        }

        return $this->render('index');
    }


    //控制类型标签的生成与检索数据
    public function actionList(){
    	if(isset($_GET['act'])){
    	switch($_GET['act']){
    		case 'seldata': Book::seldata();
    			break;
        case 'inittype':inittype();break;

    	}
       }
       
    	else echo "要参数";

    }

    //测试用控制
    public function actionTest(){
       $type=Type::findidbytype('文科');
       $sql="select bookid,bookname,author,booktypeid, bookcount from library_book WHERE typeid = $type ORDER BY bookcount limit 0,5";
       $labels= Book::findBySql($sql)->asArray()->all();
       var_dump($labels);

    }


 

}


     function inittype(){
      $type=Type::find()->select('type')->asArray()->all();
      echo json_encode($type);

    }

