<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('order');
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
        $data['param'] = $this->order->get_param();//stripslashes
        $data['list'] = $this->lists();
        $this->load->view('admin/order/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists($status = '')
    {
        if($status !== '')
        {
            $data['list'] = $this->order->all(array('a.status="'.$status.'"'));
        }
        else
        {
            $data['list'] = $this->order->all();
        }
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/order/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/order/datalist',$data,true)
            ));            
        }
    }
    //-------------------------------------------------------------------------

    public function other($status)
    {
        $this->list_type = 'return';
        $data['param'] = $this->order->get_param();//stripslashes
        $data['list'] = $this->lists($status);
        $data['title'] = $this->order->status($status);
        $this->load->view('admin/order/list_send',$data);
    }
    //-------------------------------------------------------------------------
    /*
    public function back()
    {
        $this->list_type = 'return';
        $data['param'] = $this->order->get_param();//stripslashes
        $data['list'] = $this->lists(9);
        $this->load->view('admin/order/list_back',$data);
    }
    */
    //-------------------------------------------------------------------------

    public function info($id='')
    {
        $this->load->model('pay');
        $data = array();
        if($id)
        {
            $row = $this->order->get($id);
            if(!$row)
            {
                echo json_encode(array('code'=>'1001','msg'=>'订单不存在'));
                exit;
            }
            $data['order'] = $row;
            echo json_encode(array(
                'code'=>'1000',
                'data'=>$this->load->view('admin/order/detail',$data,true)
            ));
        }
        else
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
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
            if(!$this->order->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        echo json_encode($data);
    }

    public function change_price()
    {
        $post = $this->input->post();
        if(empty($post))
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '修改成功');
        
        if($post['id'] && $post['price'])
        {
            $row = array("price"=>$post['price']);
            if(!$this->order->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
            else
            {
                //记录订单日志
                $this->load->model('order_log');
                $this->load->model('order');

                $order = $this->order->get($post['id']);
                $user_id = $this->auth->user_id();
                $order_id = $post['id'];
                $info = "[".$this->auth->username()."]用户修改了总价为".$post['price'];
                $log = array("user_id"=>$user_id,"order_id"=>$order_id,"info"=>$info);
                $this->order_log->insert($log);
            }
        }
        else
        {
            $data['code'] = "1004";
            $data['msg'] = "参数错误";
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
        if($this->order->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

    public function cancel($id)
    {
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        $order = $this->order->get($id);
        if(!$order)
        {
            echo json_encode(array('code'=>'1004','msg'=>'订单不存在'));
            exit;
        }
        if($order->status!=='0')
        {
            echo json_encode(array('code'=>'1004','msg'=>'订单不能取消'));
            exit;
        }
        if(!$this->order->update(array('status'=>10),$id))
        {
            echo json_encode(array('code'=>'1001','msg'=>'订单取消失败'));
        }
        echo json_encode(array('code'=>'1000','msg'=>'订单取消成功','id'=>$id));
    }
}
/* End of file orders.php */
/* Location: ./app/controllers/admin/orders.php */