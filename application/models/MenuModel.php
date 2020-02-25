<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuModel extends DR_Model {
    public $currentTime;
    
    public function __construct(){
        parent::__construct();
        $this->currentTime = date('Y-m-d H:i:s');
    }

    public function count($lang_id,$search=null){
        if(!empty($search)){
            $this->db->where("name LIKE '%$search%' OR email LIKE '%$search%' OR user_name LIKE '%$search%' OR phone LIKE '%$search%' ");
        }
        $query = $this->db->from("users")->get();
        $result = $query->num_rows();
        return $result;
    }

    public function getMenus($lang_id,$search=null){
        $resultData = [];
        if(!empty($search)){
            $this->db->where("ml.name LIKE '%$search%'");
        }
        $query = $this->db->select('m.*,ml.lang_id,ml.name,ml.menu_description')->from('menu as m')->join("menu_lang as ml","ml.menu_id = m.menu_id")->where(["ml.lang_id" => $lang_id])->get();
        $result = $query->num_rows();
        if ($result > 0) {
            $resultData = $query->result();
        }
        return $resultData;
    }

    public function getMenu($menu_id,$lang_id){
        $resultData = [];
        $query = $this->db->select('m.*,ml.lang_id,ml.name,ml.menu_description')->from('menu as m')->join("menu_lang as ml","ml.menu_id = m.menu_id")->where(["ml.lang_id" => $lang_id,"m.menu_id" => $menu_id])->get();
        $result = $query->num_rows();
        if ($result > 0) {
            $resultData = $query->row();
        }
        return $resultData;
    }
}
