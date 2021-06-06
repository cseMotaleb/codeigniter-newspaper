$(document).ready(function(){
	$('body').prepend('<div id="login"><table cellpadding="5" cellspacing="5" width="100%" style="font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif"><tr><td valign="top"><div class="loginWith">Sign in with</div><a class="icon facebookLogInIcon facebookLogIn"></a><a class="icon googleLogInIcon googleLogIn"></a><a class="icon twitterLogInIcon titterLogIn"></a><div class="clear"></div><a href="http://www.ntvbd.com/user/forget_password.php" class="forgetPassword"> Forgot password? </a></td><td valign="middle" class="or"><span>or</span></td><td valign="top"><div class="loginWith">Sign in</div><div class="signInPanel"><form action="http://www.ntvbd.com/user/index.php?continue='+window.top.location+'" method="post"><input name="email" id="email" type="email" placeholder="Email address"><input name="password" id="password" type="password" placeholder="Password"><button type="submit" class="button">Sign In</button>&nbsp;&nbsp;or&nbsp;&nbsp;<a href="http://www.ntvbd.com/user/register.php" class="signUp"> Sign Up </a></form></div></td></tr></table><span class="icon" id="loginCloseIcon"></span></div>');
	$('body').prepend('<div id="loginBg"></div>');
	$('#loginBg').css({'height':window.innerHeight+'px','width':window.innerWidth+'px'});
	$('#loginBg, #loginCloseIcon').click(function(){
		$('#loginBg').fadeOut();
		$('#login').animate({opacity: 0,top: "+=-250px"},300);
	});
	$('#login').css({'left':((window.innerWidth/2) - (490/2))+'px','top':'-250px'});//((window.innerHeight/2) - (250/2))
	
	$('.facebookLogIn').click(function(){
		window.open('http://www.ntvbd.com/user/login.php?type=facebook&continue=http://www.ntvbd.com/close-refresh.html','_blank','directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=850,height=550,left='+((window.innerWidth/2) - (850/2))+',top=70');
	});
	$('.googleLogIn').click(function(){
		window.open('http://www.ntvbd.com/user/login.php?type=google&continue=http://www.ntvbd.com/close-refresh.html','_blank','directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=550,height=350,left='+((window.innerWidth/2) - (550/2))+',top=70');
	});
	$('.titterLogIn').click(function(){
		window.open('http://www.ntvbd.com/user/login.php?type=twitter&continue=http://www.ntvbd.com/close-refresh.html','_blank','directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=550,height=350,left='+((window.innerWidth/2) - (550/2))+',top=70');
	});
	
});
function showLogin()
{
	$('#login').css({'top':'-250px'});
	var w = $('#login').width();
	$('#login').css({'left':((window.innerWidth/2) - (w/2))+'px'});
	if($('#login').css('top')=='-250px')
	{
		$('#loginBg').fadeIn(700);
		$('#login').animate({opacity: 1,top: "+="+(250+((window.innerHeight/2)-200))+'px'},300);
	}
}
function scrollUp(){
	$('html, body').animate({scrollTop:'0'},500);
}
$(document).ready(function(){
	scrolled ();
	$(window).scroll( function () {
	  	scrolled();
	});
	
	function scrolled () {
		if($(window).scrollTop() > 0) {
			$('body #scrollTopImg').remove();
			$('body').append('<img id="scrollTopImg" src="http://ntv-online-site.s3.amazonaws.com/images/scrollTop.png" style="position:fixed; bottom:40px; right:20px; cursor:pointer; z-index:9999999999" onclick="scrollUp();">');
			
	  	} else {
	  		$('body #scrollTopImg').remove();
	  	}
	}
});	
$(document).ready(function(){
	$('body').prepend('<div class="account"><iframe src="http://www.ntvbd.com/user/account.php" width="550" height="400" frameborder="0" /></div>');
	$('body').prepend('<div class="accountBg"></div>');
	$('.accountBg').css({'height':window.innerHeight+'px','width':window.innerWidth+'px','display':'none'});
	$('.accountBg, .accountCloseIcon').click(function(){
		$('.accountBg').fadeOut();
		$('.account').animate({opacity: 0,top: "+=-450px"},300);
	});
	$('.account').css({'left':((window.innerWidth/2) - (490/2))+'px','top':'-450px',display:'none'});//((window.innerHeight/2) - (250/2))
});
function showaccount()
{
	$('.account').css({'top':'-450px'});
	var w = $('.account').width();
	$('.account').css({'left':((window.innerWidth/2) - (w/2))+'px'});
	if($('.account').css('top')=='-450px')
	{
		$('.accountBg').fadeIn(700);
		$('.account').css({'display':'block'});
		$('.account').animate({opacity: 1,top: '+=450px'},300);
	}
}