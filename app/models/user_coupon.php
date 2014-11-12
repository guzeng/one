<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 优惠券
    * @author alex.liang
    * 2014/11/7
**********************************/
class User_coupon extends CI_Model{
	
	private $table = 'user_coupon';
    private $coupon_table = 'coupon';
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
        $param = $this->uri->uri_to_assoc(4);
        $type = isset($param['type']) ? trim($param['type']) : 1;
        $this->page = isset($param['page']) ? trim($param['page']) : 1;
        $this->base_url = 'type/'.$type;
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
        if(isset($this->param['user_id']) && $this->param['user_id'] != '')
        {
            $where[] = "a.user_id = '".$this->param['user_id']."'";
            $this->base_url .= 'user_id/'.urlencode($this->param['user_id']).'/';
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
    /**
     * lists
     * 查询所有 显示列表
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author alex.liang
     * 2014/11/7
     */    
    public function lists($where=array(),$num=15,$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_num = intval($num)>0 ? intval($num) : 15;
        $_start = (intval($this->page)-1)*$_num;
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $this->per_page = $_num;
        $_type = 'a.*,c.*';
        $this->db->select ( $_type );
        $this->db->from($this->table.' as a');
        $this->db->join($this->coupon_table.' as c','a.coupon_id=c.id','left');
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->limit($_num,$_start);
        
        if($this->groupby!='')
        {
            $this->db->group_by($this->groupby);
        }
        $this->db->order_by($_orderby);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
    }
    //----------------------------------------------------------------
    /**
     * count
     * 查询所有数量
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author alex.liang
     * 2014/11/7
     */    
    public function count($where)
    {
        $_where = $this->condition($where);
        $this->db->select ('count(a.id) as count');
        $this->db->from($this->table.' as a');
        $this->db->join($this->coupon_table.' as c','a.coupon_id=c.id','left');
        if(isset($_where)){
            $this->db->where($_where);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
            return $result[0]->count;
        }
        return 0; 
    }
    //----------------------------------------------------------------

    /**
    * 分页
    */
    public function pages($where)
    {
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = $this->count($where);
        $config['base_url'] = rtrim($this->base_url,'/');
        $this->pagination->initialize($config);
        return $this->pagination->links();
    }
    //----------------------------------------------------------------
}
/* End of file Coupon.php */
/* Location: ./app/models/Coupon.php */	