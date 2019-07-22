<?php 
$conn = mysqli_connect('localhost', 'root', '','php6');
$id = $_GET['id'];
$fetch_query = "Select * from developer where id = $id";
$record = mysqli_query($conn,$fetch_query);
$fetched_data = mysqli_fetch_array($record);
if(isset($_POST['submit'])) {
	if(isset($_POST['name']) && $_POST['name'] !=''){
		$name=$_POST['name'];
	}
	else{
		$error[]='name is missing';
	}

	if(isset($_POST['email']) && $_POST['email'] !=''){
		$email=$_POST['email'];
	}
	else{
		$error[]='email is missing';
	}
	if(isset($_POST['lastname']) && $_POST['lastname'] !=''){
		$lastname=$_POST['lastname'];
	}
	else{
		$error[]='lastname is missing';
	}

	if(isset($_POST['phone_no']) && $_POST['phone_no'] !=''){
		$phone_no=$_POST['phone_no'];
	}
	else{
		$error[]='phone no is missing';
	}


	if(!isset($error))
	{
		// we will see
		$conn = mysqli_connect('localhost', 'root', '','php6');

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
		echo $q="UPDATE developer Set name = '$name', lastname = '$lastname', email = '$email', phone_no = '$phone_no' Where id = $id";
		if(mysqli_query($conn,$q))
		{
			echo 'success';
			header('location:process.php');
		}
		else{
			echo 'failed'; 
		}
	}
	else{

		foreach ($error as $value) {
			echo $value;
			echo '<br>';
		}

	}
}
?>

<html>
<form action="process_edit.php?id=<?php echo $id; ?>" method="post">
	Name
	<input type="text" name="name" value="<?php if(isset($fetched_data['name'])) { echo $fetched_data['name']; }?>">
	<br>
	Last Name
	<input type="text" name="lastname" value="<?php if(isset($fetched_data['lastname'])) {echo $fetched_data['lastname']; } ?>">
	<br>
	email
	<input type="text" name="email" value="<?php if(isset($fetched_data['email'])) {echo $fetched_data['email']; } ?>">
	<br>
	Phone No.
	<input type="number" name="phone_no" value="<?php if(isset($fetched_data['phone_no'])) {echo $fetched_data['phone_no']; } ?>">
	<input type="submit" name="submit" value="Update">
	
</form>

</html>