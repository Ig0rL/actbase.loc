<!DOCTYPE html>
<html lang="en">

<head>
	<base href="/">
	<meta charset="utf-8">
    <?=$this->getMeta();?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="<?=DEF;?>css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="<?=DEF;?>css/addons/datatables-select.min.css" rel="stylesheet">
	<link href="<?=DEF;?>css/addons/datatables.min.css" rel="stylesheet">
	<link href="<?=DEF;?>css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
	<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.1.0/css/line-awesome.min.css">
	<!-- Your custom styles (optional) -->
	<link href="<?=DEF;?>css/style.css" rel="stylesheet">
</head>

<body class="bg">

<section id="main">
	<div class="container">
		<div class="row">
			<div class="col-lg-1 col-sm-12">
				<div class="menu">
					<a href="user"
					   data-toggle="tooltip"
					   data-placement="left"
					   title="Инженера"
					   class="material-tooltip-main mt-0 btn-floating btn-lg btn-success">
						<i class="fas fa-user-plus"></i>
					</a>
					<a data-toggle="tooltip"
					   data-placement="left"
					   title="Сделать выдачу"
					   href="extradition"
					   class="material-tooltip-main btn-floating btn-lg btn-success">
						<i class="fas fa-plus"></i>
					</a>
					<a data-toggle="tooltip"
					   data-placement="left"
					   title="Выгрузка"
					   href="export"
					   class="material-tooltip-main btn-floating btn-lg btn-success">
						<i class="fas fa-arrow-down"></i>
					</a>
					<?php if(isset($_SESSION['import'])): ?>
						<a data-toggle="tooltip"
						   data-placement="left"
						   title="Открытые сессии"
						   href="session"
						   class="ses-link material-tooltip-main btn-floating btn-lg btn-amber">
							<i class="fas fa-exclamation-circle" style="font-size: 50px;"></i>
						</a>
					<?php endif; ?>
				</div>
				<!-- /.menu -->
			</div>
			<!-- /.col-lg-2 col-sm-12 -->
			<div class="col-lg-10 col-sm-12 mx-auto">
                <?=$content?>
			</div>
			<!-- /.col-lg-10 col-sm-12 ml-auto -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>
<!-- /#main -->
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="<?=DEF;?>js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?=DEF;?>js/popper.min.js"></script>
<script src="<?=DEF;?>js/addons/datatables.min.js" rel="stylesheet"></script>
<!-- DataTables Select JS -->
<script src="<?=DEF;?>js/addons/datatables-select.min.js" rel="stylesheet"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?=DEF;?>js/bootstrap.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?=DEF;?>js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script src="<?=DEF;?>js/inputmask/jquery.inputmask.bundle.js"></script>
<script src="<?=DEF;?>js/jquery.ajaxzabro.js"></script>
<script src="<?=DEF;?>js/main.js"></script>
<script src="<?=DEF;?>js/ajax.js"></script>
</body>

</html>
