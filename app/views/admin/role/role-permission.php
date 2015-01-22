<!-- 内容开始 --> 
<div class='detail text-left hide'>
    <div class='bg-white p-20'>
        <div class='row'>
            <div class='col-md-6 '>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Lang::get('text._has_permission')?></h3>
                    </div>
                    <div class="panel-body" id='<?php echo $roleId;?>-has-permission'>
                        <?if(!empty($has_lists)):?>
                        <?foreach ($has_lists as $key => $items) :?>
                            <div class='margin-b-10'><b><?php echo Lang::get('text.role-title-'.$key);?> : </b></div>
                            <div id='has-permission-<?php echo $key;?>'>
                                <?if(!empty($items)):?>
                                    <?foreach ($items as $k => $item):?>
                                    <div class='role-h-item' id='<?php echo $roleId?>-<?php echo $item->id?>'>
                                        <span id='<?php echo $roleId?>-<?php echo $item->id?>-name' class='float-left'><?php echo Lang::get('text.'.$item->code)?></span> 
                                        <?if(User::hasPermission('Admin','RoleController','postSetPermission')):?>
                                        <span class='role-icon' onclick="delPermission('<?php echo $roleId?>','<?php echo $item->id?>')"><i class="fa fa-times hand" style='display:none'></i></span>
                                        <?endif;?>
                                    </div>
                                    <?endforeach;?>
                                <?endif;?>
                            </div>
                            <div class='clearfix m-b-10'></div>
                        <?endforeach;?>
                        <?endif;?>
                    </div>
                </div>
            </div>
            <div class='col-md-6 '>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Lang::get('text._no_permission')?></h3>
                    </div>
                    <div class="panel-body" id='<?php echo $roleId;?>-no-permission'>
                        <?if(!empty($no_lists)):?>
                        <?foreach ($no_lists as $key => $items) :?>
                            <div class='margin-b-10'><b><?php echo Lang::get('text.role-title-'.$key);?> : </b></div>
                            <div id='no-permission-<?php echo $key;?>'>
                                <?if(!empty($items)):?>
                                    <?foreach ($items as $k => $item):?>
                                    <div class='role-h-item' id='<?php echo $roleId?>-<?php echo $item->id?>'>
                                        <span id='<?php echo $roleId?>-<?php echo $item->id?>-name' class='float-left'><?php echo Lang::get('text.'.$item->code)?></span> 
                                        <?if(User::hasPermission('Admin','RoleController','postSetPermission')):?>
                                        <span class='role-icon' onclick="addPermission('<?php echo $roleId?>','<?php echo $item->id?>')"><i class="fa fa-plus hand" style='display:none'></i></span>
                                        <?endif;?>
                                    </div>
                                    <?endforeach;?>
                                <?endif;?>
                            </div>
                            <div class='clearfix m-b-10'></div>
                        <?endforeach;?>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 内容结束 -->
<script type="text/javascript">

</script>