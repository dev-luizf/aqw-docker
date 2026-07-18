<?php
$local = getenv('MYSQL_HOST') !== false && getenv('MYSQL_HOST') !== '' ? getenv('MYSQL_HOST') : '127.0.0.1';
$usuario = getenv('MYSQL_USER') !== false && getenv('MYSQL_USER') !== '' ? getenv('MYSQL_USER') : 'root';
$senha = getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '';
$banco = getenv('MYSQL_DATABASE') !== false && getenv('MYSQL_DATABASE') !== '' ? getenv('MYSQL_DATABASE') : 'mextv3';
mysql_connect($local, $usuario, $senha) or die("Erro ao Connectar");
mysql_select_db($banco) or die("Erro ao selecionar a DB");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge;" />
<meta charset="utf-8" />
<!-- Start of Header control -->
<title>AW - Guild Ranking</title>
<meta name="Description" content="Master your skills and stand against Nefer in this free-to-play MMORPG. Impressive graphics, strategic combat, battle zones system, story driven quests." />
<meta name="Keywords" content="c9, continent of the ninth, unlimited combos, precise control, unrivaled action" />
<!-- End of Header control -->
<script type="text/javascript" src="/templates/Scripts/HeadInfoe532.js?_=081315"></script>
<script src="/templates/Scripts/GameStarter4254.js?_=120814"></script>
	<script src="/templates/Scripts/Layout.mine532.js?_=081315"></script>
    <script>snowStorm.excludeMobile = false;</script>
    <link type="text/css" rel="stylesheet" href="/templates/images/Armagedom/css/style.css" />
	<link rel="canonical" href="?index" />
    <script src="/templates/platform/ui_library/jquery.bxslider.min_4.1.2.js"></script> 
<body>
<center>
<!-- Tags Code For AdsWinner.com -->
<script type='text/javascript'>
    document.write('<script src="http://adswinner.com/tag-js/?did=7292&type=banner&adsize=size1&time='+ new Date().getTime() + '" type="text/javascript"><\/script>');
</script>
<!-- End Tags AdsWinner.com -->
</center>
<div id="siteVisualWrap">
	<div id="siteVisualConts">
		<div class="G_ContsWrap">
			<div class="space298"></div>
			<nav id="GameNavi">
		<ul id="GameMenuSkip">		
		<li>	
			<div class="on">
			<a href="/" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">HomePage</span>
				<span class="onRight"></span>
			</a>
		</li>
    <li>  
      <a href="Team.php" class="depth01" rel="nofollow">
        <span class="onLeft"></span>
        <span class="onCent">Staff</span>
        <span class="onRight"></span>
      </a>
    </li>
		<li>	
			<a href="Ranking.php" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">Rankings</span>
				<span class="onRight"></span>
			</a>
		</li>
		<li>	
			<a href="Maps.php" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">Maps List</span>
				<span class="onRight"></span>
			</a>
		</li>
		<li>	
			<a href="Rules.php" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">Rules</span>
				<span class="onRight"></span>
			</a>
		</li>
		<li>	
			<a href="Register.php" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">Register</span>
				<span class="onRight"></span>
			</a>
		</li>
		<li>	
			<a href="Account/Manage.php" class="depth01" rel="nofollow">
				<span class="onLeft"></span>
				<span class="onCent">Account</span>
				<span class="onRight"></span>
			</a>
		</li>
	</ul>
		</nav>
		<!-- PopAds.net Popunder Code for armagedomworlds.net -->
<script type="text/javascript" data-cfasync="false">
  var _pop = _pop || [];
  _pop.push(['siteId', 1380855]);
  _pop.push(['minBid', 0.000000]);
  _pop.push(['popundersPerIP', 0]);
  _pop.push(['delayBetween', 0]);
  _pop.push(['default', false]);
  _pop.push(['defaultPerDay', 0]);
  _pop.push(['topmostLayer', false]);
  (function() {
    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
    var s = document.getElementsByTagName('script')[0]; 
    pa.src = '//c1.popads.net/pop.js';
    pa.onerror = function() {
      var sa = document.createElement('script'); sa.type = 'text/javascript'; sa.async = true;
      sa.src = '//c2.popads.net/pop.js';
      s.parentNode.insertBefore(sa, s);
    };
    s.parentNode.insertBefore(pa, s);
  })();
</script>
<!-- PopAds.net Popunder Code End -->
		</head>
			<div id="contentStart">
				<div class="gContsBodyDiv">
					<section id="gContsBodyWrap">

				<section class='gContsViewWrap'>
						


<script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function () {
        var gads = document.createElement('script');
        gads.async = true;
        gads.type = 'text/javascript';
        var useSSL = 'https:' == document.location.protocol;
        gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js';
        var node = document.getElementsByTagName('script')[0];
        node.parentNode.insertBefore(gads, node);
    })();
