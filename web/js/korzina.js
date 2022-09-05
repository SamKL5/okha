$(window).on("load",function(){
    all_prod();
    reload();
})

function reload(){
    $("div[id^='add_prod_']").each(function () {
        if($(this).children('.val_prod').html() > 0){
            $(this).show();
            $('#f_'+$(this).attr('id')).hide();
        }
    });
}

function all_prod(){
    $.ajax({
        url: "/korzina/all-prods",
        success: function(res){
            if(JSON.parse(res)[0] <= 0){
                $('.korzina').hide();
            }else{
                $('.korzina').show();
                $('.session_count').text(JSON.parse(res)[0]);
                $('.session_price').text(JSON.parse(res)[1]);
            }
           
        }
    });
}

function add(id){
    $.ajax({
        url: "/korzina/add-prod",
        type: "POST",
        data: {id_p: id},
        success: function(res){
            all_prod();
            $('.all_prod').text(parseInt($('.all_prod').text())+parseInt(1));
            $('#f_add_prod_'+id).hide()
            $('#add_prod_'+id).show();
            $('#prod_'+id).html(res);
          }
      });
}

function remove(id){
    
    $.ajax({
        url: "/korzina/remove-prod",
        type: "POST",
        data: {id_p: id},
        success: function(res){
            all_prod();
            if(res == 0){
                $('#f_add_prod_'+id).show();
                $('#prod_'+id).html(res);
                $('#f_add_prod_'+id).parent().show();
                $('#add_prod_'+id).hide();
            }else{
                $('#add_prod_'+id).show();
                $('#prod_'+id).html(res);
            }
          }
    });
}

function remove_res(id){
    $.ajax({
        url: "/korzina/remove-prod",
        type: "POST",
        data: {id_p: id},
        success: function(res){
            all_prod();
            if(res == 0){
                $('#prod_'+id).html(res);
                $('#result_prod_'+id).hide();
                $('.form-result').hide();
            }else{
                $('#f_add_prod_'+id).hide();
                $('#add_prod_'+id).show();
                $('#prod_'+id).html(res);
            }
            }
    });
}

function removeAll(id){
    $.ajax({
        url: "/korzina/remove-all",
        type: "POST",
        data: {id_p: id},
        success: function(){
            all_prod();
            $('.form-result').hide();
            $('#result_prod_'+id).hide();
          }
      });
}

function showForm(){
    $('.form-result').show();
    $('#showForm').hide();
    $('.form-result > div > label').after("<span style='color:red;'>*</span>");
    $('.address-korz > div > label').each(function(index, elem){
        if(!($(elem).attr('for') == 'ticket-corp' || $(elem).attr('for') == 'ticket-flat')){
            $(elem).after("<span style='color:red;'>*</span>");
        }
    })
}

