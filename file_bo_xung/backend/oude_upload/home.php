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
				<div class="container-fluid dashboard-content ">

					<ul id="tableList" class="list-group"></ul>

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
	<script src="js/main-js.js"></script>
	
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
			$.get({
				url: "lib/ajax/GetAllTableAjax.php",
				dataType: "json",
				success: function(result){
					var li = "";
					result.forEach(item => {
						li += "<li class='list-group-item d-flex justify-content-between align-items-center' id=" + item.TABLE_NAME + ">" + item.TABLE_NAME + "  <a class='text-light btn btn-primary' href=javascript:deleteTable('" + item.TABLE_NAME + "');>Delete</a>" +"</li>";						
					});
					$("#tableList").html(li);
					
				}
			});
		});
	</script>
</body>
</html>