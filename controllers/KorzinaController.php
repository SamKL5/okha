<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Korzina;
use app\models\Ticket;


class KorzinaController extends Controller{

    public function actionIndex(){
        $korzina = new Korzina();
        $res = $korzina->result();
        $model = new Ticket();

        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            $res = $korzina->result();
            if($model->validateProd()){
                if($model->saveTicket($model,$res[1])){
                        Yii::$app->session->setFlash('success', 'Заказ успешно оформлен');
                        return $this->redirect('/korzina/index');
                }
            }else{
                return $this->render('index', compact('res','model'));
            }
        }

        return $this->render('index', compact('res','model'));
    }

    public function actionAddProd(){
        if (Yii::$app->request->isAjax) {
            $korzina = new Korzina();
            return $korzina->add($_POST['id_p']);
        }
       
    }

    public function actionAllProds(){
        if (Yii::$app->request->isAjax) {
            $korzina = new Korzina();
            return $korzina->all_prods();
        }
    }
    public function actionRemoveProd(){
        if (Yii::$app->request->isAjax) {
            $korzina = new Korzina();
            return $korzina->remove($_POST['id_p']);
        }
    }

    public function actionRemoveAll(){
        if (Yii::$app->request->isAjax) {
            $korzina = new Korzina();
            return $korzina->removeAll($_POST['id_p']);
        }
    }
}