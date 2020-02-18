<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends DR_Controller {
	public $lang_id;
	public function __construct()
	{
		// create,edit,index,show,destroy
		parent::__construct();
		$adminData = $this->session->userdata('adminData');
		$this->lang_id = !empty($adminData)?$adminData->lang_id:'1';

		if($this->lang_id==1){
			$this->lang->load('admin','english');
		}else{
			$this->lang->load('admin','english');
			// $this->lang->load('admin','german');
		}
		
		$this->load->library('form_validation');
		$this->load->library('pagination');

		$this->controllerName = 'admin';
		$this->controllerFor = 'admin';
		$exceptMethod = ['login','isAdminLogin'];
		
		if(! in_array($this->method,$exceptMethod)){
			$this->data['adminData'] = $this->isAdminLogin();
		}
	}

	/* 
		show all data
	*/
	public function index()
	{
		if(isset($_GET['lang_id']) && !empty($_GET['lang_id'])){
			$this->changeAdminLang($_GET['lang_id']);
		}

		$this->data['title'] = trans('dashboard');
		$this->data['post'] = $this->PostModel->count(["post_type" => "1"]);
		$this->data['category'] = $this->PostModel->count(["post_type" => "2"]);
		$this->data['page'] = $this->PostModel->count(["post_type" => "3"]);
		$this->data['user'] = $this->UserModel->count();
		$this->template('admin/index',$this->data);
	}

	public function changeAdminLang($lang_id){
		$adminData = $this->session->userdata('adminData');
		unset($adminData->lang_id);
		$this->lang_id  = $adminData->lang_id = $lang_id;
		$this->session->set_userdata('adminData',$adminData);
		$this->db->where("admin_id",$adminData->admin_id)->update('admin',["lang_id" => $lang_id]);
		// $this->session->set_flashdata('success', trans('category_deleted'));
        redirect($_SERVER['HTTP_REFERER']);	
	}
	
	public function isAdminLogin(){
		if(!$this->session->userdata('adminData')){
			redirect($this->controllerFor.'/login');
		}else{
			return $this->session->userdata();
		}
	}

	public function login(){

		$this->data['form_action'] = base_url('admin/login');
		$this->data['title'] = trans('admin_login');
		if($this->session->flashdata('error')){
			$this->data['error'] = $this->session->flashdata('error');
		}

		if(!$this->session->userdata('adminData')){
			if($_POST){
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	            $this->form_validation->set_rules('email', 'Email', 'required|trim');
	            $this->form_validation->set_rules('password', 'password', 'required|trim');
				if ($this->form_validation->run() == true) {
	                
	                $postData = array(
	                    			'email'=>$this->input->post('email'),
	                    			'password' => md5($this->input->post('password')),
	                    			'active' => '1'
	                			);
	                $adminData = $this->AdminModel->login($postData);
	                if($adminData){
	                    $this->session->set_userdata('adminData',$adminData);
	                    redirect(base_url('admin'));
	                }else{
	                    $this->data['error'] = 'Wrong email or password, please try again.';
	                }
	            }
			}
			$this->load->view('admin/login',$this->data);
		}else{
			return $this->session->userdata();
		}
	} // end login function


	public function logout(){
		$this->session->unset_userdata('adminData');
		$this->session->sess_destroy();
		redirect('admin','refresh');
	}
    

}
