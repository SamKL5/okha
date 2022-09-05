<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\admin\Models\Category;
use mihaildev\ckeditor\CKEditor;
use app\modules\admin\Models\Characteristic;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\Models\Products */

$this->title = 'Изменить товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => '/admin/product/index'];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="products-update">

    <h1><?= Html::encode($this->title) ?></h1>

<div class="products-form">

<?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?php foreach($model2 as $m2){ ?>

<div class='char_list' id="charli">
    <div class="char field-parametrs-id_char required">
        <label class="control-label" for="parametrs-id_char">Параметр</label>
        <select id="parametrs-id_char" onfocus="opt(this)" class="form-control" name="Parametrs[id_char][]">
        <option value = "<?= $m2->id_char?>"><?= $m2->char->name ?></option>
        </select>
        <div class="help-block"></div>
    </div>
    <div class="char field-parametrs-value required">
        <label class="control-label" for="parametrs-value">Значение</label>
        <input type="text" id="parametrs-value" class="form-control" value="<?= $m2->value?>" name="Parametrs[value][]">
        <div class="help-block"></div>
    </div>
    <a class="delete-char" onclick="deleteChar(this)">Удалить</a>
</div>

<?php } ?>
<div class='link-to-add'><a  onclick="types()" >Добавить поле</a></div>

<?php
// echo($form->field($model, 'description')->textarea(['rows' => 6]));
?>

<?=
        $form->field($model, 'description')->widget(
            CKEditor::className(),
            [
                'editorOptions' => [
                    // варианты: basic, standard, full
                    'preset' => 'basic',
                    // значение по умолчанию false
                    'inline' => false,
                ],
            ]
        );
?>


<?= $form->field($model, 'pic')->fileInput() ?>

<?= $form->field($model, 'id_category')->dropDownList(ArrayHelper::map(Category::find()->all(),'id','name')); ?>

<?= $form->field($model, 'price')->textInput() ?>

<?= $form->field($model, 'count')->textInput() ?>


<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>


</div>
</div>
