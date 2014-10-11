<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Login Page for this controller.
	 * 
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}
	public function index()
	{
		$this->load->view('admin/login');
	}

	public function verify()
	{
		/*
		if($this->input->post($csrf,true) != $token)
		{
			$this->load->view('admin/login');
			exit;
		}*/
		$username = $this->input->post('username',true);
		$password = $this->input->post('password',true);
		if(!$username || !$password)
		{
			$data['msg'] = '请输入用户名密码';
			echo $this->load->view('admin/login',$data,true);
			exit;
		}
		$this->load->model('user');
		$user = $this->user->get_by_username($username);
		if(isset($user->is_admin) && $user->is_admin != 1)
		{
			$data['msg'] = "你不是管理员";
			echo $this->load->view('admin/login', $data, true);
			exit;
		}
		if(!$user)
		{
			$data['msg'] = "用户名或密码错误";
			echo $this->load->view('admin/login', $data, true);
			exit;
		}
		if($user->pwd != $this->auth->encrypt($password,$username))
		{
			$data['msg'] = "用户名或密码错误";
			echo $this->load->view('admin/login',$data, true);
			exit;
		}

		$this->auth->save_login($user);
		redirect(base_url().'admin');
	}

	public function out()
	{
		$this->auth->destroy();
		redirect(base_url().'admin');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */