<script type="text/javascript">
	function change_status(id,status)
	{
		if(parseInt(status) == 1)
			status = 0;
		else
			status = 1;
		$.ajax({
	        url:msg.base_url+"admin/questionnaires/change_status/"+id+"/"+status,
	        type:'post',
	        dataType:'json',
	        success:function(json){
	            if(json.code=='1000')
	            {
	                 show_success(json.msg);
	                 location.href=msg.base_url+"admin/questionnaires";
	            }
	            else if(json.code=='1002')
	            {
	                show_login();
	            }
	            else
	            {
	                show_error(json.msg);
	            }
	        }
	    });
	}
</script>
<table class="table table-striped table-bordered table-hover" id="questionnaire_list">
	<thead>
		<tr>
			<th>标题</th>
			<th>答题人数</th>
			<th class="hidden-xs">创建时间</th>
			<th class="hidden-xs">创建人</th>
			<th>状态</th>
			<th class="hidden-xs">操作</th>
		</tr>
	</thead>
	<tbody>
		<?if(!empty($list)):?>
		<?foreach($list as $key => $item):?>
		<tr id='<?php echo $item->id;?>'>
    		<td><?php echo $item->title?></td>
    		<td><?php echo $item->record?></td>
    		<td class="hidden-xs"><?php echo date('Y-m-d',$item->create_time)?></td>
    		<td class="hidden-xs"><?php echo $item->creator?></td>
    		<td style='text-align:center'>
                <a id='status_<?php echo $item->id ;?>' class="btn btn-xs <?php echo $item->status == 1 ? 'green' : 'red';?>" href='javascript:;' onclick="change_status(<?php echo $item->id ;?>,<?php echo $item->status;?>)">
                    <i class="fa <?php echo $item->status == 1 ? 'fa-check' : 'fa-ban';?>"></i>
                </a>
            </td>
			<td class="hidden-xs">
				<a href="<?php echo base_url();?>admin/questionnaires/edit/<?php echo $item->id?>">
					<span class='label label-warning'><i class='fa fa-edit'></i></span></a> 
				<a href="javascript:void(0)" onclick="doDelete('admin/questionnaires/delete/'+<?php echo $item->id?>)">
					<span class='label label-danger'><i class='fa fa-times'></i></span></a>
				<a href="<?php echo base_url();?>admin/questionnaires/result/<?php echo $item->id?>">
					<span class='label label-info'><i class='fa fa-bar-chart-o'></i></span></a>
			</td>
		</tr>
		<?endforeach;?>
		<?endif;?>
	</tbody>
</table>