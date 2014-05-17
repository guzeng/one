<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	/**
	 * Settings.
	 *
	 * @author varson
	 * 2014/4/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('setting');
		$this->list_type = '';
    }
	public function index()
	{
        $this->load->view('admin/setting/edit');
	}
    //-------------------------------------------------------------------------



}
/* End of file Settings.php */
/* Location: ./lms_app/controllers/admin/Settings.php */