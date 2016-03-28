<?PHP
session_start();
include('connect.php');
if(!isset($_SESSION['uid'])){
	header('Location: index.php');
}
if(isset($_GET['link'])){
	if($_GET['link']=='addstudents')
	{
		if(isset($_POST['add']))
		{
			if($_SESSION['type']=='admin')
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$type='student';
				if($insert = $db->prepare("INSERT INTO user (email, password, type) VALUES (?,?,?)"))
				{
					$insert->bind_param('sss', $username, $password, $type);
					$insert->execute();
					$insert->close();
					header('Location : profile.php?link=viewstudents');
				}
			}
		}
	}
	elseif($_GET['link'] == 'deletestudents')
	{
		if(isset($_POST['delete'])){
			if($_SESSION['type'] == 'admin'){
				$uid = $_POST['uid'];
				if($insert = $db->prepare("DELETE FROM user WHERE id=?")){
					$insert->bind_param('s', $uid);
					$insert->execute();
					$insert->close();
					header('Location: profile.php?link=viewstudents');
				}
			}
		}
	}
	
	if($_GET['link']=='addteachers')
	{
		if(isset($_POST['add']))
		{
			if($_SESSION['type']=='admin')
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				$type='teacher';
				$salary=$_POST['salary'];
				$salary = $db->real_escape_string($salary);
				if($insert = $db->prepare("INSERT INTO user (email, password, type) VALUES (?,?,?)"))
				{
					$insert->bind_param('sss', $username, $password, $type);
					$insert->execute();
					$insert->close();
					if($insert2 = $db->prepare("INSERT INTO salary (name,salary) VALUES(?,?)"))
					{
						$insert2->bind_param('ss', $username,$salary);
						$insert2->execute();
						$insert2->close();
						header('Location: profile.php?link=viewteachers');
					}
				}
			}
		}
	}
	elseif($_GET['link'] == 'deleteteachers')
	{
		if(isset($_POST['delete'])){
			if($_SESSION['type'] == 'admin'){
				$name=$_GET['username'];
				echo $name;
				$uid = $_POST['uid'];
				if($insert = $db->prepare("DELETE FROM user WHERE id=?")){
				
					$insert->bind_param('s', $uid);
					$insert->execute();
					$insert->close();
					if($insert2 = $db->prepare("DELETE FROM salary WHERE name=?"))
					{
				
						$insert2->bind_param('s', $name);
						$insert2->execute();
						$insert2->close();
						header('Location: profile.php?link=viewteachers');
					}
					
				}
			}
		}
	}

	
	if($_GET['link'] == 'addnotifications'){
		if(isset($_POST['add'])){
			if($_SESSION['type'] == 'admin'){
				$title = $_POST['title'];
				$subject = $_POST['subject'];
				$notice = $_POST['notice'];
				if($insert = $db->prepare("INSERT INTO notifications (title, subject, notice) VALUES (?,?,?)")){
					$insert->bind_param('sss', $title, $subject, $notice);
					$insert->execute();
					$insert->close();
					header('Location : profile.php?link=viewnotifications');
					
				}
			}
		}
	}
	elseif($_GET['link'] == 'editnotifications'){
		if(isset($_POST['edit'])){
			if($_SESSION['type'] == 'admin'){
				$title = $_POST['title'];
				$subject = $_POST['subject'];
				$notice = $_POST['notice'];
				$nid = $_POST['nid'];
				if($insert = $db->prepare("UPDATE notifications SET title=?, subject=?, notice=? WHERE id=?")){
					$insert->bind_param('ssss', $title, $subject, $notice, $nid);
					$insert->execute();
					$insert->close();
					header('Location: profile.php?link=viewnotifications');
				}
			}
		}
	}
	
	elseif($_GET['link'] == 'deletenotifications'){
		if(isset($_POST['delete'])){
			if($_SESSION['type'] == 'admin'){
				$nid = $_POST['nid'];
				if($insert = $db->prepare("DELETE FROM notifications WHERE id=?")){
					$insert->bind_param('s', $nid);
					$insert->execute();
					$insert->close();
					header('Location: profile.php?link=viewnotifications');
				}
			}
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
			<h3 class="header-logo-txt"><a href="index.php">Ilmiyah University</a></h3>
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
		<div style="padding: 0; height: 400px;">
			<div class="sub-link-bar">
				<?PHP
					if(isset($_SESSION['uid'])){
						$type = $_SESSION['type'];
						if($type == 'admin'){
							echo '
								<ul>
									<li><a href="profile.php">Home</a></li>
									<li><a href="profile.php?link=viewstudents">View Students</a></li>
									<li><a href="profile.php?link=addstudents">Add Students</a></li>
									<li><a href="profile.php?link=deletestudents">Delete Students</a></li>
									<li><a href="profile.php?link=viewteachers">View Teachers</a></li>
									<li><a href="profile.php?link=addteachers">Add Teachers</a></li>
									<li><a href="profile.php?link=deleteteachers">Delete Teachers</a></li>
									<li><a href="profile.php?link=viewnotifications">View Notifications</a></li>
									<li><a href="profile.php?link=addnotifications">Add Notifications</a></li>
									<li><a href="profile.php?link=editnotifications">Edit Notifications</a></li>
									<li><a href="profile.php?link=deletenotifications">Delete Notifications</a></li>
									
								</ul>
							';
						}
						
						if($type == 'teacher'){
							echo '
								<ul>
									<li><a href="profile.php">Home</a></li>
									<li><a href="profile.php?link=viewstudents">View Students</a></li>
									<li><a href="profile.php?link=viewnotifications">View Notifications</a></li>
									<li><a href="profile.php?link=viewsalary">View Salary</a></li>
								</ul>
							';
						}
						if($type == 'student'){
							echo '
								<ul>
									<li><a href="profile.php">Home</a></li>
									<li><a href="profile.php?link=viewnotifications">View Notifications</a></li>
									<li><a href="profile.php?link=viewfees">View Fees</a></li>
								</ul>
							';
						}
					}
				?>
			</div>
				<?PHP
					if(isset($_SESSION['uid']))
					{
						if(!isset($_GET['link'])){
							echo "<h1 align='center' style='margin: 0 0 0 200px; left: 160px; position: relative; top: 80px; width: 480px; font-size: 48px;'>WELCOME ".strtoupper($type)."</h1>";
						}
						if($type == 'admin'){
							if(isset($_GET['link']))
							{
								$link = $_GET['link'];
								if($link == 'viewstudents')
								{
									$query = $db->query("SELECT * FROM user WHERE type='student'");
									$total = $query->num_rows;
									echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									echo '<h1 class="links-heading">Students list</h1>';
									while($row = $query->fetch_object()):
										$email = $row->email;
										echo "".$email."<br />";
									endwhile;
									echo "Total Students ".$total;
									echo '</div>';
								}
								elseif($link=='addstudents')
								{
								echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									echo '
										<form action="" method="post">
											<div class="sec-field">Username : <input  type="text" name="username" /></div>
											<div class="sec-field">Password : <input type="password" name="password" /></div>
											<div class="submit-sec">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="add" value="Add" /></div>
										</form>
									';
									echo '</div>';			
									
									
								}
								elseif($link=='deletestudents')
								{
									if(!isset($_GET['uid']))
									{
										$query = $db->query("SELECT * FROM user WHERE type='student'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
										
										$username=$row->email;
										$uid=$row->id;	
										echo '<a href="profile.php?link=deletestudents&uid='.$uid.'">'.$username."</a><br />";
										endwhile;
										echo "total Students ".$total;
										echo '</div>';
									}
									if(isset($_GET['uid']))
									{
										$uid = $_GET['uid'];
										$query = $db->query("SELECT * FROM user WHERE id='$uid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
										echo '
										<form action="" method="post">
											<div style="display:none;">Id : <input type="text" value="'.$uid.'" name="uid" /></div>
											<div class="submit-sec"><input type="submit" name="delete" value="Delete" /></div>
										</form>
											';
										echo '</div>';
									}
								}
						
								elseif($link == 'viewteachers'){
									$query = $db->query("SELECT * FROM user WHERE type='teacher'");
									$total = $query->num_rows;
									echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									echo '<h1 class="links-heading">Teachers list</h1>';
									while($row = $query->fetch_object()):
										$email = $row->email;
										$new = $db->query("SELECT * FROM salary WHERE name='$email'");
										$r = $new->fetch_object();
										if($new->num_rows == 0){
											$salary = "no salary record";
										}else{
											$salary= $r->salary;
										}
										echo $email." salary : ".$salary."<br />";
									endwhile;
									echo "Total Teachers ".$total;
									echo '</div>';
								}
								elseif($link=='addteachers')
								{
									echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									echo '
										<form action="" method="post">
											<div class="sec-field">Username : <input type="text" name="username" /></div>
											<div class="sec-field">Password &nbsp: <input type="password" name="password" /></div>
											<div class="sec-field">Salary &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:   <input type="text" name="salary" /> </div>
											<div class="submit-sec">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="add" value="Add" /></div>
										</form>
									';
									echo '</div>';
								}
								elseif($link=='deleteteachers')
								{
									
									if(!isset($_GET['uid']))
									{
										$query = $db->query("SELECT * FROM user WHERE type='teacher'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
										
										$username=$row->email;
										$uid=$row->id;	
										echo '<a href="profile.php?link=deleteteachers&uid='.$uid.'&username='.$username.'">'.$username."</a><br />";
										endwhile;
										echo "Total Teachers ".$total;
										echo '</div>';
									}
									if(isset($_GET['uid']))
									{
										$uid = $_GET['uid'];
										$query = $db->query("SELECT * FROM user WHERE id='$uid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
										echo '
										<form action="" method="post">
											<div style="display:none;">Id : <input type="text" value="'.$uid.'" name="uid" /></div>
											<div class="submit-sec"><input type="submit" name="delete" value="Delete" /></div>
										</form>
											';
										echo '</div>';
									}
									
									
									
									
									
									
									
									
								}
								elseif($link == 'viewnotifications'){
									if(!isset($_GET['nid'])){
										$query = $db->query("SELECT * FROM notifications ");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										echo '<h1 class="links-heading">View  Notifications</h1>';
										while($row = $query->fetch_object()):
											$title = $row->title;
											$subject = $row->subject;
											$nid = $row->id;
											echo '<a href="profile.php?link=viewnotifications&nid='.$nid.'">'.$title." - ".$subject."</a><br />";
										endwhile;
										echo "Total Notifications ".$total;
										echo '</div>';
									}
									if(isset($_GET['nid'])){
										$nid = $_GET['nid'];
										$query = $db->query("SELECT * FROM notifications WHERE id='$nid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
											$title = $row->title;
											$subject = $row->subject;
											$text = $row->notice;
											echo "<h1>".$title."</h1><br />";
											echo "<h3>".$subject."</h3><br />";
											echo $text."<br />";
										echo '</div>';
									}
								}
								elseif($link == 'addnotifications'){
									echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									echo '
										<form action="" method="post">
											<div class="sec-field">Title &nbsp&nbsp&nbsp&nbsp&nbsp  : <input type="text" name="title" /></div>
											<div class="sec-field">Subject : <input type="text" name="subject" /></div>
											<div>Notice :</div>
											<div class="sec-field">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<textarea name="notice"></textarea></div>
											<div class="submit-sec">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="add" value="Add" /></div>
										</form>
									';
									echo '</div>';
								}
								elseif($link == 'editnotifications'){
									if(!isset($_GET['nid'])){
										$query = $db->query("SELECT * FROM notifications ");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
											$title = $row->title;
											$subject = $row->subject;
											$nid = $row->id;
											echo '<a href="profile.php?link=editnotifications&nid='.$nid.'">'.$title." - ".$subject."</a><br />";
										endwhile;
										echo "Total Notifications ".$total;
										echo '</div>';
									}
									if(isset($_GET['nid'])){
										$nid = $_GET['nid'];
										$query = $db->query("SELECT * FROM notifications WHERE id='$nid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
											$title = $row->title;
											$subject = $row->subject;
											$text = $row->notice;
											echo '
											<form action="" method="post">
												<div class="sec-field">Title &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : <input type="text" value="'.$title.'" name="title" /></div>
												<div class="sec-field">Subject &nbsp : <input type="text" value="'.$subject.'" name="subject" /></div>
												<div style="display:none;">Id : <input type="text" value="'.$nid.'" name="nid" /></div>
												<div>Notice :</div>
												<div class="sec-field">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<textarea name="notice">'.$text.'</textarea></div>
												<div class="submit-sec">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" name="edit" value="Edit" /></div>
											</form>
											';
										echo '</div>';
									}
								}
								
								elseif($link == 'deletenotifications'){
									if(!isset($_GET['nid'])){
										$query = $db->query("SELECT * FROM notifications ");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
											$title = $row->title;
											$subject = $row->subject;
											$nid = $row->id;
											echo '<a href="profile.php?link=deletenotifications&nid='.$nid.'">'.$title." - ".$subject."</a><br />";
										endwhile;
										echo "Total Notifications ".$total;
										echo '</div>';
									}
									if(isset($_GET['nid'])){
										$nid = $_GET['nid'];
										$query = $db->query("SELECT * FROM notifications WHERE id='$nid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
										echo '
										<form action="" method="post">
											<div style="display:none;">Id : <input type="text" value="'.$nid.'" name="nid" /></div>
											<div class="submit-sec"><input type="submit" name="delete" value="Delete" /></div>
										</form>
											';
										echo '</div>';
									}
								}
							}
						}
						if($type == 'teacher'){
							if(isset($_GET['link'])){
								$link = $_GET['link'];
								if($link == 'viewstudents'){
									$query = $db->query("SELECT * FROM user WHERE type='student'");
									$total = $query->num_rows;
									echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									while($row = $query->fetch_object()):
										$email = $row->email;
										echo "".$email."<br />";
									endwhile;
									echo "Total Students ".$total;
									echo '</div>';
								}
								elseif($link == 'viewnotifications'){
									if(!isset($_GET['nid'])){
										$query = $db->query("SELECT * FROM notifications ");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
											$title = $row->title;
											$subject = $row->subject;
											$nid = $row->id;
											echo '<a href="profile.php?link=viewnotifications&nid='.$nid.'">'.$title." - ".$subject."</a><br />";
										endwhile;
										echo "Total Notifications ".$total;
										echo '</div>';
									}
									if(isset($_GET['nid'])){
										$nid = $_GET['nid'];
										$query = $db->query("SELECT * FROM notifications WHERE id='$nid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
											$title = $row->title;
											$subject = $row->subject;
											$text = $row->notice;
											echo "<h1>".$title."</h1><br />";
											echo "<h3>".$subject."</h3><br />";
											echo $text."<br />";
										echo '</div>';
									}
								}
								if($link == 'viewsalary'){
									$uuid = $_SESSION['uid'];
									$equery = $db->query("SELECT * FROM user WHERE id='$uuid'");
									$erow = $equery->fetch_object();
									$eemail = $erow->email;
									$iquery = $db->query("SELECT * FROM salary WHERE name='$eemail'");
									$irow = $iquery->fetch_object();
									$iname = $irow->name;
									$salary = $irow->salary;
									echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									if($iquery->num_rows == 0){
										echo '<h1>No Salary Record</h1>';
									}
									if($iquery->num_rows == 1){
										echo '<h1>Name : '.$iname.'<br />Salary : '.$salary.'</h1>';
									}
									echo '</div>';
								}
							}
						}
						if($type == 'student'){
							if(isset($_GET['link'])){
								$link = $_GET['link'];
								if($link == 'viewnotifications'){
									if(!isset($_GET['nid'])){
										$query = $db->query("SELECT * FROM notifications ");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										while($row = $query->fetch_object()):
											$title = $row->title;
											$subject = $row->subject;
											$nid = $row->id;
											echo '<a href="profile.php?link=viewnotifications&nid='.$nid.'">'.$title." - ".$subject."</a><br />";
										endwhile;
										echo "Total Notifications ".$total;
										echo '</div>';
									}
									if(isset($_GET['nid'])){
										$nid = $_GET['nid'];
										$query = $db->query("SELECT * FROM notifications WHERE id='$nid'");
										$total = $query->num_rows;
										echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
										$row = $query->fetch_object();
											$title = $row->title;
											$subject = $row->subject;
											$text = $row->notice;
											echo "<h1>".$title."</h1><br />";
											echo "<h3>".$subject."</h3><br />";
											echo $text."<br />";
										echo '</div>';
									}
								}
								elseif($link == 'viewfees'){
									
									echo '<div style="margin: 0 0 0 200px; padding: 0 40px 0 0; top: 15px; font-size: 17px; left: 15px; position: relative;">';
									$uuid = $_SESSION['uid'];
									$equery = $db->query("SELECT * FROM user WHERE id='$uuid'");
									$erow = $equery->fetch_object();
									$eemail = $erow->email;
									echo '<h1 align="center">'.$eemail.'</h1>';
									echo '<img style="margin-left:250px" src="img/fees.png" width="255 align="center"/>';
									echo '</div>';
								}
							}
						}
					}
				?>
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
