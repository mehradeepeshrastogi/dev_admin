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
		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			$this->form_validation->set_rules('description_short[]',"Short description", "trim|required");
			$this->form_validation->set_rules('slug[]',"Slug", "trim|required");
			$this->form_validation->set_rules('short_order',"Short order", "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				 redirect($_SERVER['HTTP_REFERER']);	
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
