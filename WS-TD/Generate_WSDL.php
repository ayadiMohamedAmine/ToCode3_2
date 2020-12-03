<?php
    require "vendor/php2wsdl/php2wsdl/src/PHPClass2WSDL.php";
    require "vendor/autoload.php"; 
    $class="Login";
    $serviceURI="http://localhost/ToCode3_2/WS-TD.php";
    $expectedFile="WS-TD.wsdl";
    require "login.php";
    $gen = new \PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
    $gen->generateWSDL();
    file_put_contents($expectedFile, $gen->dump());
    echo "Generated WSDL:";
    echo "<a href='http://localhost/ToCode3_2/$expectedFile'>$expectedFile</a><br/>";
?>