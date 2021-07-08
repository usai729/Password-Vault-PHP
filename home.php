<?php 
	include("connect.php");

	$greetings = array("Hi, ", "Hello, ", "Hola, ", "Howdy, ", "Hey, ");
	$greetingIndex = array_rand($greetings);

	session_start();

	if (!isset($_SESSION['user'])) {
		header("Location: index.php");
	}

	$name = $_SESSION['user'];
	$greetUser = $greetings[$greetingIndex].$name."!";

	//ENCRYPTION AND DECRYPTION DETAILS
	$ciphering = "AES-128-CTR";
	$encryption_key = "2h1mbshdhc2n8cnd8FSy7hu726";
	$options = 0;
	$encryption_iv = '1234567891011121';

	//GETTING USER PRIMARY ID (PRIMARY KEY)
	$sql_getID = "SELECT pId FROM users WHERE user_name='$name'";
	$query_getID = mysqli_query($conn, $sql_getID);

	$id = mysqli_fetch_array($query_getID);
	$id = $id['pId'];

	$sql_getPwds = "SELECT * FROM passwords WHERE relId='$id'";
	$query_getPwds = mysqli_query($conn, $sql_getPwds);

	//ADD NEW PASSWORD
	if (isset($_POST['pwd_nn'])) {
		$name = mysqli_real_escape_string($conn, $_POST['pwd_name_n']);
		$pwd = openssl_encrypt(mysqli_real_escape_string($conn, $_POST['pwd_nn']), $ciphering, $encryption_key, $options, $encryption_iv);
		$date = date('y-m-d');

		$sql_insert_new = "INSERT INTO passwords(relId, name_of_pwd, pwd, date_added) VALUES('$id', '$name', '$pwd', '$date')";

		if (mysqli_query($conn, $sql_insert_new)) {
			header("Location: home.php");
		}
	}

	//DELETE A PASSWORD
	if (isset($_POST['delPwdBtn'])) {
		$pwd_id_to_del = $_POST['delPwdBtn'];

		$del_sql = "DELETE FROM passwords WHERE pId='".$pwd_id_to_del."'";
		$del_query = mysqli_query($conn, $del_sql);

		if ($del_query) {
			header("Location: home.php");
		}
	}
?>

<html>
<head>
	<title>Home</title>

	<meta name="viewport" content="width=device-width">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="design.js"></script>

	<style type="text/css">
		body, html {
			margin: 0 auto;
		}
		.btn {
			font-weight: bolder;
		}
		center {
			margin-top: 30px;
		}
		#user_name {
			color: #0275d8;
			font-weight: bolder;
		}
		#content {
			margin-top: 10px;
			background-color: #202020;
			border-radius: 2px;
		}
		#sub-content {
			padding: 10px;
			color: white;
			font-weight: normal;
			text-align: left;
		}
		.delBtn {
			margin-top: 5px;
			border-color: black;
		}
		hr {
			border-top: 10px;
		}
		input {
			margin-top: 5px;
		}
		footer {
			background-color: #303030;
			width: 100%;
			height: 90px;
			padding: 35px;
			bottom: 0;
			position: fixed;
		}
		#copyright {
			color: gray;
			cursor: not-allowed;
			font-size: 14;
			margin-left: 20px;
		}
		#dev {
			color: gray;
			cursor: pointer;
			font-size: 16;
			text-decoration: none;
		}
		#ebdB2 {
			color: white;
			text-transform: uppercase;
			background-color: #303030;
			border-width: 2px;
			border-color: black;
		}
		ul li {
			display:  inline-block;
		}
		#prompt_c_1 {
			margin: 10px;
		}
		#addLink {
			font-weight: bold;
			font-color: gray;
		}
		#addLink:hover {
			cursor: pointer;
			margin-bottom: 10px;
		}
		#addLink:hover:before, #addLink:hover:after {
			content: "--";
			font-weight: bold;
			font-color: gray;
		}
		#body {
			margin-bottom: 90px;
		}
		@media (max-width: 700px) {
			footer {
				width: 100%;
				height: 80px;
				padding: 27px;
			}
			#body {
				margin-bottom: 80px;
			}
		}
		@media (max-width: 400px) {
			footer {
				width: 100%;
				height: 60px;
				padding: 20px;
			}
			#body {
				margin-bottom: 60px;
			}	
		}
		#pwd_id {
			display: none;
		}
	</style>
</head>

<body>
	<div id="body">
		<div class="container">
			<center>
				<div class="alert alert-primary w-50" role="alert">
					<span id="user_name"><?php echo $greetUser; ?></span>
				</div>
				
				<?php 
					//ADD NEW PASSWORD BUTTON
					echo "<button class=\"btn w-100\" id=\"ebdB2\" data-bs-toggle=\"modal\" data-bs-target=\"#addNew\">Add New Password</button>";

					//DISPLAY THE INFORMATION FROM DATABASE IN A PROPER FROMAT
					if (mysqli_num_rows($query_getPwds) > 0) {
						while ($rows = mysqli_fetch_assoc($query_getPwds)) {
							$pwd_id = $rows['pId'];

							echo "
								<div id='content'>
									<div id='sub-content'>
										<span id='pwd_id'>".$pwd_id."</span>
										Name: <span id='name'>".$rows['name_of_pwd']."</span><br>
										Password: <span id='password'>".openssl_decrypt($rows['pwd'], $ciphering, $encryption_key, $options, $encryption_iv)."</span><br>
										Date Of Entry: ".$rows['date_added']."<br>
										<!-- DELETE BUTTON -->
										<form action='' method='POST'>
											<button type='submit' class='btn btn-dark w-100 delBtn' name'delPwdBtn' value='".$rows['pId']."'>Delete</button>
										</form>
									</div>
								</div>
								<hr>
							";
						}
					}
					else {
						echo "
							<center id='prompt_c_1'>
								You have not added any password yet!<br>
								<span id='addLink' data-bs-toggle='modal' data-bs-target='#addNew'>Add Now!</span>
							</center>
						";
					}
				?>
			</center>

			<!-- Modals -->
			<!-- ADD NEW PASSWORD -->
			<div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			 <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Add New Password</h5>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">
			        <form action="" method="POST">
			        	<input type="hidden" name="id" value="<?php echo $id; ?>">
			        	<input type="text" value="" id="pwdname" placeholder="Enter Identification Name" class="form-control" name="pwd_name_n">
			        	<input type="text" value="" id="pwdtext" placeholder="Enter New Password" class="form-control" name="pwd_nn" autocomplete="off">
			      </div>
			      <div class="modal-footer">
			       	 	<button type="submit" class="btn btn-primary">Save changes</button>
			    	</form>
			      </div>
			    </div>
			  </div>
			</div>
			<!-- Modals End -->
		</div>
	</div>

	<footer>
		<ul>
				<!-- MY INSTAGRAM -->
			<li><a href="https://www.instagram.com/u_sai00_" id="dev">U. Sai Nath Rao</a></li>
				<!--  -->
			<li><span id="copyright">&#169; All rights reserved</span></li>
		</ul>
	</footer>
</body>
<html>