<?php
define('URL', 'http://localhost:80/PRUEBA');

define('HOST','localhost');
define('DB','prueba');
define('USER','root');
define('PASSWORD','');
define('CHARSET','utf8mb4');


define('ERMES', 'Error esta categoria ya existe');
define('SCMES', 'Exito fue creada la categoria ');


class Security{
    private function encryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
    
    private function decryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }
}


?>