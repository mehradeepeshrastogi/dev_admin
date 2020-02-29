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
                    'field' => 'name',
                    'label' => trans('name'),
                    'rules' => 'required|min_length[3]|trim',
                    'errors' => [
                            'required' => trans('name_required'),
                            'min_length' => trans('name_min_length'),
                    ],
                ],

                [
                    'field' => 'user_name',
                    'label' => trans('user_name'),
                    'rules' => 'required|min_length[4]|trim|is_unique[users.user_name]',
                    'errors' => [
                            'required' => trans('user_name_required'),
                            'min_length' => trans('user_name_min_length'),
                            'is_unique' => trans('is_unique_user_name')
                    ],
                ],

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
}