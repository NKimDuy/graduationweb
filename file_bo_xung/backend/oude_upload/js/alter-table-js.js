function updateTips(text) { // cập nhập trạng thái khi có lỗi xảy ra
	$(".error") // chọn seletor có lớp là error
	.text(text)
	.addClass("ui-state-highlight");
	setTimeout(function() {
		element.removeClass("ui-state-highlight", 1500);
	}, 500 );
}

function checkLength(element, column, min, max) { // kiểm tra độ dài của trường dữ liệu nhập vào
	if ( element.val().length > max || element.val().length < min ) {
		element.addClass("ui-state-error");
		updateTips("độ dài  " + column + " phải nằm trong khoảng " +
		min + " đến " + max + ".");
		return false;
	} else {
		return true;
	}
}

function checkRegexp( element, regexp, errorMessage ) { // kiểm tra định dạng của trường nhập vào có hợp lệ không
	if ( !( regexp.test(element.val()))) { // text trả về true nếu chuỗi trùng khớp
		element.addClass("ui-state-error");
		updateTips(errorMessage);
		return false;
	} else {
		element.removeClass("ui-state-error");
		return true;
	}
}

function regexpForCreateUpdate(strUrl, dialogId) { // hàm dùng chung cho cập nhập và tạo mới dòng, sẽ kiểm tra và gửi dữ liệu sang file php
	var data = [];
	var valid = true;
	valid = valid && checkLength($("#txtMadvlk"),"Mã đơn vị liên kết", 1, 15);
	valid = valid && checkLength($("#txtTendvlk"),"Tên đơn vị liên kết", 1, 500);
	valid = valid && checkLength($("#txtMssv"),"Mã số sinh viên", 1, 15);
	valid = valid && checkLength($("#txtHo"),"Họ", 1, 50);
	valid = valid && checkLength($("#txtTen"),"Tên", 1, 15);
	valid = valid && checkLength($("#txtNgaySinh"),"ngày sinh", 1, 10);
	valid = valid && checkLength($("#txtNoiSinh"),"Nơi sinh", 1, 50);
	valid = valid && checkLength($("#txtDanToc"),"Dân tộc", 1, 15);
	valid = valid && checkLength($("#txtQuocTich"),"Quốc tịch", 1, 50);
	valid = valid && checkLength($("#txtNganhDaoTao"),"Ngành đào tạo", 1, 100);
	valid = valid && checkLength($("#txtGiayKhaiSinh"),"Giấy khai sinh", 1, 50);
	valid = valid && checkLength($("#txtBangCap"),"Bằng cấp", 1, 50);
	valid = valid && checkLength($("#txtHtdt"),"Hình thức đào tạo", 1, 50);
	valid = valid && checkLength($("#txtDiem"),"Điểm", 1, 50);
	valid = valid && checkLength($("#txtXepLoai"),"Xếp loại", 1, 50);
	valid = valid && checkLength($("#txtHoKd"),"Họ không dấu", 1, 50);
	valid = valid && checkLength($("#txtTenKd"),"Tên không dấu", 1, 15);
	valid = valid && checkLength($("#txtHoTenKd"),"Họ và tên không dấu", 1, 100);
	valid = valid && checkLength($("#txtHocKi"),"Học kì ", 1, 50);
	valid = valid && checkLength($("#txtCthk"),"Chi tiết học kì", 1, 50);
	
	//valid = valid && checkRegexp($("#txtMssv"), /^([0-9a-zA-Z])+$/, "Mã số sinh viên bao gồm số hoặc chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtMadvlk"), /^([0-9a-zA-Z])+$/, "Mã đơn vị liên kết bao gồm số hoặc chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtTendvlk"), /^([0-9a-zA-Z\s])+$/, "Tên đơn vị liên kết bao gồm số hoặc chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtHo"), /^[a-z]+$/i, "Họ bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtTen"), /^[a-z]+$/i, "Tên bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtNoiSinh"), /^[a-z]+$/i, "Nơi sinh bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtDanToc"), /^[a-z]+$/i, "Dân tộc bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtQuocTich"), /^[a-z]+$/i, "Quốc tịch bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtNganhDaoTao"), /^[a-z]+$/i, "Ngành đào tạo bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtGiayKhaiSinh"), /^[a-z]+$/i, "Giấy khai sinh bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtHtdt"), /^[a-z]+$/i, "Hình thức đào tạo bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtDiem"), /^([0-9])+$/, "Điểm phải là số"); // yes
	//valid = valid && checkRegexp($("#txtXepLoai"), /^[a-z]+$/i, "Xếp loại đào tạo bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtHoKd"), /^[a-z]+$/i, "Họ không dấu bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtTenKd"), /^[a-z]+$/i, "Tên không dấu bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtHoTenKd"), /^[a-z]+$/i, "Họ và tên không dấu bao gồm chữ (viết thường hoặc viết hoa)"); // yes
	//valid = valid && checkRegexp($("#txtHocKi"), /tn_[\d]+/i, "Học kì gồm các kí tự số, chữ, dấu _, và phải bắt đầu là kí tự");
	//valid = valid && checkRegexp($("#txtBangCap"), /^[a-z]([0-9a-z-\s])+$/i, "Bằng cấp gồm các kí tự số, chữ, dấu -, và phải bắt đầu là kí tự");
	//valid = valid && checkRegexp($("#txtCthk"), /^[a-z]([0-9a-z-\s])+$/i, "Chi tiết học kì gồm các kí tự số, chữ, dấu -, và phải bắt đầu là kí tự");
	//valid = valid && ( checkRegexp($("#txtNgaySinh"), /^([\d]{2})\/([\d]{2})\/([\d]{4})$/, "ngày sinh có thể là dd/mm/yyyy hoặc yyyy")  || checkRegexp($("#txtNgaySinh"), /^([\d]{4})$/, "ngày sinh có thể là dd/mm/yyyy hoặc yyyy"));
	
	
	if (valid) { // nếu hợp lệ sẽ chuyển dữ liệu của các thẻ input sang file php
		data.push($("#txtStt").val(),
				$("#txtMadvlk").val(),
				$("#txtTendvlk").val(),
				$("#txtMssv").val(),
				$("#txtHo").val(),
				$("#txtTen").val(),
				$("#txtNgaySinh").val(),
				$("#txtNoiSinh").val(),
				$("#txtGioiTinh").val(),
				$("#txtDanToc").val(),
				$("#txtQuocTich").val(),
				$("#txtNganhDaoTao").val(),
				$("#txtGiayKhaiSinh").val(),
				$("#txtBangCap").val(),
				$("#txtHinh").val(),
				$("#txtPdkxcb").val(),
				$("#txtCtdt").val(),
				$("#txtHtdt").val(),
				$("#txtDiem").val(),
				$("#txtXepLoai").val(),
				$("#txtDktn").val(),
				$("#txtHoKd").val(),
				$("#txtTenKd").val(),
				$("#txtHoTenKd").val(),
				$("#txtHocKi").val(),
				$("#txtCthk").val());
		$.ajax({
			//url: "./UpdateTableAjax.php",
			url: strUrl,
			method: 'post',
			data: {
				"row": data,
				"table_name": $("#tableName").val()
			},
			dataType: "json",
			'success': function(result) {
				//alert(strUrl);
				alert(result);
				
			},
			'complete': function(result){
				//alert(strUrl);
				$(dialogId).dialog( "close" );
				loadTable(); // khi hoàn thành thêm hoặc xóa thì sẽ load lại bảng để lấy dữ liệu mới
			}
		});
	}
	return valid;
}

