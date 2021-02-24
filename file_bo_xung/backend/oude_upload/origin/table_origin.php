<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- javascript/jquery -->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<!--------------------------------------------------------------------------------->
		
		<!-- datatable -->
		<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" >
		<!---->
		
		<!-- bootstrap 4 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
		
		<!-- tooltipter -->
			<link rel="stylesheet" href="css/tooltipster/tooltipster.bundle.min.css">
			<link rel="stylesheet" href="css/tooltipster/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css">
			<script src="js/tooltipster/tooltipster.bundle.min.js" ></script>
		<!---->
		
		<style>
			.error {
				color:red;
				border: 1px solid transparent;
				padding: 0.3em;
			}
			
			.require {
				color: red;
			}
		</style>
		
	</head>
	<body>
		<div class="container">
			
			<div class="row">
				<div class="col">
						<label for="tableName">Các bảng hiện có trong cơ sở dữ liệu</label>
						<select class="custom-select form-control" id="tableName"></select>
						<button id="btnAdd" class="btn btn-primary">Thêm dòng mới</button>
				</div>
			</div>
			<div class="row">
				<table id="example"></table>
			</div>
			
			
			<div id="dialogDelete" style="display:none;" title="Delete Row">
				<p id="mssvDelete"></p>
			</div>
			
			<div id="dialog" style="display:none;">
				<form>
					<fieldset>
						<div class="form-group">
						
							<label for="txtStt">STT</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="stt" id="txtStt" />
							
							<label for="txtStt">MSSV</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="mssv" id="txtMssv" disabled />
							
							<label for="txtMadvlk">Mã đơn vị liên kết</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="maDvlk" id="txtMadvlk" />
							
							<label for="txtTendvlk">Tên đơn vị liên kết</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="tenDvlk" id="txtTendvlk" />
							
							<label for="txtHo">Họ</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="ho" id="txtHo" />
							
							<label for="txtTen">Tên</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="ten" id="txtTen" />
							
							<label for="txtNgaySinh">Ngày sinh</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="ngaySinh" id="txtNgaySinh" />
							
							<label for="txtNoiSinh">Nơi Sinh</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="noiSinh" id="txtNoiSinh" />
							
							
							<label for="txtGioiTinh">Giới tính</label>
							<select class="custom-select" id="txtGioiTinh">
								<option value="Nam" selected>Nam</option>
								<option value="Nữ">Nữ</option>
							</select>
							
							<label for="txtDanToc">Dân tộc</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="danToc" id="txtDanToc" />
							
							<label for="txtQuocTich">Quốc tịch</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="quocTich" id="txtQuocTich" />
							
							<label for="txtNganhDaoTao">Ngành đào tạo</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="nganhDaoTao" id="txtNganhDaoTao" />
							
							<label for="txtGiayKhaiSinh">Giấy khai sinh</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="giayKhaiSinh" id="txtGiayKhaiSinh" />
							
							<label for="txtBangCap">Bằng cấp</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="bangCap" id="txtBangCap" />
							
							
							<label for="txtHinh">Hình</label>
							<select class="custom-select" id="txtHinh">
								<option value="HỢP LỆ" selected>HỢP LỆ</option>
								<option value="BỔ SUNG" >BỔ SUNG</option>
							</select>
							
							<label for="txtPdkxcb">Phiếu đăng kí xét cấp bằng</label>
							<select class="custom-select" id="txtPdkxcb">
								<option value="HỢP LỆ" selected>HỢP LỆ</option>
								<option value="BỔ SUNG">BỔ SUNG</option>
							</select>
							
							<label for="txtCtdt">Chương trình đào tạo</label>
							<select class="custom-select" id="txtCtdt">
								<option value="HOÀN THÀNH" selected>HOÀN THÀNH</option>
								<option value="CHƯA HOÀN THÀNH">CHƯA HOÀN THÀNH</option>
							</select>
							
							<label for="txtHtdt">Hình thức đào tạo</label> <span class ="require"> *</span>
							<input class="form-control" type="text" name="htdt" id="txtHtdt" />
							
							<label for="txtDiem">Điểm</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="diem" id="txtDiem" />
							
							<label for="txtXepLoai">Xếp loại</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="xepLoai" id="txtXepLoai" />
							
							<label for="txtDktn">Điều kiện tốt nghiệp</label>
							<select class="custom-select" id="txtDktn">
								<option value="Đủ điều kiện" selected>Đủ điều kiện</option>
								<option value="Chưa đủ điều kiện">Chưa đủ điều kiện</option>
							</select>
							
							<label for="txtHokd">Họ không dấu</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="hoKd" id="txtHoKd" />
							
							<label for="txtTenkd">Tên không dấu</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="tenKd" id="txtTenKd" />
							
							<label for="txtHoTenKd">Họ và tên không dấu</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="hoTenKd" id="txtHoTenKd" />
							
							<label for="txtHocKi">Học kì</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="hocKi" id="txtHocKi" />
							
							<label for="txtCthk">Chi tiết học kì</label><span class ="require"> *</span>
							<input class="form-control" type="text" name="cthk" id="txtCthk" />
							
							<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
						</div>
					</fieldset>
				</form>
				<p class="error">các trường có dấu ( * ) là bắt buộc.</p>
			</div>
		</div>
		
	</body>
	<script src="js/alter-table-js.js"></script>
</html>