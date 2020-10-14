

<?php

session_start();
include "config.php";
$errors=array();


if(isset($_POST['submit'])) {
	$username=isset($_POST['username'])?$_POST['username']:'';
	$password=isset($_POST['password'])?$_POST['password']:'';


	if(sizeof($errors)==0) {


		$sql = 'SELECT * FROM users where
		`uname`="'.$username.'" AND `password`="'.$password.'"' ;
		$result = $conn->query($sql);


		if ($result->num_rows > 0) {

			// output data of each row
			while ($row = $result->fetch_assoc()) {
				if ($row['role']== 'admin') {

					$_SESSION['userdata'] = array('uname' => $row['uname'],'userid' => $row['userid'], 'password'=> $row['password'], 'email'=>$row['email'], 'address'=>$row['address'], 'age'=>$row['dob'] , 'role'=>$row['role']);
					header('Location:index.php');
				} else {
					$_SESSION['userdata'] = array('uname' => $row['uname'],'userid' => $row['userid'], 'password'=> $row['password'], 'email'=>$row['email'], 'address'=>$row['address'], 'age'=>$row['dob']) ;
					header('Location:dashboard.php');
				}
			}
		} else {
			$errors[]=array('input'=>'form','msg'=>'Invalid Login');
		}

		$conn->close();
	}
}
if (isset($_POST['registerpage'])) {
	header('Location:signup.php');
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simpla Admin | Sign In</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>

	<body id="login">

		<div id="login-wrapper" class="png_bg">
			<div id="login-top">

				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->

			<div id="login-content">

				<form action="login.php" method="POST">

					<!---<div class="notification information png_bg">
						<div>
							Just click "Sign In". No password needed.
						</div>
					</div>-->

					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password"  name="password"/>
					</p>
					<div class="clear"></div>
					<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" name="submit" value="Sign In" />
					</p>

				</form>
			</div> <!-- End #login-content -->

		</div> <!-- End #login-wrapper -->
  </body>
</html>
