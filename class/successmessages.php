<?php

class SuccessMessages{
    // SUCCESS_CONTROLLER_METHOD
    const SUCCESS_ADMIN_NEW_CATEGORY_EXISTS = "bc731d0ae45a48e9331b0283393356d4";
    private $succList = [];
    public function __construct()
    {
        $this ->succList =[
            SuccessMessages::SUCCESS_ADMIN_NEW_CATEGORY_EXISTS =>'Exito se ha ingresado'
        ];
    }
    //Metodo para obtener la cadena 
    public function get($hash){
        return $this->succList[$hash];
    }
    //metodo para validar el contenido de la cadena 
    public function existsKey($key){
        if(array_key_exists($key, $this->succList)){
            return true;
        }else{
            return false;
        }
    }

}


?>