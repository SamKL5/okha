<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Products;

class Korzina extends Model{
    public function add($id){
        $session = Yii::$app->session;
        $session->open();

        if (!$session->has('basket')) {
            $session->set('basket', []);
            $basket = [];
        } else {
            $basket = $session->get('basket');
        }

        if(isset($basket['products']['product_'.$id])){
            $count = $basket['products']['product_'.$id]['count'];
            $count ++;
        }else{
            $count = 1;
        }

        $model = Products::findOne($id);
        $basket['products']['product_'.$id]['id'] = $model->id;
        $basket['products']['product_'.$id]['name'] = $model->name;
        $basket['products']['product_'.$id]['count'] = $count;
        $session->set('basket', $basket);
        return $count;
    }

    public function remove($id){
        $session = Yii::$app->session;
        $session->open();

        if (!$session->has('basket')) {
            $session->set('basket', []);
            $basket = [];
        } else {
            $basket = $session->get('basket');
        }

        if(isset($basket['products']['product_'.$id]) && $basket['products']['product_'.$id]['count'] > 0){
            $count = $basket['products']['product_'.$id]['count'];
            $count--;
            $model = Products::findOne($id);
            $basket['products']['product_'.$id]['id'] = $model->id;
            $basket['products']['product_'.$id]['name'] = $model->name;
            $basket['products']['product_'.$id]['count'] = $count;
        }
        if($count == 0){
            unset($basket['products']['product_'.$id]);
        }
        $session->set('basket', $basket);
        return $count;
    }

    public function removeAll($id){
        $session = Yii::$app->session;
        $session->open();

        if (!$session->has('basket')) {
            $session->set('basket', []);
            $basket = [];
        } else {
            $basket = $session->get('basket');
        }
            unset($basket['products']['product_'.$id]);
            $session->set('basket', $basket);
    }

    public function result(){
        $fullprice = 0;
        $mas = array();
        $session = Yii::$app->session;
        $session->open();
        if(!empty($session['basket']['products'])){
        foreach($session['basket']['products'] as $val){
            $arr = Products::findOne($val['id']);
            $fullprice += $arr->price * $val['count'];
            $mas[] = array(
                'id' => $val['id'],
                'name' => $arr->name,
                'picture' => $arr->picture,
                'price' => $arr->price * $val['count'],
                'count' => $val['count'],
            );
        }
        $mas[]= $fullprice;
        }
        return $mas;
    }

    public function all_prods(){
        $session = Yii::$app->session;
        $session->open();
        $res = 0;
        $fullprice = 0; 
        if(isset($session['basket']['products'])){
            foreach($session['basket']['products'] as $val){
                $arr = Products::findOne($val['id']);
                $fullprice += $arr->price * $val['count'];
                $res += $val['count'];
            }
        }
        $mas=array($res, $fullprice);
        return json_encode($mas);
    }
}