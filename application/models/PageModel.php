<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageModel extends DR_Model {
    public $lang_id;
    public function __construct(){
        parent::__construct();
        $adminData = $this->session->userdata('adminData');
		$this->lang_id = !empty($adminData)?$adminData->lang_id:'1';
    }

    public function count($search=null){
        if(!empty($search)){
            $this->db->where("pl.name LIKE '%$search%'");
        }
        $query = $this->db->from("page as p")->join("page_lang as pl","pl.page_id = p.page_id","left")->where(['lang_id' => $this->lang_id ])->get();
        $result = $query->num_rows();
        return $result;
    }


    /* 
        get all categories with pagination
    */

    public function getPages($limit,$start,$search=null){
        if($start < 1){
            $start = 0;
        }else{
            $start = $start - 1;
        }
        if(!empty($search)){
            $this->db->where("pl.name LIKE '%$search%'");
        }
        
        $query = $this->db->select('p.page_id,p.slug,p.active,pl.name')->from('page as p')
        ->join('page_lang as pl','pl.page_id = p.page_id','left')
        ->limit($limit,$start)->where([ 'pl.lang_id' => $this->lang_id ])->order_by('short_order','asc')->get();
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result();
        }
        return false;
    }

    public function getPage($page_id,$lang_id=null){
        $return = "result";
        $this->db->select(' p.*,pl.page_lang_id,pl.lang_id,pl.name,pl.description')
        ->from('page as p')
        ->join('page_lang as pl','pl.page_id = p.page_id','left')
        ->where(['p.page_id' => $page_id]);
        
        if(!empty($lang_id)){
            $return = "row";
            $this->db->where(['pl.lang_id' => $lang_id]);
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

        $query = $this->db->select("p.page_id,pl.name,pl.description")
        ->from("page as p")->join("page_lang as pl","pl.page_id = p.page_id","left")->where(["pl.lang_id" => $lang_id])
        ->order_by('short_order')
        ->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result;
        
    } // end getAllCategories function


}
    