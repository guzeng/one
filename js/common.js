
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
        eval(callback+"("+str+")");
        hide_confirm_dialog();
    })
    var h = 0-parseInt($('#_confirm_dialog').height());
    $('#_confirm_dialog').css({'z-index':'1150','top':'50%','margin-top':h}).show();
    $('body').append("<div class='modal-backdrop' id='_confirm_dialog_backgrop'></div>");
    close_alert();
}
//------------------------------------------------------------------------

function hide_confirm_dialog()
{
    $('#_confirm_dialog').hide(
        function(){
            $('#_confirm_dialog_backgrop').remove();
        }
    )
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
    change_height('_login_form');
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
 * browser
 * type of browser
 * 
    browser={
        version: (userAgent.match( /.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/ ) || [0,'0'])[1],
        safari: /webkit/.test( userAgent ),
        opera: /opera/.test( userAgent ),
        msie: /msie/.test( userAgent ) && !/opera/.test( userAgent ),
        mozilla: /mozilla/.test( userAgent ) && !/(compatible|webkit)/.test( userAgent )
    }
 * @author zeng.gu
 * @2013/4/9
 */
function msie()
{
    var userAgent = navigator.userAgent.toLowerCase();
    if(/msie/.test( userAgent ) && !/opera/.test( userAgent ))
    {
        return true;
    }
    return false;
}
//------------------------------------------------------------------------

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

function load_page(target, url, callback)
{
    if(typeof(target)!='undefined' && typeof(url)!='undefined' && target != '' && url != '')
    {
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

function load_submit_page(target, formID)
{
    if(typeof(target)!='undefined' && typeof(formID)!='undefined' && target != '' && formID != '')
    {
        $('#'+formID).find('input[type=text]').each(function(){
            if($(this).val()==$(this).attr('placeholder'))
            {
                $(this).val('');
            }
        })
        $('#'+formID).ajaxSubmit({
            dataType:'json',
            beforeSend:function(){
                show_alert(msg.loading,'loading');
            },
            success:function(data){
                close_alert();
                if(typeof(data.code)!='undefined' && data.code == '1002')
                {
                    show_login();
                }
                else if(data.code=='1000')
                {
                    $('#'+target).html(data.data);
                }
                place_holder();
            },
            error:function(){
                show_alert(msg.error, 'error');
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
        beforeSubmit:function(){
            show_alert(msg.loading,'loading');
        },
        success:function(data){
            close_alert();
            if(typeof(data.code)!='undefined' && data.code == '1002')
            {
                show_login();
            }
            else if(data.code=='1000')
            {
                if(typeof(callback) == 'function')
                {
                    callback();
                }
                else
                {
                    show_alert(msg.success, 'success');
                }
            }
            else
            {
                if(typeof(data.msg)!='undefined')
                {
                    show_alert(data.msg,'error');
                }
                else
                {
                    show_alert(msg.error, 'error');
                }
            }
        },
        error:function(){
            show_alert(msg.error, 'error');
        }
    })
}
//------------------------------------------------------------------------
