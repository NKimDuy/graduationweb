<?php
	session_start();
	if (isset($_SESSION['user_account']) and isset($_SESSION['password_account']))
	{
		header("Location: home.php");
	}
	else
	{
		require_once './lib/htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php';
		$correct = true; // kiểm tra nếu thông tin tài khoản không đúng
		if (isset($_POST['login']))
		{
			$con = mysqli_connect("localhost", "root", "nkDuy1998", "duy");
			
			$username = isset($_POST['User']) ? $_POST['User'] : "";
			$password = isset($_POST['User']) ? $_POST['Password'] : "";
			
			//********************************************************\\
			$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
			$replacement = "";
			$username = preg_replace($patterm, $replacement, $username);
			$password = preg_replace($patterm, $replacement, $password);
			
			$config = HTMLPurifier_Config::createDefault();
			$purifier = new HTMLPurifier($config);
			$username = $purifier->purify(trim(preg_replace('/\s+/mu', ' ', $username)));
			$password = $purifier->purify(trim(preg_replace('/\s+/mu', ' ', $password)));
			//********************************************************\\
			
			$sql = "SELECT user_account, password_account, password_backup, group_user FROM tb_user WHERE user_account = '" . $username . "'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
				if ($number > 0)
				{
					$row = mysqli_fetch_assoc($query);
					if (hash_equals($row['password_account'], crypt($password, $row['password_account'])) or hash_equals($row['password_backup'], crypt($password, $row['password_backup'])))
					{
						$_SESSION['user_account'] = $row['user_account'];
						$_SESSION['password_account'] = $row['password_account'];
						$_SESSION['group_user'] = $row['group_user'];
						header('Location: home.php');
					}
					else
					{
						$correct = false;
					}
				}
				else
				{
					$correct = false;
				}
				
			}
		}
	
?>
<html lang="en">
<head>

	<title>login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<style>
		.row {
			height: 810px;
		}
	</style>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script language = "javascript">
		$(document).ready(function() {
			
			$("#validate-form").submit(function() {
				if ($("#User").val() == "" || $("#Password").val() == "" ) {
					alert("Bạn chưa nhập tài khoản hay mật khẩu");
					return false;
				}
			});
			var correct = "<?php echo $correct; ?>";
			if (correct == false) {
				alert("Tài khoản hoặc mật khẩu không đúng!!");
			}
			
			
		});
	</script>
</head>
<body>
	<div class = "container">
		<!--<div class="row align-items-center">
			<div class="col align-self-center">
				some thing !!!!
			</div>
		</div>-->
		
		<div class = "row justify-content-center">
			<div class = "col-4 align-self-center p-3 mb-2 bg-info text-white">
				<img src = "./images/oude.png" alt = "OUDE">
				<div class="text-center font-weight-normal font-weight-bold">ĐĂNG NHẬP</div>
				<form method = "post" id = "validate-form">
					<div class="form-group">
						<input type="text" class="form-control" id="User" name = "User" aria-describedby="emailHelp" placeholder="Enter User">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="Password" name = "Password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary btn-lg btn-block" id = "login" name = "login">ĐĂNG NHẬP</button>
				</form>
			</div>
		</div>
		
	</div>
</body>
</html>
<?php } ?>