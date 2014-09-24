<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").eq(0).css("overflow-y","scroll");
         //地区
        $("#province").change(function(){
            areaChange($("#province"),2);
        });
        $("#city").change(function(){
            areaChange($("#city"),3);
        });
    });
</script>
    <div class='container m-b-20 m-t-20'>
        <div class='row'>
            <div class="col-lg-2 col-md-2" style="padding:0px;">
                <?$this->load->view('home/user-left')?>
            </div>
            <div class="col-lg-10 col-md-10">
                <div id="main">
                    <div class="tab-content">
                        <!-- 账户地址 -->
                        <div id="tab_address" class="tab-pane active">
                            <div class="o-mt">
                                <h2>收货地址</h2>
                            </div>
                            <div class="b">
                                <form action="<?php echo base_url()?>address/update" method="post" onsubmit='return false' role="form" id='address_form' class="form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>收货人：</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <input type="text" id="consignee" name="consignee" maxlength="30" class="form-control" value="<?php echo isset($row)?$row->consignee:''?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2 col-xs-2 m-r-20">性别：</label>
                                            <div class="radio-list col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <label class="radio-inline">
                                                <input type="radio" name="gender" id="gender" value="1" <?php if(isset($row) && $row->gender == 1):?>checked<?endif;?> <?php if(!isset($row)):?>checked<?endif;?> /> 男士
                                                </label>
                                                <label class="radio-inline">
                                                <input type="radio" name="gender" id="gender" value="2" <?php if(isset($row) && $row->gender == 2):?>checked<?endif;?> /> 女士
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>手机号码：</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <input type="text" id="phone" name="phone" maxlength="30" class="form-control" value="<?php echo isset($row)?$row->phone:''?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>固定电话：</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <input type="text" id="telephone" name="telephone" maxlength="30" class="form-control" value="<?php echo isset($row)?$row->telephone:''?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>地区：</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <?php if(isset($row->area)&&$row->area):?>
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
                                                        <option value="-1">请选择</option>
                                                        <?php foreach($area['qu_list'] as $key => $item):?>
                                                        <option <?php echo $item->area_id == $area['qu']->area_id?'selected':'';?> <?php $row->area==$item->area_id?'selected':'';?>value="<?php echo $item->area_id;?>"><?php echo $item->area_name;?></option>
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
                                                        <option value="-1">请选择</option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                <?endif;?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>地址：</label>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                <input type="text" id="address" name="address" maxlength="50" class="form-control" value="<?php echo isset($row)?$row->address:''?>" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-7">
                                              <div class="checkbox">
                                                <label>
                                                  <input type="checkbox" id="default" name="default" <?php if(isset($row) && $row->default):?>checked<?endif;?> /> 默认地址
                                                </label>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"></label>
                                        <div class="col-lg-4 col-md-5 col-sm-7 col-xs-9">
                                            <button id='address_submit_btn' type="button" onclick="do_submit('address_form')" class="btn btn-block green">保存</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo isset($row)?$row->id:''?>"/>
                                </form>
                            </div>
                        </div>
                        <!-- 账户地址结束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN FOOTER -->
    <!-- <div class="footer">
        <div class="footer-inner">
            2013 &copy; Zeng.
        </div>
        <div class="footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div> -->
    <!-- END FOOTER -->

</body>
<!-- END BODY -->
</html>