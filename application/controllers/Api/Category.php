<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(API_CONTROLLER_PATH.'Api.php');


class Category extends Api {

    public function __construct()
	{
		parent::__construct();
    }

    public function index(){
        try{
            // get cateogry using $this->lang_id;
            $this->data['data'] = $this->CategoryModel->getAllCategories($this->lang_id);
        }catch(Exception $ex){
            $ex->getException();
        }finally{
            $this->responseData = [
                "success" => true,
                "message" => !empty($this->data['data'])?trans("category_success"):trans("no_category"),
                "data" => $this->data['data'],
                "error" => false,
                "code" => 200
            ];
            dj($this->responseData);     
        }
    }

    public function categoryDetails($page_id){
        try{
            // get cateogry using $this->lang_id;
        }catch(Exception $ex){
            $ex->getException();
        }finally{

        }
    }

}