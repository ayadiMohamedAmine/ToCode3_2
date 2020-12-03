<?php
 // Pull in the NuSOAP code
 require_once('lib/nusoap.php');

 // Create the server instance
 $server = new nusoap_server();

// Define the method as a PHP function
  function SignUp($user){
    $users[$user['username']] = $user['password'];
    return strlen($user['password']);
  }

  function LogOut($user){
    return "See you soon ".$user;
  }

// Initialize WSDL support
  $server->configureWSDL('web service with complex data type', 'urn:localhost');
  $server->wsdl->schemaTargetNamespace = 'urn:localhost';
  $server->wsdl->addComplexType(
    'User',
    'complexType', 
    'struct','all', 
    '',
    array(
        'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'password' => array('name' => 'password', 'type' => 'xsd:string'))
  );

// Register the method to expose
  $server->register('SignUp',
  array('user' => 'tns:User'),  //input
  array('passwordLength' => 'xsd:int'),  //output
  'urn:localhost',   //namespace
  'urn:localhost#SignUp' //soapaction
  ); 

  $server->register('LogOut',
  array('user' => 'xsd:string'),  //input
  array('msg' => 'xsd:string'),  //output
  'urn:localhost',   //namespace
  'urn:localhost#SignUp' //soapaction
  ); 

// Use the request to (try to) invoke the service
  $server->service(file_get_contents("php://input"));
?>