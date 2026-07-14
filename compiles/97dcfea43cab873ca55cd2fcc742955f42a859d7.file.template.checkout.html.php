<?php /* Smarty version Smarty-3.1.16, created on 2016-06-28 07:36:57
         compiled from ".\templates\infinityarts\template.checkout.html" */ ?>
<?php /*%%SmartyHeaderCode:190685771f0d9ef8b57-66360791%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97dcfea43cab873ca55cd2fcc742955f42a859d7' => 
    array (
      0 => '.\\templates\\infinityarts\\template.checkout.html',
      1 => 1412025330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190685771f0d9ef8b57-66360791',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'Template' => 0,
    'Amount' => 0,
    'PayPal' => 0,
    'Package' => 0,
    'Domain' => 0,
    'UserData' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_5771f0da062005_02659104',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5771f0da062005_02659104')) {function content_5771f0da062005_02659104($_smarty_tpl) {?>
<script src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/js/jquery.redirect.min.js"></script> 
<script src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/js/jquery.base64.js"></script> 
<script>
function xt() { var method=$("input[name='method']:checked").val();if(method=="paypal"){ var pp='<?php if ($_GET['addon']=='Yes') {?><?php echo base64_encode(($_smarty_tpl->tpl_vars['Amount']->value+5));?>
<?php } else { ?><?php echo base64_encode(($_smarty_tpl->tpl_vars['Amount']->value));?>
<?php }?>';$().redirect('https://www.paypal.com/cgi-bin/webscr',{ 'cmd':'_xclick','business':'<?php echo $_smarty_tpl->tpl_vars['PayPal']->value;?>
','lc':'US','item_name':'<?php echo $_smarty_tpl->tpl_vars['Package']->value;?>
<?php if ($_GET['addon']=='Yes') {?> +5,000 RCs<?php }?>','amount': $.base64.decode(pp),'currency_code':'USD','button_subtype':'services','no_note':'0','lc':'US','undefined_quantity':'0','no_shipping':'1','return':'http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
/?purchase=success','cancel_return':'http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
/upgrade','bn':'PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest','custom': '<?php echo base64_encode(("userid=".((string)$_smarty_tpl->tpl_vars['UserData']->value->id)."&type=".((string)$_GET['sitem'])."&x=".((string)$_GET['addon'])));?>
' }) }else if(method=="paygol"){ var pg='<?php if ($_GET['addon']=='Yes') {?><?php echo base64_encode((round(((($_smarty_tpl->tpl_vars['Amount']->value+5)*105.0525262631316)/100),2)));?>
<?php } else { ?><?php echo base64_encode((round((($_smarty_tpl->tpl_vars['Amount']->value*105.0525262631316)/100),2)));?>
<?php }?>';var serviceId;switch('<?php echo $_GET['sitem'];?>
'){ case'VIP499':serviceId=68121;break;case'VIP999':serviceId=68122;break;case'VIP1499':serviceId=68123;break;case'VIP1999':serviceId=68124;break;case'AC299':serviceId=70636;break;case'AC499':serviceId=70637;break;case'AC999':serviceId=70638;break;case'AC1999':serviceId=70639;break }$().redirect('http://www.paygol.com/micropayment/paynow',{ 'pg_serviceid':serviceId,'pg_currency':'USD','pg_custom': '<?php echo base64_encode(("userid=".((string)$_smarty_tpl->tpl_vars['UserData']->value->id)."&type=".((string)$_GET['sitem'])."&x=".((string)$_GET['addon'])));?>
','pg_price': $.base64.decode(pg),'pg_return_url':'http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
/?purchase=success','pg_cancel_url':'http://<?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
/upgrade' }) } else { alert('Please select a payment method!'); } }
</script>
<div class="container clearfix">
   <div class="twelve columns  bottom">
   
     <h2 class="title small">Check Out<span class="line"></span></h2>
     
     <div class="about-project bottom">
        <p>This is the confirmation for your order. Please proceed with the payment button located on the right side of this page. After the payment is confirmed, the system will automatically add order items to your game account.</p><br>

		<p>Please confirm everything below is correct. If you find any errors after the purchase, please contact staff as soon as possible. Paid orders are final and will be processed accordingly. No alteration will be made. By any chance, if you dispute any payments, you will not be able to use our service in the future.</p>
		
<h2 class="title">Character Information<span class="line"></span></h2>
   <div class="five columns bottom" style="margin-top: 10px">    


<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="280" height="211"><param name="movie" value="/gamefiles/face.swf?ver=2"><param name="quality" value="high"><param name="wmode" value="transparent"><param name="flashvars" value="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->FlashVars;?>
"><embed src="/gamefiles/face.swf?ver=2" width="280" height="211" quality="high" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->FlashVars;?>
"></object>


    <!-- End -->   
   </div><!-- End Sidebar Widgets -->
   
   <div class="six columns bottom" style="margin-top: -20px">    
   
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

     
   </div>
   <div class="four columns bottom">   

	  <h2 class="title small">Order Information<span class="line"></span></h2>
	  <ul class="square-list bottom-2 job">
      <li><?php echo $_smarty_tpl->tpl_vars['Amount']->value;?>
 USD: <a><?php echo $_smarty_tpl->tpl_vars['Package']->value;?>
</a></li> 
	  <?php if ($_GET['addon']=='Yes') {?>
      <li>5.00 USD: <a>5,000 RCs Bonus</a></li> 
	  <?php }?>
	  </ul>
      <div class="info-box"><h4>Grand Total: <?php if ($_GET['addon']=='Yes') {?><?php echo $_smarty_tpl->tpl_vars['Amount']->value+5;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['Amount']->value;?>
<?php }?> USD</h4></div>
      <form id="payment">     
      <h2 class="title small">Payment Method <span class="line"></span></h2>
      <div class="form-box job">
         <input type="radio" name="method" value="paypal"> PayPal or Creditcard<br><br>
         <input type="radio" name="method" value="paygol" disabled="disabled"> Mobile PayGol
      </div>
      <a href="javascript:void(0);" class="button medium color" onclick="xt();">Process Payment</a>	  
      </form><p>Due to recent issues, PayGol payment option will be temporarily unavailable. Because of this, we advise you to change your payment method to PayPal.</p>
   </div>
</div>


<?php }} ?>
