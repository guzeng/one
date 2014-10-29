<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 商品
    * @author zeng.gu
    * 2014/3/31
**********************************/
class Product extends CI_Model{
	
	private $table = 'product';
    public $page = 1;
    private $per_page = 15;
    public $param = array();
    private $base_url = '';
    private $groupby = '';
    public $params = array();

    //---------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        if($this->router->fetch_directory()=='admin')
        {
            $params = $this->uri->uri_to_assoc(4);    
        }
        else
        {
            $params = $this->uri->uri_to_assoc(3);
        }
        $this->params = $params;
        $this->param['cate_id'] = $this->input->post('cate_id') ? $this->input->post('cate_id') : 
            (isset($params['cate_id']) ? urldecode($params['cate_id']) : 0);
        $this->param['code'] = $this->input->post('code')!='' ? trim($this->input->post('code')) : 
            (isset($params['code']) ? urldecode(trim($params['code'])) : '');
        $this->param['name'] = $this->input->post('name')!='' ? trim($this->input->post('name')) : 
            (isset($params['name']) ? urldecode(trim($params['name'])) : '');
        $this->param['brand_id'] = $this->input->post('brand_id')!='' ? trim($this->input->post('brand_id')) : 
            (isset($params['brand_id']) ? urldecode(trim($params['brand_id'])) : '');
        $this->param['price'] = $this->input->post('price')!='' ? trim($this->input->post('price')) : 
            (isset($params['price']) ? urldecode(trim($params['price'])) : '');

        $this->page = isset($params['page']) ? trim($params['page']) : 1;
        $this->base_url = '';
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
    *   bath_update_status
    *   更新多个个商品状态
    *   @param array row 数组
    *   @param array id
    * 
    */
    public function bath_update_status($row,$ids)
    {
        if(!empty($row) && $ids){
            $this->db->where_in('id',$ids);
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
    *   exist
    *   检查是否存在
    *   @param int id
    * 
    */
    public function exist($where)
    {
        if($where){
            $this->db->from($this->table. ' as a');
            $this->db->where($where);
            $type = 'count(a.id) as count';
            $this->db->select($type);
            $query = $this->db->get();
            if($query->row()->count > 0)
            {
                return true;
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
        $where[] = "`status` != '2'";
        if(intval($this->param['cate_id']) > 0)
        {
            $this->load->model('product_category');
            $cat_childs = $this->product_category->get_all_children($this->param['cate_id']);
            if(count($cat_childs) == 0)
            {
                $where[] = "a.cate_id='{$this->param['cate_id']}'";    
            }
            else
            {
                $cat_childs[] = $this->param['cate_id'];
                $where[] = "a.cate_id in ('".implode("','", $cat_childs) ."')";
            }
            $this->base_url .= 'cate_id/'.urlencode($this->param['cate_id']).'/';
        }
        if($this->param['name'] != '')
        {
            $where[] = "a.name like '%".addslashes(str_replace('%', '\%', $this->param['name']))."%'";
            $this->base_url .= 'name/'.urlencode($this->param['name']).'/';
        }
        if($this->param['brand_id'] != '')
        {
            $where[] = "a.brand_id='{$this->param['brand_id']}'";
            $this->base_url .= 'brand_id/'.urlencode($this->param['brand_id']).'/';
        }
        if($this->param['price'] != '')
        {
            $_p = explode('-', $this->param['price']);
            if(count($_p)==1)
            {
                $where[] = "a.price='{$this->param['price']}'";
            }
            else if(count($_p)==2)
            {
                if($_p[0])
                {
                    $where[] = "a.price>={$_p[0]}";
                }
                if($_p[1])
                {
                    $where[] = "a.price<={$_p[1]}"; 
                }
            }
            $this->base_url .= 'price/'.urlencode($this->param['price']).'/';
        }
        if($this->param['code'] != '')
        {
            $where[] = "a.code like '%".addslashes(str_replace('%', '\%', $this->param['code']))."%'";
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
    /**
     * lists
     * 查询所有 显示列表
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author zeng.gu
     * 2014/3/31
     */    
	public function lists($num=15,$orderby='',$groupby='',$cond = array())
    {
        $_where = $this->condition($cond);
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
        //echo $this->db->last_query();
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
    public function all($where=array(),$orderby='',$groupby='',$num=0)
    {
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $_type = 'a.*';
        $this->db->select ( $_type );
        if(!empty($where)){
            $this->db->where($where);
        }
        if($num > 0)
        {
            $this->db->limit($num);    
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
    public function count()
    {
        $_where = $this->condition();
        $this->db->select ('count(a.id) as count');
        if($_where){
            $this->db->where($_where);
        }
        $query = $this->db->get($this->table.' as a');
        if($query->num_rows() > 0){
            $a = $query->result();
            return $a[0]->count;
        }
        return 0;
    }
    //----------------------------------------------------------------

    /**
    * 分页
    */
    public function pages()
    {
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = $this->count();
        $config['base_url'] = rtrim($this->base_url,'/');
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
    *   取商品图片
    *   @param int id 商品ID
    *   @param var type 类型
    */
    public function pic($id='', $sort=1, $type='big')
    {
        if($id)
        {    
            $folder = upload_folder('product');
            $file_save_dir = file_save_dir($id);
            $file_save_name = file_save_name($id);
            $filePath = '';
            switch ($type) {
                case 'small':
                case 'thumb':
                    $filePath = $folder.'/'.$file_save_dir.'/'.$file_save_name.'_'.$sort.'_thumb.png';
                    $default = base_url().'assets/img/product/p-default_thumb.png';
                break;
                case 'big':
                case 'default':
                default:
                    $filePath = $folder.'/'.$file_save_dir.'/'.$file_save_name.'_'.$sort.'.png';
                    $default = base_url().'assets/img/product/p-default.png';
                break;
            }
            if(file_exists($filePath))
            {
                return base_url().$filePath.'?'.rand();
            }
            else
            {
                return $default;
            }
        }
        return false;
    }
}
/* End of file product.php */
/* Location: ./app/models/product.php */	