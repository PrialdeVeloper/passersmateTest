<?php 
	trait misc{
		protected $model = null;
		protected $controller = null;
		protected $data = array();
		protected $trait = null;

		public function sanitize($variable){
			return htmlentities(trim($variable));
		}

		public function __construct(){
			
		}

		public function checkExist(){
			if (isset($_POST['dataSend']) && !empty($_POST['dataSend'])) 
			{
				$data = $_POST['dataSend'];
				$table = $data['table'];
				$field = $data['field'];
				$dataSend = $data['data'];
				echo utf8_encode($this->model->checkExistSingle($table,$field,array($dataSend)));
			}
			else
			{
				return $this->model->checkExistSingle(array($table,$field,$data));
			}
		}

		public function crawler(){
			
		}

	}
?>