<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends DR_Controller {
	public $lang_id;
	public $post_type;
	public function __construct()
	{
		parent::__construct();
		// $adminData = $this->session->userdata('adminData');
		// $this->lang_id = !empty($adminData)?$adminData->lang_id:'1';
		$this->lang_id = "1";
		$this->post_type = $this->uri->segment(2);

		if($this->lang_id==1){
			$this->lang->load('website','english');
		}else{
			$this->lang->load('website','german');
		}
		
		$this->load->library('form_validation');
		$this->load->library('pagination');

		$this->controllerName = 'website';
		$this->controllerFor = 'website';
		// $exceptMethod = ['login','isAdminLogin'];
		
		// if(! in_array($this->method,$exceptMethod)){
		// 	$this->data['adminData'] = $this->isAdminLogin();
		// }
	}

	/* 
		show all data
	*/
	public function index($slug=null)
	{
		$post_type = "home";
		if(!empty($slug)){
			$post_type = $this->website_modal->getPostType($slug);
		}

		############# post type = 1 (Post) ###############
		switch ($post_type) {
			case '1':
				#########  $post_type = 1 (post) ########
				break;
			
			case '2':
				######### $post_type = 2 (category) ########
				break;

			case '3':
				######### $post_type = 3 (page) ########
				break;

			default:
				# home page
				break;
		}
		dd($this->data);
	}

	public function about(){
		echo "about";
	}
}
