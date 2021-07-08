<?php
	
?>

<html>
<head>
	<title>Index</title>

	<meta name="viewport" content="width=device-width">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<style type="text/css">
		body, html {
			margin: 0;
			background-color: white;
		}
		.btn {
			width: 300px;
			height: 50px;
			font-weight: bolder;
			font-size: 15;
			color: white;
			background-color: #447bd4;
			border: 2px solid silver;
			border-radius: 10px;
			margin: 10px;
			margin-top: 200px;
			cursor: pointer;
		}
		.btn:hover {
			font-size: 16;
			transition: .5s;
			box-shadow: 1px 1px 2px 1px #d1dede;
		}
		@media (max-width: 500px) {
			.btn {
				width: 250px;
				height: 40px;
				font-weight: bolder;
				font-size: 13;
				color: white;
				background-color: #447bd4;
				border: 2px solid silver;
				border-radius: 8px;
				margin: 0px;
				margin-top: 100px;
				cursor: pointer;
			}
		}
	</style>
</head>

<body>
	<div class="container">
		<center>
			<a href="signup.php" id="hr1">
				<button class="btn" id="b1">SignUp</button>
			</a>
			<a href="login.php" id="hr2">
				<button class="btn" id="b1">Login</button>
			</a>
		</center>
	</div>
</body>
</html>