<?$this->load->view('home/header')?>
<div class='container m-t-20' id="mycart">
  <div class='row'>
    <!-- left -->
    <!-- left end -->
    <!-- right -->
    <div class='col-lg-12 col-md-9 col-sm-9 col-xs-12'>
      <div class="order-tab">
        <h5 class="page-title">
					我的购物车
				</h5>
        <div id="myTabContent" class="tab-content">
            <?php if(!empty($list)):?>
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                      	<th width="130">
                            <input value="option1" id="inlineCheckbox1" type="checkbox" title='全选'>
                        </th>
                        <th>商品</th>
                        <th width="150">价格</th>
                        <th width="120">优惠</th>
                        <th width="150">数量</th>
                        <th width="150">操作</th>  
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach ($list as $key => $value) :?>
                    <tr id='cart_row_<?php echo $value['product_id']?>'>
                        <td><span><input value="option1" id="inlineCheckbox1" type="checkbox"></span></td> 
                        <td><?php echo $value['name']?></td> 
                        <td><?php echo $value['price']?></td>
                        <td><?php echo $value['best_price']?></td> 
                        <td><?php echo $value['count']?></td> 
                        <td>
                            <button class='btn red btn-xs' onclick="confirm_dialog('<?php echo $this->lang->line('delete_confirm')?>', '<?php echo $this->lang->line('sure_to_delete')?>', delCart, '<?php echo $value['product_id']?>')">
                                <i class='fa fa-trash-o'></i>
                            </button>
                        </td> 
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table> 
            <?php else:?>
                <p style="text-align:center;padding:50px 0;">购物车为空，继续购买商品 <a href="<?php echo base_url();?>">商城首页</a></p>
            <?php endif;?>
           
        
          <div class="tab-pane fade" id="profile"></div>
          <div class="tab-pane fade" id="dropdown1"></div>
          
        </div>
      </div>

    </div>
    <!-- right end --> </div>
</div>

<div class='container m-b-20' id='ad-footer'>
  <div class=''>
    <img class='img-responsive' src='<?php echo base_url()?>assets/img/home/ad-footer.png'></div>
</div>
<?$this->load->view('home/footer')?>