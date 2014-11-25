var clearTime = '';
function show_success(msg)
{
    close_alert();
    clearTimeout(clearTime);
    if(typeof(msg)=='undefined' || msg=='')
    {
        var msg = '操作成功';
    }
    var html = "<div class='alert alert-success alert-dismissable show-alert' id='success'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'></button>"
             + "<i class='fa fa-thumbs-o-up'></i> <strong>"+msg+"</strong>"
             + "</div>";
    $('body').append(html);
    var w = parseInt($('#success').width())+60;
    $('#success').css('margin-left',(0-w/2)+'px');
    clearTime = setTimeout(function(){$('#success').remove();},5000);
}
function show_error(msg)
{
    close_alert();
    if(typeof(msg)=='undefined' || msg=='')
    {
        var msg = '出现错误';
    }
    var html = "<div class='alert alert-danger alert-dismissable show-alert' id='error'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'></button>"
             + "<i class='fa fa-warning'></i> <strong>"+msg+"</strong>"
             + "</div>";
    $('body').append(html);
    var w = parseInt($('#error').width())+60;
    $('#error').css('margin-left',(0-w/2)+'px');
}
function loading()
{
    close_alert();
    var html = "<div class='alert alert-info alert-dismissable show-alert' id='loading' style='width:150px; margin-left: -75px;'>"
             + "<button aria-hidden='true' data-dismiss='alert' class='close' type='button'></button>"
             + "<i class='fa fa-spinner'></i> <strong>请稍候...</strong>"
             + "</div>";
    $('body').append(html);
}
/**
 * close_alert
 * 关闭提示
 * 
 */ 
function close_alert(callback){
    $('.show-alert').remove();
    if(typeof(callback)!='undefined' && callback!='' && callback!='undefined')
    {
        callback();
        //$('.modal-backdrop').fadeOut('slow',function(){$(this).remove()});
    }
}
//------------------------------------------------------------------------
function reload()
{
    window.location.reload();
}
//------------------------------------------------------------------------

/**
 * confirm_course
 * 
 * 确认
 * @param int 
 * @2013/3/21
 * @author zeng.gu
 */
function confirm_dialog(title,msg,callback,param)
{
    if(typeof(title)=='undefined' || title=='' || title==null || typeof(msg)=='undefined' || msg=='' || msg==null)
    {
        return false;
    }
    if(typeof(title)!='undefined')
    {
        $('#_confirm_dialog').find('.modal-title').html(title);
    }
   
    $('#_confirm_dialog').find('.modal-body').html(msg);
    var str = '';
    if(typeof(param)!='undefined')
    {
        str = param;  
    }
    $('#_confirm_dialog').find('#_confirm_btn').unbind('click');
    $('#_confirm_dialog').find('#_confirm_btn').click(function(){
        if(typeof(callback)=='function')
        {
            callback(str);
        }
        $('#_confirm_dialog').modal('hide');
    })
    var h = 0-parseInt($('#_confirm_dialog').height());
    $('#_confirm_dialog').modal();
    close_alert();
}
//------------------------------------------------------------------------

/**
 *  change_height
 *  
 *  弹出窗口后，修改高度以适应不同浏览器大小
 *  @param string url
 *  @2013/4/1
 *  @author zeng.gu
 */
function change_height(id)
{
    var h = parseInt($(window).height());  
    $('#'+id).find('.modal-body').css('max-height',(h-160)+'px');
    var modal_h = $('#'+id).height();
    $('#'+id).css('top',parseInt((h-modal_h)/2-10)); 
}
//------------------------------------------------------------------------

/**
 * placeholder
 * placeholder for IE         
 * 
 * @author zeng.gu
 * @2013/4/9
 */
