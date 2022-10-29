
<?php 
include '../lib/Session.php';
Session::checkLogin();

include '../config/config.php';
include '../lib/Database.php';
include '../helpers/formater.php';
?>
<!-- All  classes object  -->

<?php
$db=new Database();
$fm= new formater();


?>


<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">
			<?php 
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$email=$fm->validation($_POST['email']);
				$email=mysqli_real_escape_string($db->link,$email);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					echo "Invalid E-mail formate";

				}
				else{
					$query="SELECT * from users WHERE email='$email' limit 1";
					$result=$db->select($query);
					if($result !=false){

						while ($value=$mailcheck->fetch_assoc()) {
							$userid=$value['id'];
							$username=$value['username'];
						}
						$text=substr($email,0,3);
						$random=rand(10000,99999);
						$newpass="$text$random";
						$password=md5($newpass);

						$upquery="UPDATE users SET password='$password' where id='$userid';";
						$updaterow=$db->update($upquery);



						$to      = '$email';
						$subject = 'the password';
						$message = 'You  Recovery password '.$newpass;
						$headers = 'From: tariul@example.com' . "\r\n" .
						'Reply-To: tarikul@example.com' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();

						$sendmail=mail($to, $subject, $message, $headers);
						if($sendmail){
							echo "<span style='color:green;font-size:18px;'> Plz check your mail.!!</span>";

						}
						else{
							echo "<span style='color:red;font-size:18px;'>Your Recovery password seding in your email. Please check your mail.!!</span>";
						}

					}
					else{
						echo "<span style='color:red;font-size:18px;'>E-mail not Send !!</span>";
					}
				}
			}

			?>

			<form action="" method="post">
				<h1>Password Recovery </h1>
				<div>
					<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
				</div>
				<div>
					<input type="submit" value="Send Mail" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="login.php">Login</a>
			</div><!-- button -->
			<div class="button">
				<a href="#">Training with Priyanka</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>
</html>