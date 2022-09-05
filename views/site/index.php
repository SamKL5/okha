<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
$session = Yii::$app->session;
$session->open();
?>
<section class="first-info">
    <div class="container">
        <p class='p-main'>Окна от производителя любой сложности</p>
        <p>в Санкт-Петербурге <span>от <?= $min;?> руб.</span></p>
        <p class='p-sale'>С установкой под ключ в день доставки</p>
        <a href='/site/contact' class='btn btn-sale'>Оставить заявку</a>
    </div>
</section>

<section class="second-info">
    <p class='p-main title-h1'>Окна на любой вкус</p>
    <div class='products'>
    <?php
    if(isset($result)){
        foreach($result as $item){
    ?>
    <div class="back-product">
        <a href='<?= Url::to(['site/product', 'id' => $item->id]) ?>'>
        <div style='background-image: url("../<?= $item->picture?>")'></div>
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
</section>

<section class="third-info">
    <div><p style="font-size: 42px;">Все о нас</p>
        <p>Инновационно-производственное предприятие «ЭКРОСХИМ», входящее в группу компаний «ЭКРОС», сосредоточило в своем составе подразделения, отвечающие за разработку, производство и продвижение на рынок лабораторного оборудования и приборов широко известной в России торговой марки «ПЭ».</p>
    </div>
    <div class='th-img'> </div>
</section>

<section class="fourth-info">
        <div
        class="slide"
        style="background-image: url('https://images.unsplash.com/photo-1563693998336-93c10e5d8f91?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');"
    >
        <p>Обычные окна</p>
    </div>
    <div
        class="slide"
        style="background-image: url('https://i.pinimg.com/564x/59/28/6f/59286fb7e7c784ff6b84bff0cb52b472.jpg');"
    >
        <p>Панорамные окна</p>
    </div>
    <div
        class="slide"
        style="background-image: url('https://i.pinimg.com/564x/3b/01/a1/3b01a11a835cd66b851704ba0f94176f.jpg');"
    >
        <p>Круглые окна</p>
    </div>
    <div
        class="slide"
        style=" background-image: url('https://i.pinimg.com/564x/93/dd/30/93dd305fa59866fd56125faa2c307357.jpg');"
    >
        <p>Любой формат</p>
    </div>
    <div
        class="slide active"
        style="background-image: url('https://i.pinimg.com/564x/df/eb/21/dfeb217d15b97e81808679d11e07f363.jpg');"
    >
        <p>Под ваш вкус</p>
    </div>
</section>