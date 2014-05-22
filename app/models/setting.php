<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting  extends CI_Model{
	private $table='setting';

	public function update($row,$id){
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}
	//-------------------------------------------------------

	public function insert($row){
		if(!empty($row)){
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}	
	//---------------------------------------------------------

	/**
	 * param 2 ($returnRow=false) canceled on 2013/10/22 
	 */
	public function get_var($variable)
	{
		if(!$variable)
		{
			return false;
		}
		$settings = $this->get_cache();
		if(isset($settings[$variable]))
		{
			return $settings[$variable];
		}
		return false;
	}
	//----------------------------------------------------------

	public function fetch_items($items=array()){
		
		if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_num = isset($_num) && intval($_num)>0 ? intval($_num) : 10;
        $_start = isset($_start) && intval($_start)>0 ? intval($_start) : 0;
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id asc';
        
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
	//----------------------------------------------------------

	public function fetch_all($items=array()){
		
		if(count($items) >0 ){
            foreach($items as $key => $val){
                $c = '_'.$key;
                $$c = $val;
            }
        }
        $_orderby = isset($_orderby) && $_orderby!='' ? $_orderby : 'id asc';
        
        if(!isset($_type)){
            $_type = '*';
        }
		$this->db->select ( $_type );
        
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->order_by($_orderby);

		$query = $this->db->get ( $this->table);
        //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }
		return false;
	}
	//----------------------------------------------------------

	public function cache_file()
	{
		$path = $this->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;
		return rtrim($cache_path,'/').'/system_settings.php';
	}
	//----------------------------------------------------------

	public function get_cache()
	{
		if(!is_file($this->cache_file()))
		{
			$this->save_cache();
		}
		require($this->cache_file());
		return $system_settings;
	}
	//----------------------------------------------------------
	/**
	* save the settings to a cache file
	* @param array
	*
	* @2013/10/22
	* @author Varson
	*/
	public function save_cache($settings = array())
	{
		if(empty($settings))
		{
			$all = $this->fetch_all();
			if(!empty($all))
			{
				foreach ($all as $k => $v) {
					$settings[$v->variable] = $v->value;
				}
			}
		}
		if(!empty($settings))
		{
			$CACHE = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); \n\n";
			foreach($settings as $key => $value)
			{
				$CACHE .= '$system_settings["'.$key.'"] = "'.$value.'";'."\n";
			}
            $CACHE .= '$system_settings["system_name"] = "'.$this->lang->line('LMS').'";';
			@chmod(APPPATH.'cache/',0777);
			$fp = @fopen($this->cache_file(), 'w+');
	        flock($fp, LOCK_EX);
	        fwrite($fp, $CACHE);
	        flock($fp, LOCK_UN);
	        fclose($fp);
		}
		return $settings;
	}
	//----------------------------------------------------------
}
