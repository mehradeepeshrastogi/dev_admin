<?php 

class AuthenticationException extends Exception {
    public function getException(){
    $responseData = [
        "success" => false,
        "message" => trans("invalid_auth"),
        "data" => (object) [],
        "error" => true,
        "code" => 401 // Unauthorized
    ];

    dj($responseData);
    exit;
    }
};


class AuthenticationRequiredException extends Exception {
    public function getException(){
    $responseData = [
        "success" => false,
        "message" => trans("required_auth"),
        "data" => (object) [],
        "error" => true,
        "code" => 400 // Bad Request
    ];

    dj($responseData);
    exit;
    }
};


class InvalidUserException extends Exception {
    public function getException(){
        $responseData = [
            "success" => false,
            "message" => trans("invalid_user"),
            "data" => (object) [],
            "error" => true,
            "code" => 404 // Not Found

        ];

        dj($responseData);
        exit;
    }
};

class InvalidRequestDataException extends Exception {
    public function getException(){
    $responseData = [
        "success" => false,
        "message" => trans("empty_data"),
        "data" => (object) [],
        "error" => true,
        "code" => 400 // Bad Request
    ];

    dj($responseData);
    exit;
    }
};

class RequestDataException extends Exception {
    private $errors;
    public function __construct($errors){
        $this->errors = $errors;
    }
    public function getException(){
        $responseData = [
            "success" => false,
            "message" => trans("invalid_user"),
            "data" => $this->errors,
            "error" => true,
            "code" => 400
        ];

        dj($responseData);
        exit;
    }
};



?>