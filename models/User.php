<?php
	class User {
		protected $id;
		protected $username;
		protected $password;
		protected $firstName;
		protected $lastName;
		protected $email;
		protected $role;

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

		public function login(){
			
		}

		public function logout(){

		}
	}
?>