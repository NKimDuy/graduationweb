<?php
	
	session_start();
	$flagPermission = "";
	$flagAddTable = "";
	$flagCreateUser = "";
	$flagSeeTable = "";
	$flagAlterTable = "";
	
	$information_user ="";
	if (isset($_SESSION['user']) and isset($_SESSION['password']) and isset($_SESSION['permission']))
	{
		$flagPermission = $_SESSION['permission'];
		
		if ($flagPermission == "user")
		{
			$flagCreateUser = "none";
		}
		$information_user = $_SESSION['user'];
		
		if (isset($_POST['logout']))
		{
			unset($_SESSION['user']);
			unset($_SESSION['password']);
			unset($_SESSION['permission']);
			header('Location: login.php');
		}
				
	}
	else
	{
		header('Location: login.php');
	}
	
?>
<html lang="en">
<head>

	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- khi vừa gắn bootstrap và vừa dùng jquery tab , thì thẻ script này gắn vô sẽ bị xung đột
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	-->
	
	
</head>
<body>
	<div class="container-fluid">
		<div id="dialog" style="display:none;">
			<ul id="tableList" class="list-group"></ul>
		</div>
		<div class="row">
			<div class="col">
				<button type="submit" style = "display:<?php echo $flagCreateUser; ?>;" class="btn btn-outline-info" id="btnCreateUser">Tạo tài khoản mới</button>
				<button type="submit" class="btn btn-outline-info" id="btnTableList">Các bảng hiện có</button>
				<button type="submit" class="btn btn-outline-info" id="btnAddTable">Thêm một bảng mới từ excel</button>
				<button type="submit" class="btn btn-outline-info" id="btnAlterTable">Thêm, sửa, xóa các dòng của bảng</button>		
			</div>
			<div class="col">
				<div id="accordion">
				<span style = "font-size:20px;"><?php echo $information_user; ?></span><span class="badge badge-light" style = "margin-left:85px;"><img src = "./images/user.png"></span>
				<div>
					<p>Quyền hạn: <span class="text-primary"><?php echo $flagPermission; ?></span></p>
					<div >
						<form method = "post" id = 'form-logout'>
							<button type="submit" class="btn btn-outline-danger" name = "logout" id = "logout">Đăng xuất</button>
						</form>
					</div>
				</div>
			</div>
			</div>
		</div>
		
	</div>
</body>
<script>
	function deleteTable(table) {
		$.post({
			url: "lib/ajax/DeleteTableAjax.php",
			data: {
				'table_name': table
			},
			dataType: "json",
			success: function(res) {
				alert("Đã xóa thành công " + res);
				$("#" + res).remove();
			}
		});
	}
	
	$(document).ready(function() {
		
		$("#btnCreateUser").click(() => {
			 window.location="create_account.php";
		});
		$("#btnAddTable").click(() => {
			 window.location="upload.php";
		});
		$("#btnAlterTable").click(() => {
			 window.location="table.php";
		});
		
		
		$("#btnTableList").click(() => {
			$.get({
				url: "lib/ajax/GetAllTableAjax.php",
				dataType: "json",
				success: function(result){
					var li = "";
					result.forEach(item => {
						li += "<li class='list-group-item d-flex justify-content-between align-items-center' id=" + item.TABLE_NAME + ">" + item.TABLE_NAME + "  <a class='text-light btn btn-primary' href=javascript:deleteTable('" + item.TABLE_NAME + "');>Delete</a>" +"</li>";						
					});
					$("#tableList").html(li);
					$("#dialog").dialog({
						width: 'auto',
						maxWidth: 1000,
						fluid: true,
						my: "center",
						at: "center",
						of: window,
						modal: true, // không cho phép thao tác các vị trí khác khi dialog xuất hiện
						buttons: {
							OK: function() { // hủy thông tin hiển thị của sinh viên cũ
								$( this ).dialog( "destroy" );
							}
						},
						close: function() { // hủy thông tin hiển thị của sinh viên cũ
							$( this ).dialog( "destroy" );
						} 
					});
				}
			});
		});
	});
</script>
</html>