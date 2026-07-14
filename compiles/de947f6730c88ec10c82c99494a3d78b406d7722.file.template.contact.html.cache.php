<?php /* Smarty version Smarty-3.1.19, created on 2014-11-06 00:15:18
         compiled from ".\templates\infinityarts\template.contact.html" */ ?>
<?php /*%%SmartyHeaderCode:21175545b2e16169ed6-09123260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de947f6730c88ec10c82c99494a3d78b406d7722' => 
    array (
      0 => '.\\templates\\infinityarts\\template.contact.html',
      1 => 1412005548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21175545b2e16169ed6-09123260',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'Title' => 0,
    'FacebookId' => 0,
    'Root' => 0,
    'Location' => 0,
    'Phone' => 0,
    'Email' => 0,
    'Domain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_545b2e16335470_42539339',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545b2e16335470_42539339')) {function content_545b2e16335470_42539339($_smarty_tpl) {?>
  <script>
  $('#menu_pages').attr('class', 'active');
  $('#menu_faq').attr('class', 'active');
  </script>
<div class="container clearfix">	  
   <div id="template" class="eleven columns bottom">          
      <h2 class="title">Frequently Asked Questions<span class="line"></span></h2>

       <ul id="toggle-view" class="top-3">
        <li>
            <h3 class="normal">Question #1: Can I be a moderator?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>Moderator work is time consuming and can sometimes seem thankless. It is not always easy and not always fun. You will make new friends but may also lose some. From time to time you will be called upon to make hard decisions - even some you may personally disagree with. That said, it can also be your most rewarding experience on <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
. </p>
				<br />
				<p>
				Moderator status is gained by invitation. Do not ever ASK for it.
				</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #2: How can I become an ambassador?</h3>
            <span class="link normal">+</span>
            <div class="panel">
			    <p>The Ambassadors is the branch of the volunteer program that helps with player support. They specialize in helping players, new and old with any questions or problems they may have. One of their duties is to personally greet new players, giving them a good start in the game as well as welcoming them to <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
. They also maintain a presence in the help channels providing moderation, support and answering questions where required.</p><br />
                <p>Always check our <a href="http://www.facebook.com/<?php echo $_smarty_tpl->tpl_vars['FacebookId']->value;?>
" target="_blank">facebook fan page</a> and see if we are still looking for any ambassadors. Ambassadors are basically old players who have played the game for a very long time and know how the game works. Don't apply if you're still new. Also - if you don't get a reply from Administrators within 24 hours, I'm dearly sorry but you weren't chosen.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #3: Can I have free ACs or Membership?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>No. Simply because we need money to pay off the VPS hosting provider. On the bright side, the server randomly hands out 500 ACs to one lucky winner every thirty minutes. We might also hand out 5,000 ACs to all players who helped us test the game.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #4: My account is hacked / stolen / lost! What do I do!?</h3>
            <span class="link normal">+</span>
            <div class="panel">
			    <p>Most accounts that are 'Hacked' are not truly 'hacked.' An account is stolen because a player has given their password out to a 'friend,' who then takes advantage of that information. Players do this because the 'friend' has promised them in-game items, gold or AdventureCoins and no one can give you these things in-game. We have no control over what information you give to another player, but YOU DO. Remember, we do not allow players to share, trade, sell or give away accounts.</p>
				<br />
                <p>Go to <a href="<?php echo $_smarty_tpl->tpl_vars['Root']->value;?>
contact/recover">this page</a> and fill the required fields. We will send you your new password via e-mail. If you do not remember your e-mail address you used for your account, we are sorry to inform you that we can't retrieve your account no matter what. You cannot get an account back in-game or via our in-game reporting system.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #5: When do you guys release new content?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>Mostly on the weekends so anywhere from Friday to Sunday. And please don't complain if there's no new content - Staff members also have a life to deal with.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #6: I paid for an upgrade but I haven't received it yet, HELP!</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>If you paid by PayPal, please get your PayPal transaction ID number or receipt ID number. To do this, you need to look at your PayPal email confirmation, your PayPal Account or contact PayPal for your payment information.</p>
                <br />
                <p>After you have your PayPal transaction ID, you will also need your Account User Name, Character ID and the email address that is associated with your <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
 account.</p>
                <br />
                <p>In the comments section of the form below, please write include your User Name, Email Address, transaction ID or Receipt ID (these are case sensitive, so COPY and PASTE this information)</p>
				<br />
                <p>If you choose to pay with a payment option where PayPal has to wait for the payment to clear, such as with an echeck, you will be upgraded only after the payment has cleared. If you paid with echeck, check to see when your payment is scheduled to clear before contacting us. We cannot cancel an echeck, you will have to wait for it to clear first before canceling. </p><br />
                <p>If you paid by PayGol, please contact staff members and include your PIN and phone number you used for your payment.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #7: I have suggestions for <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
! How do I share them?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>Many people want to share their suggestions for <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
 with us. We created a forum just for suggestions. We do want to hear your suggestions and comments for <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
. They help us shape the game!</p>
                <br />
                <p>If you have a Suggestion or Comment about <?php echo $_smarty_tpl->tpl_vars['Title']->value;?>
, we would be happy to hear from you. Please post your Suggestion or Comment on the Forums as that is where we look to see what players think. This is the only place that we will look for Game Suggestions.</p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #8: How do I confirm my email address?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>Confirming your email address will allow you to chat, receive our newsletter and your confirmed email cannot change without your permissiom via email.</p>
                <p>To confirm your email address you need to follow these steps:</p><br />
				
                <p>Step 1: Log in, there will be a message to you in the game chat that informs you that you need to verify your account. If you don't have this, scroll up a little and click the "Send Verification". <a href="http://prntscr.com/25b8d8" target="_blank">Click here for the screenshot</a></p><br />
                <p>Step 2: Log into the email address you used to create you account and look for an email from InfinityArts. Also check your junk/spam folders. <a href="http://prntscr.com/25b8z1" target="_blank">Click here for the screenshot.</a></p><br />
                <p>Step 3: Click the provided link to verify your account. <a href="http://prntscr.com/25b99z" target="_blank">Click here for the screenshot.</a></p>
            </div>
        </li>
        <li>
            <h3 class="normal">Question #9: Am I allowed to share, trade, sell or give away my account?</h3>
            <span class="link normal">+</span>
            <div class="panel">
                <p>We do not allow people to share, trade, sell or give away accounts. This is a direct violation of our Rules and Terms & Conditions. People most often are "hacked" because they share an account with a friend. If you share your account with someone, it means that you have to share your account user name and your password and this significantly lessens the safety and security of your account.</p><br />

                <p>We also do not allow players to share game account verifications. If we see that you are sharing accounts and/or verifications, all of your associated game accounts could be banned/disabled.</p><br />

                <p>You should NEVER share your password with anyone. If you think that someone may know your password, you should change it immediately. Please visit this help page to learn how to change your password.</p><br />

                <p>Staff Members will never ask for your password. They do not need your password to assist you. If someone is asking for your password, they are not a staff member and are most likely trying to scam you. </p>
            </div>
        </li>
        </ul>  
	  
   
      <!-- End contact form -->    
   </div>
   
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
     
      <!-- Contact Details -->
     <h2 class="title bottom-2">Bug Reporting / Feedback<span class="line"></span></h2>
     <p>Most of the bug reports we received are so poorly written that we could not figure out what the problem is.</p><br /><p> In order for your bug report or request for help to be clearly understood by the people that can help the most, please follow these guidelines:
       <ul class="circle-list" style="margin-top:5px"> 	   
	   <li class=""> <a href="http://www.chiark.greenend.org.uk/~sgtatham/bugs.html">How to report bugs effectively</a></li>  
	   <li class=""> <a href="http://catb.org/~esr/faqs/smart-questions.html">How to ask smart questions</a></li>  
	   </ul>	   
	 </p>
	 <p>Please send email to our specified address above. Thank you for your understanding and cooperation.</p>
   </div>  
</div>

<script>
$(function() {
  $('#menu_contact').attr('class', 'active');
});
</script>



<?php }} ?>
