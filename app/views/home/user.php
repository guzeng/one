<?$this->load->view('home/header')?>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.form.js" type="text/javascript"></script>
    <div class='container m-b-20 m-t-20' >
        <div class='row'>
            <div class="col-lg-2 col-md-2" style="padding:0px;">
            	 <ul class="ver-inline-menu tabbable margin-bottom-25">
					<li class="active"><a data-toggle="tab" href="#tab_3"><i class="fa fa-user"></i> 账户信息</a></li>
					<li><a data-toggle="tab" href="#tab_1"><i class="fa fa-info-circle"></i> 账户安全</a></li>
					<li><a data-toggle="tab" href="#tab_2"><i class="fa fa-tint"></i> 账户余额</a></li>
					<li><a data-toggle="tab" href="#tab_3"><i class="fa fa-leaf"></i> 收货地址</a></li>
				</ul>
            </div>
            <div class="col-lg-10 col-md-10">
            	<?php echo $user;?>
            </div>
        </div>
    </div>
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2013 &copy; Zeng.
        </div>
        <div class="footer-tools">
            <span class="go-top">
            <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->

</body>
<!-- END BODY -->
</html>