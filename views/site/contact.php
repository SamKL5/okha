<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Контакты';
?>
<div class="site-contact">
    <h1 class="title-h1"><?= Html::encode($this->title) ?></h1>
        <div class="row">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::class, ['clientOptions' => ['alias' =>  'email'],])?>

                    <?= $form->field($model, 'description')->textArea(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-sale', 'style'=>'border-radius: 0;','name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-lg-6 contact">
                <h3>Почта:</h3>
                <p>okha@mail.ru</p>
                <h3>Адрес:</h3>
                <p>г. Санкт-Петербург, ул. Пушкина, дом 28</p>
                <h3>Телефон:</h3>
                <p>+7(912)345-67-89</p>
            </div>
            <div class="col-lg-12 maps">
            <div style="position:relative;overflow:hidden;">
            <a href="https://yandex.ru/maps/org/kolledzh_informatsionnykh_tekhnologiy/1177171854/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Колледж информационных технологий</a><a href="https://yandex.ru/maps/2/saint-petersburg/category/college/184106236/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Колледж в Санкт‑Петербурге</a><iframe src="https://yandex.ru/map-widget/v1/-/CCUFz4aYpA" width="100%" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
            </div>
            </div>
        </div>
</div>
