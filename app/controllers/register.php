<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    }
	public function index()
	{
		$this->load->view('home/register');
	}

    public function checkName()
    {
        $post = $this->input->post();
        $this->load->model('user');
        $data = array("code"=>'1001',"msg"=>'请输入登录名');
        if($post['field'] && $post['field_value'])
        {
            $where = array($post['field']=>$post['field_value']);
            if($this->user->exist($where))
            {
                $data['msg'] = '用户名已存在';
            }
            else
            {
                $data['code'] = '1000';
                $data['msg'] = '';
            }                
        }

        echo json_encode($data);
    }

    public function apply()
    {
        $this->load->model('user');
        $post = $this->input->post();

        $data = array('code' => '1000', 'msg' => '');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', '登录名', 'required');
        $this->form_validation->set_rules('password', '密码', 'required|min_length[6]');
        $this->form_validation->set_rules('pwd_confirmation', '密码', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('validate_key', '验证码', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['username'] = form_error('username');
            $error['password'] = form_error('password');
            $error['pwd_confirmation'] = form_error('pwd_confirmation');
            $error['validate_key'] = form_error('validate_key');
            $data['msg'] = "出错";
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['username'])
        {
            $where = array('username'=>$post['username']);
            if($this->user->exist($where))
            {
                $error['username'] = '登录名已存在';
            }
        }
         //对比验证码，不区分大小写
        if( strtoupper($post['validate_key']) != $_SESSION['login_check_number'])
        {
            $error['validate_key'] = '验证码不正确';
            $data['message'] = "出错";
        }
        
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>"",'error'=>$error));
            exit;
        }

        $row = array(
            'pwd' => $this->auth->encrypt($post['password'],$post['username']),
            'username' => $post['username'],
            'status'  => 1
        );

        if(!$this->user->insert($row))
        {
            $data = array('code'=>'1001','msg'=>"注册失败");
        }

        if($data['code'] == '1000')
        {
            $data['url'] = base_url()."/register/welcome";
            $data['msg'] = '注册成功';
        }
        echo json_encode($data);
   }

   public function welcome(){
        return $this->load->view('home/register_success');
   }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */