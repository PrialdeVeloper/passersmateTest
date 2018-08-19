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
		public $offerJobTableDefault = array("SeekerID","WorkingAddress","StartDate","EndDate","Salary","PaymentMethod","AccomodationType","offerjobformDefault","uneditable");
		public $disableDB = 'disabledusers';
		public $disableTable = array("PasserID","SeekerID","DeactivateReason");
		public $messageTable = "message";
		public $messageDB = array("PasserID","SeekerID","MessageContent","MessageSender");
		public $agreementTable = "agreement";
		public $agreementDB = array("SeekerID","PasserID","OfferJobFormID","AgreementNotes");
		public $offerJobAddTable = "offerjob";
		public $offerJobAddDB = array("OfferJobFormID","SeekerID","PasserID","Notes");

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

		public function getDetailsPasser($passer){
			return $this->model->selectAllFromUser($this->passerTable,$this->passerUnique,array($passer));
		}

		public function getDefaultOfferJob($seeker){
			return $this->model->selectAllDynamic($this->offerJobDB,array("*"),array("offerjobformDefault",$this->seekerUnique),array(1,$seeker));
		}

		public function seekerIsSubscribed(){
			$subscription = null;
			if(!$this->checkSession('seekerUser')){
				header("location:../seeker/dashboard");
			}
			$subscription = $this->model->selectTwoCondition(array("*"),$this->subscriptionDB,"SubscriptionStatus",$this->seekerUnique,array("ongoing",$_SESSION['seekerUser']));
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
			$passerID = $default = $checkTransaction = null;
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
									$checkTransaction = $this->model->selectAllDynamic($this->offerJobAddTable,array("OfferJobStatus"),array($this->seekerUnique,$this->passerUnique,"OfferJobStatus"),array($_SESSION['seekerUser'],$_SESSION['passerJobOffer'],1));
									if(empty($checkTransaction)){
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
			$insert = $defaultJobOffer = $checkTransaction = null;
			if(isset($_POST['offerJobAdd'])){
				if($this->checkSession('passerJobOffer')){
					if($this->checkSession('seekerUser')){
						if($this->seekerIsSubscribed()){
							if($this->getDetailsSeeker($_SESSION['seekerUser'])[0]['SeekerStatus'] == 1){
								if($this->getDetailsPasser($_SESSION['passerJobOffer'])[0]['PasserStatus'] == 1){
									if($this->getDefaultOfferJob($_SESSION['seekerUser'])){
										$checkTransaction = $this->model->selectAllDynamic($this->offerJobAddTable,array("OfferJobStatus"),array($this->seekerUnique,$this->passerUnique,"OfferJobStatus"),array($_SESSION['seekerUser'],$_SESSION['passerJobOffer'],1));
										if(empty($checkTransaction)){
											$notes = (isset($_POST['notes'])?$this->sanitize($_POST['notes']):"");
											$defaultJobOffer = $this->getDefaultOfferJob($_SESSION['seekerUser'])[0]['OfferJobFormID'];
											$insert = $this->model->insertDB($this->offerJobAddTable,$this->offerJobAddDB,array($defaultJobOffer,$_SESSION['seekerUser'],$_SESSION['passerJobOffer'],$notes));
											if($insert){
												echo json_encode(array("error"=>"none"));
												$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$_SESSION['passerJobOffer'],"message"=>1));
												unset($_SESSION['passerJobOffer']);
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
			$execute = 1;
			if($notifType == 'message'){
				$checkExist = $this->model->checkExistSingle($this->notifDB,$to['sendTo'],array($to['id']));
				if($checkExist){
					$execute = 0;
				}
			}
			($execute = 1?($to['sendTo'] == "PasserID")?$this->model->insertDB($this->notifDB,$this->notifTable,array($to['id'],NULL,$notifType,$to['message'])):$this->model->insertDB($this->notifDB,$this->notifTable,array(NULL,$to['id'],$notifType,$to['message'])):""); 
			return true;
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
									$message = "verified your acount";
									break;
								case '3':
									$message = "declined your request to be verified.";
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
							$link = "agreements";
							switch ($data['notificationMessage']) {
								case '1':
									$message = "You have a job offer, Mate!";
									break;
								case '2':
									$message = "A recent job offer you received was updated mate! Check it out!";
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
			if(isset($_POST['passerUpdateDataNoImage'])){
				try {
				$passerAddress = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerAddress']));
				$passerStreet = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerStreet']));
				$passerCity = $this->sanitize($this->upperFirstOnlySpecialChars($_POST['passerCity']));
				$passerGender = $this->sanitize($_POST['passerGender']);
				$passerCPNo = $this->sanitize($_POST['PasserCPNo']);
				$passerBirthdate = $this->sanitize(date("Y-m-d",strtotime($_POST['passerBirthdate'])));
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetails,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate),$this->passerUnique,$this->passerSession);
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
				$res = $this->model->updateDB($this->passerTable,$this->passDashboardPersonalDetailsWithPhoto,array($passerAddress,$passerStreet,$passerCity,$passerGender,$passerCPNo,$passerBirthdate,$passerProfile),$this->passerUnique,$this->passerSession);
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
				$SeekerEmail = $this->sanitize($_POST['SeekerEmail']);
				$SeekerUname = $this->sanitize($_POST['SeekerUname']);
				$SeekerPass = $this->hashPassword($this->sanitize($_POST['SeekerPass']));
				$insert = $this->model->insertDB($this->seekerTable,$this->seekerDB,array($SeekerFN,$SeekerLN,$SeekerBirthdate,$SeekerAge,
					$SeekerGender,$SeekerStreet,$SeekerCity,$SeekerAddress,$SeekerCPNo,$SeekerEmail,$SeekerUname,$SeekerPass));
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
				$res = $this->model->updateDB($this->seekerTable,$this->seekDashboardPersonalDetailsWithPhoto,array($seekerAddress,$seekerStreet,$seekerCity,$seekerGender,$seekerCPNo,$seekerBirthdate,$seekerProfile),$this->seekerUnique,$this->seekerSession);
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
			$return = $checkDefault = $change = $reset = $insert = null;
			if(isset($_POST['agreementAdd'])){
				if(isset($_SESSION['agreementPasser'])){
					$seekerID = $_SESSION['seekerUser'];
					$passerID = $_SESSION['agreementPasser'];
					$notes = $this->sanitize($_POST['notes']);
					$checkDefault = $this->model->checkAuthenticity("offerjobform",$this->seekerUnique,"offerjobformDefault",array($_SESSION['seekerUser'],1));
					if($checkDefault >=1){
						$return = $this->model->selectTwoCondition(array("OfferJobFormID"),$this->offerJobDB,$this->seekerUnique,"offerjobformDefault",array($seekerID,1));
						$return = $return[0]['OfferJobFormID'];
					}else{
						$workingAddress = $this->sanitize($_POST['workAddress']);
						$workStart = $this->sanitize(date("Y-m-d",strtotime($_POST['workStart'])));
						$workEnd = $this->sanitize(date("Y-m-d",strtotime($_POST['workEnd'])));
						$salary = $this->sanitize($_POST['salary']);
						$paymentMethod = $this->sanitize($_POST['paymentMethod']);
						$accomodationType = $this->sanitize($_POST['accomodationType']);
						$return = $this->model->insertDB("offerjobform",$this->offerJobTableDefault,array($seekerID,$workingAddress,$workStart,$workEnd,$salary,$paymentMethod,$accomodationType,0,1));
					}
					$insert = $this->model->insertDB($this->agreementTable,$this->agreementDB,array($seekerID,$passerID,$return,$notes));
					if($insert){
						$this->createNotification("JobOffer",array("sendTo"=>"PasserID","id"=>$_SESSION['agreementPasser'],"message"=>1));
						unset($_SESSION['agreementPasser']);
						echo json_encode(array("error"=>"none"));
					}else{
						echo json_encode(array("error"=>$insert));
					}
				}else{
					echo json_encode(array("error"=>"noPasserSelected"));
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
				if($checkEditable[0]['uneditable'] <=0){
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
			if(isset($_POST['deleteJobForm'])){
				$id = $this->sanitize($_POST['id']);
				$checkAuthenticity = $this->checkAuthenticity("offerjobform","SeekerID","OfferJobFormID",array($_SESSION['seekerUser'],$id));
				if($checkAuthenticity){
					$checkAuthenticity = null;
					$delete = $this->model->updateDB("offerjobform",array("OfferJobFormStatus"),array(0),"OfferJobFormID",$id);
					if($delete){
						echo json_encode(array("error"=>"none"));
					}else
					echo $delete;
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
					$data = $this->model->selectAllDynamicLikeLimit($table,$select,$field,$data,$offset,$limit);
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

		public function paginationScriptSingle($table,$field,$field1Ans,$page,$offset,$limit,$add){
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
				$result = $this->model->selectAllLimitSingle($table,$field,$offset,$limit,array($field1Ans));
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
		}
?>