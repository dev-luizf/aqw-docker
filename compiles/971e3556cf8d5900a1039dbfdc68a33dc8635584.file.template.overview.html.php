<?php /* Smarty version Smarty-3.1.19, created on 2014-11-13 06:55:27
         compiled from ".\templates\infinityarts\template.overview.html" */ ?>
<?php /*%%SmartyHeaderCode:288305464c65f5a1b84-36031814%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '971e3556cf8d5900a1039dbfdc68a33dc8635584' => 
    array (
      0 => '.\\templates\\infinityarts\\template.overview.html',
      1 => 1412004769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288305464c65f5a1b84-36031814',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'Settings' => 0,
    'FlashVariables' => 0,
    'ExpPercentage' => 0,
    'ExpWidth' => 0,
    'CPPercentage' => 0,
    'CPWidth' => 0,
    'ProfileData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5464c65f7520b6_33914683',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5464c65f7520b6_33914683')) {function content_5464c65f7520b6_33914683($_smarty_tpl) {?>
      <div class="two-thirds column">
      <div class="who">
        <h2 class="title">Character Overview<span class="line"></span></h2>
        <p align="center">        
	    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="620" height="420">
        <param name="movie" value="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sProfile;?>
" />
        <param name="quality" value="high" />
        <param name="flashvars" value="<?php echo $_smarty_tpl->tpl_vars['FlashVariables']->value;?>
" />          
        <embed src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/<?php echo $_smarty_tpl->tpl_vars['Settings']->value->sProfile;?>
" width="620" height="420" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="<?php echo $_smarty_tpl->tpl_vars['FlashVariables']->value;?>
"></embed>
        </object>		
        </p>
        <p align="center" style="padding: 10px 35px; margin-top: 2px;">
        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_tumblr_hcount' displayText='Tumblr'></span>
        <span class='st_googleplus_hcount' displayText='Google +'></span>
        </p>
      </div>
      </div>		
    <div class="one-third column">
        <div class="bottom">
        <h2 class="title">Stats Progress <span class="line"></span></h2>
        <ul class="progress-bar"><li>
            <h5>Experiences ( <?php echo $_smarty_tpl->tpl_vars['ExpPercentage']->value;?>
% )</h5>
            <div class="meter"><span style="width: <?php echo $_smarty_tpl->tpl_vars['ExpWidth']->value;?>
px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Class Points ( <?php echo $_smarty_tpl->tpl_vars['CPPercentage']->value;?>
% )</h5>
            <div class="meter"><span style="width: <?php echo $_smarty_tpl->tpl_vars['CPWidth']->value;?>
px;"></span></div><!-- Edite width here -->
          </li>
        </ul></div>
    </div>
    <div class="one-third column">
      <div class="choose">      
        <h2 class="title">Parameters<span class="line"></span></h2>        
        <ul>
          <li><span class="usd icon"></span>&nbsp;Gold: <?php echo number_format($_smarty_tpl->tpl_vars['ProfileData']->value->Gold);?>
</li>
          <li><span class="credit icon"></span>&nbsp;Royal Coins: <?php echo number_format($_smarty_tpl->tpl_vars['ProfileData']->value->Coins);?>
</li>
          <li><span class="cup icon"></span>&nbsp;Total PvP Kills: <?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->KillCount;?>
</li>
          <li><span class="skull icon"></span>&nbsp;Total PvP Deaths: <?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->DeathCount;?>
</li>
        </ul>
      </div>
    </div><?php }} ?>
