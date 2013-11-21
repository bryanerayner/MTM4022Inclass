<?php


require_once("db.inc.php");


//Alias an array, changing key values
//
//	$aliasKeys = ("keyName"=>"keyAlias")
//	
//	
function aliasArray($input, $aliasKeys)
{
	foreach($aliasKeys as $key => $value)
	{
		if (isset($input[$key]))
		{
			$input[$value] = $input[$key];
			unset($input[$key]);
		}
	}
	return $input;
}


class User
{


	private $user_id = -1;

	public $user_username;
	public $user_pass;
	public $user_name_full;
	public $user_email;
	public $user_country;
	public $user_creditcard_number;
	public $char_id;

	public function __get($property) {
	    if (property_exists($this, $property)) {

	    	switch($property){
	    		case "id":
	    		case "user_id":
	    			return $this->"user_id";
	    		break;
	    	}

	    }
	}

	// Construct - accepts an associative array of values. If user_id is undefined, it will look up from the database.
	function __construct($values)
	{


		if (is_array($values))
		{
		//Alias the array, set "javascript" names to their database equivalents.
		$values = aliasArray(array(
								"id"=>"user_id",
								"userName"=>"user_username",
								"pass"=>"user_pass",
								"playName"=>"user_name_full",
								"email"=>"user_email",
								"country"=>"user_country",
								"credit"=>"user_creditcard_number",
								"characterType"=>"char_id"));
			
			if (isset($values["user_id"]))
			{
				$this->construct_fromId($values["user_id"]);
				return;
			}else
			{
				$this->construct_fromArray($values);
				return;
			}
		}
	}
	

	private function construct_fromId($id)
	{
		if (is_numeric($id))
		{
			$this->user_id = $id; 
			$this->fetch();
		}
		
	}
    private function construct_fromArray($values)
	{
		$expectedValues = array("user_username",
									"user_pass",
									"user_name_full",
									"user_email",
									"user_country",
									"user_creditcard_number",
									"char_id");
		$acceptedValues = array();
		$missingValues = array();

		foreach($expectedValues as $value)
		{
			if (isset($values[$value]))
			{
				$acceptedValues[$value] = $values[$value];
			}else
			{
				$missingValues[$value] = $values[$value];
			}
		}

		foreach($acceptedValues as $key => $value)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $value;
			}
		}
	}

	//Attempt to save this to the database.
	//
	// Returns "true" if a succesful save was done
	// Returns "false" if unsuccesful
	public function save()
	{
		if ($this->validate())
		{
			$user_id = $this->user_id;
			$user_username = $this->user_username;
			$user_pass = $this->user_pass;
			$user_name_full = $this->user_name_full;
			$user_email = $this->user_email;
			$user_country = $this->user_country;
			$user_creditcard_number = $this->user_creditcard_number;
			$char_id = $this->char_id;

			//Check to see if there is a record in the database already.
			$record = $this->fetch_record();
			if ($record->rowCount() == 0)
			{
				
				//We need to insert this user
				if ($user_id >= 0)
				{
					$sql = "INSERT INTO users('user_id', 'user_username', 'user_pass', 'user_name_full', 'user_email', 'user_country', 'user_creditcard_number') VALUES ('$user_id', '$user_username','$user_pass','$user_name_full','$user_email','$user_country','$user_creditcard_number')";
				}else
				{
					$sql = "INSERT INTO users('user_username', 'user_pass', 'user_name_full', 'user_email', 'user_country', 'user_creditcard_number') VALUES ('$user_username','$user_pass','$user_name_full','$user_email','$user_country','$user_creditcard_number')";
				}
				$record = $pdo->query($sql);
				$sql = "INSERT INTO users_characters('user_id', 'char_id') VALUES ('$user_id', '$char_id')";
				$record = $pdo->query($sql);
			}else
			{
				//We need to update this user
				$sql = "INSERT INTO users('user_id', 'user_username', 'user_pass', 'user_name_full', 'user_email', 'user_country', 'user_creditcard_number') VALUES ('$user_id', '$user_username','$user_pass','$user_name_full','$user_email','$user_country','$user_creditcard_number')";
				$record = $pdo->query($sql);
				$sql = "INSERT INTO users_characters('user_id', 'char_id') VALUES ('$user_id', '$char_id')";
				$record = $pdo->query($sql);
			}

			$pdo->beginTransaction();
			$pdo->exec($sql);
			$pdo->commit();
			return true;
		}
		return false;
	}

	public function validate()
	{
		$expectedValues = array(	"user_id",
									"user_username",
									"user_pass",
									"user_name_full",
									"user_email",
									"user_country",
									"user_creditcard_number",
									"char_id");

		foreach($expectedValues as $value)
		{
			if (!isset($this->$value))
			{
				return false;
			}
		}
		return true;
	}



	private function fetch()
	{
		$record = $this->fetch_record();
		if($record)
			if ($record->rowCount() > 0)
			{
				$values = $record->fetch(PDO::FETCH_ASSOC);
				foreach($values as $key => $value)
				{
					if (isset($values[$value]))
					{
						$this->$key = $value;
					}
				}
				return true;
			}
		}
		return false;
	}

	//Fetch records associated with the 
	private function fetch_record()
	{
		$id = $this->user_id;
		if ($id >= 0)
		{
			$sql = "SELECT u.*, c.char_id FROM users as u INNER JOIN users_characters as c ON u.user_id = c.user_id WHERE u.user_id = '$id'";
			$record = $pdo->query($sql);
		}
		else
		{
			return false;
		}
	}
}



?>