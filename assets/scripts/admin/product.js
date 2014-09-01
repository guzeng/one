
$(function(){
    $.each($('.product-pic-upload'),function(key,item){
        var id = $(item).attr('id');
        var i = $(item).attr('sort');
        $(item).on('click',function(){
            $('#pic_upload_'+i).click();
            //上传
            if($('#pic_upload_'+i).length>0 && $('#pro_pic_'+i).length>0)
            {
                $('#pic_upload_'+i).fileupload({
                    dataType: "json",
                    autoUpload: true,
                    url: msg.base_url+'uploadHandler',
                    // Enable image resizing, except for Android and Opera,
                    // which actually support image resizing, but fail to
                    // send Blob objects via XHR requests:
                    disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                    maxFileSize: 2048000,
                    maxNumberOfFiles : 1,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    start: function (e) {
                        loading();
                        $('#pic_upload_'+i).attr('disabled', true);
                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#upload-loading').show();
                        $('#upload-loading').find('div.progress-bar').width(progress + '%');
                        $('#upload-loading').find('div.progress-bar').find('span.sr-only').css({'width':'auto','height':'auto','clip':'auto'}).html(progress + '%');
                    },
                    fail: function (e, data) {
                        close_alert();
                        $('#pic_upload_'+i).attr('disabled', false);
                        show_error(data.errorThrown);
                        $('#upload-loading').hide();
                        $('#upload-loading').find('div.progress-bar').width('0%');
                        $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
                    },
                    done: function (e, data) {
                        close_alert();
                        //给隐藏值赋值
                        var url = data['result']['files'][0]['thumbnailUrl'];
                        $('#pro_pic_'+i).attr('src',url+"?"+Math.random());
                        $('#pro_pic_path_'+i).val(data['result']['files'][0]['name']);
                        data.context.text('');
                        $('#pic_upload_'+i).attr('disabled', false);
                        $('#upload-loading').hide();
                        $('#upload-loading').find('div.progress-bar').width('0%');
                        $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
                    } 
                });        
            } 
        })
    })

    $('#cate_id').select2({
        placeholder: "请选择",
        allowClear: true
    });
    CKEDITOR.replace( 'info', {
        // Load the German interface.
        language: 'zh-cn'
    });
    CKEDITOR.replace( 'promise', {
        // Load the German interface.
        language: 'zh-cn'
    });
})