<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ad  extends CI_Model{
	private $table='ad';
	
	public function insert($row){
		if(is_array($row) && !empty($row)){
			if(!isset($row['create_time']) || $row['create_time']=='')
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

	/**
	 * lists
	 * 查询, 用于分页显示列表
	 * 
	 *	@param item array 
	 *	@return array
	 */    
	public function lists($items=array()){
		
		if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_num = isset($_num) && intval($_num)>0 ? intval($_num) : 10;
        $_start = isset($_start) && intval($_start)>0 ? intval($_start) : 0;
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id desc';
        if(!isset($_type)){
            $_type = '*';
        }
		$this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
        $this->db->limit($_num,$_start);
		$query = $this->db->get ( $this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;	
		
	}
	//---------------------------------------------------------
	/**
	 * all
	 * 查询所有
	 * 
	 *	@param item array 
	 *	@return array   
	 *  @author zeng.gu
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
            $_type = '*';
        }
		$this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);
		$query = $this->db->get ( $this->table);
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;
	}
	//---------------------------------------------------------

	public function pic($id)
	{
		$this->config->load('upload');
		$folder = $this->config->item('ad_folder');
		$file_save_dir = file_save_dir($id);
		$file_save_name = file_save_name($id);
		if(is_file($folder.DIRECTORY_SEPARATOR.$file_save_dir.DIRECTORY_SEPARATOR.$file_save_name.'.png'))
		{
			return base_url().$folder.'/'.$file_save_dir.'/'.$file_save_name.'.png';
		}
		return base_url().'assets/img/ad.jpg';
	}
}
/* End of file ad.php */
/* Location: ./application/models/ad.php */	