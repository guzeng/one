<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionnaires extends CI_Controller {

	/**
	 * questionnaires for this controller.
	 *
	 * @author alex
	 * 2013/4/30  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('questionnaire');
        $this->load->model('questionnaire_question');
        $this->load->model('questionnaire_option');
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
        $this->auth->check_login();
        $this->list_type = 'return';
        $data['param'] = $this->questionnaire->get_param();//stripslashes
        $data['list'] = $this->lists();
        $this->load->view('admin/questionnaire/list',$data);
	}
    //-------------------------------------------------------------------------

    public function lists()
    {
        $data['list'] = $this->questionnaire->all();
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/questionnaire/datalist',$data,true);
        }
        else
        {
            $this->auth->check_login_json();
            echo json_encode(array(
                'code' => '1000',
                'data' => $this->load->view('admin/questionnaire/datalist',$data,true)
            ));            
        }

    }
    //-------------------------------------------------------------------------

    public function add()
    {
        $this->auth->check_login();
        $data = array();
        $this->load->view('admin/questionnaire/add',$data);
    }
    //-------------------------------------------------------------------------

    public function edit($id='')
    {
        $this->auth->check_login();
        $id = trim(intval($id));
        $data = array();

        if($id)
        {
            $questionnaire = $this->questionnaire->get($id);

            if( ! $questionnaire)
            {
               show_404('',false);
            }
            $data['row'] = $questionnaire;

            $questions = $this->questionnaire_question->fetch_items(array('where' => 'questionnaire_id = '.$id));
            $options = $this->questionnaire_option->fetch_items(array('where' => 'questionnaire_id = '.$id));

            if(!empty($questions) && !empty($options))
            {
                foreach($questions as $key => $q)
                {
                    $list = array();
                    foreach($options as $k => $v)
                    {
                        if($q->id == $v->questionnaire_question_id)
                        {
                            $list[] = $v;
                        }
                    }
                    $q->options = $list;
                }
            }
            $data['question'] = $questions;
        }
        $this->load->view('admin/questionnaire/edit',$data);
    }
    //-------------------------------------------------------------------------

    public function create()
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

        if($this->form_validation->run() == FALSE)
        {
            $this->form_validation->set_error_delimiters('', '');
            $data['code'] = '1010';
            $error['title'] = form_error('title');
            $data['msg'] = $this->lang->line('error_msg');
            $data['error'] = $error;
            echo json_encode($data);                                    
            exit;
        }

        //标题唯一验证
        $error = array();
        $where = array('title'=>$post['title']);
        if($this->questionnaire->exist($where))
        {
            $error['title'] = '标题已存在';
        }

        if(!empty($error))
        {
            echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
            exit;
        }

        $row = array(
            'title' => $post['title'],
            'intro' => $post['intro'] ? $post['intro'] : '',
            'conclusion' => $post['conclusion'] ? $post['conclusion'] : '',
            'create_by' => $this->auth->user_id()
        );

        $insert_id = $this->questionnaire->insert($row);
        if(!$insert_id)
        {
            $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
        }
        if($data['code'] == '1000')
        {
            $data['goto'] = 'admin/questionnaires/edit/'.$insert_id;
            $row['id'] = $insert_id;
            $data['row'] = $row;
        }
        echo json_encode($data);
    }
    //-------------------------------------------------------------------------

    // public function update()
    // {
    //     $this->auth->check_login_json();
    //     $post = $this->input->post();
    //     if(empty($post))
    //     {
    //         show_error('参数错误');
    //     }
    //     $data = array('code' => '1000', 'msg' => '');
    //     $this->load->library('form_validation');
    //     $this->form_validation->set_rules('title', ' ', 'required|max_length[50]'); 
        
    //     if($this->form_validation->run() == FALSE)
    //     {
    //         $this->form_validation->set_error_delimiters('', '');
    //         $data['code'] = '1010';
    //         $error['title'] = form_error('title');
    //         $data['msg'] = $this->lang->line('error_msg');
    //         $data['error'] = $error;
    //         echo json_encode($data);                                    
    //         exit;
    //     }

    //     $error = array();
    //     if($post['id'])
    //     {
    //         $where = array('title'=>$post['title'],'id !='=>$post['id']);
    //         if($this->questionnaire->exist($where))
    //         {
    //             $error['title'] = '标题已存在';
    //         }
    //     }
    //     else
    //     {
    //         $where = array('title'=>$post['title']);
    //         if($this->questionnaire->exist($where))
    //         {
    //             $error['title'] = '标题已存在';
    //         }
    //     }
    //     if(!empty($error))
    //     {
    //         echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
    //         exit;
    //     }
    //     $row = array(
    //         'title' => $post['title'],
    //         'intro' => $post['intro'],
    //         'conclusion' => $post['conclusion'],
    //         'status' => $post['status'],
    //         'create_by' => $this->auth->user_id()
    //     );

    //     if($post['id'])
    //     {
    //         if(!$this->questionnaire->update($row,$post['id']))
    //         {
    //             $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
    //         }
    //     }
    //     else
    //     {
    //         if(!$this->questionnaire->insert($row))
    //         {
    //             $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
    //         }
    //     }
    //     if($data['code'] == '1000' && $post['status'] == 1)     //发布才需要跳转
    //     {
    //         $data['goto'] = 'admin/questionnaires';
    //     }
    //     echo json_encode($data);
    // }
    public function change_status($id,$status = 1)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($status == 1)
        {
            $row = $this->questionnaire_question->fetch_items(array('type'=>'count(id) as count','where'=>array('questionnaire_id'=>$id)));
            if($row)
            {
                if($row[0]->count == 0)
                {
                   $data = array('code'=>'1001','msg'=>'发布失败，至少需要编辑一个问卷问题','data'=>array('id'=>$id));
                    echo json_encode($data);
                    exit;
                }
            }
        }
        if($this->questionnaire->update(array("status"=>$status),$id))
        {
            $data = array('code'=>'1000','msg'=>'操作成功','data'=>array('id'=>$id));
            $data['goto'] = 'admin/questionnaires';
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'发布失败');
        }

        echo json_encode($data);
        exit;
    }

    public function delete($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->questionnaire->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

    //删除问题
    public function delete_ques($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->questionnaire_question->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

    //删除选项
    public function delete_option($id)
    {
        $this->auth->check_login_json();
        if(!$id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }
        if($this->questionnaire_option->delete($id))
        {
            $data = array('code'=>'1000','msg'=>'删除成功','data'=>array('id'=>$id));
        }
        else
        {
            $data = array('code'=>'1001','msg'=>'删除失败');
        }
        echo json_encode($data);
    }

    //问卷、问题和选项的保存与更新
    public function update()
    {
        $this->auth->check_login_json();

        $params = $this->uri->uri_to_assoc(4);
        $data = array('code' => 1000,'msg' => '' );

        $name = $this->input->post('name')!='' ? trim($this->input->post('name')) : 
            (isset($params['name']) ? urldecode(trim($params['name'])) : '');

        $value = $this->input->post('value')!='' ? trim($this->input->post('value')) : 
            (isset($params['value']) ? urldecode(trim($params['value'])) : '');

        $conclusion = $this->input->post('conclusion')!='' ? trim($this->input->post('conclusion')) : 
            (isset($params['conclusion']) ? urldecode(trim($params['conclusion'])) : '');

        $title = $this->input->post('title')!='' ? trim($this->input->post('title')) : 
            (isset($params['title']) ? urldecode(trim($params['title'])) : '');

        $type = $this->input->post('type')!='' ? trim($this->input->post('type')) : 
            (isset($params['type']) ? urldecode(trim($params['type'])) : '');

        $questionnaire_id = $this->input->post('questionnaire_id')!='' ? trim($this->input->post('questionnaire_id')) : 
            (isset($params['questionnaire_id']) ? urldecode(trim($params['questionnaire_id'])) : '');

        $question_id = $this->input->post('question_id')!='' ? trim($this->input->post('question_id')) : 
            (isset($params['question_id']) ? urldecode(trim($params['question_id'])) : '');

        $option_id = $this->input->post('option_id')!='' ? trim($this->input->post('option_id')) : 
            (isset($params['option_id']) ? urldecode(trim($params['option_id'])) : '');

        $update_type = $this->input->post('update_type')!='' ? trim($this->input->post('update_type')) : 
            (isset($params['update_type']) ? urldecode(trim($params['update_type'])) : '');

        $create_by = $this->auth->user_id();

        if(!$update_type && !$name && $value && $questionnaire_id)
        {
            echo json_encode(array('code'=>'1003','msg'=>'参数错误'));
            exit;
        }

        $row = array(
                $name => $value
            );

        //问卷更新
        if($update_type == 'qn')
        {
            if($name == 'title')//标题唯一验证
            {
                $where = array('title'=>$value,'id !='=>$questionnaire_id);
                if($this->questionnaire->exist($where))
                {
                    $error['title'] = '问卷标题已存在';
                }
            }
            if(!empty($error))
            {
                echo json_encode(array('code'=>'1010','msg'=>$this->lang->line('error_msg'),'error'=>$error));
                exit;
            }

            if(!$this->questionnaire->update($row,$questionnaire_id))
            {
                $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
            }
        }
        else if($update_type == 'question')
        {
            if($question_id)
            {
                if(!$this->questionnaire_question->update($row,$question_id))
                {
                    $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
                }
            }
            else
            {
                $row['type'] = $type;
                $row['questionnaire_id'] = $questionnaire_id;

                $insert_ques_id = $this->questionnaire_question->insert($row);
                if(!$insert_ques_id)
                {
                    $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
                    echo json_encode($data);
                    exit;
                }

                $row['questionnaire_question_id'] = $insert_ques_id;
                unset($row['type']);
                $option_id = array();
                //多选题型要插入四条记录
                if($type == 1)
                {
                    $row['title'] = "选项1";
                    $insert_id1 = $this->questionnaire_option->insert($row);
                    $row['title'] = "选项2";
                    $insert_id2 = $this->questionnaire_option->insert($row);
                    $row['title'] = "选项3";
                    $insert_id3 = $this->questionnaire_option->insert($row);
                    $row['title'] = "选项4";
                    $insert_id4 = $this->questionnaire_option->insert($row);
                    $option_id = array($insert_id1,$insert_id2,$insert_id3,$insert_id4);
                }
                else
                {
                    $row['title'] = "选项1";
                    $insert_id1 = $this->questionnaire_option->insert($row);
                    $row['title'] = "选项2";
                    $insert_id2 = $this->questionnaire_option->insert($row);
                    $option_id = array($insert_id1,$insert_id2);
                }

                if(!$insert_id1 && $insert_id2)
                {
                    $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
                    echo json_encode($data);
                    exit;
                }
                else
                {
                    $row['ques_title'] = $value;
                    $row['type'] = $type;
                    $row['option_id'] = $option_id;
                }
            }
        }
        else if($update_type == 'option')
        {
            if($option_id)
            {
                if(!$this->questionnaire_option->update($row,$option_id))
                {
                    $data = array('code'=>'1001','msg'=>$this->lang->line('update_fail'));
                }
            }
            else
            {
                unset($row['type']);
                $row['questionnaire_question_id'] = $question_id;
                $row['questionnaire_id'] = $questionnaire_id;

                $insert_id = $this->questionnaire_option->insert($row);
                if(!$insert_id)
                {
                    $data = array('code'=>'1001','msg'=>$this->lang->line('add_fail'));
                    echo json_encode($data);
                    exit;
                }
                else
                {
                    $row['type'] = $type;
                    $row['option_id'] = $insert_id;
                }
            }
        }
        $data['row'] = $row;
        echo json_encode($data);
        exit;
    }

    //结果分析
    public function result($id = '')
    {
        $this->auth->check_login();

        $questionnaire = $this->questionnaire->get($id);
        $data = array();

        if ( ! $questionnaire)
        {
            show_404('',false);
        }
        $data['questionnaire'] = $questionnaire;

        $questions = $this->questionnaire_question->fetch_items(array('where' => 'questionnaire_id = '.$id));
        $options = $this->questionnaire_option->fetch_items(array('where' => 'questionnaire_id = '.$id));

        if(!empty($questions) && !empty($options))
        {
            foreach($questions as $k => $q)
            {
                $list = array();

                foreach($options as $k => $o)
                {
                    if($q->id == $o->questionnaire_question_id)
                    {
                        $list[] = $o;
                    }
                }
                $q->options = $list;
            }
        }

        $data['questions'] = $questions;

        $this->load->view('admin/questionnaire/result', $data);
    }
    //-------------------------------------------------------------------------

}
/* End of file questionnaires.php */
/* Location: ./lms_app/controllers/admin/questionnaires.php */