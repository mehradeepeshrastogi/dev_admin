<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends DR_Model {
    
    public function login($data){
        $result = [];
		$query = $this->db->get_where('admin',$data);
		if($query->num_rows() > 0){
			$result = $query->row();
		}
		return $result;
    }
}
