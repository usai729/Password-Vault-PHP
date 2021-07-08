<?php 
	include("connect.php");
	$fail_msg = "";

	if (isset($_POST['create'])) {
		$mailId = mysqli_real_escape_string($conn, $_POST['mailId']);
		$user = mysqli_real_escape_string($conn, $_POST['username']);
		$pwd = md5(mysqli_real_escape_string($conn, $_POST['pwd_o']));

		$sql_put = "INSERT INTO users(mailId, user_name, pwd) VALUES('$mailId', '$user', '$pwd')";

		$sql_search = "SELECT * FROM users WHERE user_name='$user'";
		$search_query = mysqli_query($conn, $sql_search);

		if (mysqli_num_rows($search_query) == 0) {
			$sql_put = "INSERT INTO users(mailId, user_name, pwd) VALUES('$mailId', '$user', '$pwd')";

			if (mysqli_query($conn, $sql_put)) {
				session_start();

				$_SESSION['user'] = $user;

				header("Location: home.php");
			}
			else {
				$fail_msg = "&#x2715; Unknown error occured!";
			}
		}
		else {
			$fail_msg = "&#x2715; Username already exists!";
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
			var mail = document.getElementById('mailId');
			var un = document.getElementById('username');
			var pwwd_o = document.getElementById('pwd_o');
			var pwd_c = document.getElementById('pwd_c');

			if (mail.value.includes("@") && mail.value.includes(".com")) {
				if (pwwd_o.value == pwd_c.value) {
					return true;
				}
				else {
					alert("The passwords do not match");
					return false;
				}
			}
			else {
				return false;
			}
		}
	</script>
</head>

<body>
	<div class="container">
		<form action="#" method="POST">
			<input type="email" id="mailId" name="mailId" placeholder="Enter your email" class="form-control" required>
			<input type="text" id="un" name="username" placeholder="Create a unique username" class="form-control" required>
			<input type="password" id="pwd_o" name="pwd_o" placeholder="Create a password (Min length 10)" minlength="10" class="form-control" required>
			<input type="password" id="pwd_c" name="pwd_c" placeholder="Confirm Password" class="form-control" required>
			<button type="submit" name="create" class="btn btn-dark w-100" onclick="return check()">Create Account</button>
		</form>
		<span id="msg">
			<?php echo $fail_msg; ?>
		</span>
	</div>
</body>
</html>