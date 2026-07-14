<?php /* Smarty version Smarty-3.1.16, created on 2014-05-31 01:18:14
         compiled from ".\templates\email\template.default.html" */ ?>
<?php /*%%SmartyHeaderCode:65635388cb66599606-44549751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a55a97469d86ce43d5e55c410b85e189e5f287e6' => 
    array (
      0 => '.\\templates\\email\\template.default.html',
      1 => 1394649403,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65635388cb66599606-44549751',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
    'Domain' => 0,
    'Root' => 0,
    'Template' => 0,
    'Name' => 1,
    'Content' => 1,
    'Company' => 0,
    'Email' => 0,
    'FacebookId' => 0,
  ),
  'has_nocache_code' => true,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5388cb665f6f33_64401006',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5388cb665f6f33_64401006')) {function content_5388cb665f6f33_64401006($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/header.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Greetings and salutations, <?php echo '/*%%SmartyNocache:65635388cb66599606-44549751%%*/<?php echo $_smarty_tpl->tpl_vars[\'Name\']->value;?>
/*/%%SmartyNocache:65635388cb66599606-44549751%%*/';?>
</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										<?php echo '/*%%SmartyNocache:65635388cb66599606-44549751%%*/<?php echo $_smarty_tpl->tpl_vars[\'Content\']->value;?>
/*/%%SmartyNocache:65635388cb66599606-44549751%%*/';?>

									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										<?php echo $_smarty_tpl->tpl_vars['Company']->value;?>
<br/>
										E-mail:  <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
" style="color: #ffffff;"><?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
</a><br/>
										Website: <a href="http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
" style="color: #ffffff;"><font color="#ffffff">http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
</font></a>
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="http://www.twitter.com/" style="color: #ffffff;">
														<img src="http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/tw.gif" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="http://www.facebook.com/<?php echo $_smarty_tpl->tpl_vars['FacebookId']->value;?>
" style="color: #ffffff;">
														<img src="http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html><?php }} ?>
