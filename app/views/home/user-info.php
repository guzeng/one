<?$this->load->view('home/header')?>
<link href="<?php echo base_url()?>assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/css/datepicker.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js"></script>
<script type="text/javascript">
    $(function(){
        //地区
        $("#province").change(function(){
            areaChange($("#province"),2);
        });
        $("#city").change(function(){
            areaChange($("#city"),3);
        });
        //时间
        $('#birthday').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            language: 'zh-CN'
      });
        //上传
        $('#user_edit_upload').fileupload({
            dataType: "json",
            autoUpload: true,
            url: msg.base_url+'uploadHandler',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 2000000,
            maxNumberOfFiles : 1,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            start: function (e) {
                loading();
                $('#user_edit_upload').attr('disabled', true);
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#upload-loading').show();
                $('#upload-loading').find('div.progress-bar').width(progress + '%');
                $('#upload-loading').find('div.progress-bar').find('span.sr-only').css({'width':'auto','height':'auto','clip':'auto'}).html(progress + '%');
            },
            fail: function (e, data) {
                close_alert();
                $('#user_edit_upload').attr('disabled', false);
                show_error(data.errorThrown);
                $('#upload-loading').hide();
                $('#upload-loading').find('div.progress-bar').width('0%');
                $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
            },
            done: function (e, data) {
                close_alert();
                //给隐藏值赋值
                var url = data['result']['files'][0]['thumbnailUrl'] ? data['result']['files'][0]['thumbnailUrl'] : data['result']['files'][0]['url'];
                $('#review_pic').html('');
                if($('#user_pic').length>0)
                {
                    $('#user_pic').attr('src',url+"?"+Math.random());
                }
                else
                {
                    $('#review_pic').prepend("<img src='"+url+"?"+Math.random()+"' id='user_pic' class='relative' style='max-width:100px;height:100px;margin-bottom:10px;top:70px;'>");   
                }
                $('#img_100').attr('src',url+"?"+Math.random());
                $('#img_50').attr('src',url+"?"+Math.random());

                $('#user_pic_path').val(data['result']['files'][0]['name']);
                //$('#upload_file_con').hide();
                data.context.text('');
                $('#user_edit_upload').attr('disabled', false);
                $('#upload-loading').hide();
                $('#upload-loading').find('div.progress-bar').width('0%');
                $('#upload-loading').find('div.progress-bar').find('span.sr-only').html('0%');
            } 
        });
    })
</script>

