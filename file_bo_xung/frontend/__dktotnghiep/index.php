	<?php
	require_once "./db/ConnectDB.php";
	require_once "./db/config.php";
	require_once "./lib/students/Students.php";
	require_once './lib/htmlpurifier-4.12.0/htmlpurifier-4.12.0/library/HTMLPurifier.auto.php';
	
	$flag_table = "display: none;"; // ẩn hoặc hiển bảng thông tin sinh viên có chọn đợt
	$flag_find_table = ""; // ẩn hoặc hiện bảng tìm thông tin sinh viên
	$flag_table_all = "display: none;"; // ẩn hoặc hiển bảng thông tin sinh viên không chọn đợt
	$semester = ""; // biến dùng để lưu học kì tương ứng
	$exception =""; // // biến dùng để lưu thông báo khi xuất hiên ngoại lệ
	$cant_see = ""; // biến dùng để lưu thông báo khi không tìm thấy thông tin sinh viên
	$data = []; // mảng dùng để lưu danh sách sinh viên có chọn đợt
	$data_all = []; // mảng dùng để lưu danh sách sinh viên không chọn đợt
	$tablename_array = []; // mảng dùng để lưu các đợt tốt nghiệp
	
	if (isset($_POST['find']))
	{
		$mssv = isset($_POST['mssv']) ? $_POST['mssv'] : "";
		$name = isset($_POST['name']) ? $_POST['name'] : "";
		
		$patterm = '/select|from|where|join|SELECT|FROM|WHERE|JOIN|=|\'/';
		$replacement = "";
		$mssv = preg_replace($patterm, $replacement, $mssv);
		$name = preg_replace($patterm, $replacement, $name);
		
		$rad = isset($_POST['rad']) ? $_POST['rad'] : "";
		$semester = isset($_POST['semester']) ? $_POST['semester'] : "";
		$seeHistory = isset($_POST['seeHistory']) ? $_POST['seeHistory'] : ""; // sinh viên chọn xem thông tin không cần chọn đợt
		
		//////////// dùng HTMLPurifier để xử ký dữ liệu nhập vào
		$config = HTMLPurifier_Config::createDefault();
		$purifier = new HTMLPurifier($config);
		$clean_mssv = $purifier->purify(trim(preg_replace('/\s+/', '', $mssv)));
		$clean_name = $purifier->purify(trim(preg_replace('/\s+/mu', ' ', $name)));
		///////////////////////////////////////////////////////////////////////
		
		//////////////////// gắn capcha ////////////////////
		session_start();
		if (count($_POST) > 0) 
		{
			if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) 
			{
				if ($rad == "radmssv") // tìm kiếm theo mssv
				{
					if ($seeHistory == "yes") // xem thông tin mà không cần biết đợt
					{
						$tablename_array = GetTableName(); // lấy các đợt tốt nghiệp
						$get_tablename = [];
						foreach($tablename_array as $item)
						{
							array_push($get_tablename, $item['TABLE_NAME']);
						}
						try
						{
							$data_all = FindAllStudentsByMssv($clean_mssv, $get_tablename);
							if($data_all == null)
							{
								$cant_see = "Không tìm thấy thông tin sinh viên";
							}
						}
						catch(Exception $e)
						{
							$exception = 'Message: ' .$e->getMessage();
						}
					}
					else
					{
						try
						{
							$data = FindStudentsByMssv($clean_mssv, $semester);
							if($data == null)
							{
								$cant_see = "Không tìm thấy thông tin sinh viên";
							}
						}
						catch(Exception $e)
						{
							$exception = 'Message: ' .$e->getMessage();
						}
					}
				}
				elseif($rad == "radname") // tìm kiếm theo tên
				{
					if ($seeHistory == "yes") // xem thông tin mà không cần biết đợt
					{
						$tablename_array = GetTableName(); // lấy các đợt tốt nghiệp
						$get_tablename = [];
						foreach($tablename_array as $item)
						{
							array_push($get_tablename, $item['TABLE_NAME']);
						}
						try
						{
							$data_all = FindAllStudentsByName($clean_name, $get_tablename);
							if($data_all == null)
							{
								$cant_see = "Không tìm thấy thông tin sinh viên";
							}
						}
						catch(Exception $e)
						{
							$exception = 'Message: ' .$e->getMessage();
						}
					}
					else
					{
						try
						{
							$data = FindStudentsByName($clean_name, $semester);
							if($data == null)
							{
								$cant_see = "Không tìm thấy thông tin sinh viên";
							}
						}
						catch(Exception $e)
						{
							$exception = 'Message: ' .$e->getMessage();
						}
					}
					
				}
			}
			else
			{
				$message = "Mã xác nhận không đúng!!";
			}
		}
		//////////////////////////////////////////////////////////////////
		
		// ẩn hoặc hiện bảng chi tiết sinh viên 
		if (!empty($data))
		{
			$flag_find_table = "display: none;";
			$flag_table = "display: block;";
		}
		else
		{
			$flag_table = "display: none;";
		}
		
		if (!empty($data_all))
		{
			$flag_find_table = "display: none;";
			$flag_table_all = "display: block;";
		}
		else
		{
			$flag_table_all = "display: none;";
		}
		///////////////////////////////////
	}
