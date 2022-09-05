<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "frame_materials".
 *
 * @property int $id
 * @property string $name
 * @property string $material
 * @property float $tickness
 * @property float $length
 * @property float $price
 * @property float $count
 */
class FrameMaterials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $pic;
    public static function tableName()
    {
        return 'frame_materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'material', 'tickness', 'length', 'price', 'count'], 'required'],
            [['tickness', 'length', 'price', 'count'], 'number'],
            [['pic'], 'image', 'extensions' => 'jpeg, png, jpg'],
            [['name', 'material'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'pic' => 'Материал(паттерн)',
            'material' => 'Материал(паттерн)',
            'tickness' => 'Толщина',
            'length' => 'Длина',
            'price' => 'Цена за кв.метр',
            'count' => 'Кол-во',
        ];
    }

    public function createMaterial($arr){
        $temp_pic = $arr->material;
        if($arr->pic = UploadedFile::getInstance($arr,'pic')){
            $temp_name ='material_'.time().'.'.$arr->pic->extension;
            if($arr->pic->saveAs('uploads/frame_material/'.$temp_name )){             
                if(!empty($temp_pic) && file_exists($temp_pic)){
                    unlink($temp_pic);
                }
                $arr->material = 'uploads/frame_material/'.$temp_name ;
            }
        }else{
            $arr->material=$temp_pic;
        }
        $arr->save(false);
        return true;
    }
}
