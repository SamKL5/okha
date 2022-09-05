<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'description:ntext',
            [
                'attribute' => 'picture',
                'label' => 'Картинка',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return "<img class='admin-img' src='../../".$d->picture."'><br>";
                },
            ],
            // [
            //     'attribute' => 'ch',
            //     'label' => 'Параметры',
            //     'format' => 'raw',
            //     'value' => function($d){
            //         $arr = null;
            //         foreach($d->parametrs as $v){
            //             $arr .= "<p>".$v->char->name.": ".$v->value." ".$v->char->unit."</p>";
            //         };
            //         return $arr;
            //     },
            // ],
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return $d->price." руб.";
                },
            ],
            [
                'attribute' => 'count',
                'label' => 'Кол-во',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return $d->count." шт.";
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
