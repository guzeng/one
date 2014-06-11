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
        $('#_confirm_dialog').find('#_dialog_title').html(title);
    }
   
    $('#_confirm_dialog').find('#_dialog_body').html(msg);
    var str = '';
    if(typeof(param)!='undefined')
    {
        str = '"'+param.replace('|','","')+'"';  
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
                //close_alert();
                if(typeof(data.code)!='undefined' && data.code == '1002')
                {
                    show_login();
                }
                else if(data.code=='1000')
                {
                    $('#'+target).html(data.data);
                    //adjust_footer();
                }
                else if(typeof(data.msg)!='undefined')
                {
                    //show_alert(data.msg,'error');
                }
				place_holder();
                if(typeof(callback)=='function')
                {
                    callback();
                }
                $("html,body").animate({scrollTop:$("#"+target).offset().top-85},1000);
            },
            error:function(){
                //show_alert(msg.error, 'error');
            },
            beforeSend:function(){
                //show_alert(msg.loading, 'loading');
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
function show_login()
{
    $('#_login_form').show();
    $('body').append("<div class='modal-backdrop' id='_login_form_backdrop' style='z-index:2000'></div>");
    //change_height('_login_form');
    $('#_relogin_form').find('#password_f').val('');
    $('#_relogin_form').find('#error_message').html('');

    if($('#_login_form').find('#username').val()!='')
    {
        $('#_login_form').find('#password_f').focus();
    }
    else
    {
        $('#_login_form').find('#username').focus();    
    }
    if($('#_login_form').find('#login_captcha').length>0)
    {
        refresh_captcha();    
    }
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
    $('#_login_form').hide();
    $('#_login_form_backdrop').remove();
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
            $('#'+formID).find('div.form-group').removeClass('has-error');
            $('#'+formID).find('span.error-span').html('').removeClass('error-span');
            $('#'+formID).find('button').addClass('disabled');
        },
        success:function(data){
            close_alert();
            $('#'+formID).find('button').removeClass('disabled');
            if(typeof(data.code)!='undefined' && data.code == '1002')
            {
                show_login();
            }
            else if(data.code=='1000')
            {
                show_success();
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