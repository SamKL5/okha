<?php

namespace app\modules\admin\models;

use Yii;

class Ticket extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'ticket';
    }

    public function rules()
    {
        return [
            [['fio', 'adress', 'tel', 'price', 'status'], 'required'],
            [['price', 'status'], 'integer'],
            ['tel', 'match', 'pattern' => '/^\+[0-9]\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/', 'message' => 'Время принимается только в формате: +7(999)999-99-99'],
            [['fio', 'adress', 'tel'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'adress' => 'Адрес',
            'tel' => 'Телефон',
            'price' => 'Цена',
            'status' => 'Статус',
        ];
    }

    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['id_ticket' => 'id']);
    }
}
