<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\modules\admin\models\Characteristic;

class JsController extends AdminController {

    public function actionType() {
        $this->layout = false;
        return $this->render('_input');
    }

    public function actionChars() {
        $res = '';
        if(isset($_POST['arr'])){
            $m = Characteristic::find()->where(['NOT IN','id',$_POST['arr']])->all();        
            foreach($m as $value){
                $res .= "<option value='".$value->id."'>".$value->name."</option>";
            }
        }else{
            $m = Characteristic::find()->all();        
            foreach($m as $value){
                $res .= "<option value='".$value->id."'>".$value->name."</option>";
            }
        }
        return $res;
        
    }

    public function actionValid(){
        $m = Characteristic::find()->count();
        if($_POST['validate'] < $m){
            return "1";
        }else{
            return "2";
        }
    }
}