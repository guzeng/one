<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 订单详情
    * @author alex.liang
    * 2014/10/9
**********************************/
class Order_detail extends CI_Model{
	
	private $table = 'order_detail';
    private $product_table = 'product';
    private $order_table = 'order';
    private $user_table = 'member';
    private $page = 1;
    private $per_page = 15;
    private $param = array();
    private $base_url = '';

    public function __construct()
    {
        parent::__construct();
        $param = $this->uri->uri_to_assoc(4);
        $this->page = isset($param['page']) ? trim($param['page']) : 1;
    }
    //----------------------------------------------------------------
    /**
    *   insert
    *   插入订单详情
    *   @param array row 数组
    * 
    */
	public function insert($row)
    {
		if(is_array($row) && !empty($row)){
            if(!isset($row['create_time']) || intval($row['create_time'])==0)
            {
                $row['create_time'] = local_to_gmt();
            }
			if($this->db->insert($this->detail_table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
    //----------------------------------------------------------------
    /**
    *   update
    *   更新订单详情
    *   @param array row 数组
    *   @param int id
    * 
    */
	public function update($row,$id)
    {
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->detail_table,$row);
		}
		return false;
	}	
    //----------------------------------------------------------------

    /**
    *   delete
    *   删除订单详情
    *   @param int id
    * 
    */
	public function delete($id)
    {
		if($id){
			$this->db->where('id',$id);
            return $this->db->delete($this->detail_table);
		}
		return false;
	}
    //----------------------------------------------------------------

    /**
    *   get
    *   获取订单详情信息
    *   @param int id
    * 
    */
	public function get($order_id)
    {
        $_type = 'd.order_id,d.product_id,d.price,d.number,p.name,p.best_price,p.score,p.unit';
        
        $this->db->select ( $_type );
        $this->db->from($this->table.' as d');
        $this->db->join($this->product_table.' as p','d.product_id=p.id','left');
        $this->db->where('d.order_id',$order_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
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
     * @param array where 查询条件
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/3/31
     */    
    public function lists($items = array())
    {
        if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_num = isset($_num) && intval($_num)>0 ? intval($_num) : 10;
        $this->per_page = $_num;
        $_start = isset($_start) && intval($_start)>0 ? intval($_start) : 0;
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'a.id desc';
        if(!isset($_type)){
            $_type = 'a.*,p.name,p.price,p.best_price,p.sale_num';
        }
        $this->db->from( $this->table.' as a');
        $this->db->join($this->product_table.' as p','p.id=a.product_id','left');
        if(isset($_join_order))
        {
            $this->db->join($this->order_table.' as o','o.id=a.user_id','left');
        }
        if(isset($_join_user))
        {
            $this->db->join($this->user_table.' as u','u.id=a.user_id','left');
            $_type .= ',u.username';
        }
        $this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
        $this->db->limit($_num,$_start);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
        /*
        //$_where = $this->condition($where);
        //$_num = intval($num)>0 ? intval($num) : 15;
        //$_start = (intval($this->page)-1)*$_num;
        //$_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->per_page = $_num;
        $_type = 'a.*,p.name';
        
        if(isset($_where) && $_where){
            $this->db->where($_where);
        }
        $this->db->limit($_num,$_start);
        $this->db->from($this->table.' as a');
        $this->db->join($this->product_table.' as p','a.product_id=p.id','left');
        // $this->db->join($this->order_table.' as o','a.order_id=o.id','left');
        if(isset($_join_user))
        {
            $this->db->join($this->user_table.' as u','a.user_id=u.id','left');
            $_type .= ',u.username';
        }
        $this->db->select ( $_type );

        $this->db->order_by($_orderby);
        $query = $this->db->get();
        echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
        */
    }
    //----------------------------------------------------------------
    /**
     * all
     * 查询所有 显示列表
     * @param array where 查询条件
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/4/11
     */    
    /*
    public function all($where = array(), $orderby='')
    {
        $_where = $this->condition($where);
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $_type = 'a.*,p.name';
        $this->db->select ( $_type );
        if(isset($_where) && !empty($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
        $this->db->join($this->product_table.' as p','a.product_id=p.id','left');
        // $this->db->join($this->order_table.' as o','a.order_id=o.id','left');
        $this->db->order_by($_orderby);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
    }
    */
    public function all($items=array())
    {
        if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id desc';
        if(!isset($_type)){
            $_type = 'a.*';
        }
        $this->db->select ( $_type );
        if(isset($_where) && !empty($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
        $this->db->from($this->table.' as a');

        $query = $this->db->get ();
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
     * @author zeng.gu
     * 2014/3/31
     */    
    public function count($where = array())
    {
        $_where = $this->condition($where);
        $this->db->select ('count(a.id) as count');
        if(isset($_where) && $_where){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
        //$this->db->join($this->product_table.' as p','a.product_id=p.id','left');
        // $this->db->join($this->order_table.' as o','a.order_id=o.id','left');
        $query = $this->db->get();
        if($query->num_rows() > 0){
           $count = $query->result();
           return $count[0]->count;
        }
        return false; 
    }
    //----------------------------------------------------------------
    /**
    * 分页
    */
    public function pages($url='',$where = array())
    {
        $config['per_page'] = $this->per_page;
        $total_rows = $this->count($where);
        $config['total_rows'] = $total_rows ? $total_rows : 0;
        $config['base_url'] = rtrim($url,'/');
        $this->pagination->initialize($config);
        return $this->pagination->links();
    }
    //----------------------------------------------------------------
}
/* End of file order_detail.php */
/* Location: ./app/models/order_detail.php */	