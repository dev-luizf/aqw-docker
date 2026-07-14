<?php /* Smarty version Smarty-3.1.19, created on 2014-11-06 00:14:45
         compiled from ".\templates\infinityarts\template.homepage.html" */ ?>
<?php /*%%SmartyHeaderCode:26720545b2df5ef3504-78372021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '02d600ecc8e6e3efa2f6cbdc1de42b1737f50913' => 
    array (
      0 => '.\\templates\\infinityarts\\template.homepage.html',
      1 => 1412005646,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26720545b2df5ef3504-78372021',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
    'Root' => 0,
    'Template' => 0,
    'NewsData' => 0,
    'stringcut' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545b2df61a2436_29544510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545b2df61a2436_29544510')) {function content_545b2df61a2436_29544510($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\UniServerZ\\www\\classes\\class.smarty\\plugins\\modifier.date_format.php';
?>
<div id="fb-root"></div>
<script>
$(function() {
    if (getParameterByName("report") == "success") { $("#contact").slideDown(); }
    if (getParameterByName("purchase") == "success") { $("#upgNotice").slideDown(); }  
});
</script>

  <div id="slider">
    <div class="container clearfix">
      <div class="sixteen columns">
      <div id="contact" class="alert success hideit" style="display: none;">
          <p>Thank you for contacting <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
. You should receive an email response shortly.</p><span class="close"></span>
      </div>
      <div id="upgNotice" class="alert success hideit" style="display: none;">
          <p>Thank you for supporting us! If you have any questions or problems regarding your purchase, please contact administrators <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
contact" target="_blank">here.</a></p><span class="close"></span>
      </div>
      <div class="flex-container">
      <div class="flexslider">
        <ul class="slides">
          <li>      
            <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/img/sliders/slider-1-0.jpg" alt="You Can Add"></a>
            <p class="flex-caption"> <span>Real-time Combat</span> Battle monsters with your friends to obtain wicked weapons, awesome armors, loyal pets and epic items!</p>
          </li>
          <li>
            <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/img/sliders/slider-1-1.jpg" alt="Crevision Theme"></a>
            <p class="flex-caption"> <span>Quests</span> With all-new quests to play, new monsters to slay, and unique gear to collect each and every week, you will become the Hero (or Villain!) you always knew you were!</p>
          </li>
          <li>
            <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/img/sliders/slider-1-2.jpg" alt="You Can Add"></a>
            <p class="flex-caption"> <span>Items</span> Thousands of equipable item are available in game!</p>
          </li>
          <li>
            <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/img/sliders/slider-1-3.jpg" alt="You Can Add"></a>
            <p class="flex-caption"> <span>PvP Battle</span> You can beat the shit out of people too!</p>
          </li>
          <li>
            <a href="#"><img src="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
templates/<?php echo $_smarty_tpl->tpl_vars['Template']->value;?>
/images/img/sliders/slider-1-4.jpg" alt="You Can Add"></a>
            <p class="flex-caption"> <span>And much more!</span> What are you waiting for? Create your account now and explore our ever-expanding world alongside your friends and family!</p>
          </li>          
        </ul>
      </div>      
      </div> 
      </div>     
    </div><!-- End Container -->
  </div><!-- End Slider -->
  
  <div id ="ajax" class="container clearfix">  
    <div id="welcome">
      <div class="sixteen columns">
        <div class="qoute">
          <div class="eleven columns omega">
            <h2>Welcome to <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
!</h2>
            <p><?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
 is a fantastic, fair, and community oriented server that is organized and run by professionals. We have a custom development team, which ensures our gameplay, monsters, items, and experience is like none other that you will experience in game.</p>
          </div>
          <div class="four columns alpha">
          <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
game" class="link" onclick="if (!Login) { $('#modal-login').show(); $('#redirect').val('<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
game'); return false; }">Play Now</a></div>
        </div>
      </div>      
    </div>
  <!-- End Welcome -->    

  <div class="two-thirds column">      
      <div class="slidewrap2" role="application" style="overflow: hidden; width: 100.2%;"><ul class="slidecontrols" role="navigation">	<li role="presentation"><a href="#sliderName2" class="carousel2-next">Next</a></li>	<li role="presentation"><a href="#sliderName2" class="carousel2-prev carousel2-disabled">Prev</a></li></ul>
       <h2 class="title">Recent Blog<span class="line"></span></h2>
       
       <div class="recent-blog">
       <div class="recent-blog2">
        
       <ul class="slider" id="sliderName2" aria-activedescendant="carousel-3-0-slide0" style="margin-left: 0px; float: left; width: 200%; -webkit-transition: margin-left 0.3s ease; transition: margin-left 0.3s ease;">
       
       <li class="slide carousel2-active-slide" role="tabpanel document" id="carousel-3-0-slide0" aria-hidden="false" style="float: left; width: 50%;">            
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['post'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['post']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['name'] = 'post';
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['NewsData']->value->SlideOne) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total']);
?>
			<div class=" blog-item vertical">
             <div class="date3"><span class="day"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Date,"%e");?>
</span>
             <span class="month"><?php echo mb_strtoupper((smarty_modifier_date_format($_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Date,"%b")), 'UTF-8');?>
</span></div>
             <h3><a href="<?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Link;?>
"><?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Title;?>
</a></h3>
			 <p><?php if (((strlen($_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content))>330)) {?>		 
			 <?php $_smarty_tpl->tpl_vars['stringcut'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content,0,330), null, 0);?>
			 <?php echo substr($_smarty_tpl->tpl_vars['stringcut']->value,0,strrpos($_smarty_tpl->tpl_vars['stringcut']->value,' '));?>
			 
			 <?php } else { ?><?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content;?>
<?php }?></p>
             <?php if (((strlen($_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content))>330)) {?><span class="more"><a href="<?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideOne[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Link;?>
">Read More</a></span><?php }?>
            </div>
		  <?php endfor; endif; ?>          
       </li>
       <li class="slide" role="tabpanel document" id="carousel-3-0-slide1" aria-hidden="true" style="float: left; width: 50%;">            
          <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['post'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['post']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['name'] = 'post';
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['post']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['post']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['post']['total']);
?>
			<div class=" blog-item vertical">
             <div class="date3"><span class="day"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Date,"%e");?>
</span>
             <span class="month"><?php echo mb_strtoupper((smarty_modifier_date_format($_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Date,"%b")), 'UTF-8');?>
</span></div>
             <h3><a href="<?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Link;?>
"><?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Title;?>
</a></h3>
             <p>
			 <?php if (((strlen($_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content))>330)) {?>		 
			 <?php $_smarty_tpl->tpl_vars['stringcut'] = new Smarty_variable(substr($_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content,0,330), null, 0);?>
			 <?php echo substr($_smarty_tpl->tpl_vars['stringcut']->value,0,strrpos($_smarty_tpl->tpl_vars['stringcut']->value,' '));?>
			 
			 <?php } else { ?><?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content;?>
<?php }?></p>
             <?php if (((strlen($_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Content))>330)) {?><span class="more"><a href="<?php echo $_smarty_tpl->tpl_vars['NewsData']->value->SlideTwo[$_smarty_tpl->getVariable('smarty')->value['section']['post']['index']]->Link;?>
">Read More</a></span><?php }?>
            </div>
		  <?php endfor; endif; ?>         
       </li>    
       </ul>        
      </div>
      </div>      
      </div>
  </div>
  <div class="one-third column">
      <h2 class="title">Sign Up Now<span class="line"></span></h2>
      <ul class="whyus">
        <li>
          <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
disclaimer"><img src="http://data.aurakingdom.to/images/r-invite.jpg" alt="" class="border"></a>
          <p>Just by joining us, you can gain several very useful consumables that will aid you among your path! From gold, inventory expansions, to even free coins</p>
          <span class="more2"><a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
disclaimer">Create a Free Account</a></span>
        </li>
      </ul>
  </div>
  </div>

  <!--
  <div class="clients clearfix">  
      <div class="slidewrap4">    
      <div class="sixteen columns">       
      <h2 class="title">Parterships<span class="line"></span></h2>       
      <ul class="slider" id="sliderName4">     
        <li class="slide carousel4-active-slide"><ul class="items">      <li><a href="http://jozoor.com"><img src="http://themes.jozoor.com/wp/crevision/white/wp-content/uploads/2012/11/client-1.jpg" alt="Poxer"></a></li>
            <li><a href="http://jozoor.com"><img src="http://themes.jozoor.com/wp/crevision/white/wp-content/uploads/2012/11/client-4.jpg" alt="client"></a></li>
            <li><a href="http://jozoor.com"><img src="http://themes.jozoor.com/wp/crevision/white/wp-content/uploads/2012/11/client-3.jpg" alt="Kiski"></a></li>
            <li><a href="http://jozoor.com"><img src="http://themes.jozoor.com/wp/crevision/white/wp-content/uploads/2012/11/client-1.jpg" alt="Poxer"></a></li>
            <li><a href="http://jozoor.com"><img src="http://themes.jozoor.com/wp/crevision/white/wp-content/uploads/2012/11/client-4.jpg" alt="client"></a></li>
      </ul></li>
      </ul>      
      </div>      
      </div>
  </div> -->

  <!-- <<< End Container >>> -->
  <script>
  $('#menu_homepage').attr('class', 'active');
  </script><?php }} ?>
