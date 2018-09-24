<html>
	<head>
		<title>metamovie - Results</title>
		<link rel="icon" href=Logo2.png>
		<link type="text/css" rel="stylesheet" href="css/project.css"/>
	</head>
	<body>
		
		<?php
			$searchQuery = " cia, fbi, homeland, security";
			$searchTerm = explode(", ", $searchQuery);

			$totalCount = 0;
			$num = 0;
			
			echo "<center><br/><br/>	<a href = default.php><img style = 'position:relative;z-index:2;blend-mode:color-burn;padding: 25px 25px;' src = logo2.png height = 15%></a><br/><br/><br/><br/>";
			echo "<form method = 'get' action = 'result.php' id = 'search'><input type = 'text' id = 'txtbox' name = 'query' size = '90' value = '" . $searchQuery . "' style = 'box-shadow: 0px 0px 60px rgba(0, 0, 0, 0.3);'></form><br/><br/><br/>";
			foreach (glob("trimmedFiles/*.txt") as $fileName)	{
				$movieText = file_get_contents($fileName,  true);
				$num = 0;
				$k = 0;
				for ($i = 0; $i < count($searchTerm); $i++)	{
					$matchCount = substr_count($movieText, $searchTerm[$i]);
					if ($matchCount > 0)	{
						$k = $k + $matchCount;
						if ($i == (count($searchTerm)-1))	{
							$resultArray[$num][1] = substr($fileName, 13, -4);
							$k = $k*5;
							if ($k <= 10)	{
								$k = 10;
							}	elseif ($k > 150)	{
								$k = 150;
							}
							$resultArray[$num][0] = $k;
//							echo $resultArray[$num][1] . " / " . $resultArray[$num][0] . "<br/>";
							echo "<font face=Miso style=font-size:" . $resultArray[$num][0]. ">[" . strtoupper($resultArray[$num][1]) . "]</font>";
							$num = $num + 1;	
							break;
						}
					}	else	{
						break;
					}
				}
				$movieText = 0;
			}
		?>
		</center>
	</body>
</html>