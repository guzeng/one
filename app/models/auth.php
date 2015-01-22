<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth Class
 *
 * @category	Auth
 * @author		Gu Zeng
 *
 */
class Auth extends CI_Model{

    private $table = 'member';

    //--------------------------------------------------------------------
    
    /**
     *  encrypt
     *           
     * 密码加密
     * @param string
     * @param string
     * @return string               
     */
    public function encrypt($psw,$auth_code='')
    {
        return sha1(sha1(trim($psw)).trim($auth_code));
    }
    
    //--------------------------------------------------------------------
    /**
     * is super administrator
     */
    public function is_super_admin()
    {
        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin']=='1')
        {
            return true;
        }
        return false;
    }
    //-------------------------------------------------------------------- 

    /**
     * check if user has login
     * 
     * @return boolen          
     */
    public function is_login()
    {
        if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
        {
            $RTR =& load_class('Router', 'core');
            $dir_name=$RTR->fetch_directory();
            if($dir_name == 'admin' && !$_SESSION['is_admin'])
            {
                return false;
            }
            return true;
        }
        return false;
    }
    
    //---------------------------------------------------------------------
    /** 
     * check login
     *      
     * 点击链接时，如未登录，则跳转到login
     *      
     */
                   
    public function check_login()
    {
        if(!$this->is_login())
        {
            setcookie('lms_logout_url', $_SERVER["PHP_SELF"], time()+3600, '/');
            if(strpos($_SERVER["PHP_SELF"],'admin') !== false)
            {
                echo "<script>window.location.href='".base_url().'admin/login'."';</script>";
            }
            else
            {
                echo "<script>window.location.href='".base_url().'login'."';</script>";
            }
            exit;    
        }
    }
    public function check_login_json()
    {
        if(!$this->is_login())
        {
            echo json_encode(array(
                'code' =>  '1002',
                'msg'  =>  $this->lang->line('login_outtime')
            ));
            exit;
        }
    }
    //--------------------------------------------------------------------         
    
    /**
     * user_id
     * 
     * @return int user id
     */
    public function user_id()
    {
        if(isset($_SESSION['user_id']) && $_SESSION['user_id']!='')
        {
            return $_SESSION['user_id'];
        }
        return false;
    }
    //--------------------------------------------------------------------
    
    /**
     * user_id
     * 
     * @return string username
     */
    public function username()
    {
        if(isset($_SESSION['username']) && $_SESSION['username']!='')
        {
            return $_SESSION['username'];
        }
        return false;
    }
    //--------------------------------------------------------------------               
    
    /**
     * email
     * 
     * @return string emai
     */
    public function email()
    {
        if(isset($_SESSION['email']) && $_SESSION['email']!='')
        {
            return $_SESSION['email'];
        }
        return false;
    }
    //-------------------------------------------------------------------- 
    
    /**
     * name
     * 
     * @return string user name
     */
    public function name()
    {
        if(isset($_SESSION['name']) && $_SESSION['name']!='')
        {
            return $_SESSION['name'];
        }
        return false;
    }
    //--------------------------------------------------------------------
    /**
     *  save
     *           
     *  save session
     *       
     */
    public function save_login($row)
    {
        if($row)
        {
            $_SESSION['user_id'] = $row->id;
            $_SESSION['username'] = $row->username;
            $_SESSION['email'] = $row->email;
            $_SESSION['name'] = $row->name;
            $_SESSION['is_admin'] = $row->is_admin;
            $this->load->model('cart');
            $res = $this->cart->save_db();
        }
    }
    //--------------------------------------------------------------------
    
