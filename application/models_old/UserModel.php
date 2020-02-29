<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends DR_Model {
    public $currentTime;
    
    public function __construct(){
        parent::__construct();
        $this->currentTime = date('Y-m-d H:i:s');
    }

    public function count($search=null){
        if(!empty($search)){
            $this->db->where("name LIKE '%$search%' OR email LIKE '%$search%' OR user_name LIKE '%$search%' OR phone LIKE '%$search%' ");
        }
        $query = $this->db->from("users")->get();
        $result = $query->num_rows();
        return $result;
    }

    public function getUsers($limit,$start,$search=null){
        if($start < 1){
            $start = 0;
        }else{
            $start = $start - 1;
        }
        if(!empty($search)){
            $this->db->where("name LIKE '%$search%' OR email LIKE '%$search%' OR user_name LIKE '%$search%' OR phone LIKE '%$search%' ");
        }
        
        $query = $this->db->select('user_id,active,user_name,email,phone')->from('users')
        ->limit($limit,$start)->order_by('user_id','desc')->get();
        // dd($this->db->last_query());
        $result = $query->num_rows();
        if ($result > 0) {
            return $query->result();
        }
        return false;
    }

    public function getUser($user_id){
        $query = $this->db->get_where("users",['user_id' => $user_id]);
        $result = $query->num_rows();
        if ($result > 0) {
            $result = $query->row();
            return $result;
        }
        return false;
    }

    /* For API */
    public function login($data){
        $result = [];
        $data["password"] = md5($data["password"]);
        $where = "(user_name = '".$data['user_name']."' OR email = '".$data['user_name']."' OR phone = '".$data['user_name']."') AND password = '".$data['password']."' AND active = '1' ";
        $query = $this->db->select("user_id,email,phone,access_token,created_at,updated_at")->where($where)->limit(1)->get('users');

		if($query->num_rows() > 0){

            $result = $query->row();
            $result->access_token = create_token();
            
            $userData["access_token"] = $result->access_token;
            $userData['updated_at'] = $this->currentTime;
            $userData['device_type'] = $data['device_type'];
            if($data['device_type'] == "1"){ // android
                $userData["device_id"] = $data['device_token'];
                $userData["device_token"] = '';
            }else{
                $userData["device_token"] = $data['device_token'];
                $userData["device_id"] = '';
            }
            

            $this->db->where(["user_id" => $result->user_id])->update("users",$userData);
            $this->createLoginHistory($result->user_id);
            
        }
        unset($result->user_id);
		return $result;
    }
    


    public function register($data){
        $userData = [
            'email' => $data['email'],
            'user_name' => $data['email'],
            'password' => md5($data['password']),
            'phone' => $data['phone'],
            'device_type' => $data['device_type'],
            'access_token' => create_token(),
            'created_at' =>  $this->currentTime,
            'updated_at' => $this->currentTime,
        ];

        if($data['device_type'] == "1"){
            $userData["device_id"] = $data['device_token'];
            $userData["device_token"] = '';
        }else{
            $userData["device_token"] = $data['device_token'];
            $userData["device_id"] = '';
        }

        $this->db->insert("users",$userData);
        $user_id = $this->db->insert_id();

        if($user_id){
            $userData = $this->getUserData($user_id);
            return !empty($userData)?$userData:false;
        }else{
            return false;
        }
    }


    public function createLoginHistory($user_id){
        $this->db->insert("user_login_history",[ "user_id" => $user_id, "created_at" => $this->currentTime ]);
    }

    public function updateUser($userData){
        $user_id = $userData['user_id'];
        unset($userData['user_id']);
        $userData['updated_at'] = $this->currentTime;
        $this->db->where('user_id',$user_id)->update("users",$userData);
        $userData = $this->getUserData($user_id);
        return !empty($userData)?$userData:false;
    }

    public function getUserData($user_id){
        return $this->db->select("email,phone,password,access_token,created_at,updated_at")->get_where("users",["user_id" => $user_id])->row();
    }
    
}
