<?php

namespace app\modules\admin\controllers;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\Parametrs;
use app\modules\admin\models\Characteristic;
use app\modules\admin\models\ProductsSearch;

use Yii;


class ProductController extends AdminController
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel, 
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Products();
        $model2 = new Parametrs();
        
        if ($this->request->isPost){
            if ($model->load($this->request->post()) && $model2->load($this->request->post())) {
                if(isset($model2->id_char) && isset($model2->value) && !empty(array_diff($model2->id_char,  array('', NULL, false)))
                 && !empty(array_diff($model2->value,  array('', NULL, false)))){
                $model->createProduct($model);
                    if($model->saveProduct($model, $model2)){
                        Yii::$app->session->setFlash('success', 'Товар успешно создан');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }else{
                    Yii::$app->session->setFlash('error', 'Нужно присвоить хотя бы 1 параметр');
                    $model->loadDefaultValues();
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'model2'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new Parametrs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model2->load($this->request->post())) {
            $model->createProduct($model);
            $model2->updateParametrs($id);
                if($model->saveProduct($model, $model2)){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }else{
            $model2 = $this->findModel2($id);
        }
        return $this->render('update', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }

    public function actionDelete($id)
    {
       $model=$this->findModel($id);

       if($model->validReserve($id)){
            if(file_exists($model->picture)){
                unlink($model->picture);
            }
            Parametrs::deleteAll('id_product=:id', [':id' => $id]);
            $model->delete();
            return $this->redirect(['index']);
       }else{
            Yii::$app->session->setFlash('error', 'Нельзя удалить товар, потому что он уже в составе заказа');
            return $this->redirect(['index']);
       }
       
    }

    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel2($id)
    {
        if (($model2 = Parametrs::find()->where('id_product=:id', [':id' => $id])->all()) !== null) {
            return $model2;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
