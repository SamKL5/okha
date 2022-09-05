<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'fio',
            [
                'attribute' => 'address',
                'format' => 'raw',
                'value' => function($d){
                    return "<a href='".Url::to(['/admin/ticket/view', 'id' => $d->id])."'>".$d->adress."</a>";
                },
            ],
            [
                'attribute' => 'tel',
                'label' => 'Телефон',
                'format' => 'raw',
                'options' => ['width' => '70'],
                'value' => function($d){
                    return $d->tel;
                },
            ],
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
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return $d->price." руб";
                },
            ],
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
                    <input type='button' class='subTicket' value='Изменить'>
                    <input type='hidden'value='".$d->id."'>";
                    return $result;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
