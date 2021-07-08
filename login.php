<?php 
	include("connect.php");

	$fail_msg = "";

	if (isset($_POST['create'])) {
		$user = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd_o']));

		$sql_query = "SELECT * FROM users WHERE user_name='$user' AND pwd='$pwd'";

		if (mysqli_num_rows(mysqli_query($conn, $sql_query)) != 0) {
			session_start();
			$_SESSION['user'] = $user;

			header("Location: home.php");	
		}
		else {
			$fail_msg = "&#x2715; Wrong Username Or password";
		}
	}
?>

<html>
<head>
	<title>Sign Up</title>

	<meta name="viewport" content="width=device-width">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<style type="text/css">
		body, html {
			margin: 0;
		}
		.container {
			margin-top: 120;
		}
		input, button {
			margin-top: 10px;
		}
		#msg {
			color: gray;
			font-size: 12;
		}
	</style>

	<script type="text/javascript">
		function check() {
			var un = document.getElementById('username');
			var pwwd_o = document.getElementById('pwd_o');

			if (un && pwwd_o) {
				return true;
			}
			else {
				alert("The passwords do not match");
				return false;
			}
	</script>
</head>

<body>
	<div class="container">
		<form action="#" method="POST">
			<input type="text" id="un" name="username" placeholder="Ente Your Username" class="form-control" required>
			<input type="password" id="pwd_o" name="pwd_o" placeholder="Enter Your password" minlength="10" class="form-control" required>
			<button type="submit" name="create" class="btn btn-dark w-100" onclick="return check()">Login</button>
		</form>

		<span id="msg">
			<?php echo $fail_msg; ?>
		</span>
	</div>
</body>
</html>