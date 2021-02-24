$(document).ready(function() {
	
	$("#firstname").tooltipster({
		content: "Họ không được chứa các key word sql và không được để trống",
		theme: "tooltipster-light"
	});
	
	$("#lastname").tooltipster({
		content: "Tên không được chứa các key word sql và không được để trống",
		theme: "tooltipster-light"
	});
	
	$("#user").tooltipster({
		content: "Tên đăng nhập không được chứa các key word sql và không được để trống",
		theme: "tooltipster-light"
	});
	
	$("#password").tooltipster({
		content: "Mật khẩu không được chứa các key word sql và không được để trống",
		theme: "tooltipster-light"
	});
	
	$("#passwordConfirm").tooltipster({
		content: "Mật khẩu không được chứa các key word sql và không được để trống",
		theme: "tooltipster-light"
	});
	
	$("#create-account").click(function(e) {
		// e.target.id : lấy id của dom element đang được thao tác
		e.preventDefault(); // ngăn chặn sự kiện mặc định 
		
		var regularExpression = /select|from|where|join|SELECT|FROM|WHERE|JOIN/; // kiểm tra thông tin nhập vào có chứa các kí tự html không
		
		var user = $("#user").val(),
			password = $("#password").val(),
			passwordConfirm = $("#passwordConfirm").val(),
			firstname = $("#firstname").val(),
			lastname = $("#lastname").val(),
			permission = $("input[name='permission']:checked").val();
		
		function checkEmptyField(element) { // báo lỗi nếu các trường trống
			var interval_obj = setTimeout(function(){
			$(element).css('border', '3px solid red');
			}, 20);
			$(element).fadeOut(1000,function(){
				$(this).css('border', '1px solid #ced4da');
			});
			$(element).fadeIn();
			return false;
		}
		
		function checkCorrectField(element, message) { // báo lỗi nếu dữ liệu nhập vào không hợp lệ
			$(element).append("<span id = 'incorrect' style = 'color:red;'>" + message + "!!!</span>");
			var interval_obj = setTimeout(function(){
				$("#incorrect").remove();
			}, 1000);
			//alert("chưa cấp quyền!!!");
			return false;
		}
		
		
	
		if (firstname == "") {
			checkEmptyField("#firstname");
			
		}
		else if(lastname == "") {
			checkEmptyField("#lastname");
			
		}
		else if(user == "") {
			checkEmptyField("#user");
		
		}
		else if(password == "") {
			checkEmptyField("#password");
			
		}
		else if(passwordConfirm == "") {
			checkEmptyField("#passwordConfirm");
			
		}
		else if(permission == null) {
			checkCorrectField("#check-permission", "chưa cấp quyền");
			
		}
		else if(password != passwordConfirm) {
			checkCorrectField("#check-account", "Mật khẩu không trùng khớp");
			
		}
		else if ((regularExpression.test(firstname))) {
			checkCorrectField("#regFirstname", "không được chứa các key word");
			
		}
		else if ((regularExpression.test(lastname))) {
			checkCorrectField("#regLastname", "không được chứa các key word");
			
		}
		else if ((regularExpression.test(passwordConfirm))) {
			checkCorrectField("#check-account", "không được chứa các key word");
			
		}
		else if ((regularExpression.test(user))) {
			checkCorrectField("#regUser", "không được chứa các key word");
			
		}
		else {
			// nếu không có lỗi xảy ra, sẽ gửi dữ liệu sang php để thêm tài khoản
			$.get({
				url: "lib/ajax/CheckAccountAjax.php",
				data: {
					'user': user,
				},
				dataType: "json",
				error: function(result){
					alert('có lỗi xảy ra khi xử lý với ajax');
				},
				success: function(result) {
					if (result == true)
						alert("Đã tồn tại tài khoản");
					else {
						$.get({
							url: "lib/ajax/CreateAccountAjax.php",
							data: {
								'user': user,
								'password': password,
								'passwordConfirm': passwordConfirm,
								'firstname': firstname,
								'lastname': lastname,
								'permission': permission
							},
							dataType: "json",
							success: function(result) {
								if (result == true)
									alert("Đã tạo tài khoản thành công");
								else
									alert("Có lỗi xảy ra khi tạo tài khoản");
							}
						});
					}
				}
			});
		}
		
	});
});