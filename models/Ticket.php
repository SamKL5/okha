<?php

namespace app\models;
use app\models\Korzina;
use app\models\Products;

use Yii;

class Ticket extends \yii\db\ActiveRecord
{
    public $city;
    public $street;
    public $building;
    public $corp;
    public $flat;

    public static function tableName()
    {
        return 'ticket';
    }

    public function rules()
    {
        return [
            [['fio', 'adress', 'tel', 'price', 'status','city','street','building'], 'required'],
            [['price', 'status'], 'integer'],
            [['tel'], 'match', 'pattern' => '/^\+[0-9]\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/','message' => 'Введите телефон в правильном формате +7(999)999-99-99'],
            [['fio', 'adress', 'tel','city','street','building','corp','flat'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Фамилия Имя Отчество',
            'adress' => 'Ваш адрес',
            'tel' => 'Телефон',
            'price' => 'Price',
            'status' => 'Status',
            'city'=>'Город',
            'street' =>'Улица',
            'building' =>'Дом/Строение',
            'corp' =>'Корпус',
            'flat' =>'Квартира',
        ];
    }

    public function getReserves()
    {
        return $this->hasMany(Reserve::className(), ['id_ticket' => 'id']);
    }

    public function validateProd(){
        $model = new Korzina();
        if($all = $model->result()){
            foreach($all as $key => $value){
                if($key != array_key_last($all)){
                    if(Products::findOne($value['id']) && (Products::findOne($value['id'])->count > $value['count'])){
                        continue;
                    }else{
                        return false;
                    }
                }
            }
            return true;
        }
    }

    public function saveTicket($arr, $price){

        $this->fio = $arr['fio'];
        $this->adress = $arr['adress'];
        $this->tel = $arr['tel'];
        $this->price = $price;
        $this->status = 0;
        $this->adress .= "г.".$arr['city'].", ".$arr['street'].", д.".$arr['building'];
        if($arr['corp'] != ''){
            $this->adress .= ", корпус ".$arr['corp'];
        }
        if($arr['flat'] != ''){
            $this->adress .= ", кв. ".$arr['flat'];
        }
        
        if($this->save()){
            $model = new Korzina();
            $all = $model->result();
                    foreach($all as $key => $value){
                        if($key != array_key_last($all)){
                            $model_reserve = new Reserve();
                            $model_reserve->id_ticket = $this->id;
                            $model_reserve->id_product = $value['id'];
                            $model_reserve->count = $value['count'];
                            if($model_reserve->save()){
                                $prod = Products::findOne($value['id']);
                                $prod->count = $prod->count - $value['count'];
                                $prod->save();
                            }
                        }
                    }
            $session = Yii::$app->session;
            $session->open();
            if (!$session->has('basket')) {
                $session->set('basket', []);
                $basket = [];
            } else {
                $basket = $session->get('basket');
            }
                unset($basket['products']);
                $session->set('basket', $basket);
            return true;
        }else{
            return false;
        }
    }
}
