
jQuery(document).ready(function() {
   initTable('cate_list');
});




function form_validate(data)
{
    if(typeof(data.code)!='undefined')
    {
        if(data.code == '1000')
        {
            window.location.href = msg.base_url+'admin/product_cate';
        }
        else
        {
            if(typeof(data.error)!='undefined' && data.error != '')
            {
                $.each(data.error,function(key,item){
                    if(item!='' && $('input[name='+key+']').length > 0)
                    {
                        $('input[name='+key+']').parent().addClass('has-error');
                        $('input[name='+key+']').parent().find('span.help-block').html(item);
                    }
                })
            }            
        }
    }
}

