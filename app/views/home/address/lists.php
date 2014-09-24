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
                            <?php if(isset($address) && !empty($address)):?>
                                <? foreach($address as $key=>$item):?>
                            <div id="address_<?php echo $item->id;?>" class="b m-b-20">
                                <div class="address-top bg-c-f5 p-b-10 b-b">
                                    <h3 class="pull-left p-l-5" style="margin:0px;"><?php echo $item->consignee;?><?php echo (isset($item->area_name))?'_'.$item->area_name:''?></h3>
                                    <div class="pull-right">
                                        <a class="m-r-20" href="<?php echo base_url().'address/edit/'.$item->id;?>">编辑</a>
                                        <a href="javascript:void(0)" onclick="doDelete('address/delete/<?php echo $item->id?>')">删除</a>
                                    </div>
                                </div>
                                <div class="address-body p-10">
                                    <div class="item-lcol m-l-25">
                                        <div class="item">
                                            <span class="pull-left">收货人：</span>
                                            <div class="pull-left">
                                                <?php echo $item->consignee;?>
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
                                                <?php echo $item->address;?>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">手机：</span>
                                            <div class="pull-left">
                                                <?php echo $item->phone;?>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="item">
                                            <span class="pull-left">固定电话：</span>
                                            <div class="pull-left">
                                                <?php echo $item->telephone;?>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <!-- <div class="item">
                                            <span class="pull-left">电子邮箱：</span>
                                            <div class="pull-left">
                                                <?php echo $item->email;?>
                                            </div>
                                            <div class="clear"></div>
                                        </div> -->
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                                <?endforeach;?>
                            <?endif;?>
                            <div class="address-foot">
                                <a href="<?php echo base_url();?>address/edit">新增收货地址</a>
                                <span class="ftx-03">您已创建<span class="ftx-02" id="addressNum_botton"><?php echo (isset($address) && !empty($address) ? count($address):0);?></span>个收货地址，最多可创建<span class="ftx-02">20</span>个</span>
                            </div>
                        </div>
                        <!-- 账户地址结束 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN FOOTER -->
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
        <div class="modal fade" id="_confirm_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title" id='_dialog_title'>title</h4>
                    </div>
                    <div class="modal-body" id='_dialog_body'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue" id='_confirm_btn'>确定</button>
                        <button type="button" class="btn default" data-dismiss="modal">取消</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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