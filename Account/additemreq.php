<?php 
	if(!(include "template/css/fonts/config.php")){
		die("<center>FATAL ERROR: Arquivo de configuração não encontrado</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 60)){ ?>

<html>
	<head>
		<title>Restricted Access</title>
		<link rel="stylesheet" href="template/css/style.css">
		<link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.0-alpha' type='text/css' media='all' />
	</head>
	<body>
		<div id="tudo">
			<div>&nbsp </div>
			<div id="conteudo" class="shadow">
				<div style="height: 30px;">&nbsp </div>
				<p><center>Only Administrators have access to the Panel of Item Req</center></p>
				<p><a href="../"><center>&raquo Back to Game</center></a></p>
			</div>
		</div>
	</body>
</html>

<?php }else if(!(empty($passon))){ ?>
<!DOCTYPE html>
<html class=" js no-touch">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta charset="iso-8858-1">
	<title>Staff - Painel</title>
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
	<link rel="shortcut icon" href="http://pixelcave.com/demo/freshui/img/favicon.ico">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon57.png" sizes="57x57">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon72.png" sizes="72x72">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon76.png" sizes="76x76">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon114.png" sizes="114x114">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon120.png" sizes="120x120">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon144.png" sizes="144x144">
	<link rel="apple-touch-icon" href="http://pixelcave.com/demo/freshui/img/icon152.png" sizes="152x152">

	<link rel="stylesheet" href="template/css/bootstrap-1.5.css">
	<link rel="stylesheet" href="template/css/plugins-1.5.css">
	<link rel="stylesheet" href="template/css/main-1.5.css">
	<link rel="stylesheet" href="template/css/themes.css">
	<script type="text/javascript" async="" src="template/js/ga.js"></script>
	<script src="template/js/modernizr-2.7.1-respond-1.4.2.min.js"></script>
</head>

<body class="header-fixed-top sidebar-left-pinned">
<div id="sidebar-left" class="enable-hover">
	<div class="sidebar-content">
		<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 573px;">
		
			<div class="sidebar-left-scroll" style="overflow: hidden; width: auto; height: 573px;">
				<ul class="sidebar-nav">
					<li><h2 class="sidebar-header">WELCOME</h2></li>
					<li><a href="index.php"><i class="fa fa-coffee"></i>Home</a></li>

					<li><h2 class="sidebar-header">GAME</h2></li>
					<li><a style="cursor: pointer;" class="menu-link"><i class="fa fa-rocket"></i>In Game</a>
						<ul>
							<li><a href="Listitem.php">Items List</a></li>
							<li><a href="Listitemreq.php">Items Requeriments List</a></li>
							<li><a href="Listshop.php">Shops List</a></li>
							<li><a href="Listshopitem.php">Shops Items List</a></li>
							<li><a href="Listmap.php">Maps List</a></li>
							<li><a href="Listmapmon.php">Map Monsters List</a></li>
							<li><a href="Listmon.php">Monster List</a></li>
							<li><a href="Listmondrop.php">Monster Drop List</a></li>
							<li><a href="Listreport.php">Reports List</a></li>
							<li><a href="Listrecrute.php">Recrutes List</a></li>
						</ul>
					</li>
					<li><a href="busca.php" class=" active"><i class="fa fa-th"></i>Players</a></li>
					<li><a href="logs.php"><i class="fa fa-file"></i>Logs</a></li>
					<li><a href="rules.php"><i class="fa fa-file"></i>Rules</a></li>
				</ul>
			</div>

			<div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 598.5110410094637px; background: rgb(255, 255, 255);"></div>
			<div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
		</div>
	</div>
</div>


<div id="page-container" class="full-width">
	<div id="fx-container" class="fx-opacity"><div id="page-content" class="block">
		<div class="block-header">
			<div class="row remove-margin">
				<div class="col-md-4">
					<a href="" class="header-title-link">
						<h1><i class="fa fa-coffee animation-expandUp"></i>Dashboard<br><small>Welcome <?php echo $useron; ?></small></h1>
					</a>
				</div>
				
				<div class="col-md-8">
					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div class="col-xs-6">
									<a href="lista.php?online" class="header-link">
										<h1 class="animation-pullDown">
											<strong><?php echo $fetch_servers[0]; ?></strong><br><small>Online</small>
										</h1>
									</a>
								</div>

								<div class="col-xs-6">
									<a class="header-link">
										<h1 class="animation-pullDown">
											<strong><?php echo $conta_users; ?></strong><br><small>Registered</small>
										</h1>
									</a>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="row">
								<div class="col-xs-6">
									<a href="lista.php?staffs" class="header-link">
										<h1 class="animation-pullDown">
											<strong><?php echo $conta_staff; ?></strong><br><small>Staffs</small>
										</h1>
									</a>
								</div>

								<div class="col-xs-6">
									<a href="lista.php?ban" class="header-link">
										<h1 class="animation-pullDown">
											<strong><?php echo $conta_ban; ?></strong><br><small>Banned</small>
										</h1>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<ul class="breadcrumb breadcrumb-top">
			<li><i class="fa fa-coffee"></i></li>
			<li><a href="index.php">Dashboard</a></li>
			<li><?php if(!(isset($_GET['edit']))){ ?>Add Item Req<?php }else{ ?>Edit Item Req<?php } ?></li>
		</ul>
		
		<div class="row gutter30">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div style='padding: 10px 50px 10px 50px;'>
			<h2>Add Item Req</h2>
				<br />
				<?php
					if(isset($_POST['add'])){
						$itemid = addslashes($_POST['iid']);
						$reqid = addslashes($_POST['riid']);
						$quant = addslashes($_POST['qua']);
						
						$busca_it_add = mysql_query("SELECT items_requirements WHERE ItemID='$itemid'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($itemid) || empty($reqid)){
							echo "<b style='color: red'>Fill in all fields correctly</b>";
						}else if($conta_it_add > 0){
							echo "<b style='color: red'>There is already a Shop Item with that ID</b>";
						}else{
							if(mysql_query("INSERT INTO items_requirements (`ItemID`, `ReqItemID`, `Quantity`) VALUES ('$itemid', '$reqid', '$quant')")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Added the item req: $itemid', '$ip')");
								
								echo "<b style='color: green'>Item Req Add with Sucess.</b>";
							}else{
								echo "<b style='color: red'>All fields have been filled in correctly, but an error occurred when sending to the database, please try again later</b>";
							}
						}
						echo "<br /><br />";
					}
				?>
			</div>
			<form action="" method="POST">
				<table>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item ID <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" name="iid" value="<?php echo $_POST['iid']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Item ID <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" name="riid" value="<?php echo $_POST['riid']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quantity <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" name="qua" value="<?php echo $_POST['qua']; ?>"></td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Add Item Req"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
			<div style='padding: 10px 50px 10px 50px;'>
				<h2>Edit Item Req</h2>
				<?php
					if(isset($_POST['edd'])){
						$ed_itid = addslashes($_POST['ed_iid']);
						$ed_reqid = addslashes($_POST['ed_rqid']);
						$ed_quant = addslashes($_POST['ed_qua']);
						
							if(mysql_query("UPDATE items_requirements SET ReqItemID='$ed_reqid', Quantity='$ed_quant' WHERE ItemID='$ed_itid'")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Edited the item req: $ed_itid', '$ip')");
								
								echo "<div class='alert alert-success fade in block-inner'>
									<button type='button' class='close' data-dismiss='alert'>×</button>
									<i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
									setTimeout(function () { location.href = 'Listitemreq.php';
									}, 5000);
									</script>
									</div>";
							}else{
								echo "<b style='color: red'>All fields have been filled in correctly, but an error occurred when sending to the database, please try again later</b>";
							}
						}
					
				?>
			</div>
				<?php
					$edit = addslashes($_GET['edit']);
					$busca_edit = mysql_query("SELECT * FROM items_requirements WHERE ItemID=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_itemid = $fetch_edit['ItemID'];
						$edit_reqid = $fetch_edit['ReqItemID'];
						$edit_quant = $fetch_edit['Quantity'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item ID: </td><td><?php echo $edit_itemid; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Item ID: </td><td><input type="text" name="ed_rqid" value="<?php echo $edit_reqid; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quantity: </td><td><input type="text" name="ed_qua" value="<?php echo $edit_quant; ?>"></td>
							</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_iid" value="<?php echo $edit_itemid; ?>"><input type="submit" name="edd" value="Editar Item Req"></td></tr>
						</table>
					</form>
			<?php
				}else{
					echo "<b>There's no Item Req with that ID</b>";
				}
			?>
		
		<?php } ?>
		
		<br /><br /><br />
		</div>
	</div>
	<!--[if IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->

	<footer class="clearfix">
		<div class="pull-right">
			<a href="" target="_blank">ArmagedomWorlds Staff</a>
		</div>
		<div class="pull-left">
			<span>2014 - 2016</span> © <a href="/" target="_blank">ArmagedomWorlds</a>
		</div>
	</footer>
	</div>
</div>

<a href="javascript:void(0)" id="to-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
	<script src="template/js/jquery.min.js"></script>
	<script src="template/js/bootstrap.min-1.5.js"></script>
	<script src="template/js/plugins-1.5.js"></script>
	<script src="template/js/main-1.5.js"></script>

</body>
</html>

<?php }else{ ?>
	<?php include "login.php"; ?>
<?php } ?>