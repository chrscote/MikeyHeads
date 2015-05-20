<?php
	$tourn = $_GET["tnmt"];
	$fileExt = $tourn . "*.gif";
	
	$sql = "SELECT * FROM schedule WHERE id='$tourn'";
	$result = mysql_query($sql) or die ("Could not select data");
	$id = -1;
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$id = $row["id"];
		$date = $row["date"];
		$loc = $row["location"];
		$first = $row["firstPlace"];
		$second = $row["secondPlace"];
		$third = $row["thirdPlace"];
		$lunker = $row["lunker"];	
			
		$fileList = glob("images/tourneys/" . $fileExt);
		$nonWinArray = array();
		
		//Now go through the file list and discard the winning pictures which we already have
		foreach ($fileList as $fileName) {
			$isFirst = strpos($fileName, "First");
			$isSecond = strpos($fileName, "Second");
			$isThird = strpos($fileName, "Third");
			$isLunk = strpos($fileName, "Lunk");
			
			if (!($isFirst||$isSecond||$isThird||$isLunk)) {
				//Place this image name in the first available slot in the array.
				$nonWinArray[] = $fileName;
			}
		}
		$numNonWinners = count($nonWinArray);
		$numRows = floor($numNonWinners/3);		//Number of rows for the remaining pics (3 per row);
		$modNum = $numNonWinners%3;
		
?>
<link rel="stylesheet" type="text/css" href="sched.css" />
<p><a href="index.php?content=sched">Back to schedule</a></p>
	<table width="75%" align="center">
    	<tr>
        	<td colspan="2" id="schedHdr">Tournament Results<br /><?php echo $loc ?></td>
        </tr>
        <tr>
        	<td id="result"><b>1<sup>st</sup> Place:&nbsp;</b></td>
            <td><?php echo $first ?></td>
        </tr>
        <tr>
        	<td id="result"><b>2<sup>nd</sup> Place:&nbsp;</b></td>
            <td><?php echo $second ?></td>
        </tr>
<?php
			if (!is_null($third)) {
?>
        <tr>
        	<td id="result"><b>3<sup>rd</sup> Place:&nbsp;</b></td>
            <td><?php echo $third ?></td>
        </tr>
<?php
			}
			if (trim($lunker)!="") {
?>
        <tr>
        	<td id="result"><b>Lunker:&nbsp;</b></td>
            <td><?php echo $lunker ?></td>
        </tr>
<?php
			}
?>
        <tr>
        	<td colspan="2"><img src="images/trnsp.gif" width="1" height="15" border="0" /></td>
        </tr>
    </table>
<?php
		$firstGif = "images/tourneys/".$id."First.gif";
		$secondGif = "images/tourneys/".$id."Second.gif";
		if (!is_null($third)) {
			$thirdGif = "images/tourneys/".$id."Third.gif";
		}
		if (trim($lunker)!="")
			$lunkGif = "images/tourneys/".$id."Lunk.gif";
	}
	if ($id!="patt") {
?>
	<table width="80%">
    	<tr>
			<td><img src="<?php echo $firstGif; ?>" /></td>
            <td><img src="<?php echo $secondGif; ?>" /></td>
<?php	if (!is_null($third)) {
?>			<td><img src="<?php echo $thirdGif;?>" /></td>
<?php
		}
?>
        </tr>
        <tr>
        	<td align="center">1<sup>st</sup> Place<br /><?php echo $first?></td>
            <td align="center">2<sup>nd</sup> Place<br /><?php echo $second?></td>
<?php		if (!is_null($third)) {
?>			<td align="center">3<sup>rd</sup> Place<br /><?php echo $third;?></td>
<?php
			}
			if (trim($lunker)!="") {
?>
        </tr>
        <tr>
        	<td colspan="3" align="center"><img src="<?php echo $lunkGif ?>" /></td>
        </tr>
        <tr>
        	<td colspan="3" align="center">Lunker<br /><?php echo $lunker?></td>
        </tr>
<?php		}
		$imgNum = 0;
		if ($modNum>0 || $numRows>0)
			echo "<tr>\n<td colspan=\"3\"><p><b>Other big catches from today's tournament:</b></p></td>\n</tr>\n";
		
		for ($n=0; $n < $numRows; $n++) {
			echo "<tr>\n";
			for ($i=0; $i<3; $i++) {
				echo "<td><img src=\"".$nonWinArray[$imgNum]."\"></td>";
				$imgNum++;
			}
			echo "</tr>";
		}
		if ($modNum==1) {
			echo "<tr>\n";
			echo "<td colspan=\"3\" align=\"center\"><img src=\"".$nonWinArray[$imgNum]."\" ></td>\n";
			echo "</tr>\n";
		} elseif ($modNum==2) {
			echo "<tr>\n";
			echo "<td><img src=\"".$nonWinArray[$imgNum++]."\" ></td><td></td>\n";
			echo "<td><img src=\"".$nonWinArray[$imgNum]."\" ></td>\n";
			echo "</tr>\n";
		}
?>
		<tr>
        	<td colspan="3"><img src="trnsp.gif" width="1" height="20" /></td>
        </tr>
    </table>
<?php
	} else
		echo "<p>Sorry, we don't have any photos from this tournament.</p>"
?>