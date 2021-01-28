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