<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends CI_Controller {

	/**
	 * Areas for this controller.
	 *
	 * @author alex liang
	 * 2013/9/11  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('area');
    }

    public function lists($id,$area_level)
    {
        $this->auth->check_login_json();
        if(!$id && !$area_level)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }

        $data['code'] = '1000';
        $data['zhi_xia_shi'] = false;   //是否是直辖市
        $data['area'] = $this->area->lists(array('where' => 'area_level = '.$area_level.' and parent_id = '.$id));

        if(!$data['area'])
        {
            $data['area'] = $this->area->lists(array('where' => 'area_level = '.intval($area_level+1).' and parent_id = '.$id));
            $data['zhi_xia_shi'] = true;   //是否是直辖市
        }

        echo json_encode($data);
    }
    //-------------------------------------------------------------------------
}
/* End of file Areas.php */
/* Location: ./lms_app/controllers/admin/Areas.php */