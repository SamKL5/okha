<?php

namespace app\modules\admin\models;

use Yii;

class Support extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'support';
    }

    public function rules()
    {
        return [
            [['email', 'description', 'date', 'status'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'description' => 'Описание',
            'date' => 'Дата',
            'status' => 'Статус',
        ];
    }
}
