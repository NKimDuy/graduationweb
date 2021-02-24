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
				li += "<li class='list-group-item d-flex justify-content-between align-items-center' id=" + item.TABLE_NAME + ">" + item.TABLE_NAME + "  <a class='text-light btn btn-primary' href=javascript:deleteTable('" + item.TABLE_NAME + "');>Xóa</a>" +"</li>";						
			});
			$("#tableList").html(li);
			
		}
	});
	
});