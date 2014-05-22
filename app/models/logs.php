<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logs  extends CI_Model{
	private $table='logs';
	
	public function insert($row){
		if(is_array($row) && !empty($row)){
            if(!isset($row['user_id']))
            {
                $row['user_id'] = $this->auth->user_id();
            }
            if(!isset($row['username']))
            {
                $row['username'] = $this->auth->username();
            }
            if(!isset($row['time']))
            {
                $row['time'] = local_to_gmt();
            }
            if(!isset($row['ip']))
            {
                $row['ip'] = $this->input->ip_address();
            }
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
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
			return true;
		}
		return false;
	}
//---------------------------------------------------------


/**
 * fetch_items
 * 查询所有
 * 
 *	@param item array 
 *	@return array   
 *  @author chunhua.hong
 *  2013/1/10 11:12:56
 */    
	public function fetch_items($items=array()){
		
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
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;	
		
	}

    //--------------------------------------------------------------

}
/* End of file logs.php */
/* Location: ./application/models/logs.php */	