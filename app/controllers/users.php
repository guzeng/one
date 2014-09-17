<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    }
	public function index($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-info',$data);
	}

	public function safe($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-safe',$data);
	}

	public function money($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-money',$data);
	}

	public function address($user_id)
	{
		if(!$user_id)
		{
			show_404('',false);
		}
		$this->load->model('user');
		$user = $this->user->get($user_id);

		$data['user'] = $user;
		$this->load->view('home/user-address',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */