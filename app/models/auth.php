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
            // $RTR =& load_class('Router', 'core');
            // $dir_name=$RTR->fetch_directory();
            // if($dir_name == 'admin')
            // {
            //     return false;
            // }
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
            $_SESSION['role'] = $row->role_id;

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

    public function check_permission($type='')
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
                if(strtolower($controller)==strtolower($value['controller']))
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
    public function allPermission()
    {
        return array (
            1 => array(
                    'id'        => 1,                   //索引
                    'dir'       =>'admin',              //类所在文件夹
                    'controller'=> 'Index',          //控制器名称
                    'cate'      => 'admin-index',       //类别
                    'code'      => '后台登录',       //编码，用于显示
                    'pre'       => array(),             //关连的权限ID
                    'show'      => false                //是否显示
                ),
            2 => array(
                    'id'        => 2,
                    'dir'       =>'admin',
                    'controller'=> 'Products',//所有商品
                    'cate'      => 'admin-product',
                    'code'      => '商品管理',
                    'pre'       => array(1,3,4,5,6,11,24),
                    'show'      => true
                ),
            3 => array(
                    'id'        => 3,
                    'dir'       =>'admin',
                    'controller'=> 'Product_cate',//商品分类
                    'cate'      => 'admin-product',
                    'code'      => '商品分类',
                    'pre'       => array(),
                    'show'      => false
                ),
            4 => array(
                    'id'        => 4,
                    'dir'       =>'admin',
                    'controller'=> 'Product_brands',//商品品牌
                    'cate'      => 'admin-product',
                    'code'      => '商品品牌',
                    'pre'       => array(),
                    'show'      => false
                ),
            5 => array(
                    'id'        => 5,
                    'dir'       =>'admin',
                    'controller'=> 'Product_comments',//商品评论
                    'cate'      => 'admin-product',
                    'code'      => '商品评论',
                    'pre'       => array(),
                    'show'      => false
                ),
            6 => array(
                    'id'        => 6,
                    'dir'       =>'admin',
                    'controller'=> 'Recycle',//回收站
                    'cate'      => 'admin-product',
                    'code'      => '回收站',
                    'pre'       => array(),
                    'show'      => false
                ),
            7 => array(
                    'id'        => 7,
                    'dir'       =>'admin',
                    'controller'=> 'Orders',//订单
                    'cate'      => 'admin-order',
                    'code'      => '订单管理',
                    'pre'       => array(1),
                    'show'      => true
                ),
            8 => array(
                    'id'        => 8,
                    'dir'       =>'admin',
                    'controller'=> 'Storages',//分仓
                    'cate'      => 'admin-storage',
                    'code'      => '分仓管理',
                    'pre'       => array(1),
                    'show'      => true
                ),
            9 => array(
                    'id'        => 9,
                    'dir'       =>'admin',
                    'controller'=> 'Users',//会员管理
                    'cate'      => 'admin-user',
                    'code'      => '会员管理',
                    'pre'       => array(1,10),
                    'show'      => true
                ),
            10 => array(
                    'id'        => 10,
                    'dir'       =>'admin',
                    'controller'=> 'User_comments',//会员评论
                    'cate'      => 'admin-user',
                    'code'      => '会员评论',
                    'pre'       => array(),
                    'show'      => false
                ),
            11 => array(
                    'id'        => 11,
                    'dir'       =>'admin',
                    'controller'=> 'Coupons',//优惠券
                    'cate'      => 'admin-product',
                    'code'      => '优惠券',
                    'pre'       => array(),
                    'show'      => false
                ),
            12 => array(
                    'id'        => 12,
                    'dir'       =>'admin',
                    'controller'=> 'Settings',//系统设置
                    'cate'      => 'admin-settting',
                    'code'      => '系统设置',
                    'pre'       => array(1,13,14,15,16,17,18,19),
                    'show'      => true
                ),
            13 => array(
                    'id'        => 13,
                    'dir'       =>'admin',
                    'controller'=> 'Roles',//角色设置
                    'cate'      => 'admin-settting',
                    'code'      => '角色设置',
                    'pre'       => array(),
                    'show'      => false
                ),
            14 => array(
                    'id'        => 14,
                    'dir'       => 'admin',
                    'controller'=> 'Providers',//供货商
                    'cate'      => 'admin-settting',
                    'code'      => '供货商',
                    'pre'       => array(),
                    'show'      => false
                ),
            15 => array(
                    'id'        => 15,
                    'dir'       => 'admin',
                    'controller'=> 'Ship_type',//配送方式
                    'cate'      => 'admin-settting',
                    'code'      => '配送方式',
                    'pre'       => array(),
                    'show'      => false
                ),
            16 => array(
                    'id'        => 16,
                    'dir'       => 'admin',
                    'controller'=> 'Pay_type',//支付方式
                    'cate'      => 'admin-settting',
                    'code'      => '支付方式',
                    'pre'       => array(),
                    'show'      => false
                ),
            17 => array(
                    'id'        => 17,
                    'dir'       =>'admin',
                    'controller'=> 'Joins',//加盟
                    'cate'      => 'admin-settting',
                    'code'      => '加盟',
                    'pre'       => array(),
                    'show'      => false
                ),
            18 => array(
                    'id'        => 18,
                    'dir'       => 'admin',
                    'controller'=> 'Links',//友情链接
                    'cate'      => 'admin-settting',
                    'code'      => '友情链接',
                    'pre'       => array(),
                    'show'      => false
                ),
            19 => array(
                    'id'        => 19,
                    'dir'       => 'admin',
                    'controller'=> 'Ads',//广告
                    'cate'      => 'admin-settting',
                    'code'      => '广告管理',
                    'pre'       => array(),
                    'show'      => false
                ),
            20 => array(
                    'id'        => 20,
                    'dir'       =>'admin',
                    'controller'=> 'News',//文章管理
                    'cate'      => 'admin-news',
                    'code'      => '文章管理',
                    'pre'       => array(1,21,22),
                    'show'      => true
                ),
            21 => array(
                    'id'        => 21,
                    'dir'       =>'admin',
                    'controller'=> 'News_cate',//文章分类
                    'cate'      => 'admin-news',
                    'code'      => '文章分类',
                    'pre'       => array(),
                    'show'      => false
                ),
            22 => array(
                    'id'        => 22,
                    'dir'       =>'Home',
                    'controller'=> 'Questionnaires',//问卷
                    'cate'      => 'admin-news',
                    'code'      => '在线问卷',
                    'pre'       => array(),
                    'show'      => false                       //角色创建后默认赋予
                ),
            23 => array(
                    'id'        => 23,
                    'dir'       =>'Home',
                    'controller'=> 'Statistic',//统计管理
                    'cate'      => 'admin-statistic',
                    'code'      => '统计管理',
                    'pre'       => array(1),
                    'show'      => true
                ),
            24 => array(
                    'id'        => 24,
                    'dir'       =>'admin',
                    'controller'=> 'Product_types',//商品类型
                    'cate'      => 'admin-product',
                    'code'      => '商品类型',
                    'pre'       => array(),
                    'show'      => false
                )
        );

    }
}
// END Auth Class

/* End of file Auth.php */
/* Location: ./application/models/Auth.php */