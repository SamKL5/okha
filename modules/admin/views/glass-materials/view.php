<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\GlassMaterials */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Материалы для стекла', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="glass-materials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот материал для стекла?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            [
                'attribute' => 'color',
                'format' => 'raw',
                'value' => function($d){
                    return "<img class='admin-img material-img' style='background-color: ".$d->color."'><br>";
                },
            ],
            'type',
            'area',
            'price',
            'count',
        ],
    ]) ?>

</div>
