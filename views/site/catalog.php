<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Characteristic;
use app\models\Parametrs;
use yii\widgets\Pjax;
use ruskid\nouislider\Slider;
$session = Yii::$app->session;
$session->open();
?>
<?php
Pjax::begin();
?>
<div class="catalogpic">
<div class="container"><p>Каталог</p></div>
</div>

<div class="catalog">
<div class="filter">
    <h1 style="font-weight: 600; font-size: 16px;margin: 0;">Фильтры<span id="span-filter" style="float: right;margin-top: 5px;display:none;"></span></h1>
    <?php
    $form = ActiveForm::begin(['options' => ['id' => 'contactForm1', 'data-pjax' => true]]);
    ?>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <p class='price-filter' style='margin-bottom: 5px;'>Цена</p>
        <div class='prs'>
            <div><input class="form-control" type='number' name="Parametrs[price_min]" id="price_0" class="prices" 
            placeholder='от <?= $param->price_min?>' value='<?php if(isset($_POST['Parametrs'])) echo($_POST['Parametrs']['price_min']);?>'>
        </div>
            <span>-</span>
            <div><input class="form-control" type='number' name="Parametrs[price_max]" id="price_1" class="prices" 
            placeholder='до <?= $param->price_max?>' value='<?php if(isset($_POST['Parametrs'])) echo($_POST['Parametrs']['price_max']);?>'>
        </div>
        </div>
    <?php
    empty($param->price_min) ? $pr_min = (int)$prices['price_min'] : $pr_min = (int)$param->price_min;
    empty($param->price_max) ? $pr_max = (int)$prices['price_max'] : $pr_max = (int)$param->price_max;
    echo Slider::widget([
        'name' => 'test',
        'value' => 50,
        'events' => [
            Slider::NOUI_EVENT_UPDATE => new \yii\web\JsExpression('function(values, handle) {'
                    . '$("#price_"+handle).val(Math.round(values[handle]));
                     }'),
        ],
        'pluginOptions' => [
            'start' => [$pr_min, $pr_max],
            'connect' => true,
            'step' => 10,
            'range' => [
                'min' => (int)$prices['price_min'],
                'max' => (int)$prices['price_max']
            ]
        ]
    ]);
    ?>
    <br>
    <?php
    if(isset($filter['Размер'])){
        echo "<div><p class='p-char'>Размер<span></span></p><div class='inp-div'><select class='input-char select-catalog' name='Parametrs[value][Размер]'>";
        if(isset($_POST) && isset($_POST['Parametrs']['value']['Размер'])){
            echo "<option disabled>Выберите размер</option>";
        }else{
            echo "<option disabled selected>Выберите размер</option>";
        }
        foreach($filter['Размер'] as $razmer){
            if(isset($_POST['Parametrs']['value']['Размер']) && $_POST['Parametrs']['value']['Размер'] == $razmer){
                echo "<option selected>".$razmer."</option>";
            }else{
                echo "<option>".$razmer."</option>";
            }
        }
        echo "</select>";
        echo "</div></div>";
    }
    
            foreach($filter as $key=>$char){    
                if($key != 'Размер'){
                    if(!empty($char)){
                        echo "<div><p class='p-char'>".$key."<span></span></p><div class='inp-div'>";
                        foreach($char as $value){
                            echo "<input id='".$value."' type='checkbox' class='catalog-check' 
                            name='Parametrs[value][".$key."][]' value='".$value."'";
                            if(isset($_POST['Parametrs']['value'][$key])){
                                foreach($_POST['Parametrs']['value'][$key] as $par){
                                    if($par == $value) echo "checked";
                                }
                            }
                            echo "><label for='".$value."' class='catalog-check-label'>".$value."</label>";
                        }
                        echo "</div></div>";
                    }else{
                        echo "<div><p class='p-char'>".$key."<span></span></p><div class='inp-div'><input class='form-control input-char' type='number' value='";
                        if(isset($_POST['Parametrs'])){echo $_POST['Parametrs']['value'][$key]."'";} else {echo "'";};
                        echo "name='Parametrs[value][".$key."]'></div></div>";
                    }
                }
            }
    ?>
            <div class="form-group">
                <?= Html::submitButton('Применить', ['class' => 'btn btn-search']) ?>
            </div>
            <p style="text-align: center;"><button class='btn-clear' onclick="clearFilter()">Сбросить</button></p>
    <?php ActiveForm::end(); ?>
</div>

<div class='product-catalog'>

<?php
if(!empty($result)){
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
<?php }}else{?>
       <div id="w5-error-0" class="alert-danger alert alert-dismissible" style='height:50px;width:100%;text-align: center;' role="alert">
       Ничего не было найдено
        </div>
        <?php }?>
    
</div>
</div>
<?php
Pjax::end();
?>