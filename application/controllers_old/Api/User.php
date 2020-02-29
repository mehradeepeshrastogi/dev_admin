<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(API_CONTROLLER_PATH.'Api.php');

class User extends Api {

    public function __construct()
	{
        parent::__construct();
    }


    /*
        APP Dashboard 
        @get method 
    */

    public function login(){
       try
       {
                $this->requestData = file_get_contents('php://input');
                if(empty($this->requestData)){
                    throw new InvalidRequestDataException();
                }

                $this->data['postData'] = json_decode($this->requestData,true);
                $config = [
                    [
                            'field' => 'user_name',
                            'label' => trans('user_name'),
                            'rules' => 'required|min_length[4]',
                            'errors' => [
                                    'required' => trans('user_name_required'),
                                    'min_length' => str_ireplace(':par','4',trans('user_name_min_length')),
                            ],
                    ],
                    [
                            'field' => 'password',
                            'label' => trans('password'),
                            'rules' => 'required|min_length[6]',
                            'errors' => [
                                    'required' => trans('password_required'),
                                    'min_length' => str_ireplace(':par','6',trans('password_min_length')),
                            ],
                    ],
                    [
                        'field' => 'device_type',
                        'label' => trans('device_type'),
                        'rules' => 'required',
                        'errors' => [
                                'required' => trans('device_type_requird'),
                        ],
                    ],
    
                    [
                        'field' => 'device_token',
                        'label' => trans('device_token'),
                        'rules' => 'required',
                        'errors' => [
                                'required' => trans('device_token_required'),
                        ],
                    ]
                ];

                $this->form_validation->set_data($this->data['postData']);
                $this->form_validation->set_rules($config);
                if($this->form_validation->run()==FALSE){
                    $errors = $this->form_validation->error_array();
                    throw new RequestDataException($errors);
                }else{
                    $this->data['data'] = $this->UserModel->login($this->data['postData']);
                    if(empty($this->data['data'])){
                        throw new InvalidUserException();
                    }
                } // end else
        } // end try
        catch(InvalidRequestDataException $ex) {
            $ex->getException();
        } // end catch
        catch(RequestDataException $ex) {
            $ex->getException();
        }
        catch(InvalidUserException $ex) {
            $ex->getException();
        } 
       
        finally {
            $this->responseData = [
                "success" => true,
                "message" => trans("user_login"),
                "data" => $this->data['data'],
                "error" => false,
                "code" => 200
            ];
            dj($this->responseData);     
        }

    }


