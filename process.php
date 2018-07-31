<?php 
	include 'config.php';

	$userTable = implode(",", array('`firstname`','`lastname`','`username`','`password`','`status`','`registerDateTime`'));

	function sanitize($variable){
		return htmlentities(trim($variable));
	}

	function message($message,$div){
		echo "<script type='text/javascript'>
				document.getElementById('" . $div . "').style.display='block';
				document.getElementById('" . $div . "').innerHTML='" . $message . "';
			</script>";
	}

	if(isset($_POST['registerSubmit'])){
		$fname = $lname = $uname = $passwordUser = $passwordRetype = null;
		$stmt = null;
		$message = null;
		$return = null;
		$id = null;
		foreach ($_POST as $key => $value) {
			switch ($key) {
				case 'fname':
					$fname = sanitize($value);
					break;
				case 'lname':
					$lname = sanitize($value);
					break;
				case 'uname':
					$uname = sanitize($value);
					break;
				case 'passwordUser':
					$passwordUser = sanitize($value);
					break;
				case 'passwordRetype':
					$passwordRetype = sanitize($value);
					break;
			}
		}
		if(!empty($fname) && !empty($lname) && !empty($uname) && !empty($passwordUser) && !empty($passwordRetype)){
			if($passwordUser != $passwordRetype){
				message('Please make sure your password is the same!','regError');
			}
			else{
				try {
					$stmt = $db->prepare("SELECT `firstname` FROM user WHERE `username` = ?");
					$stmt->execute(array($uname));
					$return = $stmt->rowCount();
						if(empty($return)){
							$stmt = null;
							$return = null;
							try {
								$stmt = $db->prepare("INSERT INTO user($userTable) VALUES(?,?,?,?,?,?)");
								$stmt->execute(array($fname,$lname,$uname,$passwordUser,0,date('l jS \of F Y h:i:s A')));
								$id = $db->lastInsertId();
									if($stmt){
								    	$_SESSION['user'] = $id;
								    	header("location: home.php");
									}
							} catch (Exception $e) {
								echo $e->getMessage();
							}
						}
						else{
							message('The username is already taken. Please choose other username','regError');
						}
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}

			
		}

		else{
			message('Please Fill up all remaining fields!','regError');
		}

	}


	if(isset($_POST['submitLogin'])){
		$stmt = null;
		$uname = null;
		$password = null;
		$return = null;
		if(isset($_POST['uname']) && !empty($_POST['uname']) && isset($_POST['password']) && !empty($_POST['password'])){
			$uname = sanitize($_POST['uname']);
			$password = sanitize($_POST['password']);

		$stmt = $db->prepare("SELECT password,userID FROM user where `username` = ?");
		$stmt ->execute(array($uname));
		$return = $stmt->fetch();
			if(empty($return)){
				message('Please check your username or password','logError');
			}
			else{
				if($password == $return['password']){
			    	$_SESSION['user'] = $return['userID'];
			    	header("location: home.php");
				}
				else
				{
					message('Please check your username or password','logError');
				}
			}
		}
	}


	if(isset($_GET['signout'])){
		session_destroy();
		header("location: index.php");
	}


	if(isset($_SESSION['user'])){
		$stmt = null;
		$dom = null;
		$build = null;
		$result = null;
		$user = null;
		$totalPage = null;
		$totalPages = null;
		$pageNo = null;
		$recordCount = 5;
		$offset = null;

		$totalPage = $db->query("SELECT COUNT(*) from `user`")->fetch()[0];
		$totalPages = ceil($totalPage/$recordCount);
		$totalPage = null;
		$pageNo = isset($_GET['page'])?$_GET['page']:1;
			if(isset($_GET['page']) && $_GET['page'] > $totalPages){header("location:home.php?page=1");}
		$offset = ($pageNo-1) * $recordCount;
			if(is_numeric($pageNo)){
				$stmt = $db->query("SELECT * FROM user WHERE `status` = 0 LIMIT $offset,$recordCount");
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($result)){
						foreach ($result as $user) {
							  $build = '<tr>
						      <td>'. sanitize($user['userID']) .'</td>
						      <td>'. sanitize($user['firstname']) .'</td>
						      <td>'. sanitize($user['lastname']) .'</td>
						      <td>'. sanitize($user['username']) .'</td>
						      <td>'. sanitize($user['password']) .'</td>
						      <td>'. sanitize($user['registerDateTime']) .'</td>
						      <form method="POST">
						      <td>
						      	<button type="submit" value="'. sanitize($user['userID']) .'" formaction="edit.php?update='. sanitize($user['userID']) .'" name="update" class="btn btn-warning">Update</button>
						      	<button type="submit" onclick="return confirm(&quot;Are you sure you want to delete your account?&quot;);" value="'. sanitize($user['userID']) .'" name="delete" class="btn btn-danger">Delete</button>
						      </td>
						      </form>
						      </tr>';
							  $dom = $dom . $build;
						}
					}
					else{
						$dom =  "
						<tr>
							<td>No Data to show</td>
							<td>No Data to show</td>
							<td>No Data to show</td>
							<td>No Data to show</td>
							<td>No Data to show</td>
							<td>No Data to show</td>
						</tr>";
					}
			}
			else{
				header("location:home.php");
			}
		}


	if(isset($_POST['delete'])){
		$variable = $_POST['delete'];
		$stmt = null;
		$return = null;
		$stmt = $db->prepare("UPDATE user SET `status` = 1 WHERE `userID` = ?");
		$return = $stmt->execute(array($variable));
			if ($return) {
				echo "<script>window.location='home.php'</script>";
			}
		$return = null;
		$variable = null; 
	}


	if(isset($_GET['update'])){
		$stmt = null;
		$return = null;
		$fname = $lname = $uname = $id = null;
		$variable = $_GET['update'];
		$stmt = $db->prepare("SELECT * FROM user WHERE `userID` = ?");
		$stmt->execute(array($variable));
		$result = $stmt->fetchAll();
		if (!empty($result)) {
			$id = $result[0]['userID'];
			$fname = $result[0]['firstname'];
			$password = $result[0]['password'];
			$lname = $result[0]['lastname'];
			$uname = $result[0]['username'];
			$fname = $result[0]['firstname'];
		}
		else{
			echo "<script>window.location='home.php'</script>";
		}
	}


	if(isset($_POST['updateSubmit'])){
		$stmt = null;
		$return = null;
		if(isset($_POST['uname']) && !empty($_POST['uname']) && isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['passwordUser']) && !empty($_POST['passwordUser']) && isset($_POST['fname']) && !empty($_POST['fname']) && isset($_POST['lname']) && !empty($_POST['lname']) && isset($_POST['passwordVerify']) && !empty($_POST['passwordVerify'])){

				if ($_POST['passwordUser'] == $_POST['passwordVerify']){
					if(isset($_POST['newPassword']) && empty($_POST['newPassword']) && isset($_POST['confirmPassword']) && empty($_POST['confirmPassword'])){
						$stmt = null;
						$stmt = $db->prepare("UPDATE user SET `firstname` = ?, `lastname` = ?, `username` = ? WHERE `userID` = ?");
						$return = $stmt -> execute(array($_POST['fname'],$_POST['lname'],$_POST['uname'],$_POST['id']));
						if($return){
							$return = null;
							$fname = $lname = $uname = $password = null;
							echo "<script>window.location='home.php'</script>";
						}
					}
					elseif(isset($_POST['newPassword']) && !empty($_POST['newPassword']) && isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword'])){
							if($_POST['newPassword'] == $_POST['confirmPassword']){
								$stmt = null;
								$stmt = $db->prepare("UPDATE user SET `firstname` = ?, `lastname` = ?, `username` = ?, `password` = ? WHERE `userID` = ?");
								$return = $stmt -> execute(array($_POST['fname'],$_POST['lname'],$_POST['uname'],$_POST['newPassword'],$_POST['id']));
								if($return){
									$return = null;
									$fname = $lname = $uname = $password = null;
									echo "<script>window.location='home.php'</script>";
								}
							}
							else{
								message('Please make sure password is the same with first written!','editError');
							}

					}	
					else{
						message('Please stop messing with elements','editError');
					}
				}
				else{
					message('Password is Incorrect!','editError');
				}

		}
		else{
			message('Please Fill up all remaining fields!','editError');
		}
	}
?>