<html>
<head>
	<title> Search </title>	
</head>
<body>
	<form method="post" action="search.php" enctype="multipart/form-data" >
     SeRch word Search word <input type="text" name="search" id="search_id"/></br>
      <input type="submit" name="submit" value="search" />
	</form>
	
	
	<?php
	
    // DB connection info
       $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b189f24b15ebb7";
    $pwd = "439af0e9";
    $db = "michaeldatabase";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
     
    //get search word
    if(!empty($_POST)) {
		try {
			$search_id = $_POST['search'];
			//dsf
		
		}
		catch(Exception $e) {
			die(var_dump($e));
		}
		
		$sql_select = "SELECT * FROM registration_tbl WHERE name LIKE ?";
		$stmt = $conn->prepare($sql_select);
        $stmt->bindValue(1, '%'.$search_id.'%');
        $stmt->execute();
	
		
		$registrants = $stmt->fetchAll();
		
	 
		if(count($registrants) > 0) {
			echo "<h2>Search results:</h2>";
			echo "<table>";
			echo "<tr><th>Name</th>";
			echo "<th>Email</th>";
			echo "<th>Date</th>";
			echo "<th>Company</th></tr>";
			foreach($registrants as $registrant) {
				echo "<tr><td>".$registrant['name']."</td>";
				echo "<td>".$registrant['email']."</td>";
				echo "<td>".$registrant['date']."</td>";
				echo "<td>".$registrant['Company']."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<h3>No result</h3>";
		}
    }
   
?>
	
</body>
</html>
