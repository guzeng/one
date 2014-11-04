<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

    /**
     * 展示用户基本信息
     * 
     */
	public function index()
	{
        $this->auth->check_login();
        $user_id = $this->auth->user_id();
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('area');

		$user = $this->user->get($user_id);
		if(isset($user->area) && $user->area)
		{
			$qu = $this->area->get($user->area);

			$qu_list = $this->area->lists(array('where' => 'parent_id = '.$qu->parent_id));
			
            $city = $this->area->lists(array('where' => 'area_level = 2 and area_id = '.$qu->parent_id));

            $city_list = array();
            if($city && !empty($city)){
                $city = $city[0];
                $city_list = $this->area->lists(array('where' => 'area_level = 2 and parent_id = '.$city->parent_id));
                $province =  $this->area->get($city->parent_id);
            }
            else{
                $province =  $this->area->get($qu->parent_id);
            }
            
            $province_list = $this->area->lists(array('where' => 'area_level = 1'));

            $area = array('qu'=>$qu,'qu_list'=>$qu_list,
                'city'=>$city,'city_list'=>$city_list,
                "province"=>$province,"province_list"=>$province_list);
		}
		else
		{
			$area['province_list'] = $this->area->lists(array('where' => 'area_level = 1') );
		}
		
		$data['user'] = $user;
		$data['area'] = $area;

		$this->load->view('home/user-info',$data);
	}

    /**
     * 展示用户安全信息
     * 
     */
	public function safe()
	{
        $this->auth->check_login();
        $user_id = $this->auth->user_id();
		if(!$user_id)
		{
			show_404('',false);
		}
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-safe',$data);
	}

    /**
     * 展示用户余额信息
     * 
     */
	public function money()
	{
        $this->auth->check_login();
        $user_id = $this->auth->user_id();
		if(!$user_id)
		{
			show_404('',false);
		}
        $this->load->model('user_money_log');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
        $data['money_log'] = $this->user_money_log->all(array('where'=>array('user_id'=>$user_id)));
		$this->load->view('home/user-money',$data);
	}

    /**
     * 更新用户基本信息
     * 
     */
	public function update()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        
        $this->load->library('form_validation');

        if($post['email'])
        {
            $this->form_validation->set_rules('email', ' ', 'valid_email');
        }
        if($post['email'] && $this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['email'] = form_error('email');
            $data['msg'] = "出错";
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }
        $error = array();
        if($post['id'])
        {
            if($post['email'])
            {
                $where = array('email'=>$post['email'],'id !='=>$post['id']);
                if($this->user->exist($where))
                {
                    $error['email'] = '邮箱已存在';
                }                
            }
        }
        else
        {
            if($post['email'])
            {
                $where = array('email'=>$post['email']);
                if($this->user->exist($where))
                {
                    $error['email'] = '邮箱已存在';
                }
            }
        }
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>"出错",'error'=>$error));
            exit;
        }

        $row = array(
            'alias' => $post['alias'],
            'email' => $post['email'],
            'phone' => $post['phone'],
            'name' => $post['name'],
            'birthday' => $post['birthday'] ? intval(strtotime($post['birthday'])):0,
            'area' => $post['area'] != '' && $post['area'] >0? $post['area'] : 0,
            'address' => $post['address'],
            'id_card_number' => $post['id_card_number']
        );

        if($post['id'])
        {
            if(!$this->user->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_failed'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'home/users';
        }
        echo json_encode($data);
    }

    /**
     * 上传用户头像
     * 
     */
    public function upload_pic()
    {
        $post = $this->input->post();
        $id = $this->auth->user_id();
        $data = array('code' => '1000', 'msg' => '');

        if(empty($post) && !$id)
        {
            show_error('参数错误');
        }
        //处理图片
        if($post['user_pic_path'] && is_file(upload_folder('temp').DIRECTORY_SEPARATOR.$post['user_pic_path']))
        {
            $target = upload_folder('user').DIRECTORY_SEPARATOR.file_save_dir($id);

            create_folder($target);
            $config['image_library'] = 'gd2';
            $config['source_image'] = upload_folder('temp').DIRECTORY_SEPARATOR.$post['user_pic_path'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = TRUE;
            $config['new_image'] = $target.DIRECTORY_SEPARATOR.file_save_name($id).'.png';
            $config['width'] = 100;
            $config['height'] = 100;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            // $config['new_image'] = $target.DIRECTORY_SEPARATOR.file_save_name($id).'_small.png';
            // $config['width'] = 50;
            // $config['height'] = 50;
            // $this->load->library('image_lib', $config);

            // $this->image_lib->resize();
            @unlink($config['source_image']);
        }
        else
        {
            $data['code'] ='1001';
            $data['msg'] = '上传图片失败';
        }
        echo json_encode($data);
    }

    public function password()
    {
        $this->load->view('home/user/password');
    }

    public function updatePassword()
    {
        $this->auth->check_login_json();
        $oldpassword = $this->input->post('oldpassword');
        $password = $this->input->post('password');
        $password_confirmation = $this->input->post('password_confirmation');

        if(!$oldpassword)
        {
            echo json_encode(array(
                'code' => '1001',
                'msg' => '请填写旧密码'
            ));
            exit;
        }
        if(!$password)
        {
            echo json_encode(array(
                'code' => '1001',
                'msg' => '请填写新密码'
            ));
            exit;
        }
        if(!$password_confirmation)
        {
            echo json_encode(array(
                'code' => '1001',
                'msg' => '请填写确认密码'
            ));
            exit;
        }
        $user_id = $this->auth->user_id();
        $user = $this->user->get($user_id);
        if($user->pwd != $this->auth->encrypt($oldpassword,$user->username))
        {
            echo json_encode(array(
                'code' => '1001',
                'msg' => '旧密码错误'
            ));
            exit;
        }
        if(strlen($password)<6){
            echo json_encode(array(
                'code' => '1001',
                'msg' => '新密码不得小于六位'
            ));
            exit;
        }
        else if (strlen($password) != strlen($password_confirmation)) {
            echo json_encode(array(
                'code' => '1001',
                'msg' => '新密码与确认密码长度不一致'
            ));
            exit;
        }
        else if($password != $password_confirmation){
             echo json_encode(array(
                'code' => '1001',
                'msg' => '新密码与确认密码不相同'
            ));
            exit;
        }
        
        $row = array(
            'pwd' => $this->auth->encrypt($password,$user->username)
        );
        if($this->user->update($row,$user_id))
        {
            $data['code'] = '1000';
            $data['msg'] = '设置成功';
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = '设置失败';
        }
        echo json_encode($data);
    }

    public function payPwd()
    {
        $this->load->view('home/user/pay-pwd');
    }

    public function updatePayPwd()
    {
        $this->auth->check_login_json();
        $post = $this->input->post('paypwd');
        if(!isset($post['paypwd']))
        {
            echo json_encode(array(
                'code' => '1001',
                'msg' => $this->lang->line('param_error')
            ));
            exit;
        }
        $user_id = $this->auth->user_id();
        $user = $this->user->get($user_id);
        $row = array(
            'pay_pwd' => $this->auth->encrypt($post['paypwd'],$user->username)
        );
        if($this->user->update($row,$user_id))
        {
            $data['code'] = '1000';
            $data['msg'] = '设置成功';
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = '设置失败';
        }
        echo json_encode($data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */