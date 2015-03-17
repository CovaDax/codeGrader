<?php
	class Database {
		private $host;
		private $user;
		private $password;
		private $database;

		public function __CONSTRUCT($db){
			$this->host = $db['db1']['host'];
			$this->user = $db['db1']['username'];
			$this->password = $db['db1']['password'];
			$this->database = $db['db1']['dbname'];
		}

	    public function __GET($property) {
	        if (property_exists($this, $property)) {
	            return $this->$property;
	        }
	    }

	    public function __SET($property, $value) {
	        if (property_exists($this, $property)) {
	            $this->$property = $value;
	        }
	    }

		public function query($sql){
			echo $this->host;
			$connection = new mysqli($this->host, $this->user, $this->password, $this->database);
			$result = $connection->query($sql);
			return $result;
		}
	}
	
?>