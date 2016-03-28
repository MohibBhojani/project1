<?PHP
session_start();
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
				<?PHP 
					if(isset($_SESSION['uid'])){
						echo '<li><a href="profile.php">PROFILE</a></li>';
					}
				?>
			</ul>
		</div>
			<a href="http://saylaniwelfare.com/high-image/"><div  class="contactus-pic" ></div></a>
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
