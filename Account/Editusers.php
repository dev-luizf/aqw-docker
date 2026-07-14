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
				<p><center>Only Administrators have access to the Panel of Players</center></p>
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
			<li><a href="index.php">Search: <?php echo $_GET['user']; ?></a></li>
			<li>Edit Player: <?php echo $_GET['user']; ?></li>
		</ul>
		
		<div class="row gutter30">
			<div class="block full">
				<div class="block-title">
					<h2><i class="fa fa-search"></i> Get Another Player</h2>
				</div>
				<form action="busca.php" method="post">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['search-term']); ?>" name="search-term" class="form-control" placeholder="Player Name...">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			
			
			<h3>Edit Player: "<?php echo $_GET['user']; ?>"</h3>
			
			<?php
				$player = addslashes($_GET['user']);
				$busca_edit = mysql_query("SELECT * FROM users WHERE Name='$player'");
				$conta_edit = mysql_num_rows($busca_edit);
			?>
			<?php if($conta_edit > 0){ ?>
			
				<?php
					$fetch_edit = mysql_fetch_array($busca_edit);
					
					$busca_max_lvl = mysql_query("SELECT value FROM settings_rates WHERE name='intLevelMax'");
					$fetch_max_lvl = mysql_fetch_array($busca_max_lvl);
					
					$cargo_edit = $fetch_edit['Name'];
					$user_id = $fetch_edit['id'];
				?>
				<div style="float: left; width: 50%">
					<h6>Account info</h6>
					
					<?php
						if(isset($_POST['acao']) && $_POST['acao'] == "Update"){
							if(!(empty($_SESSION['passlog']))){
								$continuar = true;
								
								if(isset($_POST['access'])){
									$cargo = $_POST['access'];
								}else{
									$cargo = $fetch_edit['Access'];
								}
								
								
								$gender = $_POST['gender'];
								
								$gold = $_POST['gold'];
								if($gold > 9999999999999){
									$gold = 9999999999999;
								}
								
								$coins = $_POST['coins'];
								if($coins > 9999999999999){
									$coins = 9999999999999;
								}
								
								$level = $_POST['level'];
								if($level > $fetch_max_lvl[0]){
									$level = $fetch_max_lvl[0];
								}
								
								$bag = $_POST['bag'];
								if($bag > 4000){
									$bag = 4000;
								}
								
								$house = $_POST['house'];
								if($house > 4000){
									$house = 4000;
								}
								
								$kill = $_POST['kills'];
								if($kill > 9999999999999){
									$kill = 9999999999999;
								}
								
								$death = $_POST['deaths'];
								if($death > 9999999999999){
									$death = 9999999999999;
								}
								
								$reb = $_POST['rebirths'];
								if($reb > 9999999999999){
									$reb = 9999999999999;
								}
								
								$staff = $_POST['staff'];
								if($staff > 2){
									$staff = 0;
								}
								
								$youtube = $_POST['yt'];
								if($youtube > 2){
									$youtube = 0;
								}
								
								if($continuar){
									mysql_query("UPDATE users SET Access='$cargo', Gender='$gender', Gold='$gold', Coins='$coins', Level='$level', SlotsBag='$bag', SlotsHouse='$house', KillCount='$kill', DeathCount='$death', Rebirth='$reb', Staff='$staff', YouTuber='$youtube' WHERE Name='$player'");
									
									mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Edited the player: $player', '$ip')");
									
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Updating the page...
		            </div>		            <script type='text/javascript'>   
function Redirect() 
{  
window.location='Editusers.php?user=$player'; 
} 
setTimeout('Redirect()', 3000);   
</script>";								}else{
									echo "<b style='color: red;'>Something wrong, fill the fields correctly</b>";
								}
							}else{
								echo "<b style='color: red;'>You can not change ranks</b>";
							}
						}
					?>
					
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>User Id: </td><td><?php echo $fetch_edit['id']; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Username: </td><td><?php echo $fetch_edit['Name']; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Rank: </td><td>
								
									<?php 
										if($access < 60){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not change ranks.
		            </div>";	
		             } else if($fetch_edit['Name'] == $user){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not change your rank.
		            </div>";										
		            	}else{
									?>
											<?php if($fetch_edit['Access'] >= 60){ ?>
												<select name="access">
													<option value="60">Administrator</option>
													<option value="40">Moderator</option>
													<option value="4">Helper</option>
													<option value="1">Player</option>
												</select>
											<?php }else if($fetch_edit['Access'] >= 40){ ?>
												<select name="access">
													<option value="40">Moderator</option>
													<option value="60">Administrator</option>
													<option value="4">Helper</option>
													<option value="1">Player</option>
												</select>
											<?php }else if($fetch_edit['Access'] >= 4){ ?>
												<select name="access">
													<option value="4">Helper</option>
													<option value="1">Player</option>
													<option value="40">Moderator</option>
													<option value="60">Administrator</option>
												</select>
											<?php }else if($fetch_edit['Access'] >= 1){ ?>
												<select name="access">
													<option value="1">Player</option>
													<option value="4">Helper</option>
													<option value="40">Moderator</option>
													<option value="60">Administrator</option>
												</select>
											<?php }else{ ?>
												Player banned
											<?php } ?>
									<?php } ?>
								
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Gender: </td><td>
								<select name="gender">
									<?php if($fetch_edit['Gender'] == 'M'){ ?>
										<option value="M">Male</option>
										<option value="F">Female</option>
									<?php }else if($fetch_edit['Gender'] == 'F'){ ?>
										<option value="F">Female</option>
										<option value="M">Male</option>
									<?php } ?>
								</select>
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Gold: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="gold" value="<?php echo $fetch_edit['Gold']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Coins: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="coins" value="<?php echo $fetch_edit['Coins']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Level: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="level" value="<?php echo $fetch_edit['Level']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Bag: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="bag" value="<?php echo $fetch_edit['SlotsBag']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>House: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="house" value="<?php echo $fetch_edit['SlotsHouse']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Kills: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="kills" value="<?php echo $fetch_edit['KillCount']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Deaths: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="deaths" value="<?php echo $fetch_edit['DeathCount']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Rebirths: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="rebirths" value="<?php echo $fetch_edit['Rebirth']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Staff: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="staff" value="<?php echo $fetch_edit['Staff']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>YouTuber: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="yt" value="<?php echo $fetch_edit['YouTuber']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Address: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $fetch_edit['Address']; ?>" readonly="true"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Server: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $fetch_edit['CurrentServer']; ?>" readonly="true"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Map: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(empty($fetch_edit['LastArea'])){ echo "Nenhum"; }else{ echo $fetch_edit['LastArea']; } ?>" readonly="true"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Last Login: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(empty($fetch_edit['LastLogin'])){ echo "Nenhum"; }else{ echo $fetch_edit['LastLogin']; } ?>" readonly="true"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" name="acao" value="Update"></td>
							</tr>
						</table>
					</form>
					
				</div>
				<div style="float: right; width: 50%">
				<h2>Add Item <font style="font-size: 20px"><a href="Listitem.php" target="_blank">Item List</a></font></h2>
					<?php
						if(isset($_POST['additem'])){
							if(!(empty($_SESSION['passlog']))){
								$itemid_add = addslashes($_POST['itemid']);
								$quant_add = addslashes($_POST['quantidade']);
								
								$busca_add = mysql_query("SELECT * FROM items WHERE id='$itemid_add'");
								$conta_add = mysql_num_rows($busca_add);
								
								$busca_play_add = mysql_query("SELECT id FROM users_items WHERE itemid='$itemid_add' AND userid='$user_id'");
								$conta_play_add = mysql_num_rows($busca_play_add);
								
								if(empty($itemid_add) || empty($quant_add)){
									echo "<b style='color: red;'>Enter the ID of the Item and the amount</b>";
								}else if($conta_add <= 0){
									echo "<b style='color: red;'>There is no Item with this ID</b>";
								}else if($conta_play_add > 0){
									echo "<b style='color: green;'>Item added to the account</b>";
								}else{
									$fetch_add = mysql_fetch_array($busca_add);
									$data = "20" . date("y/m/d") . " " . date("H:i:s");
									
									mysql_query("INSERT INTO `users_items` (itemid, userid, equipped, quantity, EnhID, Bank, DatePurchased) VALUES ('$itemid_add', '$user_id', '0', '$quant_add', '1957', '0', '$data')");
									
									mysql_query("INSERT INTO admin_logs (`staff`, `info`, `ip`) VALUES ('$user', 'Added the item: $itemid_add - for the player: $player', '$ip')");
									
									echo "<script>history.go(0)</script>";
								}
							}else{
								echo "<b style='color: red;'>You are not logged in</b>";
							}
						}
					?>
					
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 0px;'>Item ID: </td><td><input type="text" name="itemid"> </td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 0px;'>Quantity: </td><td><input type="text" name="quantidade" value="1"> </td>
							</tr><tr>
								<td></td><td><input type="submit" name="additem" value="Add Item"> </td>
							</tr>
						</table>
					</form>
				</div>
			<?php }else{ ?>
				<b>Player Does Not Exist</b>
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