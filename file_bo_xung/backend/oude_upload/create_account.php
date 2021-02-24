<?php
	session_start();
	require_once("db/Config.php");
	if (isset($_SESSION['user']) and isset($_SESSION['success']) and isset($_SESSION['permission']))
	{
		if (($_SESSION['permission'] != 'admin ' . $_SESSION['user']))
		{
			header("Location:" . $conf["root"]);
			//header('Location: home.php');
		}
	}
	else
	{
		header("Location:" . $conf["root"] . "login.php");
		//header('Location: login.php');
	}
?>
<!doctype html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<link href="css/fonts/circular-std/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/fonts/fontawesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="css/tooltipster/tooltipster.bundle.min.css">
	<link rel="stylesheet" href="css/tooltipster/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css">
</head>
<body>
	<!-- ============================================================== -->
	<!-- main wrapper -->
	<!-- ============================================================== -->
	<div class="dashboard-main-wrapper">
		<!-- ============================================================== -->
		<!-- navbar -->
		<!-- ============================================================== -->
		<div class="dashboard-header">
			<?php include 'base/header.php'; ?>
		</div>
		<!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
		<div class="nav-left-sidebar sidebar-dark">
			<?php include 'base/left-sidebar.php'; ?>
		</div>
		<!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
		<div class="dashboard-wrapper">
			<div class="dashboard-ecommerce">
				<div class="container-fluid dashboard-content">
					
					<!-- diaog when successful register -->
					<div id = "dialog" style = "display:none;">
						<p>Đã tạo tài khoản thành công</p>
					</div>
					<!------------------------------------->
						
					<h1 class="text-center text-uppercase text-primary">Đăng kí</h1>
					<form method="post" id = "validate-form">
					
						<div class="form-group">
							<label for="exampleInputFirstName1"  id="regFirstname">Họ<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "firstname" id="firstname">
						</div>
						
						<div class="form-group">
							<label for="exampleInputLastName1" id="regLastname">Tên<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "lastname" id="lastname">
						</div>
						
						<div class="form-group">
							<label for="exampleInputUser1" id="regUser">Tên đăng nhập<span style = "color:red;"> * </span></label>
							<input type="text" class="form-control" name = "user" id="user">
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1"  id="regPassword">Mật khẩu<span style = "color:red;"> * </span></label>
							<input type="password" class="form-control" name = "password" id="password">
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword2" id = "check-account">Nhập lại mật khẩu<span style = "color:red;"> * </span></label>
							<input type="password" class="form-control" name = "passwordConfirm" id="passwordConfirm">
						</div>
						
						<div id = "check-permission"> Quyền hạn:<span style = "color:red;"> * </span> </div>
						
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name = "permission" value="admin">
							<label class="form-check-label" for="inlineCheckbox1">admin</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name = "permission" value="user">
							<label class="form-check-label" for="inlineCheckbox1">user</label>
						</div>
						
						<!--<input type = "hidden" id = "account">-->
						<button type="submit" class="btn btn-primary" name = "create-account" id = "create-account">Tạo tài khoản</button>
						
					</form>
					<!--<a style = "position: absolute; right:0;font-size:30px;" href = "home.php" id = "back-home">Trang chủ</a>-->				
				</div>
			</div>
			<!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
			<div class="footer">
				<?php include 'base/footer.php'; ?>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--<script src="js/main-js.js"></script>-->
	<script src="js/create-account-js.js"></script>
	<script src="js/tooltipster/tooltipster.bundle.min.js" ></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>