</script>
<style type="text/css">#r03e{position:fixed !important;position:absolute;top:-1px;top:expression((t=document.documentElement.scrollTop?document.documentElement.scrollTop:document.body.scrollTop)+"px");left:3px;width:101%;height:102%;background-color:#fff;opacity:.95;filter:alpha(opacity=95);display:block;padding:20% 0}#r03e *{text-align:center;margin:0 auto;display:block;filter:none;font:bold 14px Verdana,Arial,sans-serif;text-decoration:none}#r03e ~ *{display:none}</style><script type="text/javascript">
// <![CDATA[
(function(l,m){function n(a){a&&r03e.nextFunction()}var h=l.document,p=["i","s","u"];n.prototype={rand:function(a){return Math.floor(Math.random()*a)},getElementBy:function(a,b){return a?h.getElementById(a):h.getElementsByTagName(b)},getStyle:function(a){var b=h.defaultView;return b&&b.getComputedStyle?b.getComputedStyle(a,null):a.currentStyle},deferExecution:function(a){setTimeout(a,2E3)},insert:function(a,b){var e=h.createElement("strong"),d=h.body,c=d.childNodes.length,g=d.style,f=0,k=0;if("r03e"==b){e.setAttribute("id",b);g.margin=g.padding=0;g.height="100%";for(c=this.rand(c);f<c;f++)1==d.childNodes[f].nodeType&&(k=Math.max(k,parseFloat(this.getStyle(d.childNodes[f]).zIndex)||0));k&&(e.style.zIndex=k+1);c++}e.innerHTML=a;d.insertBefore(e,d.childNodes[c-1])},displayMessage:function(a){var b=this;a="abisuq".charAt(b.rand(5));b.insert("<"+a+'><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZUAAAAPAgMAAABRv7o5AAAACVBMVEX9/f3IyMgAAAASOm6lAAACSklEQVQ4je2UsY6jMBCGjSWaqUOzT4D9FA7SNlTeCFLwBMk9BaK4ggohkiKVF9kR+ClvBm+yJBdpdf1ZII9m/uGzx2MY+z9+HLx+cvjpFpmeIunrJGBMvv7kSgZ6mczd76pbpGKPQ9xxvFtjFD1rTPdsYG5Q2Lvf3nIgf0j+xuCs/xUTh2mzwmQTSNwWbDMPzMh6DNWTAgx45htfQ53y2hPC4PsLMWD42JIYJj52nrcYIIM0UzoBG1sKGYYfMITxc15xR+kK9q2yzshQPTeLg9g3J3PUvBO8P+NSxAF1v2tQ4gDVhcSiggpDMwWqoKnkG6jrJ4aY5efmdCCMK0XWDLg7b6Ksb85DKrZUEz4IB4JpbQXuGqDSuBQHdLoGFIayi7oOaQzH7KKNwyoJMrBe6Gkp5CJlQY9dvBSN4UqpqG8F+L7vOyG+Ciq8zz33AZPn3oaDBEzG58gR42fpybB01oJfSBM8104EvQ1Fu2OwEvvO71YYV273bblg+JyXxd+YU+mqNYY0wfONSQ4BA7D7wkDnlXEiXCEzp5DyS2ZFShheY0FSbFRoBlCpyKFvrEmtJGMgDEBPGiuPvG8QkwKeTXOuBTWqZXzOAgbGTig5IMaFTptzv5ssODkxx/yAGkedprHBHPbVZKWTbYYNpglDnYYa2R55NyGG0pnX3tH1xMMvl3sRqajQMYvxhYJa/z0qo1KVm6iIS5QlKIowEL2rWKOx75JNXMQfqtCJWi4IGqiJP96ZTjY6XtITlRQP1241IvXa/zAefg0/jT8Xn/OD6fzcyQAAAABJRU5ErkJggg==" height="15" width="405" alt="" /> <a href="http://goo.gl/1PY4EI">[ ? ]</a>'+("</"+a+">"),"r03e");h.addEventListener&&b.deferExecution(function(){b.getElementBy("r03e").addEventListener("DOMNodeRemoved",function(){b.displayMessage()},!1)})},i:function(){for(var a="adSpace,adlandscape,adsense6,adspot-c,adv-mpux,bigAd1,slide_ad,ad,ads,adsense".split(","),b=a.length,e="",d=this,c=0,g="abisuq".charAt(d.rand(5));c<b;c++)d.getElementBy(a[c])||(e+="<"+g+' id="'+a[c]+'"></'+g+">");d.insert(e);d.deferExecution(function(){for(c=0;c<b;c++)if(null==d.getElementBy(a[c]).offsetParent||"none"==d.getStyle(d.getElementBy(a[c])).display)return d.displayMessage("#"+a[c]+"("+c+")");d.nextFunction()})},s:function(){var a={'pagead2.googlesyndic':'google_ad_client','js.adscale.de/getads':'adscale_slot_id','get.mirando.de/miran':'adPlaceId'},b=this,e=b.getElementBy(0,"script"),d=e.length-1,c,g,f,k;h.write=null;for(h.writeln=null;0<=d;--d)if(c=e[d].src.substr(7,20),a[c]!==m){f=h.createElement("script");f.type="text/javascript";f.src=e[d].src;g=a[c];l[g]=m;f.onload=f.onreadystatechange=function(){k=this;l[g]!==m||k.readyState&&"loaded"!==k.readyState&&"complete"!==k.readyState||(l[g]=f.onload=f.onreadystatechange=null,e[0].parentNode.removeChild(f))};e[0].parentNode.insertBefore(f,e[0]);b.deferExecution(function(){if(l[g]===m)return b.displayMessage(f.src);b.nextFunction()});return}b.nextFunction()},u:function(){var a="-ad-hrule-,/ad_image2.,/adsrv.,/asyncspc.,/google_adv/ad,/images/ad-,/txtad.,_ads_multi.,_static_ads.,/head486x60.".split(","),b=this,e=b.getElementBy(0,"img"),d,c;e[0]!==m&&e[0].src!==m&&(d=new Image,d.onload=function(){c=this;c.onload=null;c.onerror=function(){p=null;b.displayMessage(c.src)};c.src=e[0].src+"#"+a.join("")},d.src=e[0].src);b.deferExecution(function(){b.nextFunction()})},nextFunction:function(){var a=p[0];a!==m&&(p.shift(),this[a]())}};l.r03e=r03e=new n;h.addEventListener?l.addEventListener("load",n,!1):l.attachEvent("onload",n)})(window);
// ]]>
</script>
<article class="fanSiteWrap"> <div class="rankDateTab">
		<a href="Ranking.php" id="termweekly">Player</a>
		<a href="PvPRanking.php">PvP Ranking</a>
		<a href="GuildRanking.php">Guild</a>
	</div>
							
								
		<div>
			<div style="height:42px;"></div>
				 <center><h2>Guild Ranking</h2></center>
				 <?php
