<?php
	class Course {
		protected $crn;
		protected $title;
		protected $catalog;
		protected $section;

		public function __CONSTRUCT($crn, $title, $catalog, $section){
			$this->crn = $crn;
			$this->title = $title;
			$this->catalog = $catalog;
			$this->section = $section;
		}

		public function __GET($name){
			return $this->$name;
		}

		public function __SET($var, $value){
			$this->$var = $value;
		}
	}
?>