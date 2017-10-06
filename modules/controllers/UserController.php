<?php

namespace app\modules\controllers;
use app\modules\models\user;
use app\modules\models\borrow;
use app\modules\models\book;
use app\modules\models\SignupForm;
use app\modules\models\ModifypwdForm;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\cookie;

class UserController extends \yii\web\Controller
{

    public function actions(){
        // 验证码
    return [
         'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 5, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 3,//间距
                'height'=>34,//高度
                'width' => 90,  //宽度
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>4        //设置字符偏移量 有效果
            ],
     ];
     }
    public $layout='main';
//用户登录设置sessin并判断是否需要cookies
    public function actionLogin()
    {
        if(\Yii::$app->request->isPost){
            $username=trim($_POST['user']);
            $pwd=trim($_POST['password']);
            if($user=User::login($username,md5($pwd))){
                $session=\Yii::$app->session;
                    if(!$session->isActive){ $session->open();
                    }
                    if($_POST['autologin']=='autologin'){
                      $cookie=new Cookie();
                      $cookie->name='user';
                      $cookie->expire=time()+3600*24*30;
                      $cookie->value=$username;
                      \Yii::$app->response->getCookies()->add($cookie);
                       $cookie=new Cookie();
                      $cookie->name='password';
                      $cookie->expire=time()+3600*24*30;
                      $cookie->value=md5($pwd);
                      \Yii::$app->response->getCookies()->add($cookie);
                    }
                    $session->set('user',$username);
                    $session->set('userid',$user['userid']);

                    echo "<script>alert('登录成功');location.href='".\Yii::$app->homeUrl."index/index';</script>";

            }
            else{
                 echo "<script>alert('密码或用户名错误');history.go(-1);</script>";
            }


        }
        else{
        return $this->render('user');}
    }

    //用户注册，设置session
     public function actionRegister()
    {
        ob_clean(); 
                $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                
                    $session=\Yii::$app->session;
                    if(!$session->isActive){ $session->open();
                    }

                    $session->set('user',$user->username);
                    $session->set('userid',$user['userid']);
                     echo "<script>alert('注册成功，正在跳转');location.href='".\Yii::$app->homeUrl."index/index';</script>";
                
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //测试用控制

    public function actionTest(){

        $model = new SignupForm();
        if ($model->load(\Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                
                    $session=\Yii::$app->session;
                    if(!$session->isActive){ $session->open();
                    }

                    $session->set('user',$user->username);
                    echo "<script>alert('注册成功，正在跳转');location.href='".\Yii::$app->homeUrl."index/index';</script>";
                
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

   //用户中心，根据act的值进行三种操作
    public function actionUsercenter(){
        check();
        ob_clean(); 

        if($_GET['userid']!=\Yii::$app->session->get('userid')){
            echo '禁止访问';
        }
        else{
            $userid=$_GET['userid'];
            $borrow=new borrow();
            if($_GET['act']=='onborrow'||$_GET['act']==null)
            {
                $data=Borrow::onborrow($userid);
        
            return $this->render('usercenter',$data);
            }
            else 
                if($_GET['act']=='historyborrow')
            {
                $data=Borrow::historyborrow($userid);

           return $this->render('usercenter',$data);
            }
            else{
                  $model = new ModifypwdForm();
                if ($model->load(\Yii::$app->request->post())) {
                  if ($model->modifypwd()) {
                    echo "<script>alert('修改成功');history(-1);</script>";
                                           }
                  else echo "<script>alert('密码错误');history(-1);</script>";
                  }
         return $this->render('usercenter', [
            'model' => $model
        ]);

            }

            // switch ($_GET['act']) {
            //     case 'onborrow':$data=onborrow();
            //         break;          
            //     case 'historyborrow':$data=historyborrow();
            //         break;
            //     case '':$data=onborrow();
            //         break;      

            // }
           

         
    }

    }

    //退出登录时，消除session和cookies
    public function actionLoginout(){
        check();
        $session=\Yii::$app->session;
        if(!$session->isActive){ $session->open(); }
        $session->destroy();
        $cookie=\Yii::$app->response->cookies;
        $cookie->remove('user');
        $cookie->remove('password');

        echo "<script>alert('退出成功，正在跳转');location.href='".\Yii::$app->homeUrl."index/index';</script>";


    }

    // public function actionUserlogin(){

    //     if(\Yii::$app->request->isPost){
    //         $username=trim($_POST['user']);
    //         $pwd=trim($_POST['password']);
    //         if($user=User::finduserbyusername($username)){
    //             if($user['userpassword']==md5($pwd))
    //             {
    //                 $session=\Yii::$app->session;
    //                 if(!$session->isActive){ $session->open();
    //                 }

    //                 $session->set('user',$username);
    //                 $session->set('userid',$user['userid']);

    //                 echo "<script>alert('登录成功');location.href='".\Yii::$app->homeUrl."?r=index/index';</script>";

    //             }
    //             else{
    //                 echo "<script>alert('密码错误');history.go(-1);</script>";
    //             }
    //         }
    //         else{
    //             echo "<script>alert('用户名不存在');history.go(-1);</script>";
    //         }


    //     }
    //     else
    //         echo '你进来干嘛！';
    // }




   
}

function check(){
    $session=\Yii::$app->session;
    $session->open();
    if($session->get('user')==null){
        echo '禁止非法登录';
        exit;
    }


}

     function historyborrow(){
            $userid=$_GET['userid'];
            $borrow=new borrow;
            $where['userid']=$userid;
            $data=array();
            $data['res']=$borrow::find()->select('borrowid,bookid,borrowtime,backtime,ifback')->where($where)->asArray()->all();
            for($i=0;$i<count($data['res']);$i++){
                $data['res'][$i]['bookid']=Book::getbook($data['res'][$i]['bookid']);
                switch ($data['res'][$i]['ifback']) {
                    case '0':$data['res'][$i]['ifback']='未归还';
                        break;
                    case '1':$data['res'][$i]['ifback']='待审核';
                        break;
                    case '2':$data['res'][$i]['ifback']='已归还';
                        break;        
                }
                
            }
           return $data;
    }