    /**
     *  destroy
     *           
     *  destroy sessions , logout
     */                        
    public function destroy()
    {
        setcookie('_login_auth','', time()-100, '/');
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['is_admin']);
        unset($_SESSION['all_permission']);
        unset($_SESSION['role']);
        session_destroy();
    }
    //--------------------------------------------------------------------

    /**
     * set_auto_login
     *        
     * @param varchar username
     * @param varchar password
     */
    public function set_auto_login($username, $password)
    {
        $day = 15;
        setcookie('_login_auth',base64_encode($username.'lms'.'#!'.sha1($password).md5(rand())), time()+3600*24*$day, '/');
    }
    //--------------------------------------------------------------------

    static public function checkPermission($type='')
    {
        if(!$this->has_permission())
        {
            if($type == 'json')
            {
                echo json_encode(array(
                    'code' =>  '1403',
                    'msg'  =>  "你没有此操作的权限"
                ));
                exit;
            }
            else
            {
                show_error('', 403, '你没有此操作的权限');
            }
        }

    }

     /**
     * 权限验证
     */
    public function has_permission( $dir='', $controller='', $method='')
    {
        //如果是超级管理员就不用验证权限
        if($this->is_super_admin())
        {
            return true;
        }

        if(!isset($_SESSION['all_permission']))
        {
            if(isset($_SESSION['role']) && !empty($_SESSION['role']))
            {
                $this->load->model('role_permission');
                $role_id = $_SESSION['role'];
                if(is_array($role_id))
                {
                    if(count($role_id)==1)
                    {
                        $items['where'] = array('a.role_id'=>$role_id[0]);
                    }
                    else
                    {
                        $items['where_in'] = array('a.role_id'=>$role_id);
                    }
                }
                else
                {
                    $items['where'] = array('a.role_id'=>$role_id);
                }
                $lists = $this->role_permission->fetch_items($items);   //查询用户拥有的权限
                $permission = array();
                if(!empty($lists))
                {
                    foreach ($lists as $key => $value) {
                        $permission[] = $value->permission_id;
                    }
                }
                if(!empty($permission))
                {
                    $_SESSION['all_permission'] = $permission;
                }                
            }
            else
            {
                return false;
            }
        }
        else
        {
            $permission = $_SESSION['all_permission'];
        }

        $RTR =& load_class('Router', 'core');
        $dir = $dir != '' ? $dir :  rtrim($RTR->fetch_directory(), '/');                //controller php所在的文件夹
        $controller = $controller != '' ? $controller : rtrim($RTR->fetch_class(), '/');//controller.php 的class name
        $method = $method != '' ? $method : rtrim($RTR->fetch_method(), '/');           //方法名

        $all_permission = $this->allPermission();
        $p_id = 0;
        if(!empty($all_permission))
        {
            foreach ($all_permission as $key => $value) {
                // if(in_array($method, $value['method']))
                if(in_array($controller, $value['controller']))
                {
                    $p_id = $key;
                    break;
                }
            }
        }
        if($p_id && isset($permission) && in_array($p_id, $permission))
        {
            return true;
        }
        return false;
    }
    //---------------------------------------------------------------------

    //所有权限
    static public function allPermission()
    {
        return array (
            1 => array(
                    'id'        => 1,                   //索引
                    'dir'       =>'admin',              //类所在文件夹
                    'controller'=> 'IndexController',   //控制器名称
                    'method'    => array('getIndex'),   //控制器下的方法
                    'cate'      => 'admin-index',       //类别
                    'code'      => 'admin-index',       //编码，用于显示
                    'pre'       => array(),             //关连的权限ID
                    'show'      => false                //是否显示
                ),
            2 => array(
                    'id'        => 2,
                    'dir'       =>'admin',
                    'controller'=> 'index',
                    'method'    => array('user_online'),
                    'cate'      => 'admin-index',
                    'code'      => 'admin-user-online',
                    'pre'       => array(),
                    'show'      => false
                ),
            3 => array(
                    'id'        => 3,
                    'dir'       =>'admin',
                    'controller'=> 'CourseUserController',
                    'method'    => array('getIndex','postSave'),
                    'cate'      => 'learning',
                    'code'      => 'admin-course-user',
                    'pre'       => array(),
                    'show'      => false
                ),
            4 => array(
                    'id'        => 4,
                    'dir'       =>'admin',
                    'controller'=> 'QuestionController',
                    'method'    => array('postUpload','postUpdate','postDelete','postDeleteall'),
                    'cate'      => 'learning',
                    'code'      => 'admin-question',
                    'pre'       => array(),
                    'show'      => false
                ),
            5 => array(
                    'id'        => 5,
                    'dir'       =>'admin',
                    'controller'=> 'CourseController',
                    'method'    => array('getIndex','getDatalist','postUpdate','getEdit','getDelete','postChangeStatus','getPlay','getCoursewareEdit','postCoursewareDelete','postCoursewareUpdate','postUpload','getInfo','getGradeList'),
                    'cate'      => 'learning',
                    'code'      => 'admin-course',
                    'pre'       => array(1,2,3,4,6),
                    'show'      => true
                ),
            6 => array(
                    'id'        => 6,
                    'dir'       =>'admin',
                    'controller'=> 'CategoryController',
                    'method'    => array('getIndex','postUpdate','getEdit','getDelete'),
                    'cate'      => 'learning',
                    'code'      => 'admin-category',
                    'pre'       => array(),
                    'show'      => false
                ),
            7 => array(
                    'id'        => 7,
                    'dir'       =>'admin',
                    'controller'=> 'ExamUserController',
                    'method'    => array('getIndex','postSave'),
                    'cate'      => 'learning',
                    'code'      => 'admin-exam-user',
                    'pre'       => array(),
                    'show'      => false
                ),
            8 => array(
                    'id'        => 8,
                    'dir'       =>'admin',
                    'controller'=> 'ExamController',
                    'method'    => array('getIndex','getEdit','postUpdate','postChangeStatus','getDelete','getDatalist','getInfo'),
                    'cate'      => 'learning',
                    'code'      => 'admin-exam',
                    'pre'       => array(1,2,4,7),
                    'show'      => true
                ),
            9 => array(
                    'id'        => 9,
                    'dir'       =>'admin',
                    'controller'=> 'UserController',
                    'method'    => array('getIndex','getDatalist','getEdit','postUpdate','getChangeStatus','getDelete','postUpload','postResetPassword'),
                    'cate'      => 'user',
                    'code'      => 'admin-user',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            10 => array(
                    'id'        => 10,
                    'dir'       =>'admin',
                    'controller'=> 'DepartmentController',
                    'method'    => array('getIndex','getEdit','postUpdate','getDelete','postAddChild'),
                    'cate'      => 'user',
                    'code'      => 'admin-department',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            11 => array(
                    'id'        => 11,
                    'dir'       =>'admin',
                    'controller'=> 'PostController',
                    'method'    => array('getIndex','getEdit','postUpdate','getDelete'),
                    'cate'      => 'user',
                    'code'      => 'admin-post',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            12 => array(
                    'id'        => 12,
                    'dir'       => 'Admin',
                    'controller'=> 'QueryController',
                    'method'    => array('getUser','getUserlist','getCourse','getCourselist','getExam','getExamlist','getUserExport','getCourseExport','getExamExport'),
                    'cate'      => 'learning',
                    'code'      => 'admin-query',
                    'pre'       => array(1,2,13,14,15,16),
                    'show'      => true
                ),
            13 => array(
                    'id'        => 13,
                    'dir'       =>'admin',
                    'controller'=> 'export_user',
                    'method'    => array('user','user_course','user_exam'),
                    'cate'      => 'learning',
                    'code'      => 'admin-query-export-user',
                    'pre'       => array(),
                    'show'      => false
                ),
            14 => array(
                    'id'        => 14,
                    'dir'       =>'admin',
                    'controller'=> 'export_course',
                    'method'    => array('course','course_user'),
                    'cate'      => 'learning',
                    'code'      => 'admin-query-export-course',
                    'pre'       => array(),
                    'show'      => false
                ),
            15 => array(
                    'id'        => 15,
                    'dir'       => 'Admin',
                    'controller'=> 'export_exam',
                    'method'    => array('exam','exam_user'),
                    'cate'      => 'learning',
                    'code'      => 'admin-query-export-exam',
                    'pre'       => array(),
                    'show'      => false
                ),
            16 => array(
                    'id'        => 16,
                    'dir'       => 'Admin',
                    'controller'=> 'system_statistic',
                    'method'    => array('index'),
                    'cate'      => 'learning',
                    'code'      => 'admin-query-system-statistic',
                    'pre'       => array(),
                    'show'      => false
                ),
            17 => array(
                    'id'        => 17,
                    'dir'       => 'Admin',
                    'controller'=> 'SystemController',
                    'method'    => array('getIndex','postUpdate'),
                    'cate'      => 'settings',
                    'code'      => 'admin-settings',
                    'pre'       => array(1,2,22),
                    'show'      => true
                ),
            18 => array(
                    'id'        => 18,
                    'dir'       =>'admin',
                    'controller'=> 'NewsController',
                    'method'    => array('getIndex','getDatalist','getEdit','postUpdate','getDelete','getChangeStatus'),
                    'cate'      => 'settings',
                    'code'      => 'admin-news',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            19 => array(
                    'id'        => 19,
                    'dir'       => 'Admin',
                    'controller'=> 'SkinController',
                    'method'    => array('getIndex','postUpdate','getDelete'),
                    'cate'      => 'settings',
                    'code'      => 'admin-skin',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            20 => array(
                    'id'        => 20,
                    'dir'       => 'Admin',
                    'controller'=> 'QuestionnaireController',
                    'method'    => array('getIndex','getDatalist','getEdit','postUpdate','getDelete','getChangeStatus','getDownload'),
                    'cate'      => 'settings',
                    'code'      => 'admin-survey',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            21 => array(
                    'id'        => 21,
                    'dir'       =>'admin',
                    'controller'=> 'RoleController',
                    'method'    => array('getIndex','getDatalist','getEdit','postUpdate','postDelete','getPermission','postSetPermission'),
                    'cate'      => 'settings',
                    'code'      => 'admin-role',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            22 => array(
                    'id'        => 22,
                    'dir'       =>'admin',
                    'controller'=> 'LogController',
                    'method'    => array('getIndex'),
                    'cate'      => 'settings',
                    'code'      => 'admin-log',
                    'pre'       => array(),
                    'show'      => true
                ),
            23 => array(
                    'id'        => 23,
                    'dir'       =>'Home',
                    'controller'=> 'CourseController',
                    'method'    => array('getIndex'),
                    'cate'      => 'learning',
                    'code'      => 'home-course',
                    'pre'       => array(24,25),
                    'show'      => true,
                    'default'   => true                         //角色创建后默认赋予
                ),
            24 => array(
                    'id'        => 24,
                    'dir'       =>'Home',
                    'controller'=> 'MycourseController',
                    'method'    => array('applycourse','cancelcourse','course_rate','grade_course'),
                    'cate'      => 'learning',
                    'code'      => 'home-mycourse',
                    'pre'       => array(),
                    'show'      => false
                ),
            25 => array(
                    'id'        => 25,
                    'dir'       =>'Home',
                    'controller'=> 'ExaminationController',
                    'method'    => array('join','course','exam','exam_continue','course_continue','save_answer','calculate_score','save_answer_status'),
                    'cate'      => 'learning',
                    'code'      => 'home-examination',
                    'pre'       => array(),
                    'show'      => false
                ),
            26 => array(
                    'id'        => 26,
                    'dir'       =>'Home',
                    'controller'=> 'ExamController',
                    'method'    => array('getIndex'),
                    'cate'      => 'learning',
                    'code'      => 'home-exam',
                    'pre'       => array(25,27),
                    'show'      => true,
                    'default'   => true
                ),
            27 => array(
                    'id'        => 27,
                    'dir'       =>'Home',
                    'controller'=> 'MyexamController',
                    'method'    => array('chose_exam','cancel_exam'),
                    'cate'      => 'learning',
                    'code'      => 'home-myexam',
                    'pre'       => array(),
                    'show'      => false
                ),
            28 => array(
                    'id'        => 28,
                    'dir'       => 'Admin',
                    'controller'=> 'LicenseController',
                    'method'    => array('getIndex','postUpdate'),
                    'cate'      => 'settings',
                    'code'      => 'admin-license',
                    'pre'       => array(1,2),
                    'show'      => true
                ),
            29 => array(
                    'id'        => 29,
                    'dir'       => 'Admin',
                    'controller'=> 'SystemController',
                    'method'    => array('getCheckupgrade','getUpgrade'),
                    'cate'      => 'settings',
                    'code'      => 'upgrade',
                    'pre'       => array(),
                    'show'      => false
                )
        );

    }
}
// END Auth Class

/* End of file Auth.php */
/* Location: ./application/models/Auth.php */