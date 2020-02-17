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
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$this->data['title'] = trans('categories');
		$this->data['form_action'] = base_url('admin/category');
		$this->data['add_category'] = base_url('admin/category/create');
		$this->data['search'] = $search;
		$config["base_url"] = base_url() . "admin/category";
		$total_row = $this->CategoryModel->count($search);
		$config["total_rows"] = $total_row;
		$config["per_page"] = 30;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = trans('next');
		$config['prev_link'] = trans('previous');
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
		$this->data["results"] = $this->CategoryModel->getCategories($config["per_page"], $page,$search);
		$str_links = $this->pagination->create_links();
	
		$this->data["links"] = explode('&nbsp;',$str_links);
		$this->template('admin/category/index',$this->data);

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

		$this->data['title'] = trans('add_category');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/category/store");
		$this->data['back_action'] = base_url("admin/category");
		$this->template('admin/category/create',$this->data);
    }
    


	/* 
		save data to database
		@post method 
	*/
	public function store()
	{
		$this->form_validation->set_rules('name[]',"Name", "trim|required");
		$this->form_validation->set_rules('description_short[]',"Short description", "trim|required");
		// $this->form_validation->set_rules('description[]',"Description", "trim|required");
		$this->form_validation->set_rules('slug',"Slug", "trim|required");
		$this->form_validation->set_rules('short_order',"Short order", "trim|required");

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			$this->create();
		}else{
			$postData = $_POST;

			//////////////////// Insert data in category table /////////////////////////

			$category = [
				'short_order' => $postData['short_order'],
				'active' => $postData['active'],
				'slug' => $postData['slug'],
				'created_at' => $this->current_datetime,
				'updated_at' => $this->current_datetime
			];
			$this->db->insert('category',$category);
			$category_id = $this->db->insert_id();

			//////////////////// end Insert data in category table /////////////////////////
			

			if(!empty($category_id)){

				
				//////////////  Insert Category Language data  ////////////////////////////
				
				foreach($this->data['languages'] as $k=>$language){
					$categoryLang[] = [
						'name' => $postData['name'][$language->lang_id],
						'description_short' => $postData['description_short'][$language->lang_id],
						// 'description' => $postData['description'][$language->lang_id],
						'category_id' => $category_id,
						'lang_id' => $language->lang_id
					];
				} // end foreach languages

				$this->db->insert_batch("category_lang",$categoryLang);

				////////////////////// end category language data ///////////////////////////

/*

			/////////////////////// upload category image data /////////////////////////////////
			
				$filesCount = count($_FILES['image']['name']);
				$uploadData = [];
				if($filesCount){

					for($i = 0; $i < $filesCount; $i++){

						if(!empty($_FILES['image']['name'][$i])){

								$_FILES['file']['name']     = time().$_FILES['image']['name'][$i];
								$_FILES['file']['type']     = $_FILES['image']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
								$_FILES['file']['error']     = $_FILES['image']['error'][$i];
								$_FILES['file']['size']     = $_FILES['image']['size'][$i];
								
								// File upload configuration
								$uploadPath = 'uploads/category/';
								$config['upload_path'] = $uploadPath;
								$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
								
								// Load and initialize upload library
								$this->load->library('upload', $config);
								$this->upload->initialize($config);
								
								// Upload file to server
								if($this->upload->do_upload('file')){
									// Uploaded file data
									$fileData = $this->upload->data();
									$cover_image = '0';
									if($i == $postData['cover_image']){
										$cover_image = '1';
									}
									
									$uploadData[$i]['category_id'] = $category_id;
									$uploadData[$i]['name'] = $postData['image_name'][$i];
									$uploadData[$i]['cover'] = $cover_image;
									$uploadData[$i]['image_name'] = $fileData['file_name'];
									
								} // end if do_upload

						} // end if = filename not empty
					
					} // end for loop
					if(!empty($uploadData)){
						$this->db->insert_batch("category_image",$uploadData);
					}
					

				} // end if File count
				
		/////////////////////////// end upload category image data /////////////////////////
			
*/

				$this->session->set_flashdata('success', trans('category_created'));
                redirect($_SERVER['HTTP_REFERER']);	
			}else{
				$this->session->set_flashdata('error', trans('something_wrong'));
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		
    }
    
    /* 
		show data using id
		@get method
	*/

	public function show($id)
	{
		$this->data['title'] = trans('category_details');
		$this->data['id'] = $id;
		$this->data['category'] = $this->CategoryModel->getCategory($id);
		$this->template('admin/category/show',$this->data);
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

		$this->data['title'] = trans('edit_category');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/category/update/".$id);
		$this->data['back_action'] = base_url("admin/category");
		$category = $this->CategoryModel->getCategory($id);
		$this->data['category'] = $category;
		$this->template('admin/category/edit',$this->data);

	}



	/* 
		update data using id
		@post method
	*/
	
	public function update($category_id)
	{
		$postData = $_POST;
		// dd($postData);
		$category = [
			'short_order' => $postData['short_order'],
			'slug' => $postData['slug'],
			'active' => $postData['active'],
			'created_at' => $this->current_datetime,
			'updated_at' => $this->current_datetime
		];
		$this->db->where('category_id',$category_id)->update('category',$category);
		$this->db->where('category_id',$category_id)->delete(["category_lang"]);

		//////////////  Insert Category Language data  ////////////////////////////
				
		foreach($this->data['languages'] as $k=>$language){
			$categoryLang[] = [
				'name' => $postData['name'][$language->lang_id],
				'description_short' => $postData['description_short'][$language->lang_id],
				// 'description' => $postData['description'][$language->lang_id],
				'category_id' => $category_id,
				'lang_id' => $language->lang_id
			];
		} // end foreach languages

		$this->db->insert_batch("category_lang",$categoryLang);

		////////////////////// end category language data ///////////////////////////

		
		$this->session->set_flashdata('success', trans('category_updated'));
        redirect($_SERVER['HTTP_REFERER']);	

		
	}

	public function updateStatus(){
		$category_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?'category_activated':'category_deactivated';
		$this->db->where(["category_id" => $category_id])->update("category",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}




	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$category_id = $this->input->post('id');
		$filePath = FCPATH."uploads/category/";
		$table = "category_image";
		$select = "image_name";
		$where = ["category_id" => $category_id];
		unlinkFile($filePath,$table,$select,$where);
		$this->db->where(["category_id" => $category_id])->delete(["category_image","category_lang","iq_category_rates","category"]);
		$this->session->set_flashdata('success', trans('category_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}


	public function postCategoryData($post,$id=null){

	
		
		if(!empty($_FILES['image']['name'])){
			$file_name = "MAIN.jpg";
			$categoryArr = str_split($id_category);
			$folder = implode('/',$categoryArr);
			$upload_path = CATEGORY_IMAGE_PATH.$folder;
			
			if (!file_exists($upload_path)) {
				mkdir($upload_path, 0777, true);
			}

			$upload_conf = array(
				'file_name'  =>   $file_name,
				'upload_path'   => realpath($upload_path),
				'allowed_types' => 'gif|jpg|jpeg|png',
				'max_size'      => '300000',
				);
				 
				$this->load->library('upload');
				$this->upload->initialize( $upload_conf );
				$field_name = 'image';
				 
				if ( !$this->upload->do_upload('image','')){
					$error['upload']= $this->upload->display_errors();				
				}else{
					$catImgArr = [
						'name' => $_FILES['image']['name'],
						'id_category' => $id_category,
					];
					$this->db->insert('category_image',$catImgArr);
					$id_image = $this->db->insert_id();

					$upload_data = $this->upload->data();
					$category_imageArr = CATEGORY_IMAGE_ARRAY;
					foreach($category_imageArr as $image){
						$resize_conf = array(
							'upload_path'  => realpath($upload_path),
							'source_image' => $upload_data['full_path'], 
							'new_image'    => $upload_data['file_path'].$image['prefix'].$id_image.$image['type'],
							'width'        => $image['width'],
							'height'       => $image['height']
						);
						$this->load->library('image_lib'); 
						$this->image_lib->initialize($resize_conf);
						$this->image_lib->resize();
					} // end foreach image array

				} // end else file successfully uploading

		} // end file exist

	} // end function

	public function manageLanguage(){
		$string = APPPATH.'language/english/admin_lang.php';
		show_source($string);
		// dd($data);

	}

}
