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
				<p><center>Only Administrators have access to the Panel of Maps</center></p>
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
			<li><?php if(!(isset($_GET['edit']))){ ?>Add Map<?php }else{ ?>Edit Map<?php } ?></li>
		</ul>
		
		<div class="row gutter30">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div style='padding: 10px 50px 10px 50px;'>
			<h2>Add Map</h2>
				<br />
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$nome = addslashes($_POST['add-term']);
						$staff = addslashes($_POST['staff']);
						$upgrade = addslashes($_POST['upgrade']);
						$file = addslashes($_POST['file']);
						$maxplayer = addslashes($_POST['maxp']);
						$rlevel = addslashes($_POST['rlev']);
						$pvpm = addslashes($_POST['pvp']);
						
						$busca_it_add = mysql_query("SELECT Name FROM maps WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($id) || empty($nome) || ($id <= 0)){
							echo "<b style='color: red'>Fill in all fields correctly</b>";
						}else if($conta_it_add > 0){
							echo "<b style='color: red'>There is already a Map with that ID</b>";
						}else{
							if(mysql_query("INSERT INTO maps (`id`, `Name`, `File`, `MaxPlayers`, `ReqLevel`, `Upgrade`, `Staff`, `PvP`) VALUES ('$id', '$nome', '$file', '$maxplayer', '$rlevel', '$upgrade', '$staff', '$pvp')")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Added the map: $nome', '$ip')");
								
								echo "<b style='color: green'>Map Add with Sucess. Map ID: $id</b>";
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Map ID <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" name="id" value="<?php echo $_POST['id']; ?>" maxlength="8"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Nome: </td><td><input type="text" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">File: </td><td><input type="text" name="file" value="<?php echo $_POST['file']; ?>"></td>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Max Players: </td><td><input type="text" name="maxp" value="<?php echo $_POST['maxp']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Level: </td><td><input type="text" name="rlev" value="<?php echo $_POST['rlev']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
						<td>
							<select name="upgrade">
								<?php if(isset($_POST['upgrade']) && $_POST['upgrade'] > 0){ ?>
									<option value="1">Yes</option>
									<option value="0">No</option>
								<?php }else{ ?>
									<option value="0">No</option>
									<option value="1">Yes</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Only Staff: </td>
						<td>
							<select name="staff">
								<?php if(isset($_POST['staff']) && $_POST['staff'] > 0){ ?>
									<option value="1">Yes</option>
									<option value="0">No</option>
								<?php }else{ ?>
									<option value="0">No</option>
									<option value="1">Yes</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">PvP: </td>
						<td>
							<select name="pvp">
								<?php if(isset($_POST['pvp']) && $_POST['pvp'] > 0){ ?>
									<option value="1">Yes</option>
									<option value="0">No</option>
								<?php }else{ ?>
									<option value="0">No</option>
									<option value="1">Yes</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Add Map"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
			<div style='padding: 10px 50px 10px 50px;'>
				<h2>Edit Map</h2>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_staff = addslashes($_POST['ed_staff']);
						$ed_upgrade = addslashes($_POST['ed_upgrade']);
						$ed_file = addslashes($_POST['ed_file']);
						$ed_maxp = addslashes($_POST['ed_maxp']);
						$ed_rlev = addslashes($_POST['ed_rlev']);
						$ed_pvp = addslashes($_POST['ed_pvp']);
						
							if(mysql_query("UPDATE maps SET Name='$ed_name', File='$ed_file', MaxPlayers='$ed_maxp', ReqLevel='$ed_rlev', Upgrade='$ed_upgrade', Staff='$ed_staff', PvP='$ed_pvp' WHERE id='$ed_id'")){
								
							mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Edited the Map: $ed_id', '$ip')");
								
								echo "<div class='alert alert-success fade in block-inner'>
									<button type='button' class='close' data-dismiss='alert'>×</button>
									<i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
									setTimeout(function () { location.href = 'Listmap.php';
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
					$busca_edit = mysql_query("SELECT * FROM maps WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_name = $fetch_edit['Name'];
						$edit_staff = $fetch_edit['Staff'];
						$edit_upgrade = $fetch_edit['Upgrade'];
						$edit_file = $fetch_edit['File'];
						$edit_maxp = $fetch_edit['MaxPlayers'];
						$edit_rlev = $fetch_edit['ReqLevel'];
						$edit_pvp = $fetch_edit['PvP'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Map ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Nome: </td><td><input type="text" name="ed_name" value="<?php echo $edit_name; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">File: </td><td><input type="text" name="ed_file" value="<?php echo $edit_file; ?>"></td>
							</tr>
							<tr id="upload">
								<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Max Players: </td><td><input type="text" name="ed_maxp" value="<?php echo $edit_maxp; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Level: </td><td><input type="text" name="ed_rlev" value="<?php echo $edit_rlev; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
								<td>
									<select name="ed_upgrade">
										<?php if($edit_upgrade > 0){ ?>
											<option value="1">Yes</option>
											<option value="0">No</option>
										<?php }else{ ?>
											<option value="0">No</option>
											<option value="1">Yes</option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Only Staff: </td>
								<td>
									<select name="ed_staff">
										<?php if($edit_staff > 0){ ?>
											<option value="1">Yes</option>
											<option value="0">No</option>
										<?php }else{ ?>
											<option value="0">No</option>
											<option value="1">Yes</option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">PvP: </td>
								<td>
									<select name="ed_pvp">
										<?php if($edit_pvp > 0){ ?>
											<option value="1">Yes</option>
											<option value="0">No</option>
										<?php }else{ ?>
											<option value="0">No</option>
											<option value="1">Yes</option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Edit Map"></td></tr>
						</table>
					</form>
			<?php
				}else{
					echo "<b>There's no Map with that ID</b>";
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