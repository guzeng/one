<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * course for this controller.
	 *
	 * @author varson
	 * 2013/3/21  
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('product');
        $this->load->model('product_category');
		$this->list_type = '';
    }
	public function index()
	{
        $this->list_type = 'return';
        $category = $this->product_category->fetch_all(array('orderby' =>'parent_id asc,id asc'));
        $data['category_list'] = $category;
        $data['list_view'] = $this->lists();
		$this->load->view('admin/product-list',$data);
	}
    //-------------------------------------------------------------------------
	public function lists()
	{
        if($this->list_type == '')
        {
        	//验证登录及权限
        }

        
        $data['param'] = $this->product->get_param();//stripslashes
        //$data['code'] = stripslashes($code);
		//$data['name'] = stripslashes($name);
        //$data['category_list'] = $this->product_category->tree();
        //$data['list'] = $list;
        //$data['page_url'] = rtrim($base_url,'/').'/page/'.$page;
        if($this->list_type == 'return')
        {
            return $this->load->view('admin/product-list-view',$data,true);
        }
        else
        {
            echo json_encode(array('code'=>'1000','data'=>$this->load->view('admin/product-list-view',$data, true)));
            exit;
        }
	}
    //-------------------------------------------------------------------------

	public function update()
	{
        $this->auth->check_login_json();
        $this->auth->check_permission_json();
		@set_time_limit(300);
		$data = array(
			'code' => '1000', //成功
			'msg' => ''//成功为空);
		);
		//课程详情参数
		$id = trim($this->input->post('id',TRUE));
		if($id)
		{
			$course = $this->course->get($id);
			if(!$course)
			{
				$data['code'] = '1004';
				$data['msg'] = $this->lang->line('param_incorrect');
				echo json_encode($data);
				exit;
			}
			if(  $this->auth->user_id() != $course ->create_user_id && !$this->auth->is_super_admin() )//判断是否是该课程管理员
			{
	            $data['code'] = '1003';
	            $data['msg'] = $this->lang->line('permission_denied');
	            echo json_encode($data);
	            exit;
        	}
			if($course->status == 1 && $course->chose_number > 0)
			{
				$data['code'] = '1010';
				$data['msg'] = $this->lang->line('course_chosed_so_cannot_edit');
				echo json_encode($data);
				exit;
			}
		}
		else
		{
			if($this->course->get_count() >= MAX_COURSE)
        	{
        		$data['code'] = '1010';
        		$data['msg'] = $this->lang->line('reach_max_courses');
        		echo json_encode($data);
        		exit;
        	}
		}

		$this->load->model('question');
		$this->load->model('courseware');
        $this->load->model('scorm');
        $this->load->model('courseware_sco');
		$this->load->helper('file');

		$name = trim($this->input->post('name',TRUE));
		$code = trim($this->input->post('code',TRUE));
		$category = trim($this->input->post('category',TRUE));
		$validity_date = trim($this->input->post('validity_date',true));
		$complete = trim($this->input->post('complete',TRUE));
		$lecturer = trim($this->input->post('lecturer',TRUE));
		$intro = trim($this->input->post('intro',true));

	 	//考试设置参数
		$answer_time = trim($this->input->post('answer_time',true));
		$answer_number = trim($this->input->post('answer_number',true));
		$pass_score = trim($this->input->post('pass_score',true));
		$single_score = trim($this->input->post('single_score',TRUE));
		$single_num = trim($this->input->post('single_num',TRUE));
		$multiple_score = trim($this->input->post('multiple_score',TRUE));
		$multiple_num = trim($this->input->post('multiple_num',TRUE));
		$judge_score = trim($this->input->post('judge_score',TRUE));
		$judge_num = trim($this->input->post('judge_num',TRUE));
		$exam_intro = trim($this->input->post('exam_intro',TRUE));
		$show_answer = trim($this->input->post('show_answer',true));
		if(!$show_answer)
		{
			$show_answer = 0;
		}
 		$active_status = trim($this->input->post('active_status',TRUE));//是否直接发布
		//表单验证
		$this->load->library('form_validation');

		$error = array();
		$total_score = (int)$single_score*(int)$single_num+(int)$multiple_score*(int)$multiple_num+(int)$judge_score*(int)$judge_num;

		$this->form_validation->set_rules('code', ' ' , 'max_length[20]');
		$this->form_validation->set_rules('name', ' ', 'required|max_length[30]'); //$this->lang->line('coursename')
    	$this->form_validation->set_rules('validity_date', ' ', 'is_natural|greater_than[-1]|less_than[1000]');//$this->lang->line('course_eff_day')
    	$this->form_validation->set_rules('lecturer', ' ', 'max_length[30]'); //$this->lang->line('lecturer')
    	//$this->form_validation->set_rules('intro', ' ', 'max_length_no_html[1000]'); //$this->lang->line('intro')
    	if(isset($complete) && $complete > 1)
    	{
	    	$this->form_validation->set_rules('answer_time',' ', 'required|is_natural|greater_than[0]|less_than[1000]');
	    	$this->form_validation->set_rules('answer_number',' ', 'required|is_natural|greater_than[-1]|less_than[100]');
	    	$this->form_validation->set_rules('pass_score', ' ', 'required|is_natural|greater_than[-1]|less_than[10000]');
			$this->form_validation->set_rules('single_score', strtolower($this->lang->line('score')), 'is_natural|less_than[100]');
			$this->form_validation->set_rules('single_num', strtolower($this->lang->line('amount')), 'is_natural|less_than[1000]');
			$this->form_validation->set_rules('multiple_score', strtolower($this->lang->line('score')), 'is_natural|less_than[100]');
			$this->form_validation->set_rules('multiple_num', strtolower($this->lang->line('amount')), 'is_natural|less_than[1000]');
			$this->form_validation->set_rules('judge_score', strtolower($this->lang->line('score')), 'is_natural|less_than[100]');
			$this->form_validation->set_rules('judge_num', strtolower($this->lang->line('amount')), 'is_natural|less_than[1000]');

    		//$this->form_validation->set_rules('exam_intro', ' ', 'max_length_no_html[1000]'); //$this->lang->line('intro')
			if($total_score <= 0)
			{
				$error['total_score'] = $this->lang->line('total_score_less_than_0');
			}
			else if($total_score < $pass_score)
			{
				$error['total_score'] = $this->lang->line('total_score_less_than_passscore');
			}		
    	}

    	//课件上传后未保存的表单
    	$courseware_name = trim($this->input->post('courseware_name',true));
    	$courseware_learning_time = trim($this->input->post('courseware_learning_time',true));
        $learning_time_sec = trim($this->input->post('courseware_learning_time_sec',true));
        $spend_time = trim($this->input->post('spend_time',true));
    	$courseware_type = trim($this->input->post('courseware_type',true));
		$courseware_file_name = trim($this->input->post('courseware_file_name',true));
		$courseware_no_store = $this->input->post('courseware_no_store',true);
		$courseware_no_store_title = $this->input->post('courseware_no_store_title',true);
		$courseware_no_store_learning_time = $this->input->post('courseware_no_store_learning_time',true);
        $courseware_no_store_learning_time_sec = $this->input->post('courseware_no_store_learning_time_sec',true);
		$courseware_no_store_type = $this->input->post('courseware_no_store_type',true);
		$courseware_no_store_file_name = $this->input->post('courseware_no_store_file_name',true);
        $courseware_no_store_spend_time = $this->input->post('courseware_no_store_spend_time',true);


		$question_id = $this->input->post('question_id',true);//未分配到课程下的试题

    	if($courseware_name)
    	{
			$this->form_validation->set_rules('courseware_name', '', 'max_length[30]');	   
    	}
    	if($courseware_learning_time)
    	{
			$this->form_validation->set_rules('courseware_learning_time', '', 'is_natural|max_length[5]');	   
    	}
        if($learning_time_sec)
        {
            $this->form_validation->set_rules('courseware_learning_time_sec', ' ', 'is_natural|max_length[5]'); 
        }

		if($this->form_validation->run() == FALSE)
		{
			$this->form_validation->set_error_delimiters('', '');
			$error['code'] = form_error('code');
			$error['name'] = form_error('name');
			$error['validity_date'] = form_error('validity_date');
			$error['lecturer'] = form_error('lecturer');
			$error['intro'] = form_error('intro');
			$error['answer_time'] = form_error('answer_time');
			$error['answer_number'] = form_error('answer_number');
			$error['pass_score'] = form_error('pass_score');
			$error['single_score'] = form_error('single_score');
			$error['single_num'] = form_error('single_num');
			$error['multiple_score'] = form_error('multiple_score');
			$error['multiple_num'] = form_error('multiple_num');
			$error['judge_score'] = form_error('judge_score');
			$error['judge_num'] = form_error('judge_num');
			$error['exam_intro'] = form_error('exam_intro');
		} 
		if(!isset($error['name']))//名称的其它验证已通过时，验证是否重复
		{
			$name = addslashes($name);
		    $check_name = array(
				'type' => 'count(id) as count',
				'num' => 1
			);
			if(isset($id)&& !empty($id))
			{
				$check_name['where'] = "name ='".$name."' and id != '".$id."' and status != '2'";
			}
			else
			{                       	
				$check_name['where'] =  "name = '".$name."'  and status != '2'";
			}
			$course_name = $this->course->fetch_items($check_name);
			if($course_name[0]->count > 0)
			{ 	
				$error['name'] = $this->lang->line('course_name_is_exist');
			} 			
		}
		
		//判断code是否有相同的
		if(!isset($error['code']) && $code)
		{
			$check_course_code = array(
				'type' =>'count(id) as count',
				'num' => 1
			);
			if(isset($id)&& !empty($id))
			{
				$check_course_code['where'] = "code = '".$code."' and status != '2' and id != '".$id."' ";
			}
			else
			{                       	
				$check_course_code['where'] =  "code = '".$code."' and status != '2'";
			}
			$is_exist = $this->course->fetch_items($check_course_code);
			if($is_exist[0]->count > 0)
			{
			    $error['code'] = $this->lang->line('code_is_exist');
			}					
		}
	 	if(!empty($error))
	 	{
	 		$data['code'] = '1010';
	 		$data['msg'] = $this->lang->line('submit_error');
			$data['error'] = $error;
			echo json_encode($data);                                    
			exit;
	 	}

	 	/* 直接发布时，验证课件及题目是否足够*/

	 	if($active_status == 1 || (isset($course) && $course->status==1))
	 	{
			$single_request = $single_num!=''?$single_num:0;
			$multiple_request = $multiple_num!=''?$multiple_num:0;
			$judge_request = $judge_num!=''?$judge_num:0;

	 		if($id && isset($course))
	 		{
	 			$_courseware_num = $this->courseware->fetch_items(array('where'=>array('course_id'=>$id),'type'=>'count(id) as count','num'=>1));
	 			if($_courseware_num[0]->count == 0 && (strlen($courseware_file_name)!=36 || !$courseware_name) )
	 			{
	 				$data['code'] = '1010';
					$data['msg'] = $this->lang->line('cannot_modify_course_status_2');
					echo json_encode($data);
					exit;
	 			}
	 			if($complete > 1)
	 			{
		          	$_questions = $this->question->fetch_items(array(
		  				'type'=>'type, count(id) as count',
		  				'groupby' => 'type' ,
						'orderby' => 'type asc' ,
					    'where' => "course_id ='".$id."' and answer != '' "
					));						
					//没有对应类型的情况
					$type_array = array();  //题库有的类型
					if(!empty($_questions))
					{
						foreach($_questions as $question){
							$type_array[$question->type]= $question->count;
						}						
					}
					$_question_msg = array(); 
					$check = false; 			
					if($single_request > 0 ){ //没有相关类型的题目
						if(!array_key_exists('1', $type_array))
						{
							$_question_msg[] = sprintf($this->lang->line('single_num_1'), $single_request);
							$check = true;						
						}
						else if($single_request > $type_array['1'])
						{
							$_question_msg[] = sprintf($this->lang->line('single_num_1'), ($single_request - $type_array['1']));
							$check = true;	
						}
					} 		
					if($multiple_request > 0 ){ //没有相关类型的题目
						if(!array_key_exists('2', $type_array))
						{
							$_question_msg[] = sprintf($this->lang->line('multiple_num_1'), $multiple_request);
							$check = true;
						}
						else if($multiple_request > $type_array['2'])
						{
							$_question_msg[] = sprintf($this->lang->line('multiple_num_1'), ($multiple_request - $type_array['2']));
							$check = true;	
						}
					} 	
					if($judge_request > 0 ){ //没有相关类型的题目
						if(!array_key_exists('3', $type_array))
						{
							$_question_msg[] = sprintf($this->lang->line('judge_num_1'), $judge_request);
							$check = true;						
						}
						else if($judge_request > $type_array['3'])
						{
							$_question_msg[] = sprintf($this->lang->line('judge_num_1'), ($judge_request - $type_array['3']));
							$check = true;	
						}
					}
					if($check)
					{
						$data['code'] = '1004';
						$data['msg'] =  implode(' , ', $_question_msg); 
						echo json_encode($data);
	          			exit;
					}
	 			}
	 		}
	 		else//新建课程时验证
	 		{
	 			if((!$courseware_no_store || empty($courseware_no_store)) && (strlen($courseware_file_name)!=36 || !$courseware_name))
	 			{
	 				$data['code'] = '1010';
	 				$data['msg'] = $this->lang->line('cannot_modify_course_status_2');
	 				echo json_encode($data);
	 				exit;
	 			}
	 			if($complete > 1)
	 			{
					if(!$question_id)
					{
		          		$data['code'] = '1010';
		          		$data['msg'] = $this->lang->line('cannot_modify_exam_status_2');
		          		echo json_encode($data);
		          		exit;
					}
					$_questions = $this->question->get_by_ids($question_id);
		          	if(empty($_questions))//没有题库
		          	{  
		          		$data['code'] = '1010';
		          		$data['msg'] = $this->lang->line('cannot_modify_exam_status_2');
		          		echo json_encode($data);
		          		exit;
		          	}
		          	$_have_single = $_have_multi = $_have_judge = 0;//各类型题目数量
		          	foreach($_questions as $ques)
		          	{
		          		if($ques->answer != '')
		          		{
			          		switch ($ques->type) {
			          			case '1':
			          				$_have_single++;
			          				break;
			          			case '2':
			          				$_have_multi++;
			          				break;
			          			case '3':
			          				$_have_judge++;
			          				break;
			          		}	          			
		          		}
		          	}
					$check = false;
			        if($single_request > $_have_single){
	  					$question_error_msg .=   sprintf($this->lang->line('single_num_1'), (intval($single_request)-intval($_have_single)));
	  					$check = true;
					}
			       	if($multiple_request > $_have_multi){	
	  					$question_error_msg .=  sprintf($this->lang->line('multiple_num_1'), (intval($multiple_request)-intval($_have_multi)));
	  					$check = true;
					}
			        if($judge_request > $_have_judge){
	  					$question_error_msg .=  sprintf($this->lang->line('judge_num_1'), (intval($judge_request)-intval($_have_judge)));
	  					$check = true;
					}
					if($check)
					{   
						$data['code'] = '1004';
						$data['msg']  =  $question_error_msg;
						echo json_encode($data);
	          			exit;
					}	 				
	 			}
	 		}
	 	}

	 	/* 直接发布验证结束 */

		$param = array(
			'name' => stripslashes($name),
			'category_id' => $category,
			'admin_id' => 0,
			'complete' => $complete,
			'lecturer' => $lecturer,
	     	'intro' =>  trim($intro),
	        'validity_date' => $validity_date !=''? $validity_date :0
		);
		$log = array();
		$log_param = array('object_name'=>$param['name']);

		if($code)
		{
			$param['code'] = $code;
		}

		if($id && isset($course))
		{
			if(!$code)
			{
				$param['code'] =  str_pad($id,4,'0',STR_PAD_LEFT); 
			}
			if(!$this->course->update($param,$id))
			{
				$data['msg'] = $this->lang->line('update_failed');
				$data['code'] = '1001';
				echo json_encode($data);
				exit;
			}
			else
			{
				$data['msg'] = $this->lang->line('update_success');
				$course_id = $id;
			}
			$log_param['type'] = 'update';
			if($course->name != $param['name'])
			{
				$log[] = $this->lang->line('coursename').$this->lang->line('colon').$course->name.'=>'.$name;
			}
			else
			{
				$log[] = $this->lang->line('coursename').$this->lang->line('colon').$name;
			}
		}
		else 
		{
            $param['status'] = 0;
	     	$param['create_user_id'] = $this->auth->user_id();
			$course_id = $this->course->insert($param);
			if(!$course_id)
			{
				$data['msg'] = $this->lang->line('failed');   
				$data['code'] = '1001';
				echo json_encode($data);
				exit;
			}
			else
			{
				if(!$code)
				{        
			   		$code =  str_pad($course_id,4,'0',STR_PAD_LEFT); 
			   		$this->course->update(array('code'=>$code),$course_id);
				}
				$data['msg'] = $this->lang->line('add_success');
			}
			$log_param['type'] = 'add';
			$log[] = $this->lang->line('coursename').$this->lang->line('colon').$name;
		}

		//暂存及课程上传目录
		$_temp_folder 	= upload_folder('temp');
		$_course_folder = upload_folder('course');

		// 课程图片 
		$course_pic_path = $this->input->post('course_pic_path', true);
		if($course_pic_path)
		{
	        $this->load->library('image_lib');
		    $course_folder = $_course_folder.'/'.course_dir($course_id);
		    create_folder($course_folder);
	        $config_resize['image_library'] = 'gd2';
	        $config_resize['source_image'] = $_temp_folder.'/'.$course_pic_path;
	        $config_resize['new_image'] = rtrim($course_folder,'/').'/cover.png';
	        $config_resize['create_thumb'] = false;
	        $config_resize['maintain_ratio'] = TRUE;
	        $config_resize['width'] = 540;
	        $config_resize['height'] = 300;
	        $this->image_lib->initialize($config_resize); 
	        $this->image_lib->resize();
	        $config_resize['new_image'] = rtrim($course_folder,'/').'/cover_thumb.png';
	        $config_resize['width'] = 270;
	        $config_resize['height'] = 150;
	        $this->image_lib->initialize($config_resize); 
	        $this->image_lib->resize();
	        @unlink($config_resize['source_image']);
		}


		
		$log[] = $this->lang->line('coursecode').$this->lang->line('colon').(isset($param['code'])&&$param['code']!='' ? $param['code'] : $code);
		if($category)
		{
			$log[] = $this->lang->line('course_category').$this->lang->line('colon').$this->category->get($category)->name;
		}
		$log[] = $this->lang->line('effectiveday').$this->lang->line('colon').$param['validity_date'].$this->lang->line('day');
		$log[] = $this->lang->line('complete_condition').$this->lang->line('colon').$this->lang->line('complete_condition_'.$complete);
		$log[] = $this->lang->line('teacher').$this->lang->line('colon').$lecturer;
		$log[] = $this->lang->line('introduction').$this->lang->line('colon').$param['intro'];

		//设置考试

		$param_exam = array(
			'answer_time' => $answer_time !=''?$answer_time:90,
			'answer_number' => $answer_number!=''?$answer_number:2,
			'pass_score' => $pass_score != ''?$pass_score:60,
	     	'intro' =>  $exam_intro,
			'show_answer'=>$show_answer,
			'single_score' => $single_score!=''?$single_score:0,
			'single_num' => $single_num!=''?$single_num:0,
			'multiple_score' => $multiple_score!=''?$multiple_score:0,
			'multiple_num' => $multiple_num!=''?$multiple_num:0,
			'judge_score' => $judge_score!=''?$judge_score:0,
			'judge_num' => $judge_num!=''?$judge_num:0,
			'total_score' => $total_score
		);
		if(isset($complete) && $complete == 1)
		{
			$this->course_exam->delete_by_course($course_id);
		}
		else
		{
			$course_exam = $this->course_exam->get_by_course($course_id);
			if($course_exam) //更新
			{
				if(!$this->course_exam->update($param_exam,$course_exam->id))
				{
					$data['msg'] = $this->lang->line('examination_setting') . $this->lang->line('update_failed');
					$data['code'] = '1001';
					echo json_encode($data);                                    
					exit;
				}
				else
				{
					$data['msg'] = $this->lang->line('examination_setting') . $this->lang->line('update_success');
				}
			}
			else 
			{    
				$param_exam['course_id'] = $course_id;
				if(!$this->course_exam->insert($param_exam))
				{
					$data['msg'] = $this->lang->line('examination_setting') . $this->lang->line('add_failed');   
					$data['code'] = '1001';
					echo json_encode($data);                                    
					exit;
				}
				else
				{
					$data['msg'] = $this->lang->line('examination_setting') . $this->lang->line('add_success');
				}
			}	
			$log[] = $this->lang->line('answer_time').$this->lang->line('colon').$param_exam['answer_time'].$this->lang->line('minutes');
			$log[] = $this->lang->line('allow_times').$this->lang->line('colon').$param_exam['answer_number'].$this->lang->line('ci');
			$log[] = $this->lang->line('pass_score').$this->lang->line('colon').$param_exam['pass_score'].$this->lang->line('point');
			if($param_exam['single_num']>0)
			{
				$log[] = $this->lang->line('single_type').$this->lang->line('colon').$param_exam['single_num'].$this->lang->line('question_num').'*'.$param_exam['single_score'].$this->lang->line('point_for_num');
			}
			if($param_exam['multiple_num']>0)
			{
				$log[] = $this->lang->line('multi_type').$this->lang->line('colon').$param_exam['multiple_num'].$this->lang->line('question_num').'*'.$param_exam['multiple_score'].$this->lang->line('point_for_num');
			}
			if($param_exam['judge_num']>0)
			{
				$log[] = $this->lang->line('judge_type').$this->lang->line('colon').$param_exam['judge_num'].$this->lang->line('question_num').'*'.$param_exam['judge_score'].$this->lang->line('point_for_num');
			}
			$log[] = $param_exam['show_answer'] ? $this->lang->line('show_answer_after_exam') : '';
			$log[] = $this->lang->line('introduction').$this->lang->line('colon').$param_exam['intro'];
		}

		//课件操作
		$log_courseware = array();

		if($courseware_no_store)
		{
			
			foreach($courseware_no_store as $w => $ware)
			{
				$courseware_row = array(
					'title' => $courseware_no_store_title[$w],
					'learning_time' => intval($courseware_no_store_learning_time[$w])*60+intval($courseware_no_store_learning_time_sec[$w]),
					'type' => $courseware_no_store_type[$w],
					'file_name' => $courseware_no_store_file_name[$w],
					'course_id' => $course_id,
                    'spend_time' => intval($courseware_no_store_spend_time[$w])
				);
				$courseware_id = $this->courseware->insert($courseware_row);
				$suffix_name = get_file_sufix($ware);      			//获取后缀名
				$prefix_name = get_file_prefix($ware);				  //获取前缀

				if($courseware_id)
				{ 
	            	$dest_dir = $_course_folder.'/'.rtrim(file_save_dir($course_id),'/').'/'.$courseware_id;
	            	$file_path = $_temp_folder.'/'.$ware;
	            	//课件是zip的需要解压
	            	if ($suffix_name == '.zip')
	            	{
		            	$size = unzip($file_path,$dest_dir);	//解压到正常目录下
		            	if($size)
		            	{
                            //解析清单文件，将resource存入
                            $scorm_resource = $this->scorm->parse($dest_dir.'/imsmanifest.xml');
		            		$this->courseware->update(array('size'=>$size,'course_id'=>$course_id,'version'=>$scorm_resource['version']),$courseware_id);
		                	@unlink($_temp_folder.'/'.$ware);
		                	delete_dir($_temp_folder.'/'.$prefix_name);//删除目录
		                	$data['size'] = round($size/1024/1024,2);
		                	$log_courseware[] = $courseware_row['title'];

                            if(!empty($scorm_resource['scos']))
                            {
                                foreach ($scorm_resource['scos'] as $key => $value) {
                                    if(isset($value['href']) && isset($value['identifierref']))
                                    {
                                        $this->courseware_sco->insert(array(
                                            'course_id'         =>  $course_id,
                                            'courseware_id'     =>  $courseware_id,
                                            'identifier'        =>  isset($value['identifier'])?$value['identifier']:'',
                                            'parent_identifier' =>  isset($value['parent_identifier'])?$value['parent_identifier']:'',
                                            'identifierref'     =>  isset($value['identifierref'])?$value['identifierref']:'',
                                            'href'              =>  isset($value['href'])?$value['href']:''
                                        ));                                        
                                    }
                                }
                            }
		            	}					
		            }
		            else if($suffix_name == '.flv' || $suffix_name == '.mp4' || $suffix_name == '.webm' || $suffix_name == '.ogg')	//视频格式处理
		            {
		            	$size = copy2dest($file_path, $dest_dir, $ware, $suffix_name);
    					if($size)
		            	{
		            		$this->courseware->update(array('size'=>$size,'course_id'=>$course_id),$courseware_id);
		                	@unlink($file_path);							//删除视频
		                	$data['size'] = round($size/1024/1024,2);
		                	$log_courseware[] = $courseware_row['title'];
		            	}
		            }
		            else     //其他格式处理
		            {
		            	$file_path2 = $_temp_folder.'/'.$prefix_name.'.pdf';
		            	$file_path3 = $_temp_folder.'/'.$prefix_name.'.swf';
		            	
		            	//$size = copy2dest($file_path2, $dest_dir, $ware, '.pdf');
		            	$size = copy2dest($file_path, $dest_dir, $ware, $suffix_name);//复制源文件
		            	copy2dest($file_path3, $dest_dir, $ware, '.swf');
		            	
    					if($size)
		            	{
		            		$this->courseware->update(array('size'=>$size,'course_id'=>$course_id),$courseware_id);
		            		if($file_path != $file_path2)
		            		{
								@unlink($file_path);							//删除office	
		            		}
		            			
		                		@unlink($file_path2);							//删除pdf
		                		@unlink($file_path3); 							//删除swf
		                	$data['size'] = round($size/1024/1024,2);
		                	$log_courseware[] = $courseware_row['title'];
		            	}
		            }
				}
			}
			$update_course_times = true;
		}
		
		if(strlen($courseware_file_name)==36 && $courseware_name)// && $courseware_learning_time
		{
            $file_path = $_temp_folder.'/'.$courseware_file_name;
            if(file_exists($file_path))
            {
                $courseware_row = array(
                    'title' => $courseware_name,
                    'learning_time' => intval($courseware_learning_time)*60+intval($learning_time_sec),
                    'type' => $courseware_type,
                    'file_name' => $courseware_file_name,
                    'course_id' => $course_id,
                    'spend_time' => $spend_time
                );
                $suffix_name = get_file_sufix($courseware_file_name);               //获取后缀名
                $prefix_name = get_file_prefix($courseware_file_name);                //获取前缀
                $courseware_id = $this->courseware->insert($courseware_row);

                if($courseware_id)
                {
                    $dest_dir = $_course_folder.'/'.rtrim(file_save_dir($course_id),'/').'/'.$courseware_id;
                    
                    //课件是zip的需要解压
                    if ($suffix_name == '.zip')
                    {
                        $size = unzip($file_path,$dest_dir);
                        if($size)
                        {
                            //解析清单文件，将resource存入
                            $scorm_resource = $this->scorm->parse($dest_dir.'/imsmanifest.xml');
                            $this->courseware->update(array('size'=>$size,'course_id'=>$course_id,'version'=>$scorm_resource['version']),$courseware_id);
                            @unlink($_temp_folder.'/'.$courseware_file_name);
                            delete_dir($_temp_folder.'/'.$prefix_name);//删除目录
                            $log_courseware[] = $courseware_row['title'];
                            
                            if(!empty($scorm_resource['scos']))
                            {
                                foreach ($scorm_resource['scos'] as $key => $value) {
                                    if(isset($value['href']) && isset($value['identifierref']))
                                    {
                                        $this->courseware_sco->insert(array(
                                            'course_id'         =>  $course_id,
                                            'courseware_id'     =>  $courseware_id,
                                            'identifier'        =>  isset($value['identifier'])?$value['identifier']:'',
                                            'parent_identifier' =>  isset($value['parent_identifier'])?$value['parent_identifier']:'',
                                            'identifierref'     =>  isset($value['identifierref'])?$value['identifierref']:'',
                                            'href'              =>  isset($value['href'])?$value['href']:''
                                        ));                                    
                                    }
                                }
                            }
                        }   
                    }
                    else if($suffix_name == '.flv' || $suffix_name == '.mp4' || $suffix_name == '.webm' || $suffix_name == '.ogg')  //视频格式处理
                    {
                        $size = copy2dest($file_path, $dest_dir, $courseware_file_name, $suffix_name);
                        if($size)
                        {
                            $this->courseware->update(array('size'=>$size,'course_id'=>$course_id),$courseware_id);
                            @unlink($file_path);                            //删除视频
                            $log_courseware[] = $courseware_row['title'];
                        }
                    }
                    else     //其他格式处理
                    {
                        $file_path2 = $_temp_folder.'/'.$prefix_name.'.pdf';
                        $file_path3 = $_temp_folder.'/'.$prefix_name.'.swf';

                        //$size = copy2dest($file_path2, $dest_dir, $courseware_file_name, '.pdf');
                        $size = copy2dest($file_path, $dest_dir, $courseware_file_name, $suffix_name);//复制源文件
                        copy2dest($file_path3, $dest_dir, $courseware_file_name, '.swf');
                        
                        if($size)
                        {
                            $this->courseware->update(array('size'=>$size,'course_id'=>$course_id),$courseware_id);
                            if($file_path != $file_path2)
                            {
                                @unlink($file_path);                            //删除office  
                            }
                                
                                @unlink($file_path2);                           //删除pdf
                                @unlink($file_path3); //删除swf
                            $log_courseware[] = $courseware_row['title'];
                        }
                    }
                }
                $update_course_times = true;                
            }

		}

		if(!empty($log_courseware))
		{
			$log[] = $this->lang->line('courseware_manage').$this->lang->line('colon').implode(',', $log_courseware);
		}
		if(isset($update_course_times) && $update_course_times==true)
		{
			$all_courseware_time = $this->courseware->fetch_all(array('type'=>'sum(learning_time) as times','where'=>array('course_id'=>$course_id)));
			$this->course->update(array('class_hour'=>$all_courseware_time[0]->times), $course_id);
		}
		//题目操作

		if($question_id)
		{
			$ques_res = $this->question->update_by_type('course',$question_id,$course_id);
			$log_question = array();
			if(!empty($ques_res))
			{
				foreach ($ques_res as $key => $value) {
					$log_question[] = $value.' '.$this->lang->line(strtolower($this->question->question_type($key)).'_type');
				}
			}
			$log[] = $this->lang->line('question_bank_management').$this->lang->line('colon').implode(',', $log_question);
		}

		//直接发布时，最后再修改为已发布状态

		if($active_status == 1)
		{
			$this->course->update(array('status'=>1, 'publish_time'=>local_to_gmt(time())), $course_id);
			$log[] = $this->lang->line('directly_release');
		}

		$this->load->model('lms_log');
		$log_param['object_id'] = $course_id;
		$log_param['object_type'] = 'course';
		$log_param['message'] = implode(' ; ', $log);
		$this->lms_log->insert($log_param);
		echo json_encode($data);                                    
		exit;
	}
    //-------------------------------------------------------------------------

    /**
     * edit
     * 
     * 课程修改
     * @param int id
     */
    public function edit()
    {
        $this->auth->check_login_json();
        $this->auth->check_permission_json();

		$param = $this->uri->uri_to_assoc(4);
    	$id = isset($param['id']) ? trim($param['id']) : '';
    	$setting = isset($param['setting']) ? trim($param['setting']) : '';
    	$category_id = isset($param['category_id']) ? trim($param['category_id']) : '';

        $this->lang->load('exam',get_language());
        $this->load->model('question');
        $this->load->model('courseware');
        $this->load->model('category');
		$d = array();
		$data = array(
	    	'code' => '1000'
		); 
        $question_manage = array();
        $question_manage['question_type'] = $this->question->question_type();
        if($id)
        {
        	$course = $this->course->get($id);
        	if(!$course)
        	{
        		$data['code'] = '1001';
        		$data['msg'] = $this->lang->line('course_not_exist');
        		echo json_encode($data);
        		exit;
        	}	
		    //判断是否是管理员
		    if( $this->auth->user_id() != $course ->create_user_id && !$this->auth->is_super_admin() ){
		        $data['code'] = '1003';
		        $data['msg'] = $this->lang->line('permission_denied');
		        echo json_encode($data);
		        exit;
		    }
			if($course->status == 1 && $course->chose_number > 0)
			{
				$data['code'] = '1010';
				$data['msg'] = $this->lang->line('course_chosed_so_cannot_edit');
				echo json_encode($data);
				exit;
			}
        	$d['course'] = $course;
        	$course_exam = $this->course_exam->get_by_course($id);
        	if($course_exam)
        	{
        		$d['course_exam'] = $course_exam;
        	}
        	$d['courseware'] = $this->courseware->fetch_all(array('where'=>array('course_id'=>$id)));
        	$question_manage['question'] = $this->question->all_question('course',$id);
        	$question_manage['instance'] = $course;
        }
        else
        {
        	if($this->course->get_count() >= MAX_COURSE)
        	{
        		$data['code'] = '1010';
        		$data['msg'] = $this->lang->line('reach_max_courses');
        		echo json_encode($data);
        		exit;
        	}
        	$d['category_id'] = $category_id;
        }
        $d['category_list'] = $this->category->tree();
        $question_manage['instance_type'] = 'course';
        $d['question_manage'] = $this->load->view('backend/question-manager.php',$question_manage,true);
        $d['setting'] = $setting;
        $data['data'] = $this->load->view('backend/course-edit',$d,true);
        echo json_encode($data);
        exit;
    }
    //-------------------------------------------------------------------------

	public function delete()
	{
		$this->auth->check_login_json();
		$this->auth->check_permission_json();
		$data = array(
			'code' => '1000',
			'msg' => ''
		);        

	 	$id = trim($this->input->post('id',TRUE));
	    if($id)
	    {
	    	//判断是否是管理员
	    	$course = $this->course->get($id);
        	if(!$course)
        	{
        		$data['code'] = '1001';
        		$data['msg'] = $this->lang->line('course_not_exist');
        		echo json_encode($data);
        		exit;
        	}	
        	if(  $this->auth->user_id() != $course ->create_user_id && !$this->auth->is_super_admin()){
	            $data['code'] = '1003';
	            $data['msg'] = $this->lang->line('permission_denied');
	            echo json_encode($data);
	            exit;
        	}
        	if($course->status == 1 && $course->chose_number > 0)
			{
				$data['code'] = '1010';
				$data['msg'] = $this->lang->line('course_chosed_so_cannot_del');
				echo json_encode($data);
				exit;
			}
			$param = array(
				'type' => 'id',
				'where' => 'course_id ='.$id
			);
			$user_course_list = $this->user_course->fetch_items($param);
			if($user_course_list)
			{
				$data['code'] = '1004';
		    	$data['msg'] =$this->lang->line('delete_course_limit');					
			}
			else
			{
			    if(!$this->course->delete($id))
				{
			    	$data['code'] = '1010';
			    	$data['msg'] = $this->lang->line('delete_failed');
				}
				else
				{
					$this->load->model('courseware');
                    $this->load->model('courseware_sco');
					$this->load->helper('file');
					//删除该课程所有课件
					delete_dir(upload_folder('course').'/'.course_dir($id));
					$this->courseware->delete_by_course($id);
                    $this->courseware_sco->delete_by_course($id);
					if($this->course_exam->delete_by_course($id))
					{
						delete_dir(upload_folder('question').'/course/'.course_dir($id));
					}

					$this->load->model('lms_log');
					$log_param['object_id'] = $id;
					$log_param['object_name'] = $course->name;
					$log_param['object_type'] = 'course';
					$log_param['type'] = 'delete';
					$log_param['message'] = $this->lang->line('delete').' '.$this->lang->line('_course') .$this->lang->line('french_quotes_left'). $course->name.$this->lang->line('french_quotes_right');
					$this->lms_log->insert($log_param);
				}
			} 		       			
		}	
		else
		{
		 	$data['code'] = '1004';
		 	$data['msg'] =$this->lang->line('param_incorrect');
		}
		echo json_encode($data);
		exit;
	}
    //-------------------------------------------------------------------------

	/**
	 * change status
	 * 
	 * 更改状态
	 * @param int id 
	 * @2013/4/1
	 * @author varson
	 */
    public function change_status($id)
    {
		$this->auth->check_login_json();
		$this->auth->check_permission_json();

        $data = array('code'=>'1000');
    	$id = trim($id);
        if(!$id)
        {
            $data['code'] = '1004';
            $data['msg'] = $this->lang->line('param_incorrect');
            echo json_encode($data);
            exit;
        }
        $course = $this->course->get($id);
        if(!$course)
        {
            $data['code'] = '1001';
            $data['msg'] = $this->lang->line('no_data_exist');
            echo json_encode($data);
            exit;
        }
        //判断是否是管理员
    	if(  $this->auth->user_id() != $course ->create_user_id && !$this->auth->is_super_admin()){
            $data['code'] = '1003';
            $data['msg'] = $this->lang->line('permission_denied');
            echo json_encode($data);
            exit;
    	}
        if($course->status==1)
        {
            $data['code'] = '1010';
            $data['msg'] = $this->lang->line('course_active');
            echo json_encode($data);
            exit;
        }
        else
        {
            //检查是否有课件、考试设置
            $this->load->model('courseware');
            $this->load->model('course_exam');
            $where = array('course_id'=>$id);
            $courseware = $this->courseware->fetch_items(array('type'=>'count(id) as count','where'=>$where));
            if($courseware[0]->count==0)//检查是否有课件
            {
                $data['code'] = '1010';
                $data['msg'] = $this->lang->line('cannot_modify_course_status_2')." <button class='btnGrey' onclick='course_edit($id,1)'>".$this->lang->line('now_upload1')."</button>";
                echo json_encode($data);
                exit;
            }
            if($course->complete > 1)
            {
              
                $course_exam = $this->course_exam->get_by_course($id);//检查是否已设置考试
                if(!$course_exam)
                {
                    $data['code'] = '1003';
					$exam_function = "exam_setting(".$id.")";
                    $data['msg'] = $this->lang->line('cannot_modify_course_status_3')." <button class='btnGrey' onclick='course_edit($id,2)' >".$this->lang->line('now_setting')."</button>";
                    echo json_encode($data);
                    exit;
                }
                else
                {
		           //检查是否有题库 
                	if($course_exam->total_score == 0)
                	{
		                $data['code'] = '1010';
		                $data['msg'] = $this->lang->line('no_exam_setting');
		                echo json_encode($data);
		                exit;
                	}
                	if($course_exam->total_score < $course_exam->pass_score)
                	{
		                $data['code'] = '1010';
		                $data['msg'] = $this->lang->line('total_score_less_than_passscore');
		                echo json_encode($data);
		                exit;
                	}
                	
					$this->load->model('question');
		          	$questions = $this->question->fetch_items(array(
		  				'type'=>'type, count(id) as count',
		  				'groupby' => 'type' ,
						'orderby' => 'type asc' ,
					    'where' => "course_id ='".$id."' and answer != '' "
					));
		          	if(empty($questions))//没有题库
		          	{  
		          		$data['code'] = '1003';
		          		$data['msg'] = $this->lang->line('cannot_modify_exam_status_2'). " <button class='btnGrey'  onclick='course_edit($id,3)' >".$this->lang->line('now_setting')."</button>";
		          		echo json_encode($data);
		          		exit;
		          	}
					else  //判断题目数量是否达到
					{
						$course_exam = $this->course_exam->get_by_course($id);    //课程考试设置的题目数量
						$single_num = $course_exam->single_num;
						$multiple_num = $course_exam->multiple_num;
						$judge_num = $course_exam->judge_num;
						
						//没有对应类型的情况
						$type_array = array();  //题库有的类型
						foreach($questions as $question){
							$type_array[$question->type]= $question->count;
						}
						$_question_msg = array(); 
						$check = false; 			
						if($single_num > 0 ){ //没有相关类型的题目
							if(!array_key_exists('1', $type_array))
							{
								$_question_msg[] = sprintf($this->lang->line('single_num_1'), $single_num);
								$check = true;						
							}
							else if($single_num > $type_array['1'])
							{
								$_question_msg[] = sprintf($this->lang->line('single_num_1'), ($single_num - $type_array['1']));
								$check = true;	
							}
						} 		
						if($multiple_num > 0 ){ //没有相关类型的题目
							if(!array_key_exists('2', $type_array))
							{
								$_question_msg[] = sprintf($this->lang->line('multiple_num_1'), $multiple_num);
								$check = true;
							}
							else if($multiple_num > $type_array['2'])
							{
								$_question_msg[] = sprintf($this->lang->line('multiple_num_1'), ($multiple_num - $type_array['2']));
								$check = true;	
							}
						} 	
						if($judge_num > 0 ){ //没有相关类型的题目
							if(!array_key_exists('3', $type_array))
							{
								$_question_msg[] = sprintf($this->lang->line('judge_num_1'), $judge_num);
								$check = true;						
							}
							else if($judge_num > $type_array['3'])
							{
								$_question_msg[] = sprintf($this->lang->line('judge_num_1'), ($judge_num - $type_array['3']));
								$check = true;	
							}
						}
						if($check)
						{   
							$data['code'] = '1004';
							$data['msg'] =  implode(' , ', $_question_msg) . "<button class='btnGrey' onclick='course_edit(\"$id\",3)'>".$this->lang->line('now_add')."</button>";
							echo json_encode($data);
		          			exit;
						}
					}
				}  
            } 
            $row = array('status'=>1,'publish_time'=>local_to_gmt());
        }
        if($this->course->update($row,$id))
        {
            $data['code'] = '1000';
            $data['data'] = $row;
            if($this->auth->has_permission('admin','course_user','index'))
            {
                $data['assign_course_user'] = true;
            }
			$this->load->model('lms_log');
			$log_param['object_id'] = $id;
			$log_param['object_name'] = $course->name;
			$log_param['object_type'] = 'course';
			$log_param['type'] = 'update';
			$log_param['message'] = $this->lang->line('open');
			$this->lms_log->insert($log_param);
        }
        else
        {
            $data['code'] = '1001';
            $data['msg'] = $this->lang->line('failed');
        }
        echo json_encode($data);
        exit;
    }
    //-------------------------------------------------------------------------

    /**
     * player
     *
     * @param int course id
     * @author varson
     * @2013/05/17
     */
    public function play($course_id,$courseware_id=0,$filename = '',$course_name = '')
    {
        $this->auth->check_login();
		$this->auth->check_permission();
		$this->load->helper('file');

    	$course_id = trim($course_id);
    	$courseware_id = trim($courseware_id);
    	$course_save_dir = file_save_dir($course_id);

    	$_temp_folder = upload_folder('temp');
    	$_course_folder = upload_folder('course');

		if($course_id == -1 && $courseware_id == -1)	//新创建课程的预览
		{
	    	$course_name = urldecode(trim($course_name));
			$filename = trim($filename);

			if(!$filename)
			{
				show_error($this->lang->line('no_courseware'));
			}

			$suffix_name = get_file_sufix($filename);      			//获取后缀名
			$prefix_name = get_file_prefix($filename);				//获取前缀
			$data['course_name'] = $course_name;
			$data['courseware_id'] = '';
			//$data['src'] = base_url().'admin/courses/loadsco/-1/-1/'.$filename;
            $xmlfile = $_temp_folder.'/'.$prefix_name.'/imsmanifest.xml';
		}
		else    //更新课程的预览
		{
			$this->load->model('courseware');
	        $this->load->model('user_courseware');
	        if(!$course_id || !$courseware_id)
	        {
	            show_error($this->lang->line('param_incorrect'));
	        }
	        $user_id = $this->auth->user_id();

	        $course = $this->course->get($course_id);
	        if(!$course)
	        {
	            show_error($this->lang->line('course_not_exist'));
	        }

	        if($courseware_id)
	        {
	            $courseware = $this->courseware->get($courseware_id);
	        }
	        if(!$courseware)
	        {
                show_error($this->lang->line('no_courseware_exist'));
                /*
	            $courseware_list = $this->courseware->fetch_items(array('where'=>array('course_id'=>$course_id),'orderby'=>'id asc','num'=>1));//取课程的第一个courseware
	            if($courseware_list)
	            {
	                $courseware = $courseware_list[0];
	            }
	            else
	            {
	                show_error($this->lang->line('no_data_exist'));
	            }*/
	        }

	        $data['courseware'] = $courseware;        
	        $data['course_name'] = $course->name;
	        //$data['user_courseware'] = $user_courseware;
	        $data['courseware_id'] = $courseware->id;  
	        //$data['src'] = base_url().'admin/courses/loadsco/'.$course_id.'/'.$courseware->id;
	        $data['course_id'] = $course_id;
            $data['version'] = $courseware->version;
	        $filename = $courseware->file_name;
	        $suffix_name = get_file_sufix($filename);      			 //获取后缀名
			$prefix_name = get_file_prefix($filename);				  //获取前缀

            $xmlfile = $_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/imsmanifest.xml';
		}

        $data['is_single_sco'] = true;
        $data['type'] = 'browse';
        //不同的文件用不同的视图显示

        if($suffix_name == '.zip')
        {
            $this->load->model('courseware_sco');
            $this->load->model('scorm');
            $scos = array();
            if($courseware_id > 0)
            {
                $sco = $this->courseware_sco->fetch_items(array('where' => array("a.courseware_id" => $courseware_id)));//courseware的所有sco
                $data['version'] = $courseware->version;
            }                
            if(!file_exists($xmlfile))
            {
                show_error('',404,$this->lang->line('no_courseware_exist'));
            }
            $res = $this->scorm->parse($xmlfile);
            if(!$res)
            {
                show_error('',500, $this->lang->line('course_parse_error'));
            }
            $data['scos'] = $res['scos'];
            if(count($res['scos']) > 1)
            {
                $data['is_single_sco'] = false;
                $data['tree'] = $this->scorm->get_item_tree($res['scos']);
            }
            if(!empty($sco))
            {
                $index = $sco[0]->href;
                $data['current_sco'] = $sco[0]->id;
            }            
            else
            {
                foreach($res['scos'] as $sco)
                {
                    if(isset($sco['href']) && $sco['href']!='')
                    {
                        $index = $sco['href'];
                    }
                }
                $data['version'] = $res['version'];
            }            
            if($course_id == -1 && $courseware_id == -1)
            {
                $data['path'] = base_url().$_temp_folder.'/'.$prefix_name.'/'; 
                $data['src'] = $data['path'].$index;
            }
            else
            {
                $data['path'] = base_url().$_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/';
                $data['src'] = $data['path'].$index;
            }
        	$this->load->view('common/player',$data);
        }
        else if($suffix_name == '.flv' || $suffix_name == '.mp4' || $suffix_name == '.webm' || $suffix_name == '.ogg')
        {	
        	$data['video_type'] = str_replace('.', '', $suffix_name);
        	if($course_id == -1 && $courseware_id == -1)
        		$data['src'] = base_url().$_temp_folder.'/'.$filename;
        	else
        		$data['src'] = base_url().$_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/'.$filename;
        	$this->load->view('common/player-video',$data);
        }
        else
        {
        	if($course_id == -1 && $courseware_id == -1)
        	{
        		$data['src'] = base_url().$_temp_folder.'/'.$prefix_name.'.swf';												//新建地址
        	}
        	else
        	{
        		$data['src'] = base_url().$_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/'.$prefix_name.'.swf';//更新的地址
        	}
        	$this->load->view('common/player-swf',$data);
        }
        
    }
    //-------------------------------------------------------------------------
	
    /**
     * loadsco
     *
     *
     */
    public function loadsco($course_id,$courseware_id,$filename = '')
    {
        $this->auth->check_login();
        $this->auth->check_permission();

        if(!$course_id || !$courseware_id){
            show_error('','',$this->lang->line('param_incorrect'));
        }
        $this->load->model('user_courseware');    
        $this->load->model('courseware');
        $this->load->helper('file');

        $_temp_folder = upload_folder('temp');
        $_course_folder = upload_folder('course');

        $course_id = trim($course_id);
        $courseware_id = trim($courseware_id);
        $filename = trim($filename);
        $prefix_name = get_file_prefix($filename);
        $user_id = $this->auth->user_id();
        if($course_id=='default')
        {
            if($this->auth->is_admin())
            {
                $xmlfile = './import/course/admin/imsmanifest.xml';
            }
            else
            {
                $xmlfile = './import/course/xueyuan/imsmanifest.xml';
            }
        }
        else
        {
        	if($course_id == -1 && $courseware_id == -1)
        	{
        		$xmlfile = $_temp_folder.'/'.$prefix_name.'/imsmanifest.xml';
        	}
        	else
        	{
				$course_save_dir = file_save_dir($course_id);
	            $xmlfile = $_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/imsmanifest.xml';
        	}            
        }
        if(!file_exists($xmlfile))
        {
            show_error('',404,$this->lang->line('no_courseware_exist'));
        }
        $xmlparser = xml_parser_create();
        // 打开文件并读取数据
        $xmldata = file_get_contents($xmlfile);
        $res = xml_parse_into_struct($xmlparser,$xmldata,$values);
        if(!$res)
        {
            show_error('','', $this->lang->line('course_parse_error') .':'. xml_error_string(xml_get_error_code($xmlparser)) );
        }
        xml_parser_free($xmlparser);
        $index = '';
        $data = array();
        foreach($values as $item)
        {
            if(strtoupper($item['tag'])=='RESOURCE' && isset($item['attributes']))
            {
                $index = $item['attributes']['HREF'];
                break;
            }
        }
        if($index!='')
        {
            if($course_id=='default')
            {
                if($this->auth->is_admin())
                {
                    $data['src'] = base_url().'/import/course/admin/'.$index;
                }
                else
                {
                    $data['src'] = base_url().'/import/course/xueyuan/'.$index;
                }
            }
            else
            {
            	if($course_id == -1 && $courseware_id == -1)	//新建课件预览地址
	        	{
	        		$data['src'] = base_url().$_temp_folder.'/'.$prefix_name.'/'.$index;
	        	}
	        	else//更新课件预览
	        	{
	        		$course_save_dir = file_save_dir($course_id);
					$data['src'] = base_url().$_course_folder.'/'.$course_save_dir.'/'.$courseware_id.'/'.$index;
	        	}  
            }
        }
        $this->load->view('common/loadSCO',$data);
    }
}
/* End of file course.php */
/* Location: ./lms_app/controllers/admin/course.php */