    /*
        create user account 
        @post method
    */
    public function register(){
        // code 201
        try{
            $this->requestData = file_get_contents('php://input');
            if(empty($this->requestData)){
                throw new InvalidRequestDataException();
            }

            $this->data['postData'] = json_decode($this->requestData,true);
          

            $config = [
                [
                        'field' => 'email',
                        'label' => trans('email'),
                        'rules' => 'required|valid_email|min_length[10]|is_unique[users.email]',
                        'errors' => [
                                'required' => trans('email_required'),
                                'min_length' => trans('emial_min_length'),
                                'valid_email' => trans('not_valid_email'),
                                'is_unique' => trans('is_unique_email')
                        ],
                ],
                
                [
                        'field' => 'password',
                        'label' => trans('password'),
                        'rules' => 'required|min_length[6]',
                        'errors' => [
                                'required' => trans('password_required'),
                                'min_length' => trans('password_min_length'),
                        ],
                ],

                  
                [
                    'field' => 'phone',
                    'label' => trans('phone'),
                    'rules' => 'required|min_length[10]|is_unique[users.phone]',
                    'errors' => [
                            'required' => trans('phone_required'),
                            'min_length' => trans('phone_min_length'),
                            'is_unique' => trans('is_unique_phone')
                    ],
                ],

                [
                    'field' => 'device_type',
                    'label' => trans('device_type'),
                    'rules' => 'required',
                    'errors' => [
                            'required' => trans('device_type_requird'),
                    ],
                ],

                [
                    'field' => 'device_token',
                    'label' => trans('device_token'),
                    'rules' => 'required',
                    'errors' => [
                            'required' => trans('device_token_required'),
                    ],
                ],
            ];

            $this->form_validation->set_data($this->data['postData']);
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==FALSE){
                $errors = $this->form_validation->error_array();
                throw new RequestDataException($errors);
            }else{
                $registerData = $this->UserModel->register($this->data['postData']);
                if(empty($registerData)){
                    throw new InvalidUserException();
                }
            } // end else

        }catch(InvalidRequestDataException $ex){
            $ex->getException();
        }catch(RequestDataException $ex){
            $ex->getException();
        }catch(InvalidUserException $ex){
            $ex->getException();
        }finally{
            $this->responseData = [
                "success" => true,
                "message" => trans("user_created"),
                "data" => $registerData,
                "error" => false,
                "code" => 201
            ];
            dj($this->responseData);     
        }
    }

    
      /*
        update user account 
        @post method
    */
    public function update(){
        // code 201
        try{
            $this->requestData = $_POST;
            if(empty($this->requestData)){
                throw new InvalidRequestDataException();
            }

            $this->data['postData'] = json_decode($_POST["data"],true);

            $config = [
                [
                        'field' => 'email',
                        'label' => trans('email'),
                        'rules' => 'required|valid_email|min_length[5]|callback_uniqueUserEmail',
                        'errors' => [
                                'required' => trans('email_required'),
                                'min_length' => trans('emial_min_length'),
                                'valid_email' => trans('not_valid_email'),
                                'is_unique' => trans('is_unique_email')
                        ],
                ],
                
                [
                        'field' => 'user_name',
                        'label' => trans('user_name'),
                        'rules' => 'required|min_length[3]|callback_uniqueUserName',
                        'errors' => [
                                'required' => trans('user_name_required'),
                                'min_length' => trans('user_name_min_length'),
                        ],
                ],

                  
                [
                    'field' => 'phone',
                    'label' => trans('phone'),
                    'rules' => 'required|min_length[10]|callback_uniqueUserPhone',
                    'errors' => [
                            'required' => trans('phone_required'),
                            'min_length' => trans('phone_min_length'),
                            'is_unique' => trans('is_unique_phone')
                    ],
                ],
            ];

            $this->form_validation->set_data($this->data['postData']);
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==FALSE){
                $errors = $this->form_validation->error_array();
                throw new RequestDataException($errors);
            }else{
                
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
                if(!empty( $this->data['user']->profile_image)){
                    $filePath = FCPATH."uploads/user/";
                    $table = "users";
                    $select = "profile_image";
                    $where = ["user_id" => $user_id];
                    unlinkFile($filePath,$table,$select,$where);
                }

				$this->data['postData']['profile_image'] = $_FILES['image']['name'];
			}
			
			// end if do_upload
			
		}

    ##########################  end upload user profile image ################################
    
                $this->data['postData']['user_id'] = $this->data['user']->user_id;
                $registerData = $this->UserModel->updateUser($this->data['postData']);
                if(empty($registerData)){
                    throw new InvalidUserException();
                }
            } // end else

        }catch(InvalidRequestDataException $ex){
            $ex->getException();
        }catch(RequestDataException $ex){
            $ex->getException();
        }catch(InvalidUserException $ex){
            $ex->getException();
        }finally{
            $this->responseData = [
                "success" => true,
                "message" => trans("user_updated"),
                "data" => $registerData,
                "error" => false,
                "code" => 200
            ];
            dj($this->responseData);     
        }
    }



    /*
        APP Dashboard 
        @post method 
    */

    public function logout(){
        // delete token
        $userData = $this->db->where("user_id",$this->data['user']->user_id)->update("users",["access_token" => ""]);
        $this->success = true;
        $this->responseData = [
            "success" => $this->success,
            "message" => trans("user_logout"),
            "data" => $this->data['data'],
            "error" => ($this->success)?false:true,
            "code" => 200
        ];
        dj($this->responseData);
    }

     /*
        APP Dashboard 
        @post method
        where active => 2 = delete account from user 
    */

    public function delete(){
        // deactive user account 
        
        $userData = $this->db->where("user_id",$this->data['user']->user_id)->update("users",["active" => "2"]);
        $this->success = true;
        $this->responseData = [
            "success" => $this->success,
            "message" => trans("user_deleted"),
            "data" => $this->data['data'],
            "error" => ($this->success)?false:true,
            "code" => 200
        ];
        dj($this->responseData);
    }


    /*
        change password
    */
    public function changePassword(){

           // code 201
           try{
            $this->requestData = file_get_contents('php://input');
            if(empty($this->requestData)){
                throw new InvalidRequestDataException();
            }

            $this->data['postData'] =   json_decode($this->requestData,true);

            $config = [
                [
                        'field' => 'old_password',
                        'label' => trans('old_password'),
                        'rules' => 'required|min_length[6]|callback_matchUserPassword',
                        'errors' => [
                                'required' => trans('old_password_required'),
                        ],
                ],
                
                [
                    'field' => 'new_password',
                    'label' => trans('new_password'),
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                            'required' => trans('new_password_required'),
                            'min_length' => str_ireplace(':par','6',trans('new_password_min_length')),
                    ],
                ],

                  
                [
                    'field' => 'confirm_password',
                    'label' => trans('confirm_password'),
                    'rules' => 'required|min_length[6]|matches[new_password]',
                    'errors' => [
                            'required' => trans('confirm_password_required'),
                            'min_length' => str_ireplace(':par','6',trans('confirm_password_min_length')),
                            // 'match' => trans('new_and_confirm_password_not_match'),
                    ],
                ],
            ];

            $this->form_validation->set_data($this->data['postData']);
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()==FALSE){
                $errors = $this->form_validation->error_array();
                throw new RequestDataException($errors);
            }else{
    
                $postData['user_id'] = $this->data['user']->user_id;
                $postData['password'] = md5($this->data['postData']['confirm_password']);
                $registerData = $this->UserModel->updateUser($postData);
                if(empty($registerData)){
                    throw new InvalidUserException();
                }
            } // end else

        }catch(InvalidRequestDataException $ex){
            $ex->getException();
        }catch(RequestDataException $ex){
            $ex->getException();
        }catch(InvalidUserException $ex){
            $ex->getException();
        }finally{
            $this->responseData = [
                "success" => true,
                "message" => trans("user_password_changed"),
                "data" => $registerData,
                "error" => false,
                "code" => 200
            ];
            dj($this->responseData);     
        }
        
    } // end change password

    public function uniqueUserEmail($email){
        $num_row = $this->db->where('email',$email)->get_where('users',['user_id !=' => $this->data['user']->user_id])->num_rows();
        
        if($num_row > 0){
            $this->form_validation->set_message('uniqueUserEmail', trans('email_exist'));
            return false;
        }else{
            return true;
        }
    }

    public function uniqueUserName($user_name){
        $num_row = $this->db->where('user_name',$user_name)->get_where('users',['user_id !=' => $this->data['user']->user_id])->num_rows();
        
        if($num_row > 0){
            $this->form_validation->set_message('uniqueUserName', trans('user_name_exist'));
            return false;
        }else{
            return true;
        }
    }

    public function uniqueUserPhone($phone){
        $num_row = $this->db->where('phone',$phone)->get_where('users',['user_id !=' => $this->data['user']->user_id])->num_rows();
        
        if($num_row > 0){
            $this->form_validation->set_message('uniqueUserPhone', trans('phone_exist'));
            return false;
        }else{
            return true;
        }
    }

    public function matchUserPassword($old_password){
        $old_password = md5($old_password);
        $num_row = $this->db->where('password',$old_password)->get_where('users',['user_id' => $this->data['user']->user_id])->num_rows();
        if($num_row > 0){
            return true;
        }else{
            $this->form_validation->set_message('matchUserPassword', trans('old_password_not_match'));
            return false;
        }
    }
}