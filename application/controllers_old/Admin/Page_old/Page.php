<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class Page extends Admin {
	
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

		$config = [];
		$search = "";
		$condition = ["post_type" => "3"];
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$this->data['title'] = trans('pages');
		$this->data['form_action'] = base_url('admin/page');
		$this->data['add_page'] = base_url('admin/page/create');
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
		$this->template('admin/page/index',$this->data);

    }  // end index function
    


	/* 
		show form for creation 
	*/
	public function create()
	{
		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}


		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			// $this->form_validation->set_rules('description_short[]',"Short description", "trim|required");
			$this->form_validation->set_rules('description[]',"Description", "trim|required");
			$this->form_validation->set_rules('slug[]',"Slug", "trim|required");
			$this->form_validation->set_rules('short_order',"Short order", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				 redirect($_SERVER['HTTP_REFERER']);	
			}else{
				$postData = $_POST;
				$postData["post_type"] = "3";
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

		$this->data['title'] = trans('add_page');
		$this->data['form_action'] = base_url("admin/post/create");
		$this->data['back_action'] = base_url("admin/page");
		$this->template('admin/post/create',$this->data);
    }
    


	// /* 
	// 	save data to database
	// 	@post method 
	// */
	// public function store()
	// {
	// 	$this->form_validation->set_rules('name[]',"Name", "trim|required");
	// 	$this->form_validation->set_rules('description[]',"Description", "trim|required");
	// 	$this->form_validation->set_rules('slug',trans('slug'), "trim|required");

	// 	if($this->form_validation->run() == FALSE){
	// 		$this->session->set_flashdata('error', validation_errors());
	// 		$this->create();
	// 	}else{
	// 		$postData = $_POST;

	// 		//////////////////// Insert data in page table /////////////////////////

	// 		$page = [
 //                'slug' => $postData['slug'],
	// 			'short_order' => $postData['short_order'],
	// 			'active' => $postData['active'],
	// 			'created_at' => $this->current_datetime,
	// 			'updated_at' => $this->current_datetime
	// 		];
	// 		$this->db->insert('page',$page);
	// 		$page_id = $this->db->insert_id();

	// 		//////////////////// end Insert data in page table /////////////////////////
			

	// 		if(!empty($page_id)){
				
	// 			//////////////  Insert page Language data  ////////////////////////////
				
	// 			foreach($this->data['languages'] as $k=>$language){
	// 				$pageLang[] = [
	// 					'name' => $postData['name'][$language->lang_id],
	// 					'description' => $postData['description'][$language->lang_id],
	// 					'page_id' => $page_id,
	// 					'lang_id' => $language->lang_id
	// 				];
	// 			} // end foreach languages

	// 			$this->db->insert_batch("page_lang",$pageLang);

	// 			////////////////////// end page language data ///////////////////////////
			

	// 			$this->session->set_flashdata('success', trans('page_created'));
 //                redirect($_SERVER['HTTP_REFERER']);	
	// 		}else{
	// 			$this->session->set_flashdata('error', trans('something_wrong'));
	// 			redirect($_SERVER['HTTP_REFERER']);
	// 		}
	// 	}
		
 //    }
    
    /* 
		show data using id
		@get method
	*/

	public function show($id)
	{
		$this->data['title'] = trans('page_details');
		$this->data['id'] = $id;
		$this->data['page'] = $this->PageModel->getPage($id);
		$this->template('admin/page/show',$this->data);
    }
    


	/* 
		edit data using id
		@get method
	*/

	public function edit($id)
	{
		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		$this->data['title'] = trans('edit_page');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/page/update/".$id);
		$this->data['back_action'] = base_url("admin/page");
		$page = $this->PageModel->getPage($id);
		$this->data['page'] = $page;
		$this->template('admin/page/edit',$this->data);

	}



	/* 
		update data using id
		@post method
	*/
	
	public function update($page_id)
	{
		$postData = $_POST;
		// dd($postData);
        $page = [
            'slug' => $postData['slug'],
            'short_order' => $postData['short_order'],
            'active' => $postData['active'],
            'created_at' => $this->current_datetime,
            'updated_at' => $this->current_datetime
        ];
		$this->db->where('page_id',$page_id)->update('page',$page);
		$this->db->where('page_id',$page_id)->delete(["page_lang"]);

		//////////////  Insert page Language data  ////////////////////////////
				
		foreach($this->data['languages'] as $k=>$language){
			$pageLang[] = [
                'name' => $postData['name'][$language->lang_id],
                'description' => $postData['description'][$language->lang_id],
                'page_id' => $page_id,
                'lang_id' => $language->lang_id
            ];
		} // end foreach languages

		$this->db->insert_batch("page_lang",$pageLang);
        $this->session->set_flashdata('success', trans('page_updated'));
                redirect($_SERVER['HTTP_REFERER']);	

		/////////////////////////// end upload page image data /////////////////////////

		
	}

	public function updateStatus(){
		$page_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?'page_activated':'page_deactivated';
		$this->db->where(["page_id" => $page_id])->update("page",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}




	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$page_id = $this->input->post('id');
		$this->db->where(["page_id" => $page_id])->delete(["page_image","page_lang","page"]);
		$this->session->set_flashdata('success', trans('page_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}


}
