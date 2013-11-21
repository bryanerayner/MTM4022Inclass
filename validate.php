<?php

require_once("includes/db.inc.php");
require_once("includes/validations.php");


header('Content-Type: application/json');

$pageResponse = array();
$pageResponse["valid"] = "unevaluated";

if (isset($_GET["userName"]))
{
	if (validate_userName($_GET["userName"], $pdo))
	{
		$pageResponse["valid"] = true;
	}else
	{
		$pageResponse["valid"] = false;
	}
}else if (isset($_GET["email"]))
{
	if (validate_email($_GET["email"], $pdo))
	{
		$pageResponse["valid"] = true;
	}else
	{
		$pageResponse["valid"] = false;
	}
}


echo json_encode($pageResponse);

?>