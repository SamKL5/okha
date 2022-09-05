<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Материалы для рамы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frame-materials-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить материал для рамы', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            // 'id',
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($d){
                    return "<a href='".Url::to(['/admin/frame-materials/view', 'id' => $d->id])."'>".$d->name."</a>";
                },
            ],
            [
                'attribute' => 'material',
                'format' => 'raw',
                'value' => function($d){
                    return "<img class='admin-img material-img' src='../../".$d->material."'><br>";
                },
            ],
            'tickness',
            'length',
            'price',
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