function place_holder()
{
    $.support.placeholder = false;
    if ("placeholder" in document.createElement("input")) $.support.placeholder = true;
    if (!$.support.placeholder) {
        var active = document.activeElement;
        $(":text, textarea").on("focus", function () {
            if ($(this).attr("placeholder") != "" && $(this).val() == $(this).attr("placeholder") && $(this).hasClass("placeholder")==true) {
                $(this).val("");
            }
            $(this).removeClass('placeholder');
        }).on("blur", function () {
            if (typeof($(this).attr("placeholder")) != "undefined" && $(this).val() == "" ) {
                $(this).val($(this).attr("placeholder")).addClass('placeholder');
            }
            else if($(this).attr("placeholder") != $(this).val())
            {
                $(this).removeClass('placeholder');
            }
        });
        $(":text, textarea").blur();
        $(active).focus();
        $("form").submit(function () {
            $(this).find(".placeholder").each(function () {
                if($(this).val()==$(this).attr('placeholder')){
                    $(this).val("");
                } 
            });
        });
    }
}
//---------------------------------------------------------------------------------

/**
 * isExistOption
 * select中是否存在某值
 * @author zeng.gu
 * @2013/4/12
 */
function isExistOption(id,value) {
    var isExist = false;
    var count = $('#'+id).find('option').length;
    for(var i=0;i<count;i++)
    {
        if($('#'+id).get(0).options[i].value == value)
        {
            isExist = true;
            break;
        }
    }
    return isExist;
}
//------------------------------------------------------------------------

//处理键盘事件 禁止后退键（Backspace）密码或单行、多行文本框除外
function banBackSpace(e){
    var ev = e || window.event;//获取event对象
    var obj = ev.target || ev.srcElement;//获取事件源
    var t = obj.type || obj.getAttribute('type');//获取事件源类型
    //获取作为判断条件的事件类型
    var vReadOnly = obj.readOnly;
    var vDisabled = obj.disabled;
    //处理undefined值情况
    vReadOnly = (vReadOnly == undefined) ? false : vReadOnly;
    vDisabled = (vDisabled == undefined) ? true : vDisabled;
    //当敲Backspace键时，事件源类型为密码或单行、多行文本的，
    //并且readOnly属性为true或disabled属性为true的，则退格键失效
    var flag1= ev.keyCode == 8 && (t=="password" || t=="text" || t=="textarea")&& (vReadOnly==true || vDisabled==true);
    //当敲Backspace键时，事件源类型非密码或单行、多行文本的，则退格键失效
    var flag2= ev.keyCode == 8 && t != "password" && t != "text" && t != "textarea" ;
    //判断
    if(flag2 || flag1)return false;
}
//------------------------------------------------------------------------

