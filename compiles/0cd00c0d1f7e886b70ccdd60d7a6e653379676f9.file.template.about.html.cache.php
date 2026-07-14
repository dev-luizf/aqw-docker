<?php /* Smarty version Smarty-3.1.19, created on 2014-11-06 00:15:18
         compiled from ".\templates\infinityarts\template.about.html" */ ?>
<?php /*%%SmartyHeaderCode:24952545b2e166f6337-51160088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cd00c0d1f7e886b70ccdd60d7a6e653379676f9' => 
    array (
      0 => '.\\templates\\infinityarts\\template.about.html',
      1 => 1412005324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24952545b2e166f6337-51160088',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TeamList' => 0,
    'Root' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545b2e168ecb15_27163232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545b2e168ecb15_27163232')) {function content_545b2e168ecb15_27163232($_smarty_tpl) {?>
<div class="container clearfix">
 
    <div class="sixteen columns"> <h1 class="page-title">About Us <span class="line"></span></h1> </div> <!-- Page Title -->
    
    <div class="two-thirds column">
      <div class="who">
        <h2 class="title">Who We Are? <span class="line"></span></h2>
        <p>
          We're nothing but a pirated server from the original flash-based game. We are created to introduce the free fun of the original game and to create a fair society. We're totally free, extra payments unlocks more content of our game.<br><br>
          Rules are simple, be a nice player and do NOT use any hack programs to load shops, quests, and items or your account will be disabled. We're okay with having pixel sex inside the game as it obviously makes our players very comfortable but once we smell a reporting about sexual harrasments you will be punished hardly for it. Donations are very low and we do not use it for our own goods, all of the donations go directly into the server in order to keep it online. As most of you think, we copied everything from the original game. We did it for a good cause, it's to offer the game's community a better chance.
        </p>
        <br><br>
      </div>
    </div>
    
    <div class="one-third column">
      <div class="bottom">
        <h2 class="title">Our Progress <span class="line"></span></h2>
        <ul class="progress-bar">
          <li>
            <h5>Guilds ( 90% )</h5>
            <div class="meter"><span style="width: 280px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Friends and Guilds Friend List ( 80% )</h5>
            <div class="meter"><span style="width: 240px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>User Skills and Battle System ( 80% )</h5>
            <div class="meter"><span style="width: 240px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>PVP, Wars and Live Events! ( 90% )</h5>
            <div class="meter"><span style="width: 290px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Customizable Houses ( 100% )</h5>
            <div class="meter"><span style="width: 300px;"></span></div><!-- Edite width here -->
          </li>
        </ul>
      </div>
    </div>
    
    <div class="clearfix"></div>
  
    <div class="meet-team">
      <div class="sixteen columns">
        <h2 class="title">Meet The Team <span class="line"></span></h2>
        <p>
         We're a small team trying our best to bring you best gaming experiences.<br /> We strive to hire the very best people who are passionate, thoughtful and creative.
        </p>
        </div>
        
        <div class="clearfix"></div>    
        <ul class="team">        
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['user'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['user']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['name'] = 'user';
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['TeamList']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total']);
?>
          <li class="one-third column">
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
            <h3>
              <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?profile=<?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Name;?>
"><?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Name;?>
</a> 
              <a href="#" class="linkedin">linkedin</a>
              <a href="#" class="skype">skype</a>
              <a href="#" class="facebook">facebook</a>
              <a href="#" class="twitter">twitter</a>
            </h3>
            <p><?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Description;?>
</p>
          </li>
        <?php endfor; endif; ?>
        </ul>
    </div>     
</div>
<script>
  $('#menu_pages').attr('class', 'active');
  $('#menu_about').attr('class', 'active');
</script><?php }} ?>
