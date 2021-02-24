<?php
	session_start();
	require_once "./db/connectDB.php";
	require_once 'lib/htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php';
	if (isset($_SESSION['user_account']) and isset($_SESSION['password_account']) and isset($_SESSION['group_user']))
	{
		if (($_SESSION['group_user'] == 'admin'))
		{
			if (isset($_POST['create-account']))
			{
				$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
				$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
				$user = isset($_POST['user']) ? $_POST['user'] : "";
				$password = isset($_POST['password']) ? $_POST['password'] : "";
				$permission = isset($_POST['permission']) ? $_POST['permission'] : "";
				
				//    dùng regular expression để tránh sql injection    \\
				$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
				$replacement = "";
				$firstname = preg_replace($patterm, $replacement, $firstname);
				$lastname = preg_replace($patterm, $replacement, $lastname);
				$user = preg_replace($patterm, $replacement, $user);
				$password = preg_replace($patterm, $replacement, $password);
				//*********************************************************\\
				
				// dùng html purifier để tránh người dùng chèn mã javascript \\
				$config = HTMLPurifier_Config::createDefault();
				$purifier = new HTMLPurifier($config);
				$firstname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $firstname)));
				$lastname = $purifier->purify(trim(preg_replace('/\s+/mu', '', $lastname)));
				$user = $purifier->purify(trim(preg_replace('/\s+/mu', '', $user)));
				$password = $purifier->purify(trim(preg_replace('/\s+/mu', '', $password)));
				//*********************************************************\\
				
				
				$con = Connect();//$con = mysqli_connect("localhost", "root", "nkDuy1998", "duy");
				/*
				if ($permission == 'admin')
				{
					$insert = "INSERT INTO tb_user(user_account, password_account, password_backup, first_name, last_name, group_user) VALUES ('" . $user . "', '" . crypt($password, "1998nk!Duy@@$") . "', '" . crypt('1TtDttx!',"1998nk!Duy@@$") . "', '" . $firstname . "', '" . $lastname ."', 'admin')";
					$query = mysqli_query($con, $insert);
				}
				*/
				if ($permission == 'create')
				{
					$insert = "INSERT INTO tb_user(user_account, password_account, password_backup, first_name, last_name, group_user) VALUES ('" . $user . "', '" . crypt($password, "1998nk!Duy@@$") . "', '" . crypt('1TtDttx!',"1998nk!Duy@@$") . "', '" . $firstname . "', '" . $lastname ."', 'create')";
					$query = mysqli_query($con, $insert);
				}
				elseif ($permission == 'watch')
				{
					$insert = "INSERT INTO tb_user(user_account, password_account, password_backup, first_name, last_name, group_user) VALUES ('" . $user . "', '" . crypt($password, "1998nk!Duy@@$") . "', '" . crypt('1TtDttx!',"1998nk!Duy@@$") . "', '" . $firstname . "', '" . $lastname ."', 'watch')";
					$query = mysqli_query($con, $insert);
				}
				
				
			}
		}
		else
		{
			header('Location: home.php');
		}
	}
	else
	{
		header('Location: login.php');
	}
?>

