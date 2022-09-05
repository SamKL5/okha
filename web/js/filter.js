var slider = document.getElementById('w_nouislider');
$("#price_0").on('change',function(){
    slider.noUiSlider.set([this.value,null]);
})
$("#price_1").on('change',function(){
    slider.noUiSlider.set([null,this.value]);
})