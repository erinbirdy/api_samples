<?php

// include our handy API wrapper that makes it easy to call the API, it also depends on MOScURL to make the cURL call
require_once("MOSAPICall.class.php");

// setup our credentials
// this key is to our demo data and allows full access to just /Account/797/Item control
$mosapi = new MOSAPICall("303f2b1c8400dff842a1376ce3370eb52f3c127b5e1777b723c4691141d7d900","797");

// We'll create an item
$item_description = "Hello World Item #" . time();
$xml_create_item = "<?xml version='1.0'?><Item><description>$item_description</description></Item>";

// make the API call to Account.Item control with Create method and our Item XML.
$item_response_xml = $mosapi->makeAPICall("Account.Item","Create",null,$xml_create_item);

// get the itemID out of the response XML
$item_id = $item_response_xml->itemID;

// Change the item's description
$updated_description = $item_description . " Updated!";
$xml_update_item = "<?xml version='1.0'?><Item><description>$updated_description</description></Item>";

// make another API call to Account.Item, this time with Update method and our changed Item XML.
$updated_item_response_xml = $mosapi->makeAPICall("Account.Item","Update",$item_id,$xml_update_item);

// output everything
?>
<html>
	<head>
		<title>MerchantOS API Test Example</title>
	</head>
	<body>
		<div>
			<h1>Create Item</h1>
			<h2>Request:</h2>
			<?php echo htmlentities($xml_create_item); ?>
			<h2>Response:</h2>
			<?php echo htmlentities($item_response_xml->asXML()); ?>
		</div>
		<div>
			<h1>Update Item #<?php echo $item_id; ?></h1>
			<h2>Request:</h2>
			<?php echo htmlentities($xml_update_item); ?>
			<h2>Response:</h2>
			<?php echo htmlentities($updated_item_response_xml->asXML()); ?>
		</div>
	</body>
</html>
