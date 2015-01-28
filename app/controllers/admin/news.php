<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author alex
	 * 2013/4/27  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('newss');
        $this->load->model('news_category');
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
        $category = $this->news_category->all(array('orderby' =>'id asc'));
        $data['category_list'] = $category;
        $data['param'] = $this->newss->get_param();//stripslashes
        $data['list'] = $this->lists();
        $this->load->view('admin/news/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->newss->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/news/datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/news/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->newss->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $data['cates'] = $this->news_category->all();
        $this->load->view('admin/news/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $this->auth->check_login_json();
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', ' ', 'required|max_length[50]'); 
        $this->form_validation->set_rules('content', ' ', 'required'); 
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['title'] = form_error('title');
            $error['content'] = form_error('content');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
            $where = array('title'=>$post['title'],'id !='=>$post['id']);
            if($this->newss->exist($where))
            {
                $error['title'] = '名称已存在';
            }
        }
        else
        {
            $where = array('title'=>$post['title']);
            if($this->newss->exist($where))
            {
                $error['title'] = '名称已存在';
            }
        }
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
            exit;
        }
        //show_time处理,状态0和1录入当前时间
        $show_time =  ($post['status'] == 0 ||  $post['status'] == 1) ? time() : intval(strtotime($post['show_time']));
        $row = array(
            'title' => $post['title'],
            'content' => $post['content'] ? $post['content'] : '',
            'status' => $post['status'] ? $post['status'] : 0,
            'show_time' => $show_time,
            'cate_id' => $post['cate_id'] ? $post['cate_id'] : 0
        );

        if($post['id'])
        {
            if(!$this->newss->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->newss->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/news';
        }
        echo json_encode($data);
    }

    public function delete($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->newss->delete($id))
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
/* End of file news.php */
/* Location: ./app/controllers/admin/news.php */