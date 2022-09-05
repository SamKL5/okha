<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "support".
 *
 * @property int $id
 * @property string $email
 * @property string $description
 * @property string $date
 * @property int $status
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'description', 'date', 'status'], 'required', 'message' => 'Это обязательно поле'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Ваш адрес электронной почты',
            'description' => 'Описание вопроса',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}
