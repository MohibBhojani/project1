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
		<div class="main-txt">
			 <h3 class="body-main-txt">Welcome To Our Website</h3>
			 <div class="main-txt-description">
				Hello,thank you for taking the time to visit our website.
			    Here you can find information regarding courses details ,fees structure , notifications,results updates and other co-curricular activities.
				This site will provide continous updates regarding every aspects in almost all the departments of the campus.
				
			 </div>
		</div>
		<div class="main-txt">
			 <h3 class="body-main-txt">Quality Education</h3>
			 <div class="main-txt-description">
			 Highly qualified & experienced faculty Air Conditioned class rooms equiped with Audio Visual Systems <br />
			 Well equiped Air conditioned Laboratories 2000+ nodes Computer Network <br />
			 High Speed Internet Connectivity Throughout the campus <br />
			 Career Planning & well structured Internship program <br />
			 Collaboration with leading Universities of the World <br />
			 Credit Transfers available in leading world universities<br />
			 Scholarships & Financial Assistance worth more than Rs .50 Million for deserving and needy students		 
			 
			 </div>
		</div>
		<div class="grid-box">
			<div class="box1" id="bx-sh">
				<div class="box-background1"></div>
				<div class="bx-hd">OUR GOAL</div>
				<div class="bx-txt">
				Ilmiyah University is already a distinguished institution, 
				standing along the best universities in the nation. 
				Our goal, however, is to not be beside our peers, 
				but in front of them, to lead as a research university.
			
				</div>
			</div>
			<div class="box2" id="bx-sh">
				<div class="box-background2"></div>
				<div class="bx-hd">OUR MISSION</div>
				<div class="bx-txt">
				The mission of the University of Ilmiyah is to 
				offer nationally competitive and internationally recognized
				opportunities for learning, discovery and engagement to a
				diverse population of students in a real-world setting.
				</div>
			</div>
			<div class="box3" id="bx-sh">
				<div class="box-background3"></div>
				<div class="bx-hd">OUR VISION</div>
				<div class="bx-txt">
				We're already an ambitious, world-class university. 
				By placing enterprise at the heart of everything we do, 
				we will develop an innovative and creative culture that empowers 
				people. This is the type of university we want to be.
				</div>
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
