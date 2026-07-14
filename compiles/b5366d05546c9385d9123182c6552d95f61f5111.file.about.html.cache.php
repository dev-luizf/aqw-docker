<?php /* Smarty version Smarty-3.1.16, created on 2016-06-02 19:35:53
         compiled from ".\templates\infinityarts\about.html" */ ?>
<?php /*%%SmartyHeaderCode:12515750ed09a51160-77157079%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5366d05546c9385d9123182c6552d95f61f5111' => 
    array (
      0 => '.\\templates\\infinityarts\\about.html',
      1 => 1464921349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12515750ed09a51160-77157079',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'TeamList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5750ed09a937f2_47769001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5750ed09a937f2_47769001')) {function content_5750ed09a937f2_47769001($_smarty_tpl) {?><div class="container">
    <div class="row">
       <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="300" height="231">
             <param name="movie" value="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/face.swf?ver=2" 
             <param name="quality" value="high" />
             <param name="wmode" value="transparent" />
             <param name="flashvars" value="<?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->FlashVars;?>
" />
             <embed src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/face.swf?ver=2" width="300" height="231" quality="high" wmode="transparent"  pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="<?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->FlashVars;?>
"></embed>
             </object>
    </div>   
        <br />   
    </div>  
</div><?php }} ?>
