<?php
$conn=mysqli_connect('localhost','root','','location');
	if($conn){
		echo "connected successfully";
	}
	else{
		echo $conn->error;
	}
	?>