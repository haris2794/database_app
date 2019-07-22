<?php

$conn = mysqli_connect('localhost', 'root', '','php6');
$fetch_query = "Select * from developer";
$fetched_data = mysqli_query($conn,$fetch_query);
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
		echo $q="insert into developer(`name`,`lastname`,`email`, `phone_no`) VALUES ('$name','$lastname','$email','$phone_no')";

		if(mysqli_query($conn,$q))
		{

			$fetch_query = "Select * from developer";
			$fetched_data = mysqli_query($conn,$fetch_query);
			echo 'success';
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

?>

<html>

<form action="" method="post">
	Name
	<input type="text" name="name" value="<?php if(isset($_POST['name'])) echo trim($_POST['name']);?>">
	<br>
	Last Name
	<input type="text" name="lastname" value="<?php if(isset($_POST['lastname'])) echo trim($_POST['lastname']);?>">
	<br>
	email
	<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo trim($_POST['email']);?>">
	<br>
	Phone No.
	<input type="number" name="phone_no" value="<?php if(isset($_POST['phone_no'])) echo trim($_POST['phone_no']);?>">
	<input type="submit" name="submit" value="submit">
<button class="btn btn-outline-primary" type="submit" name="submit">Logout</button><br>


  
</form>

<table width="50%" border="1">
	<tr>
		<th>Sr#</th>
		<th>Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Phone No</th>
		<th>Actions</th>
	</tr>
	<?php foreach($fetched_data as $item){
		echo "<tr>";
		echo "<td>".$item['id']."</td>";
		echo "<td>".$item['name']."</td>";
		echo "<td>".$item['lastname']."</td>";
		echo "<td>".$item['email']."</td>";
		echo "<td>".$item['phone_no']."</td>";
		echo "<td><a href='process_delete.php?id=".$item['id']."'><button>Delete</button></a><a href='process_edit.php?id=".$item['id']."'><button>Edit</button></a></td>";
		echo "</tr>";
	}
	?>
</table>

</html>