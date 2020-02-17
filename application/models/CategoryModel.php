<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends DR_Model {
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
            $this->db->where("cl.name LIKE '%$search%'");
        }
        
        $query = $this->db->select('c.category_id,c.active,cl.name')->from('category as c')
        ->join('category_lang as cl','cl.category_id = c.category_id','left')
        ->limit($limit,$start)->where([ 'cl.lang_id' => $this->lang_id ])->order_by('short_order','asc')->get();
        // dd($this->db->last_query());
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result();
        }
        return false;
    }

    public function getCategory($category_id,$lang_id=null){
        $return = "result";
        $this->db->select(' c.*,cl.category_lang_id,cl.lang_id,cl.name,cl.description_short')
        ->from('category as c')
        ->join('category_lang as cl','cl.category_id = c.category_id','left')
        ->where(['c.category_id' => $category_id]);
        
        if(!empty($lang_id)){
            $return = "row";
            $this->db->where(['cl.lang_id' => $lang_id]);
        }
        $query = $this->db->get();
        $result = $query->num_rows();
        if ($result > 0) {
            if($return == "row"){
                $result = $query->row();
                return $result;
            }else{
                $result = $query->result();
                return $result;
            }
               
        }
        return false;
    }


    /* 
        This function is for API
    */
    public function getAllCategories($lang_id){
        $result = [];

        $query = $this->db->select("c.category_id,cl.name,cl.description,IFNULL((select if(ci.image_name='','',CONCAT('".base_url('uploads/category/')."',ci.image_name)) from iq_category_image as ci where ci.category_id = c.category_id AND ci.cover = '1'),'') as image_name")
        ->from("category as c")->join("category_lang as cl","cl.category_id = c.category_id","left")->where(["cl.lang_id" => $lang_id])
        ->order_by('short_order')
        ->get();

        if($query->num_rows() > 0){
            $result = $query->result();
            foreach($result as &$res){
                $res->images = $this->getCategoryImageForAPI($res->category_id);
            }
        }
        return $result;
        
    } // end getAllCategories function

    public function getCategoryImageForAPI($category_id){
        $resultArr = [];
        $where = ['category_id' => $category_id,'cover !=' => '1'];
        $query = $this->db->select("*,IF(image_name = '','',CONCAT('".base_url('uploads/category/')."',image_name) ) as image_name")->get_where('category_image',$where);
        $result = $query->num_rows();
        if($result > 0){
            $resultArr = $query->result();
        }
        return $resultArr;
    }


}
    