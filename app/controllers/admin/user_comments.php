<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_comments extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author alex liang
	 * 2014/5/26  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_comment');
		$this->list_type = '';
        if ( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) {
            $this->auth->check_login_json();
            $this->auth->check_permission('json');
        } else {
            $this->auth->check_login();
            $this->auth->check_permission();
        }
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/user_comment/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->user_comment->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/user_comment/datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/user_comment/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->user_comment->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/user_comment/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $this->auth->check_json_login();

        $this->load->model('auth');
        $user_id = $this->auth->user_id();
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->form_validation->set_rules('content', ' ', 'required'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $error['content'] = form_error('content');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $row = array(
            'content' => trim($post['content']),
            'user_id' => $user_id
        );
        if(!$this->user_comment->insert($row))
        {
            $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
        }
        echo json_encode($data);
    }

    public function reversion($id='')
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '','goto'=>'admin/user_comments');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('reversion', ' ', 'required'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $error['reversion'] = form_error('reversion');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $row = array(
            'reversion' => trim($post['reversion'])
        );
        if($id)
        {
            if(!$this->user_comment->update($row,$id))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        echo json_encode($data);
    }

    public function delete($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->user_comment->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }
}
/* End of file user_comments.php */
/* Location: ./lms_app/controllers/admin/user_comments.php */