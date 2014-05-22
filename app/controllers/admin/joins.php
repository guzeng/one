<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Joins extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('join');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/join/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->join->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/join/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/join/datalist',$data,true)
            ));            
        }
    }
    //-------------------------------------------------------------------------

    public function info($id='')
    {
        if($id)
        {
            $row = $this->join->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/join/info',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->form_validation->set_rules('status', ' ', 'integer|max_length[3]'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $error['status'] = form_error('status');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $row = array(
            'status' => intval($post['status'])
        );
        if($post['id'])
        {
            if(!$this->join->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        echo json_encode($data);
    }


}
/* End of file joins.php */
/* Location: ./app/controllers/admin/joins.php */