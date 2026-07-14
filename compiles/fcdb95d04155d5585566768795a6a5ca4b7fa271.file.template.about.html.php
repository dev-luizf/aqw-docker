<?php /* Smarty version Smarty-3.1.16, created on 2016-02-28 02:28:49
         compiled from ".\templates\infinityarts\template.about.html" */ ?>
<?php /*%%SmartyHeaderCode:2086756d22321ca9c34-93640998%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcdb95d04155d5585566768795a6a5ca4b7fa271' => 
    array (
      0 => '.\\templates\\infinityarts\\template.about.html',
      1 => 1449599524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2086756d22321ca9c34-93640998',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TeamList' => 0,
    'Root' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_56d22321cf9cf4_44349708',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d22321cf9cf4_44349708')) {function content_56d22321cf9cf4_44349708($_smarty_tpl) {?><div class="container clearfix">
 
    <div class="sixteen columns"> <h1 class="page-title">Staff List <span class="line"></span></h1> </div> <!-- Page Title -->
    
    <div class="two-thirds column">
      <div class="who">
        <h2 class="title">Who we are? <span class="line"></span></h2>
        <p>
          Nós somos a Staff do Armagedom Worlds cada um que estiver nessa lista desempenha um papel importante no servidor como manutenção, desenvolvimento do site, criação de items, mapas, etc esses players são players que possuem "poder" no server para punir outros players caso descumpram com as regras do servidor ou façam algo inadequado no servidor bom se vc ficou interessado e quer tentar entrar para a staff do Armagedom Worlds voce pode ir para a pagina de recrutamento <a href="Recruit.php">clicando aqui</a> e preencher os dados pedidos se tiver alguma duvida sobre como virar mod voce pode ir na pagina de Contact e olhar o que é preciso <a href="/contact">clicando aqui</a> bom é isso vlw por jogarem e apoiarem o Armagedom Worlds sempre tentaremos melhorar o nosso conteudo para vocês.
        </p>
        <br>
		<p>
		We are the Staff of Armagedom Worlds each that are on that list plays an important role on the server as maintenance, development of the site, creating items, maps, etc. these players are players that have "power" on the server in order to punish other players if breaks with the server rules or do something inappropriate in the Nice server if you get interested and want to try out for the staff of Armageddon Worlds you can go to the recruitment page <a href="Recruit.php">by clicking here</a> and fill the data requests if you have any doubts about how to turn mod you can go to the Contact page and look what it takes <a href="/contact">by clicking here</a> good is so thanks for playing and supporting the Armageddon Worlds always will try to improve our content for you.
		</p>
      </div>
    </div>
    
    <div class="one-third column">
      <div class="bottom">
        <h2 class="title">Server Progress <span class="line"></span></h2>
        <ul class="progress-bar">
          <li>
            <h5>Guilds ( 50% )</h5>
            <div class="meter"><span style="width: 150px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Friends and Guilds Friend List ( 100% )</h5>
            <div class="meter"><span style="width: 300px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Skills and Battle System ( 40% )</h5>
            <div class="meter"><span style="width: 130px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>PVP Battles ( 10% )</h5>
            <div class="meter"><span style="width: 30px;"></span></div><!-- Edite width here -->
          </li>
          <li>
            <h5>Customizable Houses ( 0% )</h5>
            <div class="meter"><span style="width: 0px;"></span></div><!-- Edite width here -->
          </li>
        </ul>
      </div>
    </div>
    
    <div class="clearfix"></div>
  
    <div class="meet-team">
      <div class="sixteen columns">
        <h2 class="title">Members of Staff<span class="line"></span></h2>
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
              <a><?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Name;?>
</a>
            </h3>
            <p><?php echo $_smarty_tpl->tpl_vars['TeamList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Description;?>
</p>
          </li>
        <?php endfor; endif; ?>
        </ul>
    </div>     
</div><?php }} ?>
