<?php

namespace app\models;

use Yii;
use yii\db\Expression;

class Products extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'products';
    }
    public function rules()
    {
        return [
            [['name', 'description', 'picture', 'price', 'count'], 'required'],
            [['description'], 'string'],
            [['price', 'count'], 'integer'],
            [['name', 'picture'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'picture' => 'Picture',
            'price' => 'Price',
            'count' => 'Count',
        ];
    }

    public function getParametrs()
    {
        return $this->hasMany(Parametrs::className(), ['id_product' => 'id']);
    }

    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['id_product' => 'id']);
    }

    public function getProductsForMain($id){
        $model = Products::find()
        ->andFilterWhere(['NOT IN','id',$id])
        ->orderBy(new Expression('rand()'))
        ->limit(5)
        ->all();
        return($model);
    }
}
