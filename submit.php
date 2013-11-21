<?php

require_once("includes/db.inc.php");
require_once("includes/validations.php");
require_once("includes/users.php");

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
		$missingValues[] = $value;
	}
}

if (0 == count($missingValues))
{
	//There are no empty fields.
	if (validate_userName($acceptedValues["userName"], $pdo))
	{
		if (validate_email($acceptedValues["email"], $pdo))
		{
			$newUser = new User($acceptedValues, $pdo);
			if ($newUser->save())
			{
				$pageResponse["status"] = "success";
				$pageResponse["message"] = "Succesful Registration.";
			}else
			{
				$pageResponse["status"] = "error";
				$pageResponse["message"] = "There was an error in saving your account, even though you filled out the form with impeccable precision. We are sorry.";
			}
		}
		else
		{
			$pageResponse["status"] = "error";
			$pageResponse["message"] = "This email address, ".$acceptedValues["email"]." already exists!";
		}
	}
	else
	{
		$pageResponse["status"] = "error";
		$pageResponse["message"] = "This username, ".$acceptedValues["userName"]." already exists!";
	}
}else
{
	$pageResponse["status"] = "error";
	$pageResponse["message"] = "Missing some values in the form. Please fill out all fields before submitting. Too bad there's no javascript validation to ensure you don't get this error!";
	$pageResponse["missingValues"] = json_encode($missingValues);
}






echo json_encode($pageResponse);

?>