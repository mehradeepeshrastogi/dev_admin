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
		
	}

	/* 
		show all data
	*/
	public function index($slug=null)
	{
		$post_type = "home";
		$post_id = null;
		if(!empty($slug)){
			$post= $this->website_modal->getPost($slug);
			$post_type = $post["post_type"];
			$post_id = $post["post_id"];
		}

		############# post type = 1 (Post) ###############
		switch ($post_type) {
			case '1':
				#########  $post_type = 1 (post) ########
				break;
			
			case '2':
				######### $post_type = 2 (category) ########
				$this->category($post_id);
				break;

			case '3':
				######### $post_type = 3 (page) ########
				break;

			default:
				# home page
				$this->home();
				break;
		}

		dd($this->data);
	}

	public function home(){
		$this->data["slider"] = "slider,description";
		$this->data["services"] = "services list";
		$this->data["display_blog"] = "popular,new,feature";
		$this->data["tips"] = "popular,new,feature";
		$this->data["footer_blog"] = "popular,new,feature";
		$this->data["resource_footer"] = "popular,new,feature";
		$this->data["footer_testimonials"] = "popular,new,feature";
		$this->data["footer_social"] = "popular,new,feature";
	}

	public function category($post_id=null,$slug=null){
		if(!empty($post_id)){
			$this->db->where(["post_id" => $post_id,"pl.lang_id" => $this->lang_id]);	
		}
		if(!empty($slug)){
			$this->db->where(["pl.slug" => $slug,"pl.lang_id" => $this->lang_id]);
		}


	}

	public function about(){
		echo "about";
	}
}
