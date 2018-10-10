<?php
class Kudos{
    private $id;
    private $fromUser;
    private $toUser;
    public $message;
    public $date;
    public $time;
    public $count;

    function __construct($row){
        $this->id = $row['id'];
        $this->fromUser = $row['fromUser'];
        $this->toUser = $row['toUser'];
        $this->message = $row['message'];
        $this->date = $row['date'];
        $this->time = $row['time'];
        $this->count = $row['count'];
    }

    function getId() { return $this->id; }
    function getFromUser() {
        $c=DB::connect();
        $r = $c->query("SELECT username FROM users WHERE id='$this->fromUser'");
        echo $c->error;
        $row = $r->fetch_assoc();
        return $row['username'];
     }
    function getToUser() { 
        $c=DB::connect();
        $r = $c->query("SELECT username FROM users WHERE id='$this->toUser'");
        $row = $r->fetch_assoc();
        return $row['username'];
   
    }
}
?>