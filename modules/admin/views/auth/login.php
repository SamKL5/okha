<?php
use app\models\User;

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
?>
<div class='form-auth'>
    <p>Авторизация</p>
    <?php $form = ActiveForm::begin([
        // 'options' => ['class' => 'form-auth',],
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        ],
    ]); ?>

        <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= Html::submitButton('Войти') ?>

    <?php ActiveForm::end(); ?>
</div>
