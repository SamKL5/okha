<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
// debug($model)
$session = Yii::$app->session;
$session->open();
?>
<section class='view-f'>
    <div class='img-view' onmousemove="zoomIn(event)" onmouseout="zoomOut()" style="background-image: url(../../<?= $model->picture?>)"></div>
    <div class='name-view'>
        <p><?= $model->name?></p>
        <p><?= $model->price?> руб/шт</p>
        <button  id='f_add_prod_<?=$model->id?>' onclick='add(<?=$model->id?>)' value='<?=$model->id?>' class='btn btn-add'>Добавить</button>
                <div class='count_add' style='display:none' id='add_prod_<?=$model->id?>'>
                    <a onclick='remove(<?=$model->id?>)'>-</a>
                    <a class='val_prod' id='prod_<?=$model->id?>'>
                    <?php
                            if(isset($session['basket']['products']['product_'.$model->id]['count'])){
                                echo($session['basket']['products']['product_'.$model->id]['count']);
                    };?>
                    </a>
                    <a  onclick='add(<?=$model->id?>)'>+</a>
                </div>
    </div>
</section>

<section class='view-s'>
<div class="col-lg-5">
    <p class='zag'>Характеристики</p>
    <ul class="oglavl">
    <?php
    foreach($model->parametrs as $c){
    ?>
    <li>
        <span class="text"><?=$c->char->name ?></span>
        <span class="page"><?=$c->value ?></span>
    </li>
    <?php }?>
    </ul>  
</div>
<div class="col-lg-5">
    <p class='zag'>Описание</p>
    <p style='font-size: 20px;'><?= $model->description?></p>
</div>
</section>
<section class='view-t'>
<div class='products'>
        <?php
        if(isset($result)){
            foreach($result as $item){
        ?>
        <div class="back-product">
            <a href='<?= Url::to(['site/product', 'id' => $item->id]) ?>'>
            <div style='background-image: url("../../<?= $item->picture?>")'></div>
            <p><?= $item->name?></p>
            </a>
            <div class='price'>
                <p><?= $item->price?> ₽/шт.</p>
                <p>
                    <button  id='f_add_prod_<?=$item->id?>' onclick='add(<?=$item->id?>)' value='<?=$item->id?>' class='btn btn-add'><span></span>В корзину</button>
                    <div class='count_add' style='display:none' id='add_prod_<?=$item->id?>'>
                        <a onclick='remove(<?=$item->id?>)'>-</a>
                        <a class='val_prod' id='prod_<?=$item->id?>'>
                        <?php
                        if(isset($session['basket']['products']['product_'.$item->id]['count'])){
                            echo($session['basket']['products']['product_'.$item->id]['count']);
                        };?>
                        </a>
                        <a  onclick='add(<?=$item->id?>)'>+</a>
                    </div>
                </p>
            </div>
        </div>
        <?php }} ?>
        </div>
        <div class="btn-slider">
            <button class="prv">&#10094</button>
            <button class="nxt">&#10095</button>
        </div>
    </div>
</section>