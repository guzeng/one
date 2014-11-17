<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailsubs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('user_mailsubs');
    }

	/**
	 * Index Page for this controller.
	 * 
	 */
	public function index()
	{
		$this->auth->check_login();
        $user_id = $this->auth->user_id();
		if(!$user_id)
		{
			show_404('',false);
		}
		$user = $this->user->get($user_id);
		$user_mailsubs = $this->user_mailsubs->get($user_id);

		$data['user'] = $user;
		$data['user_mailsubs'] = $user_mailsubs;
		$this->load->view('home/mailsubs',$data);
	}

	/**
     * 更新用户订阅信息
     * 
     */
    public function update()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        $user_id = $this->auth->user_id();
		if(!$user_id)
		{
			show_404('',false);
		}

        $data = array('code' => '1000', 'msg' => '');
        // $row = array(
        //     'shoping_order' => isset($post['shoping_order']) ? $post['shoping_order'] : 0,
        //     'shoping_not_pay' => isset($post['shoping_not_pay']) ? $post['shoping_not_pay'] : 0,
        //     'shoping_pay_success' => isset($post['shoping_pay_success']) ? $post['shoping_pay_success'] : 0,
        //     'shoping_not_comment' => isset($post['shoping_not_comment']) ? $post['shoping_not_comment'] : 0,
        //     'account_coupon' => isset($post['account_coupon']) ? $post['account_coupon'] : 0,
        //     'account_not_pay' => isset($post['account_not_pay']) ? $post['account_not_pay'] : 0,
        //     'account_pay_success' => isset($post['account_pay_success']) ? $post['account_pay_success'] : 0,
        //     'account_not_comment' => isset($post['account_not_comment']) ? $post['account_not_comment'] : 0,
        //     'user_id' => $user_id
        // );

        // $user_mailsubs = $this->user_mailsubs->get($user_id);
        // if($user_mailsubs)
        // {
        //     if(!$this->user_mailsubs->update($row,$user_id))
        //     {
        //         $data = array('code'=>'1001','msg'=>$this->lang->line('update_failed'));
        //     }
        // }
        // else
        // {
        // 	if(!$this->user_mailsubs->insert($row))
        //     {
        //         $data = array('code'=>'1001','msg'=>$this->lang->line('add_failed'));
        //     }
        // }

        if($data['code'] == '1000')
        {
            $data['goto'] = 'home/mailsubs';
        }
        echo json_encode($data);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */