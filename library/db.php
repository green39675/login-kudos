<?php

class DB{
    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB   = 'login_project';

    public static function connect(){
        $c = new mysqli(self::HOST, self::USER, self::PASS, self::DB);
        return $c;
    }
}

?>