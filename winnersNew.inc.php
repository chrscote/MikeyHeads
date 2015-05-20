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
		$lunker = $row["lunker"];	
			
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
			if ($lunker!="") {
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
		if ($lunker!=" ")
			$lunkGif = "images/tourneys/".$id."Lunk.gif";
	}
	if ($id!="mood") {
?>
	<table width="80%">
    	<tr>
			<td><img src="<?php echo $firstGif; ?>" /></td>
            <td><img src="<?php echo $secondGif; ?>" /></td>
        </tr>
        <tr>
        	<td align="center">1<sup>st</sup> Place<br /><?php echo $first?></td>
            <td align="center">2<sup>nd</sup> Place<br /><?php echo $second?></td>
<?php
			if ($lunker!="") {
?>
        </tr>
        <tr>
        	<td colspan="3" align="center"><img src="<?php echo $lunkGif ?>" /></td>
        </tr>
        <tr>
        	<td colspan="3" align="center">Lunker<br /><?php echo $lunker?></td>
        </tr>
<?php		}
?>
		<tr>
        	<td colspan="3"><img src="trnsp.gif" width="1" height="20" /></td>
        </tr>
    </table>
<?php
	} else
		echo "<p>Sorry, we don't have any photos from this tournament.</p>"
?>