<form method="POST" >
    <h3 style="text-align: center;">Sign Up</h3><br>
    <h4 style="text-align: center;">Username : <input type="text" name="username"></h4><br>
    <h4 style="text-align: center;">Password : <input type="password" name="password"></h4><br>
    <h4 style="text-align: center;"><input style="text-align: center;" type="submit" value="Sign Up"></h4><br>
</form>
<?php
require_once('lib/nusoap.php');
	$error  = '';
    $result1 = array();
    $result2 = array();
	$wsdl = "http://localhost/ToCode3_2/WS1/WS1.php?wsdl";
		if(!$error){
			
			$client = new nusoap_client($wsdl, true);
			$err = $client->getError();
			if ($err) {
				echo '<h2>Constructor error</h2>' . $err;
			    exit();
			}
			try {
				$result1 = $client->call('SignUp', array(array('username' => $_POST['username'], 'password' => $_POST['password'])));
			}
			catch (Exception $e) {
			    echo 'Caught exception: ',  $e->getMessage(), "\n";
			 }
        }	
?>
<?php
require_once('lib/nusoap.php');
    $wsdl = "https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
    $client = new nusoap_client($wsdl, 'wsdl');
    $err = $client->getError();
    if ($err) {
        echo '<h2>L\'erreur est :</h2>' . $err;
        exit();
    }
    try {
    $result2=$client->call('CelsiusToFahrenheit', array('Celsius'=>$result1));
    echo $result2['CelsiusToFahrenheitResult'];
    }
    catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
?>