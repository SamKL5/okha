<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\Models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\Models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => '/admin/product/index'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот товар?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            [
                'attribute' => 'picture',
                'label' => 'Картинка',
                'format' => 'raw',
                'options' => ['width' => '100'],
                'value' => function($d){
                    return "<img class='admin-img' src='../../".$d->picture."'>";
                },
            ],
            [
                'attribute' => 'ch',
                'label' => 'Параметры',
                'format' => 'raw',
                'value' => function($d){
                    $arr = null;
                    foreach($d->parametrs as $v){
                        $arr .= "<p>".$v->char->name.": ".$v->value." ".$v->char->unit."</p>";
                    };
                    return $arr;
                },
            ],
            [
                'attribute' => 'id_category',
                'format' => 'raw',
                'value' => function($d){
                  return $d->category->name;
                },
            ],
            [
                'attribute' => 'price',
                'label' => 'Цена',
                'format' => 'raw',
                'options' => ['width' => '70'],
                'value' => function($d){
                    return $d->price." руб.";
                },
            ],
            [
                'attribute' => 'count',
                'label' => 'Кол-во',
                'format' => 'raw',
                'options' => ['width' => '70'],
                'value' => function($d){
                    return $d->count." шт.";
                },
            ],
        ],
    ]) ?>

</div>
