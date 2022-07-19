<?php

class Controller{

    function __construct(){
        //instancia la vista
        $this->view = new View();
    }

    function loadModel($model){
        //carga el modelo de acuerdo a la vista 
        $url = 'models/'.$model.'model.php';

        if(file_exists($url)){
            //instanciamos la variable URL 
            require_once $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    // Revisa si existen parametros de tipo post
    function existPOST($params){
        //bucle de validacion
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                error_log("ExistPOST: No existe el parametro $param" );
                return false;
            }
        }
        error_log( "ExistPOST: Existen parámetros" );
        return true;
    }
    // Revisa si existen parametros de tipo get
    function existGET($params){
        //bucle de validacion
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGet($name){
        return $_GET[$name];
    }

    function getPost($name){
        return $_POST[$name];
    }

    //Redireccionamiento de valores por medio de la URL y parametros que se envian
    function redirect($url, $mensajes = []){
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }
        $params = join('&', $data);
        
        if($params != ''){
            $params = '?' . $params;
        }
        header('location: ' . constant('URL') . $url . $params);
    }
}

?>