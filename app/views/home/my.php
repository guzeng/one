<?$RTR =& load_class('Router', 'core');?>
<?$controller_name=$RTR->fetch_class();$method_name=$RTR->fetch_method();?>
<div class='col-lg-2 col-md-3 col-sm-3 col-xs-12 col-no-padding my-left-menu'>         
  <div class="page-sidebar nav-collapse">
    <ul class="nav">
        <li class="head">订单中心</li>
        <li <?if($controller_name=='orders' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>orders">我的订单</a></li>
        <li <?if($controller_name=='evaluation' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>evaluation">评价管理</a></li>
        <li <?if($controller_name=='history' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>history">浏览历史</a></li>
        <li <?if($controller_name=='mailsubs' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>mailsubs">邮件订阅</a></li>  
        <li <?if($controller_name=='myintegral' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>myintegral">我的积分</a></li>
        <li class="head">账户中心</li>
        <li <?if($controller_name=='users' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>users">账户信息</a></li>
        <li <?if($controller_name=='users' && $method_name=='safe'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>users/safe">账户安全</a></li>
        <li <?if($controller_name=='users' && $method_name=='money'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>users/money">账户余额</a></li>
        <li <?if($controller_name=='users' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>users/consume">消费记录</a></li>
        <li <?if($controller_name=='user_coupons' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>user_coupons">优惠券</a></li>
        <li <?if($controller_name=='address' && $method_name=='index'):?>class="active"<?endif?> ><a href="<?php echo base_url().'home/';?>address">收货地址</a></li>                  
    </ul>
  </div>
</div>