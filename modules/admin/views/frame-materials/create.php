<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\FrameMaterials */

$this->title = 'Добавить материал для рамы';
$this->params['breadcrumbs'][] = ['label' => 'Материалы для рамы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frame-materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
