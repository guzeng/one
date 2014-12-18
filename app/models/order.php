<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 订单
    * @author zeng.gu
    * 2014/4/11
**********************************/
class Order extends CI_Model{
	
	private $table = 'order';
    private $detail_table = 'order_detail';
    private $product_table = 'product';
    private $address_table = 'user_address';
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
        $this->page = isset($params['page']) ? trim($params['page']) : 1;
    }
    //----------------------------------------------------------------
    /**
    *   insert
    *   插入单个商品
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
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
    //----------------------------------------------------------------
    /**
    *   update
    *   更新单个商品
    *   @param array row 数组
    *   @param int id
    * 
    */
	public function update($row,$id)
    {
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}	
    //----------------------------------------------------------------

    /**
    *   delete
    *   删除单个商品
    *   @param int id
    * 
    */
	public function delete($id)
    {
		if($id){
			$this->db->where('id',$id);
            return $this->db->delete($this->table);
		}
		return false;
	}
    //----------------------------------------------------------------

    /**
    *   get
    *   获取单个商品信息
    *   @param int id
    * 
    */
	public function get($id)
    {
		if($id){
            $this->db->from($this->table. ' as a');
			$this->db->where('a.id',$id);
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
    *   get
    *   获取单个商品信息
    *   @param int code
    * 
    */
    public function get_by_code($code)
    {
        if($code){
            $this->db->from($this->table. ' as a');
            $this->db->where('a.code',$code);
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
    *   detail
    *   获取订单详细信息
    *   @param int id
    * 
    */
    public function get_detail($id)
    {
        if($id){
            $this->db->from($this->detail_table. ' as a');
            $this->db->where('a.order_id',$id);
            $type = 'a.*';
            $this->db->select($type);
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result();
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
	public function lists($where = array(), $num=15,$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_num = intval($num)>0 ? intval($num) : 15;
        $_start = (intval($this->page)-1)*$_num;
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $this->per_page = $_num;
        $_type = 'a.*,address.consignee';
        
		$this->db->select ( $_type );
        if(isset($_where) && $_where){
            $this->db->where($_where);
        }
        $this->db->limit($_num,$_start);
        $this->db->from($this->table.' as a');
        $this->db->join($this->address_table.' as address','address.id=a.address_id','left');
        $this->db->join($this->detail_table.' as d','d.order_id=a.id','left');
        $this->db->join($this->product_table.' as p','d.product_id=p.id','left');

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
     * all
     * 查询所有 显示列表
     * @param array where 查询条件
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/4/11
     */    
    public function all($where = array(), $orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $_type = 'a.*';
        $this->db->select ( $_type );
        if(isset($_where) && !empty($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
        $this->db->join($this->detail_table.' as d','d.order_id=a.id','left');
        $this->db->join($this->product_table.' as p','d.product_id=p.id','left');
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
        $this->db->join($this->detail_table.' as d','d.order_id=a.id','left');
        $this->db->join($this->product_table.' as p','d.product_id=p.id','left');
        $this->db->group_by("d.order_id");
        $query = $this->db->get();
        if($query->num_rows() > 0){
           $count = $query->result();
           return count($count);
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
    public function user_count($where = array())
    {
        $_where = $this->condition($where);
        $this->db->select ('count(a.id) as count');
        if(isset($_where) && $_where){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
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

    /**
    * 分页，用于AJAX形式只更新页面部分内容
    */
    public function pages_ajax()
    {
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = $this->count();
        $config['base_url'] = base_url().'admin/products/lists/'.rtrim($this->base_url,'/');
        $config['target'] = 'list_view';
        $this->pagination->init($config);
        return $this->pagination->links_load_page();
    }
    //----------------------------------------------------------------

    /**
    * 生成订单号
    * param int uid 用户ID
    */
    public function code($uid)
    {
        if(!$uid) return 0;
        return date('YmdHis').$uid;
    }

    /**
    * 生成订单
    * param array list 产品列表
    */
    public function create($list)
    {
        $total_price = 0;
        foreach ($list as $key => $value) {
            $total_price += $value['best_price']*$value['count'];
            $$value['product_id'] = $this->product->get($value['product_id']);
            if($$value['product_id']->amount < $value['count'])
            {
                return array('error'=>$$value['product_id']->name.' '.$this->lang->line('product_shortage'));
            }
        }
        $total_price = round($total_price,2);
        $this->db->trans_begin();

        $user_id = $this->auth->user_id();
        $row = array(
            'user_id' => $user_id,
            'username' => $this->auth->username(),
            'code'  => $this->code($user_id),
            'price' => $total_price,
            'create_time' => local_to_gmt()
        );
        $this->db->insert($this->table,$row);
        $orderId = $this->db->insert_id();
        if($orderId)
        {
            foreach ($list as $key => $value) {
                $this->db->insert($this->detail_table, array(
                    'order_id' => $orderId,
                    'user_id'   =>$user_id,
                    'product_id'    => $value['product_id'],
                    'price' => $value['best_price'],
                    'number'    => $value['count']
                ));
                //修改产品库存
                $this->db->update($this->product_table, array('amount'=>$$value['product_id']->amount - $value['count']), "id = ".$value['product_id']);
            }
        }

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return array('error'=>$this->lang->line('update_failed'));
        }
        else
        {
            $this->db->trans_commit();
            return array('error'=>'','orderId'=>$orderId);
        }
    }
}
/* End of file order.php */
/* Location: ./app/models/order.php */	