<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<!-- boostrap 4 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!---->
	</head>
	<body>
		<div class="container-fluild">
			<div class="row">
				<div class="col">
					<h1>Các bảng hiện có trong cơ sở dữ liệu</h2>
					<ul id="tableList"></ul>
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
					alert(res);
				},
				complete: function(result) {
					alert(result);
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
						li += "<li>" + item.TABLE_NAME + "<a href=javascript:deleteTable('" + item.TABLE_NAME + "');>Delete</a>" +"</li>";
						//li += item.TABLE_NAME;
					});
					$("#tableList").html(li);
				}
			});
		});
	</script>
</html>