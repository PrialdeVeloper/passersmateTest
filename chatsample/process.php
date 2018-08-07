<?php 
$con = new PDO("mysql: host=localhost; dbname=chat","root","");


if(isset($_POST['send'])){
	try {
		$ret = null;
		$message = $_POST['message'];
		$data = array($message,1);
		$stmt = $con->prepare("INSERT INTO `message`(`message`,`type`) VALUES(?,?)");
		$stmt->execute($data);
		$ret["return"]["id"] = $con->lastInsertId();
		echo json_encode($ret); 
	} catch (Exception $e) {
		$ret["return"]["id"] = $e->getMessage();
		echo json_encode($ret);
	}
	
}


if(isset($_GET['getMessage'])){
	try {
		$data = array();
		$trylang = null;
		$ret = null;
		$stmt = $con->query("SELECT messageid,message,type FROM `message` ORDER BY `messageid` ASC");
		$ret = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($ret as $row) {
			if($row['messageid'] % 2 == 0){

				$data = '<div class="row msg_container base_receive">
	                        <div class="col-md-2 col-xs-2 avatar">
	                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
	                                </div>
	                                <div class="col-md-10 col-xs-10">
	                            <div class="messages msg_receive">
	                        <p>'.$row['message'].'</p>
	                        <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
	                           </div>
	                        </div>
	                    </div>';
            }
            else{
            	$data = '<div class="row msg_container base_sent">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p>'.$row['message'].'</p>
                                <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                    </div>';
            }
            $trylang  = $trylang."".$data;
		}
		echo $trylang;
	} catch (Exception $e) {
		$data["data"]["type"] = "error";
		echo json_encode($data);
		
	}
}

?>