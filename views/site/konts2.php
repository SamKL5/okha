<form>
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
<div class='konst' style='display: none;'>
<?php
echo "<div class='frames-m'>";
foreach($model as $v){
    echo "<div class='frame-m'>";
    echo "<input type='radio' name='frame-material' id='frame_".$v->id."' value='".$v->id."'>
    <label for='frame_".$v->id."'><img class='material-img' src='../".$v->material."'><br>".$v->name."</label>";
    echo "</div>";
}
echo "</div>";
echo "<hr>";
echo "<div class='frames-m'>";
foreach($model2 as $v){
    echo "<div class='frame-m'>";
    echo "<input type='radio' name='glass-material' id='glass_".$v->id."' value='".$v->id."'>
    <label for='glass_".$v->id."'><img class='material-img' style='background-color: ".$v->color."'><br>".$v->name."</label>";
    echo "</div>";
}
echo "</div>";
?>

Ширина<input type='number' name='width'><br>
Высота<input type='number' name='height'><br>
Толщина<input type='number' name='tick'><br>

<input type='button' class='btn-create' value='Сформировать'>

<div class="konst-result">
</div>
</form>
</div>
