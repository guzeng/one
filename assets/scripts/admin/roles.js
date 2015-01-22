$(function(){
    $('#role_list').on('mouseover','.role-h-item',function(){
        $(this).find('i').css('display','block');
    }).on('mouseout','.role-h-item',function(){
        $(this).find('i').css('display','none');
    })
})
//------------------------------------------------------------------------------
function showPermissions(roleId)
{
    if(typeof(roleId) == 'undefined')
    {
        return false;
    }
    if($('#detail-'+roleId).length == 0 || $('#detail-'+roleId).css('display') == 'none')
    {
        if($('.details').length > 0)
        {
            $.each($('.details'),function(key,item){
                var id = $(item).attr('id');
                if($('#'+id).css('display') != 'none')
                {
                    $('#'+id).find('.detail').slideUp('slow',function(){
                        $(this).hide();
                        $('#'+id).hide();
                    });
                }
            })
        }        
    }

    if($('#detail-'+roleId).length > 0)
    {
        if($('#detail-'+roleId).css('display')=='none')
        {
            $('#detail-'+roleId).show();
                $('#detail-'+roleId).find('.detail').slideDown();
        }
        else
        {
            $('#detail-'+roleId).find('.detail').slideUp(function(){
                $('#detail-'+roleId).hide();
            });
        }
        return false;
    }

    $.ajax({
        url:msg.base_url+'admin/roles/permission/'+roleId,
        dataType:'json',
        success:function(json){
            close_alert();
            if(json.code == '1000')
            {
                $('#detail-'+roleId).find('td').css('padding','0px').html(json.data);
                $('#detail-'+roleId).find('.detail').slideDown(); 
            }
            else if(json.code == '1002')
            {
                show_login(json);
                $('#detail-'+roleId).remove();
            }
            else
            {
                if(typeof(json.msg) != 'undefined')
                {
                    show_error(json.msg);
                }
                else
                {
                    show_error(msg.error);
                }
                $('#detail-'+roleId).remove();
            }
        },
        beforeSend:function(){
            var html = "<tr class='details' id='detail-"+roleId+"'><td colspan='2' style='padding:10px 0;text-align:center' class='bg-grey'>";
            html += "<img src='"+msg.base_url+"assets/img/loading.gif'>";
            html += "</td></tr>";
            $('tr#'+roleId).after(html);
            loading();
        },
        error:function(){
            show_error();
        }
    })
}
//------------------------------------------------------------------------------
function addRole()
{
    var tr_html = "<tr id='new_node'><td colspan='2'>"+
                    "<div >"+
                        "<label class='radio-inline' style='padding-left: 0px;'><input name='name' class='form-control' placeholder='"+msg.role_cn_name+"' id='add-name-edit' maxlength='30' type='text'></label>"+
                        "<button id='node_add' onclick=\"saveRole()\" class='btn blue' type='button'>"+msg.save+"</button>"+
                        "<button id='node_cancle' onclick='cancelRoleEdit()' class='btn btn-default' type='button'>"+msg.cancel+"</button>"+
                        " <span class='help-block'></span>"+
                    "</div>"+
                "</td></tr>";

    $("#add_new").before(tr_html);
    $("input[id='add-name-edit']").focus();
    place_holder();
}
//------------------------------------------------------------------------------

