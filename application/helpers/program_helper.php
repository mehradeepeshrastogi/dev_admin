<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('trans'))
{
	function trans($name)
	{
		$CI = &get_instance();
		$trans_name = $CI->lang->line($name);
		$key = array_keys($CI->lang->is_loaded);
		$value = array_values($CI->lang->is_loaded);
		return (!empty($trans_name))?$trans_name:$value[0].".".$key[0].".".$name;
	}
}

if(!function_exists('create_token')){
	function create_token(){
		$unique_string = md5(time().uniqid().mt_rand());
		return $unique_string;
	}
}

/*
	get_token method have 3 parameter
	'table', => required, get data from this table
	'access_token' => required, matching token from table token fields
	'except' => optional, if you no need some array element  
*/
if(!function_exists('get_token')){
	// get_token('user','access_token',['password','remember_token']);
	function get_token($table,$access_token,$except=[]){
		$CI = &get_instance();
		$select = "*";
		if(!empty($except)){
			$table_data = $CI->db->list_fields($table);
			$selectArr = array_except($table_data,$except);
			$select = implode(',',$selectArr);
		}

		$query = $CI->db->select($select)->get_where($table,['access_token' => $access_token]);
		return ($query->num_rows() > 0)?$query->row():false;
	}
}

if(!function_exists('array_except')){
	function array_except($data,$except){
		$data_flip = array_flip($data);
		$newArr = [];
		if(!empty(is_array($data[0]))){
			echo"2d array";
		}else{
			foreach($except as $expt){
				unset($data_flip[$expt]);
			}
			return array_flip($data_flip);
		}
			
	
		// dd($data);
	}
}


/*
	 dd = dump & die;
*/

if (!function_exists('dd'))
{
	function dd($data)
	{
		echo"<pre>";print_r($data);die;
	}
}


/*
	 dd = dump json;
*/

if (!function_exists('dj'))
{
	function dj($data)
	{
		 echo json_encode($data);die;
	}
}



/*
	 unlinkFile = unlink files;
*/

if (!function_exists('unlinkFile'))
{
	function unlinkFile($filePath,$table,$select,$where)
	{
		$CI = &get_instance();
		$query = $CI->db->select($select)->get_where($table,$where);
		$result = $query->num_rows();
		if($result > 0){
			$files = $query->result();
			foreach($files as $file){
				unlink($filePath.$file->$select);
			}
		}
		return true;
	}
}

