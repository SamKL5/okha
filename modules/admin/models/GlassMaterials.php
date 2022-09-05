<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "glass_materials".
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property string $type
 * @property float $area
 * @property float $price/sm2
 * @property int $count
 */
class GlassMaterials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glass_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'color', 'type', 'area', 'price', 'count'], 'required'],
            [['area', 'price'], 'number'],
            [['count'], 'integer'],
            [['name', 'color', 'type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'color' => 'Цвет',
            'type' => 'Тип стекла',
            'area' => 'Площадь',
            'price' => 'Цена за кв.см',
            'count' => 'Кол-во',
        ];
    }
}
