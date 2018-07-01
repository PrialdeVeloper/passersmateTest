<?php 
	trait misc{
		protected $model = null;
		protected $controller = null;
		protected $data = array();
		protected $trait = null;

		public function __construct(){
			
		}

		public function hello(){
			return "hello";
		}
	}
?>