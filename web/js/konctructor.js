$(window).on("load",function(){
  $('#select-category').click('on',function(){
    $('.konst').slideDown( "slow");
    if($(this).val() != 1){
      $('input[name="radius"]').parent().show();
      if($(this).val() == 2){
        $('select[name=plate]').show();
      }else{
        $('select[name=plate]').hide();
      }
    }else{
      $('input[name="radius"]').parent().hide();
      $('select[name=plate]').hide();
    }
  });

  $("input[name='frame-material']").click('on',function(){
    $("input[name='frame-material']").next().children('img').css('border','0');
    if($(this).is(':checked')){
      $(this).next().children('img').css('border','5px solid #1D98DB');
    }
  })

  $("input[name='glass-material']").click('on',function(){
    $("input[name='glass-material']").next().children('img').css('border','0');
    if($(this).is(':checked')){
      $(this).next().children('img').css('border','5px solid #1D98DB');
    }
  })

  // $('.btn-create').click('on',function(){
  //   var id_fr = $("input[name='frame-material']:checked").val();
  //   var id_gl = $("input[name='glass-material']:checked").val();
  //   var wth = $("input[name='width']").val();
  //   var hgt = $("input[name='height']").val();
  //   var tck = $("input[name='tick']").val();
  //   $('.konst-result').empty();
  //   if(wth != '' && hgt != '' && tck != ''){
  //     $.ajax({
  //       url: '/site/create',
  //       type: 'get',
  //       data: {
  //         id_frame: id_fr, 
  //         id_glass: id_gl,
  //         w: wth,
  //         h: hgt,
  //         t: tck
  //       },
  //       success: function(res){
  //         $('.konst-result').append(res);
  //       }
  //     })
  //   }else{
  //     $('.konst-result').append('<p>Введите ширину и высоту</p>');
  //   }
    
  // })
});
// var AccpetAdd = false;

// $(window).on("load",function(){
//     $('.konstructor').html("<canvas class='canvas' height='600' width='"+$('.konstructor').width()+"' id='konst'>Обновите браузер</canvas>");
      
//         $('#canvasForm > label > input').on('keyup', create);
//         $('#canvasForm > label > input').on('click', create);


//         var canvas = document.getElementById('konst');


//         function create(){
//           if(window.innerWidth <= 742){
//             var diff = 2;
//           }else{
//             var diff = 5;
//           }
//           var w = $('#canvasW').val()*diff;
//           var h = $('#canvasH').val()*diff;
//           var t = $('#canvasT').val()*diff;
            
//             if (canvas.getContext) {
    
//               var ctx = canvas.getContext('2d');
//               ctx.clearRect(0, 0, canvas.width, canvas.height);
//               if(h+40 >= 600){
//                 canvas.height = h+40;
//                 $('.konstructor').height(70+h+40+70);
//               }else{
//                 canvas.height = 600;
//                 $('.konstructor').height(740);
//               }
//               var x0 = (canvas.width - w )/2;
//               var y0 = 20;


//                 $('input[name="color"]').is(':checked') ? colorMain = $('input[name="color"]:checked').val() : colorMain = "black";
//                 ctx.fillStyle = colorMain;
//                 ctx.fillRect(x0,y0,w,h);


//                 $('input[name="colorGlass"]').is(':checked') ? colorGlass = $('input[name="colorGlass"]:checked').val() :  colorGlass = "white";
//                 ctx.fillStyle = colorGlass;
//                 x1G = x0+t;
//                 y1G = y0+t;
//                 x2G = w-2*t;
//                 y2G = h-2*t;
//                 ctx.fillRect(x1G,y1G,x2G,y2G);

//                 if(add == true){
//                   Strv($("#canvasW_1").val());
//                 }
//             }

//             // function Strv(w1){
//             //   x22M = w1*diff;
//             //   ctx.fillStyle =colorMain;
//             //   ctx.fillRect(x1G,y1G,x22M,y2G);

//             //   ctx.fillStyle = colorGlass;
//             //   ctx.fillRect(x1G+t,y1G+t,x22M-2*t,y2G-2*t);
//             // }

//             $('#canvasW_1').on('keyup', create);
//             console.log($('#Stvor').val());
            
//         }
// })
// // $('#addStvor').on('click', function(){
// //   AccpetAdd = true;
// //   $('#addStvor').parent().append($("<label>Ширина<input id='canvasW_"+1+"' type='number'></label><br>"));
// // });



