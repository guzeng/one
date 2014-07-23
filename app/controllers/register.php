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
	 //-------------------------------------------------------------------------
    
    public function apply()
    {
        $validate_key = trim($this->input->post('validate_key'));
         //对比验证码，不区分大小写
        if( strtoupper($validate_key) != $_SESSION['login_check_number'])
        {
            $data['code'] = '1011';
            $data['message'] = 验证码不准确;
            echo json_encode($data);
            exit;
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */