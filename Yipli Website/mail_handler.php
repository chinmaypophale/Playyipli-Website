<?php
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$msg=$_POST['msg'];

		$to='bhargavkmakadia@gmail.com'; // Receiver Email ID, Replace with your email ID
		$subject='Form Submission';
		$message="Name :".$name."\n"."Phone :".$phone."\n"."Wrote the following :"."\n\n".$msg;
		$headers="From: ".$email;

		if(mail($to, $subject, $message, $headers)){
			 echo("<script>alert('Form Submitted Successfully ! Thank You... We will contact you shortly!');
			    window.location = 'index.html'
			 </script>");
		}
		else{
			echo "Something went wrong!";
		}
	}
?>
