<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class CategoryLang extends Admin {
	
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
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$this->data['title'] = trans('categories');
		$this->data['form_action'] = base_url('admin/category_lang');
		$this->data['add_category'] = base_url('admin/category_lang/create');
		$this->data['search'] = $search;
		$config["base_url"] = base_url() . "admin/category_lang";
		$total_row = $this->CategoryLangModel->count($search);
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
		$this->data["results"] = $this->CategoryLangModel->getCategories($config["per_page"], $page,$search);
		$str_links = $this->pagination->create_links();
	
		$this->data["links"] = explode('&nbsp;',$str_links);
		$this->template('admin/categoryLang/index',$this->data);

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
		$this->data['form_action'] = base_url("admin/category_lang/store");
		$this->data['back_action'] = base_url("admin/category_lang");
		$this->template('admin/categoryLang/create',$this->data);
    }
    


	/* 
		save data to database
		@post method 
	*/
	public function store()
	{
		$this->form_validation->set_rules('name',"Name", "trim|required");
		$this->form_validation->set_rules('description',"Description", "trim|required");

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			$this->create();
		}else{
			$postData = $_POST;

			//////////////////// Insert data in category table /////////////////////////

			$category = [
				'name' => $postData['name'],
				'lang_id' => $postData['lang_id'],
                'description' =>  $postData['description'],
                'category_id' =>  1
			];
			$this->db->insert('category_lang',$category);
			$category_lang_id = $this->db->insert_id();

			//////////////////// end Insert data in category table /////////////////////////
			

			if(!empty($category_lang_id)){
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
		$this->data['category'] = $this->CategoryLangModel->getCategory($id);
		$this->template('admin/categoryLang/show',$this->data);
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
		$this->data['form_action'] = base_url("admin/category_lang/update/".$id);
		$this->data['back_action'] = base_url("admin/category_lang");
		$category = $this->CategoryLangModel->getCategory($id);
		$this->data['category'] = $category;
		$this->template('admin/categoryLang/edit',$this->data);

	}



	/* 
		update data using id
		@post method
	*/
	
	public function update($category_lang_id)
	{
		$postData = $_POST;
		// dd($postData);
		$category = [
            'name' => $postData['name'],
            'lang_id' => $postData['lang_id'],
            'description' =>  $postData['description'],
            'category_id' =>  1
		];
		$this->db->where('category_lang_id',$category_lang_id)->update('category_lang',$category);
        $this->session->set_flashdata('success', trans('category_updated'));
        redirect($_SERVER['HTTP_REFERER']);	
	}

	public function updateStatus(){
		$category_lang_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['lang_id'] == 1)?'category_activated':'category_deactivated';
		$this->db->where(["category_lang_id" => $category_lang_id])->update("category_lang",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}




	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$category_lang_id = $this->input->post('id');
		$this->db->where(["category_lang_id" => $category_lang_id])->delete(["category_lang"]);
		$this->session->set_flashdata('success', trans('category_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}


	public function postCategoryData($post,$id=null){

	
		
		if(!empty($_FILES['image']['name'])){
			$filename = $_FILES['image']['name'];
			$ext = pathinfo($filename,PATHINFO_EXTENSION);
			$file_name = 'main.'.$ext;
			$categoryArr = str_split($id_post);
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
						'id_post' => $id_post,
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

}
