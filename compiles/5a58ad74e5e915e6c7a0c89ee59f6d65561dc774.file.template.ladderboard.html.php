<?php /* Smarty version Smarty-3.1.16, created on 2016-01-02 22:20:46
         compiled from ".\templates\infinityarts\template.ladderboard.html" */ ?>
<?php /*%%SmartyHeaderCode:27484568814feb0fb07-21810408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a58ad74e5e915e6c7a0c89ee59f6d65561dc774' => 
    array (
      0 => '.\\templates\\infinityarts\\template.ladderboard.html',
      1 => 1417200873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27484568814feb0fb07-21810408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_568814feb3ba96_95806689',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_568814feb3ba96_95806689')) {function content_568814feb3ba96_95806689($_smarty_tpl) {?><div class="container clearfix">
   <div class="sixteen columns"> <h1 class="page-title">Featured<span class="line"></span></h1> </div>
   <div id="description">
      <div class="sixteen columns">
        <div class="description">
        <p>
         Top player board contains the top 10 characters in <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
 less then level 40 and is updated every 5 minutes and judged by character level, experiences, kills, and deaths.
        </p>
        </div>
      </div>
   </div>

   <div class="meet-team">        
     <ul class="team">
          
     </ul>
   </div>

   <div class="sixteen columns bottom">
        <h2 class="title">Top Players<span class="line"></span></h2>
        <table>
          <tbody>
            <tr>
              <th style="width:5px;">#</th>
              <th>Character Name</th>
              <th>Level</th>
              <th style="width:175px;">Experiences</th>
              <th style="width:50px;">Golds</th>
              <th style="width:50px;">Coins</th>
              <th style="width:50px;">Kills</th>
              <th style="width:50px;">Deaths</th>
            </tr>
            
          </tbody>
        </table>
   </div><!-- Page Title -->
   <div class="clearfix"></div>
</div><?php }} ?>
