<?php
    require('login.php');
    $options = array("uri" => "http://localhost");
    $server = new SoapServer(null, $options);
    $server->setClass('Login'); 
    $server->handle();
?>