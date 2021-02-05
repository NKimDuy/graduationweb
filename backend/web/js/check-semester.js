
function test() {
	alert('abc');
}

function createTableDetailStudent(mssv, username, semester) { // khi sinh viên tiến hành tìm kiếm thông tin, nếu submit thành công thì sẽ hiển thị các thông tin tương ứng
	
	$.ajax({
		method: "POST",
		url: "/oude/create",
		dataType: "JSON",
		data: {
			'mssv': mssv,
			'username': username,
			'semester': semester
		},
		success: function(result){
			//alert(JSON.stringify(result.errors));
			//
			//alert($('.help-block').text());
			if ($('#mssv').val() == "" && $('#username').val() == "") { // nếu không nhập mssv hoặc họ tên
				alert('Mã số sinh viên hoặc họ tên không được trống');
				
			}
			else {
				$('.progress').css('display', 'grid'); // khi submit thành công sẽ hiện thanh quá trình
				
				var table = '<table class="table table-striped display" id = "result1" style="width:100%;" >';
				
				table += '<thead>';
				table += '<tr>';
				table += '<th>MÃ SỐ SINH VIÊN</th>';	
				table += '<th>HỌ</th>';
				table += '<th>TÊN</th>';
				table += '<th>HỌC KÌ</th>';
				table += '<th></th>';
				table += '</tr>';
				table += '</thead>';
				
				table += '<tbody>';
				$.each(result.allStudentInSemester, function(index, item) {
					table += '<tr>';
					table += '<td class="align-middle">' + item[0] + '</td>';
					table += '<td class="align-middle">' + item[1] + '</td>';
					//table += '<td class="align-middle">' + item[2] + '</td>';
					//table += '<td class="align-middle">' + item[3] + '</td>';
					//table += '<td class="align-middle">' + item[5] + '</td>';
					table += '<td class="align-middle">' + '<i onclick="test()" class="fas fa-edit" style="font-size: re;"></i>' + ' | ' + '<i class="fas fa-trash-alt" style="font-size: re;"></i>' + '</td>';
					//table += '<td class="align-middle">' + "<img src = '/images/edit.png' style='width:10%;' />" + "<img src = '/images/delete.png' style='width:10%;' />" + '</td>';
					
					//nhét 2 cái hình vô đây
					
					
					table += '</tr>';
					
				});
				table += '</tbody>';
					
				table += '</table>';
				
				$('.progress').css('display', 'none'); // khi hoàn tất quá trình đẩy dữ liệu, thì thanh progress bar sẽ biến mất
				
				//$('#find-table').css('display','none'); // ẩn bảng tìm kiếm khi tìm thấy thông tin sinh viên
				
				$('#displayStudent').html(table); // thêm table sinh viên vừa tạo vào vùng div có id là 'displayStudent'
				
				//$('#imgHome').css('display','block'); // hiện image home để quay lại giao diện tìm kiếm 
			}
		}
	});
}


$(document).ready(function() {
	
	//$('.help-block').css('color','red');
	
	$('#mssv').focus(); // khi trang web vừa đc load lên thì input mssv sẽ được focus
	
	$("#semesterlist").prepend('<option value="all" selected>Xem tất cả</option>'); // thêm lựa chọn xem tất cả các học kì
	
	/*
	$('#imgHome').click(() => {
		$('#find-table').css('display','flex');
		$('#displayStudent > table').remove();
		
		$('#imgHome').css('display','none');
	});
	*/
	
	$('#result1').DataTable({
		language: {
			"lengthMenu": "Hiển thị _MENU_ mẫu tin trên 1 trang",
			"zeroRecords": "Ứng dụng không tìm thấy thông tin sinh viên",
			"info": "Đang hiển thị trang _PAGE_ trong tổng số _PAGES_ trang",
			"infoEmpty": "No records available",
			"infoFiltered": "(Danh sách được lọc từ _MAX_ mẫu tin)",
			"search": "Tìm kiếm:",
			"paginate": {
				"first": "Trang đầu",
				"last": "Trang cuối",
				"next": "Trang tiếp theo",
				"previous": "Trang trước"
			}
		},
		fixedHeader: {
			header: true,
			footer: true
		}
	});
	
	$("#mssv").tooltipster({ // hiện hướng dẫn khi rê chuột lên các input tìm kiếm
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#username").tooltipster({
		theme: "tooltipster-light"
	});
	
	$("#login-form").submit((e) => {	
		//$('#login-form').submit();
		e.preventDefault();
		createTableDetailStudent($('#mssv').val(), $('#username').val(), $('#semesterlist').val());
		
		
		//e.preventDefault();
	
	});
});