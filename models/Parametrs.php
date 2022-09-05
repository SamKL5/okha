<?php

namespace app\models;
use app\models\Characteristic;
use app\models\Products;
use Yii;

class Parametrs extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'parametrs';
    }

    public $name;
    public $price_min;
    public $price_max;
    public $price;

    public function rules()
    {
        return [
            ['name', 'string'],
            [['id_product', 'id_char', 'value'], 'required'],
            [['id_product', 'id_char', 'value','price_min','price_max'], 'integer'],
            [['id_char'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::className(), 'targetAttribute' => ['id_char' => 'id']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'id_char' => 'Id Char',
            'value' => 'Value',
        ];
    }
    public function searchProducts($arr, $id_category){
        $somefilters = false;
        $somefilters_num = false;
        foreach($arr->value as $key => $v){
            if(!empty($v)){
                    $somefilters = true;
                    $id = Characteristic::findOne(['name'=>$key])->id;
                    if(is_Array($v)){       
                        foreach($v as $val){
                            if($model = Parametrs::find()->andWhere(['id_char'=>$id,'value'=>$val])->all()){
                                foreach($model as $id_prod){
                                    $all_str[$id][]=$id_prod->id_product;
                                }
                            }
                        }
                    }else{
                        $somefilters_num = true;
                        if($model1 = Parametrs::find()->orWhere(['id_char'=>$id,'value'=>$v,])->all()){
                            foreach($model1 as $id_prod){
                                $all_num[$id][]=$id_prod->id_product;
                            }
                        }
                    }
            }
        }

        $res=array();
        $res1=array();
        if(isset($all_num) && !empty($all_num)){
            $temp_arr = $all_num[array_key_first($all_num)];
            foreach($all_num as $key=>$res_id){
                if(count($all_num) != 1 ){
                    if($key != array_key_first($all_num)){
                        foreach(array_intersect($temp_arr,$all_num[$key]) as $res_id){
                            $res[]=$res_id;
                        }
                    }
                }else{
                    foreach(array_intersect($temp_arr,$all_num[$key]) as $res_id){
                        $res[]=$res_id;
                    }
                }
                $temp_arr = $all_num[$key];
            }
        }else{
            if($somefilters){
                if(!$somefilters_num){
                    foreach(Parametrs::find()->all() as $val){
                        $res[]=$val->id_product;
                    }
                }
            }else{
                foreach(Parametrs::find()->all() as $val){
                    $res[]=$val->id_product;
                }
            }
        }

    if(isset($all_str) && !empty($all_str)){
        $temp_arr = $all_str[array_key_first($all_str)];
        foreach($all_str as $key=>$res_id){
            foreach(array_intersect($temp_arr,$all_str[$key]) as $res_id){
                if(in_array($res_id, $res1)){
                    unset($res1);
                }
                $res1[]=$res_id;
            }
            $temp_arr = $all_str[$key];
        }
    }else{
        if($somefilters){
            if($somefilters_num){
                if(empty($res)){
                    $res1[] = null;
                }else{
                    foreach(Parametrs::find()->all() as $val){
                        $res1[]=$val->id_product;
                    }
                }
            }else{
                $res1[] = null;
            }
        }else{
            foreach(Parametrs::find()->all() as $val){
                $res1[]=$val->id_product;
            }
        }
    }

        if(empty($arr->price_min) || ($arr->price_min < Products::find()->min('price')) || ($arr->price_max < $arr->price_min)){
            $arr->price_min = Products::find()->min('price');
        }
        if(empty($arr->price_max) || ($arr->price_max > Products::find()->max('price')) || ($arr->price_max < $arr->price_min)){
            $arr->price_max = Products::find()->max('price');
        }

        if(!($result_id = array_intersect($res, $res1))) {
            $result_id[] = 0;
        }

        $result = Products::find()
        ->andFilterWhere(['IN', 'id', $result_id])
        ->andFilterWhere(['id_category' => $id_category])
        ->andFilterWhere(['BETWEEN', 'price', $arr->price_min, $arr->price_max])
        ->all();
        return $result;
        
    
    }
    public function price(){
        $prices=[
            'price_min' => Products::find()->min('price'),
            'price_max' => Products::find()->max('price'),
        ];
        return $prices;
    }

    public function getChar()
    {
        return $this->hasOne(Characteristic::className(), ['id' => 'id_char']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }
}
