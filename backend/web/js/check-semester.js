function detailStudent(mssv, hk) {  // khi sinh viên có chọn đơt tốt nghiệp
	$(document).ready(function() {
		
	
		$.ajax({
			url: '/oude/detail-for-one-semester',
			dataType: "json", // dữ liệu nhận về dạng json
			data: { // dữ liệu được gửi đến file xử lý
				'mssv': mssv,
				'hk': hk
			},
			success: function (result){
				
				$("#dialog").attr("title", "Thông tin sinh viên " + result[15] + " " + result[16] + " (" + result[14] + ")");
				var table = "<table class='table table-hover table-striped' id = 'result1'>";
			
				table += "<tr>";
				table += "<th class = 'align-middle'>MÃ ĐƠN VỊ LIÊN KẾT</th>";
				table += "<td class = 'align-middle'>" + result[0] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>TÊN ĐƠN VỊ LIÊN KẾT</th>";
				table += "<td class = 'align-middle'>" + result[1] + "</td>";
				table += "</tr>";
			
				table += "<tr>";
				table += "<th class = 'align-middle'>DÂN TỘC</th>";
				table += "<td class = 'align-middle'>" + result[2] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>QUỐC TỊCH</th>";
				table += "<td class = 'align-middle'>" + result[3] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>NGÀNH ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[4] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>GIẤY KHAI SINH</th>";
				table += "<td class = 'align-middle'>" + result[5] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>BẰNG CẤP</th>";
				table += "<td class = 'align-middle'>" + result[6] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>HÌNH</th>";
				table += "<td class = 'align-middle'>" + result[7] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>PHIẾU ĐĂNG KÍ XÉT CẤP BẰNG</th>";
				table += "<td class = 'align-middle'>" + result[8] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>CHƯƠNG TRÌNH ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[9] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>HÌNH THỨC ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[10] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>ĐIỂM TRUNG BÌNH</th>";
				table += "<td class = 'align-middle'>" + result[11] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>XẾP LOẠI</th>";
				table += "<td class = 'align-middle'>" + result[12] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>ĐIỀU KIỆN TỐT NGHIỆP</th>";
				if (result[13] == "Chưa đủ điều kiện") {
					table += '<td class="align-middle"><span style = "font-size: 15px;" class = "badge badge-danger">' + result[13] + '</span></td>';
				}
				else {
					table += "<td class = 'align-middle'><span style='font-size: 15px;' class = 'badge badge-success'>" + result[13] + "</span></td>";
				}
				table += "</tr>";
				table += "</table>";
				
				$("#dialog").html(table); // add bảng vào dialog
				
				$( "#dialog" ).dialog({ // tạo dialog
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
}

function detailStudentAllSemester(mssv, hk) { // khi sinh viên không chọn đợt tốt nghiệp, thì sẽ hiện tất cả học kì có sinh viên đó, sau đó sinh viên nhấn vô từng học kì cụ thể để xem
	$(document).ready(function() {
		$.ajax({
			url: '/oude/detail-for-all-semester',
			dataType: "json", // dữ liệu nhận về dạng json
			data: { // dữ liệu được gửi đến file xử lý
				'mssv': mssv,
				'hk': hk
			},
			success: function (result){
				//alert(JSON.stringify(result));
				
				$("#dialog").attr("title", "Thông tin sinh viên " + result[15] + " " + result[16] + " (" + result[14] + ")");
				var table = "<table class='table table-hover table-striped' id = 'result1'>";
			
				table += "<tr>";
				table += "<th class = 'align-middle'>MÃ ĐƠN VỊ LIÊN KẾT</th>";
				table += "<td class = 'align-middle'>" + result[0] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>TÊN ĐƠN VỊ LIÊN KẾT</th>";
				table += "<td class = 'align-middle'>" + result[1] + "</td>";
				table += "</tr>";
			
				table += "<tr>";
				table += "<th class = 'align-middle'>DÂN TỘC</th>";
				table += "<td class = 'align-middle'>" + result[2] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>QUỐC TỊCH</th>";
				table += "<td class = 'align-middle'>" + result[3] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>NGÀNH ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[4] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>GIẤY KHAI SINH</th>";
				table += "<td class = 'align-middle'>" + result[5] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>BẰNG CẤP</th>";
				table += "<td class = 'align-middle'>" + result[6] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>HÌNH</th>";
				table += "<td class = 'align-middle'>" + result[7] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>PHIẾU ĐĂNG KÍ XÉT CẤP BẰNG</th>";
				table += "<td class = 'align-middle'>" + result[8] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>CHƯƠNG TRÌNH ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[9] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>HÌNH THỨC ĐÀO TẠO</th>";
				table += "<td class = 'align-middle'>" + result[10] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>ĐIỂM TRUNG BÌNH</th>";
				table += "<td class = 'align-middle'>" + result[11] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>XẾP LOẠI</th>";
				table += "<td class = 'align-middle'>" + result[12] + "</td>";
				table += "</tr>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'>ĐIỀU KIỆN TỐT NGHIỆP</th>";
				if (result[13] == "Chưa đủ điều kiện") {
					table += '<td class="align-middle"><span style = "font-size: 15px;" class = "badge badge-danger">' + result[13] + '</span></td>';
				}
				else {
					table += "<td class = 'align-middle'><span style='font-size: 15px;' class = 'badge badge-success'>" + result[13] + "</span></td>";
				}
				table += "</tr>";
				table += "</table>";
				
				$("#dialog").html(table); // add bảng vào dialog
				
				$( "#dialog" ).dialog({ // tạo dialog
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
}

function studentAllSemester(mssv) { // khi sinh viên không chọn cụ thể đợt tốt nghiệp

	$(document).ready(function() {
		
	
		$.ajax({
			url: '/oude/student-all-semester',
			dataType: "json", // dữ liệu nhận về dạng json
			data: { // dữ liệu được gửi đến file xử lý
				'mssv': mssv
			},
			success: function (result){
				//alert(JSON.stringify(result));
				
				$("#dialog").attr("title", "Thông tin sinh viên ");
				var table = "<table class='table table-hover table-striped' id = 'result1'>";
				
				table += "<tr>";
				table += "<th class = 'align-middle'> Đợt tốt nghiệp </th>";
				table += "<th class = 'align-middle'> Tình trạng </th>";
				table += "<th>  </th>";
				table += "</tr>";
				
				result.studentSemes.forEach((itemStudentSemester, index) => { // lấy tất cả hiện trạng hiện có của sinh viên 
					
					const itemGraduationSemester = result.graduationSemes[index]; // lấy đúng học kì theo từng hiện trạng của sinh viên
					
					table += "<tr>";
					table += "<td class = 'align-middle'>" + itemGraduationSemester['chi_tiet_hk'] + "</td>"; 
					
					if (itemStudentSemester['dk_tn'] == "Chưa đủ điều kiện") {
						table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-danger'>" + itemStudentSemester['dk_tn'] + "</span></td>";
					}
					else {
						table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-success'>" + itemStudentSemester['dk_tn'] + "</span></td>";
					}
					
					var detail = "javascript:detailStudentAllSemester('" + itemStudentSemester['mssv'] + "', '" + itemStudentSemester['ma_hk'] +"');";
					table += "<td><a class='btn btn-outline-primary float-right' id = 'detail' href = " + '"' + detail + '"' + ">Xem chi tiết</a></td>";
					table += "</tr>";
				});
				
				table += "</table>";
				
				$("#dialog").html(table); // add bảng vào dialog
				
				$( "#dialog" ).dialog({ // tạo dialog
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
				//$('.help-block').text($('.help-block').text() + ', ' + 'Mã số sinh viên hoặc họ tên không được trống');
			}
			//else if($('.help-block').text() == "") { // nếu người dùng nhập đúng captcha , thì div báo lỗi sẽ trống
			
				//alert("every thing success");
				
				$('.progress').css('display', 'grid'); // khi submit thành công sẽ hiện thanh quá trình
				
				var table = '<table class="table table-striped display" id = "result1" style="width:100%;" >';
				
				table += '<thead>';
				table += '<tr>';
				table += '<th>MÃ SỐ SINH VIÊN</th>';	
				table += '<th>HỌ</th>';
				table += '<th>TÊN</th>';
				table += '<th>HỌC KÌ</th>';
				
				table += '</tr>';
				table += '</thead>';
				
				table += '<tbody>';
				$.each(result.allStudentInSemester, function(index, item) {
					table += '<tr>';
					table += '<td class="align-middle">' + item[0] + '</td>';
					table += '<td class="align-middle">' + item[1] + '</td>';
					table += '<td class="align-middle">' + item[2] + '</td>';
					table += '<td class="align-middle">' + item[3] + '</td>';
					
					//nhét 2 cái hình vô đây
					
					
					table += '</tr>';
					
				});
				table += '</tbody>';
					
				table += '</table>';
				
				$('.progress').css('display', 'none'); // khi hoàn tất quá trình đẩy dữ liệu, thì thanh progress bar sẽ biến mất
				
				$('#find-table').css('display','none'); // ẩn bảng tìm kiếm khi tìm thấy thông tin sinh viên
				
				$('#displayStudent').html(table); // thêm table sinh viên vừa tạo vào vùng div có id là 'displayStudent'
				
				$('#imgHome').css('display','block'); // hiện image home để quay lại giao diện tìm kiếm 
				
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