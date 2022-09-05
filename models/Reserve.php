<?php

namespace app\models;

use Yii;

class Reserve extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'reserve';
    }

    public function rules()
    {
        return [
            [['id_ticket', 'id_product', 'count'], 'required'],
            [['id_ticket', 'id_product', 'count'], 'integer'],
            [['id_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['id_ticket' => 'id']],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ticket' => 'Id Ticket',
            'id_product' => 'Id Product',
            'count' => 'Count',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'id_ticket']);
    }
}
