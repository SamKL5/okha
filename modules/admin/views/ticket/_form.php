<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="ticket-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '+7([9]{3})[9]{3}-[9]{2}-[9]{2}',]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        '0' => 'Ожидание',
        '1' => 'В пути',
        '2'=>'Доставлен',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
