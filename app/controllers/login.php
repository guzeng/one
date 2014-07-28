<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('home/login');
	}
	//-------------------------------------------------------------------------
    
    /**
     * verify login
    */
    public function verify(){
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $this->load->model('user');
        $data = array('code'=>'1000');

        setcookie('one_username', base64_encode($username.'one'), time()+3600*24*10,'/');
        if($username=="")
        {
            $data['code'] = '1011';
            $data['message'] = "请输入帐户";
            echo json_encode($data);
            exit;
        }
        if($password=="")
        {
            $data['code'] = '1011';
            $data['message'] = "请输入密码";
            echo json_encode($data);
            exit;
        }

        $user = $this->user->get_by_condition($username);

        if(!$user)
        {
            $data['code'] = '1001';
            $data['message'] = "帐户或密码错误";
            echo json_encode($data);
            exit;
        }
        $username = $user->username;
        if($user->status != '1')
        {
            $data['code'] = '1010';
            $data['message'] = "帐户暂没启用";
            echo json_encode($data);
            exit;
        }
        if($user->pwd != $this->auth->encrypt($password,$username))
        {
            $data['code'] = '1001';
            $data['message'] = "帐户或密码错误";
            echo json_encode($data);
            exit;
        }

        $update_row = array();

        if($data['code']=='1000')
        {
            $login_time = local_to_gmt();
            // $update_row['visit_count'] =  $user->visit_count + 1;
            $update_row['last_login_time'] = $login_time;
            $update_row['last_login_ip'] = $this->input->ip_address();
            //自动保留登录15天
            $this->auth->set_auto_login($user->username, $user->password);
            if(isset($_COOKIE['lms_logout_url']))
            {
                $data['url'] = $_COOKIE['lms_logout_url'];
                setcookie('lms_logout_url', '', time()-3600, '/');
            }
            else
            {
                $data['url'] = base_url();
            }
            $this->user->update($update_row,$user->id);
            
        }
        echo json_encode($data);
        exit;
    }

    function get_captcha(){
        $this->load->helper('captcha');
        create_my_captcha();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */