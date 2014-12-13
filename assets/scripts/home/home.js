// JavaScript Document
$(document).ready(function(e) {
    ctrl_skin();
    $("#skin_pre").click(function(){
        var obj = $(".skin-content").find(".show");
        if(typeof(obj) != 'undefined')
        {
            var pre_page = parseInt(obj.attr('id'));
            if(pre_page != 0)
            {
                obj.removeClass("show").addClass("hide");
                obj.prev().fadeIn('slow').removeClass("hide").addClass("show").removeAttr('style');
            }
        }
        ctrl_skin();
    });

    $("#skin_next").click(function(){
        var obj = $(".skin-content").find(".show");
        if(typeof(obj) != 'undefined')
        {
            var next_page = parseInt(obj.attr('id'));
            if(typeof(obj.next().attr('id')) != 'undefined')
            {
                obj.removeClass("show").addClass("hide");
                obj.next().fadeIn('slow').removeClass("hide").addClass("show").removeAttr('style');
            }
        }
        ctrl_skin();
    });
    var f = ['f1','f2','f3'];
    $.each(f,function(key,item){
        $('#'+item).find('ul#list-tab').find('a').mouseover(function(){
            var href = $(this).attr('href');
            href = href.replace('#','');
            var ul = $(this).parent().parent().attr('id');
            $('#'+item).find('div#list').find('div.tabitem').hide();
            $('#'+item).find('div#'+href).show();
        })        
    })

});

//控制按钮样式
function ctrl_skin()
{
    var skin_obj = $(".skin-content").find(".show");
    if(typeof(skin_obj) != 'undefined' && $('#skin_pre').length > 0)
    {
        var page = parseInt(skin_obj.attr('id'));
        if(typeof(skin_obj.prev().attr('id')) == 'undefined')
        {
            $('#skin_pre').css('cursor','default');
        }
        else
        {
            $('#skin_pre').css('cursor','pointer');
        }
        
        if(typeof(skin_obj.next().attr('id')) == 'undefined')
        {
            $('#skin_next').css('cursor','default');
        }
        else
        {
            $('#skin_next').css('cursor','pointer');
        }
    }
}
