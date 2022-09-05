<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;

class AuthController extends Controller
{

    public function actionLogin(){
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            LoginForm::login();
            return $this->redirect('/admin/panel/index');
        }

        $session = Yii::$app->session;
        if ($session->has('auth_admin')) {
            return $this->redirect('/admin/panel/index');
        }

        $model->password = '';
        return $this->render('login',compact('model'));
    }

    public function actionLogout(){
        $session = Yii::$app->session;
        if ($session->has('auth_admin')) {
            $session->remove('auth_admin');
            return $this->redirect('/site/index');
        }
    }
}
