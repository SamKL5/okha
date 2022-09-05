<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Products;
use yii\widgets\Pjax;

$session = Yii::$app->session;
$session->open();
?>

<h1 class='title-h1' style="margin-top: 50px;">Корзина</h1>
<?php 
Pjax::begin();
?>
<?php
if(!empty($res)){
foreach($res as $key => $val){
    if($key != array_key_last($res)){
?>
<div class='tovar-korz' id='result_prod_<?=$val["id"]?>'>
<div class='div-img-korz' style='background-image: url("../<?= $val['picture']?>")'></div>
<div class='name-korz'><p><?=$val['name']?></p></div>

<div class="price-korz">
    <div class='count_add' id='add_prod_<?=$val["id"]?>'>
        <a href='/korzina/index' onclick='remove_res(<?=$val["id"] ?>)'>-</a>
        <a class='val_prod' id='prod_<?=$val["id"]?>'><?php
        if(isset($session['basket']['products']['product_'.$val["id"]]['count'])){
            echo($session['basket']['products']['product_'.$val["id"]]['count']);
        };?></a>
        <a href='/korzina/index' onclick='add(<?=$val["id"]?>)'>+</a>
    </div>
</div>

<div class='prodprice-korz'><p><?= $val['price']?> руб.</p></div>
<div><a href='/korzina/index' onclick='removeAll(<?=$val["id"] ?>)'>Очистить</a></div>
</div>

<?php }}?>
<p class='p-korz' >Итого: <span id='fullprice'><?=$res[array_key_last($res)];?></span> рублей</p>
<button onclick='showForm()' class='btn btn-zakaz' id='showForm'>Оформить заказ</button>

<?php 

    $form = ActiveForm::begin(['options' => ['class' => 'form-result', 'data-pjax' => true],]); ?>
    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
    <div class='address-korz'><p>Заполните адрес:<span style='color:red;'>*</span></p>
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'building')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'corp')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'flat')->textInput(['maxlength' => true]) ?>
    </div>
    <?=$form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '+7([9]{3})[9]{3}-[9]{2}-[9]{2}',])?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success-zakaz']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php }else{?>
    <p>В корзине ничего нет</p>
    <?php }?>
<?php Pjax::end();?>
