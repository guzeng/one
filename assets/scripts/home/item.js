$(function(){
    $('.item-thumb').mouseover(function(){
        var thumb = $(this).attr('src');
        var org = thumb.replace('_thumb','');
        $('#item_img').attr('src',org);
        $(this).parent().parent().find('div.pinfo-s').removeClass('active');
        $(this).parent().addClass('active');
    })
})
function cart_count(type,obj)
{
    if(typeof(type)=='undefined')
    {
        return false;
    }
    var c = $(obj).parent().find('input[name=cart_num]').val();

    switch(type)
    {
        case 'plus':
            $(obj).parent().find('input[name=cart_num]').val(parseInt(c)+1);
        break;
        case 'minus':
            var min=$(obj).parent().find('input[name=min_num]').val();
            if(min=='' || parseInt(min)<1)
            {
                min = 1;
            }
            if(parseInt(c)-1 > parseInt(min))
            {
                $(obj).parent().find('input[name=cart_num]').val(parseInt(c)-1);
            }
            else
            {
                $(obj).parent().find('input[name=cart_num]').val(min);
            }
        break;
    }
}

function item_go(type)
{
    var o = $('#see_again');
    switch(type)
    {
        case 'up':
            o.find('a:visible').last().next().show(400);
            if(o.find('a:visible').length > 3)
            {
                o.find('a:visible').first().hide(400);
            }
        break;
        case 'down':
            o.find('a:visible').first().prev().show(400);
            if(o.find('a:visible').length > 3)
            {
                o.find('a:visible').last().hide(400);
            }
        break;
    }
}
