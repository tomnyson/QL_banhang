
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>administrator loading...</title>
<style type="text/css">
body {
	background: #161616 url(../file/img/pattern_40.gif) top left repeat;
	margin: 0;
	padding: 0;
	font: 12px normal Verdana, Arial, Helvetica, sans-serif;
	height: 100%;
}

* {margin: 0; padding: 0; outline: none;}

img {border: none;}

a { 
	text-decoration:none; 
	color:#00c6ff;
}

h1 {
	font: 4em normal Arial, Helvetica, sans-serif;
	padding: 20px;	margin: 0;
	text-align:center;
	color:#bbb;
}

h1 small{
	font: 0.2em normal  Arial, Helvetica, sans-serif;
	text-transform:uppercase; letter-spacing: 0.2em; line-height: 5em;
	display: block;
}

.container {width: 960px; margin: 0 auto; overflow: hidden;}

/* PROGRESS BAR */

@-moz-keyframes loading {
	0%{-moz-transform:scale(0,0);}
	100%{-moz-transform:scale(1,1);}	
}

@-webkit-keyframes loading {
	0%{-webkit-transform:scale(0,0);}
	100%{-webkit-transform:scale(1,1);}	
}


@-moz-keyframes pulse {
	0%   {-moz-transform: scale(0);opacity: 0;}
    10%  {-moz-transform: scale(1);opacity: 0.5;}
	50%  {-moz-transform: scale(1.75);opacity: 0;}
    100% {-moz-transform: scale(0);opacity: 0;}  
}

@-webkit-keyframes pulse {
	0%   {-webkit-transform: scale(0);opacity: 0;}
	10%  {-webkit-transform: scale(1);opacity: 0.5;}
    50%  {-webkit-transform: scale(1.75);opacity: 0;}
    100% {-webkit-transform: scale(0);opacity: 0;}    
}


/* Full Width Progress Bar */

#content { 
	width:20%; 
	height:5px; 
	margin:50px auto; 
	background:#000;
}

.fullwidth .expand { 
	width:20%; 
	height:1px; 
	margin:2px 0; 
	background:#2187e7; 
	position:absolute;
	box-shadow:0px 0px 10px 1px rgba(0,198,255,0.7);
    -moz-animation:fullexpand 10s ease-out;
	-webkit-animation:fullexpand 10s ease-out;
}

@-moz-keyframes fullexpand {
	0%  { width:0px;}
	100%{ width:100%;}	
}
@-webkit-keyframes fullexpand {
	0%  { width:0px;}
	100%{ width:100%;}	
}



@-moz-keyframes fill {
	0%{ opacity:0; }
	100%{ opacity:1; }	
}

@-webkit-keyframes fill {
	0%{ opacity:0; }
	100%{ opacity:1; }	
}

/* Trigger button for javascript */

.trigger, .triggerFull, .triggerBar {
	background: #000000;
	background: -moz-linear-gradient(top, #161616 0%, #000000 100%);
	background: -webkit-linear-gradient(top, #161616 0%,#000000 100%);
	border-left:1px solid #111; border-top:1px solid #111; border-right:1px solid #333; border-bottom:1px solid #333; 
	font-family: Verdana, Geneva, sans-serif;
	font-size: 0.8em;
	text-decoration: none;
	text-transform: lowercase;
	text-align: center;
	color: #fff;
	padding: 10px;
	border-radius: 3px;
	display: block;
	margin: 0 auto;
	width: 140px;  
}
		


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js" type="text/javascript"></script>
<script>	
jQuery(window).load(function () {
            redirectTime = "800";
            redirectURL = "../administrator.php";
	        setTimeout("location.href = redirectURL;",redirectTime);
            
             	       
			$('#content').removeClass('fullwidth').queue(function(next){
				$(this).addClass('fullwidth');
		        next();
		    });
		 
});
</script>

</head>
<body>


<!-- FULL WIDTH -->
<div id="content">
<span class="expand"></span>
</div>
<!-- END FULL WIDTH -->
</body>
</html>