<div class='container m-t-20'>
    <div class='row' id="user-info">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <div id="main">
                <div class="tab-content">
                    <!-- 账户信息 -->
            	    <div id="tab_1-1" class="tab-pane active">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#account-info">账户信息</a></li>
                                <li class=""><a data-toggle="tab" href="#account-pic">头像照片</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="account-info" class="tab-pane active">
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url()?>home/users/update" method="post" onsubmit='return false' role="form" id='user_info_form' class="form-horizontal">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">昵称：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" value="<?php echo isset($user)&&isset($user->alias)?$user->alias:'';?>" id="alias" name="alias" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">真实姓名：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" value="<?php echo isset($user)&&isset($user->name)?$user->name:'';?>" id="name" name="name" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">生日：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input readonly type="text" value="<?php echo isset($user)&&isset($user->birthday) && $user->birthday?date('Y-m-d',$user->birthday):'';?>" id="birthday" size="16" type="text"  name="birthday" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">身份证：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" value="<?php echo isset($user)&&isset($user->id_card_number)?$user->id_card_number:'';?>" id="id_card_number" name="id_card_number" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">邮箱：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" value="<?php echo isset($user)&&isset($user->email)?$user->email:'';?>" id="email" name="email" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">手机：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" value="<?php echo isset($user)&&isset($user->phone)?$user->phone:'';?>" id="phone" name="phone" maxlength="30" class="form-control">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">地区：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <?php if(isset($user->area)&&$user->area):?>
                                                            <select class="form-control input-small inline" id="province">
                                                                <option value="0">请选择</option>
                                                                <?php foreach($area['province_list'] as $key => $item):?>
                                                                <option <?php echo $item->area_id == $area['province']->area_id?'selected':'';?> value="<?php echo $item->area_id;?>"><?php echo $item->area_name;?></option>
                                                                <?endforeach;?>
                                                            </select>
                                                            <?php if($area['city'] && !empty($area['city_list'])):?>
                                                            <select class="form-control input-small inline" id="city">
                                                                <option value="0">请选择</option>
                                                                <?php foreach($area['city_list'] as $key => $item):?>
                                                                <option <?php echo $item->area_id == $area['city']->area_id?'selected':'';?> value="<?php echo $item->area_id;?>"><?php echo $item->area_name;?></option>
                                                                <?endforeach;?>
                                                            </select>
                                                            <?else:?>
                                                            <select class="form-control input-small inline hide" id="city">
                                                                <option value="0">请选择</option>
                                                            </select>
                                                            <?endif;?>
                                                            <select class="form-control input-small inline" id="area" name="area">
                                                                <option value="0">请选择</option>
                                                                <?php foreach($area['qu_list'] as $key => $item):?>
                                                                <option <?php echo $item->area_id == $area['qu']->area_id?'selected':'';?> <?php $user->area==$item->area_id?'selected':'';?>value="<?php echo $item->area_id;?>"><?php echo $item->area_name;?></option>
                                                                <?endforeach;?>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        <?else:?>
                                                            <select class="form-control input-small inline" id="province">
                                                                <option value="0">请选择</option>
                                                                <?php foreach($area['province_list'] as $key => $item):?>
                                                                <option value="<?php echo $item->area_id;?>"><?php echo $item->area_name;?></option>
                                                                <?endforeach;?>
                                                            </select>
                                                            <select class="form-control input-small inline" id="city">
                                                                <option value="0">请选择</option>
                                                            </select>
                                                            <select class="form-control input-small inline" id="area" name="area">
                                                                <option value="0">请选择</option>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">地址：</label>
                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                        <input type="text" id="address" name="address" maxlength="50" class="form-control" value="<?php echo isset($user)?$user->address:'';?>">
                                                        <span class="help-block"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"></label>
                                                    <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                                         <button type="button" class="btn btn-block green" onclick="do_submit('user_info_form')" id='user_info_submit_btn'>保存</button>
                                                    </div>
                                                </div>
                                                <input type='hidden' id='id' name='id' value="<?php echo isset($user)?$user->id:'';?>">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="account-pic" class="tab-pane">
                                    <form action="<?php echo base_url()?>home/users/upload_pic" method="post" onsubmit='return false' role="form" id='user_pic_form' class="form-horizontal">
                                      <div class="row">
                                        <div class="col-md-8">
                                            <div id="upload_pic">
                                                <div class="row fileupload-buttonbar" id='upload_file_con'>
                                                    <div class="col-md-3">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                                        <span class="btn default fileinput-button" style='padding-left:60px;padding-right:60px;border:1px solid #ccc;border-radius:2px !important;background-color:#f5f5f5'>
                                                        <span>选择要上传的头像</span>
                                                        <input id="user_edit_upload" type="file" name="files" multiple="false">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class='clearfix'></div>
                                                <div class="progress progress-striped active hide" id="upload-loading">
                                                    <div style="width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                                                        <span class="sr-only"></span>
                                                    </div>
                                                </div>
                                                <p class='help-block'>接受图片格式：.jpg .png .gif , 图片大小小于2M </p>
                                            </div>
                                            <div id="review_pic" class="m-t-10 bg-c-f5 relative" style="text-align:center;height:240px;">
                                                <?if(isset($user)&&$user->id>0):?>
                                                    <img src="<?php echo $this->user->pic($user->id,'normal')?>" id='user_pic' class="relative" style='width:100px;height:100px;margin-bottom:10px;top:70px;'> 
                                                <?endif;?>
                                            </div>
                                            <button id="edit_btn" onclick="do_submit('user_pic_form')" class="btn btn-default btn-lg green m-t-20">确定</button>
                                        </div>
                                        <div class="col-md-4">
                                             <h4>效果预览</h4>
                                             <p>上传的图片会自动生成尺寸</p>
                                             <div id="pic_review" class="padding:10px;">
                                                <div class="m-b-10">
                                                    <?if(isset($user)&&$user->id>0):?>
                                                    <img id="img_100" style="width:100px;height:100px" class="m-t-10 m-b-10" src="<?php echo $this->user->pic($user->id,'normal')?>" />
                                                    <?endif;?>
                                                    <p>100*100像素</p>
                                                </div>
                                                <div class="m-b-10">
                                                    <?if(isset($user)&&$user->id>0):?>
                                                    <img id="img_50" style="width:50px;height:50px" class="m-t-10 m-b-10" src="<?php echo $this->user->pic($user->id,'small')?>" />
                                                    <?endif;?>
                                                    <p>50*50像素</p>
                                                </div>
                                             </div>
                                        </div>
                                      </div>
                                    <input type='hidden' id='user_pic_path' name='user_pic_path' value=''>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 账户信息结束 -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
<!-- The main application script -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?php echo base_url();?>assets/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js" type="text/javascript"></script>
<![endif]-->
<!-- BEGIN:File Upload Plugin JS files-->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload fade">
            <td>
                <span class="preview"></span>
            </td>
            <td>
                <p class="name">{%=file.name%}</p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <p class="size">{%=o.formatFileSize(file.size)%}</p>
                {% if (!o.files.error) { %}
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                {% } %}
            </td>
            <td>
                {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                    <button class="btn blue start">
                        <i class="fa fa-upload"></i>
                        <span>Start</span>
                    </button>
                {% } %}
                {% if (!i) { %}
                    <button class="btn red cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn red delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="fa fa-trash-o"></i>
                        <span>Delete</span>
                    </button>
                {% } else { %}
                    <button class="btn yellow cancel">
                        <i class="fa fa-ban"></i>
                        <span>Cancel</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>

<div class='container m-b-20' id='ad-footer'>
    <div class='row'>
        <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>