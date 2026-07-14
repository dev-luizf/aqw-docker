<?php /* Smarty version Smarty-3.1.16, created on 2016-05-17 10:02:33
         compiled from ".\templates\infinityarts\template.registration.html" */ ?>
<?php /*%%SmartyHeaderCode:253545388cb5ae4b259-61712072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '785cc265f0bd870d9a2fa81362e29842fefac53f' => 
    array (
      0 => '.\\templates\\infinityarts\\template.registration.html',
      1 => 1449632276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '253545388cb5ae4b259-61712072',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5388cb5ae76be5_77318439',
  'variables' => 
  array (
    'Root' => 0,
    'Settings' => 0,
    'LimitExceeded' => 0,
    'ServerDate' => 0,
    'ServerTime' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5388cb5ae76be5_77318439')) {function content_5388cb5ae76be5_77318439($_smarty_tpl) {?><style type="text/css">
.wraptocenter {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    width: 620px;
    height: 395px;
}
.wraptocenter * {
    vertical-align: middle;
}
/*\*//*/
.wraptocenter {
    display: block;
}
.wraptocenter span {
    display: inline-block;
    height: 100%;
    width: 1px;
}
/**/
</style>
<!--[if lt IE 8]><style>
.wraptocenter span {
    display: inline-block;
    height: 100%;
}
</style><![endif]-->

<script type="text/javascript">
  $(document).ready(function() {
    var params = { LOOP : "false", SCALE : "exactfit", allowScriptAccess : "always", allowFullScreen : "true", menu : "false", flashvars: "&sLang=id", wmode: "window"};
    swfobject.embedSWF("<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sNewUser;?>
", "flashContent", "960", "550", "9.0", null, null, params, { name: "flashContent" });
    $("#char-irea").slideUp();
	$("#char-akasha").slideUp();
	$(".animated-clouds").fadeOut();
  });
  
  $('#menu_pages').attr('class', 'active');
  $('#menu_game').attr('class', 'active');
</script>
<?php if ($_smarty_tpl->tpl_vars['LimitExceeded']->value) {?>
<div class="alert notice hideit" style="margin-top: 20px; margin-bottom: -30px;"><p>[<?php echo $_smarty_tpl->tpl_vars['ServerDate']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['ServerTime']->value;?>
] Registration limit exceeded! Sorry, we're no longer accepting registrations for today. Please come back again soon.</p><span class="close"></span></div>
<?php } else { ?>
<!-- <div class="alert info hideit" style="margin-top: 20px; margin-bottom: -30px;"><p>Unlike any other private servers, you must provide your Real Email Address as a validation email will be sent to that email address. Email verification is required to chat, receive our newsletter and to help keep your account as secure as possible. Thank you for your corporation.</p><span class="close"></span></div> -->
<?php }?>
<div id="game">
  <div class="container clearfix"> 
<h4><p align="center"><font color="darkcyan">In the Email you must put @gmail.com or @hotmail.com or so does not create the account.</font></p></h4>
  <br>
  <h4><p align="center"><font color="darkcyan">No Email vocês devem colocar @gmail.com ou @hotmail.com ou então não irá criar a conta.</font></p></h4> 
  <br>
   <script src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/infinityarts/js/swfobject.js"></script>   
   <div id="flashContent" name="flashContent">
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="960" height="550">
      <param name="movie" value="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sNewUser;?>
" />
      <param name="quality" value="high" />
      <param name="flashvars" value="showLogo=true&specAd=&Landing=true&refID=&campaign=&strSourceID=LandTestB"/>
      <param name="wmode" value="opaque" />
      <param name="AllowScriptAccess" value="always" /> 
      <embed src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sNewUser;?>
" quality="high" wmode="opaque" Landing="true" 
       pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" 
       type="application/x-shockwave-flash" width="960" height="550" 
       flashvars="showLogo=true&specAd=&Landing=true&refID=&campaign=&strSourceID=LandTestB" allowscriptaccess="always"></embed>
    </object>
   </div>
  <h4><p align="center"><font color="darkcyan">Once you put the data of the account and click GO to account will be created but it will come back to you create again but the account will be created just go <a href="Play.php">PLAY</a> and play.</font></p></h4>
  <br>
  <h4><p align="center"><font color="darkcyan">Assim que vocês colocarem os dados da conta e clicarem em GO a conta será criada porém ele vai voltar para você criar de novo mas a conta já estará criada é só você ir em <a href="Play.php">PLAY</a> e jogar.</font></p></h4>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('.wraptocenter').css('height', $("#horizontal-tabs").height() - 25);
    $('.imgstream').css('max-height', $("#horizontal-tabs").height() - 25);
  });
</script><?php }} ?>
