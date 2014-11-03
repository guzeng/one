<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validate extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 */

    function __construct()
    {
        parent::__construct();
        $this->load->model('user');

    }


	public function phone()
	{

		$this->auth->check_login();
		$user_id = $this->auth->user_id();
		$user = $this->user->get($user_id);
		if(!$user)
		{
			echo json_encode(array(
				'code' => '1001',
				'msg' => $this->lang->line('no_data_exist')
			));
			exit;
		}
		$data['phone'] = $user->phone;
		$this->load->view('home/user/validate-phone',$data);
	}

	public function mobile()
	{

	}

	public function sendemail()
	{
		$this->auth->check_login_json();
		$user_id = $this->auth->user_id();
		$user = $this->user->get($user_id);
		if(!$user)
		{
			echo json_encode(array(
				'code' => '1001',
				'msg' => $this->lang->line('no_data_exist')
			));
			exit;
		}
		if($user->validate_email == 1)
		{
			echo json_encode(array(
				'code' => '1001',
				'msg' => "您的邮箱已验证"
			));
			exit;
		}
		if(!$user->email)
		{
			echo json_encode(array(
				'code' => '1004',
				'msg' => '邮箱不存在'
			));
			exit;
		}
		//发邮件
		$this->load->model('email');
		$this->load->model('validation');
		$code = md5(rand());
		$this->validation->insert(array(
			'user_id' => $user_id,
			'email' => $user->email,
			'code' => $code
		));
		$data = array(
			'username'=>$user->username,
			'email' => $user->email,
			'url' => base_url().'validate/email/'.str_replace('=','',base64_encode(base64_encode($user->email).'###'.$code))
		);
		$msg = $this->load->view('email/validate-email',$data,true);
		if($this->email->send($user->email,'邮箱验证',$msg))
		{
			echo json_encode(array(
				'code' => '1000',
				'msg' => '邮件发送成功，请登录您的邮箱'.$user->email.'，点击验证链接。'
			));
		}
		else
		{
			echo json_encode(array(
				'code' => '1010',
				'msg' => '邮件发送失败，请稍候重试'
			));
		}
	}

	public function email($code)
	{
		if(!$code)
		{
			show_error($this->lang->line('param_error'),500);
		}
		$code = base64_decode($code);

		$arr = explode('###', $code);

		if(count($arr) != 2)
		{
			show_error($this->lang->line('param_error'),500);
		}
		$email = base64_decode($arr[0]);
		$c = $arr[1];
		$this->load->model('validation');
		$row = $this->validation->exist(array('email'=>$email,'code'=>$c));

		if($row)
		{
			if($row->expires < local_to_gmt())
			{
				show_error('链接已过期');
			}
			else
			{
				$user = $this->user->get($row->user_id);
				if(!$user || $user->status == 0)
				{
					show_error($this->lang->line('no_data_exist'));
				}
				else
				{
					if($this->user->update(array('validate_email'=>1),$row->user_id))
					{
						$this->validation->delete($row->id);
						//验证成功
						echo '验证成功';
					}
					else
					{
						//验证失败
						echo '验证失败';
					}
				}
			}
		}
		else
		{
			show_error($this->lang->line('no_data_exist'));
		}
	}

}

/* End of file validate.php */
/* Location: ./application/controllers/validate.php */