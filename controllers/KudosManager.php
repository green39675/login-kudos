<?php
require_once('./library/db.php');
require_once('./models/Kudos.php');

class KudosManager{
    public function main(){
        echo '<div class="col-md-6">';
        echo '<h4>Kudos listings</h4>';
        require_once('./views/kudos_table.php');
    }

    public function kudos($user_id){
        if(!$_POST){
            require_once('./views/kudos_message.html');
        }
        else{
            $c = DB::connect();
            $r = $c->query("SELECT id FROM users WHERE username LIKE '{$_SESSION['username']}'");

            $user = $r->fetch_assoc();
            $fromUser = $user['id'];
            $toUser = $user_id;
            $message = $_POST['message'];
            $date = date('Y-m-d');
            $time = date('H:i:s');

            $r = $c->query("SELECT * FROM kudos WHERE fromUser = '$fromUser' AND toUser = '$toUser' ORDER BY id DESC LIMIT 1");
            if(mysqli_num_rows($r)){
                $row = $r->fetch_assoc();
                $count = $row['count'];
                $c->query("INSERT INTO kudos (fromUser, toUser, message, date, time, count) VALUES ('$fromUser','$toUser', '$message', '$date', '$time', $count + 1)");
                echo $c->error;
                require_once('./views/kudos_inserted.html');
            }
            else{
                $c->query("INSERT INTO kudos (fromUser, toUser, message, date, time, count) VALUES ('$fromUser','$toUser', '$message', '$date', '$time', 1)");
                echo $c->error;
                require_once('./views/kudos_inserted.html');
            }
        }
    }

    function kudosPreview(){
        require_once('./views/kudos_table.php');
    }
}

?>