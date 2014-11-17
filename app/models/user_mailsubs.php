<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 用户邮箱订阅
    * @author alex.liang
    * 2014/11/17
**********************************/
class User_mailsubs extends CI_Model{
	
	private $table = 'user_mailsubs';
    private $user_table = 'member';
    private $page = 1;
    private $per_page = 15;
    private $param = array();
    private $base_url = '';
    private $groupby = '';

    //---------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $params = $this->uri->uri_to_assoc(4);
        $this->param['title'] = $this->input->post('title')!='' ? trim($this->input->post('title')) : 
            (isset($params['title']) ? urldecode(trim($params['title'])) : '');
        $this->page = isset($params['page']) ? trim($params['page']) : 1;
        $this->base_url = '';
    }
    //----------------------------------------------------------------
    /**
    *   insert
    *   插入用户邮箱订阅
    *   @param array row 数组
    * 
    */
	public function insert($row)
    {
		if(is_array($row) && !empty($row)){
            if(!isset($row['create_time']) || intval($row['create_time'])==0)
            {
                $row['create_time'] = time();
            }
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
    //----------------------------------------------------------------
    /**
    *   update
    *   更新用户邮箱订阅
    *   @param array row 数组
    *   @param int id
    * 
    */
    public function update($row,$user_id)
    {
        if(!empty($row) && $user_id){
            $this->db->where('user_id',$user_id);
            return $this->db->update($this->table,$row);
        }
        return false;
    }   
    //----------------------------------------------------------------

    /**
    *   get
    *   获取用户邮箱订阅信息
    *   @param int id
    * 
    */
	public function get($id)
    {
		if($id){
            $this->db->from($this->table. ' as a');
			$this->db->where('a.user_id',$id);
            $type = 'a.*';
            $this->db->select($type);
			$query = $this->db->get();
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//----------------------------------------------------------------

    /**
    *   get_param
    *   返回所有参数
    *   @param return array
    * 
    */
    public function get_param()
    {
        return $this->param;
    }
    //----------------------------------------------------------------

    /**
    *   condition
    *   由传递的参数拼成查询条件
    */
    public function condition($cond=array())
    {
        $where = array();
        if($this->param['title'] != '')
        {
            $where[] = "a.title like '%".addslashes(str_replace('%', '\%', $this->param['title']))."%'";
            $this->base_url .= 'title/'.urlencode($this->param['title']).'/';
        }
        if(!empty($cond))
        {
            $where = array_merge($where,$cond);
        }
        if(!empty($where))
        {
            return "(".implode(") and (",$where).")";
        }
        return '';
    }
}
/* End of file product.php */
/* Location: ./app/models/product.php */	