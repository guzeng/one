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
			show_404();
		}
		$data['phone'] = $user->phone;
		$data['validate_phone'] = $user->validate_phone;
		$this->load->view('home/user/validate-phone',$data);
	}

	public function mobile()
	{
		$this->auth->check_login_json();
		$post = $this->input->post();
		$mobile = $post['phone'];
		$code = $post['validate_code'];
		$this->load->model('validation');
		$row = $this->validation->exist(array('mobile'=>$mobile,'code'=>$code));
		if($row)
		{
			if($row->expires < local_to_gmt())
			{
				//已过期
				echo json_encode(array(
					'code' => '1010',
					'msg' => "验证码已过期"
				));
				exit;
			}
			else
			{
				if($this->user->update(array('phone'=>$mobile, 'validate_phone'=>1), $this->auth->user_id()))
				{
					echo json_encode(array(
						'code' => '1000',
						'msg' => "您的手机验证成功"
					));
					exit;
				}
				else
				{
					echo json_encode(array(
						'code' => '1010',
						'msg' => "您的手机验证失败，请稍候再试"
					));
					exit;
				}
			}
		}
		else
		{
			echo json_encode(array(
				'code' => '1001',
				'msg' => "验证码错误"
			));
			exit;
		}
	}

	public function validate_email()
	{
		$this->auth->check_login();
		$user_id = $this->auth->user_id();
		$user = $this->user->get($user_id);
		if(!$user)
		{
			show_404();
		}
		$data['email'] = $user->email;
		$data['validate_email'] = $user->validate_email;
		$this->load->view('home/user/validate-email',$data);
	}

	public function sendemail()
	{
		$this->auth->check_login();
		$user_id = $this->auth->user_id();
		$user = $this->user->get($user_id);
		if(!$user)
		{
			show_404();
		}
		$post = $this->input->post();
		$email = $post['email'];
		/*
		if($user->validate_email == 1)
		{
			echo json_encode(array(
				'code' => '1001',
				'msg' => "您的邮箱已验证"
			));
			exit;
		}*/
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('email',' ', 'required|valid_email'); 
		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('', '');
			$data['error'] = form_error('email');
			$data['email'] = $email;
			echo $this->load->view('home/user/validate-email',$data,true);      
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
			$data['success'] = '邮件发送成功，请登录您的邮箱'.$user->email.'，点击链接完成验证。';
		}
		else
		{
			$data['error'] = '邮件发送失败，请稍候重试';
		}
		$this->load->view('home/message',$data);
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