<?php
	$tourn = $_GET["tnmt"];
	
	$sql = "SELECT * FROM locations WHERE id='$tourn'";
	$result = mysql_query($sql) or die ("Could not select data");
	if (mysql_num_rows($result)>0) {
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$id = $row["id"];
		$loc = $row["location"];
		$lat = $row["lat"];
		$long = $row["long"];
?>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
	var myLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $long ?>);
	var dirDisplay;
	var dirService = new google.maps.DirectionsService();
	
	function initialize(){
		dirDisplay = new google.maps.DirectionsRenderer();
		var mapOptions = {
			zoom: 15,
			center: myLatlng
		};
		var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title:"<?php echo $loc ?>"
		});
		var infoWindow = new google.maps.InfoWindow({content:"<?php echo $loc ?>"});
		infoWindow.open(map, marker);
		dirDisplay.setMap(map);
		dirDisplay.setPanel(document.getElementById('dir_panel'));
	}
	
	function calcRoute() {
		var address = document.getElementById("address").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var zip = document.getElementById("zip").value;
		
		var start = address + " "+city+", "+state+" "+zip;
		//alert("start="+start);
		var request = {
			origin: start,
			destination: myLatlng,
			travelMode: google.maps.TravelMode.DRIVING
		};
		dirService.route(request, function(response, status) {
			if (status==google.maps.DirectionsStatus.OK) {
				dirDisplay.setDirections(response);
			}
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<h3><?php echo $loc?></h3>
<div id="map_canvas"></div>
    <div id="dirFrom">
    	<p>Get directions to this location by entering your address below and clicking "Get Route".</p>
    	<form name="dirForm">
    	<p>Address: <input type="text" id="address" size="20" maxlength="50"  /><br />
        City: <input type="text" id="city" size="15" maxlength="25" /> State: <input type="text" id="state" size="2" maxlength="2" /> Zip: <input type="text" id="zip" size="5" maxlength="10" />
        <input type="button" onClick="calcRoute();" value="Get Route" /></p>
        </form>
    </div>
	<div id="dir_panel"></div>
<?php
	}
?>