<?php /* Smarty version Smarty-3.1.16, created on 2014-11-28 03:19:31
         compiled from ".\templates\infinityarts\template.profile.html" */ ?>
<?php /*%%SmartyHeaderCode:1686654785a43bddfe5-40258663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f04899e1b5d2905e5f47aec0b88b192f99cef044' => 
    array (
      0 => '.\\templates\\infinityarts\\template.profile.html',
      1 => 1417172889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1686654785a43bddfe5-40258663',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'Template' => 0,
    'Overview' => 0,
    'ProfileData' => 0,
    'AchievementList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_54785a4413fac8_77807940',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54785a4413fac8_77807940')) {function content_54785a4413fac8_77807940($_smarty_tpl) {?>
	<script src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/js/charpagedumper.js"></script>
    <div class="container clearfix">
	<div id="banStatus" class="alert notice hideit" style="display:none; margin-top:10px; margin-bottom:-10px;">
      <p><b>This account is currently disabled.</b></p>
      <span class="close"></span>
    </div>
    <div id="welcome">
      <?php echo $_smarty_tpl->tpl_vars['Overview']->value;?>

    </div><!-- End Welcome -->
	<div class="clearfix"></div>
    <div class="two-thirds column bottom-2">
        <h2 class="title">Character Inventory<span class="line"></span></h2>
        
        <div id="vertical-tabs">
        
          <ul class="tabs">
            <li id="tabz1" class="current">Items</li>
            <li id="tabz2">Costumes</li>
            <li id="tabz3">Classes</li>
            <li id="tabz4">Houses</li>
          </ul>
          <div class="contents">
          
          <div id="contentz1" class="tabscontent" style="display: block;">
          <p>
          <ul class="charitems circle-list">
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['item'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['item']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['name'] = 'item';
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Weapons']) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['item']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['item']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['item']['total']);
?>
		  <li><a href='http://augoeides.org/wiki/index.php?search=<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Weapons'][$_smarty_tpl->getVariable('smarty')->value['section']['item']['index']]->Name;?>
&button=&title=Special%3ASearch' class='<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Weapons'][$_smarty_tpl->getVariable('smarty')->value['section']['item']['index']]->Highlight;?>
 <?php echo mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Weapons'][$_smarty_tpl->getVariable('smarty')->value['section']['item']['index']]->Type, 'UTF-8');?>
' target="_blank">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Weapons'][$_smarty_tpl->getVariable('smarty')->value['section']['item']['index']]->Name;?>
</a></li>
		  <?php endfor; endif; ?>
          </ul>
          </p>
          </div> 
          <div id="contentz2" class="tabscontent" style="display: none;">
          <p>
          <ul class="charitems circle-list">
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['armor'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['name'] = 'armor';
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Armors']) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['armor']['total']);
?>
		  <li><a href='http://augoeides.org/wiki/index.php?search=<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Armors'][$_smarty_tpl->getVariable('smarty')->value['section']['armor']['index']]->Name;?>
&button=&title=Special%3ASearch' class='<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Armors'][$_smarty_tpl->getVariable('smarty')->value['section']['armor']['index']]->Highlight;?>
 <?php echo mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Armors'][$_smarty_tpl->getVariable('smarty')->value['section']['armor']['index']]->Type, 'UTF-8');?>
' target="_blank">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Armors'][$_smarty_tpl->getVariable('smarty')->value['section']['armor']['index']]->Name;?>
</a></li>
		  <?php endfor; endif; ?>
          </ul>
          </p>
          </div> 
          <div id="contentz3" class="tabscontent" style="display: none;">
          <p>
          <ul class="charitems circle-list">
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['class'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['class']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['name'] = 'class';
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes']) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['class']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['class']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['class']['total']);
?>
		  <li><a href='http://augoeides.org/wiki/index.php?search=<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes'][$_smarty_tpl->getVariable('smarty')->value['section']['class']['index']]->Name;?>
&button=&title=Special%3ASearch' class='<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes'][$_smarty_tpl->getVariable('smarty')->value['section']['class']['index']]->Highlight;?>
 <?php echo mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes'][$_smarty_tpl->getVariable('smarty')->value['section']['class']['index']]->Type, 'UTF-8');?>
' target="_blank">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes'][$_smarty_tpl->getVariable('smarty')->value['section']['class']['index']]->Name;?>
</a> (Rank <?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Classes'][$_smarty_tpl->getVariable('smarty')->value['section']['class']['index']]->Rank;?>
)</li>
		  <?php endfor; endif; ?>
          </ul>
          </p>
          </div> 
          <div id="contentz4" class="tabscontent" style="display: none;">
          <p>
          <ul class="charitems circle-list">
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['house'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['house']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['name'] = 'house';
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses']) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['house']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['house']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['house']['total']);
?>
		  <li><a href='http://augoeides.org/wiki/index.php?search=<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Name;?>
&button=&title=Special%3ASearch' class='<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Highlight;?>
' target="_blank"><span class="<?php if (mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Type, 'UTF-8')=='wall item') {?>display<?php } elseif (mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Type, 'UTF-8')=='house') {?>bank<?php } elseif (mb_strtolower($_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Type, 'UTF-8')=='floor item') {?>vases<?php }?> icon" ></span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Inventory['Houses'][$_smarty_tpl->getVariable('smarty')->value['section']['house']['index']]->Name;?>
</a></li>
		  <?php endfor; endif; ?>
          </ul>
          </p>
          </div>  
          
          </div><!-- End contents -->          
        </div>        
    </div>
    <div class="one-third column">
        <div class="bottom">
        <h2 class="title">Achievements<span class="line"></span></h2>
        <div class="popular-tags top bottom">  
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['achv'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['name'] = 'achv';
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['AchievementList']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['achv']['total']);
?>
        <a href='#' title='<?php echo $_smarty_tpl->tpl_vars['AchievementList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['achv']['index']]->Description;?>
'><span class='<?php echo $_smarty_tpl->tpl_vars['AchievementList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['achv']['index']]->Icon;?>
 icon'></span><?php echo $_smarty_tpl->tpl_vars['AchievementList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['achv']['index']]->Title;?>
</a>		
	    <?php endfor; endif; ?></div>
        </div>
    </div>
  </div><!-- <<< End Container >>> -->
  <script>
  if (<?php echo $_smarty_tpl->tpl_vars['ProfileData']->value->Access;?>
 <= 0) { $('#banStatus').slideDown(); }
  </script>
<?php }} ?>
