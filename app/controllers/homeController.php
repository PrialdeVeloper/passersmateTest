<?php 
	class homeController extends Controller{

		protected $model = null;
		protected $controller = null;
		protected $data = [];

		public function __construct(){
			include_once "../public/etc/etcCompile.marvee";
			$this->controller = new Controller();
			$this->model = $this->controller->model("dbModel");
			$this->data = [];
		}

		public function index(){
			$this->controller->view("all/signup",['qwe'=>'qwe']);
		}

		public function search(){
			$this->controller->view("all/search",['qwe'=>'qwesxee']);
		}
	}

?>