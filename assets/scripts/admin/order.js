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

function show_dialog(id,price)
{
	$("#order_id").val(id);
	$("#order_price").val(price);
    $('#order_modal').modal();
}

function change_price()
{
	var id = $("#order_id").val();
	var price = $("#order_price").val();
	if(price.length<0)
	{
		show_error("必须输入总价");
		return;
	}
	if(isNaN(price))
	{
		show_error("你输入的总价必须是数字");
		return;
	}
	$.ajax({
        url:msg.base_url+"admin/orders/change_price",
        type:'post',
        data:{'id':id,'price':price},
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                show_success(json.msg);
                $('#order_modal').modal('hide');
                location.reload();
            }
            else if(json.code=='1002')
            {
                show_login();
            }
            else
            {
                show_error(json.msg);
            }
        }
    });
}