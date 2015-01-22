
<table class="table table-striped table-bordered table-hover table-full-width" id="">
    <thead>
        <tr>
            <th width='*'>&nbsp;角色名</th>
            <th class='hidden-xs col-sm-3 col-lg-2'>操作</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($list)):?>
            <?php foreach ($list as $key => $item):?>
                <tr id="<?php echo $item->id ?>" class='form-inline'>
                    <td>&nbsp;<span id='<?php echo $item->id?>-name-span'><?php echo $item->name ?></span></td>
                    <td class='hidden-xs'>
                        <?//if(User::hasPermission('Admin', 'RoleController', 'getPermission')):?>
                            <a href='javascript:void(0)' onclick="showPermissions('<?php echo $item->id;?>')" title="设置权限" class='btn btn-xs yellow btn-editable'><i class="fa fa-cogs"></i></a>  
                        <?//endif;?>
                        <?//if(User::hasPermission('Admin', 'RoleController', 'postUpdate')):?>
                            <a href='javascript:void(0)' onclick="editRole(<?php echo $item->id ?>)" title="更新" class='btn btn-xs blue btn-editable'><i class="fa fa-pencil"></i></a> 
                        <?//endif;?>
                        <?//if(User::hasPermission('Admin', 'RoleController', 'postDelete')):?>
                            <a href='javascript:void(0)' onclick="deleteRole(<?php echo $item->id ?>)" title="删除" class="btn btn-xs red btn-removable"><i class="fa fa-times"></i></a>
                        <?//endif;?>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
        <tr id="add_new" class='form-inline'>
            <td colspan='2'>
                <?//if(User::hasPermission('Admin','RoleController','postUpdate')):?>
                    <a class="btn" href="javascript:void(0)" onclick="addRole()"><i class="fa fa-plus"></i> 添加角色</a>
                <?//endif;?>
            </td>
        </tr>
    </tbody>
</table>