<?php

?>

<form id="canvasForm">
<label>Выберите тип окна</label><br>
<select name='id_category' id='select-category'>
    <?php
    foreach($category as $cat){
        echo "<option value='".$cat->id."'>".$cat->name."</option>";
    }
    ?>
</select>
<br>
<label style='display: none;'>Радиус<input type='number' name='radius'></label>
<select name='plate' style='display: none;'>
    <option disabled selected>Сторона</option>
    <option value='4'>Сверху</option>
    <option value='1'>Слева</option>
    <option value='2'>Снизу</option>
    <option value='3'>Справа</option>
</select>
<div class='konst' style='display: block;'>
<?php
echo "<div class='frames-m'>";
foreach($model as $v){
    echo "<div class='frame-m'>";
    echo "<input type='radio' name='frame-material' id='frame_".$v->id."' value='../".$v->material."'>
    <label for='frame_".$v->id."'><img class='material-img' src='../".$v->material."'><br>".$v->name."</label>";
    echo "</div>";
}
echo "</div>";
echo "<hr>";
echo "<div class='frames-m'>";
foreach($model2 as $v){
    echo "<div class='frame-m'>";
    echo "<input type='radio' name='glass-material' id='glass_".$v->id."' value='".$v->color."'>
    <label for='glass_".$v->id."'><img class='material-img' style='background-color: ".$v->color."'><br>".$v->name."</label>";
    echo "</div>";
}
echo "</div>";

?>
Ширина<input type='number' name='width'><br>
Высота<input type='number' name='height'><br>
Толщина<input type='number' name='tick'><br>

<input type='button' class='btn-create' onclick='create()' value='Сформировать'>
</div>
    <!-- <label>Ширина<input id="canvasW" type='number' value='100'></label><br>
    <label>Высота<input id="canvasH" type='number' value='90'></label><br>
    <label>Толщина<input id="canvasT" type='number' value='2'></label><br>
    <label>Цвет:
    Красный<input type="radio" name="color" value="red">
    Зеленый:<input type="radio" name="color" value="green"></label><br>
    <label>Цвет стекла:
    Cиний: <input type="radio" name="colorGlass" value="blue">
    Розовый:<input type="radio" name="colorGlass" value="pink"></label><br>

    <label>Добавить створку: <input type="button" id="addStvor" value="Доабвить"></label>

    <select id='Stvor'>
        <option selected>1</option> 
        <option>2</option> 
        <option>3</option> 
    </select> -->
</form>
<div class="konstructor">
    <!-- <canvas height='320' width='100px' id='konst' style='border: 1px solid black;'>Обновите браузер</canvas> -->
</div>


