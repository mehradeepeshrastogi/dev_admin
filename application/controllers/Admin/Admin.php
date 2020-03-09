<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends DR_Controller {
	public $lang_id;
	public $post_type;
	public function __construct()
	{
		// create,edit,index,show,destroy
		parent::__construct();
		$adminData = $this->session->userdata('adminData');
		$this->lang_id = !empty($adminData)?$adminData->lang_id:'1';
		$this->post_type = $this->uri->segment(2);

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


	 public function uploadImages(){
	 	$post_data = $_POST;
	 	// dump($post_data);
	 	// dd($_FILES);
      /////////////////////// upload category image data /////////////////////////////////
        $size = [];
        $filesCount = count($_FILES['image']['name']);
        for($i = 0; $i < $filesCount; $i++){
          $file_name = $_FILES['image']['name'][$i];
          $_FILES['file']['name']     = time().$file_name;
          $_FILES['file']['type']     = $_FILES['image']['type'][$i];
          $_FILES['file']['tmp_name'] = $_FILES['image']['tmp_name'][$i];
          $_FILES['file']['error']     = $_FILES['image']['error'][$i];
          $_FILES['file']['size']     = $_FILES['image']['size'][$i];
          
          // File upload configuration
          $uploadPath = 'uploads/images';
          $config['upload_path'] = $uploadPath;
          $config['allowed_types'] = 'jpg|jpeg|png|gif';
          
          // Load and initialize upload library
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
          
          // Upload file to server
          if($this->upload->do_upload('file')){
            // Uploaded file data
            $fileData = $this->upload->data();
            $uploadData['image_name'] = $fileData['file_name'];
            $uploadData['image_original_name'] = $file_name;
            $uploadData['image_url'] = base_url($uploadPath);
            $uploadData['image_path'] = FCPATH.$uploadPath;
            $uploadData['created_at'] = FCPATH.$uploadPath;
            $uploadData['updated_at'] = FCPATH.$uploadPath;
            $this->db->insert("images",$uploadData);
            $category_image_id = $this->db->insert_id();
            if(!empty($post_data)){
                $size = ["width" => $post_data["width"],"height" => $post_data["height"]];
            }
            $this->resizeImage($fileData,$size);
            ///////////////////  end upload category image data ///////////////////////////
      

          } // end if do_upload
        
        } // end for loop

        
        
      /////////////////////////// end upload category image data /////////////////////////
   }

   public function resizeImage($upload_data,$post_data=[]){

       // $imageSizeArr = $this->config->item('IMAGE_SIZE_ARRAY');
       if(empty($post_data)){
          $post_data = ["width" => "800","height" => "800"];
       }

       $imageSizeArr = [
          [
            "width" => $post_data["width"],
            "height" => $post_data["height"],
            "path" => "main"
          ],
          [
            "width" => (($post_data["width"]-200) > 0)?($post_data["width"]-200):'640',
            "height" => (($post_data["height"]-200) > 0)?($post_data["height"]-200):'640',
            "path" => "large",
          ],
          [
            "width" => (($post_data["width"]-400) > 0)?($post_data["width"]-400):'320',
            "height" => (($post_data["height"]-400) > 0)?($post_data["height"]-400):'320',
            "path" => "medium",
          ],
          [
            "width" => (($post_data["width"]-600) > 0)?($post_data["width"]-600):'160',
            "height" => (($post_data["height"]-600) > 0)?($post_data["height"]-600):'160',
            "path" => "small",
          ],
          [
            "width" => "80",
            "height" => "80",
            "path" => "thumb",
          ],

       ];
       // dd($upload_data);
       $this->load->library('image_lib'); 
       foreach($imageSizeArr as $image){
          $file_path = $upload_data['file_path'].$image['path'];
          if (!file_exists($file_path)){
              mkdir($file_path, 0777, true);
          }

          $resize_conf = array(
            // 'upload_path'  => realpath($file_path),
            // 'new_image'    => $file_path.$upload_data['file_name'].$image['type'],
            'image_library' => 'gd2',
            'source_image' => $upload_data['full_path'], 
            'new_image'    => $file_path.'/'.$upload_data['file_name'],
            'width'        => $image['width'],
            'height'       => $image['height']
          );
          $this->image_lib->clear();
          $this->image_lib->initialize($resize_conf);
          $this->image_lib->resize();
        } // end foreach image array
   }

   public function getPostImages_OLD(){
		$data["languages"] = $this->data['languages'];
		$this->load->helper('directory'); //load directory helper
		$dir = "uploads/images/main/"; // Your Path to folder
		$postImages = directory_map($dir);
		if($this->input->is_ajax_request()){
			$image_url = base_url().$dir;
			$postImages = array_map('postImageUrl',$postImages,$image_url);
			echo json_encode($postImages); die;

		}else{
			$data["postImages"] = $postImages;
			$this->load->view("admin/modal/admin_html_modal",$data);   
		}
		
	}

	 public function getPostImages(){
		$data["languages"] = $this->data['languages'];
		$query = $this->db->order_by("image_id","desc")->get("images");
		if($query->num_rows() > 0){
			
			$resultData = $query->result_array();

			if($this->input->is_ajax_request()){
				echo json_encode($resultData); die;

			}else{
				$data["result_data"] = $resultData;
				$this->load->view("admin/modal/admin_html_modal",$data);   
			}
		}
	}

	public function deletePostImage(){
		if(!empty($_POST["image_id"])){
			extract($_POST);
			$imageArr = [
				$image_path."/".$image_name,
				$image_path."/large/".$image_name,
				$image_path."/main/".$image_name,
				$image_path."/medium/".$image_name,
				$image_path."/small/".$image_name,
				$image_path."/thumb/".$image_name,
			];
			foreach($imageArr as $image){
				unlink($image);
			}

			$this->db->where(["image_id" => $image_id])->delete("images");
			echo json_encode(["message" => "deleted successfully"]);
		}
	}

    

}
