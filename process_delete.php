<?php 
$conn = mysqli_connect('localhost', 'root', '','php6');
$delete_query = "DELETE from developer where id = ".$_GET['id'];
$fetched_data = mysqli_query($conn,$delete_query);

header('location:process.php');
?>