function editRole(roleId)
{
    if(typeof(roleId)!='undefined' && roleId!='')
    {
        if($('#'+roleId+'-edit-btn').length > 0)
        {
            return false;
        }
        $.ajax({
            url:msg.base_url+'admin/roles/edit/'+roleId,
            dataType:'json',
            success:function(json){
                if(json.code == '1000')
                {
                    close_alert();
                    $('#'+roleId+'-name-span').hide();

                    $('#'+roleId+'-name-span').parent().append("<form role='form' class='form-inline' id='"+roleId+"-name-edit_span' style='margin-top:-15px;'>"
                                +"<div class='form-group col-md-6 col-xs-8 col-sm-8' style='padding-left:0px;'>"
                                +"<label class='radio-inline' style='padding-left: 0px;'><input type='text' id='"+roleId+"-name-edit' class='form-control' value=\""+json.name+"\"></label>"
                                +"<button type='button' class='btn blue' id='"+roleId+"-edit-btn' onclick=\"saveRole('"+roleId+"')\">"+msg.save+"</button>"
                                +"<button type='button' class='btn btn-default' id='"+roleId+"-cancel-btn' onclick=\"cancelRoleEdit('"+roleId+"')\">"+msg.cancel+"</button>"
                                +"<span class='help-block'></span></div></form>");
                }
                else if(json.code == '1002')
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
            error:function(){
                show_error();
            }
        })
    }
}
//------------------------------------------------------------------------------

function cancelRoleEdit(roleId)
{
    if(typeof(roleId) != 'undefined' && roleId != '')
    {
        $('#'+roleId+'-name-span').show();
        $('#'+roleId+'-name-edit_span').remove();
    }
    else
    {
        $('#new_node').remove();
    }
}
//------------------------------------------------------------------------------

function saveRole(roleId)
{
    var n='', n_en='';
    if(typeof(roleId) != 'undefined' && roleId != '')
    {
        n = $('#'+roleId+'-name-edit').val();
    }
    else
    {
        n = $('#add-name-edit').val();
        var roleId = '';
    }
    if(n=='' || n_en == '')
    {
        show_error(msg.name_can_not_empty);
    }
    $.ajax({
        url:msg.base_url + 'admin/roles/update',
        type:'post',
        data:{'roleId':roleId,'name':n},
        dataType:'json',
        beforeSend:function(){
            loading();
            if(roleId)
            {
                $("#"+roleId+"-name-edit_span").find('.form-group').removeClass('has-error'); 
                $("#"+roleId+"-name-edit_span").find('button').attr('disabled',true);
                $('#'+roleId+'-name-edit_span').find('span.help-block').html('');
            }
            else
            {
                $('#new_node').find('button').attr('disabled',true);
                $('#new_node').find('div').removeClass('has-error');
                $('#new_node').find('span.help-block').html('');
            }
        },
        success:function(json){
            close_alert();
            if(json.code == '1000')
            {
                cancelRoleEdit(roleId);
                if(typeof(roleId)!='undefined' && roleId != '')
                {
                    $('#'+roleId+'-name-span').html(json.name).show();
                }
                else
                {
                    var html = "<tr id='"+json.id+"' class='form-inline'>"
                             + "<td>&nbsp;<span id='"+json.id+"-name-span'>"+json.name+"</span></td>"
                             + "<td>";
                    if(typeof(json.set_permission)!='undefined' && json.set_permission == true)
                    {
                        html += "<a href='javascript:void(0)' onclick=\"showPermissions('"+json.id+"')\">"+msg.check_permission+"</a> &nbsp; ";
                    }
                    if(typeof(json.can_edit)!='undefined' && json.can_edit == true)
                    {
                        html += "<a href='javascript:void(0)' onclick=\"editRole('"+json.id+"')\" class='btn btn-xs blue btn-editable'><i class='fa fa-pencil'></i></a> &nbsp; ";
                    }
                    if(typeof(json.can_delete)!='undefined' && json.can_delete == true)
                    {
                        html += "<a href='javascript:void(0)' onclick=\"deleteRole('"+json.id+"')\" class='btn btn-xs red btn-removable'><i class='fa fa-times'></i></a>";
                    }
                    html += "</td></tr>";
                    $('#add_new').before(html);
                }
            }
            else if(json.code == '1002')
            {
                show_login(json);
            }
            else
            {
                if(typeof(json.msg)!='undefined')
                {
                    if(roleId)
                    {
                        $('#'+roleId+'-name-edit_span').find('div').addClass('has-error');
                        $('#'+roleId+'-name-edit_span').find('span.help-block').html(json.msg);
                    }
                    else
                    {
                        $('#new_node').find('div').addClass('has-error');
                        $('#new_node').find('span.help-block').html(json.msg);
                    }
                }
            }
            if(roleId)
            {
                $("#"+roleId+"-name-edit_span").find('button').attr('disabled',false);
            }
            else
            {
                $('#new_node').find('button').attr('disabled',false);
            }
        },
        error:function(){
            show_error();
            if(roleId)
            {
                $("#"+roleId+"-name-edit_span").find('button').attr('disabled',false);
            }
            else
            {
                $('#new_node').find('button').attr('disabled',false);
            }
        }
    })
}
//------------------------------------------------------------------------------

function deleteRole(roleId)
{
    doDelete('admin/roles/delete/'+roleId);
}

function delRole(roleId)
{
    if(typeof(roleId) == 'undefined')
    {
        return false;
    }
    $.ajax({
        url:msg.base_url+'admin/roles/delete',
        type:'post',
        dataType:'json',
        data:{'roleId':roleId},
        beforeSend:function(){
            loading();
            $('tr#'+roleId).find('a').attr('disabled',true);
        },
        success:function(json){
            close_alert();
            $('tr#'+roleId).find('a').attr('disabled',false);
            if(json.code == '1000')
            {
                show_success(msg.success);
                $('tr#'+roleId).remove();
                if($('tr#detail-'+roleId).length > 0)
                {
                    $('tr#detail-'+roleId).remove();        
                }
            }
            else if(json.code == '1002')
            {
                show_login(json);
            }
            else
            {
                show_error(json.msg);
            }
        }
    })
}
//------------------------------------------------------------------------------

function addPermission(roleId, permissionId)
{
    setPermission(roleId, permissionId, 'add');
}
//------------------------------------------------------------------------------
function delPermission(roleId, permissionId)
{
    setPermission(roleId, permissionId, 'del');
}
//------------------------------------------------------------------------------
function setPermission(roleId, permissionId, type)
{
    if(typeof(roleId)=='undefined' || typeof(permissionId)=='undefined' || typeof(type)=='undefined')
    {
        return false;
    }
    $.ajax({
        url:msg.base_url+'admin/roles/set_permission',
        type:'post',
        data:{'roleId':roleId, 'permissionId':permissionId, 'type':type},
        dataType:'json',
        beforeSend:function(){
            loading();
        },
        success:function(json){
            close_alert();
            if(json.code == '1000')
            {
                show_success(msg.success);
                var o = $('#'+roleId+'-'+permissionId);
                if(o.length > 0)
                {
                    o.find('.role-icon').attr('onclick','').unbind('click');
                    switch(type){
                        case 'add':
                            if(typeof(json.also_add)!='undefined')
                            {
                                var a;
                                $.each(json.also_add,function(key,item){
                                    if(item.cate!='' && item.id!='')
                                    {
                                        a = $('#'+roleId+'-'+item.id);
                                        if(a.length > 0)
                                        {
                                            a.find('.role-icon').attr('onclick','').unbind('click');
                                            a.find('.role-icon').click(function(){
                                                delPermission(roleId,item.id);
                                            });
                                            a.find('i').removeClass('fa-plus').addClass('fa-times').css('display','none');
                                            if($('#'+roleId+'-has-permission').find('#has-permission-'+item.cate).length > 0)
                                            {
                                                a.appendTo($('#'+roleId+'-has-permission').find('#has-permission-'+item.cate));
                                            }
                                            else
                                            {
                                                $('#'+roleId+'-has-permission').append("<div class='m-b-10'><b>"+item.title+" : </b></div><div id='has-permission-"+item.cate+"'></div><div class='clearfix m-b-10'></div>");
                                                a.appendTo($('#'+roleId+'-has-permission').find('#has-permission-'+item.cate));
                                            }
                                        }                                        
                                    }
                                });
                            }
                            o.find('.role-icon').click(function(){
                                delPermission(roleId,permissionId);
                            });
                            o.find('i').removeClass('fa-plus').addClass('fa-times').css('display','none');
                            if($('#'+roleId+'-has-permission').find('#has-permission-'+json.cate).length > 0)
                            {
                                o.appendTo($('#'+roleId+'-has-permission').find('#has-permission-'+json.cate));
                            }
                            else
                            {
                                $('#'+roleId+'-has-permission').append("<div class='m-b-10'><b>"+json.title+" : </b></div><div id='has-permission-"+json.cate+"'></div><div class='clearfix m-b-10'></div>");
                                o.appendTo($('#'+roleId+'-has-permission').find('#has-permission-'+json.cate));
                            }
                        break;
                        case 'del':
                            o.find('.role-icon').click(function(){
                                addPermission(roleId,permissionId);
                            });
                            o.find('i').removeClass('fa-times').addClass('fa-plus').css('display','none');
                            if($('#'+roleId+'-no-permission').find('#no-permission-'+json.cate).length > 0)
                            {
                                o.appendTo($('#'+roleId+'-no-permission').find('#no-permission-'+json.cate));
                            }
                            else
                            {
                                $('#'+roleId+'-no-permission').append("<div class='m-b-10'><b>"+json.title+" : </b></div><div id='no-permission-"+json.cate+"'></div><div class='clearfix m-b-10'></div>");
                                o.appendTo($('#'+roleId+'-no-permission').find('#no-permission-'+json.cate));
                            }
                        break;
                    }
                }
            }
            else if(json.code == '1002')
            {
                show_login(json);
            }
            else
            {
                show_error(json.msg);
            }
        },
        error:function(){
            show_error();
        }
    })
}
//------------------------------------------------------------------------------
