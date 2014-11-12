<?$this->load->view('home/header')?>
<div class="main">
    <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row m-b-50">
          <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <div class="content-page">
                    <!-- BEGIN LEFT SIDEBAR -->  
                    <div class="row m-t-50">          
                        <div class="col-md-12 p-l-30 p-r-30">
                            <h2 class='text-center'>
                                <?php if($msg=='success'):?>
                                支付成功
                                <?php else:?>
                                支付失败
                                <?php endif;?>
                            </h2>
                        </div>
                    </div>
                    <hr>
                    <div class="row">          
                        <div class="col-md-12 p-l-30 p-r-30 text-center">
                            <a href="<?php echo base_url().'home/orders'?>">我的订单</a> &nbsp; 
                            <a href="<?php echo base_url()?>">继续购物</a>
                        </div>
                    </div>
                    <hr>

                    <!-- END LEFT SIDEBAR -->
                </div>
            </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
<?$this->load->view('home/footer')?>
