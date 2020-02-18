<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(API_CONTROLLER_PATH.'Api.php');


class Page extends Api {

    public function __construct()
	{
		parent::__construct();
    }

    public function page(){
        try{
            // get cateogry using $this->lang_id;
        }catch(Exception $ex){
            $ex->getException();
        }finally{

        }
    }

    public function pageDetails($page_id){
        try{
            // get page using $this->lang_id;
        }catch(Exception $ex){
            $ex->getException();
        }finally{

        }
    }

}