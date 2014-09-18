<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").eq(0).css("overflow-y","scroll");
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
                        <div id="tab_1-4" class="tab-pane active">
                            <div class="o-mt">
                                <h2>收货地址</h2>
                            </div>
                            <div id="addressList" class="b">
                                <div class="address-top bg-c-f5 p-b-10 b-b">
                                    <h3 class="pull-left p-l-5" style="margin:0px;">收货人-**区</h3>
                                    <div class="pull-right"><a class="btn btn-default btn-success m-r-20">bianji</a><a class="btn btn-default btn-danger">del</a></div>
                                </div>
                                <div class="address-body p-10">
                                    <div class="item-lcol m-l-25">
                                        <div class="item">
                                            <span class="pull-left">收货人：</span>
                                            <div class="pull-left">
                                                Alex
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">所在地区：</span>
                                            <div class="pull-left">
                                                广东珠海市香洲区拱北区
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">地址：</span>
                                            <div class="pull-left">
                                                地址
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">手机：</span>
                                            <div class="pull-left">
                                                159999999999
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">固定电话：</span>
                                            <div class="pull-left">
                                                
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">电子邮箱：</span>
                                            <div class="pull-left">
                                                
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="address-foot">
                                <a href="javascript:;" data-toggle="modal" data-target="#myModal">新增收货地址</a>
                                <span class="ftx-03">您已创建<span class="ftx-02" id="addressNum_botton">3 </span>个收货地址，最多可创建<span class="ftx-02">20</span>个</span>
                            </div>
                        </div>
                        <!-- 账户地址结束 -->
                    </div>
                    <!-- Modal start -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">编辑收货地址</h4>
                          </div>
                          <div class="modal-body">
                                <div class="portlet-body form">
                                    <form action="<?php echo base_url()?>admin/users/update_address" method="post" onsubmit='return false' role="form" id='user-form' class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>收货人：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <input type="text" id="consignee" name="consignee" maxlength="30" class="form-control">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2 col-xs-2 m-r-20">性别：</label>
                                                <div class="radio-list col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="0" checked> 男士
                                                    </label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="1" > 女士
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>手机号码：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <input type="text" id="phone" name="phone" maxlength="30" class="form-control">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2">固定电话：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <input type="text" id="telephone" name="telephone" maxlength="30" class="form-control">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>地区：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <select class="form-control input-small inline">
                                                        <option>Option 1</option>
                                                    </select>
                                                    <select class="form-control input-small inline">
                                                        <option>Option 1</option>
                                                    </select>
                                                    <select class="form-control input-small inline">
                                                        <option>Option 1</option>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>地址：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <input type="text" id="address" name="address" maxlength="50" class="form-control">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-2"><span class="req">*</span>默认地址：</label>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-9">
                                                    <input type="text" id="default" name="default" maxlength="50" class="form-control">
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary">保存</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal end -->
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