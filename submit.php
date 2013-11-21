<?php

require_once("includes/db.inc.php");

header('Content-Type: application/json');

$pageResponse = array();


$expectedValues = array("userName", "pass",	"email", "playName", "country", "credit", "characterType");

$acceptedValues = array();

$missingValues = array();


foreach($expectedValues as $value)
{
	if (isset($_POST[$value]))
	{
		$acceptedValues[$value] = $_POST[$value];
	}else
	{
		$missingValues[$value] = $_POST[$value];
	}
}


if (0 == count($missingValues))
{
	//There are no empty fields.
	if (validate_userName($acceptedValues["userName"]))
	{
		
	}
	else
	{
		$pageResponse["status"] = "error";
		$pageResponse["message"] = "This username, $ already exists!";
	}


}else
{
	$pageResponse["status"] = "error";
	$pageResponse["message"] = "Missing some values in the form. Please fill out all fields before submitting. Too bad there's no javascript validation to ensure you don't get this error!";
}


$userName = ;
$pass = ;
$email = ;
$playName = ;
$country = ;
$credit = ;
$characterType = ;




echo json_encode($pageResponse);

?>