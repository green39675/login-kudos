<?php
require_once("views/header.html");
require_once("controllers/UserManager.php");
require_once("controllers/KudosManager.php");

session_start();

if(isset($_GET['a'])){
    $a = $_GET['a'];
}
else{
    $a = '';
}

$um = new UserManager();
$km = new KudosManager();

switch($a){
    case 'login': $um->login();
    break;
    case 'registration': require("views/registration.html");
    break;
    case 'register': $um->register();
    break;
    case 'main': 
        require_once('./views/main_top.html');
        $um->main();
        $km->main();
        require_once('./views/main_bottom.html');
    break;
    case 'kudos': 
        require_once('./views/main_top.html');
        $km->kudos($_GET['user']);
        require_once('./views/main_bottom.html');
    break;
    case 'kudosPreview':
        require_once('./views/main_top.html');
        $km->kudosPreview();
        require_once('./views/main_bottom.html');
    break;
    case 'logout': $um->logout();
    break;
    default:
        if(isset($_SESSION['username'])){
            require_once('./views/main_top.html');
            $um->main();
            $km->main();
            require_once('./views/main_bottom.html');
        }
        else{
            require_once("views/login.html");
        }
}

require_once("views/footer.html");
?>
