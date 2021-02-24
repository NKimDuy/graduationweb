<?php
	session_start();
	require_once("db/Config.php");
	if (isset($_SESSION['user']) and isset($_SESSION['success']) and isset($_SESSION['permission']))
	{
		header("Location:" . $conf["root"]);
	}
	else
	{
		require_once("db/connectDB.php");
		require_once ("db/Config.php");
		require_once ('./lib/htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php');
		$correct = true; // kiểm tra nếu thông tin tài khoản không đúng
		if (isset($_POST['login']))
		{
			$con = Connect();
			
			$username = isset($_POST['User']) ? $_POST['User'] : "";
			$password = isset($_POST['Password']) ? $_POST['Password'] : "";
			
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
			
			$sql = "SELECT user, password, password_backup, permission FROM tb_user WHERE user = '" . $username . "'";
			$query = mysqli_query($con, $sql);
			if ($query)
			{
				$number = mysqli_num_rows($query);
				if ($number > 0)
				{
					$row = mysqli_fetch_assoc($query);
					if (hash_equals($row['password'], crypt($password, $row['password'])) or hash_equals($row['password_backup'], crypt($password, $row['password_backup'])))
					{
						$_SESSION['user'] = $row['user'];
						$_SESSION["success"] = "success " . $row['user'];
						$_SESSION['permission'] = $row['permission'] . " " . $row['user']; // để phân biệt các người dùng với nhau
						header("Location:" . $conf["root"]);
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

	
	<link rel="stylesheet" href="css/fonts/fontawesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="css/login.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form method="post" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input type="text" class="input100" id="User" name = "User" aria-describedby="emailHelp" placeholder="Enter User">
						<!--<span class="focus-input100" data-placeholder="&#xe82a;"></span>-->
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input type="password" class="input100" id="Password" name = "Password" placeholder="Password">
						<!--<span class="focus-input100" data-placeholder="&#xe80f;"></span>-->
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button type="submit" class="login100-form-btn" id = "login" name = "login">Login</button>
						
					</div>

				</form>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	
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
</body>
</html>
<?php } ?>