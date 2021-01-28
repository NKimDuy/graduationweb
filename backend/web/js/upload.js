
function addslashes(str) { // có nhiệm vụ hiểu dấu nháy đơn trong chuỗi
	return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}

function checkAll() { // chọn hoặc bỏ chọn tất cả các checkbox
	if($("#chkAll").is(':checked')) {
		$("#upload table input:checkbox:not(#chkAll)").prop("checked","checked");
	}
	else {
		$("#upload table input:checkbox:not(#chkAll)").prop("checked",false);
	}
}


$(document).ready(() =>{
	var rowsAddToSql = 0;
	
	var rowsGetByExcel = 0; // các dòng hiện có trong excel
	
	var wb = null; // lưu giữ thông tin workbook nào đang được tương tác
	var sheetName = null; // lấy worksheet tương ứng với workbook
	var range = null; // lấy tất cả các ô có giá trị trong sheet
	
	$('#input-excel').change(function(e){ // khi file excel đã được lấy lên, sau đó sẽ được xử lý
		var reader = new FileReader();
		reader.readAsArrayBuffer(e.target.files[0]);
		reader.onload = function(e) {
			var data = new Uint8Array(reader.result);
			wb = XLSX.read(data,{type:'array'}); // tạo ra workbook từ dataReader vừa load file lên
			// lấy giá trị các ô trong excel
			sheetName = wb.Sheets["Sheet1"]; // lấy sheet có tên là Sheet1
			range = XLSX.utils.decode_range(sheetName['!ref']); // !ref có ý nghĩa là chỉ chọn vùng nào có tồn tại dữ liệu
			var htmlstr = XLSX.write(wb,{sheet:"Sheet1", type:'string', bookType:'html'});  // dữ liêu từ excel đã được lấy lên, sẵn sàng để hiển thị lên
			
		
			
			for(var R = range.s.r; R <= range.e.r; ++R) {
				rowsGetByExcel += 1;
			}
			alert(rowsGetByExcel - 1); // hiện các dòng có trong excel
			
		
			
			//if (flagTitle) { // nếu file excel hợp lệ
				$('#upload')[0].innerHTML += htmlstr;
				$("#upload > table").addClass("table table-hover");
				$("#upload table tr:first-child").prepend("<td><input id='chkAll' type='checkbox'  onclick='checkAll()' /></td>"); // thêm checkbox để check tất cả các dòng
				$("#upload table tr").not("tr:first-child").prepend("<td><input type='checkbox' /></td>"); // thêm checkbox để biểt dòng nào được chọn để thêm
				$("#upload table tr:first-child").css("font-weight","bold");
				//$("#upload table tr").prepend("<td><input type='checkbox' /></td>");
			//}

			// gán ID đến các checkbox tương ứng, bắt đầu là 1
			var input_index = range.s.r + 1;
			$("#upload table input:checkbox").each(function(index, item) {
				if (index != 0) {
					$(item).attr("id",input_index++);
				}
				
			});				
		}
		
	});
	
	
	//$("#upload-form").submit((ev) => {
	$("#btnAdd").click((ev) => {
		//alert('abc');
		ev.preventDefault();
		
		
		
		var errorArray = []; // mảng lưu các dòng không thêm thành công
		
		var rowChecked = 0;
		$("#upload table input:checked:not(#chkAll)").each(function(index, item) {
			rowChecked += 1;
		});
		
		if ($("#upload table").length != 0 && rowChecked > 0)
			$('.progress').css('display', 'grid'); // khi submit thành công sẽ hiện thanh quá trình
		
		$("#upload table input:checked:not(#chkAll)").each(function(index, item) {
			
			var R = $(item).attr("id"); // lấy dòng tương ứng với ID của checkbox
							
			var value_temp = [];
			try {
				for(var C = range.s.c; C <= range.e.c; ++C) {
					var cell_address = {c:C, r:parseInt(R)};
					var cell_ref = XLSX.utils.encode_cell(cell_address);
					
					var desired_cell = sheetName[cell_ref];
					if (desired_cell === undefined)
						desired_cell = "";
					value_temp.push(addslashes(desired_cell.v));
				}
			}
			catch(e) {
				console.log(e.message);
			}
			
			$.post({ 
				url: '/oude/add',
				data: {
					"data": value_temp
				},
				dataType: "json",
				error: function() {
					addRowSuccessfully = false;
				},
				success: function(result) {
					//alert(result);
					
					if (result == true) {
						rowsAddToSql += 1; //số dòng được thêm vào database thành công
					}
					else {
						errorArray.push(result);  // nếu có dòng nào bị lỗi, sẽ được thêm vào màng errorArray
					}
										
					if (errorArray.length + rowsAddToSql == rowChecked) {
						//alert('số dòng không thêm đc: ' + errorArray.length + 'số dòng thêm thành công: ' + rowsAddToSql + 'tổng số dòng đc chọn: ' + rowChecked																										);
						
						$('.progress').css('display', 'none'); // khi duyệt qua hết các dòng đc chọn, sẽ tắt thanh progress bar
						$('#showSuccess ').css('display','block'); // bật thông báo các dòng đc thêm thành công
						$('#showFailed ').css('display','block'); // hiện các dòng thêm thất bại
						if(errorArray.length == 0)
							//alert("Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
							$('#success-notification').text("Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
						else {
							
							var failedRow = 'các dòng không thêm vào được cơ sở dữ liệu:  ';
							errorArray.forEach((item) => {
								failedRow += item + ", ";
							});
							//alert("Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
							//alert(failedRow.substring(0,(failedRow.length-1)));
							$('#success-notification ').text(" Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
							$('#danger-notification ').text(failedRow.substring(0,(failedRow.length-2)));
						}
						
					}
					
					
					
					//if( (rowsAddToSql == rowsGetByExcel - 1 /* khi chọn tất cả */) || (rowsAddToSql == rowChecked /* khi chỉ chọn 1 vài dòng */) ) {
						
					//	$('.progress').css('display', 'none');
					//	alert("Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
					//	//$('#success-notification').text("Đã thêm " + rowsAddToSql + " dòng được đánh dấu vào cơ sở dữ liệu");
					//	$("#upload-form").submit();
					//}
					
				}
			})
			/*.done(function() {
				alert( "$.post succeeded" );
			});*/
			//alert('abc');
		});
		
	});
	
});


