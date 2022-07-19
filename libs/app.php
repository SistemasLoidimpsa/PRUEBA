<?php

class App{

    function __construct(){
        $url = isset($_GET['URL']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        //Redireccion a login 
        if(empty($url[0])){
            error_log('APP::construct-> No hay controlador especificado');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/'.$url[0].'.php';
        //verificacion del controlador por medio de archivos
        if(file_exists($archivoController)){
            require_once $archivoController;

            $controller = new $url[0];
            $controller->loadModel($url[0]);

            //validacion de segundo parametro del controlador
            if(isset($url[1])){
                //validar si existe metodo por medio de la url
                if(method_exists($controller, $url[1])){
                    if(isset($url[2])){
                        // numero de parametros
                        $nparam = count($url) - 2;
                        $params = [];
                        // iteracion para agregar elementos al arreglo
                        for($i=0; $i< $nparam; $i++){
                            array_push($params, $url[$i] + 2);
                        }
                        $controller->{$url[1]}($params);
                    }else{
                        //no tiene parametros, se manda a llamar
                        //el metodo tal cual
                        $controller->{$url[1]}();
                    }

                }else{
                    //no existe el metodo
                    // pagina 404
                    $controller = new Errores();
                }
            }else{
                // no hay metodo a cargar, se carga el metodo por default
                $controller->render();
            }
        }else{
            // no existe el archivo, manda error
            $controller = new Errores();
        }

    }
}


?>