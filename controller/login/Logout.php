<?php
    session_start();
    session_destroy();
    setcookie("token","",time()-1,"/");

    header("Location: ../../view/login/Login.html");


?>