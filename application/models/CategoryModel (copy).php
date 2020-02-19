<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends DR_Model {
    public $lang_id = "1";
    public function __construct(){
        parent::__construct();
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
        
        $query = $this->db->select('c.category_id,cl.name')->from('category as c')
        ->join('category_lang as cl','cl.category_id = c.category_id','left')
        ->limit($limit,$start)->where([ 'cl.lang_id' => $this->lang_id ])->get();
        // dd($this->db->last_query());
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result();
        }
        return false;
    }

    public function getCategory($category_id,$lang_id=null){
        $return = "result";
        $this->db->select(' c.*,cl.category_lang_id,cl.lang_id,cl.name,cl.description_short,cl.description')
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
                return $result->categoryImage = $this->getCategoryImage($res->category_id,$lang_id);
            }else{
                $result = $query->result();
                foreach($result as &$res){
                    $res->categoryImage = $this->getCategoryImage($res->category_id,$lang_id);
                }
                return $result;
            }
               
        }
        return false;
    }

    public function getCategoryImage($category_id,$lang_id = null){
        $where = ['category_id' => $category_id];
        $query = $this->db->get_where('category_image',$where);
        $result = $query->num_rows();
        if($result > 0){
            $resultArr = $query->result();
            foreach($resultArr as &$res){
                $res->categoryImage_name = $this->getCategoryImageName($res->category_image_id,$lang_id);
            }
            return $resultArr;
        }
        else
        {
            return false;
        }
    }

    public function getCategoryImageName($category_image_id,$lang_id = null){
        $where = ['category_image_id' => $category_image_id];
        if(!empty($lang_id)){
            $where = array_merge($where,['lang_id' => $lang_id]);
        }
        $query = $this->db->get_where('category_image_lang',$where);
        $result = $query->num_rows();
        return ($result > 0)?$query->result():false;
    }

}
