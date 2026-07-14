<?php /* Smarty version Smarty-3.1.16, created on 2016-06-28 07:35:42
         compiled from ".\templates\infinityarts\template.askbonus.html" */ ?>
<?php /*%%SmartyHeaderCode:245075771f08e32ea70-61050684%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50d856e0557d8797a9a58b76eafa98a1dd5f2af0' => 
    array (
      0 => '.\\templates\\infinityarts\\template.askbonus.html',
      1 => 1412025312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245075771f08e32ea70-61050684',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'Package' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5771f08e33afc6_11989063',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5771f08e33afc6_11989063')) {function content_5771f08e33afc6_11989063($_smarty_tpl) {?>
<div class="container clearfix">
<div class="sixteen columns bottom">
<div class="askbonus">
    <p>Add <b>5000</b> more Royal Coins<br> for only <b>$5.00</b> ?</p>
    <div class="bonusBtns">
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
checkout.php?sitem=<?php echo $_smarty_tpl->tpl_vars['Package']->value;?>
&amp;addon=Yes" class="btnYes">Yes!</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
checkout.php?sitem=<?php echo $_smarty_tpl->tpl_vars['Package']->value;?>
&amp;addon=No" class="btnNo">No</a>
    </div>
</div>
</div>
</div><?php }} ?>
