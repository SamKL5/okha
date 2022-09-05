
<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

    $form = ActiveForm::begin(['enableAjaxValidation' => true,]); ?>
    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'building')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'corp')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'flat')->textInput(['maxlength' => true]) ?>
<?php
// echo MaskedInput::widget([
//     'name' => 'tel',
//     'mask' => '9-a{1,3}9{1,3}'
// ]);
?>
<?php
    //  echo ($form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::class, [
    // 'mask' => '999-999-9999',])) 
    ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>