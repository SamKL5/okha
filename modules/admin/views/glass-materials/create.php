<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\GlassMaterials */

$this->title = 'Создать материал для стекла';
$this->params['breadcrumbs'][] = ['label' => 'Материалы для стекла', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="glass-materials-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
