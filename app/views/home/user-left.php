<?$RTR =& load_class('Router', 'core');?>
<?$controller_name=$RTR->fetch_class();$method_name=$RTR->fetch_method();?>
<div id="left-side">
     <ul class="ver-inline-menu tabbable margin-bottom-25">
     	<li style="padding:10px;"><strong> 订单中心</strong></li>
        <li><a data-toggle="tab" href="#tab_1-2"> 我的订单</a></li>
        <li><a data-toggle="tab" href="#tab_1-2"> 我的积分</a></li>
        <li style="padding:10px;"><strong> 账户中心</strong></li>
        <li <?if($controller_name=='users' && $method_name=='index'):?>class="active"<?endif?>><a href="<?php echo base_url().'users/index/'.$this->auth->user_id();?>"> 账户信息</a></li>
        <li <?if($controller_name=='users' && $method_name=='safe'):?>class="active"<?endif?>><a href="<?php echo base_url().'users/safe/'.$this->auth->user_id();?>">账户安全</a></li>
        <li <?if($controller_name=='users' && $method_name=='money'):?>class="active"<?endif?>><a href="<?php echo base_url().'users/money/'.$this->auth->user_id();?>">账户余额</a></li>
        <li <?if($controller_name=='address' && $method_name=='index'):?>class="active"<?endif?>><a href="<?php echo base_url().'address/index/'.$this->auth->user_id();?>">收货地址</a></li>
    </ul>
</div>