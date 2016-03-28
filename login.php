 <?PHP
session_start();
if(isset($_SESSION['uid'])){
	header('Location: index.php');
}
if(!isset($_SESSION['uid'])){
	if(isset($_POST['login'])){
		include('connect.php');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$e_check = $db->query("SELECT * FROM user WHERE email='$username'");
		if($e_check->num_rows == 1){
			$row = $e_check->fetch_object();
			$password_check = $row->password;
			if($password_check == $password){
				$type = $row->type;
				$uid = $row->id;
				//user type
				
				$_SESSION['uid'] = $uid;
				$_SESSION['type'] = $type;
				header('Location: index.php');
			}
			elseif($password_check != $password){
				
			}
		}
		elseif($e_check->num_rows == 0){
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" >
	<meta charset="UTF-8">
</head>
<body>
	<header>
		<div class="iheader">
			<a href="index.php"><h3 class="header-logo-txt">Ilmiyah University</h3></a>
			<div class="login-box">
				<div class="link-txt">
					<?PHP
						if(!isset($_SESSION['uid'])){
							echo '<a href="login.php">Log In</a>';
						}
						if(isset($_SESSION['uid'])){
							echo '<a href="logout.php">Log Out</a>';
						}
					?>
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="main-pic"></div>
		<div class="nav">
			<ul>
				<li><a href="index.php">HOME</a></li>
				<li><a href="events.php">EVENTS</a></li>
				<li><a href="about us.php">ABOUT US</a></li>
				<li><a href="contact us.php">CONTACT US</a></li>
			</ul>
		</div>
		<div class="login-box">
			<form action="" method="post">
				<div class="email-sec">
					<div class="sec-text">Username </div>
					<div class="sec-field"><input type="text" name="username" placeholder="example@some.com" /> </div>
				</div >
				<div class="password-sec">
					<div class="sec-text">Password </div>
					<div class="sec-field"><input type="password" name="password" placeholder="password" /> </div>
				</div >
				<div class="submit-sec">
					<input type="submit" name="login" value="Login" />
				</div >
			</form>
		</div>
		<div class="top-footer">
			<div class="footer-box">
				<div class="fo-bx-hd">Why Choose Us !</div>
				<div class="fo-bx-tx">Highest HEC Ranking (W4)</div>
				<div class="fo-bx-tx">Inspection & Evaluation Committee (CIEC)</div>
				<div class="fo-bx-tx">ISO 9001:2008 Certified</div>
				<div class="fo-bx-tx">Chartered by Government of Sindh in 1993</div>
				<div class="fo-bx-tx">Member Association of (ACU)</div>
				<div class="fo-bx-tx">Member  International Association of Universities(IAU),UNESCO,Paris</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="ifooter">
			<div class="footer-text">© 2015 All rights Reserved</div>
		</div>
	</footer>
</body>
</html>
