<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupons extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('coupon');
        $this->list_type = '';
    }
	public function index()
    {
        $this->auth->check_login();
        $data['list'] = $this->lists();
        return $this->load->view('admin/coupon/list',$data);
    }

    public function lists()
    {
        $data['list'] = $this->coupon->all();
        return $this->load->view('admin/coupon/datalist',$data,true);
    }

    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->coupon->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
            $this->load->view('admin/coupon/edit',$data);
        }
        $this->load->view('admin/coupon/edit');
    }
    //-------------------------------------------------------------------------

    public function delete($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->coupon->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

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
        $this->form_validation->set_rules('code', ' ', 'required');
        $this->form_validation->set_rules('value', ' ', 'required|natural');
        $this->form_validation->set_rules('use', ' ', 'required|natural');
        $this->form_validation->set_rules('expirse_from', ' ', 'required');
        $this->form_validation->set_rules('expirse_to', ' ', 'required');
         
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['code'] = form_error('code');
            $error['value'] = form_error('value');
            $error['use'] = form_error('use');
            $error['expirse_from'] = form_error('expirse_from');
            $error['expirse_to'] = form_error('expirse_to');
            $data['msg'] = "出错";
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
             if($post['code'])
            {
                $where = array('code'=>$post['code'],'id !='=>$post['id']);
                if($this->coupon->exist($where))
                {
                    $error['code'] = '编号已存在';
                }                
            }
        }
        else
        {
            if($post['code'])
            {
                $where = array('code'=>$post['code']);
                if($this->coupon->exist($where))
                {
                    $error['code'] = '编号已存在';
                }
            }
        }
        if($post['value']<0)
        {
            $error['value'] = '必须大于0';
        }
        if($post['use']<0)
        {
            $error['use'] = '必须大于0';
        }
        if(strtotime($post['expirse_from'])>=strtotime($post['expirse_to']))
        {
            $error['expirse_from'] = '有效期开始时间不能大于等于结束时间';
        }
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>"出错",'error'=>$error));
            exit;
        }
        $row = array(
            'code' => $post['code'],
            'value' => $post['value'],
            'use' => $post['use'],
            'type' => $post['type'],
            'expirse_from' => strtotime($post['expirse_from']),
            'expirse_to' => strtotime($post['expirse_to'])
        );

        if($post['id'])
        {
            if(!$this->coupon->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_failed'));
            }
        }
        else
        {
            if(!$this->coupon->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_failed'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/coupons';
        }
        echo json_encode($data);
    }
}

/* End of file Coupons.php */
/* Location: ./application/controllers/Coupons.php */