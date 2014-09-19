<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    }
	public function index($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$this->load->model('area');

		$user = $this->user->get($user_id);
		if(isset($user->area) && $user->area)
		{
			$area['qu'] = $this->area->lists(array('where' => 'area_level = 3 and area_id = '.$user->area));
			$area['city'] = $this->area->lists(array('where' => 'area_level = 2 and parent_id = '.$area['qu']->parent_id));
			$area['province'] = $this->area->lists(array('where' => 'area_level = 1'));
		}
		else
		{
			$area['province'] = $this->area->lists(array('where' => 'area_level = 1') );
		}
		
		$data['user'] = $user;
		$data['area'] = $area;

		$this->load->view('home/user-info',$data);
	}

	public function safe($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-safe',$data);
	}

	public function money($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-money',$data);
	}

	public function address($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-address',$data);
	}

	public function update_by_id()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        
        $this->load->library('form_validation');
        $this->load->model('user');

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
            'area' => $post['area'] != ''? $post['area'] : 0,
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
            $data['goto'] = 'users/index/'.$post['id'];
        }
        echo json_encode($data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */