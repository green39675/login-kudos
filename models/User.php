<?php
class User{
    private $username;
    private $password;
    private $email;
    private $gender;
    public $name;
    public $surname;
    public $birth_date;

    function __construct($row){
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->email = $row['email'];
        $this->gender = $row['gender'];
        $this->name = $row['name'];
        $this->surname = $row['surname'];
        $this->birth_date = $row['birth_date'];
    }

    function fullName(){
        return array($this->name, $this->surname);
    }

    function getUsername() { return $this->username; }


}
?>