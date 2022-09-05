<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

class AdminController extends Controller {

    public function beforeAction($action) {
        $session = Yii::$app->session;
        $session->open();
        if (!$session->has('auth_admin')) {
            $this->redirect('/admin/auth/login');
            return false;
        }
        return parent::beforeAction($action);
    }
}