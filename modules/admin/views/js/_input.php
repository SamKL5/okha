<div class="char_list" id="charli">
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
        <a class="delete-char" onclick="deleteChar(this)">Удалить</a>
</div>