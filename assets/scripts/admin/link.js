
$(function(){
    //上传
    $('#skin_edit_upload').fileupload({
        dataType: "json",
        autoUpload: true,
        url: msg.base_url+'uploadHandler',
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        maxFileSize: 1000000,
        maxNumberOfFiles : 1,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        start: function (e) {
        	loading();
            $('#skin_edit_upload').attr('disabled', true);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#upload-loading').show();
            $('#upload-loading').find('div.progress-bar').width(progress + '%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').css({'width':'auto','height':'auto','clip':'auto'}).html(progress + '%');
        },
        fail: function (e, data) {
        	close_alert();
            $('#skin_edit_upload').attr('disabled', false);
            show_error(data.errorThrown);
            $('#upload-loading').hide();
            $('#upload-loading').find('div.progress-bar').width('0%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
        },
        done: function (e, data) {
            close_alert();
            //给隐藏值赋值
            var url = var url = data['result']['files'][0]['thumbnailUrl'] ? data['result']['files'][0]['thumbnailUrl'] : data['result']['files'][0]['url'];
            $('#review_pic').html('');
            if($('#link_setting_pic').length>0)
            {
            	$('#link_setting_pic').attr('src',url+"?"+Math.random());
            }
            else
            {
            	$('#review_pic').prepend("<img src='"+url+"?"+Math.random()+"' id='link_setting_pic' style='max-width:120px;height:68px;'>");	
            }
            $('#link_pic_path').val(data['result']['files'][0]['name']);
            //$('#upload_file_con').hide();
            data.context.text('');
            $('#skin_edit_upload').attr('disabled', false);
            $('#upload-loading').hide();
            $('#upload-loading').find('div.progress-bar').width('0%');
            $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
        } 
    });
})
function cancel_upload()
{
    $('#review_pic').html('');
    $('#link_pic_path').val('');
    $('#upload_file_con').show();
}