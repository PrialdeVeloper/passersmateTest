<?php
	trait misc{
		protected $seekerTable = "seeker";
		protected $seekerUnique = "SeekerID";
		protected $passerTable = 'passer';
		protected $passerUnique = 'PasserID';
		protected $notifDB = 'notification';
		protected $notifTable = array("PasserID","SeekerID","notificationType","notificationMessage");
		protected $model = null;
		protected $controller = null;
		protected $data = array();
		protected $trait = null;
		protected $options = ['cost' => 12,];
		public $subscriptionDB = "subscription";
		public $subscriptionTable = array("SubscriptionTypeID","SeekerID","SubscriptionStart","SubscriptionEnd","PaymentMethod");
		public $offerJobDB = "offerjobform";
		public $offerJobTable = array("SeekerID","WorkingAddress","StartDate","EndDate","Salary","PaymentMethod","AccomodationType");
		public $offerJobTableUsed = array("OfferJobID","notes","WorkingAddress","StartDate","EndDate","Salary","PaymentMethod","AccomodationType");
		public $offerJobTableDefault = array("SeekerID","WorkingAddress","StartDate","EndDate","Salary","PaymentMethod","AccomodationType","offerjobformDefault","uneditable");
		public $disableDB = 'disabledusers';
		public $disableTable = array("PasserID","SeekerID","DeactivateReason");
		public $messageTable = "message";
		public $messageDB = array("PasserID","SeekerID","MessageContent","MessageSender");
		public $agreementTable = "agreement";
		public $agreementDB = array("SeekerID","PasserID","OfferJobFormUsedID");
		public $offerJobAddTable = "offerjob";
		public $offerJobAddDB = array("OfferJobFormID","SeekerID","PasserID","Notes");
		public $cancelTable = "canceljoboffer";
		public $cancelDB = array("OfferJobID","SeekerID","PasserID","CancellationInitiator","CancelReason");
		public $disputeTable = "dispute";
		public $disputeDB = array("PasserID","SeekerID","JobOfferID","DisputeIssuer","DisputeReason");
		public $ratingTable = "ratings";
		public $ratingDB = array("OfferJobID","PasserID","SeekerID","PersonalityRate","PunctualityRate","WorkQualityRate","Feedback","ReviewBy");
		public $switchTable = "switch";
		public $switchDB = array("SeekerID","PasserID","Original");
		public $seekerSwitchDB = array("SeekerFN","SeekerLN","SeekerBirthdate","SeekerAge","SeekerGender","SeekerStreet","SeekerCity","SeekerAddress","SeekerCPNo","SeekerEmail","SeekerPass","SeekerProfile","SeekerStatus");
		public $passerSwitchDB = array("PasserFN","PasserLN","PasserPass","PasserEmail");
		public $transactionTable = "transactionhistory";
		public $transactionDB = array("OfferJobID","OldStatus","NewStatus","Triggerer","TransactionDateTime");


		public function sanitize($variable){
			return htmlentities(trim($variable));
		}

		public function decodeISO($variable){
			return html_entity_decode($variable);
		}

		public function upperFirstOnlySpecialChars($variable){
			return ucwords(mb_strtolower($variable,"UTF-8"));
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

		public function getDetailsSeeker($seeker){
			return $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($seeker));
		}

		public function sendSMS($number,$message){
			$array_fields['phone_number'] = $number;
			$array_fields['message'] = $message;
			$array_fields['device_id'] = 102125;

			$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzNzI0NDU1OSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjUwMjAxLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.nc-a8NkAnKwWl-ipaGiI5drc3Geg69idg1P76h39GKA";

			$curl = curl_init();

			curl_setopt_array($curl, array(
			    CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_ENCODING => "",
			    CURLOPT_MAXREDIRS => 10,
			    CURLOPT_TIMEOUT => 30,
			    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			    CURLOPT_CUSTOMREQUEST => "POST",
			    CURLOPT_POSTFIELDS => "[  " . json_encode($array_fields) . "]",
			    CURLOPT_HTTPHEADER => array(
			        "authorization: $token",
			        "cache-control: no-cache"
			    ),
			));
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			    echo "cURL Error #:" . $err;
			}
			return true;
		}

		public function joinCancelJobOffer(){
			$data = null;
			if(isset($_POST['getCancelData'])){
				$data = $this->model->joinCancel(array($_POST['id']))[0];
				if($data['CancellationStatus'] == 1){
					echo json_encode(array("data"=>$data));
				}
			}
		}

		public function getDetailsAjax(){
			 $user = $table = null;
			if(isset($_POST['user'])){
				$user = ($_POST['user'] == "seeker"?$this->seekerUnique:$this->passerUnique);
				$table = ($_POST['user'] == "seeker"?$this->seekerTable:$this->passerTable);
				echo json_encode($this->model->selectAllFromUser($table,$user,array($_POST['id']))[0]);	
			}
		}

		public function getDetailsAjaxDynamic(){
			 $user = $table = null;
			if(isset($_POST['user'])){
				$user = $_POST['user'];
				$table =  $_POST['table'];
				$unique = ($table == "Seeker"?"SeekerID":"PasserID");
				echo json_encode($this->model->selectAllFromUser($table,$unique,array($user))[0]);	
			}
		}

		public function getDetailsPasser($passer){
			return $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($passer));
		}

		public function getDefaultOfferJob($seeker){
			return $this->model->selectAllDynamic($this->offerJobDB,array("*"),array("offerjobformDefault",$this->seekerUnique),array(1,$seeker));
		}

		public function checkExistingWorkPasser($passer){
			return ($this->model->checkAuthenticity("agreement",$this->passerUnique,"AgreementStatus",array($passer,1)) <=0?false:true);
		}

		public function seekerIsSubscribed(){
			$subscription = null;
			if(!$this->checkSession('seekerUser')){
				header("location:../seeker/dashboard");
			}
			$subscription = $this->model->selectTwoCondition(array("*"),$this->subscriptionDB,"SubscriptionStatus",$this->seekerUnique,array("ongoing",$_SESSION['seekerUser']));
			return (empty($subscription) ?false:true);
		}

		public function seekerIsSubscribedDynamic($seeker){
			$subscription = null;
			$subscription = $this->model->selectTwoCondition(array("*"),$this->subscriptionDB,"SubscriptionStatus",$this->seekerUnique,array("ongoing",$seeker));
			return (empty($subscription) ?false:true);
		}

		public function seekerCheckSubscriptionStatus(){
			$subscription = null;
			if($this->checkSession('seekerUser')){
				$subscription = $this->model->selectTwoCondition(array("*"),$this->subscriptionDB,$this->seekerUnique,"SubscriptionStatus",array($_SESSION['seekerUser'],"ongoing"));
				if(!empty($subscription)){
					foreach ($subscription as $data) {
						if($data['SubscriptionEnd'] < date("Y-m-d")){
							$this->model->updateDB($this->subscriptionDB,array("SubscriptionStatus"),array("ended"),$this->seekerUnique,$_SESSION['seekerUser']);
							$this->createNotification("subscription",array("sendTo"=>"SeekerID","id"=>$_SESSION['seekerUser'],"message"=>2));
						}
					}
				}
			}
		}

		public function JOformDisplayDefault(){
			$passerID = $default = $offerJobCheck = $flag = null;
			if(isset($_POST['getDefaultBitch'])){
				if(strlen($_POST['id']) != 14){
					$passerID = $this->sanitize($_POST['id']);
				}else{
					$passerID = $this->model->selectSingleUser($this->passerTable,$this->passerUnique,array($this->sanitize($_POST['id'])),"PasserCOCNo");
				}
				if(isset($_SESSION['passerJobOffer'])){
					unset($_SESSION['passerJobOffer']);
				}
				$_SESSION['passerJobOffer'] = $passerID;
				if($this->checkSession('seekerUser')){
					if($this->seekerIsSubscribed()){
						if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
							if($this->getDetailsPasser($passerID)[0]['PasserStatus'] == 1){
								if($this->getDefaultOfferJob($_SESSION['seekerUser'])){
									// $offerJobCheck = $this->model->selectAllFromUser("offerjob",$this->passerUnique,array($passerID));
									// if(!empty($offerJobCheck)){
									// 	foreach ($offerJobCheck as $data) {
									// 		if($data['OfferJobStatus'] != 7 && $data['OfferJobStatus'] != 8){
									// 			$flag = 1;
									// 		}
									// 	}
									// }
									if($flag == null){
										$default = $this->getDefaultOfferJob($_SESSION['seekerUser']);
										$default['formattedStartDate'] = date("F jS, Y", strtotime($default[0]['StartDate']));
										$default['formattedEndDate'] = date("F jS, Y", strtotime($default[0]['EndDate']));
										echo json_encode(array("error"=>"none","data"=>$default));
									}
									else{
										echo json_encode(array("error"=>"unfinishedBusiness"));
									}
								}
								else{
									echo json_encode(array("error"=>"noDefaultJobOffer"));
								}
							}
							else{
								echo json_encode(array("error"=>"passerNotVerified"));
							}
						}
						else{
							echo json_encode(array("error"=>"seekerNotVerified"));
						}
					}
					else{
						echo json_encode(array("error"=>"notSubscribed"));
					}
				}
				else{
					echo json_encode(array("error"=>"notSeeker"));
				}
			}
		}

		public function offerJobAdd(){
			$insert = $defaultJobOffer = $offerJobCheck = $flag = null;
			if(isset($_POST['offerJobAdd'])){
				if($this->checkSession('passerJobOffer')){
					if($this->checkSession('seekerUser')){
						if($this->seekerIsSubscribed()){
							if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
								if($this->getDetailsPasser($_SESSION['passerJobOffer'])[0]['PasserStatus'] == 1){
									if($this->getDefaultOfferJob($_SESSION['seekerUser'])){
										// $offerJobCheck = $this->model->selectAllFromUser("offerjob",$this->passerUnique,array($_SESSION['passerJobOffer']));
										// if(!empty($offerJobCheck)){
										// 	foreach ($offerJobCheck as $data) {
										// 		if($data['OfferJobStatus'] != 7 && $data['OfferJobStatus'] != 8){
										// 			$flag = 1;
										// 		}
										// 	}
										// }
										if($flag == null){
											$notes = (isset($_POST['notes'])?$this->sanitize($_POST['notes']):"");
											$defaultJobOffer = $this->getDefaultOfferJob($_SESSION['seekerUser'])[0]['OfferJobFormID'];
											$insert = $this->model->insertDB($this->offerJobAddTable,$this->offerJobAddDB,array($defaultJobOffer,$_SESSION['seekerUser'],$_SESSION['passerJobOffer'],$notes));
											if($insert){
											$this->model->insertDB($this->transactionTable,$this->transactionDB,array($insert,0,1,"Seeker",date("Y-m-d H:i:s")));
												$this->model->updateDBDynamic($this->offerJobDB,array("uneditable"),array(2,$_SESSION['seekerUser'],$defaultJobOffer),array($this->seekerUnique,"OfferJobFormID"));
												$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$_SESSION['passerJobOffer'],"message"=>1));
												unset($_SESSION['passerJobOffer']);
												echo json_encode(array("error"=>"none"));
											}
										}
										else{
											echo json_encode(array("error"=>"unfinishedBusiness"));
										}
									}
									else{
										echo json_encode(array("error"=>"noDefaultJobOffer"));
									}
								}
								else{
									echo json_encode(array("error"=>"passerNotVerified"));
								}
							}
							else{
								echo json_encode(array("error"=>"seekerNotVerified"));
							}
						}
						else{
							echo json_encode(array("error"=>"notSubscribed"));
						}
					}
					else{
						echo json_encode(array("error"=>"notSeeker"));
					}
				}
				else{
					echo json_encode(array("error"=>"noPasserSelected"));
				}
			}
		}

		public function dynamicOfferJobAdd(){
			$insert = $defaultJobOffer = $offerJobCheck = $flag = $passer = null;
			if(isset($_POST['dynamicOfferJobAdd'])){
				$passer = $this->sanitize($_POST['passerID']);
				if($this->checkSession('seekerUser')){
					if($this->seekerIsSubscribed()){
						if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
							if($this->getDetailsPasser($passer)[0]['PasserStatus'] == 1){
								if($this->getDefaultOfferJob($_SESSION['seekerUser'])){
									// $offerJobCheck = $this->model->selectAllFromUser("offerjob",$this->passerUnique,array($passer));
									// if(!empty($offerJobCheck)){
									// 	foreach ($offerJobCheck as $data) {
									// 		if($data['OfferJobStatus'] != 7 && $data['OfferJobStatus'] != 8){
									// 			$flag = 1;
									// 		}
									// 	}
									// }
									if($flag == null){
										$notes = (isset($_POST['notes'])?$this->sanitize($_POST['notes']):"");
										$defaultJobOffer = $this->getDefaultOfferJob($_SESSION['seekerUser'])[0]['OfferJobFormID'];
										$insert = $this->model->insertDB($this->offerJobAddTable,$this->offerJobAddDB,array($defaultJobOffer,$_SESSION['seekerUser'],$passer,$notes));
										if($insert){
											$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$passer,"message"=>1));
											echo json_encode(array("error"=>"none"));
										}
									}
									else{
										echo json_encode(array("error"=>"unfinishedBusiness"));
									}
								}
								else{
									echo json_encode(array("error"=>"noDefaultJobOffer"));
								}
							}
							else{
								echo json_encode(array("error"=>"passerNotVerified"));
							}
						}
						else{
							echo json_encode(array("error"=>"seekerNotVerified"));
						}
					}
					else{
						echo json_encode(array("error"=>"notSubscribed"));
					}
				}
				else{
					echo json_encode(array("error"=>"notSeeker"));
				}
			}
		}

		public function checkAuthenticity($table,$field,$field2,$data){
			$return = null;
			$return = $this->model->checkAuthenticity($table,$field,$field2,$data);
			return $return?true:false;
		}

		public function selectAndAuthenticate(){
			if(isset($_POST['select'])){
				$user = $this->sanitize($_POST['user']);
				$id = ($user == "SeekerID"?$_SESSION['seekerUser']:$_SESSION['passerUser']);
				$table = $this->sanitize($_POST['table']);
				$field = $this->sanitize($_POST['field']);
				$data = $this->sanitize($_POST['data']);
				$checkAuthenticity = $this->checkAuthenticity($table,$user,$field,array($id,$data));
				if($checkAuthenticity){
					try {
						$operation = $this->model->selectAllFromUser($table,$field,array($data));
						if($operation){
							echo json_encode(array("error"=>"none","data"=>$operation));
						}
						else{
							echo json_encode(array("error"=>$operation));
						}
					} catch (Exception $e) {
						echo $e->getMessage();
					}
				}else{
					echo json_encode(array("error"=>"wrongUser"));
				}
			}
		}

		public function unlinkFileFromDB($imageName){
			$imageFile = str_replace("../../", "../", $this->sanitize($imageName));
			if(file_exists($imageFile)){
				unlink($imageFile);
			}
			return true;
			
		}

		public function createNotification($notifType,$to = []){
			$number =  $message = null;
			$execute = 1;
			if($notifType == 'message'){
				$checkExist = $this->model->checkExistSingle($this->notifDB,$to['sendTo'],array($to['id']));
				if($checkExist){
					$execute = 0;
				}
			}
			if($execute = 1){
				if($to['sendTo'] == "PasserID"){
					$this->model->insertDB($this->notifDB,$this->notifTable,array($to['id'],NULL,$notifType,$to['message']));
					$number = $this->getDetailsPasser($to['id'])[0]['PasserCPNo'];
					$message = $this->notificationMeaning($notifType,$to['message']);
				}
				else{
					$this->model->insertDB($this->notifDB,$this->notifTable,array(NULL,$to['id'],$notifType,$to['message']));
					$number = $this->getDetailsSeeker($to['id'])[0]['SeekerCPNo'];
					$message = $this->notificationMeaning($notifType,$to['message']);
				}
				if(!empty($number) && $message != 'message'){
					$number = "0".$number;
					$this->sendSMS($number,$message);
				}
			}
			// ($execute = 1?($to['sendTo'] == "PasserID")?$this->model->insertDB($this->notifDB,$this->notifTable,array($to['id'],NULL,$notifType,$to['message'])):$this->model->insertDB($this->notifDB,$this->notifTable,array(NULL,$to['id'],$notifType,$to['message'])):""); 
			return true;
		}


		public function notificationMeaning($notifType,$message){
			switch ($notifType) {
				case 'updateUserStatus':
					switch ($message) {
						case '1':
							$message = "Hurray! PassersMate verified or activated your acount. Please login your account for more information.";
							break;
						case '3':
							$message = "Your verification request has been declined, it maybe caused one of your passed documents. Please check and login your account for more information.";
							break;
						case '4':
							$message = "You have disabled your account If this is not you please check and login your account for more information.";
							break;
						case '5':
							$message = "Passersmate has disabled your account. Please check and login your account for more information.";
							break;
					}
					break;

				case 'message':
					$link = "message";
					break;

				case 'subscription':
					switch ($message) {
						case '0':
							$message = "You may want to subscribe first, Mate!";
							$link = "subscription";
							break;
						case '1':
							$message = "You have successfully Subscribed. Please Login to Passersmate for more information.";
							break;
						case '2':
							$message = "Your subscription has ended. Login to Passersmate for more information.";
							break;
					}
					break;
				case 'JobOffer':
					switch ($message) {
						case '1':
							$message = "You have a job offer, Mate! Login to Passersmate for more information.";
							break;
						case '2':
							$message = "A recent job offer you received was updated mate! Check it out! Login to Passersmate for more information.";
							break;
						case '3':
							$message = "Congratulations, You have been hired! Login to Passersmate for more information.";
							break;
						case '4':
							$message = "A seeker has requested to cancel a job. Login to Passersmate for more information.";
							break;
						case '5':
							$message = "A job youv'e been hired has been marked done. Login to Passersmate for more information.";
							break;
					}
					break;
				case 'jobOfferSeeker':
					switch ($message) {
						case '3':
							$message = "Your job offer has been accepted! Check it out mate! Login to Passersmate for more information.";
							break;
						case '4':
							$message = "Unfortunately, your job offer has been rejected. Login to Passersmate for more information.";
							break;
						case '3':
							$message = "A passer has requested to cancel a job. Login to Passersmate for more information.";
							break;
					}
					break;
				case 'cancellationSeeker':
					switch ($message) {
						case '1':
							$message = "You have new job cancellation Request. Login to Passersmate for more information.";
							break;
						case '2':
							$message = "Your job cancellation has been Approved. Login to Passersmate for more information.";
							break;
						case '3':
							$message = "Your job cancellation has been declined. Login to Passersmate for more information.";
							break;
					}
					break;

				case 'dispute':
					switch ($message) {
						case '1':
							$message = "A Passer has file a dispute . Login to Passersmate for more information.";
							break;
					}
					break;

				case 'disputeSeeker':
					switch ($message) {
						case '1':
							$message = "A Seeker has file a dispute. Login to Passersmate for more information.";
							break;
					}
					break;
			}
			return $message;
		}

		public function addPasserToMessage(){
			$passerID = $addMessage = $checkExist = null;
			if(isset($_POST['addtomessage'])){
				$passerID = $this->model->selectAllFromUser($this->passerTable,"PasserCOCNo",array($this->sanitize($_POST['passerCOC'])));
				if(!empty($passerID)){
					extract($passerID[0]);
					if($PasserStatus == 1){
						extract($this->getDetailsSeeker($_SESSION['seekerUser'])[0]);
						if($SeekerStatus ==1){
							if($this->seekerIsSubscribed()){
								$checkExist = $this->model->selectAllDynamic($this->messageTable,array("*"),array($this->passerUnique,$this->seekerUnique),array($PasserID,$_SESSION['seekerUser']));
								if(empty($checkExist)){
									$addMessage = $this->model->insertDB($this->messageTable,$this->messageDB,array($PasserID,$_SESSION['seekerUser'],"",""));
									if($addMessage){
										echo json_encode(array("error"=>"none"));
									}
								}else{
									echo json_encode(array("error"=>"none"));
								}
							}else{
								echo json_encode(array("error"=>"noSubscription"));
							}
						}else{
							echo json_encode(array("error"=>"notActivatedSeeker"));
						}
					}else{
						echo json_encode(array("error"=>"notActivatedPasser"));
					}
				}else{
					echo json_encode(array("error"=>"notFound"));
				}
			}
		}

		public function addPasserToMessageJobOffer(){
			$passerID = $addMessage = $checkExist = null;
			if(isset($_POST['addtomessage'])){
				$passerID = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($this->sanitize($_POST['seekerID'])));
				if(!empty($passerID)){
					extract($passerID[0]);
					if($PasserStatus == 1){
						extract($this->getDetailsSeeker($_SESSION['seekerUser'])[0]);
						if($SeekerStatus ==1){
							if($this->seekerIsSubscribed()){
								$checkExist = $this->model->selectAllDynamic($this->messageTable,array("*"),array($this->passerUnique,$this->seekerUnique),array($PasserID,$_SESSION['seekerUser']));
								if(empty($checkExist)){
									$addMessage = $this->model->insertDB($this->messageTable,$this->messageDB,array($PasserID,$_SESSION['seekerUser'],"",""));
									if($addMessage){
										echo json_encode(array("error"=>"none"));
									}
								}else{
									echo json_encode(array("error"=>"none"));
								}
							}else{
								echo json_encode(array("error"=>"noSubscription"));
							}
						}else{
							echo json_encode(array("error"=>"notActivatedSeeker"));
						}
					}else{
						echo json_encode(array("error"=>"notActivatedPasser"));
					}
				}else{
					echo json_encode(array("error"=>"notFound"));
				}
			}
		}

		public function addSeekerToMessage(){
			$seekerID = $addMessage = $checkExist = null;
			if(isset($_POST['addtomessage'])){
				$seekerID = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($this->sanitize($_POST['seekerID'])));
				if(!empty($seekerID)){
					extract($seekerID[0]);
					if($SeekerStatus == 1){
						extract($this->getDetailsPasser($_SESSION['passerUser'])[0]);
						if($PasserStatus ==1){
							if($this->seekerIsSubscribedDynamic($_POST['seekerID'])){
								$checkExist = $this->model->selectAllDynamic($this->messageTable,array("*"),array($this->seekerUnique,$this->passerUnique),array($SeekerID,$_SESSION['passerUser']));
								if(empty($checkExist)){
									$addMessage = $this->model->insertDB($this->messageTable,$this->messageDB,array($this->passerSession,$_POST['seekerID'],"",""));
									if($addMessage){
										echo json_encode(array("error"=>"none"));
									}
								}else{
									echo json_encode(array("error"=>"none"));
								}
							}else{
								echo json_encode(array("error"=>"noSubscription"));
							}
						}else{
							echo json_encode(array("error"=>"notActivatedPasser"));
						}
					}else{
						echo json_encode(array("error"=>"notActivatedSeeker"));
					}
				}else{
					echo json_encode(array("error"=>"notFound"));
				}
			}
		}

		public function sendMessage(){
			$message = $sender = $reciever = $send = $messageSenderUser = $checkSubscription = null;
			$flag = 1;
			if(isset($_POST['message'])){
				$message = $this->sanitize($_POST['message']);
				$reciever = $this->sanitize($_POST['sender']);
				$sender = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$messageSenderUser = (isset($_SESSION['passerUser'])?"Passer":"Seeker");
				if(isset($_SESSION['seekerUser'])){
					echo $this->seekerIsSubscribed();
					if($this->seekerIsSubscribed() == false){
						$flag = 0;
					}
				}
				if($flag > 0){
					$send = (isset($_SESSION['seekerUser'])?$this->model->insertDB($this->messageTable,$this->messageDB,array($reciever,$sender,$message,$messageSenderUser)):$this->model->insertDB($this->messageTable,$this->messageDB,array($sender,$reciever,$message,$messageSenderUser)));
				}
			}
		}

		public function getMessageUser(){
			$user = $otherUser = $otherUserID = $otherUserData = $otherUserTable = $otherUserUnique = $otherUserProfile = $otherUserFullName = $otherUserMessages = $dom = $builder = $dateRaw = $sentDate =null;
			if(!isset($_POST['otherUserID'])){
				$this->toOtherPage("messages");
			}
			$otherUserID = $this->sanitize($_POST['otherUserID']);
			$user = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);	
			$otherUser = (isset($_SESSION['passerUser'])?"Seeker":"Passer");
			$otherUserTable = (isset($_SESSION['passerUser'])?$this->seekerTable:$this->passerTable);
			$otherUserUnique = (isset($_SESSION['passerUser'])?$this->seekerUnique:$this->passerUnique);
			$otherUserData = $this->model->selectAllFromUser($otherUserTable,$otherUserUnique,array($otherUserID));
			extract($otherUserData[0]);
			$otherUserProfile = (isset($PasserProfile)?$PasserProfile:$SeekerProfile);
			$otherUserFullName = (isset($PasserFN)?$PasserFN." ".$PasserLN:$SeekerFN." ".$SeekerLN);
			$otherUserMessages = $this->model->selectAllFromUserSort(array("*"),$this->messageTable,$otherUserUnique,array($otherUserID),"MessageID","ASC");
			if(!empty($otherUserMessages)){
				foreach ($otherUserMessages as $data) {
					if(!empty($data['MessageContent'])){
						$dateRaw = $data['MessageTimeAndDate'];
						if(strtotime("Y",strtotime($dateRaw)) > strtotime("+1 year",strtotime(date("Y")))){
							$sentDate = date("g:i A",strtotime($dateRaw))." | ".date("M d 'y",strtotime($dateRaw));
						}else{
							$sentDate = date("g:i A",strtotime($dateRaw))." | ".date("F d",strtotime($dateRaw));
						}
						if($data['MessageSender'] == $otherUser){
							$builder = 
							'
							<div class="incoming_msg">
		                      <div class="incoming_msg_img"> 
		                      	<img src="'.$this->sanitize($otherUserProfile).'" alt="sunil"> 
		                      </div>
		                      <div class="received_msg">
		                        <div class="received_withd_msg">
		                          <p>'.$data['MessageContent'].'</p>
		                          <span class="time_date">'.$sentDate.'</span>
		                        </div>
		                      </div>
		                    </div>
							';
						}else{
							$builder = 
							'
							<div class="outgoing_msg">
		                      <div class="sent_msg">
		                        <p>'.$data['MessageContent'].'</p>
		                        <span class="time_date">'.$sentDate.'</span> 
		                      </div>
		                    </div>
							';
						}
						$dom = $dom."".$builder;
						$dateRaw = $sentDate = null;
					}
				}
			}
			else{
				$dom = "No Messages";
			}
			echo json_encode(array("dom"=>$dom,"otherUserName"=>$otherUserFullName));
		}

		public function createSidebarMessage(){
			$field = $id = $sidebarData = $table = $passer = $messageLimited = $passerData = $seeker = $seekerData = $builder = $dom = $rawDate = $convertedDate = $sidebarDate = $messageStatus = null;
			$checkAgain = array();
			if(isset($_POST['sidebarData'])){
				$field = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);	
				$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);	
				$sidebarData = $this->model->selectAllFromUserSort(array("*"),$this->messageTable,$field,array($id),"MessageID","DESC");
				if(isset($_SESSION['seekerUser'])){
					foreach ($sidebarData as $data) {
						if(!empty($data['MessageContent'])){
							if(!in_array($data[$this->passerUnique], $checkAgain)){
								array_push($checkAgain,$data[$this->passerUnique]);
								$rawDate = $data['MessageTimeAndDate'];
								$convertedDate = date("Y-m-d",strtotime($rawDate));
								switch ($convertedDate) {
									case strtotime($convertedDate) == strtotime(date("Y-m-d")):
										$sidebarDate = date('g:ia', strtotime($rawDate));
										break;

									case strtotime($convertedDate) <= strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("D",strtotime($convertedDate));
										break;

									case strtotime($convertedDate) > strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("M d",strtotime($convertedDate));
										break;
								}
								$messageLimited = (strlen($this->sanitize($data['MessageContent'])) > 10?substr($data['MessageContent'], 0,10)."...":$data['MessageContent']);
								$passer = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($data['PasserID']));
								foreach ($passer as $passerData) {
									$messageStatus = ($data['MessageStatus'] == 1?"active_chat":"read_chat");
									$builder = 
									'
									<div class="chat_list '.$messageStatus.' cursor" onclick="window.location=\'messages?t='.$this->sanitize($passerData['PasserID']).'\'">
			                          <div class="chat_people">
			                            <div class="chat_img"> 
			                            	<img class="messageSidebarImage" src="'.$this->sanitize($passerData['PasserProfile']).'" alt="Profile Picture"> 
			                            </div>
			                            <div class="chat_ib">
			                              <h5>'.$this->sanitize($passerData['PasserFN'])." ".$this->sanitize($passerData['PasserLN']).'<span class="chat_date">'.$sidebarDate.'</span></h5>
			                              <p>'.$messageLimited.'</p>
			                            </div>
			                          </div>
			                        </div>
									';
									$dom = $dom."".$builder;
								}
							}
						}
					}
					echo $dom;
				}else{
					foreach ($sidebarData as $data) {
						if(!empty($data['MessageContent'])){
							if(!in_array($data[$this->seekerUnique], $checkAgain)){
								array_push($checkAgain,$data[$this->seekerUnique]);
								$rawDate = $data['MessageTimeAndDate'];
								$convertedDate = date("Y-m-d",strtotime($rawDate));
								switch ($convertedDate) {
									case strtotime($convertedDate) == strtotime(date("Y-m-d")):
										$sidebarDate = date('g:ia', strtotime($rawDate));
										break;

									case strtotime($convertedDate) <= strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("D",strtotime($convertedDate));
										break;

									case strtotime($convertedDate) > strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("M d",strtotime($convertedDate));
										break;
								}
								$messageLimited = (strlen($this->sanitize($data['MessageContent'])) > 10?substr($data['MessageContent'], 0,10)."...":$data['MessageContent']);
								$seeker = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($data['SeekerID']));
								foreach ($seeker as $seekerData) {
									$messageStatus = ($data['MessageStatus'] == 1?"active_chat":"read_chat");
									$builder = 
									'
									<div class="chat_list '.$messageStatus.' cursor" onclick="window.location=\'messages?t='.$this->sanitize($seekerData['SeekerID']).'\'">
			                          <div class="chat_people">
			                            <div class="chat_img"> 
			                            	<img class="messageSidebarImage" src="'.$this->sanitize($seekerData['SeekerProfile']).'" alt="Profile Picture"> 
			                            </div>
			                            <div class="chat_ib">
			                              <h5>'.$this->sanitize($seekerData['SeekerFN'])." ".$this->sanitize($seekerData['SeekerLN']).'<span class="chat_date">'.$sidebarDate.'</span></h5>
			                              <p>'.$messageLimited.'</p>
			                            </div>
			                          </div>
			                        </div>
									';
									$dom = $dom."".$builder;
								}
							}
						}
					}
					echo $dom;
				}
			}
		}


		public function searchSidebarMessage(){
			$currentField = $id = $sidebarData = $table = $passer = $messageLimited = $passerData = $seeker = $seekerData = $builder = $dom = $rawDate = $convertedDate = $sidebarDate = $messageStatus = $inputName = $otherTable = $otherUserID = $otherUserName = null;
			$checkAgain = array();
			if(isset($_POST['searchSidebarData'])){
				$inputName = $this->sanitize($_POST['name']);
				$currentField = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);	
				$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$otherTable = (isset($_SESSION['passerUser'])?$this->seekerTable:$this->passerTable);
				$otherUserID = (isset($_SESSION['passerUser'])?$this->seekerUnique:$this->passerUnique);
				$otherUserName = (isset($_SESSION['passerUser'])?"SeekerFN":"PasserFN");
				$sidebarData = $this->model->selectDataFromOtherDBLike(array("*"),$this->messageTable,array($currentField,$otherUserID),$otherUserID,$otherTable,array($otherUserName),array($id,"%".$inputName."%"),"MessageID","DESC");
				if(isset($_SESSION['seekerUser'])){
					foreach ($sidebarData as $data) {
						if(!empty($data['MessageContent'])){
							if(!in_array($data[$this->passerUnique], $checkAgain)){
								array_push($checkAgain,$data[$this->passerUnique]);
								$rawDate = $data['MessageTimeAndDate'];
								$convertedDate = date("Y-m-d",strtotime($rawDate));
								switch ($convertedDate) {
									case strtotime($convertedDate) == strtotime(date("Y-m-d")):
										$sidebarDate = date('g:ia', strtotime($rawDate));
										break;

									case strtotime($convertedDate) <= strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("D",strtotime($convertedDate));
										break;

									case strtotime($convertedDate) > strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("M d",strtotime($convertedDate));
										break;
								}
								$messageLimited = (strlen($this->sanitize($data['MessageContent'])) > 10?substr($data['MessageContent'], 0,10)."...":$data['MessageContent']);
								$passer = $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($data['PasserID']));
								foreach ($passer as $passerData) {
									$messageStatus = ($data['MessageStatus'] == 1?"active_chat":"read_chat");
									$builder = 
									'
									<div class="chat_list '.$messageStatus.' cursor" onclick="window.location=\'messages?t='.$this->sanitize($passerData['PasserID']).'\'">
			                          <div class="chat_people">
			                            <div class="chat_img"> 
			                            	<img class="messageSidebarImage" src="'.$this->sanitize($passerData['PasserProfile']).'" alt="Profile Picture"> 
			                            </div>
			                            <div class="chat_ib">
			                              <h5>'.$this->sanitize($passerData['PasserFN'])." ".$this->sanitize($passerData['PasserLN']).'<span class="chat_date">'.$sidebarDate.'</span></h5>
			                              <p>'.$messageLimited.'</p>
			                            </div>
			                          </div>
			                        </div>
									';
									$dom = $dom."".$builder;
								}
							}
						}
					}
					echo $dom;
				}else{
					foreach ($sidebarData as $data) {
						if(!empty($data['MessageContent'])){
							if(!in_array($data[$this->seekerUnique], $checkAgain)){
								array_push($checkAgain,$data[$this->seekerUnique]);
								$rawDate = $data['MessageTimeAndDate'];
								$convertedDate = date("Y-m-d",strtotime($rawDate));
								switch ($convertedDate) {
									case strtotime($convertedDate) == strtotime(date("Y-m-d")):
										$sidebarDate = date('g:ia', strtotime($rawDate));
										break;

									case strtotime($convertedDate) <= strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("D",strtotime($convertedDate));
										break;

									case strtotime($convertedDate) > strtotime(date("Y-m-d",strtotime("+7 day"))):
										$sidebarDate = date("M d",strtotime($convertedDate));
										break;
								}
								$messageLimited = (strlen($this->sanitize($data['MessageContent'])) > 10?substr($data['MessageContent'], 0,10)."...":$data['MessageContent']);
								$seeker = $this->model->selectAllFromUser($this->seekerTable,$this->seekerUnique,array($data['SeekerID']));
								foreach ($seeker as $seekerData) {
									$messageStatus = ($data['MessageStatus'] == 1?"active_chat":"read_chat");
									$builder = 
									'
									<div class="chat_list '.$messageStatus.' cursor" onclick="window.location=\'messages?t='.$this->sanitize($seekerData['SeekerID']).'\'">
			                          <div class="chat_people">
			                            <div class="chat_img"> 
			                            	<img class="messageSidebarImage" src="'.$this->sanitize($seekerData['SeekerProfile']).'" alt="Profile Picture"> 
			                            </div>
			                            <div class="chat_ib">
			                              <h5>'.$this->sanitize($seekerData['SeekerFN'])." ".$this->sanitize($seekerData['SeekerLN']).'<span class="chat_date">'.$sidebarDate.'</span></h5>
			                              <p>'.$messageLimited.'</p>
			                            </div>
			                          </div>
			                        </div>
									';
									$dom = $dom."".$builder;
								}
							}
						}
					}
					echo $dom;
				}
			}
		}

		public function getNotificationMessage(){
			if(isset($_POST['notificationGet'])){
				$builder = null;
				$dom = null;
				$user = $otherUser = null;
				$field = (!empty($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (!empty($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$otherUser = (!empty($_SESSION['passerUser'])?"Seeker":"Passer");
				$notifCount = $this->model->selectAllDynamic("message",array("count(*)"),array($field,"MessageStatus","MessageSender"),array($id,1,$otherUser));
				echo json_encode(array("count"=>$notifCount[0]["count(*)"]));
			}

		}

		public function getNotification(){
			if(isset($_POST['notificationGet'])){
				$builder = null;
				$dom = null;
				$user = null;
				$field = (!empty($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (!empty($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$notifCount = $this->model->checkAuthenticity($this->notifDB,$field,"notificationStatus",array($id,1));
				$notificationData = $this->model->selectAllFromUserSort(array("*"),$this->notifDB,$field,array($id),"notificationID","DESC");
				foreach ($notificationData as $data) {
					$link = null;
					$message = null;
					switch ($data['notificationType']) {
						case 'updateUserStatus':
							$link = "dashboard";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "verified or activated your acount";
									break;
								case '3':
									$message = "declined your request to be verified.";
									break;
								case '4':
									$message = "You have disabled your account.";
									break;
								case '5':
									$message = "disabled your account.";
									break;
							}
							break;

						case 'message':
							$link = "message";
							break;

						case 'subscription':
							$link = "search";
							switch ($data['notificationMessage']) {
								case '0':
									$message = "You may want to subscribe first!";
									$link = "subscription";
									break;
								case '1':
									$message = "You have successfully Subscribed.";
									break;
								case '2':
									$message = "Your subscription has ended.";
									break;
							}
							break;
						case 'JobOffer':
							$link = "joboffers";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have a job offer, Mate!";
									break;
								case '2':
									$message = "A recent job offer you received was updated mate! Check it out!";
									break;
								case '3':
									$message = "You have been hired!";
									break;
								case '4':
									$message = "A seeker has requested to cancel a job.";
									break;
								case '5':
									$message = "A job youv'e been hired has been marked done.";
									break;
							}
							break;
						case 'jobOfferSeeker':
							$link = "joboffered";
							switch ($data['notificationMessage']) {
								case '3':
									$message = "Your job offer has been accepted! Check it out mate!";
									break;
								case '4':
									$message = "Unfortunately, your job offer has been rejected.";
									break;
								case '3':
									$message = "A passer has requested to cancel a job.";
									break;
							}
							break;
						case 'cancellationSeeker':
							$link = "joboffers";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have new job cancellation Request.";
									break;
								case '2':
									$message = "Your job cancellation has been Approved.";
									break;
								case '3':
									$message = "Your job cancellation has been declined.";
									break;
							}
							break;

						case 'cancellationPasser':
							$link = "joboffered";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have new job cancellation Request.";
									break;
								case '2':
									$message = "Your job cancellation has been Approved.";
									break;
								case '3':
									$message = "Your job cancellation has been declined.";
									break;
							}
							break;

						case 'dispute':
							$link = "joboffered";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have new Disputed job.";
									break;
							}
							break;

						case 'disputeSeeker':
							$link = "joboffers";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have new Disputed job.";
									break;
							}
							break;
					}

					$builder = '
					<div class="cursor content" onclick="window.location=\''.$link.'\'">
				  		<div class="notification-item">
					       	<div class="row mb-2" >
						      	<div class="col-md-2 col-sm-2 col-xs-2">
							       	<div class="notify-img ml-2">
							       		<img src="../../public/etc/images/system/logo-2.png" alt="image" width="40px">
							       	</div>
						    	</div>
								<div class="col-md-9 col-sm-9 col-xs-9 mt-2">
									<a class="font-weight-bold text-dark">PassersMate </a><small>'. $message.'</small> 
					      		 </div>
						    </div>
						</div>
				  	</div>
					';
					$dom = $dom ."". $builder; 
				}
				echo json_encode(array("count"=>$notifCount,"dom"=>$dom));
			}
		}

		public function readAllNotification(){
			if(isset($_POST['notifChange'])){
				$field = (!empty($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (!empty($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$this->model->updateDB($this->notifDB,array("notificationStatus"),array(0),$field,$id);
			}
		}

		public function readAllNotificationMessage(){
			if(isset($_POST['notifChange'])){
				$field = (!empty($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$id = (!empty($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$this->model->updateDB("message",array("MessageStatus"),array(0),$field,$id);
			}
		}

		public function returnURLGmail(){
			$gmail = null;
			$google = new Google_Client();
			$google->setClientID('90516234623-faht3953u559pufek8kt6ibhu4u4ie3s.apps.googleusercontent.com');
			$google->setClientSecret('zv08B6KoCTLGpTea338hagb1');
			$google->setApplicationName('PassersMate');
			$google->setRedirectUri('http://localhost/passersmate/public/home/getGmailData');
			$google->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
			$loginURL = $google->createAuthUrl();
			return $loginURL;
		}

		public function getGmailData(){
			$google = null;
			$token = null;
			$auth = null;
			$user = null;
			if(isset($_GET['code']) && !empty($_GET['code'])){
				$google = new Google_Client();
				$google->setClientID('90516234623-faht3953u559pufek8kt6ibhu4u4ie3s.apps.googleusercontent.com');
				$google->setClientSecret('zv08B6KoCTLGpTea338hagb1');
				$google->setApplicationName('PassersMate');
				$google->setRedirectUri('http://localhost/passersmate/public/home/getGmailData');
				$token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
				$auth = new Google_Service_Oauth2($google);
				$user = $auth->userinfo_v2_me->get();
				$gmailIdCheck = $this->model->checkExistSingle($this->seekerTable,$this->seekerGmail,array($this->sanitize($user['id'])));
				$seekerGmailId = $this->sanitize($user['id']);

				if($gmailIdCheck <= 0){
				$seekerFName = $this->sanitize($user['givenName']);
				$seekerLName = $this->sanitize($user['familyName']);
				$seekerEmail = $this->sanitize($user['email']);
				$seekerGender = $this->upperFirstOnlySpecialChars($this->sanitize($user['gender']));
				$seekerLink = $this->sanitize($user['link']);
				$seekerPic = $this->sanitize($user['picture']);
				$return = $this->model->insertDB($this->seekerTable,$this->seekerGmailAdd,array($seekerGmailId,$seekerFName,$seekerLName,$seekerEmail,$seekerGender,$seekerLink,$seekerPic));
					if($return){
						$_SESSION['seekerUser'] = $return;
						$fb = null;
						$accessToken = null;
						$oauth = null;
						$user = null;
						$res = null;
						$return = null;
					}
				}else{
					$return = $this->model->selectSingleUser($this->seekerTable,$this->seekerUnique,array($seekerGmailId),$this->seekerGmail);
					if($return){
						$_SESSION['seekerUser'] = $return;
						$fb = null;
						$accessToken = null;
						$oauth = null;
						$user = null;
						$res = null;
						$return = null;
					}
				}
				$this->toOtherPage("../seeker/dashboard");
			}
		}

		public function returnURLFacebook(){
			$fb = null;
			$fb = new Facebook\Facebook([
				'app_id' => '170160493603540',
				'app_secret' => 'e0f71895d4a60525054f55567ccd486f',
				'default_graph_version' => 'v2.12'
			]);
			$helper = $fb->getRedirectLoginHelper();
			$redirectURL = "http://localhost/passersmate/public/home/getFacebookData";
			$permission = array("email","user_birthday");
			$loginURL = $helper->getLoginUrl($redirectURL,$permission);
			return $loginURL;
		}

		public function getFacebookData(){
			$fb = new Facebook\Facebook([
				'app_id' => '170160493603540',
				'app_secret' => 'e0f71895d4a60525054f55567ccd486f',
				'default_graph_version' => 'v2.12'
			]);

			$helper = $fb->getRedirectLoginHelper();
			try {
				$accessToken = $helper->getAccessToken();
			} catch (\Facebook\Exception\FacebookResponseException $e) {
				echo 'response sdk: ' .$e->getMessage();
			} catch(\Facebook\Exception\FacebookSDKException $e){
				echo 'SDK: '. $e->getMessage();
			}

			if(!$accessToken){
				header("location: ../seeker/dashboard");
			}

			$oauth = $fb->getOAuth2Client();
			if(!$accessToken->isLongLived())
				$accessToken = $oauth->getLongLivedAccessToken($accessToken);

			$res = $fb->get("/me?fields=id, first_name, middle_name, last_name, email, picture.type(large), cover, gender, address, link, location, birthday, age_range",$accessToken);
			$user = $res->getGraphNode()->asArray();
			$facebookIdCheck = $this->model->checkExistSingle($this->seekerTable,$this->seekerFacebook,array($this->sanitize($user['id'])));
			$seekerFacebookId = $this->sanitize($user['id']);
			if($facebookIdCheck <= 0){
				$seekerFName = $this->sanitize($user['first_name']);
				$seekerLName = $this->sanitize($user['last_name']);
				$seekerEmail = $this->sanitize($user['email']);
				$seekerGender = $this->upperFirstOnlySpecialChars($this->sanitize($user['gender']));
				$seekerLink = $this->sanitize($user['link']);
				$seekerPic = $this->sanitize($user['picture']['url']);
				$return = $this->model->insertDB($this->seekerTable,$this->seekerFacebookAdd,array($seekerFacebookId,$seekerFName,$seekerLName,$seekerEmail,$seekerGender,$seekerLink,$seekerPic));
				if($return){
					$_SESSION['seekerUser'] = $return;
					$fb = null;
					$accessToken = null;
					$oauth = null;
					$user = null;
					$res = null;
					$return = null;
				}
			}else{
				$return = $this->model->selectSingleUser($this->seekerTable,$this->seekerUnique,array($seekerFacebookId),$this->seekerFacebook);
				if($return){
					$_SESSION['seekerUser'] = $return;
					$fb = null;
					$accessToken = null;
					$oauth = null;
					$user = null;
					$res = null;
					$return = null;
				}
			}
			$this->toOtherPage("../seeker/dashboard");
		}

		public function showError($div,$message){
			echo '
			<script>
				$("'.$div.'").show();
				$("'.$div.'").html("'.$message.'");
			</script>
			';
		}

		public function toOtherPage($where){
			echo '
			<script>
				window.location="'.$where.'"
			</script>
			';
		}

		public function __construct(){
		}

		public function logout(){
			if(isset($_SESSION['passerUser'])){
				unset($_SESSION['passerUser']);
			}
			elseif(isset($_SESSION['seekerUser'])){
				unset($_SESSION['seekerUser']);
			}
			header("location:../home/login");
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
					$fname = html_entity_decode(ucwords(mb_strtolower($fname,"UTF-8")));
					$lname = html_entity_decode(ucwords(mb_strtolower($lname,"UTF-8")));
					$mname = substr($name, $mnameIndex,1);
					$num = trim($dom->find('table tr td',1)->plaintext);
					$ncert = html_entity_decode(htmlentities(trim($dom->find('table tr td',2)->plaintext)));

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

		public function checkDateValidity(){
			if(isset($_GET['validityCheck'])){
				$month = $this->sanitize($_GET['month']);
				$date = $this->sanitize($_GET['date']);
				echo strtotime($month.' month ago');
				var_dump(strtotime($date) < strtotime($month.' month ago'));
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

		public function randomize(){
			$random = time() . rand(1,10) . strtotime("now") . rand(1,6);
			return $random;
		}

		public function imageUpload($destination,$file,$id){
			$target_dir = "../public/etc/images/".$destination."/";
			$target_file = $target_dir . basename($_FILES[$file]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$randomFileName = $this->randomize() . $id . "." . $imageFileType;
			$fileDir = $target_dir . $randomFileName;
		    if (move_uploaded_file($_FILES[$file]["tmp_name"], $fileDir)) {
		        return "../../public/etc/images/".$destination."/" . $randomFileName;
		    } else {
		        return $_FILES[$file]["error"];
		    }
		}


		public function validatePasser(){
			if(isset($_POST['passerValidate'])){
				$frontID = $this->imageUpload("userVerify/passer","frontID",$this->passerSession);
				$backID = $this->imageUpload("userVerify/passer","backID",$this->passerSession);
				$selfie = $this->imageUpload("userVerify/passer","selfieID",$this->passerSession);
				$coc = $this->imageUpload("userVerify/passer","competencyCertificate",$this->passerSession);
				$idNumber = $this->sanitize($_POST['idNumber']);
				$idType = $this->sanitize($_POST['acceptedId']);
				$expDate = $this->sanitize(date("Y-m-d",strtotime($_POST['expiryDate'])));

				try {
					$return = $this->model->insertDB("passervalidate",$this->passerValidate,array($this->passerSession,$frontID,$backID,$selfie,$coc,$idType,$idNumber,$expDate));
					if($return){
						$updateThis = $this->model->updateDB("$this->passerTable",array("PasserStatus"),array(2),$this->passerUnique,$this->passerSession);
						if($updateThis){
							echo json_encode(array("error"=>"none"));
						}
					}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}

		public function validateSeeker(){
			if(isset($_POST['seekerValidate'])){
				$frontID = $this->imageUpload("userVerify/seeker","frontID",$this->seekerSession);
				$backID = $this->imageUpload("userVerify/seeker","backID",$this->seekerSession);
				$selfie = $this->imageUpload("userVerify/seeker","selfieID",$this->seekerSession);
				$idNumber = $this->sanitize($_POST['idNumber']);
				$idType = $this->sanitize($_POST['acceptedId']);
				$expDate = $this->sanitize(date("Y-m-d",strtotime($_POST['expiryDate'])));

				try {
					$return = $this->model->insertDB("seekervalidate",$this->seekerValidate,array($this->seekerSession,$frontID,$backID,$selfie,$idType,$idNumber,$expDate));
					if($return){
						$updateThis = $this->model->updateDB("$this->seekerTable",array("seekerStatus"),array(2),$this->seekerUnique,$this->seekerSession);
						if($updateThis){
							echo json_encode(array("error"=>"none"));
						}
					}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}


		public function registerPasser(){
			if(isset($_POST['registerPasser'])){
					$cocNumber = $this->sanitize($_POST['cocNumber']);
					$passerFirstname = $this->decodeISO($this->sanitize($_POST['passerFirstname']));
					$passerLastname = $this->decodeISO($this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerLastname'])));
					$passerMiddlename = $this->decodeISO($this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerMiddlename'])));
					$cocTitle = $this->decodeISO($this->sanitize($_POST['cocTitle']));
					$passerPassword = $this->sanitize($this->hashPassword($_POST['passerPassword']));
					$email = $this->sanitize($_POST['email']);
					$typeofCertificatePasser = $this->sanitize($_POST['typeofCertificatePasser']);
					$passerTesdaLink = $this->sanitize($_POST['passerLink']);
					$expdateField = $this->sanitize(date("Y-m-d",strtotime($_POST['expdateField'])));
					try {
						$return = $this->model->insertDB('passer',$this->passerReg,array($cocNumber,$passerFirstname,$passerLastname,$passerMiddlename,$passerPassword,$email,$cocTitle,$typeofCertificatePasser,$passerTesdaLink,$expdateField));
						$_SESSION['passerUser'] = $return;
						echo json_encode(array("error"=>"none"));
					} catch (Exception $e) {
						echo json_encode(array("error"=>$e->getMessage()));
					}
			}
		}

		public function updatePasserPersonalDetails(){
			$currentYear = date("Y");
			$age = null;
			if(isset($_POST['passerUpdateDataNoImage'])){
				try {
				$passerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerAddress']));
				$passerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerStreet']));
				$passerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerCity']));
				$passerGender = $this->sanitize($_POST['passerGender']);
				$passerCPNo = $this->sanitize($_POST['PasserCPNo']);
				$passerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['passerBirthdate'])));
				$age = $currentYear - date("Y",strtotime($_POST['passerBirthdate']));
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetails,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate,$age),$this->passerUnique,$this->passerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}elseif(isset($_POST['passerUpdateDataWithImage'])){
				try {
				$imageFile = $this->model->selectSingleUser($this->passerTable,"PasserProfile",array($this->passerSession),$this->passerUnique);
				$this->unlinkFileFromDB($imageFile);
				$passerProfile = $this->imageUpload("user/passer","profileUploadPasser",$this->passerSession);
				$passerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerAddress']));
				$passerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerStreet']));
				$passerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerCity']));
				$passerGender = $this->sanitize($_POST['passerGender']);
				$passerCPNo = $this->sanitize($_POST['PasserCPNo']);
				$passerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['passerBirthdate'])));
				$age = $currentYear - date("Y",strtotime($_POST['passerBirthdate']));
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetailsWithPhoto,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate,$passerProfile,$age),$this->passerUnique,$this->passerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					print_r($e->getMessage());
				}
			}
		}

		public function registerSeeker(){
			if(isset($_POST['registerSeeker'])){
				$yearToday = date("Y");
				$SeekerFN = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['SeekerFN']));
				$SeekerLN = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['SeekerLN']));
				$SeekerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['SeekerBirthdate'])));
				$SeekerAge = $yearToday - (date("Y",strtotime($SeekerBirthdate)));
				$SeekerGender = $this->sanitize($_POST['SeekerGender']);
				$SeekerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['SeekerStreet']));
				$SeekerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['SeekerCity']));
				$SeekerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['SeekerAddress']));
				$SeekerCPNo = $this->sanitize($_POST['SeekerCPNo']);
				$SeekerCompany = $this->sanitize($_POST['seekerCompany']);
				$SeekerEmail = $this->sanitize($_POST['SeekerEmail']);
				$SeekerUname = $this->sanitize($_POST['SeekerUname']);
				$SeekerPass = $this->hashPassword($this->sanitize($_POST['SeekerPass']));
				$insert = $this->model->insertDB($this->seekerTable,$this->seekerDB,array($SeekerFN,$SeekerLN,$SeekerBirthdate,$SeekerAge,
					$SeekerGender,$SeekerStreet,$SeekerCity,$SeekerAddress,$SeekerCPNo,$SeekerCompany,$SeekerEmail,$SeekerUname,$SeekerPass));
				if($insert){
					$_SESSION['seekerUser'] = $insert;
					echo json_encode(array("error"=>"none"));
				}else{
					echo $insert;
				}
			}
		}

		public function updateSeekerPersonalDetails(){
			if(isset($_POST['seekerUpdateDataNoImage'])){
				try {
				$seekerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerAddress']));
				$seekerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerStreet']));
				$seekerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerCity']));
				$seekerGender = $this->sanitize($_POST['seekerGender']);
				$seekerCPNo = $this->sanitize($_POST['SeekerCPNo']);
				$seekerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['seekerBirthdate'])));
				$age = date("Y") - (date("Y",strtotime($seekerBirthdate)));
				$res = $this->model->updateDB($this->seekerTable,$this->seekDashboardPersonalDetails,array($seekerAddress,$seekerStreet,$seekerCity,$seekerGender,$seekerCPNo,$seekerBirthdate,$age),$this->seekerUnique,$this->seekerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}elseif(isset($_POST['seekerUpdateDataWithImage'])){
				try {
				$imageFile = $this->model->selectSingleUser($this->seekerTable,"SeekerProfile",array($this->seekerSession),$this->seekerUnique);
				$this->unlinkFileFromDB($imageFile);
				$seekerProfile = $this->imageUpload("user/seeker","profileUploadSeeker",$this->seekerSession);
				$seekerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerAddress']));
				$seekerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerStreet']));
				$seekerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['seekerCity']));
				$seekerGender = $this->sanitize($_POST['seekerGender']);
				$seekerCPNo = $this->sanitize($_POST['SeekerCPNo']);
				$seekerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['seekerBirthdate'])));
				$age = date("Y") - (date("Y",strtotime($seekerBirthdate)));
				$res = $this->model->updateDB($this->seekerTable,$this->seekDashboardPersonalDetailsWithPhoto,array($seekerAddress,$seekerStreet,$seekerCity,$seekerGender,$seekerCPNo,$seekerBirthdate,$seekerProfile,$age),$this->seekerUnique,$this->seekerSession);
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					print_r($e->getMessage());
				}
			}
		}



		public function addJobExperience(){
			if(isset($_POST['passerJobExperienceData'])){
				try {
				$title = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['jTitle']));
				$company = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['company']));
				$companyNumber = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['companyNumber']));
				$startDate = $this->sanitize(date("Y-m-d",strtotime($_POST['startDate'])));
				$endDate = $this->sanitize(date("Y-m-d",strtotime($_POST['endDate'])));
				$desc = !empty($_POST["passerWorkDesc"])?$this->sanitize($_POST["passerWorkDesc"]): "";
				unset($this->passerWorkHistory[0]);
				unset($this->passerWorkHistory[8]);
				$res =  $this->model->insertDB("passerworkhistory",$this->passerWorkHistory,array($this->passerSession,$title,$company,$companyNumber,$desc,$startDate,$endDate));
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}else{
				if(isset($_POST['passerJobExperienceDataUpdate'])){
					$idWorkHistory = $this->sanitize($_POST['workExperienceID']);
					if($this->checkAuthenticity("passerworkhistory","PasserWorkHistoryID","PasserID",array($idWorkHistory,$this->passerSession))){
						try {
							$title = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['jTitle']));
							$company = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['company']));
							$startDate = $this->sanitize(date("Y-m-d",strtotime($_POST['startDate'])));
							$endDate = $this->sanitize(date("Y-m-d",strtotime($_POST['endDate'])));
							$desc = !empty($_POST["passerWorkDesc"])?$this->sanitize($_POST["passerWorkDesc"]): "";
							unset($this->passerWorkHistory[0]);
							unset($this->passerWorkHistory[7]);
							$res = $this->model->updateDB("passerworkhistory",$this->passerWorkHistory,array($this->passerSession,$title,$company,$desc,$startDate,$endDate),"PasserWorkHistoryID",$idWorkHistory);
							echo json_encode(array("error"=>"none"));
						} catch (Exception $e) {
							echo $e->getMessage();
						}
					}
				}
			}
		}

		// public function addSeekerCompany(){
		// 	if(isset($_POST['seekerCompany'])){
		// 		try {
		// 		$companyName = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['companyName']));
		// 		$companyNumber = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['companyNumber']));
		// 		$res = !empty($_POST["companyDesc"])? $this->model->insertDB("seekerCompany",$this->seekerCompany,array($this->seekerSession,
		// 		$companyName,$companyNumber,$this->sanitize($_POST["companyDesc"]))): $this->model->insertDB("seekerCompany",$this->seekerCompany,array($this->seekerSession,$companyName,$companyNumber,""));
		// 		echo json_encode(array("error"=>"none"));
		// 		} catch (Exception $e) {
		// 			echo $e->getMessage();
		// 		}
		// 	}
		// }

		public function addEducation(){
			if(isset($_POST['passerEducation'])){
				try {
				$attainment = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['educationalLevel']));
				$school = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['school']));
				$res = !empty($_POST["passerDesc"])? $this->model->insertDB("passereducation",$this->passerEducation,array($this->passerSession,$attainment,$school,$this->sanitize($_POST["passerDesc"]))): $this->model->insertDB("passereducation",$this->passerEducation,array($this->passerSession,$attainment,$school,""));
				echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}
		
		public function addJobForm(){
			if(isset($_POST['createJobForm'])){
				$seekerID = $_SESSION['seekerUser'];
				$workingAddress = $this->sanitize($_POST['workAddress']);
				$workStart = $this->sanitize(date("Y-m-d",strtotime($_POST['workStart'])));
				$workEnd = $this->sanitize(date("Y-m-d",strtotime($_POST['workEnd'])));
				$salary = $this->sanitize($_POST['salary']);
				$paymentMethod = $this->sanitize($_POST['paymentMethod']);
				$accomodationType = $this->sanitize($_POST['accomodationType']);
				try {
					$return = $this->model->insertDB("offerjobform",$this->offerJobTable,array($seekerID,$workingAddress,$workStart,$workEnd,$salary,$paymentMethod,$accomodationType));
						if($return){
							echo json_encode(array("error"=>"none"));
						}else{
							echo json_encode(array("error"=>$return));
						}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}

		public function addAgreement(){
			$checkExistingWork = $passerID = $jobofferFormID = $jobofferID = $passerDetails = $seekerDetails = $jobofferformData = $insert = $insertAgreement = $dataSend = $jobofferformDataAll = $joboffered = $changeJobOfferStatus = null;
			if(isset($_POST['passerID']) && isset($_POST['jobofferFormID']) && isset($_POST['jobofferID'])){
				$passerID = $this->sanitize($_POST['passerID']);
				$jobofferFormID = $this->sanitize($_POST['jobofferFormID']);
				$jobofferID = $this->sanitize($_POST['jobofferID']);
				$checkExistingWork = $this->model->checkAuthenticity("agreement",$this->passerUnique,"AgreementStatus",array($passerID,1));
				if($checkExistingWork <= 0){
					$passerDetails = $this->getDetailsPasser($passerID);
					if($passerDetails[0]['PasserStatus'] == 1 ){
						$seekerDetails = $this->getDetailsSeeker($this->seekerSession);
						if($seekerDetails[0]['SeekerStatus'] == 1){
							$jobOfferData = $this->model->selectAllFromUser("offerjobform","OfferJobFormID",array($jobofferFormID));
							$joboffered = $this->model->selectAllFromUser("offerjob","OfferJobID",array($jobofferID));
							extract($joboffered[0]);
							extract($jobOfferData[0]);
							$jobofferformDataAll = array($OfferJobID,$Notes,$WorkingAddress,$StartDate,$EndDate,$Salary,$PaymentMethod,$AccomodationType);
							$insert = $this->model->insertDB("offerjobformused",$this->offerJobTableUsed,$jobofferformDataAll);
							if($insert){
								$insertAgreement = $this->model->insertDB($this->agreementTable,$this->agreementDB,array($this->seekerSession,$passerID,$insert));
								$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,5,"Seeker",$OfferJobDateTime));
								if($insertAgreement){
									$changeJobOfferStatus = $this->model->updateDBDynamic($this->offerJobAddTable,array("OfferJobStatus"),array(5,$jobofferID),array("OfferJobID"));
									$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$passerID,"message"=>3));
									echo json_encode(array("error"=>"none"));
								}
							}
						}
						else{
							echo json_encode(array(array("error"=>"notVerifiedSeeker")));
						}
					}
					else{
						echo json_encode(array(array("error"=>"notVerifiedPasser")));
					}
				}
				else{
					echo json_encode(array("error"=>"hasExistingWork"));
				}
			}
		}

		public function editJobFormDefault(){
			if(isset($_POST['createJobForm'])){
				$seekerID = $_SESSION['seekerUser'];
				$workingAddress = $this->sanitize($_POST['workAddress']);
				$workStart = $this->sanitize(date("Y-m-d",strtotime($_POST['workStart'])));
				$workEnd = $this->sanitize(date("Y-m-d",strtotime($_POST['workEnd'])));
				$salary = $this->sanitize($_POST['salary']);
				$paymentMethod = $this->sanitize($_POST['paymentMethod']);
				$accomodationType = $this->sanitize($_POST['accomodationType']);
				try {
					$checkDefault = $this->model->checkAuthenticity("offerjobform",$this->seekerUnique,"offerjobformDefault",array($_SESSION['seekerUser'],1));
					if($checkDefault >=1){
						unset($this->offerJobTableDefault[0]);
						$jobFormID = $this->model->selectSingleUser("offerjobform","OfferJobFormID",array(1),"offerjobformDefault");
						$return = $this->model->updateDBDynamic("offerjobform",$this->offerJobTableDefault,array($workingAddress,$workStart,$workEnd,$salary,$paymentMethod,$accomodationType,1,1,1,$seekerID),array("offerjobformDefault",$this->seekerUnique));

						if($return){
							echo json_encode(array("error"=>"none"));
						}else{
							echo json_encode(array("error"=>$return));
						}
					}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
		}

		public function editJobForm(){
			$checkEditable = null;
			if(isset($_POST['updateJobForm'])){
				$workingAddress = $this->sanitize($_POST['workAddress']);
				$jobFormID = $this->sanitize($_POST['jobFormID']);
				$workStart = $this->sanitize(date("Y-m-d",strtotime($_POST['workStart'])));
				$workEnd = $this->sanitize(date("Y-m-d",strtotime($_POST['workEnd'])));
				$salary = $this->sanitize($_POST['salary']);
				$paymentMethod = $this->sanitize($_POST['paymentMethod']);
				$accomodationType = $this->sanitize($_POST['accomodationType']);
				$checkEditable = $this->model->selectAllFromUser("offerjobform","OfferJobFormID",array($jobFormID));
				if($checkEditable[0]['uneditable']  != 1){
					try {
						unset($this->offerJobTable[0]);
						$return = $this->model->updateDB("offerjobform",$this->offerJobTable,array($workingAddress,$workStart,$workEnd,$salary,$paymentMethod,$accomodationType),"OfferJobFormID",$jobFormID);
							if($return){
								echo json_encode(array("error"=>"none"));
							}else{
								echo json_encode(array("error"=>$return));
							}
					} catch (Exception $e) {
						echo $e->getMessage();
					}
				}else{
					echo json_encode(array("error"=>"uneditable"));
				}
			}
		}

		public function editNotifyJobForm(){
			$jobFormID = $check = $passer = null;
			if(isset($_POST['editNotifyJobForm'])){
				$jobFormID = $this->sanitize($_POST['jobFormID']);
				$passer = $this->sanitize($_POST['passer']);
				$update = $this->model->updateDB($this->offerJobAddTable,array("OfferJobStatus"),array(2),"OfferJobID",$jobFormID);
				if($update){
					$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$passer,"message"=>2));
					echo json_encode(array("error"=>"none"));
				}
				else{
					echo json_encode(array("error"=>$update));
				}
			}
		}

		public function setDefaultJobForm(){
			if(isset($_POST['setDefaultJobForm'])){
				$id = $this->sanitize($_POST['id']);
				$checkAuthenticity = $this->checkAuthenticity("offerjobform","SeekerID","OfferJobFormID",array($_SESSION['seekerUser'],$id));
				if($checkAuthenticity){
					$checkAuthenticity = null;
					$reset = $this->model->updateDB("offerjobform",array("offerjobformDefault"),array(0),"offerjobformDefault","1");
					if($reset){
						$reset = null;
						$default = $this->model->updateDB("offerjobform",array("offerjobformDefault"),array(1),"OfferJobFormID",$id);
						if($default){
							echo json_encode(array("error"=>"none"));
						}else
						echo $default;
					}
				}
				else{
					echo json_encode(array("error"=>"wrongUser"));
				}
			}
		}

		public function deleteJobForm(){
			$details = null;
			if(isset($_POST['deleteJobForm'])){
				$id = $this->sanitize($_POST['id']);
				$checkAuthenticity = $this->checkAuthenticity("offerjobform","SeekerID","OfferJobFormID",array($_SESSION['seekerUser'],$id));
				if($checkAuthenticity){
					$details = $this->model->selectAllDynamic($this->offerJobDB,array("uneditable"),array("OfferJobFormID",$this->seekerUnique),array($id,$_SESSION['seekerUser']));
					if($details[0]['uneditable'] <= 0){
						$checkAuthenticity = null;
						$delete = $this->model->updateDB("offerjobform",array("OfferJobFormStatus"),array(0),"OfferJobFormID",$id);
						if($delete){
							echo json_encode(array("error"=>"none"));
						}else
						echo $delete;
					}
					else{
						echo json_encode(array("error"=>"undeletable"));
					}	
				}
				else{
					echo json_encode(array("error"=>"wrongUser"));
				}
			}
		}

		public function paginationScriptOwnQuery(){
			if(isset($_POST['getData'])){
				$result = $totalPage = $totalPages = $offset = $page = null;
				$field = $_POST['field'];
				$data = $_POST['data'];
				$table = $_POST['table'];
				$limit = $_POST['limit'];
				$page = $_POST['page'];
				$select = (isset($_POST['select'])?$_POST['select']:array("*"));
				$result = $this->model->selectAllDynamicLike($table,$select,$field,$data);
				$totalPage = count($result);
				$totalPages = ceil($totalPage/$limit);
				$offset = ($page-1) * $limit;
				$first = ($page <= 1)?"disabled":"";
				$prevLI = ($page <= 1)?"disabled":"";
				$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1);

				$nextLI = ($page >= $totalPages)?"disabled":"";
				$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1);
				$lastLI = ($page >= $totalPages)?"disabled":"";
				$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages;

				$pagination = '
					<nav>
					  <ul class="pagination">
					    <li class="page-item '.$first.'"><a class="page-link" name="firstPage" href="?page=1">First</a></li>
					    <li class="page-item '.$prevLI.'"><a class="page-link" name="prevPage" href="'.$prevLink.'">Prev</a></li>
					    <li class="page-item '.$nextLI.'"><a class="page-link" name="nextPage" href="'.$nextLink.'">Next</a></li>
					    <li class="page-item '.$lastLI.'"><a class="page-link" name="lastPage" href="'.$lastLink.'">Last</a></li>
					  </ul>
					</nav>
					';
				if(is_numeric($page)){
					$data = $this->model->selectAllDynamicLikeLimitSearch($table,$data,$offset,$limit);
				}
				echo json_encode(array("pagination"=>$pagination,"data"=>$data,"resultCount"=>$totalPages,"page"=>$page));
			}
		}

		public function paginationScript($table,$field,$field1Ans,$field2,$field2Ans,$page,$offset,$limit,$order,$sort,$add){
			$result = $totalPage = $totalPages = $offset = $add = null;
			$totalPage = $this->model->checkExistSingle($table,$field,array($field1Ans));
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1).$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1).$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages.$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->selectAllLimitSort($table,$field,$field2,$offset,$limit,array($field1Ans,$field2Ans),$order,$sort);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function paginationScriptSingle($table,$field,$field1Ans,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = $offset = null;
			$totalPage = $this->model->checkExistSingle($table,$field,array($field1Ans));
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->selectAllLimitSingle($table,$field,$offset,$limit,$order,$sort,array($field1Ans));
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function paginationAll($table,$field,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = $offset = null;
			$totalPage = $this->model->countAll($table,$field);
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->selectAllLimitSingleAll($table,$offset,$limit,$order,$sort);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function paginationReviews($unique,$data,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = $offset = null;
			$totalPage = $this->model->joinRatingCount($unique,$data);
			$totalPages = ceil($totalPage/$limit);
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->joinRating($unique,$data,$order,$sort,$offset,$limit);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result,"total"=>$totalPage));
		}

		public function paginationAllSubscription($table,$field,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = $offset = null;
			$totalPage = $this->model->countAll($table,$field);
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->joinSubscriptionAdmin($offset,$limit,$order,$sort);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function paginationTransaction($data,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = $offset = null;
			$totalPage = $this->model->countAllTransactionHistory($data);
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->joinTransactionHistory($offset,$limit,$order,$sort,$data);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function dynamicJobOffer($table,$where,$user,$data,$page,$offset,$limit,$order,$sort,$add){
			// $add = (!empty($add)?"&".$add:"");
			$result = $totalPage = $totalPages = null;
			$totalPage = $this->model->countJobOffer($table,$where,$user,$data);
			$totalPages = ceil($totalPage/$limit);
			$totalPage = null;
			$offset = ($page-1) * $limit;
			$first = ($page <= 1)?"disabled":"";
			$prevLI = ($page <= 1)?"disabled":"";
			$prevLink = ($prevLI == "disabled")?"#":"?page=".($page-1)."".$add;

			$nextLI = ($page >= $totalPages)?"disabled":"";
			$nextLink = ($nextLI == "disabled")?"#":"?page=".($page+1)."".$add;
			$lastLI = ($page >= $totalPages)?"disabled":"";
			$lastLink = ($lastLI == "disabled")?"#":"?page=".$totalPages."".$add;

			$pagination = '
				<nav>
				  <ul class="pagination">
				    <li class="page-item '.$first.'"><a class="page-link" href="?page=1'.$add.'">First</a></li>
				    <li class="page-item '.$prevLI.'"><a class="page-link" href="'.$prevLink.'">Prev</a></li>
				    <li class="page-item '.$nextLI.'"><a class="page-link" href="'.$nextLink.'">Next</a></li>
				    <li class="page-item '.$lastLI.'"><a class="page-link" href="'.$lastLink.'">Last</a></li>
				  </ul>
				</nav>
				';
			if(is_numeric($page)){
				$result = $this->model->JobOffer($table,$offset,$where,$user,$data,$limit,$order,$sort);
			}
			return json_encode(array("pagination"=>$pagination,"data"=>$result));
		}

		public function registerAdmin(){
			if(isset($_POST['registerAdmin'])){
				$username = $this->sanitize($_POST['adminUsername']);
				$email = $this->sanitize($_POST['adminEmail']);
				$password = $this->sanitize($this->hashPassword($_POST['adminPassword']));
				try {
					$return = $this->model->insertDB($this->adminTable,$this->adminReg,array($username,$email,$password));
					$_SESSION['adminUser'] = $return;
					echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo json_encode(array("error"=>$e->getMessage()));
				}
			}
		}

		public function createPasserUnverified(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$dom = null;
			$tableCreate = null;
			$passerUnverified = $this->model->selectAllFromUser("passer","PasserStatus",array(2));
			foreach ($passerUnverified as $data) {
				$dom = '
				<tr>
                    <td class=""><a href="" class="passerUnverify" data-toggle="modal" data-target="#Modal3" data-passer='.$data['PasserID'].'><span badge badge-warning">'.$data['PasserID'].'</span></a></td>
                    <td class="">'.$this->sanitize($data['PasserFN']). ' '. $this->sanitize($data['PasserMname']). '. ' . $this->sanitize($data['PasserLN']).'</td>
                    <td class="">'.$this->sanitize($data['PasserEmail']).'</td>
                    <td class="">Passer</td>
                </tr>
				';
				$tableCreate = $tableCreate ."".$dom;
			}
			return $tableCreate;
		}

		public function createSeekerUnverified(){
			if(!$this->checkSession('adminUser')){
				header("location:index");
			}
			$dom = null;
			$tableCreate = null;
			$seekerUnverified = $this->model->selectAllFromUser("seeker","SeekerStatus",array(2));
			foreach ($seekerUnverified as $data) {
				$dom = '
				<tr>
                    <td class=""><a href="" class="seekerUnverify" data-toggle="modal" data-target="#Modal3" data-seeker='.$data['SeekerID'].'><span badge badge-warning">'.$data['SeekerID'].'</span></a></td>
                    <td class="">'.$this->sanitize($data['SeekerFN']). ' ' . $this->sanitize($data['SeekerLN']).'</td>
                    <td class="">'.$this->sanitize($data['SeekerEmail']).'</td>
                    <td class="">Seeker</td>
                </tr>
				';
				$tableCreate = $tableCreate ."".$dom;
			}
			return $tableCreate;
		}

		public function selectConditionPasser(){
			if(isset($_POST['getData'])){
				$data = $this->sanitize($_POST['data']);
				$return = array("passerDetails"=>$this->model->queryDataUnverifiedPasser(array($data)));
				echo json_encode($return);
			}
		}

		public function selectConditionSeeker(){
			if(isset($_POST['getData'])){
				$data = $this->sanitize($_POST['data']);
				$return = array("seekerDetails"=>$this->model->queryDataUnverifiedSeeker(array($data)));
				echo json_encode($return);
			}
		}

		public function updateStatus(){
			if(isset($_POST['userStatus'])){
				$table = $this->sanitize($_POST['table']);
				$field = $this->sanitize($_POST['field']);
				$id = $this->sanitize($_POST['id']);
				$status = $this->sanitize($_POST['status']);
				$userUnique = $this->sanitize($_POST['userUnique']);
				try {
					$this->createNotification("updateUserStatus",array("sendTo"=>$userUnique,"id"=>$id,"message"=>$status));
					$return = $this->model->updateDB($table,array($field),array($status),$userUnique,$id);
					echo json_encode(array("error"=>"none"));
				} catch (Exception $e) {
					echo $e->getMessage();
				}	
			}
		}

		public function editAccountSettings(){
			if(isset($_POST['editAccountSettings'])){
				$checkEmail = $action = $data = $id = $table = $user = $email = $cpno = $userStatus = $data = $cpnoOld = $checkExistEmail = $newPassword = $insert = null;
				$action = $this->sanitize($_POST['action']);
				$data = $_POST['data'];
				$id = (isset($_SESSION['passerUser'])?$_SESSION['passerUser']:$_SESSION['seekerUser']);
				$table = (isset($_SESSION['passerUser'])?$this->passerTable:$this->seekerTable);
				$user = (isset($_SESSION['passerUser'])?$this->passerUnique:$this->seekerUnique);
				$email = (isset($_SESSION['passerUser'])?"PasserEmail":"SeekerEmail");
				$cpno = (isset($_SESSION['passerUser'])?"PasserCPNo":"SeekerCPNo");
				$password = (isset($_SESSION['passerUser'])?"PasserPass":"SeekerPass");
				$userStatus = (isset($_SESSION['passerUser'])?"PasserStatus":"SeekerStatus");
				$dataUser = $this->model->selectAllFromUser($table,$user,array($id));
				extract($dataUser[0]);
				$emailOld = (isset($SeekerEmail)?$SeekerEmail:$PasserEmail);
				$cpnoOld = (isset($SeekerCPNo)?$SeekerCPNo:$PasserCPNo);
				$passwordOld = (isset($SeekerPass)?$SeekerPass:$PasserPass);
				switch ($action) {
					case 'email':
						if($data['email'] == $emailOld){
							echo json_encode(array("error"=>"sameEmail"));
						}elseif($this->model->checkExistSingle($table,$email,array($data['email']))){
							echo json_encode(array("error"=>"emailExist"));
						}else{
							$checkPassword = $this->verifyHash($data['password'],$passwordOld);
								if($checkPassword){
									$update = $this->model->updateDB($table,array($email),array($this->sanitize($data['email'])),$user,$id);
									if($update){
										echo json_encode(array("error"=>"none"));
									}
								}
								else{
									echo json_encode(array("error"=>"incorrectPassword"));
								}
							}
						break;
					case 'phone':
						if($data['cpno'] == $cpnoOld){
							echo json_encode(array("error"=>"samecpNo"));
						}elseif($this->model->checkExistSingle($table,$cpno,array($data['cpno']))){
							echo json_encode(array("error"=>"cpNoExist"));
						}else{
							$checkPassword = $this->verifyHash($data['password'],$passwordOld);
								if($checkPassword){
									$update = $this->model->updateDB($table,array($cpno),array($this->sanitize($data['cpno'])),$user,$id);
									if($update){
										echo json_encode(array("error"=>"none"));
									}
								}
								else{
									echo json_encode(array("error"=>"incorrectPassword"));
								}
							}
						break;
					case 'password':
						if($this->verifyHash($data['newPassword'],$passwordOld)){
							echo json_encode(array("error"=>"samePassword"));
						}elseif(!$this->verifyHash($data['password'],$passwordOld)){
							echo json_encode(array("error"=>"incorrectPassword"));
						}else{
							$newPassword = $this->hashPassword($data['newPassword']);
							$update = $this->model->updateDB($table,array($password),array($this->sanitize($newPassword)),$user,$id);
							if($update){
								echo json_encode(array("error"=>"none"));
							}
						}
						break;
					case 'status':
						if(!$this->verifyHash($data['password'],$passwordOld)){
							echo json_encode(array("error"=>"incorrectPassword"));
						}else{
							$update = $this->model->updateDB($table,array($userStatus),array(4),$user,$id);
							if($update){
								$insert = (isset($_SESSION['passerUser'])?$this->model->insertDB($this->disableDB,$this->disableTable,array($id,NULL,$this->sanitize($data['reason']))):$this->model->insertDB($this->disableDB,$this->disableTable,array(NULL,$id,$this->sanitize($data['reason']))));
								if($insert){
									echo json_encode(array("error"=>"none"));
								}
							}
						}
						break;
					}
				}
			}

			public function jobOfferData(){
				$offerJob = $offerJobChanged = $startDateChanged = $endDateChanged = null;
				if(isset($_POST['offerDetails'])){
					if($this->seekerIsSubscribed()){
						if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
							if($this->getDetailsPasser($_SESSION['agreementPasser'])[0]['PasserStatus'] == 1){
								$offerJob = $this->model->selectTwoCondition(array("*"),"offerjobform","SeekerID","offerjobformDefault",array($_SESSION['seekerUser'],1));
								if(count($offerJob) > 0){
									$startDateChanged = date("F jS, Y", strtotime($offerJob[0]['StartDate']));
									$endDateChanged = date("F jS, Y", strtotime($offerJob[0]['EndDate']));
									$offerJobChanged = array_replace($offerJob[0], array("StartDate"=>$startDateChanged,"EndDate"=>$endDateChanged));
									$offerJobChanged["unchangedStartDate"] = $offerJob[0]["StartDate"];
									$offerJobChanged["unchangedEndDate"] = $offerJob[0]["EndDate"];
									echo json_encode(array("error"=>"none","data"=>$offerJobChanged));
								}
								else{
									echo json_encode(array("error"=>"noJobFormSaved"));
								}
							}
							else{
								echo json_encode(array("error"=>"passerNotVerified"));
							}
						}
						else{
							echo json_encode(array("error"=>"seekerNotVerified"));
						}
					}
					else{
						echo json_encode(array("error"=>"noSubscription"));
					}
				}
			}

			public function updateJobOfferStatus(){
				$newStatus = $jobofferID = $otherUserID = $update = $currentUserID = $otherUserUnique = $otherUserTable = $currentUserUnique = $flag = $checkExist = $jobOfferData = $agreementCheck = $otherUserLiteral = $reaso = $insert = $rating = $feedback = $select = null;
				if(isset($_POST['update'])){
					$newStatus = $this->sanitize($_POST['newStatus']);
					$jobofferID = $this->sanitize($_POST['jobofferID']);
					$otherUserID = $this->sanitize($_POST['otherUser']);
					$currentUserID = (isset($this->seekerSession)?$this->seekerSession:$this->passerSession);
					$currentUserUnique = (isset($this->seekerSession)?$this->seekerUnique:$this->passerUnique);
					$otherUserUnique = (isset($this->seekerSession)?$this->passerUnique:$this->seekerUnique);
					$otherUserTable = (isset($this->seekerSession)?$this->passerTable:$this->seekerTable);
					$otherUserLiteral = (isset($this->seekerSession)?"Seeker":"Passer");
					$checkExist = $this->model->checkAuthenticity("offerjob",$currentUserUnique,"OfferJobID",array($currentUserID,$jobofferID));
					if($checkExist >= 1){
						$jobOfferData = $this->model->selectAllFromUser("offerjob","OfferJobID",array($jobofferID))[0];
						extract($jobOfferData);
						if(isset($_SESSION['passerUser'])){
							if($this->getDetailsPasser($this->passerSession)[0]['PasserStatus'] == 1){
								if($this->getDetailsSeeker($otherUserID)[0]['SeekerStatus'] == 1){
									switch ($newStatus) {
										case '3':
											if($this->checkExistingWorkPasser($this->passerSession) == false){
												if($OfferJobStatus == 1 || $OfferJobStatus == 2){
													$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Passer",$OfferJobDateTime));
													$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
													if($update){
														$this->createNotification("jobOfferSeeker",array("sendTo"=>"SeekerID","id"=>$otherUserID,"message"=>'3'));
														echo json_encode(array("error"=>"none"));
													}
												}
												else{
													echo json_encode(array("error"=>"notAcceptable"));
												}
											}
											else{
												echo json_encode(array("error"=>"hasExistingWork"));
											}
										break;

										case '4':
											if($OfferJobStatus == 1 || $OfferJobStatus == 2){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Passer",$OfferJobDateTime));
												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
													if($update){
														$this->createNotification("jobOfferSeeker",array("sendTo"=>"SeekerID","id"=>$otherUserID,"message"=>'4'));
														echo json_encode(array("error"=>"none"));
													}
											}
											else{
												echo json_encode(array("error"=>"notDeclinable"));
											}
										break;

										case '7':
											if($OfferJobStatus == 6){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Passer",$OfferJobDateTime));
												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
												if($update){
													$agreementCheck = $this->model->joinAgreementCancel($this->passerUnique,array($this->passerSession));
													if(!empty($agreementCheck) && $agreementCheck[0]['OfferJobID'] == $jobofferID){
														$update = $this->model->updateDBDynamic("agreement",array("AgreementStatus"),array(3,$agreementCheck[0]['AgreementID']),array("AgreementID"));
													}
													$this->createNotification("cancellationSeeker",array("sendTo"=>"SeekerID","id"=>$otherUserID,"message"=>"2"));
													$this->model->updateDB($this->cancelTable,array("CancellationStatus"),array(2),"OfferJobID",$jobofferID);
													echo json_encode(array("error"=>"none"));
												}
											}
											else{
												echo json_encode(array("error"=>"notCancellable"));
											}
										break;
										case '8':
											if($OfferJobStatus != 1 || $OfferJobStatus !=2){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Passer",$OfferJobDateTime));
												$reason = $this->sanitize($_POST['reason']);
												$insert = $this->model->insertDB($this->disputeTable,$this->disputeDB,array($this->passerSession,$otherUserID,$jobofferID,$otherUserLiteral,$reason));
												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
												if($update){
													$agreementCheck = $this->model->joinAgreementCancel($this->passerUnique,array($this->passerSession));
													if(!empty($agreementCheck) && $agreementCheck[0]['OfferJobID'] == $jobofferID){
														$update = $this->model->updateDBDynamic("agreement",array("AgreementStatus"),array(4,$agreementCheck[0]['AgreementID']),array("AgreementID"));
													}
													$this->createNotification("dispute",array("sendTo"=>"SeekerID","id"=>$otherUserID,"message"=>"1"));
													echo json_encode(array("error"=>"none"));
												}
											}
											else{
												echo json_encode(array("error"=>"notCancellable"));
											}
										break;

										case '9':
											if($OfferJobStatus == 9){
												switch ($_POST['ratingInsert']) {
													case 'insert':
														$prating = $this->sanitize($_POST['prate']);
														$wqrate = $this->sanitize($_POST['wqrate']);
														$puncrate = $this->sanitize($_POST['puncrate']);
														$feedback = $this->sanitize($_POST['feedback']);
														$this->model->insertDB($this->ratingTable,$this->ratingDB,array($jobofferID,$this->passerSession,$otherUserID,$prating,$wqrate,$puncrate,$feedback,$otherUserLiteral));
													break;
												}
												echo json_encode(array("error"=>"none"));
											}
											else{
												echo json_encode(array("error"=>"endable"));
											}
									}
								}
								else{
									echo json_encode(array("error"=>"seekerNotVerified"));
								}
							}
							else{
								echo json_encode(array("error"=>"passerNotVerified"));
							}
						}
						else{
							if($this->getDetailsPasser($otherUserID)[0]['PasserStatus'] == 1){
								if($this->getDetailsSeeker($this->seekerSession)[0]['SeekerStatus'] == 1){
									switch ($newStatus) {
										case '7':
											if($OfferJobStatus == 6){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Seeker",$OfferJobDateTime));
												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
												if($update){
													$this->createNotification("cancellationPasser",array("sendTo"=>"SeekerID","id"=>$otherUserID,"message"=>"2"));
													$this->model->updateDB($this->cancelTable,array("CancellationStatus"),array(2),"OfferJobID",$jobofferID);
													echo json_encode(array("error"=>"none"));
												}
											}
											else{
												echo json_encode(array("error"=>"notCancellable"));
											}
										break;

										case '8':
											if($OfferJobStatus != 1 || $OfferJobStatus !=2){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Seeker",$OfferJobDateTime));
												$reason = $this->sanitize($_POST['reason']);
												$insert = $this->model->insertDB($this->disputeTable,$this->disputeDB,array($otherUserID,$_SESSION['seekerUser'],$jobofferID,$otherUserLiteral,$reason));

												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
												if($update){
													$agreementCheck = $this->model->joinAgreementCancel($this->seekerUnique,array($this->seekerSession));
													if(!empty($agreementCheck) && $agreementCheck[0]['OfferJobID'] == $jobofferID){
														$update = $this->model->updateDBDynamic("agreement",array("AgreementStatus"),array(4,$agreementCheck[0]['AgreementID']),array("AgreementID"));
													}
													$this->createNotification("disputeSeeker",array("sendTo"=>"PasserID","id"=>$otherUserID,"message"=>"1"));
													echo json_encode(array("error"=>"none"));
												}
											}
											else{
												echo json_encode(array("error"=>"notCancellable"));
											}
										break;
										case '9':
											if($OfferJobStatus == 5){
												$this->model->insertDB($this->transactionTable,$this->transactionDB,array($OfferJobID,$OfferJobStatus,$newStatus,"Seeker",$OfferJobDateTime));
												$update = $this->model->updateDBDynamic("offerjob",array("OfferJobStatus"),array($newStatus,$jobofferID),array("OfferJobID"));
												if($update){
													$agreementCheck = $this->model->selectAllDynamic("agreement",array("*"),array($currentUserUnique,$otherUserUnique,"AgreementStatus"),array($this->seekerSession,$otherUserID,1));
													if(!empty($agreementCheck)){
														$select = $this->model->selectSingleUser("offerjobformused","OfferJobID",array($agreementCheck[0]['OfferJobFormUsedID']),"JobOfferFormUsedID");
														if($select == $jobofferID){
															$update = $this->model->updateDBDynamic("agreement",array("AgreementStatus"),array(2,$agreementCheck[0]['AgreementID']),array("AgreementID"));
														}
													}
													switch ($_POST['ratingInsert']) {
														case 'insert':
															$prating = $this->sanitize($_POST['prate']);
															$wqrate = $this->sanitize($_POST['wqrate']);
															$puncrate = $this->sanitize($_POST['puncrate']);
															$feedback = $this->sanitize($_POST['feedback']);
															$this->model->insertDB($this->ratingTable,$this->ratingDB,array($jobofferID,$otherUserID,$this->seekerSession,$prating,$wqrate,$puncrate,$feedback,$otherUserLiteral));
															break;
													}
													$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$otherUserID,"message"=>"5"));
													echo json_encode(array("error"=>"none"));
												}
											}
											else{
												echo json_encode(array("error"=>"endable"));
											}
										break;

									}
								}
								else{
									echo json_encode(array("error"=>"seekerNotVerified"));
								}
							}
							else{
								echo json_encode(array("error"=>"passerNotVerified"));
							}
						}
					}
					else{
						echo json_encode(array("error"=>"noneExistingJobOffer"));
					}
				}
			}

			public function cancelJobOffer(){
				$currentUserID = $otherUserID = $currentUserTable = $otherUserTable = $reason = $initiator = $cancellableWork = $insert = $offerJobID = $otherUserUnique = $checkCancel = null;
				 $flag = 0;
				if(isset($_POST['cancel'])){
					$offerJobID = $this->sanitize($_POST['offerJobID']);
					$reason = $this->sanitize($_POST['reason']);
					$initiator = (isset($this->seekerSession)?"Seeker":"Passer");
					$currentUserID = (isset($this->seekerSession)?$this->seekerSession:$this->passerSession);
					$otherUserID = $this->sanitize($_POST['otherUser']);
					$currentUserUnique = (isset($this->seekerSession)?$this->seekerUnique:$this->passerUnique);
					$otherUserUnique = (isset($this->seekerSession)?$this->passerUnique:$this->seekerUnique);
					$otherUserTable = (isset($this->seekerSession)?$this->passerTable:$this->seekerTable);
					$cancellableWork = $this->model->selectAllFromUser($this->offerJobAddTable,$currentUserUnique,array($currentUserID));
					if(!empty($cancellableWork)){
						foreach ($cancellableWork as $data) {
							if(($data['OfferJobStatus']) == 3 || ($data['OfferJobStatus']) == 5){
								$flag = 1;
							}
						}
						if($flag == 1){
							$checkCancel = $this->model->selectAllDynamic($this->cancelTable,array("*"),array("CancellationStatus",$currentUserID,"OfferJobID"),array(1,$currentUserID,$offerJobID));
							if(empty($checkCancel)){
								$insert = (isset($this->seekerSession)?$this->model->insertDB($this->cancelTable,$this->cancelDB,array($offerJobID,$currentUserID,$otherUserID,$initiator,$reason)):$this->model->insertDB($this->cancelTable,$this->cancelDB,array($offerJobID,$otherUserID,$currentUserID,$initiator,$reason)));
								if($insert){
									$this->model->updateDBDynamic($this->offerJobAddTable,array("OfferJobStatus"),array(6,$offerJobID),array("OfferJobID"));
									$this->createNotification("cancellationSeeker",array("sendTo"=>$otherUserUnique,"id"=>$otherUserID,"message"=>1));
									echo json_encode(array("error"=>"none"));
								}
							}
							else{
								echo json_encode(array("error"=>"cancelInProcess"));
							}
						}
						else{
							echo json_encode(array("error"=>"noCancellableJobOffer"));
						}
					}
					else{
						echo json_encode(array("error"=>"noActiveOfferJob")); 
					}
				}
			}

			public function ratingDisplay(){
				$offerJobID = $otherUserID = $otherUserTable = $checkValidUser = $otherUserDetails = $otherUserUnique = null;
				if(isset($_POST['ratings'])){
					$offerJobID = $this->sanitize($_POST['offerJobID']);
					$otherUserID = $this->sanitize($_POST['otherUser']);
					$otherUserTable = (isset($this->seekerSession)?$this->passerTable:$this->seekerTable);
					$otherUserUnique = (isset($this->seekerSession)?$this->passerUnique:$this->seekerUnique);
					$checkValidUser = $this->model->checkAuthenticity("offerjob",$otherUserUnique,"OfferJobID",array($otherUserID,$offerJobID));
					if($checkValidUser > 0){
						$otherUserDetails = $this->model->selectAllFromUser($otherUserTable,$otherUserUnique,array($otherUserID))[0];
						echo json_encode(array("error"=>"none","data"=>$otherUserDetails));
					}
					else{
						echo json_encode(array("error"=>"notValidUser"));
					}
				}
			}


			public function switchAccount(){
				$original = $currentUserID = $currentUserUnique = $otherUserUnique = $otherUserTable = $currentUserTable = $checkExist = $getSeekerDetails = $getPasserDetails = $insert = $redirect = $otherSession = $currentSession =  null;
				if(isset($_POST['switch'])){
					$original = (isset($_SESSION['seekerUser'])?"Seeker":"Passer");
					$currentSession = (isset($_SESSION['seekerUser'])?'seekerUser':'passerUser');
					$currentUserID = (isset($_SESSION['seekerUser'])?$_SESSION['seekerUser']:$_SESSION['passerUser']);
					$currentUserUnique = (isset($_SESSION['seekerUser'])?$this->seekerUnique:$this->passerUnique);
					$currentUserTable = (isset($_SESSION['seekerUser'])?$this->seekerTable:$this->passerTable);
					$otherUserUnique = (isset($_SESSION['seekerUser'])?$this->passerUnique:$this->seekerUnique);
					$otherUserTable = (isset($_SESSION['seekerUser'])?$this->passerTable:$this->seekerTable);
					$otherRedirect = (isset($_SESSION['seekerUser'])?"../passer/dashboard":"../seeker/dashboard");
					$otherSession = (isset($_SESSION['seekerUser'])?"passerUser":"seekerUser");
					$checkExist = $this->model->selectAllDynamic($this->switchTable,array("*"),array($currentUserUnique),array($currentUserID));
					if(empty($checkExist)){
						if(isset($_SESSION['seekerUser'])){
							$getSeekerDetails = $this->getDetailsSeeker($_SESSION['seekerUser'])[0];
							extract($getSeekerDetails);
							$insert = $this->model->insertDB('passer',$this->passerSwitchDB,array($SeekerFN,$SeekerLN,$SeekerPass,$SeekerEmail));
						}
						else{
							$getPasserDetails = $this->getDetailsPasser($_SESSION['passerUser'])[0];
							extract($getPasserDetails);
							$insert = $this->model->insertDB($this->seekerTable,$this->seekerSwitchDB,array($PasserFN,$PasserLN,$PasserBirthdate,$PasserAge,$PasserGender,$PasserStreet,$PasserCity,$PasserAddress,$PasserCPNo,$PasserEmail,$PasserPass,$PasserProfile,1));
						}
						if($insert){
							(isset($_SESSION['seekerUser'])?$this->model->insertDB($this->switchTable,$this->switchDB,array($_SESSION['seekerUser'],$insert,$original)):$this->model->insertDB($this->switchTable,$this->switchDB,array($insert,$_SESSION['passerUser'],$original)));
							$_SESSION['switched'] = $currentUserID;
							$_SESSION[$otherSession] = $insert;
							unset($_SESSION[$currentSession]);
						}
					}
					else{
						unset($_SESSION[$currentSession]);
						$_SESSION[$otherSession] = $checkExist[0][$otherUserUnique];
						if($checkExist[0]['Original'] == $original){
							$_SESSION['switched'] = $checkExist[0][$otherUserUnique];
						}
						else{
							unset($_SESSION['switched']);
						}
					}
					echo json_encode(array("error"=>"none","redirect"=>$otherRedirect));
				}
			}

			public function updateUserPasserFee(){
				if(isset($_POST['update'])){
					$data = $this->sanitize($_POST['fee']);
					$update = $this->model->updateDB($this->passerTable,array("PasserFee"),array($data),$this->passerUnique,$this->passerSession);
					if($update){
						echo json_encode(array("error"=>"none"));
					}
				}
			}

			public function createStar($rating){
				$stars = $builderStar = null;
				if(!empty($rating)){
					for ($i=0; $i < $rating ; $i++) { 
						$builderStar = '<i class="fas fa-star text-warning"></i>';
						$stars = $builderStar."".$stars;
					}
					for ($j=$i; $j < 5 ; $j++) { 
						$stars = $stars.'<i class="fas fa-star"></i>';
					}
					unset($i,$j);
				}
				else{
					$stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
				}
				return $stars;
			}

			public function generateCOE(){
				$seeker = $offerJobID = $agreementRecords = $generatedCOE = null;
				if(isset($_POST['generate'])){
					$seeker = $this->sanitize($_POST['seekerID']);
					$offerJobID = $this->sanitize($_POST['offerjobID']);
					$agreementRecords = $this->model->agreementGenerate(array($offerJobID));
					extract($agreementRecords[0]);
					if(!empty($AgreementSerial)){
						echo json_encode(array("error"=>"none","records"=>$agreementRecords[0]));
					}
					else{
						$generatedCOE = "PM678".rand(1,19).$SeekerID.$PasserID;
						$this->model->updateDBDynamic("agreement",array("AgreementSerial"),array($generatedCOE,$AgreementID),array("AgreementID"));
						$agreementRecords = null;
						$agreementRecords = $this->model->agreementGenerate(array($offerJobID))[0];
						echo json_encode(array("error"=>"none","records"=>$agreementRecords));
					}
				}
			}


			public function generateCOEPDF(){
				if(isset($_GET['id'])){
					$check = $this->model->selectTwoCondition(array("*"),"agreement","PasserID","AgreementSerial",array($_SESSION['passerUser'],$this->sanitize($_GET['id'])));
					if(!empty($check)){
						$offerJobID = $this->sanitize($_GET['offerJobID']);
						$offerJobID = $this->model->agreementGenerate(array($offerJobID));
						extract($offerJobID[0]);
						$agreementRecords = $this->model->agreementGenerate(array($offerJobID));
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				ob_start();
				$html = '<style type="text/css">

  '.file_get_contents("../public/etc/bootstrap/css/bootstrap.min.css").'
</style>
<form method="get" action="file.doc">
<div class="card-body border border-dark" style="background-image:url(../public/etc/images/system/coe2.png);background-repeat: no-repeat;">
    <div class="col-md-6 text-center">
      <img src="../public/etc/images/system/logo-black1.png" class="" width="100">
      <h1 class="text-success" style="font-family: \'Junction\'; "><i>Certificate of Employment</i></h1>
      <p style="font-size: 20px">This is to certify that '.($PasserGender == "Male"?"Mr":"Mrs").'.</p>
      <h2 class="text-primary"><u>'.$PasserFN." ".$PasserLN.'</u></h2>
      <p style="font-size: 20px">has been employed by '.($SeekerGender == "Male"?"Mr":"Mrs").'.</p>
      <h2 class="text-dark "><u>'.$SeekerFN." ".$SeekerLN.'</u></h2>
      <p style="font-size: 20px">as a</p>
      <p class="font-weight-bold" style="font-size: 25px"><u>'.$PasserCertificate.'</u></p>
      <p class=""> from 
        <b style="font-size:18px"><u>'.date("F jS, Y",strtotime($StartDate)).'</u></b> to 
        <b style="font-size:18px"><u>'.date("F jS, Y",strtotime($AgreementDateandTime)).'</u>.</b>
      </p>
      <p style="font-size: 13pt">This certification is being issued upon the request of the aforementioned name for whatever lawful purposes it may serve him/her best.</p>
      <p style="font-size: 13pt">Given this <u>'.date("d").'</u>st day of <u>'.date("m Y").'</u></p>
    </div>
  </div>

    <div class="col-md-12 text-center" style="background: #68a2ff">
    <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
      Certificate Tracking No: <u class="text-warning">'.$AgreementSerial.'</u>
    </small>
    <br>
      <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
      PassersMate Tel.No: 266-81-34
    </small>
    <br>
      <small class="text-white font-weight-bold" style="font-size:12px; font-family: "Comic Sans MS", cursive, sans-serif">
      Email address: <a href="" class="text-info">passersmate@gmail.com</a>
     </small>

</div>
</form>';
				$pdf = new TCPDF();
				$pdf->SetCreator("PassersMate");
				$pdf->SetAuthor('PassersMate Admin');
				$pdf->SetTitle('COE for Passers');
				$pdf->SetSubject('COE');
				$pdf->SetKeywords('PassersMate');
				$pdf->AddPage('P');
				// $border = array('LRTB' => array('width' => 0.1, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
				$pdf->Image('../public/etc/images/system/coe2.png', 0, 0, 0, 0, 'PNG', '', '', false, 0, '', false, false, "", false, false, false);
				// $pdf->SetDrawColor(128, 0, 0);
				$pdf->writeHTML($html);
				// ob_end_clean();
				$pdf->Output('PassersmateCOE.pdf');
				 ob_end_flush(); 
				 }
				 }
			}

			public function getDataJobForm(){
				if(isset($_POST['getData'])){
					$user = (isset($_SESSION['seekerUser'])?$this->seekerUnique:$this->passerUnique);
					$data = $this->sanitize($_POST['id']);
					$dbData = $this->model->joinOfferJobFormUsed($user,array($data))[0];
					echo json_encode(array("error"=>"none","data"=>$dbData));
				}
			}

		}
?>