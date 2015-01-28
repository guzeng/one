<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author Han
	 * 2013/3/25  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('role');
        $this->list_type = '';
        if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
            $this->auth->check_login_json();
            if(!$this->auth->is_super_admin())
            {
                echo "你不是系统默认管理员";
                exit;
            }
        } else {
            $this->auth->check_login();
            if(!$this->auth->is_super_admin())
            {
                echo json_encode(array(
                    'code' => '1004',
                    'msg' => "你不是系统默认管理员"
                ));  
            }
        }
    }
    //-------------------------------------------------------------------------

	public function index()
    {
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/role/list',$data);
    }
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->role->all(array('orderby' =>'id asc'));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/role/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/role/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

	public function update()
	{
		$data = array('code' => '1000', 'msg' => '');
		$id = trim($this->input->post('roleId',TRUE));
		$name = trim($this->input->post('name',TRUE));
		if($id)
        {
            $row = $this->role->get($id);
            if(!$this->auth->is_super_admin())
            {
                echo json_encode(array('code'=>'1010', 'msg'=>"你不是系统默认管理员"));
                exit;
            }
        }
		//表单验证
		$this->load->library('form_validation');
        $error = array();
        if(!$this->form_validation->required($name))
        {
            if($id)
            {
                $error[$id.'-name-edit'] = "必须输入";
            }
            else
            {
                $error['add_role_name'] =  "必须输入";
            }
        }

		if(!empty($error))
		{
			$data['error'] = $error;
			$data['code'] = '1010';
            $data['msg'] = $error;
			echo json_encode($data);                                    
			exit;
		}	     
	 	else
		{	
            //检测名称是否重复
            if($id)
            {
                $where = array('name'=>$name,'id != '=>$id);
                $_res = $this->role->fetch_items(array('type'=>'count(id) as count', 'num'=>1, 'where'=>$where));
                if($_res[0]->count > 0)
                {
                    echo json_encode(array('code'=>'1010', 'msg'=>"已经存在此角色名",'error'=>array($id.'-name-edit'=>true)));
                    exit;
                }
            }
            else
            {
                $where = array('name'=>$name);
                $_res = $this->role->fetch_items(array('type'=>'count(id) as count', 'num'=>1, 'where'=>$where));
                if($_res[0]->count > 0)
                {
                    echo json_encode(array('code'=>'1010', 'msg'=>"已经存在此角色名",'error'=>array('add_role_name'=>true)));
                    exit;
                }
            }

			$param = array(
				'name' => $name
			);
			if(isset($id)&& !empty($id))
			{
				if(!$this->role->update($param,$id))
				{
					$data['code'] = '1010';
					$data['msg'] = $this->lang->line('update_failed');
				}
                $data['id'] = $id;
			}
			else 
			{
				if(!$id = $this->role->insert($param))
				{
					$data['code'] = '1010';
					$data['msg'] = $this->lang->line('add_failed');
				}
                $data['id'] = $id;
                // $this->load->model('permission');
                // $this->load->model('role_permission');
                // $all_permission = $this->permission->get_all();
                // if(!empty($all_permission))
                // {
                //     $_pre = array();
                //     foreach ($all_permission as $key => $value) {
                //         if(isset($value['default']) && $value['default'])
                //         {
                //             if(!empty($value['pre']))
                //             {
                //                 foreach ($value['pre'] as $k => $_p_id) {
                //                     if(!in_array($_p_id, $_pre))
                //                     {
                //                         $this->role_permission->insert(array('role_id'=>$id,'permission_id'=>$_p_id));
                //                         $_pre[] = $_p_id;
                //                     }
                //                 }
                //             }
                //             $this->role_permission->insert(array('role_id'=>$id,'permission_id'=>$value['id']));
                //         }
                //     }
                // }
                // if($this->auth->has_permission('admin', 'roles', 'permissions'))
                // {
                    $data['set_permission'] = true;
                // }
                // if($this->auth->has_permission('admin', 'roles', 'update'))
                // {
                    $data['can_edit'] = true;
                // }
                // if($this->auth->has_permission('admin', 'roles', 'delete'))
                // {
                    $data['can_delete'] = true;
                // }
			}
		}
        $data['name'] = $name;
		echo json_encode($data);                                    
		exit;
	}
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $id = trim($id); 
		$d = array();
		$data = array(
	    	'code' => '1000'
		); 	
        if($id )
        {
            $role = $this->role->get($id);
            if($role)
	        {
                if(!$this->auth->is_super_admin())
                {
                    $data['code'] = '1010';
                    $data['msg']  = "你不是系统默认管理员";
                }
                else
                {
                    $data['name'] = $role->name;
                }
	        }
	        else
	        {
	            $data = array(
	                'code' => '1001',
	                'msg' => "不存在这个记录"
	            );
	        }
        }
        echo json_encode($data);
        exit;
    }
    //-------------------------------------------------------------------------

    public function delete($id)
    {
        // $this->auth->check_login_json();
        // $this->auth->check_permission_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1004','msg'=>$this->lang->line('param_incorrect')));
            exit;
        }
        $this->load->model('role_permission');
        $row = $this->role->get($id);
        if(!$row)
        {
            echo json_encode(array('code'=>'1005','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
        // if($row->is_default == 10)
        // {
        //     echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('cannot_delete_admin_role')));
        //     exit;
        // }
        if($this->role->delete($id))
        {
            echo json_encode(array('code'=>'1000','data'=>array('id'=>$id)));
        }
        else
        {
            echo json_encode(array('code'=>'1001', 'msg'=>$this->lang->line('delete_failed')));
        }
        exit;
    }

    //-------------------------------------------------------------------------

	public function permission($roleId)
    {
        if(!$roleId)
        {
            echo json_encode(array('code'=>'1004','msg'=>$this->lang->line('param_incorrect')));
            exit;
        }
        $row = $this->role->get($roleId);
        if(!$this->auth->is_super_admin())
        {
            echo json_encode(array('code'=>'1010', 'msg'=>"你不是系统默认管理员"));
            exit;
        }

        $d = array();
        $this->load->model('role_permission');

        $has_permission = $this->role_permission->fetch_items(array('where'=>array('role_id'=>$roleId)));
        $all_permission = $this->auth->allPermission();

        $_has = $_no = $has_id = array();
        if(!empty($has_permission))
        {
            foreach ($has_permission as $k => $v) {
                if(isset($all_permission[$v->permission_id]) && $all_permission[$v->permission_id]['show'])
                {
                    $cate = $all_permission[$v->permission_id]['cate'];
                    if(isset($_has[$cate]))
                    {
                        $_has[$cate][] = (object)$all_permission[$v->permission_id];
                    }
                    else
                    {
                        $_has[$cate] = array((object)$all_permission[$v->permission_id]);
                    }
                    $has_id[] = $v->permission_id;
                }
            }
        }
        if(!empty($all_permission))
        {
            foreach ($all_permission as $key => $value) {
                if(!in_array($key, $has_id) && $value['show'])
                {
                    $cate = $value['cate'];
                    if(isset($_no[$cate]))
                    {
                        $_no[$cate][] = (object)$value;
                    }
                    else
                    {
                        $_no[$cate] = array((object)$value);
                    }
                }
            }
        }
        $d['has_lists'] = $_has;
        $d['no_lists'] = $_no;
        $d['roleId'] = $roleId;
        $data['code'] = '1000';
        $data['data'] = $this->load->view('admin/role/role-permission', $d, true);
        echo json_encode($data);
        exit;
    }

    /**
     * 添加、删除角色权限
     * @param int roleId
     * @param int permissionId
     * @author varson
     * @2014/03/11
     */
    public function set_permission()
    {
        $roleId = $this->input->post('roleId',true);
        $permissionId = $this->input->post('permissionId', true);
        $type = $this->input->post('type', true);
        if(!$roleId || !$permissionId || !$type)
        {
            echo json_encode(array('code'=>'1004','msg'=>$this->lang->line('param_incorrect')));
            exit;
        }
        $this->load->model('role_permission');

        $_role = $this->role->get($roleId);
        if(!$_role)
        {
            echo json_encode(array('code'=>'1010','msg'=>"角色不存在"));
            exit;
        }
        if(!$this->auth->is_super_admin())
        {
            echo json_encode(array('code'=>'1010', 'msg'=>$this->lang->line('permission_denied')));
            exit;
        }
        $_map = $this->role_permission->map($roleId, $permissionId);
        if($type == 'add' && $_map)
        {
            echo json_encode(array('code'=>'1010','msg'=>"已经拥有该权限"));
            exit;
        }
        if($type == 'del' && !$_map)
        {
            echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
        $all_permission = $this->auth->allPermission();
        if(!isset($all_permission[$permissionId]))
        {
            echo json_encode(array('code'=>'1010','msg'=>"权限不存在"));
            exit;
        }
        $_permission = $all_permission[$permissionId];
        switch ($type) {
            case 'add':
                $also_add = $_permission['pre'];                            //拥有该权限前需有的权限了（前置权限）
                if(!empty($also_add))
                {
                    foreach ($also_add as $k => $_id) {
                        $_exists = $this->role_permission->map($roleId,$_id);
                        if(!$_exists)
                        {
                            if($this->role_permission->insert(array('role_id'=>$roleId, 'permission_id'=>$_id)))
                            {
                                $_p = $all_permission[$_id];
                                if($_p['show'])
                                {
                                    $also_add[] = array('cate'=>$_p['cate'],'id'=>$_id,'title'=>$_p['code']);
                                }
                            }
                        }
                    }                        
                }
                $_res = $this->role_permission->insert(array('role_id'=>$roleId, 'permission_id'=>$permissionId));
                break;
            case 'del':
                if($_permission['controller']=='roles' )
                {
                    echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('cannot_delete_permission')));
                    exit;
                }
                $pre = $_permission['pre'];
                $others = array();

                if(!empty($pre))
                {
                    foreach($pre as $id)
                    {
                        $others[$id] = array();
                        if(!empty($all_permission))
                        {
                            foreach ($all_permission as $key => $value) {
                                if($key != $_permission['id'] && in_array($id, $value['pre']))
                                {
                                    $others[$id][] = $value;
                                }
                            }                    
                        }
                    }
                }

                if(!empty($others))
                {
                    foreach ($others as $key => $items) 
                    {
                        $_c_d = true;
                        if(empty($items))
                        {
                            $_c_d = true;
                        }
                        else
                        {
                            foreach ($items as $k => $v) //循环其它的权限，若已无共同无级连的权限，则将级连权限删除
                            {
                                $other_map = $this->role_permission->map($roleId, $v['id']);
                                if($other_map)
                                {
                                    $_c_d = false;
                                    break;
                                }
                            }
                        }
                        if($_c_d)
                        {
                            $this->role_permission->delete_by_role_permission($roleId, $key);
                        }
                    }
                }
                $_res = $this->role_permission->delete($_map->id);
                break;
        }
        if($_res)
        {
            $data = array('code'=>'1000','cate'=>$_permission['cate'],'title'=>$_permission['code']);
            if(isset($also_add) && !empty($also_add))
            {
                $data['also_add'] = $also_add;
            }
        }
        else
        {
            $data = array('code'=>'1001', 'msg'=>$this->lang->line('update_failed'));
        }
        echo json_encode($data);
        exit;
    }

    //查询所有角色
    public function all_role()
    {
        $data = array('code' => '1000', 'msg' => '');
        $list = $this->role->all(array('orderby' =>'id asc'));
        $post = $this->input->post();
        if(!empty($post))
        {
            $this->load->model('user');
            $user = $this->user->get($post['id']);
            if($user &&$user->role_id && $list)
            {
                foreach ($list as $key => $item) {
                    if($item->id == $user->role_id)
                    {
                        $list[$key]->check = true;
                    }
                }
            }
        }
        
        if(!$list)
        {
            $data['code'] = "1004";
            $data['msg'] = '需要添加角色,才能分配角色';
        }
        else
        {
            $data['list'] = $list;
        }
        echo json_encode($data);
    }
    //分配角色给用户
    public function assign_role()
    {
        $data = array('code' => '1000', 'msg' => '分配成功');
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        
        if(!isset($post['role_id']) || !$post['role_id'])
        {
            echo json_encode(array('code'=>'1010','msg'=>"请选择角色选项"));
            exit;
        }

        if(!isset($post['user_id']) || !$post['user_id'])
        {
            echo json_encode(array('code'=>'1010','msg'=>"用户不存在"));
            exit;
        }
        
        $this->load->model('user');       
        if(!$this->user->assign_role($post['user_id'],$post['role_id']))
        {
            $data = array('code'=>'1001','msg'=>"分配失败");
        }
        
        echo json_encode($data);
    }
}
/* End of file roles.php */
/* Location: ./lms_app/controllers/admin/role.php */