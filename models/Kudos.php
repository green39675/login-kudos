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

    function setCount(){
        $c = DB::connect();
        $c->query("UPDATE kudos SET count = $this->count+1 WHERE id=$this->id");
    }
    function getId() { return $this->id; }
    function getFromUser() { return $this->fromUser; }
    function getToUser() { return $this->toUser; }
}
?>