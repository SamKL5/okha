<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Ticket */

$this->title = $model->adress;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот заказ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fio',
            'adress',
            'tel',
            [
                'attribute' => 'reserve',
                'label' => 'Состав',
                'format' => 'raw',
                'value' => function($d){
                    $arr = '';
                    foreach($d->reserves as $v){
                        $arr .= "<p><a href='".Url::to(['/admin/product/view', 'id' => $v->id_product])."'>".
                        $v->product->name."</a> ".
                        $v->count." шт.</p>";
                    };
                    return $arr;
                },
            ],
            'price',
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'format' => 'raw',
                'options' => ['width' => '50'],
                'value' => function($d){
                    $result = "<select>
                    <option value='0' "; if($d->status == 0) $result .= "selected"; $result .= ">Ожидание</option>
                    <option value='1' "; if($d->status == 1) $result .= "selected"; $result .= ">В пути</option>
                    <option value='2' "; if($d->status == 2) $result .= "selected"; $result .= ">Доставлено</option>
                    </select>
                    <input type='button' class='subTicket' style='width: 20%;' value='Изменить'>
                    <input type='hidden'value='".$d->id."'>";
                    return $result;
                },
            ],
        ],
    ]) ?>

</div>
