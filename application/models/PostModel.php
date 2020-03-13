<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class PostModel extends DR_Model {
    public $lang_id;
    public function __construct(){
        parent::__construct();
        $adminData = $this->session->userdata('adminData');
		$this->lang_id = !empty($adminData)?$adminData->lang_id:'1';
    }

    public function count($condition,$search=null){
        if(!empty($search)){
            $this->db->where("pl.name LIKE '%$search%'");
        }
        if(!empty($condition)){
            if(array_key_exists("post_type", $condition)){
                $this->db->where(["p.post_type" => $condition["post_type"]]);
            }
        }
        $query = $this->db->from("post as p")->join("post_lang as pl","pl.post_id = p.post_id","left")->where(['pl.lang_id' => $this->lang_id ])->get();
        $result = $query->num_rows();
        return $result;
    }

    public function createPost($postData){
        $post = [
                'short_order' => $postData['short_order'],
                'active' => $postData['active'],
                'post_type' => $postData['post_type'],
                'post_image' => $postData['post_image'],
                'created_at' => $this->current_datetime,
                'updated_at' => $this->current_datetime
            ];
        $this->db->insert('post',$post);
        $post_id = $this->db->insert_id();
        if(!empty($post_id) && !empty($postData["languages"])){
            foreach($postData["languages"] as $k=>$language){
                    $description_short = !empty($postData['description_short'][$language->lang_id])?$postData['description_short'][$language->lang_id]:'';
                    $description = !empty($postData['description'][$language->lang_id])?$postData['description'][$language->lang_id]:'';
                    $meta_title = !empty($postData['meta_title'][$language->lang_id])?$postData['meta_title'][$language->lang_id]:'';
                    $meta_keyword = !empty($postData['meta_keyword'][$language->lang_id])?$postData['meta_keyword'][$language->lang_id]:'';
                    $meta_description = !empty($postData['meta_description'][$language->lang_id])?$postData['meta_description'][$language->lang_id]:'';
                    $slug = !empty($postData['slug'][$language->lang_id])?$postData['slug'][$language->lang_id]:'';
                    $postLang[] = [
                        'post_id' => $post_id,
                        'name' => $postData['name'][$language->lang_id],
                        'description_short' => $description_short,
                        'description' => $description,
                        'slug' => $slug,
                        'meta_title' => $meta_title,
                        'meta_keyword' => $meta_keyword,
                        'meta_description' => $meta_description,
                        'lang_id' => $language->lang_id
                    ];
                } // end foreach languages
            $this->db->insert_batch("post_lang",$postLang);
        }
        return $post_id;

    }

    public function updatePost($postData,$post_id){
        $post = [
                'short_order' => $postData['short_order'],
                'active' => $postData['active'],
                'post_type' => $postData['post_type'],
                'post_image' => $postData['post_image'],
                'created_at' => $this->current_datetime,
                'updated_at' => $this->current_datetime
            ];
        $this->db->where(["post_id" => $post_id])->update('post',$post);
        if(!empty($post_id) && !empty($postData["languages"])){
            $this->db->where(["post_id" => $post_id])->delete("post_lang");
            foreach($postData["languages"] as $k=>$language){
                    $description_short = !empty($postData['description_short'][$language->lang_id])?$postData['description_short'][$language->lang_id]:'';
                    $description = !empty($postData['description'][$language->lang_id])?$postData['description'][$language->lang_id]:'';
                    $meta_title = !empty($postData['meta_title'][$language->lang_id])?$postData['meta_title'][$language->lang_id]:'';
                    $meta_keyword = !empty($postData['meta_keyword'][$language->lang_id])?$postData['meta_keyword'][$language->lang_id]:'';
                    $meta_description = !empty($postData['meta_description'][$language->lang_id])?$postData['meta_description'][$language->lang_id]:'';
                    $slug = !empty($postData['slug'][$language->lang_id])?$postData['slug'][$language->lang_id]:'';
                    $postLang[] = [
                        'post_id' => $post_id,
                        'name' => $postData['name'][$language->lang_id],
                        'description_short' => $description_short,
                        'description' => $description,
                        'slug' => $slug,
                        'meta_title' => $meta_title,
                        'meta_keyword' => $meta_keyword,
                        'meta_description' => $meta_description,
                        'lang_id' => $language->lang_id
                    ];
                } // end foreach languages
            $this->db->insert_batch("post_lang",$postLang);
        }
        return $post_id;

    }



    public function getPost($post_id){
        $result = [];
        $query = $this->db->select("p.*,pl.lang_id,pl.name,pl.description_short,pl.description,slug,pl.meta_title,pl.meta_keyword,pl.meta_description")
        ->from("post as p")
        ->join("post_lang as pl","pl.post_id = p.post_id","left")
        ->where(["p.post_id" => $post_id])
        ->get();
        if($query->num_rows() > 0){
            $result = $query->result();
        }
        return $result;
    }

    /* 
        get all categories with pagination
    */
    

    public function getPosts($condition,$limit,$start,$search=null){
        $resultData = [];
        if($start < 1){
            $start = 0;
        }else{
            $start = $start - 1;
        }
        if(!empty($search)){
            $this->db->where("pl.name LIKE '%$search%'");
        }
        if(!empty($condition)){
            if(array_key_exists("post_type", $condition)){
                $this->db->where(["p.post_type" => $condition["post_type"]]);
            }
        }
    
        $query = $this->db->select("p.post_id, p.active, pl.name,IFNULL(concat('".base_url()."',pl.slug),'') as slug")->from('post as p')
        ->join('post_lang as pl','pl.post_id = p.post_id','left')
        ->limit($limit,$start)->where([ 'pl.lang_id' => $this->lang_id ])->order_by('short_order','asc')->order_by("post_id","desc")->get();
        $result = $query->num_rows();
        if ($result > 0) {
            $resultData = $query->result();
        }
        return $resultData;
    }

    public function getCategory($post_id,$lang_id=null){
        $return = "result";
        $this->db->select(' c.*,pl.post_lang_id,pl.lang_id,pl.name,pl.description_short')
        ->from('post as c')
        ->join('post_lang as pl','pl.post_id = c.post_id','left')
        ->where(['c.post_id' => $post_id]);
        
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

        $query = $this->db->select("c.post_id,pl.name,pl.description,IFNULL((select if(ci.image_name='','',CONCAT('".base_url('uploads/post/')."',ci.image_name)) from iq_post_image as ci where ci.post_id = c.post_id AND ci.cover = '1'),'') as image_name")
        ->from("post as c")->join("post_lang as pl","pl.post_id = c.post_id","left")->where(["pl.lang_id" => $lang_id])
        ->order_by('short_order')
        ->get();

        if($query->num_rows() > 0){
            $result = $query->result();
            foreach($result as &$res){
                $res->images = $this->getCategoryImageForAPI($res->post_id);
            }
        }
        return $result;
        
    } // end getAllCategories function

    public function getCategoryImageForAPI($post_id){
        $resultArr = [];
        $where = ['post_id' => $post_id,'cover !=' => '1'];
        $query = $this->db->select("*,IF(image_name = '','',CONCAT('".base_url('uploads/post/')."',image_name) ) as image_name")->get_where('post_image',$where);
        $result = $query->num_rows();
        if($result > 0){
            $resultArr = $query->result();
        }
        return $resultArr;
    }

    
    public function getPostData($lang_id){
        $category_data = [];
        $page_data = [];
        $post_data = [];
        $resultData = [];
        $categoryData = $this->db->select("p.post_id,pl.name")->from("post as p")->join("post_lang as pl","pl.post_id = p.post_id","left")->where(["pl.lang_id" => $lang_id,"p.active" => "1","p.post_type" => "2"])->get();
        $pageData = $this->db->select("p.post_id,pl.name")->from("post as p")->join("post_lang as pl","pl.post_id = p.post_id","left")->where(["pl.lang_id" => $lang_id,"p.active" => "1","p.post_type" => "3"])->get();

        $postData = $this->db->select("p.post_id,pl.name")->from("post as p")->join("post_lang as pl","pl.post_id = p.post_id","left")->where(["pl.lang_id" => $lang_id,"p.active" => "1","p.post_type" => "1"])->get();

        if($categoryData->num_rows() > 0){
            $category_data = $categoryData->result_array();
        }

        if($pageData->num_rows() > 0){
            $page_data = $pageData->result_array();
        }
        if($postData->num_rows() > 0){
            $post_data = $postData->result_array();
        }

        $resultData = ["category_data" => $category_data, "page_data" => $page_data, "post_data" => $post_data];

        return $resultData;
    }

    public function getPostMenu($post_ids,$lang_id){
        $result = $this->db->select("p.post_id,pl.name as text,'_top' as target,pl.name as title,IF(pl.slug != '',concat('".base_url()."',pl.slug),'') as href")->from("post as p")->join("post_lang as pl","pl.post_id = p.post_id","left")->where(["pl.lang_id" => $lang_id,"p.active" => "1"])->where_in("p.post_id",$post_ids)->get()->result_array();
        return $result;

    }


}
    