$(function(){
    $('.item-thumb').mouseover(function(){
        var thumb = $(this).attr('src');
        var org = thumb.replace('_thumb','');
        $('#item_img').attr('src',org);
        $(this).parent().parent().find('div.pinfo-s').removeClass('active');
        $(this).parent().addClass('active');
    })
})

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
