<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class Category extends Admin {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');

    }
	
	/* 
		show all data
	*/
	public function index($page=null)
	{
		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		$config = [];
		$search = "";
		$condition = ["post_type" => "2"];
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$this->data['title'] = trans('categories');
		$this->data['form_action'] = base_url('admin/category');
		$this->data['add_category'] = base_url('admin/category/create');
		$this->data['search'] = $search;
		$total_row = $this->PostModel->count($condition,$search);
		$config = $this->config->item("pagination_config");
		$config["total_rows"] = $total_row;
		$config["per_page"] = 30;
		$config['num_links'] = 5;
		$config["base_url"] = $this->data['form_action'];
		if(!empty($search)){
			$config['suffix'] = "?search=$search";
		}
		
		$this->pagination->initialize($config);
		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}
		else{
			$page = 0;
		}
		$this->data["results"] = $this->PostModel->getPosts($condition,$config["per_page"], $page,$search);
		$str_links = $this->pagination->create_links();
		$this->data["links"] = $str_links;
		$this->template('admin/category/index',$this->data);

    }  // end index function
    


	/* 
		show form for creation 
	*/
	public function create()
	{
		
		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			$this->form_validation->set_rules('description_short[]',"Short description", "trim|required");
			$this->form_validation->set_rules('slug[]',"Slug", "trim|required");
			$this->form_validation->set_rules('short_order',"Short order", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$postData = $_POST;
				$postData["post_type"] = "2";
				$postData["languages"] = $this->data['languages'];
				$post_id = $this->PostModel->createPost($postData);
				if(!empty($post_id)){
					$this->session->set_flashdata('success', trans('category_created'));
		            redirect($_SERVER['HTTP_REFERER']);	
				}else{
					$this->session->set_flashdata('error', trans('something_wrong'));
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		$this->data['title'] = trans('add_category');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/category/create");
		$this->data['back_action'] = base_url("admin/category");
		$this->template('admin/category/create',$this->data);
    }
    

    
    /* 
		show data using id
		@get method
	*/

	public function show($id)
	{
		$this->data['title'] = trans('category_details');
		$this->data['id'] = $id;
		$this->data['post'] = $this->PostModel->getPost($id);
		$this->template('admin/category/show',$this->data);
    }
    


	/* 
		edit data using id
		@get method
	*/

	public function edit($id)
	{
		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			$this->form_validation->set_rules('description_short[]',"Short description", "trim|required");
			$this->form_validation->set_rules('slug[]',"Slug", "trim|required");
			$this->form_validation->set_rules('short_order',"Short order", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$postData = $_POST;
				$postData["post_type"] = "2";
				$postData["languages"] = $this->data['languages'];
				$post_id = $this->PostModel->updatePost($postData,$id);
				if(!empty($post_id)){
					$this->session->set_flashdata('success', trans('category_updated'));
		            redirect($_SERVER['HTTP_REFERER']);	
				}else{
					$this->session->set_flashdata('error', trans('something_wrong'));
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}

		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		$this->data['title'] = trans('edit_category');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/category/edit/".$id);
		$this->data['back_action'] = base_url("admin/category");
		$post = $this->PostModel->getPost($id);
		$this->data['post'] = $post;
		$this->template('admin/category/edit',$this->data);

	}


	public function updateStatus(){
		$post_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?'category_activated':'category_deactivated';
		$this->db->where(["post_id" => $post_id])->update("post",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}




	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$post_id = $this->input->post('id');
		$post_type = $this->input->post('post_type');
		$post_type = "1";
		if($post_type == "1"){
		 	$this->db->where(["post_id" => $post_id])->delete(["post_lang","post"]);
		}else{
			// $filePath = FCPATH."uploads/category/";
			// $table = "category_image";
			// $select = "image_name";
			// $where = ["category_id" => $category_id];
			// unlinkFile($filePath,$table,$select,$where);
			// $this->db->where(["category_id" => $category_id])->delete(["category_image","category_lang","iq_category_rates","category"]);

		}
		$this->session->set_flashdata('success', trans('category_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}


	

	public function manageLanguage(){
		$string = APPPATH.'language/english/admin_lang.php';
		show_source($string);
		// dd($data);

	}

}
