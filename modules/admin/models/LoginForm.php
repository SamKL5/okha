<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\modules\admin\models\User;

class LoginForm extends Model
{
    public $login;
    public $password;

    private $_user = false;

    public function rules(){
        return [   
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max'=>100],
            ['password', 'validatePass'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function validatePass($at){
        if (!$this->hasErrors()){
            $user = $this->getUser();
            if (!$user || !$user->validatePass($this->password)) {
                $this->addError($at, 'Неверный логин или пароль');
            }
        }
    }

    public static function login(){
        $session = Yii::$app->session;
        $session->open();
        $session->set('auth_admin', true);
    }

    public function getUser(){
        if ($this->_user === false) {
            $this->_user = User::findByLogin($this->login);
        }
        return $this->_user;
    }
}
