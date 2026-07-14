<?php
	#NÃO ALTERE O ARQUIVO SE NÃO SOUBER O QUE ESTÁ FAZENDO!
	error_reporting(0);
	session_start();
	
	include "geral.php";
	
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	$db = mysql_select_db(DB_DATA);
	
	#CONFIGURAÇÕES DA SESSION
	$useron = $_SESSION['userlog'];
	$passon = $_SESSION['passlog'];
	
	if(!(empty($passon))){
		$user = addslashes($useron);
		$pass = addslashes($passon);
		$busca_user = mysql_query("SELECT * FROM users WHERE Name='$user' AND Hash='$pass'");
		$fetch_user = mysql_fetch_array($busca_user);
		
		$brin = $fetch_user['Brinde'];
		$id = $fetch_user['id'];
		$name = $fetch_user['Name'];
		$pass = $fetch_user['Hash'];
		$level = $fetch_user['Level'];
		$email = $fetch_user['Email'];
		$gold = $fetch_user['Gold'];
		$coins = $fetch_user['Coins'];
		$kills = $fetch_user['Kills'];
		$deaths = $fetch_user['Deaths'];
		$wkills = $fetch_user['KillCount'];
		$wdeaths = $fetch_user['DeathCount'];
		$reb = $fetch_user['Rebirth'];
		$datcret = $fetch_user['DateCreated'];
		$lastlogin = $fetch_user['LastLogin'];
		$staff = $fetch_user['Staff'];
		$youtuber = $fetch_user['YouTuber'];
		$rank = $fetch_user['PRank'];
		$pvprank = $fetch_user['PvPRank'];
		$tcoins = $fetch_user['TCoins'];
		$bag = $fetch_user['SlotsBag'];
		$bank = $fetch_user['SlotsBank'];
		$house = $fetch_user['SlotsHouse'];
		$ip = $fetch_user['Address'];
		$access = $fetch_user['Access'];
		switch($access){
			case 60:
				$titulo = "Staff";
				break;
			case 40:
				$titulo = "Staff";
				break;
			case 33:
				$titulo = "Founder";
				break;
			case 29:
				$titulo = "Unconquerable";
				break;
			case 28:
				$titulo = "Supreme Commander";
				break;
			case 24:
				$titulo = "High Emperor";
				break;
			case 22:
				$titulo = "Killer";
				break;
			case 27:
				$titulo = "A Millionaire";
				break;
			case 19:
				$titulo = "Top Killer";
				break;
			case 16:
				$titulo = "A Thousand";
				break;
			case 15:
				$titulo = "YouTuber";
				break;
			case 14:
				$titulo = "Grim Reaper";
				break;
			case 12:
				$titulo = "Warlord";
				break;
			case 0:
				$titulo = "Player Banned";
				break;
			default:
				$titulo = "No Title";
		}
	
	$busca_servers = mysql_query("SELECT SUM(Count) FROM servers WHERE Online>0");
	$fetch_servers = mysql_fetch_array($busca_servers);
	
	$busca_max = mysql_query("SELECT SUM(Max) FROM servers WHERE Online>0");
	$fetch_max = mysql_fetch_array($busca_max);
	
	$busca_users = mysql_query("SELECT id FROM users");
	$conta_users = mysql_num_rows($busca_users);
	
	$busca_staff = mysql_query("SELECT id FROM users WHERE Access>=40");
	$conta_staff = mysql_num_rows($busca_staff);
	
	$busca_staff_on = mysql_query("SELECT id FROM users WHERE Access>=40 AND CurrentServer!='Offline'");
	$conta_staff_on = mysql_num_rows($busca_staff_on);
	
	$busca_ban = mysql_query("SELECT id FROM users WHERE Access<1");
	$conta_ban = mysql_num_rows($busca_ban);
	
	}
		
	if(isset($_GET['logout'])){
		unset($_SESSION['userlog']);
		unset($_SESSION['passlog']);
		echo "<script>history.go(-1)</script>";
	}
?>