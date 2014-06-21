<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay_type extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('pay');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/pay/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->pay->all(array('orderby' =>'id asc'));
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/pay/datalist',$data,true);
        }
        else
        {
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/pay/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $data = array();
        if(!$id)
        {
            show_error('参数错误');
        }
        if($id)
        {
            $row = $this->pay->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
        }
        $this->load->view('admin/pay/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function update()
    {
        $post = $this->input->post();
        if(empty($post) || !$post['id'])
        {
            show_error('参数错误');
        }
        $data = array('code' => '1000', 'msg' => '');
        $this->load->library('form_validation');
        $pay = $this->pay->get($post['id']);
        if(in_array($pay->type, array('alipay','tenpay')))
        {
            $this->form_validation->set_rules('apikey', ' ', 'required|max_length[200]');

            if($this->form_validation->run() == FALSE)
            {
                $this->form_validation->set_error_delimiters('', '');
                $data['code'] = '1010';
                $error['apikey'] = form_error('apikey');
                $data['msg'] = $this->lang->line('error_msg');
                $data['error'] = $error;
                echo json_encode($data);                                    
                exit;
            }
        }
        
        $row = array(
            'apikey' => trim($post['apikey']),
            'secret' => trim($post['secret'])
        );
        if($post['id'])
        {
            if(!$this->pay->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->pay->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/pay_type';
        }
        echo json_encode($data);
    }

}
/* End of file pay_type.php */
/* Location: ./lms_app/controllers/admin/pay_type.php */