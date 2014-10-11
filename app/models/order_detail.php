<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 订单详情
    * @author alex.liang
    * 2014/10/9
**********************************/
class Order_detail extends CI_Model{
	
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
        $this->param['code'] = $this->input->post('code')!='' ? trim($this->input->post('code')) : 
            (isset($params['code']) ? urldecode(trim($params['code'])) : '');
        $this->page = isset($params['page']) ? trim($params['page']) : 1;
        $this->base_url = '';
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
			if($this->db->insert($this->table,$row)){
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
			return $this->db->update($this->table,$row);
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
            return $this->db->delete($this->table);
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
        $_type = 'd.order_id,d.product_id,d.price,d.number,p.name,p.best_price';
        
        $this->db->select ( $_type );
        $this->db->from($this->detail_table.' as d');
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
        if(isset($this->param['code']) && $this->param['code'] != '')
        {
            $where[] = "a.code like '%".addslashes(str_replace('%', '\%', $this->param['code']))."%'";
            $where[] = "p.name like '%".addslashes(str_replace('%', '\%', $this->param['code']))."%'";
            $this->base_url .= 'code/'.urlencode($this->param['code']).'/';
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
/* End of file order_detail.php */
/* Location: ./app/models/order_detail.php */	