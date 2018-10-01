<html>
	<head>
		<title>metamovie.</title>
		<link rel="icon" href=Logo2.png>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
	</head>
	<body link=black bgcolor=6C7A89>
		<!--<img src="gv-fp-0160rv2.png" id="bg-image">-->
		<center>
			<div id=container>
			
			<video id="video_background" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
			<source src="<?php
				$strings = array(
				    'Gravity.mp4',
				    'HTTM.mp4',
				);
				$key = array_rand($strings);
				echo $strings[$key];
			?>" type="video/mp4">Video not supported</video>
			</div>
			</center>
			<p class="fixedmenu">
				<font face="Nexa Light" style="font-size:32">
					<div id="fixed" font="Nexa Light">
<!--						<a style="text-decoration:none;" href=algorithm.html>algorithm</a><br/>
						<a style="text-decoration:none;" href=features.html>features</a><br/>
						<a style="text-decoration:none;" href=contact.html>contact</a><br/>
						<a style="text-decoration:none;" href=about.html>about</a><br/>	--
						<a style="text-decoration:none;font-family:nexabold;" href=default.asp class="activedark">home.</a><br/>-->
					</div>
				</font>
			</p>
		<center>
			<table border=0>
				<tr>
					<td style=width:100%>
						<br/><br/><br/><br/>
						<center>
							<a href = "index.php"><img style = "position:relative;z-index:2;blend-mode:color-burn;" src = Logo2.png height = 15%></a>
							<br/><br/>
							<form method = "get" action = "result.php" id = "search">
								<input type = "text" id = "txtbox" name = "query" size = "80" placeholder = "enter search query here" style = "box-shadow: 2px 2px 50px black;">
							</form>
							<br/>
							<div id = "define">
								<font face = "Quicksand Bold">
									Enter a search query and we'll look for<br/>every instance of the terms<br/>occurrence in movies spanning<br/>several decades.
								<br><font style = "font-size:14;">For a dictionary based search, click <a href = "dictionarytest.htm">here</a><font style = "font-family:Nexa Light;font-size:13"><sup>BETA</sup></font>
								<br/><br/><br/><br/>
								<big>
									Originally made with ❤️ using classic ASP for a high school project.
								</big>
								</font>
							</div>
						</center>
					</td>
				</tr>
		</center>
				<tr>
					<td style="position:absolute;right:0px;">
					</td>
				</tr>
			</table>
		<center>
		</center>
	</body>
</html>
