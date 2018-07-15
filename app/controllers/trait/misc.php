<?php
	trait misc{
		protected $model = null;
		protected $controller = null;
		protected $data = array();
		protected $trait = null;
		protected $options = ['cost' => 12,];

		public function sanitize($variable){
			return htmlentities(trim($variable));
		}

		public function checkSession($session){
			return isset($_SESSION[$session])?true:false;
		}

		public function hashPassword($variable){
			return password_hash($variable, PASSWORD_BCRYPT, $this->options);
		}

		public function verifyHash($password,$hashPassword){
			if(password_verify($password,$hashPassword)){
				return true;
			}
			else{
				return false;
			}
		}

		public function __construct(){
			
		}

		public function logout(){
			session_destroy();
			header("location:register");
		}

		public function crawler(){
			$data = null;
			$lname = null;
			$fnameIndex = null;
			$fname = null;
			$mnameIndex = null;
			$mname = null;
			if(isset($_POST['dataSent'])){
				$coc = $_POST['data'];
				$curl = curl_init();
				$url = "http://www.tesda.gov.ph/Rwac/Result2?CurrentFilter=&CertFilter=".$coc."&QualFilter=";
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$res = curl_exec($curl);
				// print_r($res);
				curl_close($curl);

				$dom = new simple_html_dom();
				$dom->load($res);

				if($dom->find('table tr td',0)){
					$name = trim($dom->find('table tr td',0)->plaintext);
					$i = 0;
					while(substr($name, $i,1) != ","){
						$lname = $lname."".substr($name, $i,1);
						$i +=1;
						$fnameIndex = $i+1;
					}
					while(substr($name, $fnameIndex+1,1) != ".") {
						$fname = $fname."".substr($name, $fnameIndex,1);
						$fnameIndex +=1;
						$mnameIndex = $fnameIndex;
					}
					$fname = ucwords(strtolower($fname));
					$lname = ucwords(strtolower($lname));
					$mname = substr($name, $mnameIndex,1);
					$num = trim($dom->find('table tr td',1)->plaintext);
					$ncert = trim($dom->find('table tr td',2)->plaintext);

					$point =  strpos($ncert, ' NC ')+1;
					$textResult = substr($ncert, $point,6);
					for ($i=6; $i > 0 ; $i--) { 
						$textResult = substr($ncert, $point,$i);

						if($textResult == "NC III"){
							$certType = "NC III";
							break;
						}elseif($textResult == "NC II"){
							$certType = "NC II";
							break;
						}elseif($textResult == "NC I"){
							$certType = "NC I";
							break;
						}else{
							$certType = "COC";
							break;
						}
					}

					$link = "http://www.tesda.gov.ph".trim($dom->find('table tr td:eq(3) a',0)->href);

					$data = array("fname"=>$fname,"lname"=>$lname,"mname"=>$mname,
						"cnum"=>$num,"cert"=>$ncert,"certType"=>$certType,
						"link",$link,"error"=>false);
					$json =  json_encode($data,JSON_UNESCAPED_UNICODE);
					echo $json;
				}
				else{
					echo json_encode(array("error"=>true),JSON_UNESCAPED_UNICODE);
				}
			}
		}


		public function checkExist(){
			if (isset($_POST['dataSend']) && !empty($_POST['dataSend'])) 
			{
				$table = $_POST['table'];
				$field = $_POST['field'];
				$dataSend = $_POST['data'];
				echo utf8_encode($this->model->checkExistSingle($table,$field,array($dataSend)));
			}
			else
			{
				return $this->model->checkExistSingle(array($table,$field,$data));
			}
		}

		public function imageUpload($destination,$file,$id){
			$target_dir = "../../public/images/".$destination."/";
			$target_file = $target_dir . basename($_FILES[$file]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$randomFileName = time() . strtotime("now") . rand(1,6) . $id . "." . $imageFileType;
			$fileDir = $target_dir . $randomFileName;
		    if (move_uploaded_file($_FILES[$file]["tmp_name"], $fileDir)) {
		        return $randomFileName;
		    } else {
		        return $_FILES[$file]["error"];
		    }
		}

		public function registerPasser(){
			if(isset($_POST['registerPasser'])){
					$cocNumber = $this->sanitize($_POST['cocNumber']);
					$passerFirstname = $this->sanitize($_POST['passerFirstname']);
					$passerLastname = $this->sanitize($_POST['passerLastname']);
					$passerMiddlename = $this->sanitize($_POST['passerMiddlename']);
					$cocTitle = $this->sanitize($_POST['cocTitle']);
					$passerPassword = $this->sanitize($this->hashPassword($_POST['passerPassword']));
					$email = $this->sanitize($_POST['email']);
					$typeofCertificatePasser = $this->sanitize($_POST['typeofCertificatePasser']);
					$passerTesdaLink = $this->sanitize($_POST['passerLink']);
					try {
						$return = $this->model->insertDB('passer',$this->passerReg,array($cocNumber,$passerFirstname,$passerLastname,$passerMiddlename,$passerPassword,$email,$cocTitle,$typeofCertificatePasser,$passerTesdaLink));
						$_SESSION['passerUser'] = $return;
						echo json_encode(array("error"=>"none"));
					} catch (Exception $e) {
						echo json_encode(array("error"=>$e->getMessage()));
					}
				}
		}
	}
?>