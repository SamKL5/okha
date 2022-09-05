function opt(obj){
    if(typeof($(obj).val()) != "undefined" && $(obj).val() !== null) {
      $(obj).empty();
  }
  let mas = chars();
  $.ajax({
    url: "/admin/js/chars",
    type: "POST",
    data: {arr: mas},
    context: obj,
    success: function(res){
      $(obj).prepend(res);
    }
  })
}

  function types(){
    if(valid() == 1){
      let options = chars();  
      $.ajax({
        url: "/admin/js/type",
        type: "POST",
        data: {arr: options},
        success: function(res){
          $('.link-to-add').before(res);
        }
      })
    }else{
      alert('Нет больше доступных параметров');
      $('.link-to-add').hide();
    }
  }
0
  function chars(){
    let options = new Array();
    $('.char > select').each(function () {
        options.push($(this).val());
    });
    return options;
  }

  function valid(){
    let val = 0;
    let ind = null;
    $('.char > select').each(function () {
        val += 1;
    });
    $.ajax({
      async: false,
      url: "/admin/js/valid",
      type: "POST",
      data: {validate: val},
      success: function(res){
        ind = res;
      }
    });
    return ind;
  }

  function deleteChar(obj){
      $(obj).parent().remove();
      if(valid() == 1){
        $('.link-to-add').show();
      }else{
        $('.link-to-add').hide();
      }
  }

  function checkboxChar(obj){
    if(obj.checked){
      $('#parametrs-value-'+obj.value).show();
    }else{
      $('#parametrs-value-'+obj.value).hide().val('');
    }
  }

$(window).on("load",function() {
    $('.char_list > a').each(function (index) {
      if(index == 0 ){
        $(this).remove();
      }
    });
});

  $(".p-char").click(function(){
    if($(this).next().css('display') == 'block'){
      $($(this).next()).slideUp();
      $(this).children().css({
        "transition" : "transform 300ms",
        "transform": "rotate(0deg)" 
      });
      $(this).next().children().val('');
      $(this).next().children().prop('checked', false);
    }else{
      $(this).children().css({
        "transition" : "transform 300ms",
        "transform": "rotate(180deg)" 
      });
      $($(this).next()).slideDown();
    }
  });


const slides = document.querySelectorAll('.slide')

for (const slide of slides) {
    slide.addEventListener('click', () => {
        clearActiveClasses()

        slide.classList.add('active')
    })
}

function clearActiveClasses() {
    slides.forEach((slide) => {
        slide.classList.remove('active')
    })
}

$(document).on('ready pjax:success', function(){
  $(".p-char").click(function(){
    console.log($(this).next().css('display'));
    if($(this).next().css('display') == 'block'){
      $($(this).next()).slideUp();
      $(this).children().css({
        "transition" : "transform 300ms",
        "transform": "rotate(0deg)" 
      });
      $(this).next().children().val('');
      $(this).next().children().prop('checked', false);
    }
    else{
      $(this).children().css({
        "transition" : "transform 300ms",
        "transform": "rotate(180deg)" 
      });
      $($(this).next()).slideDown();
    }
  });
});

const mediaQuery = window.matchMedia('(max-width: 767px)');
$(document).ready(function(){
  if(mediaQuery.matches){
    $('.third-info > div').addClass('container');
    $('.korzina').appendTo('body');
    $('#span-filter').show();
    $('#contactForm1').hide();
    $('.filter > h1').click(function(){
      if( $('#contactForm1').css('display') == 'none'){
        $('#contactForm1').slideDown();
        $('#span-filter').css({
          "transition" : "transform 300ms",
          "transform": "rotate(0deg)" 
        });
      }else{
        $('#contactForm1').slideUp();
        $('#span-filter').css({
          "transition" : "transform 300ms",
          "transform": "rotate(180deg)" 
        });
      }
    })
    
    let pos=0;
    const slidesToShow = 2;
    const slidesToScroll = 1;
    const cont = $('.products').parent();
    const track = $('.products');
    const prod = $('.back-product');
    const nxt = $('.nxt');
    const prv = $('.prv');
    const count = prod.length;
    const prodWd = cont.width() / slidesToShow;
    const movePos = slidesToScroll * prodWd;
  
    prod.each(function (index, prod){
        $(prod).css({
            minWidth: prodWd,
        })
    })
  
    prv.click(function(){
        pos += movePos;
        track.css({
            transform: `translateX(${pos}px)`
        })
        chkB();
    })
    nxt.click(function(){
        pos -= movePos;
        track.css({
            transform: `translateX(${pos}px)`
        })
        chkB();
    })
    const chkB = () =>{
        prv.prop('disabled', pos === 0 );
        nxt.prop('disabled', pos <= -(count - slidesToShow) * prodWd);
    };
    chkB();
  }
  
});

function zoomIn() {
  if(!mediaQuery.matches){
    if ($(".img-view").is(':hover')) {
      $(".img-view").css("width","100%");
      $(".img-view").css("height","50vh");
      $(".name-view").css("width","100%");
      $(".name-view").css("text-align","center");
      $(".name-view").css("align-items","center");
    }
  }
}

function zoomOut(){
  if(!mediaQuery.matches){
    $(".img-view").css("width","40%");
    $(".img-view").css("height","auto");
    $(".name-view").css("width","40%");
    $(".name-view").css("text-align","left");
    $(".name-view").css("align-items","unset");
  }
}

function clearFilter(){
  $('.inp-div').children('select').prop('selectedIndex', 0); 
  $('.inp-div').children('input').each(function(index, element ){
    if($(element).is(':checkbox')){
      $(element).prop('checked', false);
    }else{
      $(element).val('');
    }
    $('.btn-search').trigger('click');
  });
}

$(".subTicket").click(function(){
  var id_prod  = $(this).next().val()
  var value = $(this).prev().val();
  $.ajax({
        url: "/admin/ticket/update-status",
        type: "get",
        data: {id: id_prod, status: value},
  })
});