<!doctype html>
<html lang = "en">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
	<title>CREATE ACCOUNT</title>
	<head>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		<script language = "javascript">
			$(document).ready(function() {
				$.get({
					url: "./lib/login/FindExitAccount.php",
					dataType: "json",
					success: function(result) {
						var tmp = "";
						for (var i = 0 ; i < result.length ; i++) {
							tmp += result[i]['user_account'] + " ";
						}
						$("#account").val(tmp);
					}
				});
				
				
				$("#create-account").click(function() {
				//$("#validate-form").submit(function() {
					var user = $("#user").val(),
						password = $("#password").val(),
						password2 = $("#password2").val(),
						firstname = $("#firstname").val(),
						lastname = $("#lastname").val(),
						permission = $("input[name='permission']:checked").val();
					
					var result = $("#account").val().trim().split(" ");
					var flag = true;
					for (var i = 0 ; i < result.length ; i++) {
						if (user == result[i]) {
							flag = false;
						}
					}
					
					if (firstname == "") {
						var interval_obj = setTimeout(function(){
						$("#firstname").css('border', '3px solid red');
						}, 20);
						$('#firstname').fadeOut(1000,function(){
							$(this).css('border', '1px solid #ced4da');
						});
						$('#firstname').fadeIn();
						//alert("chưa nhập họ!!!");
						return false;
					}
					else if(lastname == "") {
						var interval_obj = setTimeout(function(){
						$("#lastname").css('border', '3px solid red');
						}, 20);
						$('#lastname').fadeOut(1000,function(){
							$(this).css('border', '1px solid #ced4da');
						});
						$('#lastname').fadeIn();
						//alert("chưa nhập tên!!!");
						return false;
					}
					else if(user == "") {
						var interval_obj = setTimeout(function(){
						$("#user").css('border', '3px solid red');
						}, 20);
						$('#user').fadeOut(1000,function(){
							$(this).css('border', '1px solid #ced4da');
						});
						$('#user').fadeIn();
						//alert("chưa nhập tài khoản!!!");
						return false;
					}
					else if(password == "") {
						var interval_obj = setTimeout(function(){
						$("#password").css('border', '3px solid red');
						}, 20);
						$('#password').fadeOut(1000,function(){
							$(this).css('border', '1px solid #ced4da');
						});
						$('#password').fadeIn();
						//alert("chưa nhập mật khẩu!!!");
						return false;
					}
					else if(password2 == "") {
						var interval_obj = setTimeout(function(){
						$("#password2").css('border', '3px solid red');
						}, 20);
						$('#password2').fadeOut(1000,function(){
							$(this).css('border', '1px solid #ced4da');
						});
						$('#password2').fadeIn();
						//alert("chưa nhập mật khẩu!!!");
						return false;
					}
					else if(permission == null) {
						$("#check-permission").append("<span id = 'incorrect' style = 'color:red;'>Chưa cấp quyền !!!</span>");
						var interval_obj = setTimeout(function(){
							$("#incorrect").remove();
						}, 1000);
						//alert("chưa cấp quyền!!!");
						return false;
					}
					else if(password != password2) {
						//alert("Mật khẩu nhập lại không đúng!!!");
						$("#check-account").append("<span id = 'incorrect' style = 'color:red;'>Mật khẩu không trùng khớp !!!</span>");
						var interval_obj = setTimeout(function(){
							$("#incorrect").remove();
						}, 1000);
						return false;
					}
					else if (!flag) {
						alert("Đã tồn tại tài khoản!!!");
						return false;
					}
					else {
						alert("Tạo tài khoản thành công");
					}
				});
			});
		</script>
	<head>
	<body>
		<div id = "dialog" style = "display:none;">
			<p>Đã tạo tài khoản thành công</p>
		</div>
		<div class="container">
			<div class="row justify-content-md-center" style=  "height: 55em;">
				<div class="col-6 align-self-center" style = "border: 1px solid #007bff;border-radius:10px;">
					<div class="text-center text-uppercase text-primary">Đăng kí</div>
					<form method = "post" id = "validate-form">
						<div class="form-group">
							<label for="exampleInputFirstName1">Họ<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "firstname" id="firstname">
						</div>
						<div class="form-group">
							<label for="exampleInputLastName1">Tên<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "lastname" id="lastname">
						</div>
						<div class="form-group">
							<label for="exampleInputUser1">Tên đăng nhập<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "user" id="user">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Mật khẩu<span style = "color:red;"> * </span></label>
							<input type="password" class="form-control" name = "password" id="password">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword2" id = "check-account">Nhập lại mật khẩu<span style = "color:red;"> * </span></label>
							<input type="password" class="form-control" name = "password2" id="password2">
						</div>
						<div id = "check-permission"> Quyền hạn:<span style = "color:red;"> * </span> </div>
						
						<!--	
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name = "permission" id="admin" value="admin">
							<label class="form-check-label" for="inlineCheckbox1">Admin</label>
						</div>
						-->
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name = "permission" id="create" value="create">
							<label class="form-check-label" for="inlineCheckbox1">Tạo và xem CSDL</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name = "permission" id="watch" value="watch">
							<label class="form-check-label" for="inlineCheckbox1">Chỉ được xem CSDL</label>
						</div>
						
						<input type = "hidden" id = "account">
						<button type="submit" class="btn btn-primary" name = "create-account" id = "create-account">Tạo tài khoản</button>
						
					</form>
					<a style = "position: absolute; right:0;font-size:30px;" href = "home.php" id = "back-home">Trang chủ</a>
				</div>
			</div>
		</div>
	</body>
</html>
