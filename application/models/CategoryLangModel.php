<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryLangModel extends DR_Model {
    public $lang_id;
    public function __construct(){
        parent::__construct();
        $adminData = $this->session->userdata('adminData');
		$this->lang_id = !empty($adminData)?$adminData->lang_id:'1';
    }

    public function count($search=null){
        if(!empty($search)){
            $this->db->where("cl.name LIKE '%$search%'");
        }
        $query = $this->db->from("category as c")->join("category_lang as cl","cl.category_id = c.category_id","left")->where(['lang_id' => $this->lang_id ])->get();
        $result = $query->num_rows();
        return $result;
    }


    /* 
        get all categories with pagination
    */

    public function getCategories($limit,$start,$search=null){
        if($start < 1){
            $start = 0;
        }else{
            $start = $start - 1;
        }
        if(!empty($search)){
            $this->db->where("name LIKE '%$search%'");
        }
        
        $query = $this->db->select('category_lang_id,name,lang_id as active')->limit($limit,$start)->order_by('category_lang_id','desc')->get('category_lang');
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result();
        }
        return false;
    }

    public function getCategory($category_lang_id){
        $resultData = [];
        $query = $this->db->select('*,lang_id as active')->where('category_lang_id',$category_lang_id)->get('category_lang');
        $result = $query->num_rows();
        if ($result > 0) {
           $resultData = $query->row();  
        }
        return $resultData;
    }


}
    