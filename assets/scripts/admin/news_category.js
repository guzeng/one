function removeNode(){
    $(".tr_node").remove();
}

function appendRootNode()
{
    removeNode();
    var select = '';
    if(tree != '')
    {
        select += "<label class='radio-inline' style='padding-left: 0px;'><select id='0_parent_span' class='form-control' style='width:200px;'>";
        select += "<option value='0'>请选择</option>";
        $.each(tree,function(key,item)
        {
            var width_str = ''
            if(item.deep>0)//计算要多少空格
            {
               width_str = new Array( item.deep + 1).join("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+'|-'; 
            }
            select += "<option value='"+item.id+"' >"+width_str+item.name+"</option>";
        })
        select += "</select></label>";
    }
    var tr_html = "<tr class='tr_node'><td colspan='2'>"+
                    "<div id='0_name_condition_edit' style='margin-bottom:0'>"+select+
                        "<label class='radio-inline' style='padding-left: 0px;'><input name='name' class='form-control' placeholder='文章分类名称' id='0_name_input' maxlength='30' type='text'></label>"+
                        "<button id='node_add' onclick=\"updateCategory(0)\" class='btn blue' type='button'>保存</button>"+
                        "<button id='node_cancle' onclick='removeNode()' class='btn btn-default' type='button'>取消</button>"+
                    "</div>"+
                "</td></tr>";

    $("#add_new_node").before(tr_html);
    $("input[id='0_name_input']").focus();
    place_holder();
}

function delete_category(uri)
{
    var uri = uri.toString().replace(/\"/g,'');
    $.ajax({
        url:uri,
        type:'get',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                show_success(json.msg);
                window.location.href = msg.base_url+"admin/news_cate";
            }
            else if(json.code=='1002')
            {
                show_login(json);
            }
            else
            {
                show_error(json.msg);
            }
        },
        beforeSend:function(){
            loading();
        },
        error:function(err){
            show_error();
        }
    });
}

function edit_category(parent_id,id,name)
{
    if($('#'+id+'_name_condition_edit').length == 0)
    {
        var margin_left = $('#'+id+'_name_condition').css('margin-left');
        tr_html="<div class='float-left name_condition' id='"+id+"_name_condition_edit' style='margin-left:"+margin_left+";'>";
        if(tree != '')
        {
            tr_html += "<label class='radio-inline' style='padding-left: 0px;'>上一级 : </label>";
            tr_html += "<label class='radio-inline' style='padding-left: 0px;'><select id='"+id+"_parent_span' class='form-control' style='width:200px;'>";
            tr_html += "<option value='0'>请选择</option>";
            var selected = '';
            $.each(tree,function(key,item){
                var width_str = ''
                if(item.id == parent_id)
                {
                    selected = 'selected';
                }
                else
                {
                    selected = '';
                }

                if(item.deep>0)//计算要多少空格
                {
                   width_str = new Array( item.deep + 1).join("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+'|-'; 
                }
                tr_html += "<option value='"+item.id+"' "+selected+">"+width_str+item.name+"</option>";
            })
            tr_html += "</select></label>";
        }
        tr_html += "<label class='radio-inline' style='padding-left: 0px;'>"+
                    "<input name='name' class='form-control' maxlength='30' id='"+id+"_name_input' type='text' value='"+name+"'>"+
                    "</label>"+
                    "<button onclick=\"updateCategory('"+id+"')\" class='btn blue node_edit' type='button'>保存</button>"+
                    "<button onclick=\"cancelEdit('"+id+"')\" class='btn btn-default' type='button'>取消</button></span>";
        $('#'+id+'_name_condition').hide().after(tr_html);
        $('#'+id+'_name_condition_edit').find('input').focus();
    }
    else
    {
        cancelEdit(id);
    }

    return false;
}

function updateCategory(id)
{
    if(typeof(id)=='undefined')
    {
        return false;
    }
    var name = $('#'+id+'_name_input').val();
    var parent_id = $('#'+id+'_parent_span').val();
    if(name == '')
    {
        return false;
    }
    var data = {'name':name,'parent_id':parent_id,'id':id};
    $.ajax({
        url:msg.base_url+'admin/news_cate/update',
        data:data,
        dataType:'json',
        type:'post',
        beforeSend:function(){
            $('.node_edit').attr('disabled',true);
            $('#'+id+'_edit_span').find("span.help-block").remove();
            loading();
        },
        success:function(json){
            close_alert();
            $('.node_edit').attr('disabled',false);
            if(json.code=='1000')
            {
                show_success();
                window.location.href = msg.base_url+"admin/news_cate";
            }
            else if(json.code=='1002')
            {
                show_login(json);
            }
            else
            {
                if(typeof(json.error['name'])!='undefined')
                {
                    $('#'+id+'_name_condition_edit').find('span.help-block').remove();
                    $('#'+id+'_name_input').parent().parent().append("<span class='help-block re m-l-15'>"+json.error['name']+"</span>");
                }
                show_error(json.msg);
            }
        },
        error:function(err){
            $('.node_edit').attr('disabled',false);
            show_error();
        }
    })
}

function cancelEdit(id)
{
    $('#'+id+'_name_condition_edit').remove();
    $('#'+id+'_name_condition').show();
}

function confirm_delete_category(id)
{
    if(typeof(id) != 'undefined')
    {
        var uri = msg.base_url+"admin/news_cate/delete/"+id;
        confirm_dialog('删除确认','确认删除该记录吗？',delete_category,uri);
    }
}

$(function(){
    $('#category_list').on('click','.name_condition',function(){
        if(typeof($(this).parent().parent().attr('show_child'))=='undefined' || $(this).parent().parent().attr('show_child')=='true')
        {
            $(this).parent().parent().attr('show_child','false');
            $(this).find('span.row-details').removeClass('row-details-open').addClass('row-details-close');
        }
        else
        {
            $(this).parent().parent().attr('show_child','true');
            $(this).find('span.row-details').removeClass('row-details-close').addClass('row-details-open');
        }
        hide_tree_list($(this).parent().parent(),$(this).parent().parent().next());
    });
})