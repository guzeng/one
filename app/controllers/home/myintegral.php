<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myintegral extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */

	public function index()
	{
        $this->auth->check_login();
        $user_id = $this->auth->user_id();
        $param = $this->uri->uri_to_assoc(4);
        $time_type = $this->param['time_type'] = $this->input->post('time_type')!='' ? trim($this->input->post('time_type')) : 
            (isset($param['time_type']) ? urldecode(trim($param['time_type'])) : 'three_month_ago');
        $time_type_list = array('three_month_ago'=>"积分记录(近三个月记录)",
                                'one_year_ago'=>"积分记录(近一年记录)",
                                'all'=>"积分记录(全部记录)");
        if(!$user_id)
        {
            show_404('',false);
        }
        $this->load->model('user');
        $this->load->model('user_score_log');
        $user = $this->user->get($user_id);

        $three_month_ago = strtotime('-3 month');
        $condition = array("a.user_id = '".$user_id."'");
        $time = 0;
        if($time_type == 'three_month_ago')
            $time = strtotime('-3 month');
        else if($time_type == 'one_year_ago')
            $time = strtotime('-1 year');
        $condition[] ="a.create_time >= ".$time;

        $list = $this->user_score_log->lists($condition,15,'a.id desc');
        $data['user'] = $user;
        $data['list'] = $list;
        $data['time_type']=$time_type;
        $data['time_type_list']=$time_type_list;
        $data['pagination'] = $this->user_score_log->pages($condition);
        $this->load->view('home/myintegral',$data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */