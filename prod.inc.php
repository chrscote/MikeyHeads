<?php
	if (!isset($_GET["type"])) {
?>
<p>We currently have the following types of hooks available.  All hook packages are just $4.25 per pack.</p><p align="center"><b>Free shipping with 6 or more packs!</b></p>

<table border="0" width="100%">
	<tr>
    	<td width="10%">&nbsp;</td>
    	<td width="20%"><h3>Hook Type</h3></td>
        <td width="10%"><h3>Hook Size</h3></td>
        <td width="20%"><h3>Colors</h3></td>
        <td width="10%"><h3>Weights (oz.)</h3></td>
        <td width="15%"><h3>Hooks per Package</h3></td>
    </tr>
    <tr>
    	<td><img src="images/bbHookBlk.jpg" width="75" height="86" /></td>
    	<td valign="top" align="center"><a href="index.php?content=prod&type=bb">Shaky Head</a></td>
        <td align="center" valign="top">4/0</td>
        <td valign="top">Black<br />Watermelon Red<br />Green Pumpkin</td>
        <td align="center" valign="top">1/8<br />3/16<br />1/4</td>
        <td align="center" valign="top">4 hooks/pack</td>
    </tr>
    <tr>
    	<td colspan="6"><hr size="1" color="#000000" /></td>
    </tr>
    <tr>
    	<td><img src="images/tsHookBlk.jpg" width="75" height="86" /></td>
    	<td valign="top" align="center"><a href="index.php?content=prod&type=ts">Tornado Spin</a></td>
        <td align="center" valign="top">5/0</td>
        <td valign="top">Black<br />Watermelon Red<br />White</td>
        <td align="center" valign="top">3/8, 1/4</td>
        <td align="center" valign="top">1 hook/pack</td>
    </tr>
    <tr>
    	<td colspan="6"><hr size="1" color="#000000" /></td>
    </tr>
    <tr>
    	<td><img src="images/bbHookBlk.jpg" width="75" height="86" /></td>
    	<td valign="top" align="center"><a href="index.php?content=prod&type=sb">Swim Baits</a><br />Same as Shaky Head</td>
        <td align="center" valign="top">4/0</td>
        <td valign="top">Black<br />Watermelon Red<br />Green Pumpkin</td>
        <td align="center" valign="top">1/8<br />3/16<br />1/4</td>
        <td align="center" valign="top">4 hooks/pack</td>
    </tr>
    <tr>
    	<td colspan="6"><h4>All hooks are great for Power Fisherman, Heavy-Line Baitcasters, and even Finnesse guys.  No Problem!</h4></td>
    </tr>
    <tr>
    	<td colspan="6"><img src="images/trnsp.gif" width="1" height="10" /></td>
    </tr>
    <tr>
    </tr>
</table>
<table border="0" width="100%">
	<tr>
    	<td colspan="5"><p>We also have the following lure.  Lures come 8 in a package for only $4.50 plus shipping and handling:</td>
    </tr>
    <tr>
    	<td width="10%">&nbsp;</td>
    	<td width="20%"><h3>Lure</h3></td>
        <td width="20%"><h3>Colors</h3></td>
        <td width="15%"><h3>Lures per Package</h3></td>
    </tr>
    <tr>
    	<td><img src="images/skpStkAll.gif" width="80" height="72" /></td>
        <td align="center" valign="top"><a href="index.php?content=prod&type=ss">Skip Stick</a></td>
        <td align="center" valign="top">Watermelon Red<br />Green Pumpkin<br />Black Blue Laminate</td>
        <td align="center" valign="top">8 lures/pack</td>
    </tr>
</table>
<?php
	} else {
		//type is set
		$type = $_GET["type"];
		if ($type=="ss")
			$imgName = "skpStkBlu.jpg";
		 else 
			$imgName = $type."HookBlk.jpg";
		
		if ($type=="bb") {
?><h2>Shaky Head</h2><p>Very Dependable 4/0 size Mustad hook. Super strong, super sharp. Great for fishing in weed edges, sparse
clumps, wood, rocks, and ledges.  Deep or shallow water.  Used for trickworms, flukes, big/little crawfish, frogs, and many 
more.</p>
    <p>Package of 4 for just $4.25 + shipping and handling.<br /><br /></p>
<?php
		} else if ($type=="sb") {
?><h2>Swim Baits</h2><p>Same as Shaky Head. 4/0 size Mustad hook.  Super strong, super sharp heavy-wire hook.  Use them with all types of swim bits as well as Umbrella rigs.  You can have the confidence during the fight to get them in without the problems of light-wire hooks.  Very strong and sharp to use power to get them in on big smallies and large mouth.  These hooks work good on striper bass, too.  I once caught a 41+ pound 46 1/2 inch striper last November in a river system in CT on a Mikey head 1/4 with zoom fluke.</p>
	<p>Package of 4 for just $4.25 + shipping and handling.<br /><br /></p>
<?php	} else if ($type=="ts") {
?><h2>Tornado Spin</h2><p>Super strong, super sharp 5/0 size Gamakatsu hook. Great for wood, sparse weeds, and rocks. Deep or shallow water.  Used for flukes, keitechs, yum money minnows, umbrella rigs, and many other baits.</p>
	<p>Package of 1 for just $4.25 + shipping and handling.<br /><br /></p>
<?php	} else if ($type=="ss") {
?><h2>Skip Stick</h2><p>Awesome for wacky rig, Texas rig. Skipping under docks tree limbs and hard to reach places. Heavy weeds, wood no problem. Really good fall rate. Soft but rugged with nice wiggle.</p>
<p>Package of 8 for just $4.50 + shipping and handling.<br /><br /></p>
<?php
		}
?>
<h3>Buy 6 or more total packs and get free shipping!</h3>
<form name="hooks" action="index.php" method="post" onsubmit="return checkInput();">
<input type="hidden" name="content" value="addToCart" />
<input type="hidden" name="prodType" id="prodType" value="<?php echo $type; ?>" />
<?php
		//If we're displaying one of the hooks
		if ($type=="sb"||$type=="ts"||$type=="bb") {
?>
<table width="100%" border="0">
    <tr>
    	<td width="75" rowspan="2"><img id="hookPic" name="hookPic" src="images/<?php echo $imgName; ?>" /></td>
        <td align="center">
        	<table border="0" cellpadding="0" cellspacing="0" width="75%">
            	<tr>
                	<td><h3>Color</h3></td>
                    <td><img src="images/trnsp.gif" width="75" height="1" border="0" /></td>
                    <td><h3>Weight (oz)</h3></td>
                    <td><h3>Amount</h3></td>
                </tr>
                <tr>
                	<td colspan="4"><hr width="100%" size="1" color="#000000" /></td>
                </tr>
                <tr>
                <?php
						if ($type=="bb") {
				?>
                	<td align="left"><input type="radio" name="color" id="color" value="Blk" checked="checked" onclick="javascript:changeID();" />Black<br />
                    	<input type="radio" name="color" id="color" value="Grn" onclick="javascript:changeID();" />Green Pumpkin<br />
                        <input type="radio" name="color" id="color" value="Red" onclick="javascript:changeID();" />Watermelon Red</td>
                <?php
						} else {
				?>
                	<td align="left"><input type="radio" name="color" id="color" value="Blk" checked="checked" onclick="javascript:changeID();" />Black<br />
                    	<input type="radio" name="color" id="color" value="Wht" onclick="javascript:changeID();" />White<br />
                        <input type="radio" name="color" id="color" value="Red" onclick="javascript:changeID();" />Watermelon Red</td>	
                <?php
						}
				?>
                    <td></td>
                <?php
						if ($type=="bb") {
				?>
                    <td align="left"><input type="radio" name="weight" value="1_8" onclick="javascript:changeID();" checked="checked" />1/8<br />
                    	<input type="radio" name="weight" value="3_16" onclick="javascript:changeID();" />3/16<br />
                        <input type="radio" name="weight" value="1_4" onclick="javascript:changeID();" />1/4</td>
               <?php	}  else if ($type=="sb") {
				?>
				  	<td align="left">
                    	<input type="radio" name="weight" value="3_16" onclick="javascript:changeID();" checked="checked" />3/16<br />
                        <input type="radio" name="weight" value="1_4" onclick="javascript:changeID();" />1/4</td>
                <?php	} else {
				?>
                	<td align="left">
                    	<input type="radio" name="weight" value="3_8" onclick="javascript:changeID();" checked="checked" />3/8</td>
                <?php	} ?>
                    <td align="center"><input type="text" name="numPacks" size="1" maxlength="2" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" id="hosted_button_id" value="EUCJKLUTFPLHQ" />
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</td>
    </tr>
    <?php
			if ($type=="bb") {
		?><tr>
    	<td colspan="2" align="center"><img src="images/bbWorm1.jpg" width="400" height="102" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><img src="images/bbGrub2.jpg" width="400" height="127" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><img src="images/bbGrub1.jpg" width="400" height="127" /></td>
    </tr>
    <?php
			} else if ($type=="sb"){
	?><tr>
    	<td colspan="2" align="center"><img src="images/swimWorm1.jpg" width="400" height="115" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><img src="images/swimMinnow.jpg" width="400" height="135" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><img src="images/swimWorm2.jpg" width="400" height="127" /></td>
    </tr>
    <?php
			} else {
	?><tr>
    	<td colspan="2" align="center"><img src="images/tsWorm1.jpg" width="371" height="198" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center"><img src="images/tsWorm2.jpg" width="400" height="170" /></td>
    </tr>
    <?php
			}
	?>
</table>
<?php
		} else {		//Not one of the hooks
?>
<table width="75%" border="0" align="center">
    <tr>
    	<td width="75" rowspan="2"><img id="hookPic" name="hookPic" src="images/<?php echo $imgName; ?>" /></td>
        <td align="center">
        	<table border="0" cellpadding="0" cellspacing="0" width="65%">
            	<tr>
                	<td><h3>Color</h3></td>
                    <td rowspan="3"><img src="images/trnsp.gif" width="45" height="1" border="0" /></td>
                    <td><h3>Amount</h3></td>
                </tr>
                <tr>
                	<td colspan="4"><hr width="100%" size="1" color="#000000" /></td>
                </tr>
                <tr>
                	<td align="left"><input type="radio" name="color" id="color" onclick="javascript:changeID();" value="Blu" checked="checked" />Black Blue Laminate<br />
                    	<input type="radio" name="color" id="color" value="Grn" onclick="javascript:changeID();" />Green Pumpkin<br />
                        <input type="radio" name="color" id="color" onclick="javascript:changeID();" value="Red" />Watermelon Red</td>
                    <td align="center"><input type="text" name="numPacks" size="1" maxlength="2" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" id="hosted_button_id" value="EUCJKLUTFPLHQ" />
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_cart_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1" />
</td>
    </tr>
</table>
</form>
<?php
		}
	}
	
?>