function is_json(obj){
    var isjson = typeof(obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length;    
    return isjson;
}
//------------------------------------------------------------------------

function load_page(url, target, callback)
{
    if(typeof(target)=='undefined' || target == '')
    {
        var target = 'page-area';
    }
    if(typeof(target)!='undefined' && typeof(url)!='undefined' && target != '' && url != '')
    {
        if(url.indexOf('http') < 0)
        {
            url = msg.base_url + url;
        }
        $.ajax({
            url:url,
            dataType:'json',
            success:function(data){
                close_alert();
                if(typeof(data.code)!='undefined' && data.code == '1002')
                {
                    show_login(data);
                }
                else if(data.code=='1000')
                {
                    $('#'+target).html(data.data);
                    //adjust_footer();
                }
                else if(typeof(data.msg)!='undefined')
                {
                    show_alert(data.msg);
                }
				place_holder();
                if(typeof(callback)=='function')
                {
                    callback();
                }
                $("html,body").animate({scrollTop:$("#"+target).offset().top-85},1000);
            },
            error:function(){
                show_alert(msg.error);
            },
            beforeSend:function(){
                //show_alert(msg.loading, 'loading');
                loading();
            }
        })
    }
}
//------------------------------------------------------------------------

function enterSumbit(){  
      var event=arguments.callee.caller.arguments[0]||window.event;//消除浏览器差异  
     if (event.keyCode == 13){  
        $('.submit-btn').click();  
     }  
}
//------------------------------------------------------------------------

/**
 * show log in popup
 * 重新登录
 * 
 * @author zeng.gu
 * @2013/08
 */
function show_login(data)
{
    $('#_login_form').modal();
    $('#_relogin_form').find('#password').val('');
    $('#_relogin_form').find('#error_message').find('span.help-block').html('');
    if($('#_relogin_form').find('#username').val()!='')
    {
        $('#_relogin_form').find('#password').focus();
    }
    else
    {
        $('#_relogin_form').find('#username').focus();    
    }
    
    if($('#_relogin_form').find('#login_captcha').length>0)
    {
        refreshValidateKey();
        $('#_relogin_form').find('input[name=validate_key]').val('');
    }
    $('#_login_form').find('#relogin_form_submit_btn').attr('disabled',false).show();
    $('#_login_form').find('#_login_form_loading').remove();

}
//------------------------------------------------------------------------

/**
 * hide log in popup
 * 重新登录
 * 
 * @author zeng.gu
 * @2013/08
 */
function hide_login_form()
{
    $('#_login_form').modal('hide');
}
//------------------------------------------------------------------------

function login()
{
    if($('#_relogin_form').find('#username').val()=='')
    {
        return false;
    }
    if($('#_relogin_form').find('#password').val()=='')
    {
        return false;
    }
    $('#_relogin_form').ajaxSubmit({
        'dataType':'json',
        success:function(json){
            $('#relogin_form_submit_btn').show();
            $('#_login_form_loading').remove();
            if(json.code == '1000')
            {
                show_success(json.msg);
                hide_login_form();                
            }
            else
            {
                $('#error_message').html("<span class='help-block'>"+json.msg+"</span>");
                $('#error_message').addClass('has-error').show();
                $('#error_message').parent().show();
                $('#_relogin_form').find('input[name=password]').val('').focus();    
            }
        },
        beforeSubmit:function(){
            $('#_login_form').find('#relogin_form_submit_btn').before("<img id='_login_form_loading' src='"+msg.base_url+"assets/img/input-spinner.gif' height='16'>");
            $('#relogin_form_submit_btn').hide();
            $('#error_message').find('span.help-block').html('');
            $('#error_message').removeClass('has-error').hide();
        }
    })
}
//------------------------------------------------------------------------

/**
 * submit
 *
 */
function do_submit(formID, callback)
{
    if(typeof(formID) == 'undefined' || formID == '')
    {
        return false;
    }
    $('#'+formID).ajaxSubmit({
        dataType:'json',
        async:false,
        type:'post',
        beforeSubmit:function(){
            loading();
            $('#'+formID).find('div.has-error').removeClass('has-error');
            $('#'+formID).find('span.error-span').html('').removeClass('error-span');
            $('#'+formID).find('button').addClass('disabled');
        },
        success:function(data){
            close_alert();
            $('#'+formID).find('button').removeClass('disabled');
            if(typeof(data.code)!='undefined' && data.code == '1002')
            {
                show_login(data);
            }
            else if(data.code=='1000')
            {
                show_success(data.msg);
                if(typeof(data.goto)!='undefined')
                {
                    window.location.href = msg.base_url+data.goto;
                }
            }
            else
            {
                show_error(data.msg);
                if(typeof(data.error)!='undefined' && data.error != '')
                {
                    $.each(data.error,function(key,item){
                        if(item!='')
                        {
                            if($('input[name='+key+']').length > 0)
                            {
                                $('#'+formID).find('input[name='+key+']').parent().addClass('has-error');
                                $('#'+formID).find('input[name='+key+']').parent().find('span.help-block').html(item).addClass('error-span');
                            }
                            else if($('textarea[name='+key+']').length > 0)
                            {
                                $('#'+formID).find('textarea[name='+key+']').parent().addClass('has-error');
                                $('#'+formID).find('textarea[name='+key+']').parent().find('span.help-block').html(item).addClass('error-span');
                            }
                            else if($('select[name='+key+']').length > 0)
                            {
                                $('#'+formID).find('select[name='+key+']').parent().addClass('has-error');
                                $('#'+formID).find('select[name='+key+']').parent().find('span.help-block').html(item).addClass('error-span');
                            }
                        }
                    })
                }
            }
            if(typeof(callback) == 'function')
            {
                callback(data);
            }
        },
        error:function(){
            $('#'+formID).find('button').removeClass('disabled');
            show_error();
        }
    })
}
//------------------------------------------------------------------------

function goback()
{
    history.go(-1);
}

/**
 * Advanced table init
 * @param tableID  table's id attribute
 */
var oTable;
function initTable(tableID) 
{
    oTable = '';
    if($('#'+tableID).length > 0)
    {
        oTable = $('#'+tableID).dataTable({           
            "aoColumnDefs": [
                { "aTargets": [ 0 ] }
            ],
            "aaSorting": [[0, 'asc']],
            "aLengthMenu": [
                [10, 5, 10, 15, 20, -1],
                ['', 5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
            "bDestroy" :true,
            "oLanguage": {
                        "sLengthMenu": "每页显示 _MENU_ ",  
                        "sZeroRecords": "未查询到任何相关数据",  
                        "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_ 条记录",  
                        "sInfoFiltered": "（从 _MAX_ 条记录中搜索）",  
                        "sProcessing": "正在加载中...",  
                        "sSearch": "搜索 : ",
                        "sInfoEmpty": "当前显示 0 至 0， 共 0 项",
                        "oPaginate":  {"sFirst":"第一页","sPrevious":"上一页 ","sNext":"下一页 ","sLast":"末页 "}
                    },
        });

        jQuery('#'+tableID+'_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#'+tableID+'_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#'+tableID+'_wrapper .dataTables_length select').select2(); // initialize select2 dropdown.TR54
        $('#'+tableID+'_column_toggler input[type="checkbox"]').off().on('change',function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            //var bVis = $(this).parent().hasClass('checked');//oTable.fnSettings().aoColumns[iCol].bVisible;
            if($(this).attr('checked')=='checked'){
                bVis = false;
                $(this).removeAttr('checked');
            }
            else
            {
                bVis = true;
                $(this).attr('checked','checked');
            }
            oTable.fnSetColumnVis(iCol, bVis);
        });
    }
}
/**
 * 删除列表中一条记录
 */
function doDelete(url)
{
    confirm_dialog('删除确认','确认删除该记录吗？',Delete,url);
}
function Delete(url)
{
    var uri = url.replace(/\"/g,'');
    if(typeof(uri)!='undefined' && uri!='' && uri!=null)
    {
        $.ajax({
            url:msg.base_url+uri,
            dataType:'json',
            success:function(data){
                if(data.code=='1000')
                {
                    if(typeof(data.ids)!='undefined')
                    {
                        $.each(data.ids,function(key,item){
                            $('#'+item).remove();
                        })
                    }
                    else
                    {
                        $('#'+data.data.id).remove();
                    }
                    show_success(data.msg);
                    if(typeof(delete_callback)=='function')
                    {
                        delete_callback();
                    }
                }
                else
                {
                    show_error(data.msg);
                }
            },
            beforeSubmit:function(){
                loading();
            },
            error:function(){
                show_error();
            }
        })        
    }
}
/**
 * 重新加载列表 
 */
function reload_list(boxID,tableID,url){
    var el = $('#'+boxID).children('.portlet-body');
    $.ajax({
        url:msg.base_url+url,
        dataType:'json',
        success:function(data){
            App.unblockUI(el);
            if(data.code == '1000')
            {
                el.html(data.data);
                initTable(tableID);
            }
            else
            {
                show_error();
            }
        },
        beforeSend:function(){
            App.blockUI(el);
        },
        error:function(){
            App.unblockUI(el);
            show_error();
        }
    })
}

function hide_tree_list(compare, current)
{
    if(typeof(current) != 'undefined' && typeof(compare)!='undefined' && $(current).length>0)
    {
        var compare_deep = $(compare).attr('deep');
        var current_deep = $(current).attr('deep');
        if(parseInt(compare_deep) < parseInt(current_deep))
        {
            if(typeof($(compare).attr('show_child'))=='undefined' || $(compare).attr('show_child')=='true')
            {
                var parent_id = $(current).attr('parent');
                if($('#'+parent_id).css('display')!='none' && (typeof($('#'+parent_id).attr('show_child'))=='undefined' || $('#'+parent_id).attr('show_child')=='true'))
                {
                    current.show();
                    //图标处理
                    $(current).find('img.fold-icon').attr('src',msg.base_url+'assets/img/minus.png');
                }
                else
                {
                    current.hide();
                    //图标处理
                    $(current).find('img.fold-icon').attr('src',msg.base_url+'assets/img/plus.png');
                }
            }
            else
            {
                current.hide();
            }
            hide_tree_list(compare,$(current).next());
        }
    }
}
//------------------------------------------------------------------------

/**
 * 
 * 获取地区
 */
function areaChange(obj,area_level)
{
    var id = $(obj).val();
    if(parseInt(id) == 0)
    {
        $(obj).nextAll().has('option').html("<option value='0'>请选择</option>");
        return;
    }
    $.ajax({
        url:msg.base_url+"admin/areas/lists/"+id+"/"+area_level,
        dataType:'json',
        success:function(data){
            if(data.code=='1000')
            {
                if(typeof(data.area)!='undefined')
                {
                    $(obj).next().has('option').html("<option value='-1'>请选择</option>");
                    $(obj).next().next().has('option').html("<option value='-1'>请选择</option>");
                    var option = "";
                    
                    if(data.zhi_xia_shi)
                    {
                        if($(obj).nextAll().size() >2 )
                        {
                            $(obj).next().has('option').hide();
                        }
                        $(obj).next().next().has('option').html("<option value='-1'>请选择</option>");

                        $.each(data.area,function(key,item){
                            option += "<option value='"+item['area_id']+"'>"+item['area_name']+"</option>";
                        })

                        $(obj).next().next().append(option);
                    }
                    else
                    {
                        $(obj).next().has('option').show();
                        $.each(data.area,function(key,item){
                            option += "<option value='"+item['area_id']+"'>"+item['area_name']+"</option>";
                        })
                        $(obj).next().has('option').append(option);
                    }
                }
            }
            else
            {
                show_error(data.msg);
            }
        },
        beforeSubmit:function(){
            loading();
        },
        error:function(){
            show_error();
        }
    })        
}
//------------------------------------------------------------------------

function cart_count(type,obj,cart)
{
    if(typeof(type)=='undefined')
    {
        return false;
    }
    var c = $(obj).parent().find('input[name=cart_num]').val();
    var count;
    switch(type)
    {
        case 'plus':
            var max=$(obj).parent().find('input[name=max_num]').val();
            if(parseInt(c)+1 > parseInt(max))
            {
                count = max;
            }
            else
            {
                count = parseInt(c)+1;
            }
        break;
        case 'minus':
            var min=$(obj).parent().find('input[name=min_num]').val();
            if(min=='' || parseInt(min)<1)
            {
                min = 1;
            }
            if(parseInt(c)-1 > parseInt(min))
            {
                count = parseInt(c)-1;
            }
            else
            {
                count = min;
            }
        break;
    }
    $(obj).parent().find('input[name=cart_num]').val(count);
    if(typeof(cart) != 'undefined')
    {
        $.ajax({
            url:msg.base_url+'carts/update',
            type:'post',
            data:{'product_id':$(obj).parent().find('input[name=cart_num]').attr('product'),'count':count},
            dataType:'json',
            success:function(json)
            {
                if(json.code == '1000')
                {
                    if($('#total_price').length > 0 && typeof(json.price.total_price)!='undefined')
                    {
                        $('#total_price').html(json.price.total_price);
                    }
                    if($('#total_best_price').length > 0 && typeof(json.price.total_price)!='undefined' && typeof(json.price.total_best_price)!='undefined')
                    {
                        $('#total_best_price').html(json.price.total_price-json.price.total_best_price);
                    }
                    if($('#order_price').length > 0 && typeof(json.price.total_best_price)!='undefined')
                    {
                        $('#order_price').html(json.price.total_best_price);
                    }
                }
                else
                {
                    show_error(json.msg);
                }
            },
            error:function()
            {
                show_error('数量修改失败');
                $(obj).parent().find('input[name=cart_num]').val(c);
            }
        })
    }
}


function addCart(id)
{
    if(typeof(id) == 'undefined' || id=='')
    {
        return false;
    }
    $.ajax({
        url:msg.base_url+'carts/add',
        data:{'product_id':id,'count':$('#'+id+'_num').val()},
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                show_success(json.msg);
                if(typeof(json.total)!='undefined')
                {
                    $('#cart_total').html('('+json.total+')');
                }
            }
            else if(json.code=='1002')
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

function delCart(id)
{
    if(typeof(id) == 'undefined' || id=='')
    {
        return false;
    }
    $.ajax({
        url:msg.base_url+'carts/del/',
        data:{'product_id':id},
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.code=='1000')
            {
                $('#cart_row_'+id).remove();
                show_success(msg.delete_success);
                if($('#cart_total').length > 0)
                {
                    $('#cart_total').html('('+json.total+')');
                }
                if(json.total == 0)
                {
                    $('#myTabContent').hide();
                    $('#cart-empty').show();
                }
                if($('#total_price').length > 0 && typeof(json.price.total_price)!='undefined')
                {
                    $('#total_price').html(json.price.total_price);
                }
                if($('#total_best_price').length > 0 && typeof(json.price.total_price)!='undefined' && typeof(json.price.total_best_price)!='undefined')
                {
                    $('#total_best_price').html(json.price.total_price-json.price.total_best_price);
                }
                if($('#order_price').length > 0 && typeof(json.price.total_best_price)!='undefined')
                {
                    $('#order_price').html(json.price.total_best_price);
                }
            }
            else
            {
                show_error(json.msg);
            }
        }
    })
}

/**
 * ajax请求
 * @param url       
 * @param data      
 * @param btnId     提交按钮Id
 * @param callback  回调函数
 * @param type      请求类型，默认post
 */
function ajaxRequest(url,btn){
    $.ajax({
        url:msg.base_url+url,
        type:'get',
        dataType:'json',
        success:function(json){ 
            close_alert();
            $(btn).attr('disabled',false);
            if(typeof(json.code)!='undefined' && json.code == '1002')
            {
                show_login(json);
            }
            else if(json.code=='1000')
            {
                if(typeof(json.msg)!='undefined')
                {
                    show_success(json.msg);
                }
                if(typeof(json.url)!='undefined')
                {
                    document.location.href=json.url;
                }
            }
            else
            {
                if(typeof(json.msg)!='undefined')
                {
                    show_error(json.msg);
                }
            }
        },
        beforeSend:function(){
            loading();
            $(btn).attr('disabled',true);
        },
        error:function(){
            show_error();
            $(btn).attr('disabled',false);
        }
    });
}

function checkLogin(formID)
{
    $.ajax({
        url:msg.base_url+'login/check',
        dataType:'json',
        success:function(json){
            if(json.code == '1000')
            {
                $('#'+formID).submit();
            }
            else
            {
                show_login();
            }
        },
        error:function(){
            show_error();
        },
        beforeSend:function(){
            loading();
        }
    })
}