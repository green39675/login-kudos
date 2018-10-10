<?php
require_once('./library/db.php');
require_once('./models/User.php');

class UserManager{
    function login(){
        // Values taken from login.html form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $c = DB::connect();
        $r = $c->query("SELECT * FROM users WHERE username = '$username'");

        $user = $r->fetch_assoc();

        // DB values check by username
        if(mysqli_num_rows($r)){
            if($password == $user['password']){
                // If the password is correct, user is logged in
                $_SESSION['username'] = $username;
                header("Location:index.php?a=main");
            }
            else{
                // If the password is incorrect, it returns an error
                if($password == ''){
                    $this->error("You haven't entered a password.", "login");
                }
                $this->error("The password you entered is incorrect.", "login");
            }
        }
        // If the username isn't found in the DB, it returns an error
        else{
            $this->error("User not registered.", "login");
        }
    }

    function register(){
        // Taking the values from registration.html form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $passwordConfirm = md5($_POST['passwordConfirm']);
        $email = $_POST['email'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $gender = $_POST['gender'];
        $birth_date = $_POST['birth_date'];

        // Checking for empty values
        foreach($_POST as $key=>$value){
            if(empty($value)){
                $this->error("You haven't entered the $key.", "reg");
            }
        }

        $c = DB::connect();
        $r = $c->query("SELECT username FROM users WHERE username = '$username'");
        // If the entered username is already used, it returns an error
        if($r->fetch_assoc()){
            $this->error("The selected username is already in use. Please enter a different username.", "reg");
        }
        else{
            // If the passwords match, the user is registered
            // ERROR! If the passwords are both empty, the registration proceeds
            if($password == $passwordConfirm){
                $_SESSION['username'] = $username;
                $c->query("INSERT INTO users (username, password, email, name, surname, gender, birth_date) VALUES ('$username','$password','$email','$name','$surname','$gender', $birth_date)");
                header("Location:index.php?a=main");
            }    
            else{
                $this->error("The passwords you entered aren't a match.", "reg");
            }
        }
    }

    function main(){
        $c = DB::connect();
        if(!$_SESSION){
            header("Location:index.php");
        }
        $r = $c->query("SELECT * FROM users WHERE username = '{$_SESSION['username']}'");
        
        $row = $r->fetch_assoc();
        $user = new User($row);
        $fullName = $user->fullName();
        echo '<div class="col-md-6">';
        echo '<h4>Welcome, '.$fullName[0].' '.$fullName[1].'!</h4>';   
        echo '<h6>Send kudos to a friend!</h6>';
        
        $r = $c->query("SELECT * FROM users");
        while($row = $r->fetch_assoc()){
            $user = new User($row);
            echo '<p><a href="?a=kudos&user='.$user->getId().'">@'.$user->getUsername().'</a></p>';
        }

        echo '</div>';
    }

    function logout(){
        session_unset();
        session_destroy();

        header("Location:index.php");
    }

    function error($string, $arg){
        // Redundancy!
        if($arg == 'login')
            require_once('./views/login.html');
        else if($arg == 'reg')
            require_once('./views/registration.html');

        echo '<br><h6><b>Error: </b>'.$string.'</h6>';
    }
}
?>