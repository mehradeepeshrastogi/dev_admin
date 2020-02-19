<?php

#######################################################################
 /* 

    @parm = parameter
    @parm lang_id = 1 i.e english
    @parm lang_id = 2 i.e german

    @parm = device_type
    @device_type = "1" // for android
    @device_type = "2" // for IOS
    DR_Controller => Application/core/DR_controller
 
*/ 

#######################################################################



require_once(API_CONTROLLER_PATH.'Exception/Exception.php');
class Api extends DR_Controller {

    public $headers;
    public $requestData;
    public $responseData;
    public $errors;
    public $success = false;
    public $error = true;

    public function __construct(){
        parent::__construct(); 
        $this->load->library('form_validation');
        $this->headers = apache_request_headers();
        $this->data['data'] = (object) []; 
        $this->lang_id = @($this->headers['lang_id'])?$this->headers['lang_id']:'2';
        
		if($this->lang_id==1){
			$this->lang->load('api','english');
		}else{
            // $this->lang->load('api','german');
            $this->lang->load('api','english');
        }
       
        /*
            exceptMethod => "No need to require access_token";
        */
        if(isset($this->headers['Accept']) && $this->headers['Accept'] == "application/json"){
            header('Content-type: application/json; charset=utf-8');
        }

        $exceptMethod = ['login','register'];    
        if(! in_array($this->method,$exceptMethod)){  
            try{
                if(empty($this->headers['access_token'])){
                    throw new AuthenticationRequiredException();
                }

            }catch(AuthenticationRequiredException $ex){
                $ex->getException();
            }finally{
                $this->data['user'] = Api::authUser($this->headers['access_token']);
            }
            
        }
        
        
    }  // end construct function

    /*
        APP Dashboard
    */

    public function index(){

    }


    /*
        checuk auth user 
        if auth user then return user details
        else exit from app
    */

    public static function authUser($access_token){
        try{
            $user = get_token('users',$access_token,['password']);
            if(empty($user)){
                throw new AuthenticationException();
            }
        }catch(AuthenticationException $ex){
            $ex->getException();
        }
        finally{
            return $user;
        }
    }

    public function sendPush($user_id,$pushData)
    {
        /*
        $pushData = [
                'message'=>$pushMsg,
                'type'=>$type,
                'badgeCount'=>$badgeCount
            ];
        */

        try{

            $notify = new NotificationService();
            $userData = $this->db->get_where('users',['user_id'=>$user_id])->limit(1)->row();
            if(empty($userData) && empty($userData->device_type)){
                throw new InvalidUserException();
            }

            if(empty($pushData)){
                throw new InvalidRequestDataException();
            }

        }catch(InvalidUserException $ex){
            $ex->getException();
        }catch(InvalidRequestDataException $ex){
            $ex->getException();
        }finally{
            
            if($userData->device_type == "1" && !empty($userData->device_id))
            {   
                $res = $notify->send("android", [$userData->device_id], $pushData); 
            }
            else if($userData->device_type == "2" && !empty($userData->device_token))
            {                             
                $msg = array("mTitle"=>"Bonjob","mDesc"=>$pushData);
                $res = $notify->send("ios", $userData->device_token, $msg);
            }else{
                 $ex = new InvalidUserException();
                 $ex->getException();
            }

        } // end finally
        
    } // end send push

}
?>