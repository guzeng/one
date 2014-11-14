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
		$data['user'] = $user;
		$this->load->view('home/mailsubs',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */