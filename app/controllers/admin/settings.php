<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	/**
	 * Settings.
	 *
	 * @author varson
	 * 2014/4/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('setting');
		$this->list_type = '';
		if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
            $this->auth->check_login_json();
            $this->auth->check_permission('json');
        } else {
            $this->auth->check_login();
            $this->auth->check_permission();
        }
    }
	public function index()
	{
		$data = array();
		$list = $this->setting->fetch_all();
		if(!empty($list))
		{
			foreach($list as $key => $item)
			{
				$data[$item->variable] = $item->value;
			}
		}
        $this->load->view('admin/setting/edit',$data);
	}
    //-------------------------------------------------------------------------

	public function update()
	{
        
		$data = array(
			'code' => '1000', 
			'msg' => ''
		);
		$post = array(
			'contact_man' 		=> trim($this->input->post('contact_man',TRUE)),
			'contact_phone' 	=> trim($this->input->post('contact_phone',TRUE)),
			'contact_email' 	=> trim($this->input->post('contact_email',TRUE)),
			'smtp_server' 		=> trim($this->input->post('smtp_server',TRUE)),
			'smtp_port' 		=> trim($this->input->post('smtp_port',TRUE)),
			'smtp_user' 		=> trim($this->input->post('smtp_user',TRUE)),
			'smtp_pwd' 			=> trim($this->input->post('smtp_pwd',TRUE)),
			'smtp_email' 		=> trim($this->input->post('smtp_email',TRUE)),
			'captcha' 	=> trim($this->input->post('key',TRUE))
		);

		//表单验证
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_man', ' ', 'max_length[100]');
		$this->form_validation->set_rules('contact_phone',' ', 'max_length[100]');
		$this->form_validation->set_rules('contact_email',' ', 'max_length[100]|valid_email');
    	$this->form_validation->set_rules('smtp_server',' ', 'max_length[100]');
		$this->form_validation->set_rules('smtp_port', ' ', 'max_length[100]');
		$this->form_validation->set_rules('smtp_user', ' ', 'max_length[50]');
		$this->form_validation->set_rules('smtp_pwd', ' ', 'max_length[50]'); 
		$this->form_validation->set_rules('smtp_email',' ', 'max_length[100]|valid_email'); 
		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('', '');
			$error['contact_man'] = form_error('contact_man');
			$error['contact_phone'] = form_error('contact_phone');
			$error['contact_email'] = form_error('contact_email');
			$error['smtp_server'] = form_error('smtp_server');
			$error['smtp_port'] = form_error('smtp_port');
			$error['smtp_user'] = form_error('smtp_user');
			$error['smtp_pwd'] = form_error('smtp_pwd');
			$error['smtp_email'] = form_error('smtp_email');
			$data['error'] = $error;
			$data['code'] = '1010';
			echo json_encode($data);                                    
			exit;
		}	     
	 	else
		{
	    	$log_param = array();
			$log_param['object_id'] = 0;
			$log_param['object_name'] = '';
			$log_param['object_type'] = 'setting';
			$log_param['type'] = 'update';

			$all_settings = $this->setting->fetch_all();
			$all = array();
			if($all_settings)
			{
				foreach($all_settings as $key => $value)
				{
					$all[$value->variable] = array('id'=>$value->id, 'value'=>$value->value);
				}
			}
			foreach($post as $key => $value)
			{
				$success = false;
				if(array_key_exists($key, $all))
				{
					if($value !== $all[$key]['value'])
					{
						if($this->setting->update(array('value'=>$value), $all[$key]['id']))
						{
							$success = true;
						}
					}
				}
				else
				{
					if($this->setting->insert(array('variable'=>$key, 'value'=>$value)))
					{
						$success = true;
					}
				}
				//写入log
				if($success)
				{
					switch ($key) {
						case 'contact_man':
							$log[] = '联系我们：'.$value;
						break;
						case 'contact_phone':
							$log[] = '联系电话：'.$value;
						break;
						case 'contact_email':
							$log[] = '电子邮件：'.$value;
						break;
						case 'smtp_server':
							$log[] = 'SMTP服务器：'.$value;
						break;
						case 'smtp_port':
							$log[] = 'SMTP服务器端口：'.$value;
						break;
						case 'smtp_user':
							$log[] = '用户名：'.$value;
						break;
						case 'smtp_pwd':
							$log[] = '密码：'.$value;
						break;
						case 'smtp_email':
							$log[] = '发信地址：'.$value;
						break;
						case 'captcha':
							$log[] = '验证码：'.($value==1 ? '打开' : '关闭');
						break;
					}
				}
			}
            $this->setting->save_cache($post);//将系统配置写入缓存文件
		}
		if($data['code']=='1000')
		{
			if(!empty($log))
			{
				$this->load->model('logs');
				$log_param['message'] = implode(' ; ', $log);
				$this->logs->insert($log_param);				
			}

			$data['goto'] = 'admin/index';
		}
		echo json_encode($data);                                    
		exit;
	}
    //-------------------------------------------------------------------------


}
/* End of file Settings.php */
/* Location: ./lms_app/controllers/admin/Settings.php */