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
        $data = array("code"=>'1001',"msg"=>'参数错误');
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
        $validate_key = trim($this->input->post('validate_key'));
         //对比验证码，不区分大小写
        if( strtoupper($validate_key) != $_SESSION['login_check_number'])
        {
            $data['code'] = '1011';
            $data['message'] = 验证码不正确;
            echo json_encode($data);
            exit;
        }
        
   }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */