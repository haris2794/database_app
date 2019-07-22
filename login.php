
<?php
session_start();
$error='';
if(isset($_POST['submit'])){
	if(empty($_POST['user']) || empty($_POST['pass']))
	{
		$error = "Username or Password is Empty";
	}
	else
	{
		$user=$_POST['user'];
		$pass=md5($_POST['pass']);
		echo "$pass";
		$conn = mysqli_connect("localhost", "root", "");
		$db = mysqli_select_db($conn, "php6");
		$query = mysqli_query($conn, "SELECT * FROM userpass WHERE pass='$pass' AND user='$user'");
		$_SESSION['rows'] = mysqli_num_rows($query);
		if($_SESSION['rows'] == 1){
			header("Location: process.php");
		}
		else
		{
			$error = "Username or Password is Invalid";
		}
		mysqli_close($conn);
	}
}
?>
<!doctype html>
<html>
<head>
<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-lg-6 m-auto"><br><br><br><br><br><br><br>
		<form method="post">
			<div class="card">
				<div class="card-header bg-dark">
					<h1 class="text-white text-center">
						User Authentication
					</h1>
				</div><br>
				<label>
				</label>
				<input type="text" placeholder="Enter username" name="user" class="form-control"><br>
				<label>
				</label>
				<input type="password" placeholder="Enter password" name="pass" class="form-control"><br>
				<button class="btn btn-outline-primary" type="submit" name="submit">Login</button>
				<h3 class="text-center text-danger">
					<span><?php echo $error; ?></span>
				</h3>
			</div>
		</form>
	</div>
</body>
</html>