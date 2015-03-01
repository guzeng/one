<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evaluation extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */

	public function index()
	{
		$this->load->model('order_detail');
		$this->load->model('user_comment');
		$this->auth->check_login();
       
        $user_id = $this->auth->user_id();
        $this->load->model('product');
        $this->load->model('order_detail');
        $base_url = '';//base_url().'/home/evaluation/index/';
        $param = $this->uri->uri_to_assoc(4);
        $page = isset($param['page']) ? trim($param['page']) : 1;
        $_num = 5;
        $condition = array('where'=>"a.user_id = '".$user_id."'",'start'=>(intval($page)-1)*$_num,'num'=>$_num);
        $list = $this->order_detail->lists($condition);

        if(!empty($list)){
            foreach ($list as $key => $value) {
            	if(isset($value->id))
            	{
                    $user_comment = $this->user_comment->get_by_orderdetail($value->id);
            		if($user_comment)
            		{
            			$list[$key]->commented = true;
                        $list[$key]->comment_id = $user_comment->id;
            		}
            		else
            		{
            			$list[$key]->commented = false;
                        
            		}
            	}
            	else
            	{
            		$list[$key]->commented = false;
            	}
            }
        }
        $data['list'] = $list;
        $data['pagination'] = $this->order_detail->pages($base_url,array("a.user_id = '".$user_id."'"));

		$this->load->view('home/evaluation',$data);
	}

	public function update()
    {
        $this->auth->check_login_json();
        $this->load->model('user_comment');
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '评论成功');
        $user_id = $this->auth->user_id();
        if(!isset($post['point']) || !$post['point'])
        {
            echo json_encode(array('code'=>'1010','msg'=>'请选择评分'));
            exit;
        }
        if(!isset($post['content']) || !$post['content'])
        {
            echo json_encode(array('code'=>'1010','msg'=>'请输入评论'));
            exit;
        }
        if(!$user_id || !$post['order_detail_id'] || !$post['product_id'])
        {
            echo json_encode(array('code'=>'1010','msg'=>'参数错误'));
            exit;
        }
        
        $row = array(
            'point' => $post['point'],
            'content' => $post['content'] ? $post['content'] : '',
            'user_id' => $user_id,
            'order_detail_id' => $post['order_detail_id'],
            'product_id' => $post['product_id']
        );
        if(!$post['id'])
        {
            if(!$this->user_comment->insert($row))
            {
                //order status
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        else
        {
            $row['id'] = $post['id'];
            if(!$this->user_comment->update($row,$post['id']))
            {
                //order status
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }

        
        if($data['code'] == '1000')
        {
            $data['goto'] = 'home/evaluation';
        }
        echo json_encode($data);
    }

    /**
     * 编辑用户评价信息
     * 
     */
    public function edit()
    {
        $this->load->model('user_comment');
        $post = $this->input->post();
        $id = $post['id'];
        $data = array('code' => '1000');

        if($id)
        {
            $row = $this->user_comment->get($id);
            if(!$row)
            {
                show_404('',false);
            }

            $data['row'] = $row;
        }
        else
        {
            $data['code'] = '1001';
        }
        echo json_encode($data);
    }
    //-------------------------------------------------------------------------
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */