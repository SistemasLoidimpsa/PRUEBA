<?php
require_once 'config/config.php';
class ErrorMessages{

    // ERROR_CONTROLLER_METHOD
    const ERROR_ADMIN_NEW_CATEGORY_EXISTS = "509e83452c2c4ef3ef869d10264f9ec5";
    private $errorList = [];
    public function __construct()
    {
        
        $this ->errorList =[
            ErrorMessages::ERROR_ADMIN_NEW_CATEGORY_EXISTS => "Error esta categoria ya existe"
        ];
    }

    public function get($hash){
        return $this->errorList[$hash];
    }
    
    public function existsKey($key){
        if(array_key_exists($key, $this->errorList)){
            return true;
        }else{
            return false;
        }
    }

    

}


?>