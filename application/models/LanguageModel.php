<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LanguageModel extends DR_Model {
    public $lang_id = "1";
    public function __construct(){
        parent::__construct();
    }

    public function language(){
        $result = $this->db->get_where('language',['active' => '1'])->result();
        return $result;
    }
}
