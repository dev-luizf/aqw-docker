<?php 
	if(!(include "template/css/fonts/config.php")){
		die("<center>FATAL ERROR: Arquivo de configuração não encontrado</center>");
	}
?>
<?php if(!(empty($passon)) && ($staff < 2)){ ?>

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
				<p><center>Only Administrators have access to the Panel of Monsters</center></p>
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
			<li><?php if(!(isset($_GET['edit']))){ ?>Add Monster<?php }else{ ?>Edit Monster<?php } ?></li>
		</ul>
		
		<div class="row gutter30">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div style='padding: 10px 50px 10px 50px;'>
			<h2>Add Monster</h2>
				<br />
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$name = addslashes($_POST['add-term']);
						$mnofile = addslashes($_POST['monfile']);
						$monlink = addslashes($_POST['monlink']);
						$monlvl = addslashes($_POST['monlvl']);
						$monheal = addslashes($_POST['monheal']);
						$goldd = addslashes($_POST['goldd']);
						$xpd = addslashes($_POST['xpd']);
						$cpd = addslashes($_POST['cpd']);
						$dps = addslashes($_POST['monlink']);
						
						$busca_it_add = mysql_query("SELECT id FROM monsters WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($id) || empty($add-term) || ($id <= 0)){
							echo "<b style='color: red'>Fill in all fields correctly</b>";
						}else if($conta_it_add > 0){
							echo "<b style='color: red'>There is already a Monster with that ID</b>";
						}else{
							if(mysql_query("INSERT INTO monsters (`id`, `Name`, `File`, `Linkage`, `Level`, `Health`, `Gold`, `Experience`, `Reputation`, `DPS`) VALUES ('$monid', '$name', '$mnofile', '$monlink', '$monlvl', '$monheal', '$goldd', '$xpd', '$cpd', 'dps')")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Added the monster: $add-term', '$ip')");
								
								echo "<b style='color: green'>Monster Add with Success. Monster ID: $monid</b>";
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster ID <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" name="id" value="<?php echo $_POST['id']; ?>" maxlength="8"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Name: </td><td><input type="text" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster File: </td><td><input type="text" name="monfile" value="<?php echo $_POST['monfile']; ?>"></td>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Linkage: </td><td><input type="text" name="monlink" value="<?php echo $_POST['monlink']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Level: </td><td><input type="text" name="monlvl" value="<?php echo $_POST['monlvl']; ?>" maxlength="3"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Health: </td><td><input type="text" name="monheal" value="<?php echo $_POST['monheal']; ?>" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold Drop: </td><td><input type="text" name="goldd" value="<?php echo $_POST['goldd']; ?>" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Xp Drop: </td><td><input type="text" name="xpd" value="<?php echo $_POST['xpd']; ?>" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Class Points Drop: </td><td><input type="text" name="cpd" value="<?php echo $_POST['cpd']; ?>" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">DPS: </td><td><input type="text" name="dps" value="<?php echo $_POST['dps']; ?>" maxlength="9"></td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Add Monster"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
			<div style='padding: 10px 50px 10px 50px;'>
				<h2>Edit Monster</h2>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_monname = addslashes($_POST['ed_monname']);
						$ed_monfile = addslashes($_POST['ed_monfile']);
						$ed_monlink = addslashes($_POST['ed_monlink']);
						$ed_monlvl = addslashes($_POST['ed_monlvl']);
						$ed_monheal = addslashes($_POST['ed_monheal']);
						$ed_goldd = addslashes($_POST['ed_goldd']);
						$ed_xpd = addslashes($_POST['ed_xpd']);
						$ed_cpd = addslashes($_POST['ed_cpd']);
						$ed_dps = addslashes($_POST['ed_dps']);
						
							if(mysql_query("UPDATE monsters SET `Name`='$ed_monname', `File`='$ed_monfile', `Linkage`='$ed_monlink', `Level`='$ed_monlvl', `Health`='$ed_monheal', `Gold`='$ed_goldd', `Experience`='$ed_xpd', `Reputation`='$ed_cpd', `DPS`='$ed_dps' WHERE `id`='$ed_id'")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Edited the Monster: $ed_id', '$ip')");
								
								echo "<div class='alert alert-success fade in block-inner'>
									<button type='button' class='close' data-dismiss='alert'>×</button>
									<i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
									setTimeout(function () { location.href = 'Listmon.php';
									}, 5000);
									</script>
									</div>";
							}else{
								echo "<b style='color: red'>All fields have been filled in correctly, but an error occurred when sending to the database, please try again later</b><br /><br />";
							}
						}
					
				?>
			</div>
				<?php
					$edit = addslashes($_GET['edit']);
					$busca_edit = mysql_query("SELECT * FROM monsters WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_moname = $fetch_edit['Name'];
						$edit_monfile = $fetch_edit['File'];
						$edit_monlink = $fetch_edit['Linkage'];
						$edit_monlvl = $fetch_edit['Level'];
						$edit_monheal = $fetch_edit['Health'];
						$edit_goldd = $fetch_edit['Gold'];
						$edit_xpd = $fetch_edit['Experience'];
						$edit_cpd = $fetch_edit['Reputation'];
						$edit_dps = $fetch_edit['DPS'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Name: </td><td><input type="text" name="ed_monname" value="<?php echo $edit_monname; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster File: </td><td><input type="text" name="ed_monfile" value="<?php echo $edit_monfile; ?>"></td>
							</tr>
							<tr id="upload">
								<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Linkage: </td><td><input type="text" name="ed_monlink" value="<?php echo $edit_monlink; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Level: </td><td><input type="text" name="ed_monlvl" value="<?php echo $edit_monlvl; ?>" maxlength="3"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Health: </td><td><input type="text" name="ed_monheal" value="<?php echo $edit_monheal; ?>" maxlength="9"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold Drop: </td><td><input type="text" name="ed_goldd" value="<?php echo $edit_goldd; ?>" maxlength="9"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Xp Drop: </td><td><input type="text" name="ed_xpd" value="<?php echo $edit_xpd; ?>" maxlength="9"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Class Points Drop: </td><td><input type="text" name="ed_cpd" value="<?php echo $edit_cpd; ?>" maxlength="9"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">DPS: </td><td><input type="text" name="ed_dps" value="<?php echo $edit_dps; ?>" maxlength="9"></td>
							</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Edit Monster"></td></tr>
						</table>
					</form>
			<?php
				}else{
					echo "<b>There's no Monster with that ID</b>";
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