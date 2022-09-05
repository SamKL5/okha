<?php

namespace app\modules\admin\models;

use Yii;

class Parametrs extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'parametrs';
    }

    public function rules()
    {
        return [
            [['id_product', 'id_char', 'value'], 'required'],
            [['id_product', 'id_char'], 'integer'],
            ['value', 'string'],
            [['id_char'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::className(), 'targetAttribute' => ['id_char' => 'id']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'id_char' => 'Параметр',
            'value' => 'Значение',
        ];
    }

    public function getChar()
    {
        return $this->hasOne(Characteristic::className(), ['id' => 'id_char']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    public function updateParametrs($id){
        return Parametrs::deleteAll('id_product=:id', [':id' => $id]);
    }
}
