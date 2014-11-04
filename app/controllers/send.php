<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_category');
		$this->load->model('product');
		$this->load->model('product_brand');
        $this->list_type = '';
    }

    public function mobileCode()
    {
    	$post = $this->input->post();
    	$mobile = $post['mobile'];
    	$this->load->helper('string');
    	$this->load->model('sms');
    	$this->load->model('validation');

    	if(!preg_mobile($mobile))
    	{
    		echo json_encode(array(
    			'code' => '1002',
    			'msg'  => '错误的手机号码'
    		));
    		exit;
    	}
        $code = mt_rand(100000,999999);
        $msg = "您好！您验证手机号所需的验证码为".$code."，请勿泄露给任何人，30分钟内有效。";

        if($this->sms->send($mobile,$msg))
        {
        	$this->validation->delete_by(array('mobile'=>$mobile));
            
            if($this->validation->insert(array(
            	'mobile' => $mobile,
            	'code'  => $code,
            	'expires' => local_to_gmt()+1800  //30分钟有效
            )))
            {
                echo json_encode(array('code'=>'1000'));
                exit;
            }
        }
        else
        {
    		echo json_encode(array(
    			'code' => '1002',
    			'msg'  => '发送失败，请稍候重试'
    		));
    		exit;
        }
		echo json_encode(array(
			'code' => '1001',
			'msg'  => '发生错误'
		));
    }
}

/* End of file send.php */
/* Location: ./application/controllers/send.php */