function createRow() {
	$("#txtMssv").attr("disabled", false); // cho phép nhập dữ liệu vào mã số sinh viên
	$("#dialog").attr("title", "Create Row"); //thay đổi title của dialog
	$("#txtStt").attr("disabled",true); // vô hiệu hóa cột STT
	$.post({
		url: "./lib/ajax/GetSttDataAjax.php",
		data: {
			"table_name": $("#tableName").val()
		},
		dataType: "json",
		success: result => {
			// chuyển tất cả các trường về rỗng, riêng cột stt sẽ được tự động tăng
			$("#txtStt").val(parseInt(result["MAX(stt)"]) + 1), $("#txtMadvlk").val(""), $("#txtTendvlk").val(""),
			
			$("#txtMssv").val(""), $("#txtHo").val(""), $("#txtTen").val(""),
			
			$("#txtNgaySinh").val(""), $("#txtNoiSinh").val(""),
			
			$("#txtGioiTinh").val(""), $("#txtDanToc").val(""),
			
			$("#txtQuocTich").val(""), $("#txtNganhDaoTao").val(""),
			
			$("#txtGiayKhaiSinh").val(""), $("#txtBangCap").val(""),
			
			/*$("#txtHinh").val(""), $("#txtPdkxcb").val(""),
			
			$("#txtCtdt").val(""),*/ $("#txtHtdt").val(""),
			
			$("#txtDiem").val(""), $("#txtXepLoai").val(""),
			
			/*$("#txtDktn").val(""),*/ $("#txtHoKd").val(""),
			
			$("#txtTenKd").val(""), $("#txtHoTenKd").val(""),
			
			$("#txtHocKi").val(""), $("#txtCthk").val("");
			
			
			
		},
		complete: function(result) {
			$("#dialog").dialog({
				height: 'auto',
				width: 1000,
				modal:true,
				fluid: true,
				my: "center",
				at: "center",
				buttons: {
					"Thêm": function() {
						regexpForCreateUpdate("./lib/ajax/AddDataTableAjax.php", "#dialog");
						
					},
					"Hủy": function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					$( this ).dialog( "destroy" );
				}
			});
		}
	});
}

