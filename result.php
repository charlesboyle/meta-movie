<html>
	<head>
		<title>metamovie.</title>
		<link rel="icon" href=Logo2.png>
		<link type="text/css" rel="stylesheet" href="css/project.css"/>
	</head>
	<body link = black bgcolor = F2F2F2>
	<div id="fixed" font="Nexa Light">
		<a href = "index.php"><img style = "position:relative;z-index:2;blend-mode:color-burn;padding: 25px 25px;" src = Logo2.png height = 15%></a>
	</div>
	<br>
	<?php
	
	ini_set('max_execution_time', 300);
	static $searchText;
	$searchText = strtolower($_GET["query"]);
	$timeStart = microtime(true);
	include('IMDbapi.php');
	
	if (strpos($searchText, ',') !== false)	{
		searchMultiple();
	}	else	{
		searchSingle();
	}
	
	function searchMultiple()	{
		$searchQuery = strtolower($_GET["query"]);
		$searchTerm = explode(", ", $searchQuery);

		$totalCount = 0;
		$num = 0;
		
		echo "<center><br/><br/>	<br/><br/><br/><br/>";
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
	}
	
	function searchSingle()		{
		
		$searchText = strtolower($_GET["query"]);
		$totalCount = 0;
		$num = 0;
		foreach (glob("trimmedFiles/*.txt") as $fileName)	{
			$movieText = file_get_contents($fileName,  true);
			$matchCount = substr_count($movieText, $searchText);
			$totalCount = $totalCount + $matchCount;
			if ($matchCount > 0) {
				$resultArray[$num][1] = substr($fileName, 13, -4);
				$resultArray[$num][0] = $matchCount;
				$num++;
			}	
			$movieText = 0;
		}

		for ($k = ($num - 2); $k >= 0; $k--)	{
			for ($j = 0; $j <= $k; $j++)	{
				if ($resultArray[$j][0] < $resultArray[$j+1][0])	{
					$t1 = $resultArray[$j+1][0];
					$t2 = $resultArray[$j+1][1];
					$resultArray[$j+1][0] = $resultArray[$j][0];
					$resultArray[$j+1][1] = $resultArray[$j][1];
					$resultArray[$j][0] = $t1;
					$resultArray[$j][1] = $t2;
				}
			}
		}

		if ($num>1)	{
			$ub = $num - 2;
		} else	{
			$ub = 0;
		}

		$timeEnd = microtime(true);
		$timeElapsed = $timeEnd - $timeEnd;

		echo "<center><font class=headline><p class=head>";
		echo "We have found " . number_format($totalCount) . " instances for '" . $searchText . "' across " . $num . " movies in " . $timeElapsed . " ms.<br>";
		echo "<form method = 'get' action = 'result.php' id = 'search'><input type = 'text' id = 'txtbox' name = 'query' size = '80' value = '" . $searchText . "' style = 'box-shadow: 0px 0px 100px black;'></form><br/>";
		if ($ub>1)	{
			for ($i = 0; $i <= $ub; $i++)	{
			$totalCount = $totalCount + $resultArray[$i][0];
			}	
		}	else	{
			require "phpspellcheck/include.php"   ;
			$spellcheckObject = new PHPSpellCheck();
			$spellcheckObject -> LicenceKey = "TRIAL";
			$spellcheckObject -> DictionaryPath = ("phpspellcheck/dictionaries/");
			$spellcheckObject -> LoadDictionary("English (International)") ;  //OPTIONAL//
			$spellcheckObject -> LoadCustomDictionary("custom.txt");
		    $suggestionText = $spellcheckObject ->didYouMean($searchText);
			echo "<div style=text-transform:none;font-family:miso;>Did you mean to search for: <a href='".$_SERVER["SCRIPT_NAME"]."?query=".htmlentities($suggestionText)."'>".$suggestionText."?</a></div>";
		}
		
		echo "</p></font><table>";
		if ($ub>1)	{
			for ($i = 0; $i<= $ub; $i++)	{
				echo "<tr><td><font class=font>" . $resultArray[$i][1] . "</font></td><td></td><td><font class=fontbold><div align=left><a href='sourceFiles/" . str_replace(" ", "%20", $resultArray[$i][1]) . ".txt'>" . $resultArray[$i][0] . "</a></div></font></td></tr><br>";
			}
		}
		echo "</table>";
	}
	?>
	
</body>
</html>
