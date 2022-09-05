<?php

namespace app\modules\admin\models;
use app\modules\admin\models\Parametrs;
use Yii;

class Characteristic extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'characteristic';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'unit'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'unit' => 'Единица измерения',
        ];
    }

    public function getParametrs()
    {
        return $this->hasMany(Parametrs::className(), ['id_char' => 'id']);
    }

}
