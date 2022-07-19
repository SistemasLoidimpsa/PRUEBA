<?php

class UserModel extends Model implements IModel{

    private $id;
    private $username;
    private $password;
    private $role;
    private $hourEx;
    private $photo;
    private $name;
    private $hourLab;
    private $state;

    public function __construct()
    {   //inicializacion del constructor y variables
        parent::__construct();
        $this->username = '';
        $this->password ='';
        $this->role ='';
        $this->hourEx =0.0;
        $this->hourLab =0.0;
        $this->photo ='';
        $this->name ='';
        $this->state = 1;
    }

    //grabar usuario nuevo
    public function save(){
        try{
            $query= $this ->prepare('INSERT INTO users(username, password, role, horasLab, photo, name, estado) VALUES 
            (:username, :password, :role, :horasLab, :photo, :name, :state)');
            $query-> execute([
                'username' => $this->username,
                'password' => $this->password,
                'role' => $this->role,
                'horasLab' => $this->hourLab,
                'photo' => $this->photo,
                'name' => $this->name,
                'state' => $this->state
            ]);
            return true;
        }cacth(PDOException $e){
            error_log('USERMODEL::save->PDOException '.$e);
            return false;
        }
    };

    //obtiene a todos los usuarios
    public function getAll(
        $items = [];
        try{
            $query = $this->query('SELECT * FROM users');
            while($p = $query->fecth(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setPassword($p['password']);         
                $item->setRole($p['role']); 
                $item->setHourLab($p['hourLab']);
                $item->setPhoto($p['photo']);
                $item->setUserName($p['username']);
                $item->setName($p['name']);
                $item->setState($p['estado']);
                array_push($items, $item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getAll->PDOException '.$e);
            return false;
        }
    );
    public function get($id){
        try{
            $query = $this->prepare('SELECT * FROM users where id = :id');
            $query->execute([
                'id' => $id
            ]);
            $user = $query->fecth(PDO::FETCH_ASSOC);
            $this->setId($user['id']);
            $this->setPassword($user['password']);         
            $this->setRole($user['role']); 
            $this->setHourLab($user['hourLab']);
            $this->setHourEx($user['hourEx']);
            $this->setPhoto($user['photo']);
            $this->setUserName($user['username']);
            $this->setName($user['name']);
            $this->setState($user['estado']);
           
            
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getId->PDOException '.$e);
            return false;
        }
    };
    public function delete($id, $state){
        try{
            if($state = 1){
                $query = $this->prepare('UPDATE users SET estado = 0 where id = :id');
                $query->execute([
                    'id' => $id
                ]);
            }elseif($state = 0){
                $query = $this->prepare('UPDATE users SET estado = 1 where id = :id');
                $query->execute([
                    'id' => $id
                ]);
            }
        }catch(PDOException $e){
            error_log('USERMODEL::getDelete->PDOException '.$e);
            return false;
        }
    };
    public function update(){
        try{
            $query = $this->prepare('UPDATE users SET username = :username, password = :password, role = :role,
            horasLab = :horasLab, photo = :photo, name = :name, estado = :state ,  hourEx = :hourEx where id = :id');
            $query->execute([
                'id'       => $this->id,
                'username' => $this->username,
                'password' => $this->password,
                'horasLab' => $this->horasLab,
                'photo'    => $this->photo,
                'name'     => $this->name,
                'estado'   => $this->estado,
                'hourEx'   => $this->hourEx
            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::getId->PDOException '.$e);
            return false;
        }
    };
    //arreglo de asignacion de campos de las variables
    public function from($array){
        $this->id       = $array['id'],
        $this->username = $array['username'],
        $this->password = $array['password'],
        $this->horasLab = $array['horasLab'],
        $this->photo    = $array['photo'],
        $this->name     = $array['name'],
        $this->estado   = $array['estado'],
        $this->hourEx   = $array['hourEx']
    };
    // metodo de encriptacion de key
    private function getHashedPassword($password){
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
    //getters and setters de las variables
    public function setId($id){             $this->id = $id;}
    public function setRole($role){         $this->role = $role;}
    public function setHourEx($hourEx){     $this->hourEx = $hourEx;}
    public function setHourLab($hourLab){     $this->hourLab = $hourLab;}
    public function setPhoto($photo){       $this->photo = $photo;}
    public function setUserName($username){         $this->username = $username;}
    public function setName($name){         $this->name = $name;}
    public function setState($state){         $this->state = $state;}
    public function setPassword($password){
        $this->password = $this->getHashedPassword($password);
    }


    public function getId(){        return $this->id;}
    public function getUsername(){  return $this->username;}
    public function getPassword(){  return $this->password;}
    public function getRole(){      return $this->role;}
    public function getHourEx(){    return $this->hourEx;}
    public function getState(){    return $this->state;}
    public function getHourLab(){    return $this->hourLab;}
    public function getPhoto(){     return $this->photo;}
    public function getName(){      return $this->name;}
}

?>