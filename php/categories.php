<?php

$apikey = 'YOURAPIKEYHERE';
$password = 'apikey'; // API Keys don't have a password and just use this filler string
$account_id = 'YOURACCOUNTID';

// Alternatively you can use your username and password
$apikey = 'imademo';
$password = 'thisismypass';
$account_id = 797;

// Create cURL resource
$curl = curl_init();

// Set URL
curl_setopt($curl, CURLOPT_URL, "https://rad.merchantos.com/API/Account/$account_id/Category.xml?nodeDepth=0");

// Authenticate
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $apikey . ":" . $password); 

// Send content in proper format
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', $additionalHeaders));              

// Set Request Type 
// (you'll need to change this depending on what you're doing)
curl_setopt($curl,CURLOPT_GET, 1);
// curl_setopt($curl,CURLOPT_POST, 1);  // POST (Create)
// curl_setopt($curl,CURLOPT_PUT, 1); // PUT (Update)
// curl_setopt($curl,CURLOPT_CUSTOMREQUEST, 'DELETE') // DELETE

// To send parameters (data)
// curl_setopt($curl, CURLOPT_POSTFIELDS, $params);


// Return the transfer as a string
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($curl);

// Close cURL resource to free up system resources
curl_close($curl);

$xml = simplexml_load_string($output);

?>

<html>
<head>
  <title>PHP Test Page</title>
</head>
<body>
	<ul id="categories">
		<?php foreach($xml->Category AS $category) { ?>
		<li><?php echo $category->name ?></li>
		<?php } ?>
	</ul>
</body>
</html>