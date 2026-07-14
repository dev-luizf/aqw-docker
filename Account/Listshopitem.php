<?php 
	if(!(include "template/css/fonts/config.php")){
		die("<center>FATAL ERROR: Arquivo de configuração não encontrado</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 40)){ ?>

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
				<p><center>Only Staff have access to the Panel of Items Shops</center></p>
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
					<li><a href="Index.php"><i class="fa fa-coffee"></i>Home</a></li>

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


<div id="page-container" class="full-width">
	<div id="fx-container" class="fx-opacity"><div id="page-content" class="block">
		
		<ul class="breadcrumb breadcrumb-top">
			<li><i class="fa fa-coffee"></i></li>
			<li><a href="Manage.php">Manage</a></li>
			<li>Get Shop Item: <?php echo $_POST['search-term']; ?></li>
		</ul>
		
		<div class="row gutter30">
			<div class="block full">
				<div class="block-title">
					<h2><i class="fa fa-search"></i> Add Shop Item</h2>
				</div>
				<form action="addshopitem.php" method="POST">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['sid']); ?>" name="sid" class="form-control" placeholder="Shop ID...">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			
			<div class="block full">
				<div class="block-title">
					<h2><i class="fa fa-search"></i> Get Shop Item</h2>
				</div>
				<form action="" method="post">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['search-term']); ?>" name="search-term" class="form-control" placeholder="Shop ID...">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		
		<table align="center">
		<tr>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>ID</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Shop ID</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Item ID</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Quantity Remain</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Edit</b></td>
		</tr>
			
		<?php
			if(!(isset($_POST['search-term']))){
				$_BS['PorPagina'] = 70;

				$sql = "SELECT COUNT(*) AS total FROM `shops_items`";
				$query = mysql_query($sql);
				$total = mysql_result($query, 0, 'total');

				$paginas =  (($total % $_BS['PorPagina']) > 0) ? (int)($total / $_BS['PorPagina']) + 1 : ($total / $_BS['PorPagina']);

				if (isset($_GET['pagina'])) {
					$pagina = (int)$_GET['pagina'];
				} else {
					$pagina = 1;
				}

				$pagina = max(min($paginas, $pagina), 1);
				$inicio = ($pagina - 1) * $_BS['PorPagina'];
				$sql = "SELECT * FROM `shops_items` ORDER BY `id` ASC LIMIT ".$inicio.", ".$_BS['PorPagina'];
				$query = mysql_query($sql);

				while ($resultado = mysql_fetch_assoc($query)) {
					$id = $resultado['id'];
					$shopid = $resultado['ShopID'];
					$itemid = $resultado['ItemID'];
					$quant = $resultado['QuantityRemain'];
					echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$shopid</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$itemid</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$quant</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
								<a href='addshopitem.php?edit=$id'><img src='template/edit.jpg' width='16px' alt='Função Editar'></a>
							</td>
						</tr>
					";
				}
				
				echo "</table>";

				if ($total > 0) {
					echo "<br /><br /><center>Other Shop Items: ";
					for($n = 1; $n <= $paginas; $n++) {
						echo '<a href="?pagina='.$n.'">'.$n.'</a>&nbsp;&nbsp;';
					}
					echo "</center>";
				}
			}else{
				$busca_prot = addslashes($_POST['search-term']);
				$busca_it = mysql_query("SELECT * FROM shops_items WHERE ((`ShopID` LIKE '%".$busca_prot."%') OR ('%".$busca_prot."%'))");
				$conta_it = mysql_num_rows($busca_it);
				if($conta_it > 0){
					while($fetch_it = mysql_fetch_array($busca_it)){
						$id = $fetch_it['id'];
						$shopid = $fetch_it['ShopID'];
						$itemid = $fetch_it['ItemID'];
						$quant = $fetch_it['QuantityRemain'];
						echo "
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$shopid</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$itemid</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$quant</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
								<a href='addshopitem.php?edit=$id'><img src='template/edit.jpg' width='16px' alt='Função Editar'></a>
							</td>
							</tr>
						";
					}
				}else{
					echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>SHOP ITEM</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>NOT</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>FOUND!</td>
						</tr>";
				}
				echo "</table>
				<center><a href='Listshopitem.php'><br /><br />Complete list of Shop Items</a></center>
				";
			}
		?>
		
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