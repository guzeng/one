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
            $this->auth->set_auto_login($user->username, $user->pwd);
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
            //保存session
            $this->auth->save_login($user);
        }
        echo json_encode($data);
        exit;
    }

    function get_captcha(){
        $this->load->helper('captcha');
        create_my_captcha();
    }

    public function out()
    {
        $this->auth->destroy();
        redirect(base_url().'home');
    }

    public function byqq()
    {

        require_once(APPPATH."libraries/QQAPI/qqConnectAPI.php");
        $qc = new QC();
        $qc->qq_login();
    }

    public function qqcallback()
    {
        $this->load->model('user');
        $this->load->model('user_openid');
        require_once(APPPATH."libraries/QQAPI/qqConnectAPI.php");
        $qc = new QC();
        $access_token = $qc->qq_callback();

        $openid = $qc->get_openid();
        $useropenid = $this->user_openid->get_by_openid($openid);
        if(isset($useropenid->user_id) && $useropenid->user_id > 0)
        {
            $this->user_openid->update(
                array(
                    'token'=>$access_token['access_token'],
                    'expires'=>local_to_gmt()+$access_token['expires_in'],
                    'refresh_token'=>$access_token['refresh_token']
                ),$useropenid->id);

            $user = $this->user->get($useropenid->user_id);
            $login_time = local_to_gmt();
            $update_row['last_login_time'] = $login_time;
            $update_row['last_login_ip'] = $this->input->ip_address();
            //自动保留登录15天
            $this->auth->set_auto_login($user->username, $user->password);
            if(isset($_COOKIE['lms_logout_url']))
            {
                $url = $_COOKIE['lms_logout_url'];
                setcookie('lms_logout_url', '', time()-3600, '/');
            }
            else
            {
                $url = base_url();
            }
            $this->user->update($update_row,$user->id);
            //保存session
            $this->auth->save_login($user);
            redirect($url);
        }
        else
        {
            if(!$useropenid)
            {
                if($this->user_openid->insert(
                    array(
                        'name'=>'qq',
                        'token'=>$access_token['access_token'],
                        'openid'=>$openid,
                        'create_time'=>local_to_gmt(),
                        'expires'=>local_to_gmt()+$access_token['expires_in'],
                        'refresh_token'=>$access_token['refresh_token']
                    )
                ))
                {
                    redirect('register/openid/'.$openid);
                }
                else
                {
                    redirect('login/error/login_error');
                }                
            }
            else
            {
                redirect('register/openid/'.$openid);
            }
        }
    }

    public function byweixin()
    {

        require_once(APPPATH."libraries/WXAPI/wxConnectAPI.php");
        $qc = new QC();
        $qc->login();
    }

    public function wxcallback()
    {
        $this->load->model('user');
        $this->load->model('user_openid');
        require_once(APPPATH."libraries/WXAPI/qqConnectAPI.php");
        $qc = new QC();
        $param = $qc->callback();
        //$openid = $qc->get_openid();
        $useropenid = $this->user_openid->get_by_openid($param['openid']);
        if(isset($useropenid->user_id) && $useropenid->user_id > 0)
        {
            $this->user_openid->update(
                array(
                    'token'=>$param['access_token'],
                    'expires'=>local_to_gmt()+$param['expires_in'],
                    'refresh_token'=>$param['refresh_token']
                ), $useropenid->id);

            $user = $this->user->get($useropenid->user_id);
            $login_time = local_to_gmt();
            $update_row['last_login_time'] = $login_time;
            $update_row['last_login_ip'] = $this->input->ip_address();
            //自动保留登录15天
            $this->auth->set_auto_login($user->username, $user->password);
            if(isset($_COOKIE['lms_logout_url']))
            {
                $url = $_COOKIE['lms_logout_url'];
                setcookie('lms_logout_url', '', time()-3600, '/');
            }
            else
            {
                $url = base_url();
            }
            $this->user->update($update_row,$user->id);
            //保存session
            $this->auth->save_login($user);
            redirect($url);
        }
        else
        {
            if(!$useropenid)
            {
                if($this->user_openid->insert(
                    array(
                        'name'=>'weixin',
                        'token'=>$param['access_token'],
                        'openid'=>$param['openid'],
                        'create_time'=>local_to_gmt(),
                        'expires'=>local_to_gmt()+$param['expires_in'],
                        'refresh_token'=>$param['refresh_token']
                    )
                ))
                {
                    redirect('register/openid/'.$param['openid']);
                }
                else
                {
                    redirect('login/error/login_error');
                }                
            }
            else
            {
                redirect('register/openid/'.$param['openid']);
            }
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */