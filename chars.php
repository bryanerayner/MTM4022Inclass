<?php

header("Content-Type:text/xml"); //XML content type

echo "<?xml version=\"1.0\"?>"; //XML declaration

/*XML really takes offense at single quotes - unless you really need them, just avoid them*/

/*processing a request is a lot like processing a form - we look for the values set in the given array, take said values, and do something with them.  To return data, echo it out*/
if(isset($_GET["test"])){
	
	//make a request to the database
	//$oConn = mysqli_connect("localhost", "root", "", "chars");
	$oConn = mysqli_connect("localhost", "rayn0021", "40628090", "rayn0021");
	
	//make the query
	$query = "SELECT name
				FROM characters";
	
	//send the query
	$rs = mysqli_query($oConn, $query);
	
	//echo out the data as XML
	if($rs){
		echo "<test>";
		
		while($row = mysqli_fetch_array($rs)){
			echo "<name>" . $row["name"] . "</name>";
		}
		
		echo "</test>";
	}
	
	//close the connection
	mysqli_close($oConn);
}


/*this time, we're processing using a specific value...*/
if(isset($_GET["name"])){
	$char_name = $_GET["name"];
	
	//once again, prepare the request
	//$oConn = mysqli_connect("localhost", "root", "", "chars");
	$oConn = mysqli_connect("localhost", "rayn0021", "40628090", "rayn0021");
	
	//make the query, this time getting only the exact species
	$query = "SELECT *
				FROM characters
				WHERE name = '$char_name'";
	
	//submit the query
	$rs = mysqli_query($oConn, $query);
	
	//check for validation
	if($rs){
		//in theory, we have only one row, so echo it out into XML
		$row = mysqli_fetch_array($rs);
		echo "<character>
				<name>" . $row["name"] . "</name>
				<job>" . $row["job"] . "</job>
				<description>" . $row["description"] . "</description>
				<power>" . $row["power"] . "</power>
				<magic>" . $row["magic"] . "</magic>
				<awesome>" . $row["awesome"] . "</awesome>
			  </character>";
	}
	
	//close the connection
	mysqli_close($oConn);
				
}


?>