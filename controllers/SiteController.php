<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Parametrs;
use app\models\Products;
use app\models\Characteristic;
use app\models\Support;
use app\models\Site;
use app\modules\admin\models\GlassMaterials;
use app\modules\admin\models\FrameMaterials;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex(){
        $model = new Products();
        $result = $model->getProductsForMain(null);
        $min = $model->find()->min('price');
        return $this->render('index', compact('result', 'min'));
    }

    public function actionCatalog($category){
        $filter = (new Characteristic())->optionChar($category);
        $param = new Parametrs();
        $prices = $param->price();
        if($val = Yii::$app->request->post()){ 
            $val['Parametrs']['value']['Высота']='';
            $val['Parametrs']['value']['Ширина']='';
            if(isset($val['Parametrs']['value']['Размер'])){
                $arr_razmer = explode("x", $val['Parametrs']['value']['Размер']);
                $val['Parametrs']['value']['Высота'] = $arr_razmer[0];
                $val['Parametrs']['value']['Ширина'] = $arr_razmer[1];
            }
            unset($val['Parametrs']['value']['Размер']);

            if($param->load($val)){
                $result = $param->searchProducts($param, $category);
            }else{
                $result = Products::find()->where(['id_category' => $category])->all();
            }
        }else{
            $result = Products::find()->where(['id_category' => $category])->all();
        }
        
        return $this->render('catalog', compact('result', 'filter', 'param', 'prices'));
    }

    public function actionProduct($id){
        $result = (new Products())->getProductsForMain($id);
        $model = Products::findOne($id);
        return $this->render('product', compact('model', 'result'));
    }

    public function actionContact()
    {
        $model = new Support();
        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            $model->status = 0;
            $model->save();
            Yii::$app->session->setFlash('success','Ваше сообщение принято, ожидайте ответа');
            return $this->refresh();
            
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        $model = Site::findOne(['name'=>'about']);
        if($model->load(Yii::$app->request->post())){
            $model->save();
        }
        return $this->render('about',compact('model'));
    }

    public function actionKonst()
    {
        $category = (new Category())->find()->all();
        $model = (new FrameMaterials())->find()->all();
        $model2 = (new GlassMaterials())->find()->all();
        return $this->render('konst',compact('model','model2','category'));
    }
    public function actionCreate($id_frame, $id_glass,$w,$h, $t)
    {
        $this->layout = false;
        $model = (new FrameMaterials())->findOne(['id'=>$id_frame]);
        $model2 = (new GlassMaterials())->findOne(['id'=>$id_glass]);
        return $this->render('konst_form',compact('model','model2','w','h','t'));
    }
}
