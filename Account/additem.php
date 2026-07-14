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
				<p><center>Only Staff have access to the Panel of Items</center></p>
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
			<li><?php if(!(isset($_GET['edit']))){ ?>Add Item<?php }else{ ?>Edit Item<?php } ?></li>
		</ul>
		
		<div class="row gutter30">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div style='padding: 10px 50px 10px 50px;'>
			<h2>Add Item</h2>
				<br />
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['itid']);
						$nome = addslashes($_POST['add-term']);
						$staf = addslashes($_POST['staff']);
						$member = addslashes($_POST['member']);
						$acs = addslashes($_POST['coins']);
						$temp = addslashes($_POST['temp']);
						$level = addslashes($_POST['level']);
						$rarity = addslashes($_POST['rare']);
						$preco = addslashes($_POST['preco']);
						$tipo = addslashes($_POST['tipo']);
						$file = addslashes($_POST['file']);
						$link = addslashes($_POST['link']);
						$enh = addslashes($_POST['enhid']);
						$fac = addslashes($_POST['facid']);
						$reqrepu = addslashes($_POST['rrepu']);
						$reqclass = addslashes($_POST['rclass']);
						$reqclasspoints = addslashes($_POST['rcpoints']);
						$acumular = addslashes($_POST['stack']);
						$desc = addslashes($_POST['desc']);
						
						if($tipo == "Item" || $tipo == "Enhancement"){
							$file = "none";
							$link = "none";
						}
						
						$busca_it_add = mysql_query("SELECT Name FROM items WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> There is already a Item with that ID!
		            </div>";
						}else{
							$continua = true;							
							switch($tipo){
								case "Sword":
									//$destino_file = "items/swords/";
									$es = "Weapon";
									$icon = "iwsword";
								break;
								case "Dagger":
									//$destino_file = "items/daggers/";
									$es = "Weapon";
									$icon = "iwdagger";
								break;
								case "Staff":
									//$destino_file = "items/staves/";
									$es = "Weapon";
									$icon = "iwstaff";
								break;
								case "Polearm":
									//$destino_file = "items/polearms/";
									$es = "Weapon";
									$icon = "iwpolearm";
								break;
								case "Axe":
									//$destino_file = "items/axes/";
									$es = "Weapon";
									$icon = "iwaxe";
								break;
								case "Bow":
									//$destino_file = "items/bows/";
									$es = "Weapon";
									$icon = "iwbow";
								break;
								case "Mace":
									//$destino_file = "items/maces/";
									$es = "Weapon";
									$icon = "iwmace";
								break;
								case "Armor":
									//$destino_file = "classes/";
									$es = "co";
									$icon = "iwarmor";
								break;
								case "Class":
									//$destino_file = "classes/";
									$es = "ar";
									$icon = "iib4";
								break;
								case "Pet":
									//$destino_file = "items/pets/";
									$es = "pe";
									$icon = "iipet";
								break;
								case "Helm":
									//$destino_file = "items/helms/";
									$es = "he";
									$icon = "iihelm";
								break;
								case "Cape":
									//$destino_file = "items/capes/";
									$es = "ba";
									$icon = "iicape";
								break;
								case "House":
									$es = "ho";
									$icon = "ihhouse";
								break;
								case "Floor Item":
									$es = "hi";
									$icon = "ihfloor";
								break;
								case "Wall Item":
									$es = "hi";
									$icon = "ihwall";
								case "Item":
									$es = "None";
									$icon = "iibag";
								break;
								default:
									$continua = false;
								break;
							}
							
							if($continua){
								if(mysql_query("INSERT INTO `items` (`id`, `Name`, `Description`, `Type`, `File`, `Link`, `Icon`, `Equipment`, `Level`, `Rarity`, `Stack`, `Cost`, `Coins`, `Temporary`, `Upgrade`, `Staff`, `EnhID`, `FactionID`, `ReqReputation`, `ReqClassID`, `ReqClassPoints`) VALUES ('$id' , '$nome', '$desc', '$tipo', '$file', '$link', '$icon', '$es', '$level', '$rarity', '$acumular', '$preco', '$acs', '$temp', '$member', '$staf', '$enh', '$fac', '$reqrepu', '$reqclass', '$reqclasspoints')")){
									
								mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Added the item: $nome', '$ip')");
									
									echo "<b style='color: green'>Item Add with Sucess. Item ID: $id</b>";
								}else{
									echo "<b style='color: red'>All fields have been filled in correctly, but an error occurred when sending to the database, please try again later</b>";
								}
							}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Error! Check the fields!
		            </div>";
							}
						}
						echo "<br /><br />";
					}
				?>
			</div>
			<form method="POST">
				<table>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item ID: </td><td><input type="text" name="itid" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['itid']; ?>" maxlength="8"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item name: </td><td><input type="text" name="add-term" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['add-term']; ?>" maxlength="50"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Description: </td><td><textarea name="desc" class="elastic form-control required"><?php echo $_POST['desc']; ?></textarea></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Type: </td>
						<td>
							<select name="tipo" onchange="exibeMsg(this.value);">
								<option value="Sword">Sword</option>
								<option value="Dagger">Dagger</option>
								<option value="Staff">Staff</option>
								<option value="Polearm">Polearm</option>
								<option value="Axe">Axe</option>
								<option value="Bow">Bow</option>
								<option value="Mace">Mace</option>
								<option value="Armor">Armor</option>
								<option value="Pet">Pet</option>
								<option value="Helm">Helm</option>
								<option value="Cape">Cape</option>
								<option value="House">House</option>
								<option value="Floor Item">Floor Item</option>
								<option value="Wall Item">Wall Item</option>
								<option value="Item">Bag</option>
							</select>
						</td>
					</tr>
					<tr id="txt">
						<script>
							function exibeMsg(valor){
								switch (valor){
									break;
									case 'Item':
										document.getElementById('txt').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">Bag Stock: <font color="red" style="font-size: 10px;">(Example: Bone Dust x50)</font> </td><td><input type="text" value="1" name="acumular" /></td>';
										document.getElementById('sfile').innerHTML = '';
										document.getElementById('slink').innerHTML = '';
									break;
									case 'Enhancement':
										document.getElementById('sfile').innerHTML = '';
										document.getElementById('slink').innerHTML = '';
										document.getElementById('txt').innerHTML = '';
									break;
									default:
										document.getElementById('txt').innerHTML = '';
										document.getElementById('sfile').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File: </td><td><input type="text" name="file" value="<?php echo $_POST['file']; ?>" placeholder="Example: items/swords/Caladbolg.swf"></td>';
										document.getElementById('slink').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">Linkage: </td><td><input type="text" name="link" value="<?php echo $_POST['link']; ?>" placeholder="Example: Caladbolg"></td>';
									break;
								}
							}
						</script>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr id="sfile">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">SWF File: </td><td><input type="text" name="file" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['file']; ?>" placeholder="Example: items/swords/Caladbolg.swf"></td>
					</tr>
					<tr id="slink">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Linkage: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="link" value="<?php echo $_POST['link']; ?>" placeholder="Example: Caladbolg"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['level'])){ echo $_POST['level']; }else{ echo 1; } ?>" name="level"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rarity <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['rare'])){ echo $_POST['rare']; }else{ echo 10; } ?>" name="rare"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Stack: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['stack'])){ echo $_POST['stack']; }else{ echo 1; } ?>" name="stack"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Price <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['preco'])){ echo $_POST['preco']; }else{ echo 0; } ?>" name="preco" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Coins: </td>
						<td>
							<select name="coins">
								<?php if(isset($_POST['coins']) && $_POST['coins'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Temporary: </td>
						<td>
							<select name="temp">
								<?php if(isset($_POST['temp']) && $_POST['temp'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
						<td>
							<select name="member">
								<?php if(isset($_POST['member']) && $_POST['member'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff: </td>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">EnhancementID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['enhid'])){ echo $_POST['enhid']; }else{ echo 1957; } ?>" name="enhid"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">FactionID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['facid'])){ echo $_POST['facid']; }else{ echo 1; } ?>" name="facid"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqReputation: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['rrepu'])){ echo $_POST['rrepu']; }else{ echo 0; } ?>" name="rrepu"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqClassID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['rclass'])){ echo $_POST['rclass']; }else{ echo 0; } ?>" name="rclass"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqClassPoints: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['rcpoints'])){ echo $_POST['rcpoints']; }else{ echo 0; } ?>" name="rcpoints"></td>
					</tr>
					<br>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Add Item"></td></tr>
				</table>
			</form>
			<?php }else{ ?>
			<div style='padding: 10px 50px 10px 50px;'>
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit item</h6>
								</ul>				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_coins = addslashes($_POST['ed_coins']);
						$ed_member = addslashes($_POST['ed_member']);
						$ed_temp = addslashes($_POST['ed_temp']);
						$ed_preco = addslashes($_POST['ed_preco']);
						$ed_level = addslashes($_POST['ed_level']);
						$ed_file = addslashes($_POST['ed_file']);
						$ed_link = addslashes($_POST['ed_link']);
						$ed_desc = addslashes($_POST['ed_desc']);
						$ed_tipo = addslashes($_POST['ed_tipo']);
						$ed_enhi = addslashes($_POST['ed_enhid']);
						$ed_faci = addslashes($_POST['ed_facid']);
						$ed_reqrepu = addslashes($_POST['ed_rrepu']);
						$ed_reqclass = addslashes($_POST['ed_rclass']);
						$ed_reqclasspoints = addslashes($_POST['ed_rcpoints']);
						$ed_rarity = addslashes($_POST['ed_rare']);
						$ed_staf = addslashes($_POST['ed_staff']);
						$ed_stack = addslashes($_POST['ed_stack']);
						
						switch($ed_tipo){
								case "Sword":
									$es = "Weapon";
									$icon = "iwsword";
								break;
								case "Dagger":
									$es = "Weapon";
									$icon = "iwdagger";
								break;
								case "Staff":
									$es = "Weapon";
									$icon = "iwstaff";
								break;
								case "Polearm":
									$es = "Weapon";
									$icon = "iwpolearm";
								break;
								case "Axe":
									$es = "Weapon";
									$icon = "iwaxe";
								break;
								case "Bow":
									$es = "Weapon";
									$icon = "iwbow";
								break;
								case "Mace":
									$es = "Weapon";
									$icon = "iwmace";
								break;
								case "Armor":
									$es = "co";
									$icon = "iwarmor";
								break;
								case "Pet":
									$es = "pe";
									$icon = "iipet";
								break;
								case "Helm":
									$es = "he";
									$icon = "iihelm";
								break;
								case "Cape":
									$es = "ba";
									$icon = "iicape";
								break;
								case "Item":
									$es = "None";
									$icon = "iibag";
								break;
								case "Enhancement":
									$es = "Weapon";
									$icon = "none";
								break;
								case "House":
									$es = "ho";
									$icon = "ihhouse";
								break;
								case "Floor Item":
									$es = "hi";
									$icon = "ihfloor";
								break;
								case "Wall Item":
									$es = "hi";
									$icon = "ihwall";
								break;
								default:
									$continua = false;
								break;
							}
						
						if(empty($ed_name)){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Error! Check the fields!
		            </div>";
		            						}else{
						if(mysql_query("UPDATE items SET `Name`='$ed_name', `Description`='$ed_desc', `Type`='$ed_tipo', `File`='$ed_file', `Link`='$ed_link', `Icon`='$icon', `Equipment`='$es', `Level`='$ed_level', `Rarity`='$ed_rarity', `Stack`='$ed_stack', `Cost`='$ed_preco', `Coins`='$ed_coins', `Temporary`='$ed_temp', `Upgrade`='$ed_member', `Staff`='$ed_staf', `EnhID`='$ed_enhi', `FactionID`='$ed_faci', `ReqReputation`='$ed_reqrepu', `ReqClassID`='$ed_reqclass', `ReqClassPoints`='$ed_reqclasspoints' WHERE `id`='$ed_id'")){
						
						mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Edited the item: $ed_id', '$ip')");
						
								echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'Listitem.php';
}, 5000);
</script>
		            </div>";
							}else{
								echo "<b style='color: red'>All fields have been filled in correctly, but an error occurred when sending to the database, please try again later</b><br /><br />";
							}
						}
					}
				?>
			</div>
				<?php
					$edit = addslashes($_GET['edit']);
					$busca_edit = mysql_query("SELECT * FROM items WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$types = "Sword,Dagger,Staff,Polearm,Axe,Mace,Armor,Class,Pet,Helm,Cape,Item,Enhancement,House,Floor Item,Wall Item";
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_coins = $fetch_edit['Coins'];
						$edit_upg = $fetch_edit['Upgrade'];
						$edit_temp = $fetch_edit['Temporary'];
						$edit_staff = $fetch_edit['Staff'];
						$edit_cost = $fetch_edit['Cost'];
						$edit_rarity = $fetch_edit['Rarity'];
						$edit_lvl = $fetch_edit['Level'];
						$edit_stack = $fetch_edit['Stack'];
						$edit_enh = $fetch_edit['EnhID'];
						$edit_fac = $fetch_edit['FactionID'];
						$edit_repu = $fetch_edit['ReqReputation'];
						$edit_class = $fetch_edit['ReqClassID'];
						$edit_classp = $fetch_edit['ReqClassPoints'];
						$edit_name = $fetch_edit['Name'];
						$edit_file = $fetch_edit['File'];
						$edit_link = $fetch_edit['Link'];
						$edit_desc = $fetch_edit['Description'];
						$edit_es = $fetch_edit['ES'];
						$edit_type = $fetch_edit['Type'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item Name: </td><td><input type="text" name="ed_name" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_name; ?>" maxlength="50"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Description: </td><td><textarea name="ed_desc" class="elastic form-control required"><?php echo $edit_desc; ?></textarea></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Type: </td>
								<td>
									<select name="ed_tipo">
										<?php
											$tipos = explode(",", $types);
											for ($b = 0; $b < count($tipos); $b++) {
												if($edit_type == $tipos[$b]){
													if($edit_type == 'Item' || $edit_type == 'None')
														echo "<option value='Item'>{$tipos[$b]}</option>";
													else
														echo "<option value='{$tipos[$b]}'>{$tipos[$b]}</option>";
												}
											}
											for ($c = 0; $c < count($tipos); $c++) {
												if($edit_type != $tipos[$c]){
														if($edit_type == 'Item' || $edit_type == 'None')
															echo "<option value='Item'>{$tipos[$c]}</option>";
														else
															echo "<option value='{$tipos[$c]}'>{$tipos[$c]}</option>";
													}
											}
										?>
									</select>
								</td>
							</tr>
							<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr id="sfile">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">SWF File: </td><td><input type="text" name="ed_file" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_file; ?>" placeholder="Example: items/swords/Caladbolg.swf"></td>
					</tr>
					<tr id="slink">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Linkage: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_link" value="<?php echo $edit_link; ?>" placeholder="Example: Caladbolg"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_lvl; ?>" name="ed_level"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rarity <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_rarity; ?>" name="ed_rare"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Stack: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_stack; ?>" name="ed_stack"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Price <font color="red" style="font-size: 10px;">(Only Numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_cost; ?>" name="ed_preco" maxlength="9"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Coins: </td>
						<td>
							<select name="ed_coins">
								<?php if($edit_coins > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Temporary: </td>
						<td>
							<select name="ed_temp">
								<?php if($edit_temp > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
						<td>
							<select name="ed_member">
								<?php if($edit_member > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff: </td>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">EnhancementID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_enh; ?>" name="ed_enhid"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">FactionID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_fac; ?>" name="ed_facid"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqReputation: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_repu; ?>" name="ed_rrepu"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqClassID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_class; ?>" name="ed_rclass"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ReqClassPoints: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_classp; ?>" name="ed_rcpoints"></td>
					</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Edit Item"></td></tr>
						</table>
					</form>
			<?php
				}else{
					echo "<b>There's no Item with that ID</b>";
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
			<span>2014 - 2015</span> © <a href="/" target="_blank">ArmagedomWorlds</a>
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