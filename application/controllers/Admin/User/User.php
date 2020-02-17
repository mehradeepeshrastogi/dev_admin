<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(ADMIN_CONTROLLER_PATH.'Admin.php');

class User extends Admin {
	
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
		$this->data['form_action'] = base_url('admin/user');
		$this->data['add_user'] = base_url('admin/user/create');
		$this->data['search'] = $search;
		$config["base_url"] = base_url() . "admin/user";
		$total_row = $this->UserModel->count($search);
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
		$this->data["results"] = $this->UserModel->getUsers($config["per_page"], $page,$search);
		$str_links = $this->pagination->create_links();
	
		$this->data["links"] = explode('&nbsp;',$str_links);
		$this->template('admin/user/index',$this->data);

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

		$this->data['title'] = trans('add_user');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/user/store");
		$this->data['back_action'] = base_url("admin/user");
		$this->template('admin/user/create',$this->data);
    }
    


	/* 
		save data to database
		@post method 
	*/
	public function store()
	{
		$this->form_validation->set_rules('name',"Name", "trim|required");
		$this->form_validation->set_rules('email',"Email", "trim|required|is_unique[users.email]");
		$this->form_validation->set_rules('user_name',"User name", "trim|required|is_unique[users.user_name]");
		$this->form_validation->set_rules('phone',"Phone", "trim|required|is_unique[users.phone]");
		$this->form_validation->set_rules('password',"Password", "trim|required");
		$this->form_validation->set_rules('active',"User status", "trim|required");

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', validation_errors());
			$this->create();
		}else{
			$postData = $_POST;

			//////////////////// Insert data in user table /////////////////////////
		
			$user = [
				'name' => $postData['name'],
				'email' => $postData['email'],
				'user_name' => $postData['user_name'],
				'phone' => $postData['phone'],
				'password' => md5($postData['password']),
				'active' => $postData['active'],
				'access_token' => create_token(),
				'created_at' => $this->current_datetime,
				'updated_at' => $this->current_datetime
			];

		##########################  upload user profile image #################################	
			
			if(!empty($_FILES['image']['name'])){
				// File upload configuration
				$_FILES['image']['name']     = time().$_FILES['image']['name'];
				$config['upload_path']          = './uploads/user/';
                $config['allowed_types']        = 'jpg|jpeg|png|gif';
                $config['max_size']             = 1000;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;
				
				// Load and initialize upload library
				$this->load->library('upload', $config);

				$this->upload->initialize($config);
				
				// Upload file to server
				
				if ( ! $this->upload->do_upload('image'))
                {
                        $error = $this->upload->display_errors();
						dd($error);
                }
                else
                {
                      $user['profile_image'] = $_FILES['image']['name'];
                }
				
				// end if do_upload
				
			}

		##########################  end upload user profile image ################################

			$this->db->insert('users',$user);
			$user_id = $this->db->insert_id();

			//////////////////// end Insert data in user table /////////////////////////
			

			if(!empty($user_id)){
				$this->session->set_flashdata('success', trans('user_created'));
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
		if (!empty($this->session->flashdata('error'))) {
			$this->data['error'] = $this->session->flashdata('error');
		}else if (!empty($this->session->flashdata('success'))) {
			$this->data['success'] = $this->session->flashdata('success');
		}

		$this->data['title'] = trans('user_edit');
		$this->data['image_range'] = "4";
		$this->data['form_action'] = base_url("admin/user/update/".$id);
		$this->data['back_action'] = base_url("admin/user");
		$user = $this->UserModel->getuser($id);
		$this->data['user'] = $user;
		$this->template('admin/user/edit',$this->data);

	}



	/* 
		update data using id
		@post method
	*/
	
	public function update($user_id)
	{
		$postData = $_POST;
		$user = [
			'name' => $postData['name'],
			'email' => $postData['email'],
			'user_name' => $postData['user_name'],
			'phone' => $postData['phone'],
			'active' => $postData['active'],
			'updated_at' => $this->current_datetime
		];

		##########################  upload user profile image #################################	
		
		if(!empty($_FILES['image']['name'])){
			// File upload configuration
			$_FILES['image']['name']     = time().$_FILES['image']['name'];
			$config['upload_path']          = './uploads/user/';
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 1000;
			// $config['max_width']            = 1024;
			// $config['max_height']           = 768;
			
			// Load and initialize upload library
			$this->load->library('upload', $config);

			$this->upload->initialize($config);
			
			// Upload file to server
			
			if ( ! $this->upload->do_upload('image'))
			{
				$error = $this->upload->display_errors();
				dd($error);
			}
			else
			{
				$filePath = FCPATH."uploads/user/";
				$table = "users";
				$select = "profile_image";
				$where = ["user_id" => $user_id];
				unlinkFile($filePath,$table,$select,$where);

				$user['profile_image'] = $_FILES['image']['name'];
			}
			
			// end if do_upload
			
		}

	##########################  end upload user profile image ################################

		if(!empty($postData['password'])){
			$user['password'] = md5($postData['password']);
		}
		$this->db->where('user_id',$user_id)->update('users',$user);
		$this->session->set_flashdata('success', trans('user_updated'));
        redirect($_SERVER['HTTP_REFERER']);	
		
	}

	public function updateStatus(){
		$user_id = $_POST['id'];
		unset($_POST['id']);
		$msg = ($_POST['active'] == 1)?'user_activated':'user_deactivated';
		$this->db->where(["user_id" => $user_id])->update("users",$_POST);
		$this->session->set_flashdata('success', trans($msg));
        redirect($_SERVER['HTTP_REFERER']);	
	}




	/* 
		delete data using id
		@post method
	*/
	
	public function destroy()
	{
		$user_id = $this->input->post('id');
		// $filePath = FCPATH."uploads/user/";
		// $table = "users";
		// $select = "image";
		// $where = ["user_id" => $user_id];
		// unlinkFile($filePath,$table,$select,$where);
		$this->db->where(["user_id" => $user_id])->delete(["user_app_tokens","users"]);
		$this->session->set_flashdata('success', trans('user_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}

}
