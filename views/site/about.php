<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

$this->title = 'О нас';
echo '<div class="about-info"><h1 class="title-h1">'.Html::encode($this->title).'</h1>';
?>
<?= $model->value ?>
</div>
<?php 
if(Yii::$app->session->has('auth_admin')){
    $form = ActiveForm::begin(['id' => 'dynamic-form']);
    echo ($form->field($model, 'value')->label('')->widget(
        CKEditor::className(),
        [
            'editorOptions' => [
                'preset' => 'basic',
                'inline' => false,
            ],
        ]
        ));
    echo '<div class="form-group">';
    echo (Html::submitButton('Сохранить изменения', ['class' => 'btn btn-success']) );
    ActiveForm::end();
}
echo '</div>';
?>