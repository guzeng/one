<?$this->load->view('home/header')?>
<script type="text/javascript">
    $("document").ready(function(){
        
    });  
    function show_pingjia($id)
    {
        if($("#tr_pingjia_"+$id).length>0){
           $("#tr_pingjia_"+$id).toggle();
        }
    }  
</script>
<div class='container m-t-20'>
    <div class='row' id="evaluation">
        <!-- left -->
        <?$this->load->view('home/my')?>
        <!-- left end -->
        <!-- right -->
        <div class='col-lg-10 col-md-9 col-sm-9 col-xs-12'>
            <ul class="nav nav-tabs">
                <li class="">
                    <h4>商品评价</h4>
                </li>

                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        更多筛选条件 <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu " role="menu">
                        <li>
                            <a href="#overview_4" tabindex="-1" data-toggle="tab">123</a>
                        </li>
                        <li>
                            <a href="#overview_4" tabindex="-1" data-toggle="tab">123456</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <th width="">商品信息</th>
                            <th width="30%">购买时间</th>
                            <th width="20%">评价</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?if(!empty($list)):?>
                        <?foreach($list as $key => $value):?>
                        <tr id="tr_<?php echo $value->id;?>">
                            <td >
                                <div class="text-left">
                                    <span class="select-item">
                                        <a target="_bank" href="<?php echo base_url()."item/id/".$value->product_id?>">
                                            <img width="150" height="100" src="<?php echo $this->product->pic($value->product_id);?>">
                                            <?php echo $value->name;?>
                                        </a>
                                    </span>
                                </div>
                            </td>
                            <td><?php echo date('Y-m-d',$value->create_time);?></td>
                            <td>
                                <a herf="javascript:void(0)" onclick="show_pingjia(<?php echo $value->id;?>)">发表评价</a>
                            </td>
                        </tr>
                        <tr id="tr_pingjia_<?php echo $value->id;?>" class="hide">
                            <td colspan="3" class="tdorder text-left">

                                <div class="message">
                                    <span class="arrow"></span>
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-1 control-label">评分</label>
                                                <div class="col-md-7">

                                                    <ul class="stars list-inline">
                                                        <li class="select"> <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star"></i>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-star-empty"></i>
                                                        </li>
                                                    </ul>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-1 control-label">评语</label>
                                                <div class="col-md-7">
                                                    <textarea class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-md-7">
                                                    <button type="submit" class="btn green">确认</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?endforeach;?>
                        <?endif;?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <!-- paginition start -->
                        <?if(isset($pagination)):?>
                        <div class="pagination pagination-right padding-right-20 pull-right">
                        <?=isset($pagination)?$pagination:''?>
                        </div>
                        <?endif;?>
                        <!-- paginition end -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
    <?$this->load->view('home/footer')?>