?>

<html lang="en">

<head>
<title>Tra cứu thông tin tình trạng xét tốt nghiệp</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<LINK REL="SHORTCUT ICON" HREF="http://oude.edu.vn/www/favicon.ico" type="image/x-icon">


<!-- file css lam thu cong -->
<link rel="stylesheet" type="text/css" href="./css/gq.css">
<!----------------------------------------------------------->

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
<!-- them cac thu vien de hien dialog -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/tooltipster/tooltipster.bundle.min.css">
<link rel="stylesheet" href="css/tooltipster/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css">


</head>
<body>
	<div id="cant-see-dialog" title="Thông báo" style = "display:none;">
		<p style = "color:red;">Không tìm thấy thông tin sinh viên !!!</p>
	</div>
	<div id="dialog" style = "display:none;"></div><!-- hien chi tiet thong tin sinh vien -->
	<div id="dialogTCSV" style = "display:none;"></div><!-- hien chi tiet thong tin sinh vien -->
	
	
	<div class="container-fluid">		
		<div class ="row header align-items-center">
			<div class="col media justify-content-center">
				<img src ="images/logo/oude.png" alt="Generic placeholder image" />
			</div>
			<div class = 'col media-body text-center'>
				<span style="font-size: 40px;" class = "text-light font-weight-bolder">TRUNG TÂM ĐÀO TẠO TỪ XA</span>
			</div>
		</div>
		<div class = "row">
			<div class ="col">
				<div id="home" class = "float-right">
					<a href="/"><img class='img-fluid' id = "img-home" src = "images/logo/home-white-5.png" alt ="Trở lại trang chủ" /></a>
				</div>
			</div>
		</div>
		<!-- bảng tìm thông tin sinh viên -->
		<div id = "find-table" class ="row justify-content-center" style = "<?php echo $flag_find_table; ?>" >
			<div class = "col-sm-6 find_mssv">
				<!-- Progress bar -->
				<div style="display: none; height: 7px;" class="progress center-block" id="progressbar">
					<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
				</div>
				<!-- Progress bar -->
				<div style = 'font-size:18px; background-color:#007bff' class = "full-screen font-weight-bold text-dark text-center"><span class="align-middle">TRA CỨU THÔNG TIN TÌNH TRẠNG XÉT TỐT NGHIỆP</span></div>
				<div class="row justify-content-center"><span style = "color: red; font-size: 15px; margin-bottom:5px;" class="badge badge-warning">Vui lòng chọn tra cứu bằng mã số hoặc họ tên sinh viên</span></div>
				<form method = "post" id = "validate_form">
				
					<div class="form-group">
						<label class="badge badge-info" for="exampleInputMssv" style="font-size:15px;">Mã số sinh viên</label>
						
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text" style="background-color:#cce5ff;">
									<input type="radio" style="display:none;" value = "radmssv" id = "radmssv" name = "rad" checked>
								</div>
							</div>
							<input type="text" class="form-control" aria-describedby="MSSV"
								autofocus
								id = "1"
								name = "mssv"
								maxlength = "16"
								title= ""
								class="tooltip"
							>
						</div>
					</div>
					
					<div class="form-group">
						<label class="badge badge-info" style="font-size:15px;" for="exampleInputName">Họ và tên</label>
						
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text" style="background-color:#cce5ff;">
									<input type="radio" style="display:none;" value = "radname" id = "radname" name = "rad">
								</div>
							</div>
							<input type="text" class="form-control"
								readonly
								id = "2"
								name = "name"
								maxlength = "50"
								data-toggle="tooltip"
								title=""
								class="tooltip"
								data-tooltip-content="#name_tooltip_content"
							>
							<div style="display: none;" class="tooltip_templates"><div id="name_tooltip_content">Nhập chuỗi ký tự có dấu hoặc không có dấu tiếng Việt với bảng mã UNICODE.<br /><br /><b>Ví dụ:</b><br /><ul style="color: #666666;"><li>Trần Đoàn Trung Tâm</li><li>Tran Doan Trung Tam</li></ul></div></div>
						</div>
					</div>
						
					<div class="form-group"> 
						<label for="exampleInputSemester">Đợt tốt nghiệp :</label>
						<select class = "opt" id = "exampleInputSemester" name = "semester">
							<?php
								foreach(GetSemester() as $key => $item)
								{
									if ($key == $conf['default_combobox'])
									{
										echo "<option selected value = '" . $key . "'>" . $item['chi_tiet_hk'] . "</option>";
									}
									else
									{
										echo "<option value = '" . $key . "'>" . $item['chi_tiet_hk'] . "</option>";
									}
									
								}
							?>
						</select>
					</div>
					<input type = "checkbox" id = "seeHistory" name = "seeHistory" value = "yes"> Tìm kiếm không cần chọn đợt
					
					<span style = "color:red; font-size:20px;" id = "cant-see"><?php echo "<br>" . $cant_see;?></span>
					<script language = "javascript">
							if ($("#cant-see").text() != "") {
								$("#cant-see-dialog").dialog({
									modal: true,
									buttons: {
										Ok: function() {
											$( this ).dialog("close");
										}
									}
								});
							}
					</script>
					<br>
					
					<div>
						Nếu không tìm thấy thông tin tình trạng xét tốt nghiệp của sinh viên. Xin vui lòng liên hệ:
					</div>
					<div>
						<b>
							Trung tâm Đào tạo từ xa - Trường Đại học Mở Thành phố Hồ Chí Minh
						</b>
						<br>
							Phòng 004 - 97 Võ Văn Tần, Phường 6, Quận 3, Thành phố Hồ Chí Minh
						<br>
							Điện thoại: 18006119 (bấm phím 1)
						
					</div>
					<label style="font-size:15px;" class="badge badge-info"> Mã xác nhận: </label>
					<img src="./lib/captcha/captcha_code.php" />
					<input name="captcha_code" type="text"><span style = "color:red; margin-left:10px;"><?php if(isset($message)) { echo $message; } ?></span>
					<button type="submit" id = "btnValid" name = "find" class="btn btn-primary btn-lg btn-block">TRA CỨU THÔNG TIN</button>
				</form>
				
			</div>
		</div>
		
		<div class = "row show_mssv">
			<div class ="col-sm">
				<div class="table-responsive-sm">
					<!-- hiện chi tiết sinh viên có chọn đợt -->
					<div id = "show-table" style = "<?php echo $flag_table; ?> margin-top: 70px;">
						<table class="table table-striped" id = "result1" >
							<thead>
								<tr>
									<th>STT</th>
									<th>MÃ SỐ SINH VIÊN</th>
									<th>HỌ</th>
									<th>TÊN</th>
									<th>NGÀY SINH</th>
									<th>NƠI SINH</th>
									<th>GIỚI TÍNH</th>
									<th>ĐỢT TỐT NGHIỆP</th>
									<th>CHI TIẾT</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									if ($data != null) 
									{
										foreach($data as $item)
										{
								?>
								<tr>
									<td class='align-middle'><?php echo $i++; ?></td>
									<td class='align-middle'><?php echo $item['mssv']; ?></td>
									<td class='align-middle'><?php echo $item['ho']; ?></td>
									<td class='align-middle'><?php echo $item['ten']; ?></td>
									<td class='align-middle'><?php echo $item['ngay_sinh']; ?></td>
									<td class='align-middle'><?php echo $item['noi_sinh']; ?></td>
									<td class='align-middle'><?php echo $item['gioi_tinh']; ?></td>
									<td class='align-middle'><?php echo $item['chi_tiet_hk']; ?></td>
									
									<td><a class="btn btn-outline-primary" id = "detail" href="javascript:chiTietSV('<?php echo $item['mssv']; ?>', '<?php echo $item['hk']; ?>');">Xem chi tiết</a></td>
								</tr>
									<?php }} ?>
							</tbody>
						</table>
					</div>
					
					<!-- hiện chi tiết sinh viên không chọn đợt -->
					<div id = "show-table-all" style = "<?php echo $flag_table_all; ?> margin-top: 70px;">						
						<table class="table table-striped align-middle" id = "result2" >
							<thead>
								<tr>
									<th>STT</th>
									<th>MÃ SỐ SINH VIÊN</th>
									<th>HỌ</th>
									<th>TÊN</th>
									<th>NGÀY SINH</th>
									<th>NƠI SINH</th>
									<th>GIỚI TÍNH</th>
									<th>  </th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									if ($data_all != null) 
									{
										foreach($data_all as $item)
										{
								?>
								<tr>
									<td class='align-middle'><?php echo $i++; ?></td>
									<td class='align-middle'><?php echo $item['mssv']; ?></td>
									<td class='align-middle'><?php echo $item['ho']; ?></td>
									<td class='align-middle'><?php echo $item['ten']; ?></td>
									<td class='align-middle'><?php echo $item['ngay_sinh']; ?></td>
									<td class='align-middle'><?php echo $item['noi_sinh']; ?></td>
									<td class='align-middle'><?php echo $item['gioi_tinh']; ?></td>
									<td><a class="btn btn-outline-primary" id = "detail" href="javascript:lichSuSV('<?php echo $item['mssv']; ?>');">Xem lịch sử</a></td>
								</tr>
									<?php }} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
		<!-- khi có lỗi xảy ra, không ngừng trang web, chỉ thông báo lỗi -->
		<div id = "exception"><?php echo $exception; ?></div>
	</div>
	
	<!-- phần footer -->
	<div class="container-fluid list-contact foot">
		<br />
		<div class="row">
			<!--first column-->
			<div class="col-md-2 mx-auto">
			  <h6 class="text-uppercase font-weight-bold mb-4 title">GIỚI THIỆU</h6>
			  <ul>
				<li><a href = "http://oude.edu.vn/introduce/%C4%91%C3%A0o-t%E1%BA%A1o-t%E1%BB%AB-xa-t%E1%BA%A1i-tr%C6%B0%E1%BB%9Dng-%C4%91%E1%BA%A1i-h%E1%BB%8Dc-m%E1%BB%9F-tp-hcm-2/view/">Đào tạo từ xa Trường Đại Học Mở TP.HCM</a></li>
				<li><a href = "http://oude.edu.vn/introduce/v%C3%AC-sao-ch%E1%BB%8Dn-ch%C3%BAng-t%C3%B4i-3/view/">Vì sao chọn chúng tôi</a></li>
				<li><a href = "http://oude.edu.vn/introduce/m%E1%BA%A1ng-l%C6%B0%E1%BB%9Bi-%C4%91%C3%A0o-t%E1%BA%A1o-r%E1%BB%99ng-kh%E1%BA%AFp-6/view/">Mạng lưới đào tạo rộng khắp</a></li>
			  </ul>
			</div>
			<!--/.first column-->

			<hr class="w-100 clearfix d-md-none">
			
			<!--Second column-->
			<div class="col-md-2 mx-auto">
			  <h6 class="text-uppercase font-weight-bold mb-4 title">LIÊN KẾT WEBSITE</h6>
			  <ul>
				<li><a href = "http://tuyensinh.oude.edu.vn/">Cổng thông tin tuyển sinh</a></li>
				<li><a href = "http://lms.oude.edu.vn/">Hệ thống hỗ trợ học tập</a></li>
				<li><a href = "http://www.ou.edu.vn/">Trường Đại Học Mở TP.HCM</a></li>
			  </ul>
			</div>
			<!--/.Second column-->

			<hr class="w-100 clearfix d-md-none">

			<!--Third column-->
			<div class="col-md-2 mx-auto">
			  <h6 class="text-uppercase font-weight-bold mb-4 title">LIÊN KẾT QUỐC TẾ</h6>
			  <ul>
				<li><a href = "http://oude.edu.vn/introduce/li%C3%AAn-k%E1%BA%BFt-qu%E1%BB%91c-t%E1%BA%BF-5/view/">Đối tác quốc tế</a></li>
				<li><a href = "http://oude.edu.vn/introduce/th%C3%A0nh-vi%C3%AAn-t%E1%BB%95-ch%E1%BB%A9c-qu%E1%BB%91c-t%E1%BA%BF-4/view/">Thành viên quốc tế</a></li>
				<li><a href = "http://peace-foundation.net/video/vietnam/Ngo_Bao_Chau">International Peace Foundation</a></li>
			  </ul>
			</div>
			<!--/.Third column-->

			<hr class="w-100 clearfix d-md-none">

			<!--Fourth column-->
			<div class="col-md-2 mx-auto">
			  <h6 class="text-uppercase font-weight-bold mb-4 title">LIÊN HỆ - HỖ TRỢ</h6>
			  <ul>
				<li><a href = "tel:18006119">Tổng đài: 18006119</a></li>
				<li><a href = "mailto:tuvan@oude.edu.vn">Email: tuvan@oude.edu.vn</a></li>
				<li><a href = "http://oude.edu.vn/contacts/index">Địa chỉ</a></li>
			  </ul>
			</div>
			<!--/.Fourth column-->

		</div>
	</div>
		
	<footer class="bg-secondary py-5" style = "padding-top:1rem !important;padding-bottom:0rem !important;">
		<div class="container">
			<div class="small text-center text-muted">
				<ul class="list-unstyled list-inline">
					<li>
						Copyright © 1990 - 2019 Open University Ho Chi Minh City.
					</li>
					<li>
						97 Vo Van Tan, 6th Ward, 3rd Dist., Ho Chi Minh City, Vietnam - Tel: 18006119
					</li>
					<li>
						Website: www.oude.edu.vn - Email: tuvan@oude.edu.vn
					</li>
				</ul>
			</div>
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--------------------------------------------------------------------------------->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js" crossorigin="anonymous"></script>
	<script src="js/tooltipster/tooltipster.bundle.min.js" ></script>

	<script language = "javascript">
		$(document).ready(function(){
			
			// hiển thị thanh quá trình
			/*
			$("#progressbar").progressbar({
				value: false
			});
			*/
			
			// kiểm tra thẻ input đã được điền hay chưa
			$('#validate_form').submit(function(){
				
				if ($("#radmssv").is(":checked")) {
					if($('#1').val() == ''){
						alert('Người dùng chưa cung cấp mã số sinh viên!!!!');
						return false;
					}
					else {
						$("#progressbar").css('display', 'flex');
					}
				}
				else if ($("#radname").is(":checked")) {
					if($('#2').val() == '') {
						alert("Người dùng chưa cung cấp Họ và tên!!!!");
						return false;
					}
					else {
						$("#progressbar").css('display', 'flex');
					}
				}
			});

			// kiểm tra nút xem lịch sử có được check
			$("#seeHistory").click(function() {
				if ($("#seeHistory").is(":checked")) {
					$("#exampleInputSemester").attr("disabled", true);
				}
				else {
					$("#exampleInputSemester").attr("disabled", false);
				}
			});
			
			// kiểm tra nút home có được nhấn hay không
			if ($("#show-table").css("display") != "none") {
				$("#find-table").css("display", "none");
				$("#home").css("display", "inline");
			}
			
			if ($("#show-table-all").css("display") != "none") {
				$("#find-table").css("display", "none");
				$("#home").css("display", "inline");
			}
			
			$("#home").click(function() {
				$("#home").css("display", "none");
				$("#show-table").css("display", "none");
			});
			
			
			// sự kiện xảy ra khi rê chuột vào nút home
			$("#home").mouseover(function() {
				$("#img-home").css("outline", "1px solid #006799");
			});
			
			$("#home").mouseout(function() {
				$("#img-home").css("outline", "none");
			});
			
			// hiện tooltip hướng dẫn nhập liệu
			/*
			$( document ).tooltip({
				position: {
					my: "center bottom-20",
					at: "center top",
					using: function( position, feedback ) {
						  $( this ).css( position );
						  $( "<div>" )
							.addClass( "arrow" )
							.addClass( feedback.vertical )
							.addClass( feedback.horizontal )
							.appendTo( this );
					}
				}
			});
			*/
			$("#1").tooltipster({
				content: "Mã số sinh viên gồm số và chữ, và có độ dài tối đa là 16 kí tự",
				theme: "tooltipster-light"
			});
			$("#2").tooltipster({
				theme: "tooltipster-light"
			});
			
		});
	</script>

	<script language="javascript">

		// hàm có chức năng hiện chi tiết sinh viên khi có chọn đợt tốt nghiệp
		function chiTietSV(mssv, semester)
		{
			$.get({
				url: "./lib/students/StudentAjax.php", // đường link đến file xử lý 
				dataType: "json", // dữ liệu nhận về dạng json
				data: { // dữ liệu được gửi đến file xử lý
					'masv': mssv,
					'semester': semester
				},
				success: function (result){ // sự kiện xảy ra khi ajax thành công
					$("#dialog").attr("title", "Thông tin sinh viên " + result.ho + " " + result.ten + " (" + result.mssv + ")");
					var table = "<table class='table table-hover table-striped' id = 'result1'>";
				
					table += "<tr>";
					table += "<th class = 'align-middle'>MÃ ĐƠN VỊ LIÊN KẾT</th>";
					table += "<td class = 'align-middle'>" + result.ma_dvlk + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>TÊN ĐƠN VỊ LIÊN KẾT</th>";
					table += "<td class = 'align-middle'>" + result.ten_dvlk + "</td>";
					table += "</tr>";
				
					table += "<tr>";
					table += "<th class = 'align-middle'>DÂN TỘC</th>";
					table += "<td class = 'align-middle'>" + result.dan_toc + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>QUỐC TỊCH</th>";
					table += "<td class = 'align-middle'>" + result.quoc_tich + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>NGÀNH ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.nganh_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>GIẤY KHAI SINH</th>";
					table += "<td class = 'align-middle'>" + result.giay_ks + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>BẰNG CẤP</th>";
					table += "<td class = 'align-middle'>" + result.bang_cap + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>HÌNH</th>";
					table += "<td class = 'align-middle'>" + result.hinh + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>PHIẾU ĐĂNG KÍ XÉT CẤP BẰNG</th>";
					table += "<td class = 'align-middle'>" + result.phieu_dkxcb + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>CHƯƠNG TRÌNH ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.ct_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>HÌNH THỨC ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.hinh_thuc_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>ĐIỂM TRUNG BÌNH</th>";
					table += "<td class = 'align-middle'>" + result.diem + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>XẾP LOẠI</th>";
					table += "<td class = 'align-middle'>" + result.xep_loai + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>ĐIỀU KIỆN TỐT NGHIỆP</th>";
					if (result.dk_tn == "Chưa đủ điều kiện") {
						table += '<td class="align-middle"><span style = "font-size: 15px;" class = "badge badge-danger">' + result.dk_tn + '</span></td>';
					}
					else {
						table += "<td class = 'align-middle'><span style='font-size: 15px;' class = 'badge badge-success'>" + result.dk_tn + "</span></td>";
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
		}
		
		
		// hàm có chức năng hiện thông tin sinh viên không chọn đợt
		function lichSuSV(mssv)
		{
			$.get({
				url: "./lib/students/AllStudentAjax.php",
				dataType: "json",
				data: {
					'masv': mssv
				},
				success: function (result){
					$("#dialog").attr("title", "Thông tin sinh viên ");
					var table = "<table class='table table-hover table-striped' id = 'result1'>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'> Đợt tốt nghiệp </th>";
					table += "<th class = 'align-middle'> Tình trạng </th>";
					table += "<th>  </th>";
					table += "</tr>";
					
					$.each (result, function (key, item){
						table += "<tr>";
						table += "<td class = 'align-middle'>" + item['chi_tiet_hk'] + "</td>";
						
						if (item['dk_tn'] == "Chưa đủ điều kiện") {
							table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-danger'>" + item['dk_tn'] + "</span></td>";
						}
						else {
							table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-success'>" + item['dk_tn'] + "</span></td>";
						}
						
						var chi_tiet = "javascript:chiTietTCSV('" + item['mssv'] + "', '" + item['hk'] +"');";
						table += "<td><a class='btn btn-outline-primary float-right' id = 'detail' href = " + '"' + chi_tiet + '"' + ">Xem chi tiết</a></td>";
						table += "</tr>";
					});
					
					table += "</table>";
					
					$("#dialog").html(table);
					
					$( "#dialog" ).dialog({
						width: 'auto',
						maxWidth: 1000,
						fluid: true,
						my: "center",
						at: "center",
						of: window,
						modal: true,
						buttons: {
							OK: function() {
								$( this ).dialog( "destroy" );
							}
						},
						close: function() {
							$( this ).dialog( "destroy" );
						}
					});
				}
			});
		}
		
		
		// hàm có chức năng hiện chi tiết sinh viên không chọn đợt
		function chiTietTCSV(mssv, semester)
		{
			$.get({
				url: "./lib/students/StudentAjax.php",
				dataType: "json",
				data: {
					'masv': mssv,
					'semester': semester
				},
				success: function (result){
					$("#dialogTCSV").attr("title", "Thông tin sinh viên " + result.ho + " " + result.ten + " (" + result.mssv + ")");
					var table = "<table class='table table-hover table-striped' id = 'result1'>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>MÃ ĐƠN VỊ LIÊN KẾT</th>";
					table += "<td class = 'align-middle'>" + result.ma_dvlk + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>TÊN ĐƠN VỊ LIÊN KẾT</th>";
					table += "<td class = 'align-middle'>" + result.ten_dvlk + "</td>";
					table += "</tr>";
				
					table += "<tr>";
					table += "<th class = 'align-middle'>DÂN TỘC</th>";
					table += "<td class = 'align-middle'>" + result.dan_toc + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>QUỐC TỊCH</th>";
					table += "<td class = 'align-middle'>" + result.quoc_tich + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>NGÀNH ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.nganh_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>GIẤY KHAI SINH</th>";
					table += "<td class = 'align-middle'>" + result.giay_ks + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>BẰNG CẤP</th>";
					table += "<td class = 'align-middle'>" + result.bang_cap + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>HÌNH</th>";
					table += "<td class = 'align-middle'>" + result.hinh + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>PHIẾU ĐĂNG KÍ XÉT CẤP BẰNG</th>";
					table += "<td class = 'align-middle'>" + result.phieu_dkxcb + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>CHƯƠNG TRÌNH ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.ct_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>HÌNH THỨC ĐÀO TẠO</th>";
					table += "<td class = 'align-middle'>" + result.hinh_thuc_dt + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>ĐIỂM TRUNG BÌNH</th>";
					table += "<td class = 'align-middle'>" + result.diem + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>XẾP LOẠI</th>";
					table += "<td class = 'align-middle'>" + result.xep_loai + "</td>";
					table += "</tr>";
					
					table += "<tr>";
					table += "<th class = 'align-middle'>ĐIỀU KIỆN TỐT NGHIỆP</th>";
					if (result.dk_tn == "Chưa đủ điều kiện") {
						table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-danger'>" + result.dk_tn + "</span></td>";
					}
					else {
						table += "<td class = 'align-middle'><span style = 'font-size: 15px;' class='badge badge-success'>" + result.dk_tn + "</span></td>";
					}
					table += "</tr>";
					
					table += "</table>";
					
					$("#dialogTCSV").html(table);
					
					$( "#dialogTCSV" ).dialog({
						width: 'auto',
						maxWidth: 1000,
						fluid: true,
						my: "center",
						at: "center",
						of: window,
						modal: true,
						buttons: {
							Ok: function() {
								$( this ).dialog( "destroy" );
							}
						},
						close: function() {
							$( this ).dialog( "destroy" );
						}
					});
				}
			});
		}
		
	</script>


	<script language="javascript">
		
		$(document).ready(function(){
			/*
			// kiem tra radio button nao dang duoc check
			$('#radmssv').change(function() {
				if ($("#radmssv").is(":checked")) {
					$("#1").focus();
					return false;
				}
			});
			
			$('#radname').change(function() {
				if ($("#radname").is(":checked")) {
					$("#2").focus();
					return false;
				}
			});
			*/
			
			$('#1').focus(function() {
				
				$('#radname').attr('checked',false);
				$('#radmssv').attr('checked',true);
				
				$("#2").val("");
				$("#2").attr("readOnly", true);
				$("#1").attr("readOnly", false);
				return false;
			});
			
			
			
			$('#2').focus(function() {
				
				$('#radmssv').attr('checked',false);
				$('#radname').attr('checked',true);
			
				$("#1").val("");
				$("#1").attr("readOnly", true);
				$("#2").attr("readOnly", false);
				return false;
			});
			
			
			
			/*
			// kiểm tra nếu tìm bằng mssv thì không cho phép tìm bằng tên
			$("#radmssv").click(function() {
				$("#1").attr("readOnly", false);
				$("#2").attr("readOnly", true);
				$("#2").val("");
				$("#1").focus();
				
			});
			
			// kiểm tra nếu tìm bằng tên thì không cho phép tìm bằng mssv
			$("#radname").click(function() {
				$("#2").attr("readOnly", false);
				$("#1").attr("readOnly", true);
				$("#1").val("");
				
			});
			
			*/
			
			// thay đổi thông tin mặc định Data table
			$('#result1')
				.DataTable({
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
			
			$('#result2')
				.DataTable({
					//responsive: true,
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
		}); 
		
	</script>
</body>
</html>