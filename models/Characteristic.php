<?php

namespace app\models;

use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Yii;
use app\models\Products;
use PDO;

class Characteristic extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'characteristic';
    }

    public function rules()
    {
        return [
            [['name', 'unit'], 'required'],
            [['name', 'unit'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'unit' => 'Unit',
        ];
    }

    public function optionChar($category){
        $prod = static::find()
        ->with('parametrs')
        ->all();
        $arr1 = array();

        $prods = (new Products())->find()->where(['id_category'=> $category])->with('parametrs')->all();
        $all_id = '';
        foreach($prods as $key=>$v){
            $emp = 0;
            foreach($v->parametrs as $v1){
                if($v1->id_char == 1 || $v1->id_char == 2){
                    $emp++;
                }
            }
            if($emp==2) $all_id.=' '.$v->id;
        }

        foreach($prods as $ty){
            $temp = null;
            $emp1 = 0;
            foreach($ty->parametrs as $ty2){
                if (strpos($all_id, (string)$ty2->id_product) !== false){
                    if($ty2->id_char == 1){
                            $temp .= $ty2->value."x";
                            $emp1++;
                    }
                }
            }
            foreach($ty->parametrs as $ty2){
                if (strpos($all_id, (string)$ty2->id_product) !== false){
                    if($ty2->id_char == 2){
                        $temp .= $ty2->value;
                        $emp1++;
                    }
                }
            }

            if($emp1 == 2){
                array_push($arr1, $temp);
                $filter['Размер']=array_unique($arr1);
            }
        }
        $arr1 = array();
        foreach($prod as $d){
            if(!empty($d->parametrs) && ($d->name != 'Высота') && ($d->name != 'Ширина')){
                    foreach($d->parametrs as $t){ 
                        if(!($t->id_char == 1 || $t->id_char == 2)){
                            if(!is_numeric($t->value)){
                                array_push($arr1, $t->value);
                            }
                        }
                    }   
                    $filter[''.$d->name.'']=array_unique($arr1);
                    $arr1 = array();
            }
        }
        return $filter;
    }

    public function getParametrs()
    {
        return $this->hasMany(Parametrs::className(), ['id_char' => 'id']);
    }
}
