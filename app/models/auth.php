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

}
// END Auth Class

/* End of file Auth.php */
/* Location: ./application/models/Auth.php */