$(window).on("load",function(){
    $('.konstructor').html("<canvas class='canvas' height='600' width='"+$('.konstructor').width()+"' id='konst'>Обновите браузер</canvas>"); 
})

var AcceptAdd = false;
        function create(){
          var canvas = document.getElementById('konst');

          if(window.innerWidth <= 742){
            var diff = 2;
          }else{
            var diff = 5;
          }
          var t = parseInt($("input[name='tick']").val());
          var w = parseInt($("input[name='width']").val());
          var h = parseInt($("input[name='height']").val());
          var r = parseInt($("input[name='radius']").val());
          var plate = parseInt($("select[name='plate']").val());
          var category =  parseInt($("select[name='id_category']").val());

            if (canvas.getContext) {
              var ctx = canvas.getContext('2d');
              ctx.clearRect(0, 0, canvas.width, canvas.height);
              if(h+40 >= 600){
                canvas.height = h+40;
                $('.konstructor').height(70+h+40+70);
              }else{
                canvas.height = 600;
                $('.konstructor').height(740);
              }

              var x0 = (canvas.width)/2;
              var y0 = 100;

              var MaterialMain = new Image();
                $('input[name="frame-material"]').is(':checked') ? MaterialMain.src = $('input[name="frame-material"]:checked').val() : MaterialMain.src = "black";
                $('input[name="glass-material"]').is(':checked') ? colorGlass = $('input[name="glass-material"]:checked').val()+80 :  colorGlass = "white";
                
                var pattern = ctx.createPattern(MaterialMain, "repeat");
                ctx.fillStyle = colorGlass;

                
                ctx.strokeStyle = pattern;
                ctx.lineWidth = t;
                console.log(category);

                if(category == 1){
                  ctx.fillRect(x0-w/2, y0, w, h);
                  ctx.strokeRect(x0-w/2+t/2,y0+t/2,w-t,h-t);
                }

                if(category == 2){
                  createRectArc(x0, y0, w, h, plate, r);
                }

                if(category == 3){
                  createArc(x0, y0, w, h, r);
                }

                function createArc(x0, y0, w, h, r){

                  ctx.beginPath();
                  ctx.arc(x0, y0+r, r, 0, 2*Math.PI);
                  // ctx.moveTo(x0-w/2, y0+h/2);
                  // ctx.bezierCurveTo(x0-w/2, y0+h, x0+w/2, y0+h, x0+w/2, y0+h/2);
                  ctx.fill();
                  ctx.beginPath();
                  ctx.arc(x0, y0+r, r-t/2, 0, 2*Math.PI);
                  ctx.stroke();
                }

                function createRectArc(x0, y0, w, h, plate, r){
                  ctx.beginPath();
                  if(plate == 1){
                    ctx.moveTo(x0-w/2+r, y0);
                    ctx.bezierCurveTo(x0-w/2, y0, x0-w/2, h+y0, x0-w/2+r,h+y0);
                    ctx.lineTo(x0+w/2, h+y0);
                    ctx.lineTo(x0+w/2, y0);
                    ctx.lineTo(x0-w/2+r, y0);
                  }

                  if(plate == 2){
                    ctx.moveTo(x0-w/2, h+y0-r);
                    ctx.bezierCurveTo(x0-w/2, h+y0, x0+w/2, h+y0, x0+w/2,h+y0-r);
                    ctx.lineTo(x0+w/2, y0);
                    ctx.lineTo(x0-w/2, y0);
                    ctx.lineTo(x0-w/2, h+y0-r);
                  }

                  if(plate == 3){
                    ctx.moveTo(x0+w/2-r, h+y0);
                    ctx.bezierCurveTo(x0+w/2, h+y0, x0+w/2, y0, x0+w/2-r,y0);
                    ctx.lineTo(x0-w/2, y0);
                    ctx.lineTo(x0-w/2, y0+h);
                    ctx.lineTo(x0+w/2-r, h+y0);
                  }

                  if(plate == 4){
                    ctx.moveTo(x0-w/2, y0+r);
                    ctx.lineTo(x0-w/2, h+y0);
                    ctx.lineTo(x0+w/2, h+y0);
                    ctx.lineTo(x0+w/2, y0+r);
                    ctx.bezierCurveTo(x0+w/2, y0, x0-w/2, y0, x0-w/2,y0+r);
                  }
                  ctx.fill();
                  ctx.stroke();
                }
                // ctx.fillRect(x0,y0,w,h);
                // ctx.strokeRect(x0+t/2,y0+t/2,w-t,h-t);
            }
          }


