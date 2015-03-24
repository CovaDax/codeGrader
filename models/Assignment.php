<?php
	class Assignment {
		private $id;
		private $crn;
		private $deadline;
		private $directory;

		public function __CONSTRUCT($crn, $id){
			//$this->directory = $_SERVER . $crn . "/" . $id;
			$this->id = $id;
			$this->crn = $crn;
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

	    public function makeDirectory(){
	    	
	    }
	}
?>