<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\modules\admin\models\Characteristic;

class PanelController extends AdminController {
    public function actionIndex(){
        return $this->render('index');
    }
}
