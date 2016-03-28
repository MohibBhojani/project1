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
		<h3 class="body-main-txt">About US</h3>
		<div class="main-txt-description">
		Welcome to Ilmiyah University. Our award-winning website is one of the many ways to learn about 
		the university and engage with members of the I.U family. Visit our schools and colleges, take a 
		virtual tour, apply for admission, meet our active students, distinguished faculty and involved 
		alumni, and look at how our scholars are creatively probing new academic frontiers. You will also 
		find a vibrant I.U presence on social media.<br/><br/>
		Ilmiyah University is moving forward with confidence and purpose. Our strategic plan—Ilmiyah
		University in the Next Decade: Leadership for a Changing World—now in its sixth year, defines our
		goals and aspirations. We’ve invested more than $100 million to meet these goals, and our progress 
		in relation to targets is updated annually. Highlights to date include a diverse and engaged student body, 
		a larger and more distinguished faculty, strong financial management and performance, more engaged alumni,
		and heightened recognition.<br/><br/>

		Our ambitious campus plan, approved in 2012, outlines projected facilities growth and campus enhancements 
		for the coming decade. We will transform the campus with new residence halls, a new home for the ilmiyah 
		College of Law in Lahore, and an attractive Campus in Islamabad.<br/><br/>

		It is an exciting time to be a part of the I.U family. I invite you to explore and remain engaged with us, online and in person.
		
		</div>
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
