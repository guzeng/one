function _cancel(id)
{
    confirm_dialog('取消确认','确认要取消该订单？',_cancel_request,id)
}

function _cancel2(id)
{
	unload_modal();
    confirm_dialog('取消确认','确认要取消该订单？',_cancel_request,id)
}

function _cancel_request(id)
{
    ajaxRequest('admin/orders/cancel/'+id,'#'+id+'_cancel',_cancel_success);
}

function _cancel_success(data)
{
    if(typeof(data.id)!='undefined')
    {
        $('#'+data.id+'_status').html('已取消');
        $('#'+data.id+'_operate').html('');
    }
}