<?php
namespace app\modules\admin\models;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName()
    {
        return 'users';
    }

    public function rules(){
        return [
            [['login', 'password'], 'required'],
            [['login'], 'unique','message'=>'Такой пользователь уже существует'],
            [['login', 'password'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }
 
    public static function findByLogin($login){
         return static::findOne(['login' => $login]);
    }
 
     public static function findIdentityByAccessToken($token, $type = null){
 
     }
 
     public function getId(){
         return $this->id;
     }
 
 
     public function getAuthKey(){
         return $this->authKey;
     }
     public function validateAuthKey($authKey){
         return $this->authKey === $authKey;
     }
     public function validatePass($password){
         return $this->password === md5($password);
     }
}
