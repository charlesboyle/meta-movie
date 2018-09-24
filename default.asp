<%@language="vbscript"%>
<%option explicit%>
<html>
	<head>
		<title>Home</title>
		<script src="http://js.leapmotion.com/leap-0.4.2.js"></script>
		<link type="text/css" rel="stylesheet" href="projectCSS.css"/>
	</head>
	<body link=black bgcolor=F2F2F2>
		<%
			dim ad
			set ad=server.createobject("MSWC.Adrotator")
		%>
		<!--<img src="gv-fp-0160rv2.png" id="bg-image">-->
		<center>
			<div id=links>
			</div>
			<video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
			<%
				dim objct
				set objct = server.createobject("MSWC.ContentRotator")
				response.write(objct.choosecontent("content.txt"))
			%>
		</center>
			<p class="fixedmenu">
				<font face="Nexa Light" style="font-size:32">
					<div id="fixed" font="Nexa Light">
						<a style="text-decoration:none;" href=algorithm.html>algorithm</a><br/>
						<a style="text-decoration:none;color:white;" href=features.html>features</a><br/>
						<a style="text-decoration:none;" href=contact.html>contact</a><br/>
						<a style="text-decoration:none;" href=about.html>about</a><br/>
						<a style="text-decoration:none;font-family:nexabold;" href=default.asp class="activedark">home.</a><br/>
					</div>
				</font>
			</p>
		<center>
			<table border=0>

				<tr>
					<td style=width:100%>
						<br/><br/>
						<center>
							<a href = "default.asp"><img style = "position:relative;z-index:2;blend-mode:color-burn" src = logo2.png height = 350 width = 350></a>
							<br/><br/>
							<form method = "get" action = "Project14.asp" id = "search">
								<input type = "text" id = "txtbox" name = "query" size = "80" placeholder = "enter search query here"/>
							</form>
							<br/>
							<div id = "define">
								<font face = "quicksand bold">
									Enter a search query and we'll look for<br/>every instance of the terms<br/>occurunce in movies spanning<br/>several decades.
								<br><font style = "font-size:16;">For dictionary based search, click <a href = "dictionarytest.htm">here</a><font style = "font-family:Nexa Light;font-size:13"><sup>BETA</sup></font>
								</font>
							</div>
						</center>
					</td>
				</tr>
		</center>
				<tr>
					<td style="position:absolute;right:0px;">
						<%response.write(ad.getadvertisement("adrot.txt"))%>
					</td>
				</tr>
			</table>
		<center>
		</center>
	</body>
	<script type = "text/javascript">
		// Setup Leap loop with frame callback function
		var controllerOptions = {enableGestures: true};

		Leap.loop(controllerOptions, function(frame) {

		  if (frame.gestures.length > 0) {
		    for (var i = 0; i < frame.gestures.length; i++) {
		      var gesture = frame.gestures[i];

		      if (gesture.type == "swipe") {
		          //Classify swipe as either horizontal or vertical
		          var isHorizontal = Math.abs(gesture.direction[0]) > Math.abs(gesture.direction[1]);
		          //Classify as right-left or up-down
		          if(isHorizontal){
		              if(gesture.direction[0] > 0){
		                  swipeDirection = "right";
						  document.getElementById("txtbox").focus();
							// Setup Leap loop with frame callback function
							var controllerOptions = {enableGestures: true};

							Leap.loop(controllerOptions, function(frame) {

							  if (frame.gestures.length > 0) {
							    for (var i = 0; i < frame.gestures.length; i++) {
							      var gesture = frame.gestures[i];

							      if (gesture.type == "swipe") {
							          //Classify swipe as either horizontal or vertical
							          var isHorizontal = Math.abs(gesture.direction[0]) > Math.abs(gesture.direction[1]);
							          //Classify as right-left or up-down
							          if(isHorizontal){
							              if(gesture.direction[0] > 0){
							                  swipeDirection = "right";
							              } else {
							                  swipeDirection = "left";
							              }
							          } else { //vertical
							              if(gesture.direction[1] > 0){
							                  swipeDirection = "up";
											  window.location = "about.html"
							              } else {
							                  swipeDirection = "down";
							              }                  
							          }
							       }
							     }
							  }

							})
		              } else {
		                  swipeDirection = "left";
		              }
		          } else { //vertical
		              if(gesture.direction[1] > 0){
		                  swipeDirection = "up";
						  window.location = "about.html"
		              } else {
		                  swipeDirection = "down";
		              }                  
		          }
		       }
		     }
		  }

		})
	</script>
</html>
