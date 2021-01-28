<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


	<!-- ============================================================== -->
	<!-- main wrapper -->
	<!-- ============================================================== -->
	<div class="dashboard-main-wrapper">
		<!-- ============================================================== -->
		<!-- navbar -->
		<!-- ============================================================== -->
		<div class="dashboard-header">
			
			<nav class="navbar navbar-expand-lg bg-white fixed-top">
				<a class="navbar-brand " href="index.html">Trung tâm đào tạo từ xa</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto navbar-right-top">
						<li class="nav-item dropdown nav-user">
							<a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= Yii::$app->request->baseUrl . '/images/' . 'user.png' ?>" class="user-avatar-md rounded-circle"></a>
							<div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
								<div class="nav-user-info">
									<h3 class="mb-0 text-center text-white nav-user-name">duy </h3>
									<span class="text-center status"></span><div class="text-center">active </div>
								</div>
								<!--
								<a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
								<a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
								-->
								<a class="dropdown-item" href="lib/logout/logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			
		</div>
		<!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
		<div class="nav-left-sidebar sidebar-dark">
			
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
								<a class="nav-link" href="#" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Tạo tài khoản</a>
								
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Các bảng hiện có</a>
								
							</li>
							<li class="nav-item ">
								<a class="nav-link" href="#" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Tạo bảng mới</a>
								
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Chỉnh sửa bảng</a>
								
							</li>
						</ul>
					</div>
				</nav>
			</div>
			
		</div>
		<!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  --> 
        <!-- ============================================================== -->
		<div class="dashboard-wrapper">
			<div class="dashboard-ecommerce">
				<div class="container-fluid dashboard-content " style="overflow-x:auto;">
					<div class="progress" style="display:none;">
						<div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
					</div>
					<div class="row">
						
						<?= $content ?>
						
					</div>
					
				</div>
			</div>
			<!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
			<div class="footer">
				
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12"></div>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="text-md-right footer-links d-none d-sm-block"></div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