function updateRow(mssv) {
	$("#txtMssv").attr("disabled", true);
	$("#dialog").attr("title", "Cập nhập thông tin sinh viên");
	$("#txtStt").attr("disabled",true);
	
	$.post({
		url: "./lib/ajax/GetOneDataAjax.php",
		data: {
			'mssv':mssv,
			"table_name": $("#tableName").val(),
		},
		dataType: "json",
		success: function(object) {
			//alert(object[0].ma_dvlk);
		
			$("#txtStt").val(object[0].stt), $("#txtMadvlk").val(object[0].ma_dvlk), $("#txtTendvlk").val(object[0].ten_dvlk),
	
			$("#txtMssv").val(object[0].mssv), $("#txtHo").val(object[0].ho), $("#txtTen").val(object[0].ten),
			
			$("#txtNgaySinh").val(object[0].ngay_sinh), $("#txtNoiSinh").val(object[0].noi_sinh),
			
			$("#txtGioiTinh").val(object[0].gioi_tinh), $("#txtDanToc").val(object[0].dan_toc),
			
			$("#txtQuocTich").val(object[0].quoc_tich), $("#txtNganhDaoTao").val(object[0].nganh_dt),
			
			$("#txtGiayKhaiSinh").val(object[0].giay_ks), $("#txtBangCap").val(object[0].bang_cap),
			
			$("#txtHinh").val(object[0].hinh), $("#txtPdkxcb").val(object[0].phieu_dkxcb),
			
			$("#txtCtdt").val(object[0].ct_dt), $("#txtHtdt").val(object[0].hinh_thuc_dt),
			
			$("#txtDiem").val(object[0].diem), $("#txtXepLoai").val(object[0].xep_loai),
			
			$("#txtDktn").val(object[0].dk_tn), $("#txtHoKd").val(object[0].ho_temp),
			
			$("#txtTenKd").val(object[0].ten_temp), $("#txtHoTenKd").val(object[0].temp),
			
			$("#txtHocKi").val(object[0].hk), $("#txtCthk").val(object[0].chi_tiet_hk);
			
			
			$("#dialog").dialog({
				height: 'auto',
				width: 1000,
				modal:true,
				fluid: true,
				my: "center",
				at: "center",
				buttons: {
					"Cập nhật": function(){
						regexpForCreateUpdate("./lib/ajax/UpdateTableAjax.php", "#dialog");
					},
					"Hủy": function() {
						$( this ).dialog( "close" );
					}
				},
				close: function() {
					$( this ).dialog( "destroy" );
				}
			});
			
		
		}
	});
	
	
}
	
function deleteRow(mssv) {
	$("#mssvDelete").text("Xóa sinh viên có mã số: " + mssv);
	$("#dialogDelete").dialog({
		height: 'auto',
		width: 'auto',
		modal:true,
		fluid: true,
		my: "center",
		at: "center",
		buttons: {
			"Có chắc chắn muốn xóa ?": function() {
				
				$.post({
					url: "./lib/ajax/DeleteDataTableAjax.php",
					data: {
						"table_name": $("#tableName").val(),
						"mssv": mssv
					},
					dataType: "json",
					success: function() {
						
					},
					'complete': function(result){
						//alert(strUrl);
						$("#dialogDelete").dialog( "close" );
						loadTable(); // khi hoàn thành thêm hoặc xóa thì sẽ load lại bảng để lấy dữ liệu mới
					}
				});
				//$("#dialogDelete").dialog( "close" );
				//loadTable(); // khi hoàn thành thêm hoặc xóa thì sẽ load lại bảng để lấy dữ liệu mới
			},
			"Hủy": function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			$( this ).dialog( "destroy" );
		}
	});
}

