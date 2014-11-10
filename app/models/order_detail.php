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

}
/* End of file order_detail.php */
/* Location: ./app/models/order_detail.php */	