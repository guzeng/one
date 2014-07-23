<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * users for this controller.
	 *
	 * @author alex liang
	 * 2013/5/11  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
		$this->list_type = '';
    }
	public function index()
	{
        $this->auth->check_login();
        $this->list_type = 'return';
        $data['list'] = $this->lists();
        $this->load->view('admin/user/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->user->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/user/datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/user/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $this->auth->check_login();
        if($id)
        {
            $row = $this->user->get($id);
            if(!$row)
            {
                show_404('',false);
            }
            $data['row'] = $row;
            $this->load->view('admin/user/edit',$data);
        }
        else{
            $this->load->view('admin/user/edit');
        }
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
        $this->form_validation->set_rules('username', ' ', 'required');
        $this->form_validation->set_rules('email', ' ', 'required|valid_email');
        $this->form_validation->set_rules('password', ' ', 'required|min_length[6]');
        $this->form_validation->set_rules('password_re', ' ', 'required|min_length[6]|matches[password]');
        $this->form_validation->set_rules('score', ' ', 'required|is_natural');
        $this->form_validation->set_rules('grade', ' ', 'required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['username'] = form_error('username');
            $error['email'] = form_error('email');
            $error['password'] = form_error('password');
            $error['password_re'] = form_error('password_re');
            $error['score'] = form_error('score');
            $error['grade'] = form_error('grade');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        $error = array();
        if($post['id'])
        {
            if($post['username'])
            {
                $where = array('username'=>$post['username'],'id !='=>$post['id']);
                if($this->user->exist($where))
                {
                    $error['username'] = '会员名已存在';
                }                
            }
            if($post['email'])
            {
                $where = array('email'=>$post['email'],'id !='=>$post['id']);
                if($this->user->exist($where))
                {
                    $error['email'] = '邮箱已存在';
                }                
            }
             if($post['phone'])
            {
                $where = array('phone'=>$post['phone'],'id !='=>$post['id']);
                if($this->user->exist($where))
                {
                    $error['phone'] = '手机号码已存在';
                }                
            }
        }
        else
        {
            if($post['username'])
            {
                $where = array('username'=>$post['username']);
                if($this->user->exist($where))
                {
                    $error['username'] = '会员名已存在';
                }
            }
            if($post['email'])
            {
                $where = array('email'=>$post['email']);
                if($this->user->exist($where))
                {
                    $error['email'] = '邮箱已存在';
                }
            }
            if($post['phone'])
            {
                $where = array('phone'=>$post['phone']);
                if($this->user->exist($where))
                {
                    $error['phone'] = '手机号码已存在';
                }
            }
            
        }
        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
            exit;
        }
        $row = array(
            'username' => $post['username'],
            'email' => $post['email'],
            'password' => $post['password'],
            'score' => $post['score'] != ''? $post['score'] : 0,
            'grade' => $post['grade'],
            'reference' => $post['reference'] != ''? $post['reference'] : 0,
            'phone' => $post['phone'],
            'telephone' => $post['telephone'],
            'post_code' => $post['post_code'],
            'area' => $post['area'] != ''? $post['area'] : 0,
            'address' => $post['address'],
            'qq' => $post['qq']
        );
        if($post['id'])
        {
            if(!$this->user->update($row,$post['id']))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else
        {
            if(!$this->user->insert($row))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
            }
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/Users';
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
        if($this->user->delete($id))
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
/* End of file Users.php */
/* Location: ./lms_app/controllers/admin/Users.php */