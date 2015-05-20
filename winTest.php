<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	$numNonWinners = 0;
	$numFullRows = floor($numNonWinners / 3);		//Number of rows of pictures (3 per row)
	$modNum = $numNonWinners%3;
	
	$imgNum = 0;
	echo "Number of images: ". $numNonWinners." NumFullRows=".$numFullRows."<br/>\n";
	for ($n=0; $n<$numFullRows; $n++) {
		for ($i=0; $i<3; $i++) {
			echo "Display img[".$imgNum."] ";
			$imgNum++;
		}
		echo "<br />\n";
	}
	if ($modNum== 1)
		echo "Add  last image.<br />\n";
	elseif ($modNum == 2) 
		echo "Add last 2 images.<br />\n";
?>
</body>
</html>