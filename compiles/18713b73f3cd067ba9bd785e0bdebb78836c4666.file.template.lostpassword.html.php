<?php /* Smarty version Smarty-3.1.16, created on 2014-09-22 01:12:46
         compiled from ".\templates\infinityarts\template.lostpassword.html" */ ?>
<?php /*%%SmartyHeaderCode:32636541fd9fe2123e7-23834120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18713b73f3cd067ba9bd785e0bdebb78836c4666' => 
    array (
      0 => '.\\templates\\infinityarts\\template.lostpassword.html',
      1 => 1406632364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32636541fd9fe2123e7-23834120',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Root' => 0,
    'Template' => 0,
    'Location' => 0,
    'Phone' => 0,
    'Email' => 0,
    'Domain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_541fd9fe230c28_83039189',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541fd9fe230c28_83039189')) {function content_541fd9fe230c28_83039189($_smarty_tpl) {?>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/js/jquery.form.js"></script>
<script>
  $(document).ready(function() {
    var options = { 
        target:        '#serverMsg',
        beforeSubmit:  showRequest,
        success:       showResponse,
        clearForm: true,
        resetForm: true
    };  

    $('#ajax-contact-form').ajaxForm(options);
  });

  var defaultBtn;      
  function showRequest(formData, jqForm, options) { 
    defaultBtn = $('#submitBtn').html();
    $('#submitBtn').html('<span class="upload icon"></span>');
    $('#submitBtn').append('Processing.. Please Wait ');
	$('#serverMsg').slideUp(500);
    return true; 
  }
  
  function showResponse(responseText, statusText, xhr, $form)  { 
    $('#submitBtn').html(defaultBtn);
	$('#serverMsg').slideDown(1000);
	//$('#ajax-contact-form').slideUp(1000);
  }
</script>
<div class="container clearfix">
   <div id="serverMsg" style="display: none;"></div>
   <div class="eleven columns bottom"><h1 class="page-title">Recover Password<span class="line"></span></h1><p>It happens to the best of us... We forget our passwords.<br /><br />Enter the email address you used when registering your account.<br />Your account information will be emailed to you.</p><h2 class="title">Please fill out this form<span class="line"></span></h2><form action="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
reset.php" method="post" class="form-elements2" id="ajax-contact-form"><div class="form-box"><label>Character Name <small>(required)</small></label><input type="text" name="name" class="text"></div><div class="form-box"><label>E-mail <small>(required)</small></label><input type="text" name="email" class="text"></div><div class="form-box last" id="submitBtn"><a href="javascript:void(0);" class="button small color" onClick="$('#ajax-contact-form').submit();" style="margin-top: 30px;">Submit Button</a></div></form></div>
   <div class="five columns bottom">  
     <!-- Contact Details -->
     <h2 class="title bottom-2">Contact Details<span class="line"></span></h2>
     
       <ul class="details top-3 bottom-2">
         <li><span class="google_maps icon black"></span><p><?php echo $_smarty_tpl->tpl_vars['Location']->value;?>
</p></li>
         <li><span class="phone icon black"></span><p><?php echo $_smarty_tpl->tpl_vars['Phone']->value;?>
</p></li>
         <li><span class="e-mail icon black"></span><p><a href="#"><span class="color"><?php echo $_smarty_tpl->tpl_vars['Email']->value;?>
</span></a></p></li>
         <li><span class="globe icon black"></span><p><a href="#"><span class="color"><?php echo $_smarty_tpl->tpl_vars['Domain']->value;?>
</span></a></p></li>
       </ul>
      
     <div class="clearfix"></div>
     <h2 class="title bottom-2">Socail Contact<span class="line"></span></h2>
     
     <ul class="followers">
        <li>
        <a href="#" data="facbook" class="black colorTipContainer"><span class="social-icon facbook color"></span><span class="colorTip" style="margin-left: -27px; display: none;">facbook<span class="pointyTipShadow"></span><span class="pointyTip"></span></span></a>
        </li>
        <li>
        <a href="#" data="twitter" class="black colorTipContainer"><span class="social-icon twitter color"></span><span class="colorTip" style="margin-left: -23px; display: none;">twitter<span class="pointyTipShadow"></span><span class="pointyTip"></span></span></a>
        </li>
        <li>
        <a href="#" data="google+" class="black colorTipContainer"><span class="social-icon google_plus  color"></span><span class="colorTip">google+<span class="pointyTipShadow"></span><span class="pointyTip"></span></span></a>
        </li>
        <li>
        <a href="#" data="Rss" class="black colorTipContainer"><span class="social-icon rss color"></span><span class="colorTip">Rss<span class="pointyTipShadow"></span><span class="pointyTip"></span></span></a> 
        </li>
     </ul> 
   </div>
   <div class="sixteen columns"> <h2 class="title">Our Location<span class="line"></span></h2></div>
   <div class="sixteen columns google-map top-2">
   
   <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=d&amp;source=s_d&amp;saddr=Tanta,+Egypt&amp;daddr=&amp;hl=en&amp;geocode=Fc3D1QEdOAfZASk18PyqXcn3FDFCroxeDIIhdA&amp;sll=30.786509,31.000376&amp;sspn=0.001307,0.002642&amp;doflg=ptk&amp;mra=ls&amp;ie=UTF8&amp;t=m&amp;ll=30.786509,31.000376&amp;spn=0.001307,0.002642&amp;output=embed"></iframe>
   
   </div>
</div>
<script>
  $('#menu_contact').attr('class', 'active');
</script>



<?php }} ?>
