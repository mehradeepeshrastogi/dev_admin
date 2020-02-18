<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DR_Model extends CI_Model {

    
    
    public function getRows($conditions = array()){

        /*
    $condition = [
        'table' => "category as C",
        'select' => "C.id_category,C.id_parent,C.active,CL.name,(SELECT `name` FROM `category_lang` WHERE id_category = C.id_parent AND id_lang = CL.id_lang) AS category_parent,CI.id_image",
        'join' => [
                        [
                            "table" => "category_lang as CL",
                            "on" => "CL.id_category = C.id_category",
                            "type" => "left"
                        ],
                        [
                            "table" => "category_image as CI",
                            "on" => "CI.id_category = C.id_category",
                            "type" => "left"
                        ]
                  ],
        'where' => [
                        "id_category" => "1",
                        "name" => "test"
        ],
        'order_by' => 'id_category desc',
        'start' => '1',
        'limit' => '10'
    */

        if(array_key_exists("table",$conditions)){
            $table = $conditions['table'];
        }

       $select = array_key_exists("select",$conditions)?$conditions['select']:'*';
   
       $this->db->select($select)->from($table);
       if(array_key_exists("join",$conditions)){
           foreach($conditions["join"] as $join){
               $this->db->join($join["table"],$join["on"],$join["type"]);
           }
       }

       if(array_key_exists("where",$conditions)){
           $this->db->where($conditions["where"]);
       }
       
       if(array_key_exists("order_by",$conditions)){
           $this->db->order_by($conditions["order_by"]);
       }
       
       if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
           $this->db->limit($conditions['limit'],$conditions['start']); 
       }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
           $this->db->limit($conditions['limit']); 
       }

       $query = $this->db->get();
       if($query->num_rows() > 0){
           if(array_key_exists("return_type",$conditions)){
               switch($conditions['return_type']){
                   case 'count':
                       $data = $query->num_rows();
                       break;
                   case 'row':
                       $data = $query->row();
                       break;
                   case 'result':
                   $data = $query->result();
                       break;
                   case 'row_array':
                   $data = $query->row_array();
                       break;
                   case 'result_array':
                   $data = $query->result_array();
                       break;
                   default:
                       $data = '';
                       break;
               }
           }
           else{
               if($query->num_rows() > 0){
                   $data = $query->result();
               }
           }
       }
    //    echo $this->db->last_query();
       return !empty($data)?$data:false;
   }

   public function getProducts($id_category=Null,$page=0,$per_page=10,$searchData=null)
   {
         $from = $page*$per_page - $per_page;
         if($page==1){ $from = 0; }
         if($from<0){ $from = 1; }
         
       $this->db->select('*')->from('product');
       if(!empty($searchData)){
           $this->db->where("Artikel_Nr LIKE '%$searchData%' OR Artikelbezeichnung LIKE '%$searchData%' OR EAN_Code LIKE '%$searchData%' OR Preis_Netto LIKE '%$searchData%' OR UVP_inkl_MwSt LIKE '%$searchData%'");
       }

       if(!empty($id_category)){
           $query = $this->db->where('id_category',$id_category)->get();
           $countQuery = $this->db->last_query()." limit ".$from.", ".$per_page;
           $data['products'] = $this->db->query($countQuery)->result();
           $data['pagination']['total'] =  $query->num_rows();
         }else{
           $query = $this->db->get();
           $countQuery = $this->db->last_query()." limit ".$from.", ".$per_page;
           $data['products'] = $this->db->query($countQuery)->result();
           $data['pagination']['total'] =  $query->num_rows();
         }
     
     $data['headers'] =  $this->db->list_fields('product');
     $data['pagination']['last_page'] = ceil($data['pagination']['total']/$per_page);
     $data['pagination']['from'] = ($from)?$from+1:1;
     $data['pagination']['to'] = (int) (($from)?$from+1:0)+$per_page;
     $data['pagination']['per_page'] = (int) $per_page;
     $data['pagination']['current_page'] = (int) $page;
 
     return $data;
         
   }

}
