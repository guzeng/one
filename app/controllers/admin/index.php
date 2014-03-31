<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->show_dashboard = '';
    }
	public function index()
	{
		$this->show_dashboard = 'return';
		$data['dashboard'] = $this->dashboard();
		$this->load->view('admin/index', $data);
	}
	/**
	 * 首页面板内容
	 */
	public function dashboard()
	{
		if($this->show_dashboard == 'return')
		{
			return $this->load->view('admin/dashboard','',true);
		}
		else
		{
			$this->load->view('admin/dashboard');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */