<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class Post extends Admin {
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
		$post_type = "3";
		$title = trans('pages');
		$add_post = trans('add_page');
		if($this->post_type == "post"){
			$post_type = "1";
			$title = trans('posts');
			$add_post = trans('add_post');
		}
		if(!empty($_GET['search'])){
			$search = $_GET['search'];
		}
		$condition = ["post_type" => $post_type];
		$this->data['title'] = $title;
		$this->data['add_post_title'] = $add_post;
		$this->data['form_action'] = base_url('admin/'.$this->post_type);
		$this->data['add_post'] = base_url('admin/'.$this->post_type.'/create');
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
		$this->template('admin/post/index',$this->data);

    }  // end index function
    


	/* 
		show form for creation 
	*/
	public function create()
	{
		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			$this->form_validation->set_rules('description[]',"Description", "trim|required");
			$this->form_validation->set_rules('slug[]',trans('slug'), "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				 // redirect($_SERVER['HTTP_REFERER']);
			}else{
				$post_type = ($this->post_type == "post")?"1":"3";
				$postData = $_POST;
				$postData["post_type"] = $post_type;
				$postData["languages"] = $this->data['languages'];
				$post_id = $this->PostModel->createPost($postData);
				if(!empty($post_id)){
					if(!empty($_FILES['image']['name'][0])){
						$this->postFiles($_FILES,$post_id);
					}
					$this->session->set_flashdata('success', trans($this->post_type.'_created'));
						redirect($this->controllerFor.'/'.strtolower($this->class));
		            // redirect($_SERVER['HTTP_REFERER']);	
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

		$this->data['title'] = trans('add_'.$this->post_type);
		$this->data['form_action'] = base_url("admin/".$this->post_type."/create");
		$this->data['back_action'] = base_url("admin/".$this->post_type);
		$this->data['image_range'] = "4";
		$this->template('admin/post/create',$this->data);
    }

/*
    public function postFiles($postFiles,$post_id){
		if(!empty($postFiles['image']['name'][0])){
			$k=0;
			foreach($postFiles['image']['name'] as $image){
				
			}
			

			$filename = $postFiles['image']['name'];
			$ext = pathinfo($filename,PATHINFO_EXTENSION);
			$file_name = 'main.'.$ext;
			$postArr = str_split($post_id);
			$folder = implode('/',$postArr);
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
					$postImgArr = [
						'name' => $postFiles['image']['name'],
						'image_name' => $postFiles['image_name'],
						'cover' => $cover,
						'post_id' => $post_id,
					];	
					$this->db->insert('post_image',$postImgArr);
					$id_image = $this->db->insert_id();

					$upload_data = $this->upload->data();
					$category_imageArr = $this->config->item('IMAGE_SIZE_ARRAY');
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
    
*/


    
    /* 
		show data using id
		@get method
	*/

	public function show($id)
	{
		$this->data['title'] = trans($this->post_type.'_details');
		$this->data['edit_post'] = base_url("admin/".$this->post_type."/edit/".$id);
		$this->data['back_action'] = base_url("admin/".$this->post_type);
		$this->data['post'] = $this->PostModel->getPost($id);
		$this->template('admin/post/show',$this->data);
    }
    


	/* 
		edit data using id
		@get method
	*/

	public function edit($id)
	{
		if(!empty($_POST)){
			$this->form_validation->set_rules('name[]',"Name", "trim|required");
			$this->form_validation->set_rules('description[]',"Description", "trim|required");
			$this->form_validation->set_rules('slug[]',trans('slug'), "trim|required");

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
			}else{
				$post_type = ($this->post_type == "post")?"1":"3";
				$postData = $_POST;
				$postData["post_type"] = $post_type;
				$postData["languages"] = $this->data['languages'];
				$post_id = $this->PostModel->updatePost($postData,$id);
				if(!empty($post_id)){
					$this->session->set_flashdata('success', trans($this->post_type.'_updated'));
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

		$this->data['title'] = trans('edit_'.$this->post_type);
		$this->data['form_action'] = base_url("admin/".$this->post_type."/edit/".$id);
		$this->data['back_action'] = base_url("admin/".$this->post_type);
		$post = $this->PostModel->getPost($id);
		$this->data['post'] = $post;
		$this->data['image_range'] = "4";
		$this->template('admin/post/edit',$this->data);

	}

	public function updateStatus(){
		$post_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?$this->post_type.'_activated':$this->post_type.'_deactivated';
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
		$this->db->where(["post_id" => $post_id])->delete(["post_lang","post"]);
		$this->session->set_flashdata('success', trans($this->post_type.'_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}	

	


}
