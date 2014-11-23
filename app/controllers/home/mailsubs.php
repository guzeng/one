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
        $subs = array();
        if($user_mailsubs->sub)
        {
            $subs = explode(",",$user_mailsubs->sub);
        }
		$data['user'] = $user;
		$data['subs'] = $subs;
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
        $subs = isset($post['subs']) ? $post['subs'] : '';
        $subs_str = '';
        if($subs)
        {
            $subs_str = implode(",",$subs);
        }
        $row = array("sub"=>$subs_str);

        $user_mailsubs = $this->user_mailsubs->get($user_id);
        if($user_mailsubs)
        {
            if(!$this->user_mailsubs->update($row,$user_id))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_failed'));
            }
        }
        else
        {
            $row["user_id"] = $user_id;
        	if(!$this->user_mailsubs->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_failed'));
            }
        }

        if($data['code'] == '1000')
        {
            $data['goto'] = 'home/mailsubs';
        }
        echo json_encode($data);
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */