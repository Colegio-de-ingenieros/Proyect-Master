<?php
    session_start();
    $_SESSION["token"] = "";
    $_SESSION["tipo_usuario"] = "";
    session_destroy();
    setcookie("token","",time()-1,"/");

    header("Location: ../../view/login/login.html");


?>