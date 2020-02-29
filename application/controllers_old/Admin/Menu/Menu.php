<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class Menu extends Admin {
	public function __construct()
	{
		parent::__construct();
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
		$search = "";
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$this->data['title'] = trans('categories');
		$this->data['form_action'] = base_url('admin/menu');
		$this->data['add_menu'] = base_url('admin/menu/create');
		$this->data['search'] = $search;
		$this->data["results"] = $this->MenuModel->getMenus($this->lang_id,$search);
		$this->template('admin/menu/index',$this->data);

    }  // end index function
    


	/* 
		show form for creation 
	*/
	public function create()
	{
		$form_post_data = [];
		$menuData = [];
		$postData = $this->PostModel->getPostData($this->lang_id);
		if(!empty($_POST)){
			
			$this->form_validation->set_rules('name',"Name", "trim|required");
			$this->form_validation->set_rules('post_ids[]',"Post Ids", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$form_post_data = $_POST;
				$post_ids = $form_post_data["post_ids"];
				$menuData = $this->PostModel->getPostMenu($post_ids,$this->lang_id);
			}
		}

		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}
		
		$this->data['title'] = trans('add_menu');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/menu/create");
		$this->data['menu_form_action'] = base_url("admin/menu/createMenu");
		$this->data['back_action'] = base_url("admin/menu");
		$this->data['category_data'] = $postData["category_data"]; 
		$this->data['page_data'] = $postData["page_data"];
		$this->data['post_data'] = $postData["post_data"];
		$this->data["menu_data"] = $menuData;
		$this->data['form_post_data'] = $form_post_data;
		$this->template('admin/menu/create',$this->data);
    }

    public function createMenu($menu_id = null){
    	extract($_POST);
    	if(!empty($menu_id)){
    		$menu_title = 'menu_updated';
    		$menuData = ["active" => "1","updated_at" => $this->current_datetime];
    		$this->db->where(["menu_id" => $menu_id])->update("menu",$menuData);
    	}else{
    		$menu_title = 'menu_created';
    		$menuData = ["active" => "1","created_at" => $this->current_datetime,"updated_at" => $this->current_datetime];
    		$this->db->insert("menu",$menuData);
    		$menu_id = $this->db->insert_id();
    	}
   
    	$menuLangData = [
    			"menu_id" => $menu_id,
    			"lang_id" => $lang_id,
    			"name" => $name,
    			"menu_description" => $menu_description
    	];
    	$this->db->where(["menu_id" => $menu_id,"lang_id" => $lang_id])->delete("menu_lang");
    	$this->db->insert("menu_lang",$menuLangData);
    	$this->session->set_flashdata('success', trans($menu_title));
        redirect(base_url('admin/menu'));	
    }
    
    /* 
		show data using id
		@get method
	*/

	public function show($id)
	{
		$this->data['title'] = trans('user_details');
		$this->data['id'] = $id;
		$this->data['user'] = $this->UserModel->getUser($id);
		$this->template('admin/user/show',$this->data);
    }
    


	/* 
		edit data using id
		@get method
	*/


	public function edit($id)
	{
		$form_post_data = [];
		$post_ids = [];
		$menuData = [];
		$postData = $this->PostModel->getPostData($this->lang_id);
		$menu = $this->MenuModel->getMenu($id,$this->lang_id);
		if(!empty($menu)){
			$menuArr = json_decode($menu->menu_description,true);
			$post_ids = array_multi_column($menuArr,"post_id","children");
			################ start menu data for menu json  ########################################
			$menuData = json_decode($menu->menu_description);
			################ end menu data for menu json  ########################################
		}
		if(!empty($_POST)){
			
			$this->form_validation->set_rules('name',"Name", "trim|required");
			$this->form_validation->set_rules('post_ids[]',"Post Ids", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$form_post_data = $_POST;
				$post_ids = $form_post_data["post_ids"];
				############# start menu data for menu json using function #######################
				$menuData = $this->PostModel->getPostMenu($post_ids,$this->lang_id);
				############## end menu data for menu json using function #######################
			}
		}

		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}
		
		$this->data['title'] = trans('edit_menu');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/menu/edit/".$id);
		$this->data['menu_form_action'] = base_url("admin/menu/createMenu/".$id);
		$this->data['back_action'] = base_url("admin/menu");
		$this->data['category_data'] = $postData["category_data"]; 
		$this->data['page_data'] = $postData["page_data"];
		$this->data['post_data'] = $postData["post_data"];
		$this->data['form_post_data'] = $form_post_data;
		$this->data['menu'] = $menu;
		$this->data['post_ids'] = $post_ids;
		$this->data["menu_data"] = $menuData;
		$this->template('admin/menu/edit',$this->data);

	}

	public function updateStatus(){
		$menu_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?'menu_activated':'menu_deactivated';
		$this->db->where(["menu_id" => $menu_id])->update("menu",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}

	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$menu_id = $this->input->post('id');
		$this->db->where(["menu_id" => $menu_id])->delete(["menu_lang","menu"]);
		$this->session->set_flashdata('success', trans('menu_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}

}
