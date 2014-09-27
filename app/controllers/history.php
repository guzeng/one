<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_browse_history');
    }
	public function index()
	{
		$user_id = $this->auth->user_id();
		if(!$user_id)
        {
            show_login();
        }
        $temp = $this->user_browse_history->lists(array('where'=>'a.user_id = '.$user_id.' and a.create_time >'.strtotime("last month"),'orderby'=>'create_time desc','num'=>500));
        $user_history = array();
        if($temp)
        {
        	$i = 0;
        	foreach ($temp as $key => $item) {

        		if($i == 5)
        			break;

        		if(date('Y-m-d', $item->create_time) == date('Y-m-d',time()))
                    $show_date = '今天';
                else if(date('Y-m-d', $item->create_time) == date('Y-m-d',time()-24*3600))
                    $show_date = '昨天';
                else if(date('Y-m-d', $item->create_time) == date('Y-m-d',time())-2*24*3600)
                    $show_date = '前天';
                else
                    $show_date = date('Y-m-d', $item->create_time);

                $item->show_date = $show_date;

        		if($key != 0 && isset($last_creat_time) && date('Y-m-d',$item->create_time) != $last_creat_time)
        		{
        			$i++;
        		}
        		$user_history[$i][] = $item;
        		$last_creat_time = date('Y-m-d',$item->create_time);
        		
        	}
        }
        $data['user_history'] = $user_history;
		$this->load->view('home/history',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */