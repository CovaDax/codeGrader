<?php
	require_once "../config.php";
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if($username && $password){
		$db = new Database($config['db']);
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$result = $db->query($sql);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$user = new User();
					$user->id = $row['id'];
					$user->username = $row['username'];
					$user->password = $row['password'];
					$user->firstName = $row['firstName'];
					$user->lastName = $row['lastName'];
					$user->email = $row['email'];
					$user->role = $row['role'];
				echo "<PRE>";
			    if(!file_exists(ROOT_PATH . "/models/data/users")){
                    mkdir(ROOT_PATH . "/models/data/users", 0744) or print_r(error_get_last());
                }
                $s = serialize($course) or die("Can't Serialize");
                $fp = fopen(ROOT_PATH . "/models/data/users/". $user->username, "w");
                fwrite($fp, $s) or print_r(error_get_last());
                fclose($fp);
       			if($username==$user->username && $password==$user->password){
       				$_SESSION['userid']=$user->id;
	   				$_SESSION['username']=$user->username;
	   				$_SESSION['firstName']=$user->firstName;
	   				$_SESSION['lastName']=$user->lastName;
	   				$_SESSION['role']=$user->role;
	   				$_SESSION['user'] = $user;
					header("Location:http://" . $relative . '/index.php', true) or die("could not change to index");
	   			} else {
	   				die("Incorrect Login");
	   			}
			} 
		} else {
			die ("User does not exist");
		}
	} else {
		die ("Please enter a username and password");
	}
?>