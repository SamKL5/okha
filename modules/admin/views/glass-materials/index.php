<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материалы для стекла';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="glass-materials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать материал для стекла', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            // 'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($d){
                    return "<a href='".Url::to(['/admin/glass-materials/view', 'id' => $d->id])."'>".$d->name."</a>";
                },
            ],
            [
                'attribute' => 'color',
                'format' => 'raw',
                'value' => function($d){
                    return "<img class='admin-img material-img' style='background-color: ".$d->color."'><br>";
                },
            ],
            'type',
            'area',
            //'price/sm2',
            //'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