function loadTable() {
	
	$("#example tr").remove(); // xóa các dòng của bảng trước khi thêm hoặc sửa
	
	// tạo các cột
	var	addThToTable = "", // thêm các cột vào bảng
		addTdToTable = ""; // thêm các dòng vào bảng
	$.get({
		url:"./lib/ajax/GetTitleTableAjax.php",
		data: {
			"table_name": $("#tableName").val()
		},
		dataType:"json",
		success: function(result) {
			addThToTable = "<thead><tr><th> </th><th> </th>";
			result.forEach(item => {
				
				addThToTable += "<th>" + item + "</th>";
				
			});
			addThToTable += "</tr></thead>";
			//$("#example").append(addThToTable);
		},
		// tạo các dòng
		complete: function() {
			addTdToTable = "<tbody>"; // "";
			$.get({
				url:"./lib/ajax/GetDataTableAjax.php",
				data: {
					"table_name": $("#tableName").val()
				},
				dataType:"json",
				success: function(result) {
					result.forEach(item => {
						addTdToTable += "<tr>"; // +=
						addTdToTable += "<td><a href =" + "javascript:updateRow('" + item.mssv + "');>Cập nhât</a></td>"
						//addTdToTable += "<td><a id = '" + item.mssv + "' href = '#'>Update</a></td>"
									 +"<td><a href =" + "javascript:deleteRow('" + item.mssv + "');>Xóa</a></td>"
									 + "<td>" + item.stt + "</td>"
									 +"<td>" + item.ma_dvlk + "</td>"
									 +"<td>" + item.ten_dvlk + "</td>"
									 +"<td>" + item.mssv + "</td>"
									 +"<td>" + item.ho + "</td>"
									 +"<td>" + item.ten + "</td>"
									 +"<td>" + item.ngay_sinh + "</td>"
									 +"<td>" + item.noi_sinh + "</td>"
									 +"<td>" + item.gioi_tinh + "</td>"
									 +"<td>" + item.dan_toc + "</td>"
									 +"<td>" + item.quoc_tich + "</td>"
									 +"<td>" + item.nganh_dt + "</td>"
									 +"<td>" + item.giay_ks + "</td>"
									 +"<td>" + item.bang_cap + "</td>"
									 +"<td>" + item.hinh + "</td>"
									 +"<td>" + item.phieu_dkxcb + "</td>"
									 +"<td>" + item.ct_dt + "</td>"
									 +"<td>" + item.hinh_thuc_dt + "</td>"
									 +"<td>" + item.diem + "</td>"
									 +"<td>" + item.xep_loai + "</td>"
									 +"<td>" + item.dk_tn + "</td>"
									 +"<td>" + item.ho_temp + "</td>"
									 +"<td>" + item.ten_temp + "</td>"
									 +"<td>" + item.temp + "</td>"
									 +"<td>" + item.hk + "</td>"
									 +"<td>" + item.chi_tiet_hk + "</td>";
									
						addTdToTable += "</tr>";
						//$("#example").append(addTdToTable);
						//$("#" + item.mssv).click(() => {
							//updateRow(item);
							//alert(item.mssv);
						//});
					});
					addTdToTable += "</tbody>";
					//alert(addTdToTable);
					$("#example").append(addThToTable+addTdToTable);
					$("#example td").css("text-align","center");
					$('#example').DataTable(); // áp dụng datatable cho bảng.
				}
			});
			
		}
	});
}

function tooltip() {
	$("#txtMssv").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtMadvlk").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtTendvlk").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtHo").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtTen").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtNgaySinh").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtNoiSinh").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtDanToc").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtQuocTich").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtNganhDaoTao").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtGiayKhaiSinh").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtBangCap").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtHtdt").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtDiem").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtXepLoai").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtHoKd").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtTenKd").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtHoTenKd").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtHocKi").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
	$("#txtCthk").tooltipster({
		content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
		theme: "tooltipster-light"
	});
	
}

$(document).ready(function() {
	$.get({
		url: "./lib/ajax/GetAllTableAjax.php",
		dataType: "json",
		success: function(result) {
			
			var option = "";
			result.forEach(item => {
				option += "<option>"+ item.TABLE_NAME +"</option>";
				
			});
			
			$("#tableName").append(option); // tableName là id của selectBox , lúc trang web đc load thì sẽ thêm các bảng vào selectBox
			loadTable();
			
		}
	});
	$("#btnAdd").click(() => {
		createRow();
	});
	
	$("#tableName").change(() => {
		loadTable();
	});
	
	tooltip();
	
	
});