<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\Models\Category;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\Pjax;
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class='char_list' id="charli">
        <div class="char field-parametrs-id_char required">
            <label class="control-label" for="parametrs-id_char">Параметр</label>
            <select id="parametrs-id_char" onfocus="opt(this)" class="form-control" name="Parametrs[id_char][]">
            
            </select>
            <div class="help-block"></div>
        </div>
        <div class="char field-parametrs-value required">
            <label class="control-label" for="parametrs-value">Значение</label>
            <input type="text" id="parametrs-value" class="form-control" name="Parametrs[value][]">
            <div class="help-block"></div>
        </div>
        <a class='delete-char' onclick="deleteChar(this)">Удалить</a>

    </div>
    <div class='link-to-add'  onclick="types()" ><a>Добавить поле</a></div>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pic')->fileInput() ?>

    <?= $form->field($model, 'id_category')->dropDownList(ArrayHelper::map(Category::find()->all(),'id','name')); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