$selecionar = mysql_query("SELECT * FROM `guilds` ORDER BY `Level` DESC, `Wins` DESC, `Loss` ASC, `TotalKills` DESC LIMIT 15");
if(mysql_num_rows($selecionar) > 0){
?>
		</div>

			<table width="100%" class="rankTable" summary="PvP Ranking List">
				<thead>
					<tr>
				<th>Rank</th>
			    <th>Guild Name</th>
				<th>Guild Level</th>
				<th>Wins</th>
				<th>Loss</th>
				<th>TotalKills</th>
					</tr>
				</thead>
<?php
	  
$i = "0";
while($l = mysql_fetch_assoc($selecionar)){
		$username = $l['Name'];
		$level = $l['Level'];
		$max = $l['MaxMembers'];
		$win = $l['Wins'];
		$los = $l['Loss'];
		$kills = $l['TotalKills'];
		$i++;
?>

      <tr>
        <td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $i; ?></center><font></td>
        <td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $username; ?></center><font></td>
		<td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $level; ?></center><font></td>
		<td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $win; ?></center><font></td>
		<td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $los; ?></center><font></td>
		<td bgcolor="#FFFFFF"><font color="#000000"><center><?php echo $kills; ?></center><font></td>
        </tr>
      <?php } ?>
		</tbody>
  </table>
  <?php } ?>
  <p></p>
			</table>
		</article>
				</section>
					<section class="gContsSideWrap">

	<article class="mainSnsFanWrap">
<?php
$selecionar = mysql_query("SELECT * FROM `guilds` ORDER BY `Level` DESC, `Wins` DESC, `Loss` ASC, `TotalKills` DESC LIMIT 1");
if(mysql_num_rows($selecionar) > 0){
?>
<?php
	  
$i = "0";
while($l = mysql_fetch_assoc($selecionar)){
		$username = $l['Name'];
		$level = $l['Level'];
		$max = $l['MaxMembers'];
		$win = $l['Wins'];
		$los = $l['Loss'];
		$kills = $l['TotalKills'];
		$i++;
?>
		<h2>Best Guild on The Server</h2>
		<br>
		<center><img src="templates/images/armagedom/cms/guildimg.png"></center>
		<br>
		<center><h3><?php echo $username; ?></h3></center>

	</article>
<?php } ?>
<?php } ?>

				</section>
					</section>
				</div>
			</div>
			<article id="gStarter"><a href="#PLAY" title="Game Starter" onFocus="this.blur();" onclick="GameLib.Exec(1);return false;"></a></article>
			<article id="gDownload"><a href="Play.php" title="Game" onFocus="this.blur();"></a></article>
	<div class="bgBottom"></div>
</aside>
					</section>
            
			<article id="gGST_Wrap">
			</article>
		</div>
	</div>
</div>
<div id="siteVisualBottom" style="margin-bottom:0"><div class="visualBottom"></div></div>
<center>
<!-- Tags Code For AdsWinner.com -->
<script type='text/javascript'>
    document.write('<script src="http://adswinner.com/tag-js/?did=7292&type=banner&adsize=size1&time='+ new Date().getTime() + '" type="text/javascript"><\/script>');
</script>
<!-- End Tags AdsWinner.com -->
</center>	
</body>
</html>