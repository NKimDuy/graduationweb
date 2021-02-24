<?php
	require_once("db/Config.php");
?>
<div class="menu-list">
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="d-xl-none d-lg-none" href="#">Dashboard</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav flex-column">
				<li class="nav-divider">
					Menu
				</li>
				
				<li class="nav-item" id="<?php echo (isset ($flagCreateAccount) ? $flagCreateAccount : "") ;?>">
					<!--<a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Tạo tài khoản <span class="badge badge-success">6</span></a>-->
					<a class="nav-link" href="<?php echo $conf["root"] ?>create_account.php" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Tạo tài khoản</a>
					
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $conf["root"] ?>detailTable.php" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Các bảng hiện có</a>
					
				</li>
				<li class="nav-item ">
					<a class="nav-link" href="<?php echo $conf["root"] ?>upload.php" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Tạo bảng mới</a>
					
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $conf["root"] ?>table.php" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Chỉnh sửa bảng</a>
					
				</li>
				
			</ul>
		</div>
	</nav>
</div>