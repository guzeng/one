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
        if($status === '0')
        {
            $data['list'] = $this->order->all(array('status'=>'0'));
        }
        else if($status == '1')
        {
            $data['list'] = $this->order->all(array('status'=>'1'));
        }
        else if($status == '2')
        {
            $data['list'] = $this->order->all(array('status'=>'2'));
        }
        else if($status == '3')
        {
            $data['list'] = $this->order->all(array('status'=>'3'));
        }
        else if($status == '4')
        {
            $data['list'] = $this->order->all(array('status'=>'4'));
        }
        else if($status == '9')
        {
            $data['list'] = $this->order->all(array('status'=>'9'));
        }
        else if($status == '10')
        {
            $data['list'] = $this->order->all(array('status'=>'10'));
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

    public function send()
    {
        $this->list_type = 'return';
        $data['param'] = $this->order->get_param();//stripslashes
        $data['list'] = $this->lists(1);
        $this->load->view('admin/order/list_send',$data);
    }
    //-------------------------------------------------------------------------

    public function back()
    {
        $this->list_type = 'return';
        $data['param'] = $this->order->get_param();//stripslashes
        $data['list'] = $this->lists(9);
        $this->load->view('admin/order/list_back',$data);
    }
    //-------------------------------------------------------------------------

    public function info($id='')
    {
        if($id)
        {
            $row = $this->order->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/order/info',$data);
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
}
/* End of file orders.php */
/* Location: ./app/controllers/admin/orders.php */