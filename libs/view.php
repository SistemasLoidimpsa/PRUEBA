<?php

class View{

    function __construct(){
    }

    function render($nombre, $data = []){
        $this->d = $data;
        
        $this->handleMessages();
        

        require 'views/' . $nombre . '.php';
    }
    
    private function handleMessages(){
        if(isset($_GET['success']) && isset($_GET['error'])){
            // no se muestra nada porque no puede haber un error y success al mismo tiempo
        }else if(isset($_GET['success'])){
            
            $this->handleSuccess();
        }else if(isset($_GET['error'])){
            $this->handleError();
        }
    }

    private function handleError(){
        //valida si viene llena la variable error por get 
        if(isset($_GET['error'])){
            $hash = $_GET['error'];
            $errors = new Errors();
            //valida el contenido del error y lo obtiene
            if($errors->existsKey($hash)){
                error_log('View::handleError() existsKey =>' . $errors->get($hash));
                //instancia el error y obtiene su valor
                $this->d['error'] = $errors->get($hash);
            }else{
                // si no encuentra vacia la variable devuelve null
                $this->d['error'] = NULL;
            }
        }
    }


    private function handleSuccess(){
        //valida si viene llena la variable success por get 
        if(isset($_GET['success'])){
            $hash = $_GET['success'];
            $success = new Success();
            //valida el contenido del success y lo obtiene
            if($success->existsKey($hash)){
                //instancia el success y obtiene su valor
                error_log('View::handleError() existsKey =>' . $success->existsKey($hash));
                $this->d['success'] = $success->get($hash);
            }else{
                // si no encuentra vacia la variable devuelve null
                $this->d['success'] = NULL;
            }
        }
    }
    //Instancia las funciones para mostrar el error
    public function showMessages(){
        $this->showError();
        $this->showSuccess();
    }
    //Muestra el error en la vista por medio del div
    public function showError(){
        //valida si viene llena la variable
        if(array_key_exists('error', $this->d)){
            echo '<div class="error">'.$this->d['error'].'</div>';
        }
    }
    //Muestra el success en la vista por medio del div
    public function showSuccess(){
        //valida si viene llena la variable
        if(array_key_exists('success', $this->d)){
            echo '<div class="success">'.$this->d['success'].'</div>';
        }
    }
}

?>