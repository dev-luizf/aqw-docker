<?php /* Smarty version Smarty-3.1.19, created on 2014-11-06 00:14:27
         compiled from ".\templates\infinityarts\template.ladderboard.html" */ ?>
<?php /*%%SmartyHeaderCode:16285545b2de3eebf55-09682025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc28a5c7c764caa858f9b7932b6861cf115c598b' => 
    array (
      0 => '.\\templates\\infinityarts\\template.ladderboard.html',
      1 => 1412079212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16285545b2de3eebf55-09682025',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'NextReset' => 0,
    'FeaturedList' => 0,
    'Root' => 0,
    'CharacterList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545b2de4583f59_29473980',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545b2de4583f59_29473980')) {function content_545b2de4583f59_29473980($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\UniServerZ\\www\\classes\\class.smarty\\plugins\\modifier.date_format.php';
?><div class="container clearfix">
   <div class="sixteen columns bottom">
       <h2 class="title">Best Player Ranking<span class="line"></span></h2>
        <p style="margin-bottom: 20px;margin-top: -20px;">
         Adventurers who show exceptional skill in all types of Arena Matches. Next reset time is <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['NextReset']->value,'%Y-%m-%d %H:%M:%S');?>
 in server time. When the ranking countdown is over, rewards will be given according to the ranking category. Top three players will be given special titles and additional Royal Coins. Congratulations to this Week's Winners!
        </p>
   </div>
   <div class="meet-team">        
     <ul class="team">
        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['top3'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['name'] = 'top3';
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['FeaturedList']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['top3']['total']);
?>
        <li class="one-third column">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="300" height="231">
        <param name="movie" value="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/face.swf?ver=2" />
        <param name="quality" value="high" />
        <param name="wmode" value="transparent" />
        <param name="flashvars" value="<?php echo $_smarty_tpl->tpl_vars['FeaturedList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['top3']['index']]->FlashVars;?>
" />
        <embed src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
gamefiles/face.swf?ver=2" width="300" height="231" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="<?php echo $_smarty_tpl->tpl_vars['FeaturedList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['top3']['index']]->FlashVars;?>
"></embed>
        </object><h3>
        <img src="<?php echo $_smarty_tpl->tpl_vars['FeaturedList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['top3']['index']]->Throphy;?>
" style="margin: -3px 5px;">
        <?php echo $_smarty_tpl->tpl_vars['FeaturedList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['top3']['index']]->Name;?>

        <p><a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?profile=<?php echo $_smarty_tpl->tpl_vars['FeaturedList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['top3']['index']]->Name;?>
">[View character profile page]</a></p>
        </h3>
        </li>
        <?php endfor; endif; ?>
     </ul>
   </div>

   <div class="sixteen columns bottom">
        <h2 class="title">Top Players<span class="line"></span></h2>
        <table>
          <tbody>
            <tr>
              <th style="width:5px;">#</th>
              <th>Character Name</th>
              <th>Guild Name</th>
              <th>Level</th>
              <th style="width:175px;">Experiences</th>
              <th style="width:50px;">Kills</th>
              <th style="width:50px;">Deaths</th>
              <th style="width:50px;">Ratio</th>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['user'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['user']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['name'] = 'user';
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['CharacterList']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
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
            <tr>
            <td><b style="color: #669;"><?php if ($_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Rank<=3) {?><img src="<?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Throphy;?>
"><?php } else { ?><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Rank;?>
<?php }?></b></td>
            <td><a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
?profile=<?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Name;?>
"><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Name;?>
</a></td>
            <td><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->GuildName;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->Level;?>
</td>
            <td><div class="meter"><span style="width: <?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->ExpWidth;?>
"></span></div></td>
            <td><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->KillCount;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->DeathCount;?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->DeathCount==0) {?> - <?php } else { ?><?php echo round(($_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->KillCount/$_smarty_tpl->tpl_vars['CharacterList']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]->DeathCount),2);?>
<?php }?></td>
            </tr>
            <?php endfor; endif; ?>
          </tbody>
        </table>
   </div><!-- Page Title -->
   <div class="clearfix"></div>
</div>
<script>
  $('#menu_rankings').attr('class', 'active');
  $('#menu_topchars').attr('class', 'active');
</script>

<?php }} ?>
