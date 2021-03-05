
function editStudent(data) { // gửi những dữ liệu mới để cập nhật  // chưa xử lý được kiểm tra ngoại lệ cho trường họ và tên
	$.ajax({
		method: "POST",
		url: '/oude/get-data-to-edit',
		dataType: "json", // dữ liệu nhận về dạng json
		data: { // dữ liệu được gửi đến file xử lý
			'data': data
		},
		success: function (result){
				
			//alert('thông tin sinh viên đã được chỉnh sửa');
			//alert(result.errors);
			/*
			var temp = result.errors;
			temp.forEach((item) => {
				alert(item);
			});
			*/
		}
	});
}


function deleteStudent(mssv, hk) { // hàm xóa sinh viên
	$("#dialogToDelete").dialog({ // tạo dialog
				width: 'auto',
				height: 'auto',
				maxWidth: 1000,
				fluid: true,
				my: "center",
				at: "center",
				of: window,
				modal: true, // không cho phép thao tác các vị trí khác khi dialog xuất hiện
				buttons: {
					"Xóa": function() { // khi nhấn vào button sửa, sẽ gom dữ liệu gửi sang oudeController để tiến hành edit
						
						$.ajax({
							method: "POST",
							url: '/oude/get-data-to-delete',
							dataType: "json", // dữ liệu nhận về dạng json
							data: { // dữ liệu được gửi đến file xử lý
								'mssv': mssv,
								'hk': hk
							},
							success: function (result){
								if (result.checkIfDeleteSuccess) {
									
									$('tr[id=' + mssv + '-' + hk + ']').remove();
									alert('Đã xóa thành công ');
								}
								else
									alert('Xóa thất bại');
								
							}
						});
						
						$( this ).dialog( "destroy" );
					},
					"Hủy": function() {
						$( this ).dialog( "destroy" );
					}
				},
				close: function() { // hủy thông tin hiển thị của sinh viên cũ
					$( this ).dialog( "destroy" );
				}
			});
	
	
	
}

function showStudentToEdit(mssv, hk) { // hiên thị dialog thông tin của 1 sinh viên
	$.ajax({
		url: '/oude/show-detail-to-edit',
		dataType: "json", // dữ liệu nhận về dạng json
		data: { // dữ liệu được gửi đến file xử lý
			'mssv': mssv,
			'hk': hk
		},
		success: function (result){
			$('#mssv-edit').val(result[14]);
			$('#ho').val(result[15]);
			$('#ten').val(result[16]);
			$('#datepicker').val(result[17]);
			$('#gioiTinh option').val(result[18]);
			$('#danToc option').val(result[2]);
			$('#noiSinh option').val(result[19]);
			$('#quocTich option').val(result[3]);
			$('#dvlk option').val(result[1]);
			$('#nganh option').val(result[4]);
			$('#htdt option').val(result[10]);
			$('#diem').val(result[11]);
			$('#xepLoai').val(result[12]);
			$('#dktn option').val(result[13]);
			$('#giayKs option').val(result[5]);
			$('#bangCap').val(result[6]);
			$('#hinh option').val(result[7]);
			$('#phieuDkxcb option').val(result[8]);
			$('#ctdt option').val(result[9]);
			
			$("#dialogEdit").dialog({ // tạo dialog
				width: 'auto',
				height: 700,
				maxWidth: 1000,
				fluid: true,
				my: "center",
				at: "center",
				of: window,
				modal: true, // không cho phép thao tác các vị trí khác khi dialog xuất hiện
				buttons: {
					"Sửa": function() { // khi nhấn vào button sửa, sẽ gom dữ liệu gửi sang oudeController để tiến hành edit
						//alert('abc');
						var data = [];
						data.push($('#mssv-edit').val());
						data.push($('#ho').val());
						data.push($('#ten').val());
						data.push($('#datepicker').val());
						data.push($('#gioiTinh').val());
						data.push($('#danToc').val());
						data.push($('#noiSinh').val());
						data.push($('#quocTich').val());
						data.push($('#dvlk').val());
						data.push($('#nganh').val());
						data.push($('#htdt').val());
						data.push($('#diem').val());
						data.push($('#xepLoai').val());
						data.push($('#dktn').val());
						data.push($('#giayKs').val());
						data.push($('#bangCap').val());
						data.push($('#hinh').val());
						data.push($('#phieuDkxcb').val());
						data.push($('#ctdt').val());
						data.push(hk);
						
						editStudent(data);
						
						$( this ).dialog( "destroy" );
					},
					"Hủy": function() {
						$( this ).dialog( "destroy" );
					}
				},
				close: function() { // hủy thông tin hiển thị của sinh viên cũ
					$( this ).dialog( "destroy" );
				}
			});
		}
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
				
			}
			else {
				//alert(JSON.stringify(result.allStudentInSemester));
				
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
					table += '<tr id= ' + item[0] + '-' + item[4] + '>';
					table += '<td class="align-middle">' + item[0] + '</td>';
					table += '<td class="align-middle">' + item[1] + '</td>';
					table += '<td class="align-middle">' + item[2] + '</td>';
					table += '<td class="align-middle">' + item[3] + '</td>';
					//table += '<td class="align-middle">' + item[5] + '</td>';
					
					table += '<td class="align-middle">' + 
					'<i onclick="showStudentToEdit(' + "'" + item[0] + "', '" + item[4] + "'" + ')" class="fas fa-edit" style="font-size: re;"></i>' + ' | ' + 
					'<i onclick="deleteStudent(' + "'" + item[0] + "', '" + item[4] + "'" + ')" class="fas fa-trash-alt" style="font-size: re;"></i>' + ' | ' + 
					//'<i class="fas fa-trash-alt" style="font-size: re;"></i>' + 
					'</td>';
					//table += '<td class="align-middle">' + '<i onclick="test()" class="fas fa-edit" style="font-size: re;"></i>' + ' | ' + '<i class="fas fa-trash-alt" style="font-size: re;"></i>' + '</td>';
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
	
	$("#datepicker").datepicker({
		 monthNamesShort: [ "01", "02", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12" ],
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		
		changeYear: true,
		yearRange: "1950:2000"
	});
	
	
	
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
		
		
		
	
	});
});