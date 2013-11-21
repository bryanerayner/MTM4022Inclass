<?php 




function validate_userName($username, $pdo)
{
	return validate_columnUnique("user_username", $username, $pdo);
}

function validate_email($email, $pdo)
{

	return validate_columnUnique("user_email", $email, $pdo);
}

function validate_columnUnique($columnName, $value, $pdo)
{
	$sql = "SELECT * FROM users WHERE $columnName = '$value'";
	$record = $pdo->query($sql);

	if ($record && $record->rowCount() > 0)
	{
		return false;
	}
	return true;
}




?>