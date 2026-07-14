<?php /* Smarty version Smarty-3.1.16, created on 2015-12-07 07:15:11
         compiled from "templates\playnow\template.default.html" */ ?>
<?php /*%%SmartyHeaderCode:75035664f9bfc96244-90250305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d3d14eafe4be7bdf85d836b5eeb6b764bc14e73' => 
    array (
      0 => 'templates\\playnow\\template.default.html',
      1 => 1406619364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75035664f9bfc96244-90250305',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Description' => 0,
    'Title' => 0,
    'Root' => 0,
    'UserData' => 1,
    'CurrentMonth' => 0,
    'TargetAmount' => 0,
    'Settings' => 0,
    'FacebookId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5664f9bfdd1f30_60888954',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5664f9bfdd1f30_60888954')) {function content_5664f9bfdd1f30_60888954($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\classes\\class.smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
" />
<meta name="keywords" content="free mmo rpg, fantasy adventure game free to play, free mmo games no download, free mmo no download, free online mmo games no download" />
<title><?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
 - Private Server</title>
<script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/merged.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/tabcontent.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/soundmanager2.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/swfobject.js"></script>  
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/jquery.leanModal.min.js"></script> 
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/jquery.nicescroll.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/playnow/playnow.css"/>
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/images/favicon/favicon.ico">
</head>
<body>

<script type="text/javascript"> 
    var adfly_id = 7367510; 
    var adfly_advert = 'int'; 
    var frequency_cap = 5; 
    var frequency_delay = 5; 
    var init_delay = 3; 
    var popunder = true; 
</script> 
<script src="https://cdn.adf.ly/js/entry.js"></script>

<script>
$(function() {
  $("html").niceScroll({ spacebarenabled:false });
  $('a[rel*=leanModal]').leanModal({ top : ($(window).height() / 2), closeButton: ".modal_close" });    
  if (!<?php echo $_smarty_tpl->tpl_vars['UserData']->value->Login;?>
) {
    $("#dynamenu_wrapper").hide();
  } else {
      if ($(document).width() < 1730) { $("#dynamenu_wrapper").hide(); $("#main").css("margin-top", 0); }
      if (document.URL.indexOf("register") < 0) {
          if (<?php echo $_smarty_tpl->tpl_vars['UserData']->value->ActivationFlag;?>
 < 5) { $("#email").fadeIn(1000); }
          if (<?php echo $_smarty_tpl->tpl_vars['UserData']->value->Access;?>
 < 40 && <?php echo $_smarty_tpl->tpl_vars['CurrentMonth']->value;?>
 < <?php echo $_smarty_tpl->tpl_vars['TargetAmount']->value;?>
) { $("#go").trigger('click'); }
      }            
  }
});
</script>
<div id="dynamenu_wrapper">
  <div id="dynamenu">
    <ul class="tabs">
      <li class="" style="display:none;"><a href="#" rel="view0"> </a></li>
      <li class=""><a href="#" rel="view1" class="dyna_tab1"> </a></li>
      <li class=""><a href="#" rel="view2" class="dyna_tab2"> </a></li>
      <li class=""><a href="#" rel="view3" class="dyna_tab3"> </a></li>
    </ul>
    <div class="dynamenu_content">
      <div style="display:none;" id="view0" class="tabcontent"></div>
      <div id="view1" class="tabcontent">
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?tos" id="tabcon_tab1" target="_blank">Rules</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?faq" id="tabcon_tab2" target="_blank">Help</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?logout" id="tabcon_tab3" target="_blank">Log Out</a>
      </div>     
      <div id="view2" class="tabcontent">
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
game/register" id="tabcon_tab4" target="_blank">Create Avatar</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
account" id="tabcon_tab5" target="_blank">Settings</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?profile=<?php echo $_smarty_tpl->tpl_vars['UserData']->value->Name;?>
" id="tabcon_tab6" target="_blank">Equipment</a>
      </div>
      <div id="view3" class="tabcontent">
        <a href="#" id="tabcon_tab7">Party</a>
        <a href="#" id="tabcon_tab8">Friend</a>
        <a href="#" id="tabcon_tab9">Guild</a>
      </div>
    </div>
  </div>
</div>
<div id="main" name="main" align="center">

<table width="960" border="0" cellspacing="0" cellpadding="0">    
    <tr>
      <td width="960" height="550">
        <div id="fb-root" name="fb-root"></div>
        <div id="flashContent" name="flashContent">
            <form id="email" style="display: none;" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
verification.php">
                <div class="qoute">
                    <div class="eleven columns omega">
                        <h2>E-mail verification required to enable chat feature.</h2>
                        <p>Confirming your email address will allow you to chat, receive our newsletter and to help keep your account as secure as possible. Please check your spam folder just in case the confirmation email got delivered there instead of your inbox. If so, select the confirmation message and click Not Junk, which will allow future messages to get through. <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
verification.php" target="_blank" style="text-decoration: none; color: #FFFFFF;">Click here to resend the confirmation email</a></p>
                    </div>
                </div>
            </form>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="u35941" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="960" height="550">
                <param name="movie" value="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sLoader;?>
" />
                <param name="LOOP" value="false" />
                <param name="SCALE" value="exactfit" />
                <param name="allowScriptAccess" value="always" />
                <param name="allowFullScreen" value="true" />
                <param name="menu" value="false" />
                <param name="wmode" value="window" />
                <param name="FlashVars" value="&sLang=en" />
                <embed id="gameSWF" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sLoader;?>
" width="960" height="550" loop="false" 
                    pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" 
                    type="application/x-shockwave-flash" scale="exactfit" allowscriptaccess="always" allowFullScreen="true" 
                    menu="false" flashvars="&sLang=en"></embed>
            </object>
        </div>
      </td>
    </tr>
</table>
<br />

<div class="sprite menu">
 <div class="menuContent">
  <div class="footer">
    <div class="clear"></div>
    <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
" target="_blank">Homepage</a> 
        | <a href="http://www.facebook.com/<?php echo $_smarty_tpl->tpl_vars['FacebookId']->value;?>
" target="_blank">News</a>
        | <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
ranking/bestPlayers" target="_blank">Player Ranking</a>
        | <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
contact" target="_blank">Report a Bug</a>
        | <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
tos" target="_blank">Terms of Service</a>
        | <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
upgrade" target="_blank">Become a VIP</a>
        | <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
wiki" target="_blank">HP Wiki</a>
        | <a href="#" target="_blank">Forum</a>

    <p style="margin-top: 3px;">We do not claim all the gamefiles and all the images/graphic materials. All copyright is directly referred to their respective owners.</p>
  </div>
 </div>       
</div>
</div>
<a id="go" rel="leanModal" name="test" href="#test" style="display:none; visibility:hidden;"></a>
<div id="test" onclick="$('#lean_overlay').trigger('click'); window.open('<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
upgrade','_blank');">
   <div id="upgrade"></div>
   <h2>Help keep the server online!</h2>
   <p>Servers cost money to host, and any purchases in support of our game are greatly appreciated! There are lots of great perks you get for donating towards the cost of the server. Once the monthly target is achieved, this notification will disappear until the next month.<br /><br /><b>$<?php echo $_smarty_tpl->tpl_vars['CurrentMonth']->value;?>
 of $<?php echo $_smarty_tpl->tpl_vars['TargetAmount']->value;?>
</b> collected as of <?php echo smarty_modifier_date_format(time(),"%B %Y");?>
.<br />Thank you for understanding!</p>
</div>
</body>
</html>
<?php }} ?>
