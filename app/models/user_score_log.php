<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_score_log  extends CI_Model{
	private $table='user_score_log';
	private $table_user = 'member';
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
        $time_type = $this->param['time_type'] = $this->input->post('time_type')!='' ? trim($this->input->post('time_type')) : 
            (isset($param['time_type']) ? urldecode(trim($param['time_type'])) : '');
        $this->page = isset($param['page']) ? trim($param['page']) : 1;
        $this->base_url = 'time_type/'.$time_type;
    }

    //---------------------------------------------------------------
	public function insert($row){
		if(is_array($row) && !empty($row)){
            if(!isset($row['create_time']) || intval($row['create_time'])<=0)
            {
                $row['create_time'] = local_to_gmt();
            }
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
	//-------------------------------------------------------
	
	public function update($row,$id){
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}
	//--------------------------------------------------------

	public function delete($id){
		if($id){
			$this->db->where('id',$id);
			return $this->db->delete($this->table);
		}
		return false;
	}
	//---------------------------------------------------------

	public function get($id){
		if($id){
			$this->db->where('id',$id);
			$query = $this->db->get($this->table);
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//---------------------------------------------------------

    public function type($type='')
    {
        $arr = array(
            '1' => '系统赠送',
            '2' => '购物返回'
        );
        if($type)
        {
            if(array_key_exists($type, $arr))
            {
                return $arr[$type];    
            }
            else
            {
                return false;
            }
        }
        return $arr;
    }

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
     * @author zeng.gu
     * 2014/3/31
     */    
	public function lists($where=array(),$num=15,$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_num = intval($num)>0 ? intval($num) : 15;
        $_start = (intval($this->page)-1)*$_num;
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $this->per_page = $_num;
        $_type = 'a.*';
		$this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->limit($_num,$_start);
        $this->db->from($this->table.' as a');
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
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/3/31
     */    
    public function all($where=array(),$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $_type = 'a.*';
        $this->db->select ( $_type );
        if(!empty($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
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
    public function count($condition=array())
    {
        $_where = $this->condition($condition);
        $this->db->select ('count(a.id) as count');
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
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
    public function pages($condition=array())
    {
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = $this->count($condition);
        $config['base_url'] = rtrim($this->base_url,'/');
        $this->pagination->initialize($config);
        return $this->pagination->links();
    }
    //----------------------------------------------------------------

}
/* End of file user_score_log.php */
/* Location: ./application/models/user_score_log.php */	