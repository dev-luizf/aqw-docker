<?php /* Smarty version Smarty-3.1.16, created on 2016-06-28 07:33:53
         compiled from ".\templates\infinityarts\template.account.html" */ ?>
<?php /*%%SmartyHeaderCode:80155771f0213c90e8-01172375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '013fdbdead29370e933edb5a0de7d93514613af3' => 
    array (
      0 => '.\\templates\\infinityarts\\template.account.html',
      1 => 1406258892,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80155771f0213c90e8-01172375',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Message' => 1,
    'Root' => 0,
    'UserData' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5771f0213fd017_77292632',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5771f0213fd017_77292632')) {function content_5771f0213fd017_77292632($_smarty_tpl) {?><div class="container clearfix">
   <div class="two-thirds column">
        <?php echo $_smarty_tpl->tpl_vars['Message']->value;?>

        <form id="settings" name="settings" action="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
account" method='post' class="form-elements2">
          <h2 class="title">Character Name<span class="line"></span></h2>
          <fieldset>
          <label>Character Name : </label>
          <input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->Name;?>
">
          </fieldset>
		  <p>Please enter your password below to confirm username change. You will be charged 2000 AdventureCoins. </p>
		
          <h2 class="title">Change Password<span class="line"></span></h2>
          <fieldset>
          <label>Password : </label>
          <input type="password" name="pass1" value="">
          </fieldset>
          <fieldset>
          <label>Re-type Password : </label>
          <input type="password" name="pass2" value="">
          </fieldset>
		  
          <h2 class="title">E-mail Address<span class="line"></span></h2>
          <fieldset>
          <label>Email : </label>
          <input type="text" name="mail1" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->Email;?>
">
          </fieldset>
          <fieldset>
          <label>Re-type Email : </label>
          <input type="text" name="mail2" value="">
          </fieldset>

          <div class="clear"></div>
          <a href="javascript:void(0);" class="button small color" onclick="document.getElementById('settings').submit();">Save Button</a>
          <a href="javascript:void(0);" class="button small gray" onclick="document.getElementById('settings').reset();">Reset Button</a>
        </form>

   </div>
   <!-- Start Sidebar Widgets -->
   <div class="five columns bottom">    

<h2 class="title">Character Information<span class="line"></span></h2>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="280" height="211"><param name="movie" value="/gamefiles/face.swf?ver=2"><param name="quality" value="high"><param name="wmode" value="transparent"><param name="flashvars" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->FlashVars;?>
"><embed src="/gamefiles/face.swf?ver=2" width="280" height="211" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->FlashVars;?>
"></object>
<ul class="square-list"><br />
<li class="bg"> Account Number: <?php echo $_smarty_tpl->tpl_vars['UserData']->value->id;?>
</li><br />
<li class="bg"> Email Status: <?php if ($_smarty_tpl->tpl_vars['UserData']->value->ActivationFlag>0) {?>Confirmed Address<?php } else { ?>Unconfirmed Address<?php }?></li><br />
<li class="bg"> Upgrade Expire: <?php if ($_smarty_tpl->tpl_vars['UserData']->value->UpgradeDays>-1) {?><?php echo $_smarty_tpl->tpl_vars['UserData']->value->UpgradeExpire;?>
<?php } else { ?>No membership yet<?php }?></li><br />
<li class="bg"> Last Login: <?php echo $_smarty_tpl->tpl_vars['UserData']->value->LastLogin;?>
</li><br />
<li class="bg"> Date Created: <?php echo $_smarty_tpl->tpl_vars['UserData']->value->DateCreated;?>
</li><br />
</ul><br />

    <!-- End -->   
   </div><!-- End Sidebar Widgets -->
</div>
<script>
  $('#menu_social').attr('class', 'active');
  $('#menu_forums').attr('class', 'active');
</script>



<?php }} ?>
