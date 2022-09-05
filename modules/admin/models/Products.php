<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;
use app\modules\admin\models\Parametrs;
use app\modules\admin\models\Reserve;


class Products extends \yii\db\ActiveRecord
{
  
    public static function tableName()
    {
        return 'products';
    }

    public $pic;

   
    public function rules()
    {
        return [
            [['name', 'description', 'picture', 'price', 'count', 'id_category'], 'required'],
            [['description'], 'string'],
            [['price', 'count', 'id_Category'], 'integer'],
            [['name', 'picture'], 'string', 'max' => 100],
            [['pic'], 'image', 'extensions' => 'jpeg, png, jpg'],
            [['id_Category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_Category' => 'id']],
        ];
    }

   
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'picture' => 'Картинка123',
            'pic' => 'Картинка',
            'price' => 'Цена',
            'count' => 'Количество',
            'id_category' => 'Категория',
        ];
    }

    
    public function createProduct($arr){
        $temp_pic = $arr->picture;
        if($arr->pic = UploadedFile::getInstance($arr,'pic')){
            $temp_name ='product_'.time().'.'.$arr->pic->extension;
            if($arr->pic->saveAs('uploads/'.$temp_name )){                   
                if(file_exists($temp_pic)){
                    unlink($temp_pic);
                }
                $arr->picture = 'uploads/'.$temp_name ;
            }
        }else{
            $arr->picture=$temp_pic;
        }
        return $arr;
    }



    public function saveProduct($arr, $arr2){
        if($arr->save(false)){
            $id = $arr->id;
            if($this->saveModel2($arr2, $id)){
                return true;
            } 
        }else{
            return false;
        }
    }

    public function saveModel2($arr2, $id){
        foreach($arr2['id_char'] as $key1 => $item1){
            foreach($arr2['value'] as $key2 => $item2){
                if($key1 == $key2){
                    $model_par = new Parametrs();
                    $model_par->id_product = $id;
                    $model_par->id_char = $item1;
                    $model_par->value = $item2;
                    $model_par->save();
                }
            }
        }
        return true;
    }

    public function validReserve($id){
        if(Reserve::find()->where('id_product=:id', [':id' => $id])->all()){
            return false;
        }else{
            return true;
        }
    }

   
    public function getParametrs()
    {
        return $this->hasMany(Parametrs::className(), ['id_product' => 'id']);
    }

    
    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['id_product' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }
}
