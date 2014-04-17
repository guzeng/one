<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Login Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->show_dashboard = '';
    }
	public function index()
	{
		$this->load->view('admin/login');
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */