<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends DR_Model {
    public $currentTime;
    
    public function __construct(){
        parent::__construct();
        $this->currentTime = date('Y-m-d H:i:s');
    }

    public function login($data){
        $result = [];
        $data["password"] = md5($data["password"]);
        $where = "user_name = '".$data['user_name']."' OR email = '".$data['user_name']."' AND password = '".$data['password']."'";
        $query = $this->db->where($where)->limit(1)->get('users');
		if($query->num_rows() > 0){
            $result = $query->row();
            $result->access_token = create_token();
            $this->db->where(["user_id" => $result->user_id])->update("users",["access_token" => $result->access_token]);
		}
		return $result;
    }

    public function register($data){
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'password' => md5($data['password']),
            'phone' => $data['phone'],
            'access_token' => create_token(),
        ];
        $this->db->insert("users",$userData);
        $user_id = $this->db->insert_id();
        $userAppTokenData = [
            'user_id' => $user_id,
            'device_type' => $data['device_type'],
            'device_token' => $data['device_token'],
            'created_at' =>  $this->currentTime,
            'updated_at' => $this->currentTime,
        ];
        $this->db->insert("user_app_tokens",$userAppTokenData);
        if($user_id){
            return $this->db->get_where("users",["user_id" => $user_id])->row();
        }else{
            return false;
        }
    }
}
